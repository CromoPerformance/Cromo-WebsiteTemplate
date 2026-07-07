(function() {
  function revealOnScroll() {
    const reveals = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    reveals.forEach(function(el) {
      var windowHeight = window.innerHeight;
      var elementTop = el.getBoundingClientRect().top;
      var revealPoint = 100;
      if (elementTop < windowHeight - revealPoint) {
        el.classList.add('active');
      }
    });
  }
  window.addEventListener('scroll', revealOnScroll);
  window.addEventListener('load', revealOnScroll);

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
})();
