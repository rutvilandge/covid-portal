<?php
require_once __DIR__ . '/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('contact.php');
if (!csrf_valid()) { set_flash('error', 'Your session expired. Please try again.'); redirect('contact.php'); }

$name = post('name'); $email = strtolower(post('email')); $phone = post('phone'); $msg = post('message');
$errors = array_filter([
    'name' => validate_name($name),
    'email' => validate_email($email),
    'phone' => validate_phone($phone),
    'message' => validate_text_length($msg, MESSAGE_MIN, MESSAGE_MAX, 'Message'),
]);
if ($errors) { set_old($_POST, $errors); redirect('contact.php'); }

try {
    $st = db()->prepare('INSERT INTO registrations (user_id, name, email, phone, message) VALUES (?, ?, ?, ?, ?)');
    $st->execute([$_SESSION['user_id'] ?? null, $name, $email, $phone, $msg]);
    clear_old();
    set_flash('success', 'Thank you. Your message has been submitted.');
} catch (PDOException $ex) {
    log_error($ex);
    set_old($_POST);
    set_flash('error', GENERIC_ERROR);
}
redirect('contact.php');
