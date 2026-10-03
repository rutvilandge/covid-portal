<?php
$pageTitle = 'Admin: comments'; $active = '';
require_once __DIR__ . '/../includes/auth.php';
require_admin();

// Moderation: hide, show or delete a comment (POST + CSRF + prepared statements).
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'] ?? '', FILTER_VALIDATE_INT);
    $do = $_POST['do'] ?? '';
    if (!csrf_valid() || !$id || !in_array($do, ['hide', 'show', 'delete'], true)) {
        set_flash('error', 'Invalid request.');
    } else {
        try {
            if ($do === 'delete') $st = db()->prepare('DELETE FROM comments WHERE id = ?');
            else $st = db()->prepare('UPDATE comments SET status = ? WHERE id = ?');
            $do === 'delete' ? $st->execute([$id]) : $st->execute([$do === 'hide' ? 'hidden' : 'visible', $id]);
            set_flash('success', 'Comment updated.');
        } catch (PDOException $ex) { log_error($ex); set_flash('error', GENERIC_ERROR); }
    }
    redirect('admin/comments.php');
}
$rows = [];
try { $rows = db()->query('SELECT c.id, c.comment, c.status, c.created_at, u.full_name, u.email FROM comments c JOIN users u ON u.id = c.user_id ORDER BY c.created_at DESC, c.id DESC')->fetchAll(); }
catch (PDOException $ex) { log_error($ex); set_flash('error', GENERIC_ERROR); }
require __DIR__ . '/../includes/header.php';
?>
<section class="page-hero"><div class="container"><h1>Comments</h1></div></section>
<section class="section"><div class="container">
  <?php require __DIR__ . '/_nav.php'; ?>
  <div class="table-wrap"><table>
    <thead><tr><th>ID</th><th>User</th><th>Comment</th><th>Status</th><th>Posted</th><th>Action</th></tr></thead>
    <tbody>
    <?php foreach ($rows as $r): ?>
      <tr>
        <td><?= (int)$r['id'] ?></td><td><?= e($r['full_name']) ?><br><small><?= e($r['email']) ?></small></td>
        <td><?= nl2br(e($r['comment'])) ?></td><td><?= e($r['status']) ?></td><td><?= e($r['created_at']) ?></td>
        <td>
          <form method="post" class="inline-form">
            <?= csrf_field() ?><input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
            <button class="btn btn-small btn-outline" name="do" value="<?= $r['status'] === 'visible' ? 'hide' : 'show' ?>"><?= $r['status'] === 'visible' ? 'Hide' : 'Show' ?></button>
            <button class="btn btn-small btn-danger" name="do" value="delete" onclick="return confirm('Delete this comment permanently?');">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table></div>
</div></section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
