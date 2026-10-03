<?php
$pageTitle = 'Home'; $active = 'home';
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <div class="container hero-grid">
    <div class="hero-copy">
      <h1>COVID-19 Information &amp; Awareness Portal</h1>
      <p class="lead">Reliable information, prevention guidelines and community awareness.</p>
      <div class="btn-row">
        <a class="btn" href="<?= e(url('about.php')) ?>">Learn About COVID-19</a>
        <a class="btn btn-light" href="<?= e(url('prevention.php')) ?>">Prevention Guidelines</a>
      </div>
    </div>
    <div class="hero-art"><?= img('covid-hero.svg', 'COVID-19 awareness and healthcare illustration showing a virus particle, a face mask and a shield', 'hero-img') ?></div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2>Start here</h2>
    <div class="card-grid four">
      <a class="card card-link" href="<?= e(url('symptoms.php')) ?>"><h3>Symptoms</h3><p>Know the common signs and when to get care.</p></a>
      <a class="card card-link" href="<?= e(url('prevention.php')) ?>"><h3>Prevention</h3><p>Everyday steps that lower the risk of spreading infection.</p></a>
      <a class="card card-link" href="<?= e(url('vaccination.php')) ?>"><h3>Vaccination</h3><p>General facts and why to follow official guidance.</p></a>
      <a class="card card-link card-alert" href="<?= e(url('symptoms.php#emergency')) ?>"><h3>Emergency guidance</h3><p>Warning signs that need urgent medical help.</p></a>
    </div>
  </div>
</section>

<section class="section section-tint">
  <div class="container split">
    <div><?= img('covid-awareness.svg', 'Illustration of people practising COVID-19 awareness', 'side-img') ?></div>
    <div>
      <h2>What is COVID-19?</h2>
      <p>COVID-19 is an infectious disease caused by the SARS-CoV-2 virus. It mainly spreads when an infected person breathes out small droplets and particles while talking, coughing, sneezing or breathing, and others breathe them in or they land on the eyes, nose or mouth.</p>
      <p>Spread is more likely in crowded, closed and poorly ventilated spaces. Many infections are mild, but some people become seriously ill, especially older adults and people with certain health conditions.</p>
      <p><strong>Why prevention matters:</strong> simple habits protect you and the people around you, including those who are more vulnerable.</p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2>Common symptoms</h2>
    <ul class="chip-list">
      <li>Fever or chills</li><li>Cough</li><li>Fatigue</li><li>Sore throat</li>
      <li>Difficulty breathing</li><li>Loss of taste or smell</li>
    </ul>
    <p><a href="<?= e(url('symptoms.php')) ?>">See the full symptoms guide</a></p>
  </div>
</section>

<section class="section section-tint">
  <div class="container">
    <h2>Prevention at a glance</h2>
    <div class="card-grid five">
      <div class="card"><h3>Hand hygiene</h3><p>Wash with soap and water, or use an alcohol-based sanitiser.</p></div>
      <div class="card"><h3>Masks</h3><p>Wear a well-fitting mask where guidance or risk calls for it.</p></div>
      <div class="card"><h3>Ventilation</h3><p>Open windows and doors; meet outdoors when possible.</p></div>
      <div class="card"><h3>Stay home when sick</h3><p>Avoid exposing others while you have symptoms.</p></div>
      <div class="card"><h3>Follow guidance</h3><p>Check advice from your health ministry or the WHO.</p></div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container split split-reverse">
    <div>
      <h2>Vaccination</h2>
      <p>Vaccines train the immune system to recognise the virus so the body can respond faster. Health authorities recommend vaccines because they lower the chance of severe illness. Eligibility and schedules change, so always follow current advice from official health authorities and your doctor.</p>
      <p><a class="btn btn-outline" href="<?= e(url('vaccination.php')) ?>">Read vaccination basics</a></p>
    </div>
    <div><?= img('vaccination.svg', 'Illustration of a vaccine vial and syringe', 'side-img') ?></div>
  </div>
</section>

<section class="section section-tint">
  <div class="container">
    <h2>COVID-19 statistics</h2>
    <p>This portal does not show live case counts. Our statistics page contains clearly labelled sample data for demonstration, plus real counters from this portal's own database.</p>
    <p><a href="<?= e(url('statistics.php')) ?>">Go to statistics</a></p>
  </div>
</section>

<section class="section cta-band">
  <div class="container cta-inner">
    <div>
      <h2>Join the conversation</h2>
      <p>Create a free account to share comments and questions with the community.</p>
    </div>
    <div class="btn-row">
      <?php if (is_logged_in()): ?>
        <a class="btn btn-light" href="<?= e(url('comments.php')) ?>">Add a comment</a>
      <?php else: ?>
        <a class="btn btn-light" href="<?= e(url('register.php')) ?>">Create an account</a>
        <a class="btn btn-ghost" href="<?= e(url('comments.php')) ?>">Read comments</a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
