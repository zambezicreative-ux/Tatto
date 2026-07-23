</main>

<footer class="site-footer">
    <div class="container footer-grid">

        <div class="footer-brand">
            <a class="brand" href="index.php" aria-label="<?= e($site['name']) ?> — home">
                <span class="brand-mark" aria-hidden="true">
                    <svg viewBox="0 0 48 48" width="38" height="38" fill="none">
                        <path d="M24 6a18 18 0 1 0 13 5.4" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                        <path d="M24 15v18M17 22h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </span>
                <span class="brand-text">
                    <span class="brand-name"><?= e($site['name']) ?></span>
                    <span class="brand-sub">Tattoo Studio</span>
                </span>
            </a>
            <p class="footer-blurb">Custom, Japanese-inspired tattoos created with intention. Your story, made permanent.</p>
            <ul class="social-links" aria-label="Social media">
                <?php foreach (active_socials() as $label => $url): ?>
                    <li><a href="<?= e($url) ?>" aria-label="<?= e($label) ?>" rel="noopener" target="_blank"><?= e($label) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <nav class="footer-col" aria-label="Quick links">
            <h3>Quick Links</h3>
            <ul>
                <?php foreach ($nav as $item): ?>
                    <li><a href="<?= e($item['url']) ?>"><?= e($item['label']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <div class="footer-col">
            <h3>Studio</h3>
            <address>
                <?= e($site['address']['street']) ?><br>
                <?= e($site['address']['city']) ?><br>
                <a href="tel:<?= e($site['phone_tel']) ?>"><?= e($site['phone']) ?></a><br>
                <a href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a>
            </address>
            <p class="footer-note">By consultation &amp; appointment &middot; Walk-ins welcome</p>
            <?php if (!empty($site['notice'])): ?>
                <p class="footer-notice"><?= e($site['notice']) ?></p>
            <?php endif; ?>
        </div>

        <div class="footer-col">
            <h3>Hours</h3>
            <ul class="hours-list">
                <?php foreach ($site['hours'] as $day => $time): ?>
                    <li><span><?= e($day) ?></span><span><?= e($time) ?></span></li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>

    <div class="container footer-bottom">
        <p>&copy; <?= date('Y') ?> Higher Truth Tattoo Inc. All rights reserved.</p>
        <p class="footer-legal">
            <a href="privacy.php">Privacy Policy</a>
            <span aria-hidden="true">&middot;</span> 18+ only
            <span aria-hidden="true">&middot;</span> Est. <?= e($site['est']) ?>
        </p>
    </div>
</footer>

<!-- Lightbox: shows the original, unstyled photo at full size (per Carlos). -->
<div class="lightbox" id="lightbox" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Image viewer">
    <button class="lightbox-close" type="button" aria-label="Close">&times;</button>
    <button class="lightbox-nav prev" type="button" aria-label="Previous image">&lsaquo;</button>
    <figure class="lightbox-stage">
        <img class="lightbox-img" src="" alt="">
        <figcaption class="lightbox-caption"></figcaption>
    </figure>
    <button class="lightbox-nav next" type="button" aria-label="Next image">&rsaquo;</button>
</div>

<script src="assets/js/main.js" defer></script>
</body>
</html>
