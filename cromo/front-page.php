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

<div id="solucoes" class="section">
  <div class="container">
    <span class="eyebrow"><?php echo esc_html(cromo_get('sol_eyebrow', 'O que fazemos')); ?></span>
    <h2 class="h2"><?php echo esc_html(cromo_get('sol_title', 'Soluções integradas para potencializar sua marca')); ?></h2>
    <?php $sol_items = cromo_get('sol_items', []); if (is_array($sol_items) && count($sol_items)): ?>
    <div class="solutions-grid">
      <?php foreach ($sol_items as $item): ?>
      <div class="solution-card">
        <span class="solution-num"><?php echo esc_html($item['number'] ?? ''); ?></span>
        <h4 class="h4"><?php echo esc_html($item['title'] ?? ''); ?></h4>
        <p class="body-sm"><?php echo esc_html($item['description'] ?? ''); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</div>

<section id="portfolio" class="section-border">
  <div class="portfolio-grid">
    <div class="portfolio-sticky">
      <span class="eyebrow"><?php echo esc_html(cromo_get('port_eyebrow', 'Projetos')); ?></span>
      <h2 class="h2" style="font-size: clamp(2.5rem, 5vw, 4rem);">
        <?php echo nl2br(esc_html(cromo_get('port_title', "Nosso\nPortfólio"))); ?>
      </h2>
      <p class="body-sm" style="margin: 1.5rem 0;">
        <?php echo esc_html(cromo_get('port_desc', 'Casos selecionados que mostram o poder da comunicação visual estratégica.')); ?>
      </p>
      <a href="<?php echo esc_url(home_url('/projeto')); ?>" class="btn btn-outline" style="padding: 0.75rem 2rem; font-size: 0.7rem; display: inline-flex; align-items: center; justify-content: center;">
        <?php echo esc_html(cromo_get('port_btn', 'Ver Todos')); ?>
      </a>
    </div>
    <div class="portfolio-scroll">
      <?php
      $projetos = get_posts(['post_type' => 'projeto', 'posts_per_page' => 6, 'orderby' => 'date', 'order' => 'DESC']);
      foreach ($projetos as $projeto):
        $hero = get_post_meta($projeto->ID, '_cromo_hero', true);
        if (!$hero) $hero = get_the_post_thumbnail_url($projeto->ID, 'full');
        $cat  = get_post_meta($projeto->ID, '_cromo_cat', true);
      ?>
      <a href="<?php echo esc_url(get_permalink($projeto->ID)); ?>" class="case-item reveal" style="text-decoration:none;color:inherit;">
        <div class="case-img-wrapper">
          <img src="<?php echo esc_url($hero ?: get_template_directory_uri() . '/assets/images/hero.avif'); ?>"
               alt="<?php echo esc_attr($projeto->post_title); ?>" class="case-img" loading="lazy" decoding="async">
        </div>
        <div class="case-info">
          <h3 class="h3"><?php echo esc_html($projeto->post_title); ?></h3>
          <p class="case-sub"><?php echo $cat ? '@ ' . esc_html($cat) : ''; ?></p>
        </div>
      </a>
      <?php endforeach; wp_reset_postdata(); ?>
    </div>
  </div>
</section>

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
