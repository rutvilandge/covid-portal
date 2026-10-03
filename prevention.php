<?php
$pageTitle = 'Prevention'; $active = 'prevention';
require __DIR__ . '/includes/header.php';
$items = [
  ['Hand hygiene', 'Wash hands with soap and water for at least 20 seconds, or use an alcohol-based sanitiser, especially after being in public places.'],
  ['Respiratory etiquette', 'Cough or sneeze into a bent elbow or tissue, throw the tissue away, then clean your hands.'],
  ['Ventilation', 'Open windows and doors, use fans to move air out, and prefer outdoor meetings.'],
  ['Stay home when sick', 'Avoid work, school and gatherings while you have symptoms so you do not pass it on.'],
  ['Masks when appropriate', 'A well-fitting mask helps in crowded or poorly ventilated places, around high-risk people, or when advised.'],
  ['Testing awareness', 'Test if you have symptoms or have been exposed, and follow the result with the right precautions.'],
  ['Follow current guidance', 'Advice changes as the situation changes. Check your health ministry or WHO for the latest.'],
];
?>
<section class="page-hero"><div class="container"><h1>Prevention</h1><p class="lead">Layered, everyday steps protect you and the people around you.</p></div></section>
<section class="section">
  <div class="container split">
    <div><?= img('covid-prevention.svg', 'Illustration of handwashing and mask use for COVID-19 prevention', 'side-img') ?></div>
    <div><h2>No single step is perfect</h2><p>Using several measures together gives better protection than relying on one. Choose the steps that fit your situation, and use more of them when risk is higher.</p></div>
  </div>
  <div class="container"><div class="card-grid three">
    <?php foreach ($items as [$t, $d]): ?><div class="card"><h3><?= e($t) ?></h3><p><?= e($d) ?></p></div><?php endforeach; ?>
  </div></div>
</section>
<section class="section"><div class="container"><p class="disclaimer">This website is for educational and awareness purposes only and does not replace professional medical advice.</p></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
