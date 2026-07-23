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

/** Primary navigation. Pages other than Home are built later. */
$nav = [
    'home'      => ['label' => 'Home',      'url' => 'index.php'],
    'portfolio' => ['label' => 'Portfolio', 'url' => 'portfolio.php'],
    'about'     => ['label' => 'About',     'url' => 'about.php'],
    'faq'       => ['label' => 'FAQ',       'url' => 'faq.php'],
    'contact'   => ['label' => 'Contact',   'url' => 'contact.php'],
];

/** Escape helper for safe output. */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
