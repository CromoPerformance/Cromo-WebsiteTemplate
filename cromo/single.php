<?php get_header(); while (have_posts()): the_post(); ?>

<div class="post-container">
  <a href="<?php echo esc_url(home_url('/blog')); ?>" class="blog-back">&larr; Blog</a>

  <div class="post-header">
    <h1 class="h1"><?php the_title(); ?></h1>
    <div style="margin-top:1rem;font-size:0.75rem;color:var(--gray);letter-spacing:1px;text-transform:uppercase;">
      <?php $cats = get_the_category(); if (!empty($cats)): ?>
        <span><?php echo esc_html($cats[0]->name); ?></span> &mdash;
      <?php endif; ?>
      <span><?php echo get_the_date('d M Y'); ?></span>
    </div>
  </div>

  <div class="post-content">
    <?php the_content(); ?>
  </div>
</div>

<?php endwhile; get_footer(); ?>
