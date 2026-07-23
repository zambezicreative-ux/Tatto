<?php
/**
 * FAQ — answers drawn from the questionnaire (section 15 + booking/hours/services).
 */
require_once __DIR__ . '/includes/config.php';

$current_page     = 'faq';
$page_title       = 'Tattoo FAQ — Dallas, TX | ' . $site['name'];
$page_description = 'Common questions about booking, pricing, deposits, aftercare, hours, and payment at '
    . $site['name'] . ', a Japanese tattoo studio in Dallas, TX.';
$page_keywords = [
    'how much does a Japanese tattoo cost',
    'tattoo consultation Dallas',
    'walk-in tattoo Dallas',
    'tattoo aftercare',
    'tattoo deposit',
];

$faqs = [
    ['Do you take walk-ins?',
     'Yes. Walk-ins are welcome whenever the schedule allows — but appointments, and a free consultation first, are always preferred so your piece gets the attention it deserves.'],

    ['How much does a tattoo cost?',
     'Every tattoo is custom, so the price depends on size, detail, and placement. Your free consultation covers all of it, so you’ll have a clear understanding before anything is booked.'],

    ['Do you require a deposit?',
     'Deposits are discussed during your free consultation. Everything is made clear up front — no surprises.'],

    ['What should I do before my appointment?',
     'We’ll walk through everything specific to your piece during your consultation. As a rule: rest well, eat beforehand, stay hydrated, and avoid alcohol the day before.'],

    ['How do I care for my new tattoo?',
     'You’ll receive personal aftercare guidance tailored to your tattoo, and I’m available for questions throughout the healing process.'],

    ['Can I bring a friend?',
     'Absolutely. A calm, supportive presence is welcome — just let me know in advance so we can keep the space comfortable.'],

    ['Do you tattoo minors?',
     'No. We tattoo adults 18 and over only, with valid government-issued ID.'],

    ['What payment methods do you accept?',
     'Cash, debit, and credit.'],

    ['What styles do you specialize in?',
     'Japanese-inspired tattooing — both traditional Japanese and neo/modern Japanese — along with custom designs, cover-ups, rework, continuations, and touch-ups.'],

    ['Do you offer any discounts?',
     'Yes. I’m proud to offer a discount for military, teachers, nurses, EMTs, and firefighters, plus referral discounts. Thank you for your service.'],

    ['Where are you located and is there parking?',
     $site['address']['street'] . ', ' . $site['address']['city'] . '. There’s plenty of free parking, near La Hacienda Ranch and Hidden Gym.'],

    ['What are your hours?',
     'Monday through Saturday, 10:00 AM – 6:00 PM. Closed Sunday.'],
];
?>
<?php require __DIR__ . '/includes/header.php'; ?>

<?php
$hero_eyebrow = 'FAQ';
$hero_title   = 'Good to know.';
$hero_sub     = 'The questions we hear most. Anything else, the free consultation covers it.';
require __DIR__ . '/includes/page-hero.php';
?>

<section class="section" aria-labelledby="faq-h">
    <div class="container narrow">
        <h2 id="faq-h" class="sr-only">Frequently asked questions</h2>
        <div class="faq-list">
            <?php foreach ($faqs as $i => $faq): ?>
                <details class="faq-item reveal"<?= $i === 0 ? ' open' : '' ?>>
                    <summary>
                        <span><?= e($faq[0]) ?></span>
                        <span class="faq-icon" aria-hidden="true"></span>
                    </summary>
                    <div class="faq-answer"><p><?= e($faq[1]) ?></p></div>
                </details>
            <?php endforeach; ?>
        </div>

        <div class="faq-cta reveal">
            <h3>Still have a question?</h3>
            <p>Reach out any time — there’s never any pressure, and the consultation is free.</p>
            <div class="cta-actions">
                <a class="btn btn-gold" href="contact.php#book">Book a Free Consultation<span class="btn-arrow">&rarr;</span></a>
                <a class="btn btn-outline" href="tel:<?= e($site['phone_tel']) ?>">Call <?= e($site['phone']) ?></a>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
