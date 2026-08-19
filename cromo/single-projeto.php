<?php get_header(); while (have_posts()): the_post();
  $hero = get_post_meta(get_the_ID(), '_cromo_hero', true);
  if (!$hero) $hero = get_the_post_thumbnail_url(get_the_ID(), 'full');
  $cat  = get_post_meta(get_the_ID(), '_cromo_cat', true);
  $year = get_post_meta(get_the_ID(), '_cromo_year', true);
  $next = get_post_meta(get_the_ID(), '_cromo_next', true);
  $gallery = get_post_meta(get_the_ID(), '_cromo_gallery', true) ?: [];
  $location = get_post_meta(get_the_ID(), '_cromo_location', true);

  // Normalize: extract flat array of image URLs regardless of format
  $urls = [];
  if (!empty($gallery)) {
    if (isset($gallery[0]) && is_string($gallery[0])) {
      $urls = $gallery;
    } elseif (isset($gallery[0]) && is_array($gallery[0])) {
      foreach ($gallery as $row) {
        foreach ($row as $k => $v) {
          if (strpos($k, 'img_') === 0 && !empty($v)) $urls[] = $v;
        }
      }
    }
  }
  $urls = array_values(array_filter($urls));

  // Fallback: read gallery from WP Gallery block in post content
  if (empty($urls)) {
    $content = get_the_content();
    if (preg_match_all('/<figure[^>]*class="[^"]*wp-block-gallery[^"]*"[^>]*>(.*?)<\/figure>/s', $content, $gallery_matches)) {
      foreach ($gallery_matches[1] as $gallery_html) {
        if (preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/', $gallery_html, $img_matches)) {
          foreach ($img_matches[1] as $url) {
            $urls[] = $url;
          }
        }
      }
    }
  }

  // Build gallery rows: always grid, never single
  $patterns = ['three-equal', 'two-wide-left', 'three-equal', 'two-wide-right'];
  $gallery_rows = [];
  $i = 0;
  $patIdx = 0;
  $count = count($urls);
  while ($i < $count) {
    $pattern = $patterns[$patIdx % count($patterns)];
    if ($pattern === 'two-wide-left' || $pattern === 'two-wide-right') {
      $imgs = [$urls[$i]];
      if (isset($urls[$i + 1])) $imgs[] = $urls[$i + 1];
      $gallery_rows[] = ['layout' => $pattern, 'images' => $imgs];
      $i += count($imgs);
    } elseif ($pattern === 'three-equal') {
      $imgs = [$urls[$i]];
      if (isset($urls[$i + 1])) $imgs[] = $urls[$i + 1];
      if (isset($urls[$i + 2])) $imgs[] = $urls[$i + 2];
      $gallery_rows[] = ['layout' => $pattern, 'images' => $imgs];
      $i += count($imgs);
    }
    $patIdx++;
  }
?>

<section class="proj-hero">
  <img src="<?php echo esc_url($hero ?: get_template_directory_uri() . '/assets/images/hero.avif'); ?>" alt="<?php the_title_attribute(); ?>">
  <div class="proj-hero-overlay">
    <div class="proj-hero-content">
      <?php if ($cat || $location): ?>
        <span class="proj-hero-cat"><?php
          $meta = [];
          if ($cat) $meta[] = esc_html($cat);
          if ($location) $meta[] = esc_html($location);
          echo implode(' / ', $meta);
        ?></span>
      <?php endif; ?>
      <h1 class="proj-hero-title"><?php the_title(); ?></h1>
    </div>
  </div>
</section>

<a href="<?php echo esc_url(home_url('/#portfolio')); ?>" class="proj-back-btn" aria-label="Voltar">
  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
</a>

<?php if (!empty($gallery_rows)): ?>
<div class="proj-gallery">
  <?php foreach ($gallery_rows as $row):
    $layout = $row['layout'];
    $imgs = $row['images'];
  ?>
  <div class="proj-row proj-row-<?php echo esc_attr($layout); ?>">
    <?php foreach ($imgs as $url): ?>
      <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
    <?php endforeach; ?>
  </div>
  <?php endforeach; ?>
</div>
<?php else: ?>
<!-- Demo gallery with placeholders -->
<div class="proj-gallery">
  <div class="proj-row proj-row-two-wide-left">
    <div class="proj-placeholder proj-placeholder-lg"></div>
    <div class="proj-placeholder proj-placeholder-sm"></div>
  </div>
  <div class="proj-row proj-row-full">
    <div class="proj-placeholder proj-placeholder-full"></div>
  </div>
  <div class="proj-row proj-row-three">
    <div class="proj-placeholder"></div>
    <div class="proj-placeholder"></div>
    <div class="proj-placeholder"></div>
  </div>
  <div class="proj-row proj-row-two-wide-right">
    <div class="proj-placeholder proj-placeholder-sm"></div>
    <div class="proj-placeholder proj-placeholder-lg"></div>
  </div>
</div>
<?php endif; ?>

<?php
if (!$next) {
  $next_projeto = get_posts(['post_type' => 'projeto', 'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'ASC', 'post__not_in' => [get_the_ID()]]);
  $next = !empty($next_projeto) ? $next_projeto[0]->ID : 0;
}
if ($next):
?>
<a href="<?php echo esc_url(get_permalink($next)); ?>" class="proj-next">
  <span class="proj-next-label">Próximo projeto</span>
  <span class="proj-next-title"><?php echo esc_html(get_the_title($next)); ?></span>
</a>
<?php endif; ?>

<?php endwhile; get_footer(); ?>
