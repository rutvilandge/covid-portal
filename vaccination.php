<?php
$pageTitle = 'Vaccination'; $active = 'vaccination';
require __DIR__ . '/includes/header.php';
$faq = [
  ['How do vaccines work?', 'They show the immune system a harmless piece or instruction of the virus so the body can recognise and respond to it faster if it meets the real virus.'],
  ['Why are vaccination programmes used?', 'Health authorities use them to lower the number of severe illnesses and hospital admissions and to protect communities, including people who cannot be vaccinated.'],
  ['Can vaccinated people still get COVID-19?', 'Yes, infection is still possible. Vaccination is mainly aimed at reducing the risk of severe illness.'],
  ['Are there side effects?', 'Mild, short-lived effects such as a sore arm, tiredness or low fever are common. Serious reactions are rare. Talk to a health professional about your own situation.'],
  ['Where do I find the current schedule?', 'Check your national health ministry, the CoWIN portal for India, or the WHO. Recommendations are updated over time.'],
];
?>
<section class="page-hero"><div class="container"><h1>Vaccination</h1><p class="lead">General information to help you ask better questions of your doctor.</p></div></section>
<section class="section">
  <div class="container split">
    <div>
      <h2>Why it matters</h2>
      <p>Vaccines are one of several tools against COVID-19, alongside hygiene, ventilation and testing. Follow the advice of official health authorities for who should be vaccinated and when.</p>
      <p>This page gives general education only. It does not give medical advice for individual people.</p>
    </div>
    <div><?= img('vaccination.svg', 'Illustration of a vaccine vial and syringe', 'side-img') ?></div>
  </div>
</section>
<section class="section section-tint">
  <div class="container">
    <h2>Frequently asked questions</h2>
    <div class="faq">
      <?php foreach ($faq as [$q, $a]): ?>
        <details><summary><?= e($q) ?></summary><p><?= e($a) ?></p></details>
      <?php endforeach; ?>
    </div>
    <p class="disclaimer">This website is for educational and awareness purposes only and does not replace professional medical advice.</p>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
