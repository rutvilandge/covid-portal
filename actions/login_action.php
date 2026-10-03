<?php
require_once __DIR__ . '/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('login.php');
if (!csrf_valid()) { set_flash('error', 'Your session expired. Please try again.'); redirect('login.php'); }

$email = strtolower(post('email'));
$pw = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';
$adminLogin = post('admin') === '1';
$back = $adminLogin ? 'admin/login.php' : 'login.php';

$errors = array_filter(['email' => validate_email($email), 'password' => $pw === '' ? 'Password is required.' : null]);
if ($errors) { set_old($_POST, $errors); redirect($back); }

try {
    $st = db()->prepare('SELECT id, full_name, password, role FROM users WHERE email = ?');
    $st->execute([$email]);
    $user = $st->fetch();
    // Same message for unknown email and wrong password (no account enumeration).
    if (!$user || !password_verify($pw, $user['password']) || ($adminLogin && $user['role'] !== 'admin')) {
        set_old($_POST, []);
        set_flash('error', 'Invalid email or password.');
        redirect($back);
    }
    clear_old();
    login_user($user);
    if ($adminLogin) { redirect('admin/dashboard.php'); }
    set_flash('success', 'Welcome back, ' . $user['full_name'] . '.');
    redirect('dashboard.php');
} catch (PDOException $ex) {
    log_error($ex);
    set_flash('error', GENERIC_ERROR);
    redirect($back);
}
