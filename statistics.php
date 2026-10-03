<?php
$pageTitle = 'Statistics'; $active = 'statistics';
require __DIR__ . '/includes/header.php';
$live = null;
try {
    $pdo = db();
    $live = [
        'Registered users' => (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn(),
        'Comments posted'  => (int)$pdo->query("SELECT COUNT(*) FROM comments WHERE status = 'visible'")->fetchColumn(),
        'Contact messages' => (int)$pdo->query('SELECT COUNT(*) FROM registrations')->fetchColumn(),
        'Information sections' => 6,
    ];
} catch (PDOException $ex) { log_error($ex); }
$sample = [['Sample cases (demo)', '12,345'], ['Sample recoveries (demo)', '11,200'], ['Sample vaccinations (demo)', '98,765'], ['Sample tests (demo)', '150,000']];
?>
<section class="page-hero"><div class="container"><h1>Statistics</h1><p class="lead">Portal activity is live from our database. Case figures are demonstration data only.</p></div></section>
<section class="section">
  <div class="container">
    <h2>Portal activity</h2>
    <?php if ($live): ?>
      <div class="card-grid four">
        <?php foreach ($live as $label => $n): ?><div class="card stat"><p class="stat-num"><?= (int)$n ?></p><p><?= e($label) ?></p></div><?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="alert alert-error">Statistics are unavailable right now. <?= e(GENERIC_ERROR) ?></p>
    <?php endif; ?>
  </div>
</section>
<section class="section section-tint">
  <div class="container">
    <h2>Sample / Demonstration Data</h2>
    <p class="disclaimer">These numbers are invented to show the layout. They are not real COVID-19 statistics. For current figures, visit the WHO COVID-19 dashboard or your national health ministry.</p>
    <div class="card-grid four">
      <?php foreach ($sample as [$l, $n]): ?><div class="card stat stat-sample"><p class="stat-num"><?= e($n) ?></p><p><?= e($l) ?></p></div><?php endforeach; ?>
    </div>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
