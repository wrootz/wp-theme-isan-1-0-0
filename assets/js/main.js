'use strict';

/* ── 1. HEADER: transparent → white on scroll ──────────── */
(function () {
  var header = document.getElementById('header');
  if (!header) return;
  var ticking = false;

  function onScroll() {
    if (window.scrollY > 40) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
    ticking = false;
  }

  window.addEventListener('scroll', function () {
    if (!ticking) { requestAnimationFrame(onScroll); ticking = true; }
  }, { passive: true });

  onScroll();
})();


/* ── 2. HAMBURGER MOBILE MENU ───────────────────────────── */
(function () {
  var btn      = document.getElementById('hamburger');
  var menu     = document.getElementById('mobile-menu');
  var closeBtn = document.getElementById('mobile-close');
  if (!btn || !menu) return;

  function openMenu() {
    menu.classList.add('open');
    btn.classList.add('open');
    btn.setAttribute('aria-expanded', 'true');
    menu.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    menu.classList.remove('open');
    btn.classList.remove('open');
    btn.setAttribute('aria-expanded', 'false');
    menu.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  btn.addEventListener('click', function () {
    menu.classList.contains('open') ? closeMenu() : openMenu();
  });

  // Botão X interno
  if (closeBtn) closeBtn.addEventListener('click', closeMenu);

  // Fechar ao clicar num link (exceto redes sociais que abrem noutra aba)
  menu.querySelectorAll('a:not([target="_blank"])').forEach(function (a) {
    a.addEventListener('click', closeMenu);
  });

  // Fechar com Escape
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && menu.classList.contains('open')) closeMenu();
  });
})();


/* ── 3. PARALLAX (hero bg + section 3 bg) ──────────────── */
(function () {
  var heroBg = document.getElementById('hero-bg');
  var paraBg = document.getElementById('parallax-bg');
  var ticking = false;

  function update() {
    var y = window.scrollY;
    if (heroBg) {
      heroBg.style.transform = 'translateY(' + (y * 0.35) + 'px)';
    }
    if (paraBg) {
      var rect   = paraBg.parentElement.getBoundingClientRect();
      var center = rect.top + rect.height / 2;
      var vhalf  = window.innerHeight / 2;
      var offset = (center - vhalf) * 0.25;
      paraBg.style.transform = 'translateY(' + offset + 'px)';
    }
    ticking = false;
  }

  window.addEventListener('scroll', function () {
    if (!ticking) { requestAnimationFrame(update); ticking = true; }
  }, { passive: true });

  update();
})();


/* ── 4. NUMBERED SLIDER (tabs) ──────────────────────────── */
(function () {
  var tabs   = document.querySelectorAll('.slider-tab');
  var panels = document.querySelectorAll('.slider-panel');
  if (!tabs.length) return;

  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      var idx = parseInt(tab.dataset.slide, 10);

      tabs.forEach(function (t, i) {
        t.classList.toggle('active', i === idx);
        t.setAttribute('aria-selected', i === idx);
      });

      panels.forEach(function (p, i) {
        if (i === idx) {
          p.classList.add('active');
          p.removeAttribute('hidden');
        } else {
          p.classList.remove('active');
          p.setAttribute('hidden', '');
        }
      });
    });
  });
})();


/* ── 5. TEXT REVEAL on scroll (Section 3) ───────────────── */
(function () {
  var lines = document.querySelectorAll('.reveal-line');
  if (!lines.length) return;

  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) entry.target.classList.add('visible');
    });
  }, { threshold: 0.25 });

  lines.forEach(function (line) { observer.observe(line); });
})();


/* ── 6. SEARCH OVERLAY ──────────────────────────────────── */
(function () {
  var trigger = document.getElementById('search-trigger');
  var overlay = document.getElementById('search-overlay');
  var closeBtn = document.getElementById('search-close');
  if (!trigger || !overlay) return;

  var input = overlay.querySelector('.search-overlay__input');

  function openSearch() {
    overlay.classList.add('is-open');
    overlay.setAttribute('aria-hidden', 'false');
    trigger.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
    setTimeout(function () { if (input) input.focus(); }, 50);
  }

  function closeSearch() {
    overlay.classList.remove('is-open');
    overlay.setAttribute('aria-hidden', 'true');
    trigger.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
    trigger.focus();
  }

  trigger.addEventListener('click', openSearch);
  if (closeBtn) closeBtn.addEventListener('click', closeSearch);

  overlay.addEventListener('click', function (e) {
    if (e.target === overlay) closeSearch();
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && overlay.classList.contains('is-open')) closeSearch();
  });
})();


/* ── 7. SMOOTH ANCHOR SCROLL ────────────────────────────── */
document.querySelectorAll('a[href^="#"]').forEach(function (a) {
  a.addEventListener('click', function (e) {
    var id = a.getAttribute('href');
    if (id === '#') return;
    var target = document.querySelector(id);
    if (target) {
      e.preventDefault();
      var top = target.getBoundingClientRect().top + window.scrollY;
      window.scrollTo({ top: top, behavior: 'smooth' });
    }
  });
});
