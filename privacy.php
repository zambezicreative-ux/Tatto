<?php
/**
 * Privacy Policy. Plain-language, specific to what this site actually does
 * (contact form + embedded Google Map). Review with the client/counsel before
 * relying on it.
 */
require_once __DIR__ . '/includes/config.php';

$current_page     = 'privacy';
$page_title       = 'Privacy Policy — ' . $site['name'];
$page_description = 'How ' . $site['name'] . ' collects, uses, and protects the information you share through this website.';
$page_keywords    = []; // not a keyword-target page

$updated = 'July 2026';
?>
<?php require __DIR__ . '/includes/header.php'; ?>

<?php
$hero_eyebrow = 'Legal';
$hero_title   = 'Privacy Policy';
$hero_sub     = 'What we collect, why, and how we look after it.';
require __DIR__ . '/includes/page-hero.php';
?>

<section class="section" aria-labelledby="privacy-h">
    <div class="container narrow legal">
        <h2 id="privacy-h" class="sr-only">Privacy Policy</h2>
        <p class="legal-updated">Last updated: <?= e($updated) ?></p>

        <p>This Privacy Policy explains how <strong>Higher Truth Tattoo Inc.</strong> (“we,” “us,” or “our”) handles information collected through this website. We keep this simple: we only ask for what we need to respond to you, and we don’t sell your information.</p>

        <h3>Information we collect</h3>
        <p>When you use our contact form, we collect the details you choose to provide — your <strong>name, email address, phone number (optional), and your message</strong>. We don’t require an account, and we don’t ask for sensitive information through this site.</p>

        <h3>How we use it</h3>
        <ul class="legal-list">
            <li>To respond to your enquiry and arrange your free consultation or appointment.</li>
            <li>To communicate with you about your request.</li>
        </ul>
        <p>We use your information only for these purposes. We do not sell, rent, or trade it.</p>

        <h3>How your message reaches us</h3>
        <p>Contact-form submissions are delivered to us by email through our website host. Standard email is not perfectly secure, so please don’t send confidential information through the form.</p>

        <h3>Third-party services</h3>
        <p>Some pages include a <strong>Google Maps</strong> embed so you can find the studio. When a map loads, Google may receive your IP address and set cookies in line with its own privacy policy. We don’t control Google’s practices; see <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Google’s Privacy Policy</a> for details. Our reviews are displayed as text and are shown publicly on Google.</p>

        <h3>Cookies &amp; analytics</h3>
        <p>This website does not set its own tracking cookies. If we add analytics in the future, we’ll update this policy first.</p>

        <h3>Keeping your information</h3>
        <p>We keep enquiry messages only as long as needed to help you, then remove them. You can ask us to delete your information at any time.</p>

        <h3>Your choices</h3>
        <p>You may ask us to access, correct, or delete the information you’ve shared with us. Just get in touch using the details below.</p>

        <h3>Age</h3>
        <p>This site and our services are intended for adults <strong>18 and older</strong>. We don’t knowingly collect information from anyone under 18.</p>

        <h3>Changes</h3>
        <p>We may update this policy from time to time. The “last updated” date above shows when it last changed.</p>

        <h3>Contact us</h3>
        <p>Questions about your privacy? Reach us at
            <a href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a>
            or <a href="tel:<?= e($site['phone_tel']) ?>"><?= e($site['phone']) ?></a>.<br>
            <?= e($site['name']) ?>, <?= e($site['address']['street']) ?>, <?= e($site['address']['city']) ?>.</p>

        <p class="legal-disclaimer">This policy is provided as a starting point and isn’t legal advice. Please review it with the studio and, if needed, a professional before publishing.</p>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
