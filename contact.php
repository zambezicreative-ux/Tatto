<?php
/**
 * Contact — enquiry form + studio details.
 * The form posts to itself, validates server-side, guards against header
 * injection and spam (honeypot), then emails the studio via mail().
 *
 * NOTE: mail() needs a configured MTA on the host. Locally it will simply
 * report the "could not send" state — that's expected off-server.
 */
require_once __DIR__ . '/includes/config.php';

$current_page     = 'contact';
$page_title       = 'Book a Free Consultation — Dallas, TX | ' . $site['name'];
$page_description = 'Book a free consultation with ' . $site['artist'] . ' at ' . $site['name']
    . ', ' . $site['address']['street'] . ', ' . $site['address']['city'] . '. Japanese-inspired tattooing in Dallas.';
$page_keywords = [
    'book Japanese tattoo Dallas',
    'tattoo consultation Dallas',
    'tattoo shop Preston Road Dallas',
    'Higher Truth Tattoo location',
];

$status = '';           // '', 'ok', 'error', 'invalid'
$errors = [];
$old    = ['name' => '', 'email' => '', 'phone' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Honeypot: real users never fill this hidden field.
    $trap = trim($_POST['company'] ?? '');

    $old['name']    = trim($_POST['name'] ?? '');
    $old['email']   = trim($_POST['email'] ?? '');
    $old['phone']   = trim($_POST['phone'] ?? '');
    $old['message'] = trim($_POST['message'] ?? '');

    if ($old['name'] === '')                                      $errors['name']    = 'Please tell us your name.';
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL))       $errors['email']   = 'Please enter a valid email.';
    if (strlen($old['message']) < 10)                            $errors['message'] = 'A few more details, please.';

    if ($trap !== '') {
        // Silently treat spam as success so bots don't learn.
        $status = 'ok';
    } elseif ($errors) {
        $status = 'invalid';
    } else {
        // Strip CR/LF to prevent email header injection.
        $safe = static fn(string $v): string => str_replace(["\r", "\n"], ' ', $v);
        $name  = $safe($old['name']);
        $email = $safe($old['email']);
        $phone = $safe($old['phone']);

        $body = "New enquiry from the {$site['name']} website\n\n"
              . "Name:    {$name}\n"
              . "Email:   {$email}\n"
              . "Phone:   {$phone}\n\n"
              . "Message:\n{$old['message']}\n";

        $headers  = 'From: ' . $site['name'] . ' <' . $form['from'] . ">\r\n";
        $headers .= 'Reply-To: ' . $name . ' <' . $email . ">\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        $sent = function_exists('mail')
            ? @mail($form['to'], $form['subject'], $body, $headers)
            : false;

        if ($sent) {
            $status = 'ok';
            $old = ['name' => '', 'email' => '', 'phone' => '', 'message' => '']; // clear on success
        } else {
            $status = 'error';
        }
    }
}
?>
<?php require __DIR__ . '/includes/header.php'; ?>

<?php
$hero_eyebrow = 'Contact';
$hero_title   = 'Let’s start the conversation.';
$hero_sub     = 'The best tattoos begin with trust. Book a free consultation or send a question — there’s never any pressure.';
require __DIR__ . '/includes/page-hero.php';
?>

<section class="section" id="book" aria-labelledby="contact-h">
    <div class="container contact-grid">

        <!-- Form -->
        <div class="contact-form-wrap reveal">
            <h2 id="contact-h" class="section-title">Request an appointment</h2>
            <p class="contact-intro">Tell me a little about your idea and the best way to reach you. I read every message personally and will follow up to set up your free consultation.</p>

            <?php if ($status === 'ok'): ?>
                <p class="form-alert ok" role="status">Thank you — your message is on its way. I’ll be in touch soon to arrange your consultation.</p>
            <?php elseif ($status === 'error'): ?>
                <p class="form-alert error" role="alert">Sorry — something went wrong sending your message. Please call <a href="tel:<?= e($site['phone_tel']) ?>"><?= e($site['phone']) ?></a> or email <a href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a>.</p>
            <?php elseif ($status === 'invalid'): ?>
                <p class="form-alert error" role="alert">Please check the highlighted fields and try again.</p>
            <?php endif; ?>

            <form class="contact-form" method="post" action="contact.php#book" novalidate>
                <!-- Honeypot (hidden from people) -->
                <div class="hp" aria-hidden="true">
                    <label>Company <input type="text" name="company" tabindex="-1" autocomplete="off"></label>
                </div>

                <div class="field<?= isset($errors['name']) ? ' has-error' : '' ?>">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?= e($old['name']) ?>" required>
                    <?php if (isset($errors['name'])): ?><span class="field-error"><?= e($errors['name']) ?></span><?php endif; ?>
                </div>

                <div class="field-row">
                    <div class="field<?= isset($errors['email']) ? ' has-error' : '' ?>">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?= e($old['email']) ?>" required>
                        <?php if (isset($errors['email'])): ?><span class="field-error"><?= e($errors['email']) ?></span><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="phone">Phone <span class="opt">(optional)</span></label>
                        <input type="tel" id="phone" name="phone" value="<?= e($old['phone']) ?>">
                    </div>
                </div>

                <div class="field<?= isset($errors['message']) ? ' has-error' : '' ?>">
                    <label for="message">Your idea</label>
                    <textarea id="message" name="message" rows="6" required placeholder="Size, placement, subject, and anything that gives it meaning to you…"><?= e($old['message']) ?></textarea>
                    <?php if (isset($errors['message'])): ?><span class="field-error"><?= e($errors['message']) ?></span><?php endif; ?>
                </div>

                <button type="submit" class="btn btn-gold">Send Request<span class="btn-arrow">&rarr;</span></button>
                <p class="form-fineprint">By sending this you agree to be contacted about your enquiry. 18+ only.</p>
            </form>
        </div>

        <!-- Studio details -->
        <aside class="contact-info reveal">
            <h3>Visit the studio</h3>
            <ul class="contact-list">
                <li>
                    <span class="ci-label">Address</span>
                    <a href="<?= e($site['address']['maps']) ?>" target="_blank" rel="noopener">
                        <?= e($site['address']['street']) ?><br><?= e($site['address']['city']) ?>
                    </a>
                </li>
                <li><span class="ci-label">Phone</span><a href="tel:<?= e($site['phone_tel']) ?>"><?= e($site['phone']) ?></a></li>
                <li><span class="ci-label">Email</span><a href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a></li>
                <li><span class="ci-label">Instagram</span><a href="<?= e($site['social']['instagram']) ?>" target="_blank" rel="noopener">@highertruthtattoo</a></li>
            </ul>

            <h3>Hours</h3>
            <ul class="hours-list">
                <?php foreach ($site['hours'] as $day => $time): ?>
                    <li><span><?= e($day) ?></span><span><?= e($time) ?></span></li>
                <?php endforeach; ?>
            </ul>
            <p class="contact-note">Free consultation preferred &middot; Walk-ins welcome &middot; Plenty of free parking</p>
            <?php if (!empty($site['notice'])): ?>
                <p class="contact-notice"><?= e($site['notice']) ?></p>
            <?php endif; ?>
        </aside>

    </div>
</section>

<!-- ===================== MAP ===================== -->
<?php
// No-key Google Maps embed built from the studio address.
$map_q     = rawurlencode($site['address']['street'] . ', ' . $site['address']['city']);
$map_embed = 'https://maps.google.com/maps?q=' . $map_q . '&z=15&output=embed';
?>
<section class="map-section" aria-label="Studio location">
    <iframe
        title="Map to <?= e($site['name']) ?>, <?= e($site['address']['street']) ?>"
        src="<?= e($map_embed) ?>"
        width="100%" height="480" style="border:0"
        loading="lazy" referrerpolicy="no-referrer-when-downgrade"
        allowfullscreen></iframe>
    <a class="map-directions" href="<?= e($site['address']['maps']) ?>" target="_blank" rel="noopener">
        Open in Google Maps <span aria-hidden="true">&rarr;</span>
    </a>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
