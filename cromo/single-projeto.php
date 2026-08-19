<?php get_header(); while (have_posts()): the_post();
  $hero = get_post_meta(get_the_ID(), '_cromo_hero', true);
  if (!$hero) $hero = get_the_post_thumbnail_url(get_the_ID(), 'full');
  $cat  = get_post_meta(get_the_ID(), '_cromo_cat', true);
  $year = get_post_meta(get_the_ID(), '_cromo_year', true);
  $next = get_post_meta(get_the_ID(), '_cromo_next', true);
  $gallery = get_post_meta(get_the_ID(), '_cromo_gallery', true) ?: [];
?>

<section class="proj-hero">
  <img src="<?php echo esc_url($hero ?: get_template_directory_uri() . '/assets/images/hero.avif'); ?>" alt="<?php the_title_attribute(); ?>">
</section>

<div class="proj-header">
  <div class="proj-header-left">
    <a href="<?php echo esc_url(home_url('/projeto')); ?>" class="proj-back">&larr; Acervo</a>
    <h1 class="proj-title"><?php the_title(); ?></h1>
  </div>
  <div class="proj-meta">
    <?php if ($cat): ?><span><?php echo esc_html($cat); ?></span><?php endif; ?>
    <?php if ($year): ?><span><?php echo esc_html($year); ?></span><?php endif; ?>
  </div>
</div>

<?php if (!empty($gallery)): ?>
<div class="proj-gallery">
  <?php foreach ($gallery as $row):
    $layout = $row['layout'] ?? 'full';
    $classes = ['two_equal' => 'two-eq', 'two_wide_left' => 'two-wide-left', 'two_wide_right' => 'two-wide-right', 'three_equal' => 'three', 'full' => 'full'];
    $row_class = $classes[$layout] ?? 'full';
    $cols = $layout === 'full' ? 1 : ($layout === 'three_equal' ? 3 : 2);
  ?>
  <div class="proj-row <?php echo esc_attr($row_class); ?>">
    <?php for ($n = 1; $n <= $cols; $n++): ?>
      <img src="<?php echo esc_url($row['img_' . $n] ?? ''); ?>"
           alt="<?php the_title_attribute(); ?>"
           class="<?php echo esc_attr($row['class_' . $n] ?? 'img-h'); ?>">
    <?php endfor; ?>
  </div>
  <?php endforeach; ?>
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
