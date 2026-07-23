<?php
/**
 * Global site configuration.
 * Single source of truth for business info so the header, footer,
 * and every page pull from the same place. Update values here only.
 *
 * NOTE: contact details flagged (*) are placeholders pending client
 * confirmation (see project audit). Do not publish until verified.
 */

$site = [
    'name'      => 'Higher Truth Tattoo',
    'short'     => 'Higher Truth',
    'tagline'   => 'Japanese-Inspired Tattooing',
    'artist'    => 'Mark C. Merchant',
    'est'       => '1994',
    'years'     => '32',

    // Contact — verify before launch (*)
    'phone'     => '469-203-5033',
    'phone_tel' => '+14692035033',
    'email'     => 'hello@highertruthtattoo.com', // * placeholder address
    'domain'    => 'highertruthtattoo.com',

    'address' => [
        'street' => '17370 Preston Rd, Suite 510',
        'city'   => 'Dallas, TX 75252',
        'maps'   => 'https://maps.google.com/?q=17370+Preston+Rd+Suite+510+Dallas+TX+75252',
    ],

    // Mon–Sat 10–6, closed Sunday (* confirm per-day hours)
    'hours' => [
        'Mon – Sat' => '10:00 AM – 6:00 PM',
        'Sunday'    => 'Closed',
    ],

    'social' => [
        'instagram' => 'https://instagram.com/highertruthtattoo',
        'facebook'  => '#', // * confirm if a page exists
        'tiktok'    => '#', // * confirm if a page exists
    ],
];

/** Primary navigation. */
$nav = [
    'home'      => ['label' => 'Home',      'url' => 'index.php'],
    'portfolio' => ['label' => 'Portfolio', 'url' => 'portfolio.php'],
    'about'     => ['label' => 'About',     'url' => 'about.php'],
    'faq'       => ['label' => 'FAQ',       'url' => 'faq.php'],
    'contact'   => ['label' => 'Contact',   'url' => 'contact.php'],
];

/** Contact-form delivery. Set a real, domain-matching From address before launch. */
$form = [
    'to'      => $site['email'],                 // where enquiries are delivered
    'from'    => 'no-reply@' . $site['domain'],  // * must be a domain you control (SPF/DKIM)
    'subject' => 'New enquiry from ' . $site['name'] . ' website',
];

/** Escape helper for safe output. */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/**
 * Output a real <img> when the file exists, otherwise a labeled placeholder.
 * Drop optimized photos into assets/img/ using the names in assets/img/README.md
 * and they light up automatically — no markup changes needed.
 *
 * $rel   Path relative to site root, e.g. 'assets/img/hero.jpg'
 * $label Placeholder caption shown until the real photo lands
 * $opts  ['class' => '', 'alt' => '', 'lazy' => true]
 */
function media(string $rel, string $label, array $opts = []): string
{
    $abs   = __DIR__ . '/../' . ltrim($rel, '/');
    $class = trim('cover-img ' . ($opts['class'] ?? ''));
    $alt   = $opts['alt'] ?? $label;
    $lazy  = ($opts['lazy'] ?? true) ? ' loading="lazy" decoding="async"' : '';

    if (is_file($abs)) {
        return sprintf('<img src="%s" alt="%s" class="%s"%s>', e($rel), e($alt), e($class), $lazy);
    }
    return sprintf('<div class="media-ph %s" data-label="%s"></div>', e($opts['class'] ?? ''), e($label));
}

/**
 * A single portfolio tile. Renders a lightbox-enabled photo when the file
 * exists, otherwise a labeled placeholder. Shared by home + portfolio pages.
 */
function portfolio_item(int $n, string $label, string $group = 'portfolio'): string
{
    global $site;
    $img = sprintf('assets/img/portfolio-%02d.jpg', $n);
    $abs = __DIR__ . '/../' . $img;

    if (is_file($abs)) {
        return sprintf(
            '<a class="work-card has-img" href="%1$s" data-lightbox="%2$s" data-caption="%3$s">'
          . '<img class="work-thumb" src="%1$s" alt="%3$s tattoo by %4$s" loading="lazy" decoding="async">'
          . '<figcaption>%3$s</figcaption></a>',
            e($img), e($group), e($label), e($site['artist'])
        );
    }
    return sprintf(
        '<figure class="work-card media-ph" data-label="%1$s"><figcaption>%1$s</figcaption></figure>',
        e($label)
    );
}

