<?php
$pageTitle = 'Login'; $active = '';
require __DIR__ . '/includes/header.php';
if (is_logged_in()) redirect('dashboard.php');
?>
<section class="section"><div class="container narrow">
  <h1>Log in</h1>
  <form class="form" method="post" action="<?= e(url('actions/login_action.php')) ?>" data-validate novalidate>
    <?= csrf_field() ?>
    <?php form_field('email', 'Email', 'email', 'email', 'required maxlength="100" autocomplete="email"'); ?>
    <?php form_field('password', 'Password', 'password', 'required', 'required maxlength="64" autocomplete="current-password"'); ?>
    <button class="btn" type="submit">Log in</button>
  </form>
  <p>New here? <a href="<?= e(url('register.php')) ?>">Create an account</a></p>
</div></section>
<?php clear_old(); require __DIR__ . '/includes/footer.php'; ?>
