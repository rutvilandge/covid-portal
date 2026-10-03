<?php
$pageTitle = 'Admin: users'; $active = '';
require_once __DIR__ . '/../includes/auth.php';
require_admin();
$rows = [];
try { $rows = db()->query('SELECT id, full_name, email, phone, role, created_at FROM users ORDER BY id')->fetchAll(); }
catch (PDOException $ex) { log_error($ex); set_flash('error', GENERIC_ERROR); }
require __DIR__ . '/../includes/header.php';
?>
<section class="page-hero"><div class="container"><h1>Registered users</h1></div></section>
<section class="section"><div class="container">
  <?php require __DIR__ . '/_nav.php'; ?>
  <div class="table-wrap"><table>
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Role</th><th>Registered</th></tr></thead>
    <tbody>
    <?php foreach ($rows as $r): ?>
      <tr><td><?= (int)$r['id'] ?></td><td><?= e($r['full_name']) ?></td><td><?= e($r['email']) ?></td><td><?= e($r['phone']) ?></td><td><?= e($r['role']) ?></td><td><?= e($r['created_at']) ?></td></tr>
    <?php endforeach; ?>
    </tbody>
  </table></div>
</div></section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
