<?php get_header(); ?>

<section class="hero" id="hero">
  <video class="hero-video" autoplay muted playsinline preload="auto" id="heroVideo">
    <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/videos/STUDIO CROMO - RESTAURANTE_V2.mov'); ?>" type="video/mp4">
  </video>
  <div class="hero-overlay"></div>

  <div class="hero-content">
    <p class="hero-eyebrow">COMUNICAÇÃO ESTRATÉGICA PARA</p>
    <h1 class="hero-title">
      <span>HOTELARIA</span>
      <span>& GASTRONOMIA</span>
    </h1>
    <div class="hero-buttons">
      <a href="#contato" class="btn-hero btn-hero-primary">COMEÇAR PROJETO</a>
      <a href="#about" class="btn-hero btn-hero-outline">CONHECER CROMO</a>
    </div>
  </div>

  <div class="hero-metrics" id="heroMetrics">
    <div class="hero-metric">
      <span class="hero-metric-num" data-target="290" data-suffix="+">0</span>
      <span class="hero-metric-label">PROJETOS ENTREGUES</span>
    </div>
    <div class="hero-metric">
      <span class="hero-metric-num hero-metric-text">AVAILABLE<br>WORLDWIDE</span>
    </div>
    <div class="hero-metric">
      <span class="hero-metric-num" data-target="6" data-suffix="">0</span>
      <span class="hero-metric-label">ANOS DE MERCADO</span>
    </div>
  </div>
</section>

<div class="section" id="about">
  <div class="container">
    <div class="about-grid">
      <div>
        <span class="eyebrow"><?php echo esc_html(cromo_get('about_eyebrow', 'Quem somos')); ?></span>
        <h2 class="h2" style="margin-bottom:1.5rem;">
          <?php echo nl2br(esc_html(cromo_get('about_title', "Cromo\nComunicação"))); ?>
        </h2>
        <?php if (cromo_get('about_desc1')): ?>
          <p class="body" style="margin-bottom:1.5rem;"><?php echo esc_html(cromo_get('about_desc1')); ?></p>
        <?php endif; ?>
        <?php if (cromo_get('about_desc2')): ?>
          <p class="body"><?php echo esc_html(cromo_get('about_desc2')); ?></p>
        <?php endif; ?>
      </div>
      <img src="<?php echo esc_url(cromo_img('about_image', 'renan-blaute.avif')); ?>"
           alt="Studio Cromo" class="about-image" loading="lazy" decoding="async">
    </div>
  </div>
</div>

<section id="portfolio" class="portfolio-fullscreen">
  <span class="portfolio-label">Projetos</span>
  <div class="portfolio-carousel" id="portfolioCarousel">
    <?php
    $projetos = get_posts(['post_type' => 'projeto', 'posts_per_page' => 10, 'orderby' => 'date', 'order' => 'DESC']);
    $total = count($projetos);
    $idx = 0;
    foreach ($projetos as $projeto):
      $hero = get_post_meta($projeto->ID, '_cromo_hero', true);
      if (!$hero) $hero = get_the_post_thumbnail_url($projeto->ID, 'full');
      $cat  = get_post_meta($projeto->ID, '_cromo_cat', true);
      $loc  = get_post_meta($projeto->ID, '_cromo_location', true);
    ?>
    <div class="portfolio-slide<?php echo $idx === 0 ? ' active' : ''; ?>" data-index="<?php echo $idx; ?>">
      <div class="portfolio-slide-bg" style="background-image:url('<?php echo esc_url($hero ?: get_template_directory_uri() . '/assets/images/hero.avif'); ?>')"></div>
      <div class="portfolio-slide-overlay"></div>
      <div class="portfolio-slide-content">
        <span class="portfolio-slide-cat"><?php echo $loc ? esc_html($loc) : ($cat ? esc_html($cat) : ''); ?></span>
        <h2 class="portfolio-slide-title"><?php echo esc_html($projeto->post_title); ?></h2>
        <a href="<?php echo esc_url(get_permalink($projeto->ID)); ?>" class="btn btn-white btn-slide">Ver Mais</a>
      </div>
    </div>
    <?php $idx++; endforeach; wp_reset_postdata(); ?>

    <div class="portfolio-nav">
      <button class="portfolio-nav-btn portfolio-prev" id="portfolioPrev">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 18l-6-6 6-6"/></svg>
      </button>
      <div class="portfolio-counter">
        <span class="portfolio-current">01</span>
        <span class="portfolio-sep">/</span>
        <span class="portfolio-total"><?php printf('%02d', $total); ?></span>
      </div>
      <button class="portfolio-nav-btn portfolio-next" id="portfolioNext">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 18l6-6-6-6"/></svg>
      </button>
    </div>

    <div class="portfolio-dots" id="portfolioDots">
      <?php for ($i = 0; $i < $total; $i++): ?>
        <button class="portfolio-dot<?php echo $i === 0 ? ' active' : ''; ?>" data-index="<?php echo $i; ?>"></button>
      <?php endfor; ?>
    </div>
  </div>
</section>

<div id="solucoes" class="section">
  <div class="container">
    <span class="eyebrow"><?php echo esc_html(cromo_get('sol_eyebrow', 'O que fazemos')); ?></span>
    <h2 class="h2"><?php echo esc_html(cromo_get('sol_title', 'Soluções integradas para potencializar sua marca')); ?></h2>
    <div class="solutions-grid">
      <div class="solution-card">
        <span class="solution-num">01</span>
        <h4 class="h4">Fotografia</h4>
        <p class="body-sm">Imagens que contam a história da sua marca com identidade visual autêntica e sofisticada.</p>
      </div>
      <div class="solution-card">
        <span class="solution-num">02</span>
        <h4 class="h4">Vídeo</h4>
        <p class="body-sm">Produção audiovisual que emociona e conecta, do conceito à entrega final.</p>
      </div>
      <div class="solution-card">
        <span class="solution-num">03</span>
        <h4 class="h4">Comunicação</h4>
        <p class="body-sm">Estratégia de conteúdo e posicionamento que fortalece sua presença no mercado.</p>
      </div>
      <div class="solution-card">
        <span class="solution-num">04</span>
        <h4 class="h4">Marketing</h4>
        <p class="body-sm">Campanhas digitais focadas em performance, engajamento e resultados mensuráveis.</p>
      </div>
    </div>
  </div>
</div>

<section id="contato" class="cta-section">
  <div class="cta-grid">
    <div class="cta-heading">
      <span class="eyebrow"><?php echo esc_html(cromo_get('contact_eyebrow', 'Contato')); ?></span>
      <h2 class="h2"><?php echo esc_html(cromo_get('contact_title', 'Vamos conversar?')); ?></h2>
      <p class="body"><?php echo esc_html(cromo_get('contact_desc', 'Conte-nos sobre seu projeto e descubra como podemos transformar sua comunicação visual.')); ?></p>
      <div>
        <a href="https://wa.me/5521969032564" target="_blank" class="btn btn-primary">Fale Conosco</a>
      </div>
    </div>
    <div>
      <form class="cta-form" id="ctaForm">
        <div class="form-row">
          <div class="form-field">
            <label class="form-label" for="nome">Nome</label>
            <input type="text" id="nome" class="form-input" placeholder="Seu nome" required>
          </div>
          <div class="form-field">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" class="form-input" placeholder="seu@email.com" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-field">
            <label class="form-label" for="whatsapp">WhatsApp</label>
            <input type="tel" id="whatsapp" class="form-input" placeholder="(21) 99999-9999">
          </div>
          <div class="form-field">
            <label class="form-label" for="empresa">Empresa</label>
            <input type="text" id="empresa" class="form-input" placeholder="Nome da empresa">
          </div>
        </div>
        <div class="form-row">
          <div class="form-field">
            <label class="form-label" for="cargo">Cargo</label>
            <input type="text" id="cargo" class="form-input" placeholder="Seu cargo">
          </div>
          <div class="form-field">
            <label class="form-label" for="instagram">Instagram</label>
            <input type="text" id="instagram" class="form-input" placeholder="@seudepartamento">
          </div>
        </div>
        <div class="form-row">
          <div class="form-field">
            <label class="form-label" for="categoria">Categoria</label>
            <select id="categoria" class="form-select">
              <option value="" disabled selected>Selecione</option>
              <option value="hotelaria">Hotelaria</option>
              <option value="gastronomia">Gastronomia</option>
              <option value="lifestyle">Lifestyle</option>
              <option value="outro">Outro</option>
            </select>
          </div>
          <div class="form-field">
            <label class="form-label" for="equipe">Equipe</label>
            <select id="equipe" class="form-select">
              <option value="" disabled selected>Selecione</option>
              <option value="1-5">1 a 5 pessoas</option>
              <option value="5-15">5 a 15 pessoas</option>
              <option value="15-50">15 a 50 pessoas</option>
              <option value="50+">Mais de 50 pessoas</option>
            </select>
          </div>
        </div>
        <div class="form-field">
          <label class="form-label" for="projeto">Descreva seu projeto</label>
          <textarea id="projeto" class="form-textarea" placeholder="Conte um pouco sobre o que você precisa..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary form-submit">Enviar</button>
      </form>
      <div class="form-success" id="formSuccess" style="display:none;">
        <div class="form-success-icon">&#10003;</div>
        <p class="body">Recebemos sua mensagem!<br>Entraremos em contato em até 24h.</p>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
