<?php get_header(); ?>

<div class="container" style="padding-top: 20vh; padding-bottom: 20vh; text-align: center;">
  <h1 class="h1" style="font-size: clamp(4rem, 12vw, 8rem); margin-bottom: 1rem;">404</h1>
  <p class="body" style="margin-bottom: 2rem;">Página não encontrada.</p>
  <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Voltar ao início</a>
</div>

<?php get_footer(); ?>
