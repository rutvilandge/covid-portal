<?php
require_once __DIR__ . '/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('register.php');
if (!csrf_valid()) { set_flash('error', 'Your session expired. Please try again.'); redirect('register.php'); }

$name = post('full_name'); $email = strtolower(post('email')); $phone = post('phone');
$pw = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';
$cpw = is_string($_POST['confirm_password'] ?? null) ? $_POST['confirm_password'] : '';

$errors = array_filter([
    'full_name' => validate_name($name),
    'email' => validate_email($email),
    'phone' => validate_phone($phone),
    'password' => validate_password($pw),
    'confirm_password' => validate_confirm($pw, $cpw),
]);
if ($errors) { set_old($_POST, $errors); redirect('register.php'); }

try {
    $pdo = db();
    $st = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $st->execute([$email]);
    if ($st->fetch()) {
        set_old($_POST, ['email' => 'This email is already registered. Try logging in.']);
        redirect('register.php');
    }
    $ins = $pdo->prepare('INSERT INTO users (full_name, email, phone, password) VALUES (?, ?, ?, ?)');
    $ins->execute([$name, $email, $phone, password_hash($pw, PASSWORD_DEFAULT)]);
    clear_old();
    set_flash('success', 'Registration successful. You can now log in.');
    redirect('login.php');
} catch (PDOException $ex) {
    log_error($ex);
    // PostgreSQL 23505 = unique violation (e.g. concurrent duplicate registration)
    if ($ex->getCode() === '23505') { set_old($_POST, ['email' => 'This email is already registered. Try logging in.']); }
    else { set_old($_POST); set_flash('error', GENERIC_ERROR); }
    redirect('register.php');
}
