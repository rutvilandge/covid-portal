<?php
$pageTitle = 'Community comments'; $active = 'comments';
require __DIR__ . '/includes/header.php';
$rows = [];
try {
    $rows = db()->query("SELECT c.comment, c.created_at, u.full_name FROM comments c JOIN users u ON u.id = c.user_id WHERE c.status = 'visible' ORDER BY c.created_at DESC, c.id DESC LIMIT 50")->fetchAll();
} catch (PDOException $ex) { log_error($ex); echo '<div class="container"><p class="alert alert-error">' . e(GENERIC_ERROR) . '</p></div>'; }
?>
<section class="page-hero"><div class="container"><h1>Community comments</h1><p class="lead">Share what you have learned. Please keep it respectful and do not post medical advice or personal details.</p></div></section>
<section class="section"><div class="container narrow">
  <?php if (is_logged_in()): ?>
    <form class="form" method="post" action="<?= e(url('actions/comment_action.php')) ?>" data-validate novalidate>
      <?= csrf_field() ?>
      <?php form_field('comment', 'Your comment (5 to 500 characters)', 'textarea', 'text:5:500', 'required maxlength="500"'); ?>
      <p class="counter" data-counter-for="comment" data-max="500">0 / 500</p>
      <button class="btn" type="submit">Post comment</button>
    </form>
  <?php else: ?>
    <p class="callout"><a href="<?= e(url('login.php')) ?>">Log in</a> or <a href="<?= e(url('register.php')) ?>">register</a> to post a comment.</p>
  <?php endif; ?>
  <h2>Recent comments</h2>
  <?php if (!$rows): ?><p>No comments yet. Be the first to post one.</p><?php endif; ?>
  <?php foreach ($rows as $r): ?>
    <article class="comment">
      <header><strong><?= e($r['full_name']) ?></strong> <time datetime="<?= e($r['created_at']) ?>"><?= e(date('d M Y, H:i', strtotime($r['created_at']))) ?></time></header>
      <p><?= nl2br(e($r['comment'])) ?></p>
    </article>
  <?php endforeach; ?>
</div></section>
<?php clear_old(); require __DIR__ . '/includes/footer.php'; ?>
