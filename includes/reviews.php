<?php
/**
 * Reusable Google reviews carousel. Set $reviews (array of
 * ['name','stars','text','when']) before including. 3 cards per slide.
 * Each card shows the reviewer, star rating, review text, and the Google logo.
 */
$reviews = $reviews ?? [];
$review_slides = array_chunk($reviews, 3);

$google_g = <<<SVG
<svg class="g-logo" viewBox="0 0 24 24" width="16" height="16" aria-hidden="true" focusable="false">
<path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
<path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
<path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/>
<path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
</svg>
SVG;
?>
<div class="reviews-carousel" data-reviews>
    <div class="reviews-viewport">
        <div class="reviews-track" data-review-track>
            <?php foreach ($review_slides as $slide): ?>
                <div class="review-slide">
                    <?php foreach ($slide as $r):
                        $stars   = max(1, min(5, (int) ($r['stars'] ?? 5)));
                        $initial = strtoupper(mb_substr(trim($r['name']), 0, 1));
                    ?>
                        <blockquote class="review-card">
                            <div class="review-top">
                                <span class="review-avatar" aria-hidden="true"><?= e($initial) ?></span>
                                <div class="review-meta">
                                    <cite class="review-name"><?= e($r['name']) ?></cite>
                                    <span class="review-stars" role="img" aria-label="<?= $stars ?> out of 5 stars"><?= str_repeat('★', $stars) ?></span>
                                </div>
                                <span class="review-google" title="Posted on Google"><?= $google_g ?></span>
                            </div>
                            <p class="review-text"><?= e($r['text']) ?></p>
                            <span class="review-when">Google review<?= !empty($r['when']) ? ' &middot; ' . e($r['when']) : '' ?></span>
                        </blockquote>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="reviews-dots" data-review-dots aria-label="Choose review slide"></div>
</div>
