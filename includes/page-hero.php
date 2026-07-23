<?php
/**
 * Reusable inner-page banner.
 * Set before including: $hero_title (required), $hero_eyebrow, $hero_sub.
 */
$hero_eyebrow = $hero_eyebrow ?? '';
$hero_sub     = $hero_sub     ?? '';
?>
<section class="page-hero jp-pattern">
    <span class="page-hero-glow" aria-hidden="true"></span>
    <div class="container">
        <?php if ($hero_eyebrow !== ''): ?>
            <p class="eyebrow reveal"><?= e($hero_eyebrow) ?></p>
        <?php endif; ?>
        <h1 class="page-hero-title reveal"><?= e($hero_title) ?></h1>
        <?php if ($hero_sub !== ''): ?>
            <p class="page-hero-sub reveal"><?= e($hero_sub) ?></p>
        <?php endif; ?>
    </div>
</section>
