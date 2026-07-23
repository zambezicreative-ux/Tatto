<?php
/**
 * About — full story, philosophy, and the artist.
 * Content drawn verbatim-in-spirit from the questionnaire (sections 1–3, 14).
 */
require_once __DIR__ . '/includes/config.php';

$current_page     = 'about';
$page_title       = 'Mark C. Merchant — Japanese Tattoo Artist in Dallas | ' . $site['name'];
$page_description = 'Meet ' . $site['artist'] . ', a Dallas Japanese tattoo artist with more than three '
    . 'decades of experience. The story and philosophy behind Higher Truth Tattoo.';
$page_keywords = [
    'Mark Merchant tattoo artist',
    'experienced Japanese tattoo artist',
    'award-winning tattoo artist Dallas',
    'tattoo artist since 1994',
];

// Placeholder reviews — REPLACE with the 32 real Google reviews (per Carlos:
// screenshot "Mark C. Merchant Tattoo Reviews" and transcribe them here).
$review_count = 32;
$review_pool = [
    'The whole experience felt personal from the first conversation. The finished piece means more than I can put into words.',
    'Incredible attention to detail and a calm, welcoming studio. My tattoo healed perfectly and looks even better than I imagined.',
    'I brought a rough idea and it became something far beyond what I pictured. Worth every minute of the process.',
    'Thirty-plus years of skill shows in every line. Patient, professional, and genuinely invested in getting it right.',
    'You can feel the respect for the tradition in the work. A true artist — I would not go anywhere else.',
    'From consultation to aftercare, I felt guided the whole way. The trust made all the difference.',
    'Mark took the time to understand the meaning behind my idea before he ever picked up a needle.',
    'The studio is spotless and private. I never felt rushed, and the result speaks for itself.',
    'Easily the best tattoo experience I have had. Thoughtful, precise, and completely worth the wait.',
    'He turned a difficult cover-up into a piece I am proud to show off. Remarkable work.',
    'Beautiful linework and shading. You can tell he genuinely loves what he does.',
    'A calm, respectful process from start to finish. My Japanese-style piece came out stunning.',
    'Professional, welcoming, and incredibly talented. I have already booked my next session.',
    'He listens, he cares, and it shows in the artwork. Highly recommend to anyone serious about their tattoo.',
    'The consultation alone convinced me I was in the right hands. The final tattoo confirmed it.',
    'Timeless design and flawless execution. This is what real craftsmanship looks like.',
];

$reviews = [];
for ($i = 0; $i < $review_count; $i++) {
    $reviews[] = [
        'name' => 'Google review',
        'text' => $review_pool[$i % count($review_pool)],
    ];
}
?>
<?php require __DIR__ . '/includes/header.php'; ?>

<?php
$hero_eyebrow = 'About';
$hero_title   = 'A higher truth, made permanent.';
$hero_sub     = 'Japanese-inspired tattooing built on meaning, craftsmanship, and trust — in Dallas, TX.';
require __DIR__ . '/includes/page-hero.php';
?>

<!-- ===================== STORY ===================== -->
<section class="section prose-section" aria-labelledby="story-h">
    <div class="container prose-grid">
        <div class="prose-copy reveal">
            <p class="eyebrow">Our Story</p>
            <h2 id="story-h" class="section-title">It was never a career.<br>It was a calling.</h2>
            <p>Tattooing wasn’t a career choice for me — it was a calling. I’ve always followed my heart and my intuition. I was born Mark Merchant, literally a “maker of marks,” and I’ve spent my life doing exactly that.</p>
            <p>I’m inspired by creating something permanent in a temporary world. A tattoo can’t be lost, stolen, or forgotten. It becomes part of the person and serves as a daily reminder of who they are, what they’ve overcome, and who they’re becoming.</p>
            <p><?= e($site['name']) ?> is dedicated exclusively to Japanese-inspired tattooing. Every project begins with a meaningful consultation, because the relationship matters as much as the artwork. When there’s genuine trust and connection, the tattoo becomes more than an image. It becomes a timeless talisman — created with intention to represent growth, healing, protection, strength, and purpose. My goal isn’t simply to decorate the body. It’s to create a piece of art that carries meaning for a lifetime.</p>
        </div>
        <!-- IMAGE SLOT: artist / studio photo -> assets/img/artist.jpg -->
        <div class="prose-media reveal"><?= media('assets/img/artist.jpg', 'Artist photo') ?></div>
    </div>
</section>

<!-- ===================== ABOUT THE ARTIST ===================== -->
<section class="section section-dark" aria-labelledby="artist-h">
    <div class="container narrow">
        <div class="reveal">
            <p class="eyebrow">The Artist</p>
            <h2 id="artist-h" class="section-title"><?= e($site['artist']) ?></h2>
        </div>
        <div class="prose reveal">
            <p>I’ve been tattooing since August 1994. More than three decades later, I still consider myself a student. I’m largely self-taught, but countless artists, mentors, clients, and friends have shaped my journey, and I’m grateful to everyone who has helped me grow.</p>
            <p>Over the years I’ve received dozens of awards and been featured in tattoo magazines and other publications. While I’m honored by that recognition, the trust my clients place in me has always meant more than any award.</p>
            <p>My specialty is capturing the look and feel of traditional Japanese tattooing through my own artistic perspective. Just as important is the experience itself. I believe communication, compassion, and trust are essential. I’m not the right artist for everyone, but when the connection is right, the process becomes something extraordinary. I don’t rush people through an appointment — I take the journey with them, guiding, encouraging, and supporting them from our first conversation through the final session.</p>
            <p>Nature is my greatest artistic influence: flowers, koi, insects, animals, and the elements of wind, water, earth, fire, and spirit. I’m equally fascinated by the mystical world of Japanese folklore, where dragons and other legendary beings represent wisdom, strength, protection, and transformation. I have immense respect for the tradition and strive to honor its timeless beauty.</p>
            <p>What I enjoy most isn’t simply making tattoos. It’s witnessing people accomplish something they once thought was beyond them. Every large-scale tattoo demands commitment, courage, patience, and trust. My role is to be a guide, a coach, and a steady presence throughout that journey. Together we create something meaningful — and the finished tattoo becomes far more than beautiful artwork. It becomes a permanent reminder of their growth, resilience, healing, and the person they chose to become.</p>
        </div>
        <dl class="artist-facts reveal">
            <div><dt>Tattooing since</dt><dd>August 1994</dd></div>
            <div><dt>Experience</dt><dd><?= e($site['years']) ?> years</dd></div>
            <div><dt>Specialty</dt><dd>Japanese-inspired tattooing</dd></div>
            <div><dt>Instagram</dt><dd><a href="<?= e($site['social']['instagram']) ?>" target="_blank" rel="noopener">@highertruthtattoo</a></dd></div>
        </dl>
    </div>
</section>

<!-- ===================== IDEAL CLIENT ===================== -->
<section class="section" aria-labelledby="ideal-h">
    <div class="container narrow center">
        <p class="eyebrow reveal">Who I Work With</p>
        <h2 id="ideal-h" class="section-title reveal">The right connection<br>changes everything.</h2>
        <p class="lead reveal">My ideal client is someone who feels drawn to Japanese-inspired tattooing and values meaning as much as aesthetics. They trust their own intuition, appreciate timeless design over trends, and are looking for something truly original. Most importantly, they’re ready to collaborate, trust the process, and create a tattoo that becomes a powerful expression of who they are and who they’re becoming.</p>
        <a class="btn btn-gold reveal" href="contact.php#book">Book a Free Consultation<span class="btn-arrow">&rarr;</span></a>
    </div>
</section>

<!-- ===================== REVIEWS (full set) ===================== -->
<section class="section section-dark reviews" aria-labelledby="reviews-h">
    <div class="container">
        <div class="section-head reveal">
            <div>
                <p class="eyebrow">Kind Words</p>
                <h2 id="reviews-h" class="section-title">Over 80 five-star reviews.</h2>
            </div>
            <p class="reviews-trust">More than <strong>80</strong> clients have taken the time to share their experience on Google.</p>
        </div>
        <?php require __DIR__ . '/includes/reviews.php'; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
