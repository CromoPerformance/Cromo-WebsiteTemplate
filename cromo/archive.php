<?php get_header(); ?>

<div class="blog-container">
  <a href="<?php echo esc_url(home_url('/')); ?>" class="blog-back">&larr; Home</a>

  <div class="blog-header">
    <h1><?php echo get_the_archive_title(); ?></h1>
    <p>Histórias, descobertas e olhares sobre gastronomia, hotelaria, viagem e lifestyle - contados por quem vive cada cena.</p>
  </div>

  <div class="blog-posts">
    <?php $index = wp_count_posts()->publish; if (have_posts()): while (have_posts()): the_post(); ?>
    <a href="<?php the_permalink(); ?>" class="blog-item">
      <div class="blog-item-left">
        <div class="blog-index"><?php echo str_pad($index--, 2, '0', STR_PAD_LEFT); ?></div>
        <div class="blog-meta">
          <?php $cats = get_the_category(); if (!empty($cats)): ?>
          <span class="blog-meta-line"><?php echo esc_html($cats[0]->name); ?></span>
          <?php endif; ?>
          <span class="blog-meta-line"><?php echo get_the_date('M Y'); ?></span>
        </div>
      </div>
      <h2 class="blog-title"><?php the_title(); ?></h2>
    </a>
    <?php endwhile; endif; ?>
  </div>
</div>

<?php get_footer(); ?>
