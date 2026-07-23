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

        /* Touch / swipe (mobile): left/right = prev/next, swipe down = close. */
        var EASE = 'cubic-bezier(.22,.61,.36,1)';
        var THRESH_X = 45;   // horizontal distance to change image
        var THRESH_Y = 90;   // vertical distance to dismiss
        var sx = 0, sy = 0, dx = 0, dy = 0, tracking = false, moved = false;

        var springBack = function () {
            lbImg.style.transition = reduceMotion ? 'none' : ('transform .3s ' + EASE + ', opacity .3s ' + EASE);
            lbImg.style.transform = '';
            lbImg.style.opacity = '';
        };

        lb.addEventListener('touchstart', function (e) {
            if (e.touches.length !== 1) { tracking = false; return; } // ignore pinch
            sx = e.touches[0].clientX; sy = e.touches[0].clientY;
            dx = dy = 0; tracking = true; moved = false;
            lbImg.style.transition = 'none';
        }, { passive: true });

        lb.addEventListener('touchmove', function (e) {
            if (!tracking || e.touches.length !== 1) return;
            dx = e.touches[0].clientX - sx;
            dy = e.touches[0].clientY - sy;
            if (!moved && Math.abs(dx) < 8 && Math.abs(dy) < 8) return;
            moved = true;
            var horizontal = Math.abs(dx) > Math.abs(dy);
            if (horizontal) {
                e.preventDefault(); // block browser back-gesture / scroll
                if (!reduceMotion) lbImg.style.transform = 'translateX(' + dx + 'px)';
            } else if (dy > 0 && !reduceMotion) {
                lbImg.style.transform = 'translateY(' + dy + 'px)';
                lbImg.style.opacity = String(Math.max(0.35, 1 - dy / 400));
            }
        }, { passive: false });

        lb.addEventListener('touchend', function () {
            if (!tracking) return;
            tracking = false;
            var horizontal = Math.abs(dx) > Math.abs(dy);
            if (horizontal && Math.abs(dx) > THRESH_X) {
                springBack();
                show(dx < 0 ? current + 1 : current - 1);
            } else if (!horizontal && dy > THRESH_Y) {
                close();
                setTimeout(springBack, 60);
            } else {
                springBack();
            }
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
