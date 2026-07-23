<?php
/**
 * Reusable reviews carousel. Set $reviews (array of ['name','text']) before include.
 * Renders slides of up to 3 cards. Home shows ~12, About shows the full ~32.
 */
$reviews = $reviews ?? [];
$review_slides = array_chunk($reviews, 3);
?>
<div class="reviews-carousel" data-reviews>
    <div class="reviews-viewport">
        <div class="reviews-track" data-review-track>
            <?php foreach ($review_slides as $slide): ?>
                <div class="review-slide">
                    <?php foreach ($slide as $r): ?>
                        <blockquote class="review-card">
                            <span class="quote-mark" aria-hidden="true">&ldquo;</span>
                            <p><?= e($r['text']) ?></p>
                            <cite><?= e($r['name']) ?></cite>
                        </blockquote>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="reviews-dots" data-review-dots aria-label="Choose review slide"></div>
</div>
