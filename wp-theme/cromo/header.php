<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#FFFFFF">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav>
  <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-nav-white.avif'); ?>" alt="Cromo" class="logo-img">
  </a>
  <div class="nav-links">
    <?php
    wp_nav_menu([
      'theme_location' => 'primary',
      'container' => false,
      'items_wrap' => '%3$s',
      'fallback_cb' => function () {
        echo '<a href="' . esc_url(home_url('/#solucoes')) . '">Soluções</a>';
        echo '<a href="' . esc_url(home_url('/#portfolio')) . '">Portfólio</a>';
        echo '<a href="' . esc_url(home_url('/blog')) . '">Blog</a>';
        echo '<a href="' . esc_url(home_url('/#contato')) . '" class="nav-cta">Contato</a>';
      },
    ]);
    ?>
  </div>
  <button class="hamburger" id="hamburger" aria-label="Abrir menu">
    <span></span>
    <span></span>
    <span></span>
  </button>
  <div class="mobile-menu" id="mobileMenu">
    <a href="<?php echo esc_url(home_url('/#solucoes')); ?>" class="mobile-link">Soluções</a>
    <a href="<?php echo esc_url(home_url('/#portfolio')); ?>" class="mobile-link">Portfólio</a>
    <a href="<?php echo esc_url(home_url('/blog')); ?>" class="mobile-link">Blog</a>
    <a href="<?php echo esc_url(home_url('/#contato')); ?>" class="mobile-link mobile-cta">Contato</a>
  </div>
</nav>
