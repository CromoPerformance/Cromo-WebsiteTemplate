<?php
/**
 * Template Name: Hub de Projetos
 */

get_header();
$projetos = get_posts(['post_type' => 'projeto', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC']);
?>

<main class="hub">
  <div class="hub-container">
    <header class="hub-header">
      <div class="hub-intro">
        <div class="hub-intro-text">
          <h1 class="hub-title">Projetos</h1>
          <p class="hub-desc">Fotografia, vídeo e estratégia visual para hotelaria e gastronomia de luxo.</p>
        </div>
      </div>
    </header>

    <div class="hub-grid">
      <?php foreach ($projetos as $idx => $p):
        $hero = get_post_meta($p->ID, '_cromo_hero', true);
        if (!$hero) $hero = get_the_post_thumbnail_url($p->ID, 'full');
        if (!$hero) $hero = get_template_directory_uri() . '/assets/images/hero.avif';
        $cat = get_post_meta($p->ID, '_cromo_cat', true);
        $loc = get_post_meta($p->ID, '_cromo_location', true);
        // Alternate grid patterns
        $pattern = $idx % 5;
      ?>
      <a href="<?php echo esc_url(get_permalink($p->ID)); ?>" class="hub-item hub-item-<?php echo $pattern; ?>" data-cat="<?php echo esc_attr($cat); ?>">
        <div class="hub-item-img">
          <img src="<?php echo esc_url($hero); ?>" alt="<?php echo esc_attr($p->post_title); ?>" loading="lazy">
        </div>
        <div class="hub-item-overlay">
          <span class="hub-item-cat"><?php echo $loc ? esc_html($loc) : esc_html($cat); ?></span>
          <h3 class="hub-item-title"><?php echo esc_html($p->post_title); ?></h3>
        </div>
      </a>
      <?php endforeach; ?>

      <?php if (empty($projetos)): ?>
      <!-- Demo placeholders -->
      <div class="hub-item hub-item-0"><div class="hub-item-img"><div class="hub-placeholder" style="background:#d4d0cb;"></div></div></div>
      <div class="hub-item hub-item-1"><div class="hub-item-img"><div class="hub-placeholder" style="background:#b8b3ab;"></div></div></div>
      <div class="hub-item hub-item-2"><div class="hub-item-img"><div class="hub-placeholder" style="background:#c2bdb5;"></div></div></div>
      <div class="hub-item hub-item-3"><div class="hub-item-img"><div class="hub-placeholder" style="background:#ccc8c1;"></div></div></div>
      <div class="hub-item hub-item-4"><div class="hub-item-img"><div class="hub-placeholder" style="background:#b0aba3;"></div></div></div>
      <div class="hub-item hub-item-0"><div class="hub-item-img"><div class="hub-placeholder" style="background:#d8d4cd;"></div></div></div>
      <div class="hub-item hub-item-1"><div class="hub-item-img"><div class="hub-placeholder" style="background:#a8a39b;"></div></div></div>
      <div class="hub-item hub-item-2"><div class="hub-item-img"><div class="hub-placeholder" style="background:#c5c0b8;"></div></div></div>
      <?php endif; ?>
    </div>
  </div>
</main>

<!-- Lightbox -->
<div class="hub-lightbox" id="hubLightbox">
  <button class="hub-lightbox-close" aria-label="Fechar">&times;</button>
  <img src="" alt="" class="hub-lightbox-img">
</div>

<?php get_footer(); ?>
