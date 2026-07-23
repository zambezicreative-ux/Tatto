<?php
/**
 * Higher Truth Tattoo — Homepage
 * Content adapted from the client questionnaire (Q&A).
 * Image slots are placeholders per Carlos: real photos (hero, portfolio,
 * studio, artist) come from the Google Drive folder later.
 */
require_once __DIR__ . '/includes/config.php';

$current_page     = 'home';
$page_title       = $site['name'] . ' — Japanese-Inspired Tattoos in Dallas, TX';
$page_description = 'Art that carries meaning for a lifetime. Custom, Japanese-inspired tattooing by '
    . $site['artist'] . ' — a private Dallas studio. Book your free consultation.';
$page_keywords = [
    'best tattoo artist Dallas',
    'traditional Japanese tattoo',
    'Irezumi Dallas',
    'free tattoo consultation Dallas',
    'koi tattoo', 'dragon tattoo',
];

/* ---- Content pulled from the questionnaire ---- */

$features = [
    ['icon' => 'gem',    'title' => 'Meaning First',      'text' => 'Every design is created with intention — to represent growth, healing, protection, and purpose.'],
    ['icon' => 'lock',   'title' => 'Private Studio',     'text' => 'A calm, one-on-one space. Consultations and appointments preferred, walk-ins welcome.'],
    ['icon' => 'crown',  'title' => '32 Years of Craft',  'text' => 'More than three decades of experience, dozens of awards, and a lifelong devotion to the art.'],
    ['icon' => 'lotus',  'title' => 'Aftercare Guidance', 'text' => 'Personal support through healing, so your tattoo settles and lasts exactly as intended.'],
];

$steps = [
    ['no' => '01', 'title' => 'Consultation', 'text' => 'A free conversation about your idea, your story, and the design — no pressure, no rush.'],
    ['no' => '02', 'title' => 'Design',       'text' => 'A custom piece drawn for you alone, refined until it feels right.'],
    ['no' => '03', 'title' => 'Session',      'text' => 'Precise, patient tattooing in a comfortable, private setting.'],
    ['no' => '04', 'title' => 'Aftercare',    'text' => 'Guidance and support through healing, long after the final session.'],
];

// Placeholder motifs for the portfolio teaser (traditional Japanese subjects).
$portfolio = ['Koi', 'Dragon', 'Hannya', 'Peony', 'Tiger', 'Wind & Water', 'Snake'];

/*
 * Placeholder testimonials — REPLACE with real Google reviews.
 * Plan (per Carlos): screenshot "Mark C. Merchant Tattoo Reviews" and
 * transcribe ~12 for the homepage carousel, 32 for the About page.
 */
$reviews = [
    ['name' => 'Client review',  'text' => 'The whole experience felt personal from the first conversation. Mark listened, and the finished piece means more than I can put into words.'],
    ['name' => 'Client review',  'text' => 'Incredible attention to detail and a calm, welcoming studio. My tattoo healed perfectly and looks even better than I imagined.'],
    ['name' => 'Client review',  'text' => 'I brought a rough idea and Mark turned it into something far beyond what I pictured. Worth every minute of the process.'],
    ['name' => 'Client review',  'text' => 'Thirty-plus years of skill shows in every line. Professional, patient, and genuinely invested in getting it right.'],
    ['name' => 'Client review',  'text' => 'You can feel the respect for the tradition in the work. A true artist — I would not go anywhere else.'],
    ['name' => 'Client review',  'text' => 'From consultation to aftercare, I felt guided the whole way. The trust made all the difference.'],
];
?>
<?php require __DIR__ . '/includes/header.php'; ?>

<!-- ============================= HERO ============================= -->
<section class="hero" id="hero">
    <!-- IMAGE SLOT: hero tattoo photo (from Drive) -> assets/img/hero.jpg -->
    <div class="hero-media"><?= media('assets/img/hero.jpg', 'Hero tattoo photo') ?></div>
    <div class="hero-overlay"></div>

    <div class="container hero-inner">
        <div class="hero-copy">
            <p class="eyebrow reveal">Bespoke &middot; Japanese-Inspired</p>
            <h1 class="hero-title reveal">Art That<br>Lasts Forever</h1>
            <p class="hero-sub reveal">Custom, Japanese-inspired tattoos created with meaning.<br>Your story, made permanent.</p>
            <div class="hero-actions reveal">
                <a class="btn btn-gold" href="contact.php#book">Book a Free Consultation<span class="btn-arrow">&rarr;</span></a>
                <a class="btn btn-ghost" href="portfolio.php">View the Portfolio</a>
            </div>
            <ul class="hero-social reveal" aria-label="Social media">
                <li><a href="<?= e($site['social']['instagram']) ?>" target="_blank" rel="noopener">Instagram</a></li>
                <li><a href="<?= e($site['social']['facebook']) ?>" target="_blank" rel="noopener">Facebook</a></li>
                <li><a href="<?= e($site['social']['tiktok']) ?>" target="_blank" rel="noopener">TikTok</a></li>
            </ul>
        </div>
    </div>

    <!-- Single, respectful Japanese accent: 芸術は永遠に残る = "art remains forever" -->
    <span class="hero-kanji" aria-hidden="true" lang="ja">芸術は永遠に残る</span>
    <span class="hero-scroll" aria-hidden="true">Scroll</span>
</section>

<!-- ============================= WELCOME / INTRO ============================= -->
<section class="welcome section" aria-labelledby="welcome-h">
    <div class="container welcome-grid">
        <div class="welcome-copy reveal">
            <p class="eyebrow">Welcome to <?= e($site['short']) ?></p>
            <h2 id="welcome-h" class="section-title">Permanent art in a<br>temporary world.</h2>
            <p class="lead">A tattoo can’t be lost, stolen, or forgotten. It becomes part of you — a daily reminder of who you are, what you’ve overcome, and who you’re becoming.</p>
            <p>Every project begins with a meaningful consultation, because the relationship matters as much as the artwork. When the connection is right, the tattoo becomes more than an image. It becomes a timeless piece, created with intention.</p>
            <a class="btn btn-outline" href="about.php">About the Studio</a>
        </div>
        <!-- IMAGE SLOT: studio interior photo -> assets/img/studio.jpg -->
        <div class="welcome-media reveal"><?= media('assets/img/studio.jpg', 'Studio interior photo') ?></div>
    </div>
</section>

<!-- ============================= PORTFOLIO TEASER ============================= -->
<section class="work section section-dark" aria-labelledby="work-h">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <p class="eyebrow">Our Work</p>
                <h2 id="work-h" class="section-title">Selected Work.</h2>
            </div>
            <a class="link-arrow" href="portfolio.php">View Full Portfolio <span>&rarr;</span></a>
        </div>
    </div>

    <div class="carousel" data-carousel="portfolio">
        <button class="carousel-btn prev" data-dir="prev" aria-label="Previous work">&larr;</button>
        <div class="carousel-track" data-track>
            <?php foreach ($portfolio as $i => $piece): ?>
                <?= portfolio_item($i + 1, $piece) ?>
            <?php endforeach; ?>
        </div>
        <button class="carousel-btn next" data-dir="next" aria-label="Next work">&rarr;</button>
    </div>
</section>

<!-- ============================= FEATURE GRID ============================= -->
<section class="features section" aria-label="Why work with us">
    <div class="container feature-grid">
        <?php foreach ($features as $f): ?>
            <div class="feature reveal">
                <span class="feature-icon" aria-hidden="true" data-icon="<?= e($f['icon']) ?>"></span>
                <h3><?= e($f['title']) ?></h3>
                <p><?= e($f['text']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ============================= PROCESS ============================= -->
<!-- Per Carlos: original "From concept to legacy" CTA removed. -->
<section class="process section section-dark" aria-labelledby="process-h">
    <div class="container process-grid">
        <div class="process-intro reveal">
            <p class="eyebrow">The Process</p>
            <h2 id="process-h" class="section-title">It starts with a<br>conversation.</h2>
            <p>Great work begins long before the needle. Your free consultation is where we talk through your idea and your story — so everything is clear before we begin. No pressure. No rush.</p>
        </div>
        <ol class="steps">
            <?php foreach ($steps as $s): ?>
                <li class="step reveal">
                    <span class="step-no"><?= e($s['no']) ?></span>
                    <h3><?= e($s['title']) ?></h3>
                    <p><?= e($s['text']) ?></p>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>

<!-- ============================= MEET THE ARTIST ============================= -->
<section class="artist section" aria-labelledby="artist-h">
    <div class="artist-grid">
        <!-- IMAGE SLOT: artist working / portrait photo -> assets/img/artist.jpg -->
        <div class="artist-media reveal"><?= media('assets/img/artist.jpg', 'Artist photo') ?></div>
        <div class="artist-copy reveal">
            <p class="eyebrow">Meet Your Artist</p>
            <h2 id="artist-h" class="section-title">Crafted by passion.<br>Driven by detail.</h2>
            <p class="lead">I’ve been tattooing since <?= e($site['est']) ?>, and more than thirty years later I still consider myself a student.</p>
            <p>My specialty is capturing the look and feel of traditional Japanese tattooing through my own perspective — but the experience matters just as much as the art. I don’t rush anyone. I take the journey with you, from our first conversation to the final session.</p>
            <p class="artist-sign">— <?= e($site['artist']) ?></p>
            <a class="btn btn-outline" href="about.php">Read Mark’s Story</a>
        </div>
    </div>
</section>

<!-- ============================= REVIEWS ============================= -->
<section class="reviews section section-dark" aria-labelledby="reviews-h">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <p class="eyebrow">Kind Words</p>
                <h2 id="reviews-h" class="section-title">Trusted by over 80 clients.</h2>
            </div>
            <p class="reviews-trust"><strong><?= e($site['years']) ?> Years</strong> &middot; <strong>80+ Five-Star Reviews</strong> &middot; <strong>Award-Winning</strong></p>
        </div>

        <?php require __DIR__ . '/includes/reviews.php'; ?>
    </div>
</section>

<!-- ============================= FINAL CTA ============================= -->
<section class="cta-band section" aria-labelledby="cta-h">
    <!-- IMAGE SLOT: subtle tattoo texture background -> assets/img/cta.jpg -->
    <div class="cta-media"><?= media('assets/img/cta.jpg', 'Texture background') ?></div>
    <div class="container cta-inner reveal">
        <h2 id="cta-h" class="section-title">Ready to create<br>something that lasts?</h2>
        <p>The best tattoos start with trust. Let’s talk about yours.</p>
        <div class="cta-actions">
            <a class="btn btn-gold" href="contact.php#book">Book a Free Consultation<span class="btn-arrow">&rarr;</span></a>
            <a class="btn btn-ghost" href="contact.php">Ask a Question</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
