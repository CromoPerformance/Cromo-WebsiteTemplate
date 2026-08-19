(function() {
  'use strict';

  /* ═══════════════════════════════════════════
     TRANSLATIONS
     ═══════════════════════════════════════════ */
  var T = {
    pt: {
      nav_sobre: 'Sobre', nav_projetos: 'Projetos', nav_solucoes: 'Soluções', nav_contato: 'Contato',
      hero_eyebrow: 'COMUNICAÇÃO ESTRATÉGICA PARA',
      hero_line1: 'HOTELARIA', hero_line2: '& GASTRONOMIA',
      hero_btn1: 'COMEÇAR PROJETO', hero_btn2: 'CONHECER CROMO',
      hero_stat1: 'PROJETOS ENTREGUES', hero_stat2: 'ANOS DE MERCADO',
      about_eyebrow: 'Quem somos', about_title: 'Cromo\nComunicação',
      about_subtitle: 'Comunicação visual estratégica para hotelaria, gastronomia & lifestyle de luxo.',
      about_btn: 'Conheça a Cromo',
      sol_eyebrow: 'O que fazemos', sol_title: 'Soluções integradas para potencializar sua marca',
      sol1_title: 'Fotografia', sol1_desc: 'Imagens que contam a história da sua marca com identidade visual autêntica e sofisticada.',
      sol2_title: 'Vídeo', sol2_desc: 'Produção audiovisual que emociona e conecta, do conceito à entrega final.',
      sol3_title: 'Comunicação', sol3_desc: 'Estratégia de conteúdo e posicionamento que fortalece sua presença no mercado.',
      sol4_title: 'Marketing', sol4_desc: 'Campanhas digitais focadas em performance, engajamento e resultados mensuráveis.',
      contact_eyebrow: 'Contato', contact_title: 'Vamos conversar?',
      contact_desc: 'Conte-nos sobre seu projeto e descubra como podemos transformar sua comunicação visual.',
      contact_btn: 'Fale Conosco',
      form_nome: 'Nome', form_email: 'Email', form_whatsapp: 'WhatsApp',
      form_empresa: 'Empresa', form_cargo: 'Cargo', form_instagram: 'Instagram',
      form_categoria: 'Categoria', form_equipe: 'Equipe', form_projeto: 'Descreva seu projeto',
      form_submit: 'Enviar',
      err_nome: 'Nome é obrigatório', err_email: 'Email inválido',
      footer_desc: 'Fotografia, vídeo e estratégia digital para hotelaria, gastronomia & lifestyle de luxo.',
      footer_nav: 'Navegação', footer_redes: 'Redes', footer_contato: 'Contato',
    },
    en: {
      nav_sobre: 'About', nav_projetos: 'Projects', nav_solucoes: 'Services', nav_contato: 'Contact',
      hero_eyebrow: 'STRATEGIC COMMUNICATION FOR',
      hero_line1: 'HOSPITALITY', hero_line2: '& GASTRONOMY',
      hero_btn1: 'START A PROJECT', hero_btn2: 'MEET CROMO',
      hero_stat1: 'PROJECTS DELIVERED', hero_stat2: 'YEARS IN BUSINESS',
      about_eyebrow: 'About us', about_title: 'Cromo\nCommunication',
      about_subtitle: 'Strategic visual communication for luxury hospitality, gastronomy & lifestyle.',
      about_btn: 'Meet Cromo',
      sol_eyebrow: 'What we do', sol_title: 'Integrated solutions to empower your brand',
      sol1_title: 'Photography', sol1_desc: 'Images that tell your brand story with authentic, sophisticated visual identity.',
      sol2_title: 'Video', sol2_desc: 'Audiovisual production that moves and connects, from concept to final delivery.',
      sol3_title: 'Communication', sol3_desc: 'Content strategy and positioning that strengthens your market presence.',
      sol4_title: 'Marketing', sol4_desc: 'Digital campaigns focused on performance, engagement and measurable results.',
      contact_eyebrow: 'Contact', contact_title: 'Let\'s talk?',
      contact_desc: 'Tell us about your project and discover how we can transform your visual communication.',
      contact_btn: 'Get in Touch',
      form_nome: 'Name', form_email: 'Email', form_whatsapp: 'WhatsApp',
      form_empresa: 'Company', form_cargo: 'Role', form_instagram: 'Instagram',
      form_categoria: 'Category', form_equipe: 'Team', form_projeto: 'Describe your project',
      form_submit: 'Submit',
      err_nome: 'Name is required', err_email: 'Invalid email',
      footer_desc: 'Photography, video and digital strategy for luxury hospitality, gastronomy & lifestyle.',
      footer_nav: 'Navigation', footer_redes: 'Social', footer_contato: 'Contact',
    },
    es: {
      nav_sobre: 'Nosotros', nav_projetos: 'Proyectos', nav_solucoes: 'Servicios', nav_contato: 'Contacto',
      hero_eyebrow: 'COMUNICACIÓN ESTRATÉGICA PARA',
      hero_line1: 'HOTELERÍA', hero_line2: '& GASTRONOMÍA',
      hero_btn1: 'EMPEZAR UN PROYECTO', hero_btn2: 'CONOCER CROMO',
      hero_stat1: 'PROYECTOS ENTREGADOS', hero_stat2: 'AÑOS EN EL MERCADO',
      about_eyebrow: 'Quiénes somos', about_title: 'Cromo\nComunicación',
      about_subtitle: 'Comunicación visual estratégica para hotelería, gastronomía y lifestyle de lujo.',
      about_btn: 'Conocer Cromo',
      sol_eyebrow: 'Qué hacemos', sol_title: 'Soluciones integradas para potenciar tu marca',
      sol1_title: 'Fotografía', sol1_desc: 'Imágenes que cuentan la historia de tu marca con identidad visual auténtica y sofisticada.',
      sol2_title: 'Video', sol2_desc: 'Producción audiovisual que emociona y conecta, del concepto a la entrega final.',
      sol3_title: 'Comunicación', sol3_desc: 'Estrategia de contenido y posicionamiento que fortalece tu presencia en el mercado.',
      sol4_title: 'Marketing', sol4_desc: 'Campañas digitales enfocadas en performance, engagement y resultados medibles.',
      contact_eyebrow: 'Contacto', contact_title: '¿Hablamos?',
      contact_desc: 'Cuéntanos sobre tu proyecto y descubre cómo podemos transformar tu comunicación visual.',
      contact_btn: 'Contáctanos',
      form_nome: 'Nombre', form_email: 'Email', form_whatsapp: 'WhatsApp',
      form_empresa: 'Empresa', form_cargo: 'Cargo', form_instagram: 'Instagram',
      form_categoria: 'Categoría', form_equipe: 'Equipo', form_projeto: 'Describe tu proyecto',
      form_submit: 'Enviar',
      err_nome: 'El nombre es obligatorio', err_email: 'Email inválido',
      footer_desc: 'Fotografía, video y estrategia digital para hotelería, gastronomía y lifestyle de lujo.',
      footer_nav: 'Navegación', footer_redes: 'Redes', footer_contato: 'Contacto',
    }
  };

  var langNames = { pt: 'PT-BR', en: 'EN', es: 'ES' };

  /* ═══════════════════════════════════════════
     LANGUAGE SWITCHER
     ═══════════════════════════════════════════ */
  function applyLanguage(lang) {
    var dict = T[lang] || T.pt;
    document.querySelectorAll('[data-i18n]').forEach(function(el) {
      var key = el.getAttribute('data-i18n');
      if (dict[key]) {
        el.innerHTML = dict[key].replace(/\n/g, '<br>');
      }
    });
    // Update switcher labels
    document.querySelectorAll('.lang-current span').forEach(function(span) {
      span.textContent = langNames[lang] || lang.toUpperCase();
    });
    // Highlight active option
    document.querySelectorAll('.lang-option').forEach(function(opt) {
      opt.classList.toggle('active', opt.getAttribute('data-lang') === lang);
    });
    document.documentElement.setAttribute('lang', lang === 'pt' ? 'pt-BR' : lang);
  }

  function setLanguage(lang) {
    try { localStorage.setItem('cromo_lang', lang); } catch(e) {}
    applyLanguage(lang);
  }

  function initLangSwitcher() {
    var saved = 'pt';
    try { saved = localStorage.getItem('cromo_lang') || 'pt'; } catch(e) {}

    ['langToggle', 'langToggleMobile'].forEach(function(toggleId) {
      var toggle = document.getElementById(toggleId);
      if (!toggle) return;
      var dropdown = toggle.closest('.lang-dropdown');
      var optionsId = toggleId === 'langToggle' ? 'langOptions' : 'langOptionsMobile';
      var options = document.getElementById(optionsId);
      if (!dropdown || !options) return;

      toggle.addEventListener('click', function(e) {
        e.stopPropagation();
        // Close other dropdowns
        document.querySelectorAll('.lang-dropdown.open').forEach(function(d) {
          if (d !== dropdown) d.classList.remove('open');
        });
        dropdown.classList.toggle('open');
      });

      options.querySelectorAll('.lang-option').forEach(function(opt) {
        opt.addEventListener('click', function() {
          var lang = this.getAttribute('data-lang');
          setLanguage(lang);
          dropdown.classList.remove('open');
        });
      });
    });

    applyLanguage(saved);
  }

  /* ═══════════════════════════════════════════
     PHONE FORMATTING (Brazil)
     ═══════════════════════════════════════════ */
  function formatPhone(value) {
    var d = value.replace(/\D/g, '');
    if (d.length === 0) return '';
    if (d.length <= 2) return '(' + d;
    if (d.length <= 7) return '(' + d.slice(0,2) + ') ' + d.slice(2);
    if (d.length <= 10) return '(' + d.slice(0,2) + ') ' + d.slice(2,6) + '-' + d.slice(6);
    return '(' + d.slice(0,2) + ') ' + d.slice(2,7) + '-' + d.slice(7,11);
  }

  /* ═══════════════════════════════════════════
     FORM VALIDATION
     ═══════════════════════════════════════════ */
  function validateField(input) {
    var field = input.closest('.form-field');
    if (!field) return true;
    var isValid = true;

    if (input.required || input.id === 'nome' || input.id === 'email') {
      if (!input.value.trim()) {
        isValid = false;
      } else if (input.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value)) {
        isValid = false;
      }
    }

    // Phone validation (optional but if filled, must be valid)
    if (input.classList.contains('phone-input') && input.value.trim()) {
      var digits = input.value.replace(/\D/g, '');
      if (digits.length < 10 || digits.length > 11) {
        isValid = false;
      }
    }

    field.classList.toggle('valid', isValid && input.value.trim());
    field.classList.toggle('invalid', !isValid);
    return isValid;
  }

  function validateForm(form) {
    var valid = true;
    form.querySelectorAll('.form-input[required], .form-input[name="nome"], .form-input[name="email"]').forEach(function(input) {
      if (!validateField(input)) valid = false;
    });
    return valid;
  }

  /* ═══════════════════════════════════════════
     FORM SUBMISSION (AJAX)
     ═══════════════════════════════════════════ */
  function initForm() {
    var form = document.getElementById('ctaForm');
    if (!form) return;

    // Phone formatting
    form.querySelectorAll('.phone-input').forEach(function(input) {
      input.addEventListener('input', function() {
        var pos = this.selectionStart;
        var oldLen = this.value.length;
        this.value = formatPhone(this.value);
        var newLen = this.value.length;
        this.setSelectionRange(pos + (newLen - oldLen), pos + (newLen - oldLen));
      });
      input.addEventListener('blur', function() { validateField(this); });
    });

    // Validate on blur
    form.querySelectorAll('.form-input').forEach(function(input) {
      input.addEventListener('blur', function() { validateField(this); });
      input.addEventListener('input', function() {
        var field = this.closest('.form-field');
        if (field && field.classList.contains('invalid')) validateField(this);
      });
    });

    // Submit
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      if (!validateForm(form)) return;

      var btn = form.querySelector('.form-submit');
      var originalText = btn.textContent;
      btn.textContent = '...';
      btn.disabled = true;

      var data = new FormData(form);
      if (typeof cromoData !== 'undefined') {
        data.append('action', 'cromo_save_lead');
        data.append('nonce', cromoData.nonce);
      }

      var xhr = new XMLHttpRequest();
      xhr.open('POST', typeof cromoData !== 'undefined' ? cromoData.ajaxUrl : '/wp-admin/admin-ajax.php', true);
      xhr.onload = function() {
        btn.textContent = originalText;
        btn.disabled = false;
        if (xhr.status === 200) {
          try {
            var res = JSON.parse(xhr.responseText);
            if (res.success) {
              form.style.display = 'none';
              var success = document.getElementById('formSuccess');
              if (success) success.style.display = 'block';
            } else {
              alert(res.data && res.data.message ? res.data.message : 'Erro ao enviar. Tente novamente.');
            }
          } catch(err) {
            alert('Erro ao enviar. Tente novamente.');
          }
        } else {
          alert('Erro ao enviar. Tente novamente.');
        }
      };
      xhr.onerror = function() {
        btn.textContent = originalText;
        btn.disabled = false;
        alert('Erro de conexão. Verifique sua internet.');
      };
      xhr.send(data);
    });
  }

  /* ═══════════════════════════════════════════
     SCROLL REVEAL
     ═══════════════════════════════════════════ */
  function revealOnScroll() {
    document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(function(el) {
      if (el.getBoundingClientRect().top < window.innerHeight - 100) {
        el.classList.add('active');
      }
    });
  }
  window.addEventListener('scroll', revealOnScroll);
  window.addEventListener('load', revealOnScroll);

  /* ═══════════════════════════════════════════
     HAMBURGER MENU
     ═══════════════════════════════════════════ */
  var hamburger = document.getElementById('hamburger');
  var mobileMenu = document.getElementById('mobileMenu');
  var siteNav = document.querySelector('.site-nav');
  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', function() {
      hamburger.classList.toggle('active');
      mobileMenu.classList.toggle('open');
      if (siteNav) siteNav.classList.toggle('menu-open');
      document.body.style.overflow = mobileMenu.classList.contains('open') ? 'hidden' : '';
    });
    mobileMenu.querySelectorAll('.mobile-link').forEach(function(link) {
      link.addEventListener('click', function() {
        hamburger.classList.remove('active');
        mobileMenu.classList.remove('open');
        if (siteNav) siteNav.classList.remove('menu-open');
        document.body.style.overflow = '';
      });
    });
  }

  /* ═══════════════════════════════════════════
     NAV SCROLL
     ═══════════════════════════════════════════ */
  if (siteNav) {
    function checkScroll() {
      siteNav.classList.toggle('scrolled', window.scrollY > 80);
    }
    window.addEventListener('scroll', checkScroll);
    checkScroll();
  }

  /* ═══════════════════════════════════════════
     HERO VIDEO (loop first 10s)
     ═══════════════════════════════════════════ */
  var heroVideo = document.getElementById('heroVideo');
  if (heroVideo) {
    heroVideo.addEventListener('timeupdate', function() {
      if (heroVideo.currentTime >= 10) {
        heroVideo.currentTime = 0;
        heroVideo.play();
      }
    });
  }

  /* ═══════════════════════════════════════════
     HERO COUNTERS
     ═══════════════════════════════════════════ */
  function animateCounters() {
    document.querySelectorAll('.hero-metric-num').forEach(function(el) {
      if (el.dataset.animated) return;
      if (!el.dataset.target) { el.dataset.animated = '1'; return; }
      el.dataset.animated = '1';
      var target = parseInt(el.dataset.target, 10);
      var suffix = el.dataset.suffix || '';
      var duration = 1800;
      var start = performance.now();
      function step(now) {
        var p = Math.min((now - start) / duration, 1);
        el.textContent = Math.round((1 - Math.pow(1 - p, 3)) * target) + suffix;
        if (p < 1) requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
    });
  }

  var metricsSection = document.getElementById('heroMetrics');
  if (metricsSection && 'IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) { animateCounters(); observer.disconnect(); }
      });
    }, { threshold: 0.3 });
    observer.observe(metricsSection);
  } else {
    animateCounters();
  }

  /* ═══════════════════════════════════════════
     PORTFOLIO CAROUSEL
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
    function startAutoplay() { stopAutoplay(); autoplayTimer = setInterval(next, 5000); }
    function stopAutoplay() { if (autoplayTimer) clearInterval(autoplayTimer); }

    if (prevBtn) prevBtn.addEventListener('click', function() { prev(); startAutoplay(); });
    if (nextBtn) nextBtn.addEventListener('click', function() { next(); startAutoplay(); });

    dots.forEach(function(dot) {
      dot.addEventListener('click', function() {
        goTo(parseInt(this.dataset.index, 10));
        startAutoplay();
      });
    });

    document.addEventListener('keydown', function(e) {
      var rect = carousel.getBoundingClientRect();
      if (rect.top > window.innerHeight || rect.bottom < 0) return;
      if (e.key === 'ArrowLeft') { prev(); startAutoplay(); }
      if (e.key === 'ArrowRight') { next(); startAutoplay(); }
    });

    var touchStartX = 0;
    carousel.addEventListener('touchstart', function(e) {
      touchStartX = e.touches[0].clientX;
      stopAutoplay();
    }, { passive: true });

    carousel.addEventListener('touchend', function(e) {
      var diff = touchStartX - e.changedTouches[0].clientX;
      if (Math.abs(diff) > 50) { diff > 0 ? next() : prev(); }
      startAutoplay();
    }, { passive: true });

    startAutoplay();
  }

  /* ═══════════════════════════════════════════
     CLOSE DROPDOWNS ON OUTSIDE CLICK
     ═══════════════════════════════════════════ */
  document.addEventListener('click', function() {
    document.querySelectorAll('.lang-dropdown.open').forEach(function(d) { d.classList.remove('open'); });
    document.querySelectorAll('.custom-select.open').forEach(function(d) { d.classList.remove('open'); });
  });

  /* ═══════════════════════════════════════════
     CUSTOM SELECT DROPDOWNS
     ═══════════════════════════════════════════ */
  document.querySelectorAll('.custom-select').forEach(function(sel) {
    var trigger = sel.querySelector('.custom-select-trigger');
    var options = sel.querySelector('.custom-select-options');
    var hidden = sel.querySelector('.form-select-hidden');
    var spanText = trigger.querySelector('span');

    trigger.addEventListener('click', function(e) {
      e.stopPropagation();
      document.querySelectorAll('.custom-select.open').forEach(function(d) {
        if (d !== sel) d.classList.remove('open');
      });
      sel.classList.toggle('open');
    });

    options.querySelectorAll('.custom-select-option').forEach(function(opt) {
      opt.addEventListener('click', function() {
        spanText.textContent = this.textContent;
        hidden.value = this.getAttribute('data-value');
        trigger.classList.add('has-value');
        sel.classList.remove('open');
      });
    });
  });

  /* ═══════════════════════════════════════════
     INIT
     ═══════════════════════════════════════════ */
  document.addEventListener('DOMContentLoaded', function() {
    initLangSwitcher();
    initForm();
  });

})();
