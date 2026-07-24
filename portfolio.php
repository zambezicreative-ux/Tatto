<?php
/**
 * Portfolio — full gallery grouped by style, with lightbox.
 * Images are placeholders until the optimized photos are added to assets/img/.
 */
require_once __DIR__ . '/includes/config.php';

$current_page     = 'portfolio';
$page_title       = 'Japanese Tattoo Portfolio — Dallas, TX | ' . $site['name'];
$page_description = 'Japanese-inspired tattoo work by ' . $site['artist']
    . ' in Dallas: traditional Japanese and neo/modern Japanese sleeves, koi, dragons, and custom pieces.';
$page_keywords = [
    'Japanese tattoo portfolio',
    'Japanese sleeve tattoo',
    'koi tattoo', 'dragon tattoo', 'hannya mask tattoo',
    'neo Japanese tattoo',
    'cover-up tattoo Dallas',
];

/*
 * Groups of work. Numbers map to assets/img/portfolio-NN.jpg.
 * When real photos are added the tiles become click-to-enlarge automatically.
 * Add or renumber freely as the real gallery is finalized.
 */
$groups = [
    'Traditional Japanese'  => [[1, 'Koi'], [2, 'Dragon'], [3, 'Hannya'], [4, 'Peony']],
    'Flowers & Nature'      => [[5, 'Chrysanthemum'], [6, 'Lotus'], [7, 'Phoenix'], [9, 'Cherry Blossom']],
    'Sleeves & Bodywork'    => [[8, 'Snake'], [10, 'Full Back'], [11, 'Full Sleeve'], [12, 'Chest & Shoulder']],
];
?>
<?php require __DIR__ . '/includes/header.php'; ?>

<?php
$hero_eyebrow = 'Portfolio';
$hero_title   = 'The work speaks first.';
$hero_sub     = 'From traditional compositions to thoughtful modern interpretations. Tap any piece to view it full size.';
require __DIR__ . '/includes/page-hero.php';
?>

<?php foreach ($groups as $groupName => $items): ?>
    <section class="section portfolio-section" aria-label="<?= e($groupName) ?>">
        <div class="container">
            <h2 class="portfolio-group-title reveal"><?= e($groupName) ?></h2>
            <div class="portfolio-grid">
                <?php foreach ($items as $item): ?>
                    <div class="reveal"><?= portfolio_item($item[0], $item[1], 'portfolio') ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endforeach; ?>

<!-- ===================== CTA ===================== -->
<section class="cta-band section" aria-labelledby="cta-h">
    <div class="cta-media"><?= media('assets/img/cta.jpg', 'Texture background') ?></div>
    <div class="container cta-inner reveal">
        <h2 id="cta-h" class="section-title">See something that speaks to you?</h2>
        <p>Every piece starts with a free consultation. Let’s talk about yours.</p>
        <div class="cta-actions">
            <a class="btn btn-gold" href="contact.php#book">Book a Free Consultation<span class="btn-arrow">&rarr;</span></a>
            <a class="btn btn-ghost" href="<?= e($site['social']['instagram']) ?>" target="_blank" rel="noopener">More on Instagram</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
