
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
    <a href="<?php echo esc_url(home_url('/#portfolio')); ?>">Portfólio</a>
    <a href="<?php echo esc_url(home_url('/#metodologia')); ?>">Metodologia</a>
    <a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a>
    <a href="<?php echo esc_url(home_url('/#contato')); ?>">Contato</a>
  </div>
  <div class="footer-col">
    <h4 class="h4">Redes</h4>
    <a href="https://instagram.com/studiocromo" target="_blank">Instagram</a>
    <a href="https://linkedin.com/company/studiocromo" target="_blank">LinkedIn</a>
    <a href="https://youtube.com/@studiocromo" target="_blank">YouTube</a>
    <a href="<?php echo esc_url(home_url('/projeto')); ?>">Acervo</a>
  </div>
  <div class="footer-col">
    <h4 class="h4">Contato</h4>
    <a href="mailto:<?php echo esc_attr(cromo_get('contact_email', 'ola@studiocromo.com')); ?>">
      <?php echo esc_html(cromo_get('contact_email', 'ola@studiocromo.com')); ?>
    </a>
    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', cromo_get('contact_phone', '(21) 99999-9999'))); ?>">
      <?php echo esc_html(cromo_get('contact_phone', '(21) 99999-9999')); ?>
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
