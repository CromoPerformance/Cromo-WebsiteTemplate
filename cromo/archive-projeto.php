<?php get_header(); ?>

<div class="feed-container">
  <a href="<?php echo esc_url(home_url('/')); ?>" class="back-link">&larr; Voltar</a>

  <div class="feed-profile">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-acervo.avif'); ?>" alt="Cromo" class="feed-logo">
    <div class="feed-info">
      <div class="feed-stats">
        <span><strong><?php echo esc_html(wp_count_posts('projeto')->publish); ?></strong> projetos</span>
        <span><strong>300+</strong> clientes</span>
        <span><strong>6</strong> anos</span>
      </div>
      <div class="feed-bio">
        <span class="bold">Studio Cromo</span> - Fotografia, vídeo e estratégia digital.<br>
        Comunicação visual para hotelaria, gastronomia &amp; lifestyle de luxo.
      </div>
    </div>
  </div>

  <div class="feed-grid" id="feedGrid">
    <?php $count = 0; if (have_posts()): while (have_posts()): the_post();
      $count++;
      $hero = get_post_meta(get_the_ID(), '_cromo_hero', true);
      if (!$hero) $hero = get_the_post_thumbnail_url(get_the_ID(), 'full');
      $hidden = $count > 6 ? ' hidden' : '';
    ?>
    <a href="<?php the_permalink(); ?>" class="feed-item<?php echo esc_attr($hidden); ?>">
      <img src="<?php echo esc_url($hero ?: get_template_directory_uri() . '/assets/images/hero.avif'); ?>"
           alt="<?php the_title_attribute(); ?>" loading="lazy">
      <div class="feed-overlay"><span><?php the_title(); ?></span></div>
    </a>
    <?php endwhile; endif; ?>
  </div>

  <?php if ($count > 6): ?>
  <div class="feed-load">
    <button class="feed-load-btn" onclick="document.querySelectorAll('.feed-item.hidden').forEach(function(el){el.classList.remove('hidden')});this.parentElement.style.display='none';">+</button>
  </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
