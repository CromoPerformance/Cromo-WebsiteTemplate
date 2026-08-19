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
})();
