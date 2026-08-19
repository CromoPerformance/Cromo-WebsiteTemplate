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

<nav class="site-nav">
  <div class="nav-left">
    <a href="<?php echo esc_url(home_url('/#about')); ?>" class="nav-link">Sobre</a>
    <a href="<?php echo esc_url(home_url('/#portfolio')); ?>" class="nav-link">Projetos</a>
    <a href="<?php echo esc_url(home_url('/#solucoes')); ?>" class="nav-link">Soluções</a>
  </div>
  <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/black-basic.avif'); ?>" alt="Cromo" class="logo-img">
  </a>
  <div class="nav-right">
    <div class="lang-dropdown">
      <button class="lang-current" id="langToggle">
        <span>PT-BR</span>
        <svg width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.2"/></svg>
      </button>
      <div class="lang-options" id="langOptions">
        <button class="lang-option" data-lang="pt">Português</button>
        <button class="lang-option" data-lang="en">English</button>
        <button class="lang-option" data-lang="es">Español</button>
      </div>
    </div>
    <a href="<?php echo esc_url(home_url('/#contato')); ?>" class="nav-cta">Contato</a>
  </div>
  <button class="hamburger" id="hamburger" aria-label="Abrir menu">
    <span></span>
    <span></span>
    <span></span>
  </button>
  <div class="mobile-menu" id="mobileMenu">
    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/black-basic.avif'); ?>" alt="Cromo" class="mobile-menu-logo" style="filter: invert(1);">
    <a href="<?php echo esc_url(home_url('/#about')); ?>" class="mobile-link">Sobre</a>
    <a href="<?php echo esc_url(home_url('/#portfolio')); ?>" class="mobile-link">Projetos</a>
    <a href="<?php echo esc_url(home_url('/#solucoes')); ?>" class="mobile-link">Soluções</a>
    <a href="<?php echo esc_url(home_url('/#contato')); ?>" class="mobile-link mobile-cta">Contato</a>
    <div class="lang-dropdown" style="margin-top: 1rem;">
      <button class="lang-current" id="langToggleMobile">
        <span>PT-BR</span>
        <svg width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.2"/></svg>
      </button>
      <div class="lang-options" id="langOptionsMobile">
        <button class="lang-option" data-lang="pt">Português</button>
        <button class="lang-option" data-lang="en">English</button>
        <button class="lang-option" data-lang="es">Español</button>
      </div>
    </div>
  </div>
</nav>
