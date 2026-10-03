<?php
declare(strict_types=1);

// Dispatch only known public PHP endpoints. Internal PHP files (config,
// includes and tests) are never directly addressable through this router.
$path = (string)($_GET['path'] ?? '');
$path = rawurldecode(trim($path, '/'));
if ($path === '') $path = 'index.php';

$publicScripts = [
    'index.php', 'about.php', 'symptoms.php', 'prevention.php', 'vaccination.php',
    'statistics.php', 'comments.php', 'contact.php', 'login.php', 'register.php',
    'dashboard.php', 'logout.php',
    'actions/register_action.php', 'actions/login_action.php',
    'actions/comment_action.php', 'actions/contact_action.php',
    'admin/login.php', 'admin/dashboard.php', 'admin/users.php',
    'admin/comments.php', 'admin/registrations.php', 'admin/logout.php',
];

if (!in_array($path, $publicScripts, true)) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Not found';
    exit;
}

require dirname(__DIR__) . '/' . $path;
