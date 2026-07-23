/* =============================================================
   Higher Truth Tattoo — interactions
   Header state · scroll reveals · mobile nav ·
   portfolio scroller · reviews carousel
   ============================================================= */
(function () {
    'use strict';

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Signal that the animation script is alive so the header failsafe stands down.
    document.documentElement.classList.add('anim-ready');

    /* ---------- Sticky header state ---------- */
    var header = document.querySelector('[data-header]');
    if (header) {
        var onScroll = function () {
            header.classList.toggle('is-scrolled', window.scrollY > 40);
        };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    /* ---------- Mobile nav ---------- */
    var toggle = document.getElementById('navToggle');
    var nav = document.getElementById('mainNav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var open = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', String(open));
            toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
            if (header) header.classList.toggle('nav-open', open);
        });
        nav.addEventListener('click', function (e) {
            if (e.target.tagName === 'A') {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
                if (header) header.classList.remove('nav-open');
            }
        });
    }

    /* ---------- Scroll reveal ---------- */
    var reveals = Array.prototype.slice.call(document.querySelectorAll('.reveal'));
    if (reduceMotion || !('IntersectionObserver' in window)) {
        reveals.forEach(function (el) { el.classList.add('is-visible'); });
    } else {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -8% 0px' });
        reveals.forEach(function (el) { io.observe(el); });
    }

    /* ---------- Portfolio horizontal scroller ---------- */
    var pCarousel = document.querySelector('[data-carousel="portfolio"]');
    if (pCarousel) {
        var track = pCarousel.querySelector('[data-track]');
        pCarousel.querySelectorAll('[data-dir]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var card = track.querySelector('.work-card');
                var step = card ? card.getBoundingClientRect().width + 20 : 300;
                track.scrollBy({
                    left: btn.dataset.dir === 'next' ? step * 2 : -step * 2,
                    behavior: reduceMotion ? 'auto' : 'smooth'
                });
            });
        });
    }

    /* ---------- Lightbox (originals, unstyled, full size) ---------- */
    var lb = document.getElementById('lightbox');
    if (lb) {
        var lbImg = lb.querySelector('.lightbox-img');
        var lbCap = lb.querySelector('.lightbox-caption');
        var triggers = Array.prototype.slice.call(document.querySelectorAll('[data-lightbox]'));
        var current = 0;
        var lastFocus = null;

        var show = function (i) {
            current = (i + triggers.length) % triggers.length;
            var t = triggers[current];
            lbImg.src = t.getAttribute('href');
            lbImg.alt = t.querySelector('img') ? t.querySelector('img').alt : '';
            lbCap.textContent = t.getAttribute('data-caption') || '';
        };
        var open = function (i, origin) {
            lastFocus = origin || null;
            show(i);
            lb.classList.add('is-open');
            lb.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            lb.querySelector('.lightbox-close').focus();
        };
        var close = function () {
            lb.classList.remove('is-open');
            lb.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            lbImg.src = '';
            if (lastFocus) lastFocus.focus();
        };

        triggers.forEach(function (t, i) {
            t.addEventListener('click', function (e) { e.preventDefault(); open(i, t); });
        });
        lb.querySelector('.lightbox-close').addEventListener('click', close);
        lb.querySelector('.prev').addEventListener('click', function () { show(current - 1); });
        lb.querySelector('.next').addEventListener('click', function () { show(current + 1); });
        lb.addEventListener('click', function (e) { if (e.target === lb) close(); });
        document.addEventListener('keydown', function (e) {
            if (!lb.classList.contains('is-open')) return;
            if (e.key === 'Escape') close();
            else if (e.key === 'ArrowLeft') show(current - 1);
            else if (e.key === 'ArrowRight') show(current + 1);
        });
    }

    /* ---------- Reviews carousel ---------- */
    var reviews = document.querySelector('[data-reviews]');
    if (reviews) {
        var rTrack = reviews.querySelector('[data-review-track]');
        var dotsWrap = reviews.querySelector('[data-review-dots]');
        var slides = rTrack ? rTrack.children.length : 0;
        var index = 0;
        var timer = null;

        if (slides > 1) {
            for (var i = 0; i < slides; i++) {
                (function (n) {
                    var dot = document.createElement('button');
                    dot.type = 'button';
                    dot.setAttribute('aria-label', 'Review slide ' + (n + 1));
                    dot.addEventListener('click', function () { goTo(n); restart(); });
                    dotsWrap.appendChild(dot);
                })(i);
            }

            var goTo = function (n) {
                index = (n + slides) % slides;
                rTrack.style.transform = 'translateX(' + (-index * 100) + '%)';
                Array.prototype.forEach.call(dotsWrap.children, function (d, di) {
                    d.classList.toggle('is-active', di === index);
                });
            };

            var restart = function () {
                if (reduceMotion) return;
                clearInterval(timer);
                timer = setInterval(function () { goTo(index + 1); }, 6500);
            };

            goTo(0);
            restart();
            reviews.addEventListener('mouseenter', function () { clearInterval(timer); });
            reviews.addEventListener('mouseleave', restart);
        }
    }
})();
