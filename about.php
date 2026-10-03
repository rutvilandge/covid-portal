<?php
$pageTitle = 'About COVID-19'; $active = 'about';
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero"><div class="container"><h1>About COVID-19</h1><p class="lead">What it is, how it spreads and why awareness matters.</p></div></section>
<section class="section">
  <div class="container split">
    <div>
      <h2>What is COVID-19?</h2>
      <p>COVID-19 (coronavirus disease 2019) is caused by the SARS-CoV-2 virus. It was first identified in late 2019 and was declared a pandemic by the World Health Organization in March 2020. The virus mainly affects the respiratory system, but it can affect other parts of the body.</p>
      <h2>How does it spread?</h2>
      <ul class="plain-list">
        <li>Breathing in air that contains virus particles from an infected person.</li>
        <li>Droplets landing on the eyes, nose or mouth during close contact.</li>
        <li>Less commonly, touching a contaminated surface and then the face.</li>
        <li>Spread is easier in crowded, closed or poorly ventilated places.</li>
      </ul>
    </div>
    <div><?= img('covid-awareness.svg', 'Illustration of people practising COVID-19 awareness', 'side-img') ?></div>
  </div>
</section>
<section class="section section-tint">
  <div class="container split split-reverse">
    <div>
      <h2>Why awareness is important</h2>
      <p>People can spread the virus before they feel unwell, and some never develop symptoms. Public awareness helps communities spot illness early, reduce spread and protect those at higher risk, such as older adults, pregnant people and people with chronic conditions.</p>
      <h2>Basic safety information</h2>
      <p>Wash hands often, improve airflow indoors, stay home when sick, and follow guidance from your health authority. See the <a href="<?= e(url('prevention.php')) ?>">prevention guide</a> for details.</p>
    </div>
    <div><?= img('health-safety.svg', 'Health and safety shield illustration', 'side-img') ?></div>
  </div>
</section>
<section class="section"><div class="container"><p class="disclaimer">This website is for educational and awareness purposes only and does not replace professional medical advice.</p></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
