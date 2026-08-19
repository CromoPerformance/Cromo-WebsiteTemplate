
<footer class="footer">
  <div class="footer-brand">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
      <img src="<?php echo esc_url(cromo_img('footer_logo', 'black-basic.avif')); ?>" alt="Cromo" class="logo-img" style="height:40px;">
    </a>
    <p class="body-sm" style="max-width:300px;">
      <?php echo esc_html(cromo_get('footer_desc', 'Fotografia, vídeo e estratégia digital para hotelaria, gastronomia & lifestyle de luxo.')); ?>
    </p>
  </div>
  <div class="footer-col">
    <h4 class="h4">Navegação</h4>
    <a href="<?php echo esc_url(home_url('/#about')); ?>">Sobre</a>
    <a href="<?php echo esc_url(home_url('/#portfolio')); ?>">Projetos</a>
    <a href="<?php echo esc_url(home_url('/#solucoes')); ?>">Soluções</a>
    <a href="<?php echo esc_url(home_url('/#contato')); ?>">Contato</a>
  </div>
  <div class="footer-col">
    <h4 class="h4">Redes</h4>
    <a href="https://instagram.com/studiocromo" target="_blank">Instagram</a>
    <a href="https://linkedin.com/company/studiocromo" target="_blank">LinkedIn</a>
  </div>
  <div class="footer-col">
    <h4 class="h4">Contato</h4>
    <a href="mailto:studio.cromo.studio@gmail.com">
      studio.cromo.studio@gmail.com
    </a>
    <a href="tel:5521969032564">
      (21) 96903-2564
    </a>
  </div>
  <div class="footer-bottom">
    <span>&copy; <?php echo date('Y'); ?> Studio Cromo. Todos os direitos reservados.</span>
    <span>Rio de Janeiro &mdash; Brasil</span>
  </div>
</footer>

<a href="https://wa.me/5521969032564" target="_blank" class="whatsapp-float" aria-label="WhatsApp">
  <svg viewBox="0 0 32 32" fill="#fff" width="24" height="24">
    <path d="M16.004 0h-.008C7.174 0 0 7.176 0 16c0 3.5 1.132 6.744 3.054 9.374L1.054 31.25l6.118-1.97C9.706 30.836 12.752 32 16.004 32 24.83 32 32 24.822 32 16S24.83 0 16.004 0zm9.35 22.604c-.39 1.1-1.932 2.014-3.158 2.28-.84.18-1.936.322-5.596-1.202-4.686-1.95-7.692-6.71-7.922-7.02-.224-.31-1.824-2.43-1.824-4.636 0-2.204 1.156-3.286 1.566-3.734.39-.426.946-.54 1.26-.54.31 0 .62.002.89.016.284.014.664-.106 1.036.79.39.936 1.33 3.236 1.446 3.47.116.234.194.506.038.816-.156.312-.232.506-.464.78-.234.274-.49.612-.7.818-.234.234-.476.486-.204.958.272.472 1.208 1.99 2.596 3.224 1.784 1.586 3.29 2.078 3.762 2.31.472.234.746.194 1.02-.116.274-.31 1.168-1.36 1.48-1.834.312-.472.624-.39 1.056-.234.434.156 2.752 1.298 3.224 1.532.472.234.786.35.904.544.116.194.116 1.12-.274 2.218z"/>
  </svg>
</a>

<?php wp_footer(); ?>
</body>
</html>
