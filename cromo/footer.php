
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
    <a href="<?php echo esc_url(home_url('/#solucoes')); ?>">Soluções</a>
    <a href="<?php echo esc_url(home_url('/#portfolio')); ?>">Projetos</a>
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

<?php wp_footer(); ?>
</body>
</html>
