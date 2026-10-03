<?php
require_once __DIR__ . '/functions.php';

function is_logged_in(): bool
{
    return !empty($_SESSION['user_id']);
}

function is_admin(): bool
{
    return is_logged_in() && ($_SESSION['user_role'] ?? '') === 'admin';
}

/** Redirect guests to the login page. */
function require_login(): void
{
    if (!is_logged_in()) {
        set_flash('error', 'Please log in to continue.');
        redirect('login.php');
    }
}

/** Only admins may pass; everyone else is sent away. */
function require_admin(): void
{
    if (!is_admin()) {
        set_flash('error', 'Admin access required.');
        redirect('admin/login.php');
    }
}

/** Start an authenticated session (regenerates the ID to prevent fixation). */
function login_user(array $user): void
{
    session_regenerate_id(true);
    $_SESSION['user_id']   = (int)$user['id'];
    $_SESSION['user_name'] = $user['full_name'];
    $_SESSION['user_role'] = $user['role'];
}

function logout_user(): void
{
    $_SESSION = [];
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_unset();
        session_destroy();
    }
    // Start a fresh anonymous session so the logout confirmation (and any
    // other post-logout flash) can survive the redirect. Never reuse the old ID.
    session_id('');
    session_start();
}

function current_user(): ?array
{
    if (!is_logged_in()) return null;
    $st = db()->prepare('SELECT id, full_name, email, phone, role, created_at FROM users WHERE id = ?');
    $st->execute([$_SESSION['user_id']]);
    return $st->fetch() ?: null;
}
