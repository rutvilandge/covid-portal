<?php
$pageTitle = 'Symptoms'; $active = 'symptoms';
require __DIR__ . '/includes/header.php';
$symptoms = [
  ['Fever or chills', 'A raised body temperature, sometimes with shivering.'],
  ['Cough', 'Usually dry, but may bring up phlegm. Can last for weeks.'],
  ['Fatigue', 'Unusual tiredness or body aches that make daily tasks harder.'],
  ['Sore throat', 'Pain or scratchiness, often with a runny or blocked nose.'],
  ['Difficulty breathing', 'Shortness of breath at rest or with light activity needs prompt attention.'],
  ['Loss of taste or smell', 'A sudden change in taste or smell, with or without other symptoms.'],
  ['Headache', 'Often along with muscle or body aches.'],
  ['Digestive symptoms', 'Nausea, vomiting or diarrhoea can occur in some people.'],
];
?>
<section class="page-hero"><div class="container"><h1>Symptoms of COVID-19</h1><p class="lead">Symptoms range from none at all to severe illness. They usually appear 2 to 14 days after exposure.</p></div></section>
<section class="section">
  <div class="container split">
    <div><?= img('covid-symptoms.svg', 'Illustration of a person with common COVID-19 symptoms such as fever and cough', 'side-img') ?></div>
    <div>
      <h2>Common symptoms</h2>
      <p>Not everyone has the same symptoms, and symptoms can overlap with flu and common colds. A test is the only way to know for sure.</p>
    </div>
  </div>
  <div class="container"><div class="card-grid four">
    <?php foreach ($symptoms as [$t, $d]): ?><div class="card"><h3><?= e($t) ?></h3><p><?= e($d) ?></p></div><?php endforeach; ?>
  </div></div>
</section>
<section class="section section-tint" id="emergency">
  <div class="container">
    <h2>When to seek medical attention</h2>
    <div class="callout callout-danger">
      <p><strong>Get emergency care right away (India: call 112) if someone has:</strong></p>
      <ul>
        <li>Trouble breathing or very fast breathing</li>
        <li>Chest pain or pressure that does not go away</li>
        <li>New confusion, or being unable to wake or stay awake</li>
        <li>Pale, grey or blue-coloured skin, lips or nails</li>
      </ul>
    </div>
    <p>If symptoms are mild, rest, drink fluids, avoid contact with others and contact a doctor if you are at higher risk or feel worse.</p>
    <p class="disclaimer">This website is for educational and awareness purposes only and does not replace professional medical advice.</p>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
