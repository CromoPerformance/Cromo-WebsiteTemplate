(function() {
  /* Scroll reveal */
  function revealOnScroll() {
    var reveals = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    reveals.forEach(function(el) {
      var windowHeight = window.innerHeight;
      var elementTop = el.getBoundingClientRect().top;
      if (elementTop < windowHeight - 100) {
        el.classList.add('active');
      }
    });
  }
  window.addEventListener('scroll', revealOnScroll);
  window.addEventListener('load', revealOnScroll);

  /* Hamburger menu */
  var hamburger = document.getElementById('hamburger');
  var mobileMenu = document.getElementById('mobileMenu');
  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', function() {
      hamburger.classList.toggle('active');
      mobileMenu.classList.toggle('open');
      document.body.style.overflow = mobileMenu.classList.contains('open') ? 'hidden' : '';
    });
    mobileMenu.querySelectorAll('.mobile-link').forEach(function(link) {
      link.addEventListener('click', function() {
        hamburger.classList.remove('active');
        mobileMenu.classList.remove('open');
        document.body.style.overflow = '';
      });
    });
  }

  /* Nav scroll transition */
  var siteNav = document.querySelector('.site-nav');
  if (siteNav) {
    function checkScroll() {
      if (window.scrollY > 80) {
        siteNav.classList.add('scrolled');
      } else {
        siteNav.classList.remove('scrolled');
      }
    }
    window.addEventListener('scroll', checkScroll);
    checkScroll();
  }

  /* Hero video — loop first 10 seconds */
  var heroVideo = document.getElementById('heroVideo');
  if (heroVideo) {
    heroVideo.addEventListener('timeupdate', function() {
      if (heroVideo.currentTime >= 10) {
        heroVideo.currentTime = 0;
        heroVideo.play();
      }
    });
  }

  /* Hero metrics counter animation */
  function animateCounters() {
    var metrics = document.querySelectorAll('.hero-metric-num');
    metrics.forEach(function(el) {
      if (el.dataset.animated) return;
      if (!el.dataset.target) {
        el.classList.add('hero-metric-visible');
        el.dataset.animated = '1';
        return;
      }
      el.dataset.animated = '1';

      var target = parseInt(el.dataset.target, 10);
      var suffix = el.dataset.suffix || '';
      var duration = 1800;
      var start = performance.now();

      function easeOut(t) {
        return 1 - Math.pow(1 - t, 3);
      }

      function step(now) {
        var elapsed = now - start;
        var progress = Math.min(elapsed / duration, 1);
        var current = Math.round(easeOut(progress) * target);
        el.textContent = current + suffix;
        if (progress < 1) {
          requestAnimationFrame(step);
        }
      }

      requestAnimationFrame(step);
    });
  }

  /* Trigger counters on IntersectionObserver or fallback */
  var metricsSection = document.getElementById('heroMetrics');
  if (metricsSection && 'IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          animateCounters();
          observer.disconnect();
        }
      });
    }, { threshold: 0.3 });
    observer.observe(metricsSection);
  } else {
    animateCounters();
  }

  /* ═══════════════════════════════════════════
     PORTFOLIO FULLSCREEN CAROUSEL
     ═══════════════════════════════════════════ */
  var carousel = document.getElementById('portfolioCarousel');
  if (carousel) {
    var slides = carousel.querySelectorAll('.portfolio-slide');
    var dots = carousel.querySelectorAll('.portfolio-dot');
    var currentEl = carousel.querySelector('.portfolio-current');
    var prevBtn = document.getElementById('portfolioPrev');
    var nextBtn = document.getElementById('portfolioNext');
    var current = 0;
    var total = slides.length;
    var autoplayTimer;

    function goTo(index) {
      if (index < 0) index = total - 1;
      if (index >= total) index = 0;
      slides[current].classList.remove('active');
      dots[current].classList.remove('active');
      current = index;
      slides[current].classList.add('active');
      dots[current].classList.add('active');
      if (currentEl) currentEl.textContent = String(current + 1).padStart(2, '0');
    }

    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1); }

    function startAutoplay() {
      stopAutoplay();
      autoplayTimer = setInterval(next, 5000);
    }

    function stopAutoplay() {
      if (autoplayTimer) clearInterval(autoplayTimer);
    }

    if (prevBtn) prevBtn.addEventListener('click', function() { prev(); startAutoplay(); });
    if (nextBtn) nextBtn.addEventListener('click', function() { next(); startAutoplay(); });

    dots.forEach(function(dot) {
      dot.addEventListener('click', function() {
        goTo(parseInt(this.dataset.index, 10));
        startAutoplay();
      });
    });

    /* Keyboard navigation */
    document.addEventListener('keydown', function(e) {
      if (!carousel.getBoundingClientRect) return;
      var rect = carousel.getBoundingClientRect();
      if (rect.top > window.innerHeight || rect.bottom < 0) return;
      if (e.key === 'ArrowLeft') { prev(); startAutoplay(); }
      if (e.key === 'ArrowRight') { next(); startAutoplay(); }
    });

    /* Touch swipe */
    var touchStartX = 0;
    carousel.addEventListener('touchstart', function(e) {
      touchStartX = e.touches[0].clientX;
      stopAutoplay();
    }, { passive: true });

    carousel.addEventListener('touchend', function(e) {
      var diff = touchStartX - e.changedTouches[0].clientX;
      if (Math.abs(diff) > 50) {
        diff > 0 ? next() : prev();
      }
      startAutoplay();
    }, { passive: true });

    startAutoplay();
  }

  /* Language dropdown */
  function initLangDropdown(toggleId, optionsId) {
    var toggle = document.getElementById(toggleId);
    var options = document.getElementById(optionsId);
    var dropdown = toggle ? toggle.closest('.lang-dropdown') : null;

    if (toggle && options && dropdown) {
      toggle.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.classList.toggle('open');
      });

      options.querySelectorAll('.lang-option').forEach(function(opt) {
        opt.addEventListener('click', function() {
          var lang = this.getAttribute('data-lang');
          toggle.querySelector('span').textContent = lang.toUpperCase();
          dropdown.classList.remove('open');
        });
      });
    }
  }

  initLangDropdown('langToggle', 'langOptions');
  initLangDropdown('langToggleMobile', 'langOptionsMobile');

  document.addEventListener('click', function() {
    document.querySelectorAll('.lang-dropdown.open').forEach(function(d) {
      d.classList.remove('open');
    });
  });
})();
