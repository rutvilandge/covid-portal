<?php
/**
 * Common helpers: bootstrap, sessions, escaping, flash messages, CSRF, redirects.
 */
define('ROOT_DIR', dirname(__DIR__));
require_once ROOT_DIR . '/config/database.php';
require_once ROOT_DIR . '/includes/validation.php';

// Never show raw PHP errors to visitors; log them instead.
ini_set('display_errors', '0');
error_reporting(E_ALL);
ini_set('log_errors', '1');
ini_set('error_log', getenv('VERCEL') ? 'php://stderr' : ROOT_DIR . '/php-error.log');

// Base URL detection so links work at the domain root or in a subfolder.
function detect_base_url(): string
{
    if (BASE_URL_OVERRIDE !== null) return rtrim(BASE_URL_OVERRIDE, '/');
    $doc  = isset($_SERVER['DOCUMENT_ROOT']) ? realpath($_SERVER['DOCUMENT_ROOT']) : false;
    $root = realpath(ROOT_DIR);
    if ($doc && $root) {
        $doc  = rtrim(str_replace('\\', '/', $doc), '/');
        $root = str_replace('\\', '/', $root);
        $prefix = DIRECTORY_SEPARATOR === '\\' ? strncasecmp($root, $doc, strlen($doc)) === 0 : strncmp($root, $doc, strlen($doc)) === 0;
        if ($prefix && ($root === $doc || substr($root, strlen($doc), 1) === '/')) return substr($root, strlen($doc));
    }
    return '';
}
define('BASE_URL', detect_base_url());

/** Persist sessions in PostgreSQL when deployed to serverless instances. */
final class PostgreSQLSessionHandler implements SessionHandlerInterface
{
    public function open(string $path, string $name): bool { return true; }
    public function close(): bool { return true; }

    public function read(string $id): string|false
    {
        $st = db()->prepare('SELECT session_data FROM sessions WHERE session_id = ? AND last_activity >= ?');
        $st->execute([$id, time() - (int)ini_get('session.gc_maxlifetime')]);
        $data = $st->fetchColumn();
        return $data === false ? '' : (string)$data;
    }

    public function write(string $id, string $data): bool
    {
        $st = db()->prepare('INSERT INTO sessions (session_id, session_data, last_activity) VALUES (?, ?, ?) ON CONFLICT (session_id) DO UPDATE SET session_data = EXCLUDED.session_data, last_activity = EXCLUDED.last_activity');
        return $st->execute([$id, $data, time()]);
    }

    public function destroy(string $id): bool
    {
        $st = db()->prepare('DELETE FROM sessions WHERE session_id = ?');
        return $st->execute([$id]);
    }

    public function gc(int $max_lifetime): int|false
    {
        $st = db()->prepare('DELETE FROM sessions WHERE last_activity < ?');
        $st->execute([time() - $max_lifetime]);
        return $st->rowCount();
    }
}

if (session_status() === PHP_SESSION_NONE && PHP_SAPI !== 'cli') {
    $isHttps = !empty($_SERVER['HTTPS']) && strtolower((string)$_SERVER['HTTPS']) !== 'off';
    session_set_cookie_params(['httponly' => true, 'secure' => $isHttps, 'samesite' => 'Lax', 'path' => '/']);
    if (getenv('VERCEL')) session_set_save_handler(new PostgreSQLSessionHandler(), true);
    session_start();
}

/** Escape for HTML output (XSS protection). */
function e(?string $s): string
{
    return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function url(string $path = ''): string
{
    return BASE_URL . '/' . ltrim($path, '/');
}

function redirect(string $path): never
{
    header('Location: ' . url($path));
    exit;
}

/** Flash messages (shown once). */
function set_flash(string $type, string $msg): void
{
    $_SESSION['flash'][] = ['type' => $type, 'msg' => $msg];
}

function pull_flash(): array
{
    $f = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $f;
}

/** Remember submitted values (never passwords) and errors so forms can be re-filled. */
function set_old(array $data, array $errors = []): void
{
    unset($data['password'], $data['confirm_password'], $data['csrf_token']);
    $_SESSION['old']    = $data;
    $_SESSION['errors'] = $errors;
}

function old(string $key): string
{
    return e($_SESSION['old'][$key] ?? '');
}

function field_error(string $key): ?string
{
    return $_SESSION['errors'][$key] ?? null;
}

function clear_old(): void
{
    unset($_SESSION['old'], $_SESSION['errors']);
}

/** CSRF protection for every POST form. */
function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_valid(): bool
{
    $sent = $_POST['csrf_token'] ?? '';
    return is_string($sent) && !empty($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $sent);
}

/** Return trimmed POST value as string. */
function post(string $key): string
{
    $v = $_POST[$key] ?? '';
    return is_string($v) ? trim($v) : '';
}

/** Image helper: local file with alt text and a graceful fallback. */
function img(string $file, string $alt, string $class = ''): string
{
    $src = url('assets/images/' . $file);
    return '<img src="' . e($src) . '" alt="' . e($alt) . '" class="' . e($class)
         . '" loading="lazy" onerror="this.onerror=null;this.classList.add(\'img-missing\');">';
}

/** Log technical errors, show friendly text to the user. */
function log_error(Throwable $t): void
{
    error_log('[' . date('Y-m-d H:i:s') . '] ' . get_class($t) . ': ' . $t->getMessage());
}

const GENERIC_ERROR = 'Something went wrong. Please try again.';

/**
 * Render one labelled form field with its (server-side) error and a slot for JS errors.
 * $rule is read by assets/js/script.js (name, email, phone, password, confirm, text:min:max).
 */
function form_field(string $id, string $label, string $type, string $rule, string $extra = '', bool $keepValue = true): void
{
    $err   = field_error($id);
    $value = ($keepValue && $type !== 'password') ? old($id) : '';
    echo '<div class="field' . ($err ? ' has-error' : '') . '">';
    echo '<label for="' . e($id) . '">' . e($label) . '</label>';
    if ($type === 'textarea') {
        echo '<textarea id="' . e($id) . '" name="' . e($id) . '" rows="5" data-rule="' . e($rule) . '" aria-describedby="' . e($id) . '-error" ' . $extra . '>' . $value . '</textarea>';
    } else {
        echo '<input id="' . e($id) . '" name="' . e($id) . '" type="' . e($type) . '" value="' . $value . '" data-rule="' . e($rule) . '" aria-describedby="' . e($id) . '-error" ' . $extra . '>';
    }
    echo '<p class="field-error" id="' . e($id) . '-error" role="alert">' . e($err) . '</p></div>';
}
