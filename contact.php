<?php
$pageTitle = 'Contact'; $active = 'contact';
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero"><div class="container"><h1>Contact us</h1><p class="lead">Questions about this portal, or feedback on its content? Send us a message.</p></div></section>
<section class="section"><div class="container narrow">
  <form class="form" method="post" action="<?= e(url('actions/contact_action.php')) ?>" data-validate novalidate>
    <?= csrf_field() ?>
    <?php form_field('name', 'Name', 'text', 'name', 'required maxlength="50" autocomplete="name"'); ?>
    <?php form_field('email', 'Email', 'email', 'email', 'required maxlength="100" autocomplete="email"'); ?>
    <?php form_field('phone', 'Phone number (10 digits)', 'tel', 'phone', 'required maxlength="10" inputmode="numeric" autocomplete="tel"'); ?>
    <?php form_field('message', 'Message (10 to 500 characters)', 'textarea', 'text:10:500', 'required maxlength="500"'); ?>
    <p class="counter" data-counter-for="message" data-max="500">0 / 500</p>
    <button class="btn" type="submit">Send message</button>
  </form>
  <p class="disclaimer">We cannot give medical advice. In an emergency call 112.</p>
</div></section>
<?php clear_old(); require __DIR__ . '/includes/footer.php'; ?>
