<?php
$pageTitle = 'Admin: contact messages'; $active = '';
require_once __DIR__ . '/../includes/auth.php';
require_admin();
$rows = [];
try { $rows = db()->query('SELECT id, user_id, name, email, phone, message, created_at FROM registrations ORDER BY created_at DESC, id DESC')->fetchAll(); }
catch (PDOException $ex) { log_error($ex); set_flash('error', GENERIC_ERROR); }
require __DIR__ . '/../includes/header.php';
?>
<section class="page-hero"><div class="container"><h1>Contact / registration submissions</h1></div></section>
<section class="section"><div class="container">
  <?php require __DIR__ . '/_nav.php'; ?>
  <div class="table-wrap"><table>
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>User ID</th><th>Sent</th></tr></thead>
    <tbody>
    <?php foreach ($rows as $r): ?>
      <tr><td><?= (int)$r['id'] ?></td><td><?= e($r['name']) ?></td><td><?= e($r['email']) ?></td><td><?= e($r['phone']) ?></td>
      <td><?= nl2br(e($r['message'])) ?></td><td><?= $r['user_id'] === null ? 'Guest' : (int)$r['user_id'] ?></td><td><?= e($r['created_at']) ?></td></tr>
    <?php endforeach; ?>
    </tbody>
  </table></div>
</div></section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
