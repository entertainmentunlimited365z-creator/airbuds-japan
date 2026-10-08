<?php
<!-- Privacy-friendly analytics by Plausible -->
<script async src="https://plausible.io/js/pa-x-ywMIfJeYUkdPJSPuEcS.js"></script>
<script>
  window.plausible=window.plausible||function(){(plausible.q=plausible.q||[]).push(arguments)},plausible.init=plausible.init||function(i){plausible.o=i||{}};
  plausible.init()
</script>

require_once __DIR__ . '/includes/catalog.php';
$meta = page_meta('iPhone Deals | New and refurbished iPhones');
require __DIR__ . '/includes/header.php';
?>
<section class="hero"><div class="hero-copy"><p class="eyebrow">THOUGHTFUL TECH. BETTER VALUE.</p><h1>Find your next iPhone.</h1><p>Compare new and refurbished iPhones, with clear prices and options for every budget.</p><div class="hero-actions"><a class="button button-dark" href="/deals.php">Shop current deals</a><a class="button button-light" href="/refurbished-iphones.php">Explore refurbished</a></div></div><div class="hero-art" aria-hidden="true"><div class="hero-phone"></div></div></section>
<section class="promo-strip"><strong>Good phones. Better deals.</strong><span>Save on new and refurbished iPhone models.</span></section>
<section class="wrap"><div class="section-heading"><div><p class="eyebrow">SHOP THE COLLECTION</p><h2>Popular iPhones</h2></div><a href="/deals.php">View all deals →</a></div><?php product_grid(array_slice(array_values(products()), 0, 8)); ?></section>
<section class="wrap"><div class="trust-row"><div class="trust-card"><b>Clear pricing</b><p>See the price and savings before you add a phone to your bag.</p></div><div class="trust-card"><b>New and refurbished</b><p>Explore options across recent and previous iPhone models.</p></div><div class="trust-card"><b>Compare models</b><p>Choose the storage and model that fits your needs.</p></div><div class="trust-card"><b>Need help?</b><p><a href="/contact.php">Contact our team</a> with your questions.</p></div></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
