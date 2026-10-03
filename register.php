<?php
$pageTitle = 'Register'; $active = '';
require __DIR__ . '/includes/header.php';
if (is_logged_in()) redirect('dashboard.php');
?>
<section class="section"><div class="container narrow">
  <h1>Create your account</h1>
  <p>Registered users can post comments and keep track of their messages.</p>
  <form class="form" method="post" action="<?= e(url('actions/register_action.php')) ?>" data-validate novalidate>
    <?= csrf_field() ?>
    <?php form_field('full_name', 'Full name', 'text', 'name', 'required maxlength="50" autocomplete="name"'); ?>
    <?php form_field('email', 'Email', 'email', 'email', 'required maxlength="100" autocomplete="email"'); ?>
    <?php form_field('phone', 'Phone number (10 digits)', 'tel', 'phone', 'required maxlength="10" inputmode="numeric" autocomplete="tel"'); ?>
    <?php form_field('password', 'Password', 'password', 'password', 'required maxlength="64" autocomplete="new-password" data-strength="strength-meter"'); ?>
    <div class="strength" id="strength-meter" aria-live="polite"><span class="strength-bar"></span><span class="strength-text">Password strength</span></div>
    <?php form_field('confirm_password', 'Confirm password', 'password', 'confirm:password', 'required maxlength="64" autocomplete="new-password"'); ?>
    <button class="btn" type="submit">Create account</button>
  </form>
  <p>Already registered? <a href="<?= e(url('login.php')) ?>">Log in</a></p>
</div></section>
<?php clear_old(); require __DIR__ . '/includes/footer.php'; ?>
