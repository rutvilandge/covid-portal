<?php
require_once __DIR__ . '/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('comments.php');
require_login();
$back = post('return') === 'dashboard' ? 'dashboard.php' : 'comments.php';
if (!csrf_valid()) { set_flash('error', 'Your session expired. Please try again.'); redirect($back); }

$comment = post('comment');
$err = validate_text_length($comment, COMMENT_MIN, COMMENT_MAX, 'Comment');
if ($err) { set_old($_POST, ['comment' => $err]); redirect($back); }

try {
    $st = db()->prepare('INSERT INTO comments (user_id, comment) VALUES (?, ?)');
    $st->execute([$_SESSION['user_id'], $comment]);   // stored as plain text; escaped on output
    clear_old();
    set_flash('success', 'Your comment has been posted.');
} catch (PDOException $ex) {
    log_error($ex);
    set_flash('error', GENERIC_ERROR);
}
redirect($back);
