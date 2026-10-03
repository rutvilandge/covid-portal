<?php
$pageTitle = 'Dashboard'; $active = 'dashboard';
require_once __DIR__ . '/includes/auth.php';
require_login();
$user = current_user();
if (!$user) { logout_user(); set_flash('error', 'Your account could not be found. Please log in again.'); redirect('login.php'); }
$comments = $messages = [];
try {
    $st = db()->prepare('SELECT comment, status, created_at FROM comments WHERE user_id = ? ORDER BY created_at DESC, id DESC');
    $st->execute([$user['id']]); $comments = $st->fetchAll();
    $st = db()->prepare('SELECT message, created_at FROM registrations WHERE user_id = ? ORDER BY created_at DESC, id DESC');
    $st->execute([$user['id']]); $messages = $st->fetchAll();
} catch (PDOException $ex) { log_error($ex); set_flash('error', GENERIC_ERROR); }
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero"><div class="container">
  <h1>Welcome, <?= e($user['full_name']) ?></h1>
  <p class="lead">Your account, comments and messages.</p>
</div></section>
<section class="section"><div class="container dash-grid">
  <div class="card">
    <h2>Account information</h2>
    <dl class="info">
      <dt>Name</dt><dd><?= e($user['full_name']) ?></dd>
      <dt>Email</dt><dd><?= e($user['email']) ?></dd>
      <dt>Phone</dt><dd><?= e($user['phone']) ?></dd>
      <dt>Member since</dt><dd><?= e(date('d M Y', strtotime($user['created_at']))) ?></dd>
    </dl>
    <?php if ($user['role'] === 'admin'): ?><p><a href="<?= e(url('admin/dashboard.php')) ?>">Open admin area</a></p><?php endif; ?>
    <a class="btn btn-outline" href="<?= e(url('logout.php')) ?>">Logout</a>
  </div>
  <div class="card">
    <h2>Post a comment</h2>
    <form class="form" method="post" action="<?= e(url('actions/comment_action.php')) ?>" data-validate novalidate>
      <?= csrf_field() ?><input type="hidden" name="return" value="dashboard">
      <?php form_field('comment', 'Comment (5 to 500 characters)', 'textarea', 'text:5:500', 'required maxlength="500"'); ?>
      <p class="counter" data-counter-for="comment" data-max="500">0 / 500</p>
      <button class="btn" type="submit">Post comment</button>
    </form>
  </div>
  <div class="card wide">
    <h2>Your comments (<?= count($comments) ?>)</h2>
    <?php if (!$comments): ?><p>You have not posted any comments yet.</p><?php endif; ?>
    <?php foreach ($comments as $c): ?>
      <article class="comment">
        <header><time datetime="<?= e($c['created_at']) ?>"><?= e(date('d M Y, H:i', strtotime($c['created_at']))) ?></time>
        <?php if ($c['status'] === 'hidden'): ?><span class="badge">Hidden by admin</span><?php endif; ?></header>
        <p><?= nl2br(e($c['comment'])) ?></p>
      </article>
    <?php endforeach; ?>
  </div>
  <div class="card wide">
    <h2>Your contact submissions (<?= count($messages) ?>)</h2>
    <?php if (!$messages): ?><p>No messages sent while logged in. <a href="<?= e(url('contact.php')) ?>">Contact us</a></p><?php endif; ?>
    <?php foreach ($messages as $m): ?>
      <article class="comment"><header><time><?= e(date('d M Y, H:i', strtotime($m['created_at']))) ?></time></header><p><?= nl2br(e($m['message'])) ?></p></article>
    <?php endforeach; ?>
  </div>
</div></section>
<?php clear_old(); require __DIR__ . '/includes/footer.php'; ?>
