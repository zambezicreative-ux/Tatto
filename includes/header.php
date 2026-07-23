<?php
/**
 * Global site header (reusable).
 * Include after setting optional: $current_page, $page_title, $page_description.
 */
require_once __DIR__ . '/config.php';

$current_page      = $current_page      ?? '';
$page_title        = $page_title        ?? $site['name'] . ' — ' . $site['tagline'];
$page_description  = $page_description  ?? 'Custom, Japanese-inspired tattoos created with meaning by ' . $site['artist'] . '. A private studio in Dallas, TX. Book a free consultation.';
$page_type         = $page_type         ?? 'website';
$page_image        = $page_image        ?? $site['og_image'];

// Merge shared + page-specific keywords, de-duplicated (case-insensitive).
$page_keywords = $page_keywords ?? [];
$all_keywords  = array_merge($site_keywords ?? [], $page_keywords);
$seen = [];
$all_keywords = array_filter($all_keywords, static function ($kw) use (&$seen) {
    $k = strtolower(trim($kw));
    if ($k === '' || isset($seen[$k])) return false;
    $seen[$k] = true;
    return true;
});
$keywords_str = implode(', ', $all_keywords);

// Absolute URLs (built from the current host so they work on any domain).
$scheme      = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (int) ($_SERVER['SERVER_PORT'] ?? 0) === 443 ? 'https' : 'http';
$base_url    = $scheme . '://' . ($_SERVER['HTTP_HOST'] ?? $site['domain']);
$canonical   = $base_url . strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
$image_url   = $base_url . '/' . ltrim($page_image, '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page_title) ?></title>
    <meta name="description" content="<?= e($page_description) ?>">
    <?php if ($keywords_str !== ''): ?>
    <meta name="keywords" content="<?= e($keywords_str) ?>">
    <?php endif; ?>
    <link rel="canonical" href="<?= e($canonical) ?>">

    <?php if (!empty($site['indexable'])): ?>
    <meta name="robots" content="index, follow">
    <?php else: ?>
    <!-- Pre-launch: kept out of search/AI until content is approved (config: indexable). -->
    <meta name="robots" content="noindex, nofollow">
    <?php endif; ?>

    <!-- Open Graph -->
    <meta property="og:site_name" content="<?= e($site['name']) ?>">
    <meta property="og:type" content="<?= e($page_type) ?>">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta property="og:title" content="<?= e($page_title) ?>">
    <meta property="og:description" content="<?= e($page_description) ?>">
    <meta property="og:image" content="<?= e($image_url) ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="<?= e($site['locale']) ?>">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($page_title) ?>">
    <meta name="twitter:description" content="<?= e($page_description) ?>">
    <meta name="twitter:image" content="<?= e($image_url) ?>">

    <meta name="theme-color" content="#0c0b0a">

    <!-- Progressive enhancement: only hide-for-reveal when JS runs, and never leave
         content trapped if the main script fails to load. -->
    <script>
        document.documentElement.classList.add('js');
        window.addEventListener('load', function () {
            setTimeout(function () {
                if (!document.documentElement.classList.contains('anim-ready')) {
                    var els = document.querySelectorAll('.reveal');
                    for (var i = 0; i < els.length; i++) els[i].classList.add('is-visible');
                }
            }, 500);
        });
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="page-<?= e($current_page ?: 'default') ?>">

<a class="skip-link" href="#main">Skip to content</a>

<header class="site-header" id="siteHeader" data-header>
    <div class="container header-inner">

        <a class="brand" href="index.php" aria-label="<?= e($site['name']) ?> — home">
            <!-- Enso-inspired brand mark (single subtle Japanese nod). Swap for supplied logo later. -->
            <span class="brand-mark" aria-hidden="true">
                <svg viewBox="0 0 48 48" width="40" height="40" fill="none">
                    <path d="M24 6a18 18 0 1 0 13 5.4" stroke="currentColor" stroke-width="2.4"
                          stroke-linecap="round"/>
                    <path d="M24 15v18M17 22h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            <span class="brand-text">
                <span class="brand-name"><?= e($site['name']) ?></span>
                <span class="brand-sub">Tattoo Studio</span>
            </span>
        </a>

        <nav class="main-nav" id="mainNav" aria-label="Primary">
            <ul>
                <?php foreach ($nav as $key => $item): ?>
                    <li>
                        <a href="<?= e($item['url']) ?>"
                           <?= $current_page === $key ? 'aria-current="page" class="is-active"' : '' ?>>
                            <?= e($item['label']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <a class="btn btn-gold header-cta" href="contact.php#book">Book Appointment</a>

        <button class="nav-toggle" id="navToggle" aria-label="Open menu" aria-expanded="false" aria-controls="mainNav">
            <span></span><span></span><span></span>
        </button>

    </div>
</header>

<main id="main">
