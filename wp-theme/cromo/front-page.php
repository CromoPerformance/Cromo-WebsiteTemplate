<?php get_header(); ?>

<section class="hero" id="hero">
  <img src="<?php echo esc_url(cromo_img('hero_desktop', 'hero.avif')); ?>"
       alt="Studio Cromo" class="hero-bg hero-bg-desktop" loading="eager" fetchpriority="high">
  <img src="<?php echo esc_url(cromo_img('hero_mobile', 'hero.avif')); ?>"
       alt="Studio Cromo" class="hero-bg hero-bg-mobile" loading="eager" fetchpriority="high">
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <div class="hero-left">
      <h1 class="h1">
        <?php
        $lines = cromo_get('hero_title_lines', []);
        if (is_array($lines)) foreach ($lines as $line):
          $weight = $line['weight'] ?: '900';
          $size = $line['size'] ?? '';
          $color = $line['color'] ?? '';
          $style = 'font-weight:' . esc_attr($weight) . ';';
          if ($size) $style .= 'font-size:' . esc_attr($size) . ';';
          if ($color) $style .= 'color:' . esc_attr($color) . ';';
        ?>
          <span style="<?php echo esc_attr($style); ?>"><?php echo esc_html($line['text'] ?? ''); ?></span>
        <?php endforeach; ?>
      </h1>
      <p class="body"><?php echo esc_html(cromo_get('hero_desc')); ?></p>
      <div style="display:flex;gap:0.75rem;">
        <?php if (cromo_get('hero_btn1_text')): ?>
          <a href="<?php echo esc_url(cromo_get('hero_btn1_url', '#contato')); ?>" class="btn btn-primary">
            <?php echo esc_html(cromo_get('hero_btn1_text')); ?>
          </a>
        <?php endif; ?>
        <?php if (cromo_get('hero_btn2_text')): ?>
          <a href="<?php echo esc_url(cromo_get('hero_btn2_url', '#portfolio')); ?>" class="btn btn-outline">
            <?php echo esc_html(cromo_get('hero_btn2_text')); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
    <div class="hero-right">
      <span class="hero-stat">
        <?php echo esc_html(cromo_get('hero_stat_num', '300')); ?>
        <span class="hero-stat-suffix"><?php echo esc_html(cromo_get('hero_stat_suffix', '+')); ?></span>
      </span>
      <span class="hero-stat-label">
        <?php echo nl2br(esc_html(cromo_get('hero_stat_label', "Hotéis & Restaurantes\natendidos desde 2019"))); ?>
      </span>
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

<div class="section stats-header">
  <div class="container" style="text-align:center;">
    <span class="eyebrow"><?php echo esc_html(cromo_get('stats_eyebrow', 'Métricas')); ?></span>
    <h2 class="h2" style="font-size: clamp(1.5rem, 4vw, 2.5rem);">
      <?php echo esc_html(cromo_get('stats_title', 'Números que falam por si')); ?>
    </h2>
  </div>
</div>

<section class="stats-section">
  <div class="container">
    <?php $stats = cromo_get('stats_items', []); if (is_array($stats) && count($stats)): ?>
    <div class="stats-grid-alt">
      <?php $d = 0; foreach ($stats as $s): ?>
      <div class="stat-item reveal" style="<?php echo $d > 0 ? 'transition-delay:' . $d . 's;' : ''; ?>">
        <span class="stat-num"><?php echo esc_html($s['number'] ?? ''); ?></span>
        <p class="stat-desc"><?php echo esc_html($s['description'] ?? ''); ?></p>
      </div>
      <?php $d += 0.15; endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<section id="metodologia">
  <?php $steps = cromo_get('meth_steps', []); if (is_array($steps) && count($steps)): ?>
  <div class="methodology-grid">
    <div class="method-sticky">
      <span class="eyebrow"><?php echo esc_html(cromo_get('meth_eyebrow', 'Como fazemos')); ?></span>
      <h2 class="h2" style="font-size: clamp(2.5rem, 4vw, 3.5rem);">
        <?php echo esc_html(cromo_get('meth_title', 'Metodologia')); ?>
      </h2>
      <p class="body-sm" style="margin-top:1rem;">
        <?php echo esc_html(cromo_get('meth_desc', 'Cinco passos para transformar sua marca em referência visual.')); ?>
      </p>
    </div>
    <div class="method-steps">
      <?php foreach ($steps as $step): ?>
      <div class="method-step reveal">
        <span class="method-num">/ <?php echo esc_html($step['number'] ?? ''); ?></span>
        <h3 class="h3"><?php echo esc_html($step['title'] ?? ''); ?></h3>
        <p class="body"><?php echo esc_html($step['description'] ?? ''); ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>
</section>

<div class="section clients-header">
  <div class="container">
    <span class="eyebrow"><?php echo esc_html(cromo_get('clients_eyebrow', 'Parceiros')); ?></span>
    <h2 class="h2" style="font-size: clamp(1.8rem, 4vw, 3rem);">
      <?php echo esc_html(cromo_get('clients_title', 'Marcas que confiam na Cromo')); ?>
    </h2>
  </div>
</div>

<?php $clients = cromo_get('clients_list', []); if (is_array($clients) && count($clients)): ?>
<div class="clients-section">
  <div class="marquee">
    <div class="marquee-track">
      <?php foreach (array_merge($clients, $clients) as $c): ?>
      <span class="marquee-item"><?php echo esc_html($c['name'] ?? ''); ?></span>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>

<section id="contato" class="cta-section">
  <div class="cta-grid">
    <div class="cta-heading">
      <span class="eyebrow"><?php echo esc_html(cromo_get('contact_eyebrow', 'Contato')); ?></span>
      <h2 class="h2"><?php echo esc_html(cromo_get('contact_title', 'Vamos conversar?')); ?></h2>
      <p class="body"><?php echo esc_html(cromo_get('contact_desc', 'Conte-nos sobre seu projeto e descubra como podemos transformar sua comunicação visual.')); ?></p>
      <div>
        <?php $phone = cromo_get('contact_phone'); if ($phone): ?>
        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" class="btn btn-outline"><?php echo esc_html($phone); ?></a>
        <?php endif; ?>
        <?php $email = cromo_get('contact_email'); if ($email): ?>
        <a href="mailto:<?php echo esc_attr($email); ?>" class="btn btn-outline"><?php echo esc_html($email); ?></a>
        <?php endif; ?>
        <?php $insta = cromo_get('contact_insta'); if ($insta): ?>
        <a href="https://instagram.com/<?php echo esc_attr(ltrim($insta, '@')); ?>" target="_blank" class="btn btn-outline"><?php echo esc_html($insta); ?></a>
        <?php endif; ?>
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
