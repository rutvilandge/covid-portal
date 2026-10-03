<?php
$pageTitle = 'Admin login'; $active = '';
require_once __DIR__ . '/../includes/auth.php';
if (is_admin()) redirect('admin/dashboard.php');
require __DIR__ . '/../includes/header.php';
?>
<section class="section"><div class="container narrow">
  <h1>Admin login</h1>
  <p>Restricted area. Only accounts with the admin role can sign in here.</p>
  <form class="form" method="post" action="<?= e(url('actions/login_action.php')) ?>" data-validate novalidate>
    <?= csrf_field() ?><input type="hidden" name="admin" value="1">
    <?php form_field('email', 'Admin email', 'email', 'email', 'required maxlength="100" autocomplete="username"'); ?>
    <?php form_field('password', 'Password', 'password', 'required', 'required maxlength="64" autocomplete="current-password"'); ?>
    <button class="btn" type="submit">Log in as admin</button>
  </form>
</div></section>
<?php clear_old(); require __DIR__ . '/../includes/footer.php'; ?>
