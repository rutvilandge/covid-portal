<?php
$pageTitle = 'Admin dashboard'; $active = '';
require_once __DIR__ . '/../includes/auth.php';
require_admin();
$c = ['Users' => 0, 'Comments' => 0, 'Contact messages' => 0];
try {
    $pdo = db();
    $c = ['Users' => (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn(),
          'Comments' => (int)$pdo->query('SELECT COUNT(*) FROM comments')->fetchColumn(),
          'Contact messages' => (int)$pdo->query('SELECT COUNT(*) FROM registrations')->fetchColumn()];
} catch (PDOException $ex) { log_error($ex); set_flash('error', GENERIC_ERROR); }
require __DIR__ . '/../includes/header.php';
?>
<section class="page-hero"><div class="container"><h1>Admin dashboard</h1></div></section>
<section class="section"><div class="container">
  <?php require __DIR__ . '/_nav.php'; ?>
  <div class="card-grid three">
    <?php foreach ($c as $l => $n): ?><div class="card stat"><p class="stat-num"><?= $n ?></p><p><?= e($l) ?></p></div><?php endforeach; ?>
  </div>
</div></section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
