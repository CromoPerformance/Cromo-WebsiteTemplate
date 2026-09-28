/**
 * Gera o site estatico a partir de site/_data/content.json.
 *
 * Espelha a saida dos templates do tema WordPress:
 *   header.php + footer.php  -> partials()
 *   front-page.php           -> index.html
 *   page-hub.php             -> projetos/index.html
 *   single-projeto.php       -> projeto/<slug>/index.html
 *   404.php                  -> 404.html
 *
 * Paths sao absolutos de raiz (/assets/...) porque o site e servido na raiz
 * do dominio tanto em producao quanto em preview na Vercel.
 */

const fs = require('fs');
const path = require('path');

const ROOT = 'C:/Users/jmgvh/Desktop/Github/Cromo-WebsiteTemplate/site';
const data = JSON.parse(fs.readFileSync(path.join(ROOT, '_data/content.json'), 'utf8'));

const O = data.options;
const P = data.projetos;

const esc = (s) => String(s == null ? '' : s)
  .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
  .replace(/"/g, '&quot;').replace(/'/g, '&#039;');

const A = '/assets/';
const IMG = A + 'images/';
const year = new Date().getFullYear();

function ensure(dir) {
  fs.mkdirSync(dir, { recursive: true });
}

/* ─────────────────────────── header ─────────────────────────── */
function header(bodyClass, pageTitle, pageDesc) {
  const links = [
    ['/#about', 'nav_sobre', 'Sobre'],
    ['/#portfolio', 'nav_projetos', 'Projetos'],
    ['/#solucoes', 'nav_solucoes', 'Soluções'],
  ];
  const desktop = links.map(([h, k, t]) =>
    `    <a href="${h}" class="nav-link" data-i18n="${k}">${t}</a>`).join('\n');
  const mobile = links.map(([h, k, t]) =>
    `    <a href="${h}" class="mobile-link" data-i18n="${k}">${t}</a>`).join('\n');

  const chevron = `<svg width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.2"/></svg>`;
  const options = ['pt|Português', 'en|English', 'es|Español']
    .map(s => {
      const [l, n] = s.split('|');
      return `<button class="lang-option" data-lang="${l}">${n}</button>`;
    }).join('\n          ');

  return `<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#FFFFFF">
  <title>${esc(pageTitle)}</title>
  <meta name="description" content="${esc(pageDesc)}">
  <link rel="icon" href="${IMG}black-basic.avif" type="image/avif">
  <link rel="preload" as="image" href="${IMG}hero.avif">
  <link rel="stylesheet" href="${A}css/style.css">
</head>
<body class="${bodyClass}">

<nav class="site-nav">
  <div class="nav-left">
${desktop}
  </div>
  <a href="/" class="logo">
    <img src="${IMG}black-basic.avif" alt="Cromo" class="logo-img">
  </a>
  <div class="nav-right">
    <div class="lang-dropdown">
      <button class="lang-current" id="langToggle">
        <span>PT-BR</span>
        ${chevron}
      </button>
      <div class="lang-options" id="langOptions">
          ${options}
      </div>
    </div>
    <a href="/#contato" class="nav-cta" data-i18n="nav_contato">Contato</a>
  </div>
  <button class="hamburger" id="hamburger" aria-label="Abrir menu">
    <span></span>
    <span></span>
    <span></span>
  </button>
  <div class="mobile-menu" id="mobileMenu">
    <img src="${IMG}black-basic.avif" alt="Cromo" class="mobile-menu-logo" style="filter: invert(1);">
${mobile}
    <a href="/#contato" class="mobile-link mobile-cta" data-i18n="nav_contato">Contato</a>
    <div class="lang-dropdown" style="margin-top: 1rem;">
      <button class="lang-current" id="langToggleMobile">
        <span>PT-BR</span>
        ${chevron}
      </button>
      <div class="lang-options" id="langOptionsMobile">
          ${options}
      </div>
    </div>
  </div>
</nav>
`;
}

/* ─────────────────────────── footer ─────────────────────────── */
function footer() {
  return `
<footer class="footer">
  <div class="footer-brand">
    <a href="/" class="logo">
      <img src="/assets/${O.footer_logo}" alt="Cromo" class="logo-img" style="height:40px;">
    </a>
    <p class="body-sm" style="max-width:300px;" data-i18n="footer_desc">
      ${esc(O.footer_desc)}
    </p>
  </div>
  <div class="footer-col">
    <h4 class="h4" data-i18n="footer_nav">Navegação</h4>
    <a href="/#about" data-i18n="nav_sobre">Sobre</a>
    <a href="/#portfolio" data-i18n="nav_projetos">Projetos</a>
    <a href="/#solucoes" data-i18n="nav_solucoes">Soluções</a>
    <a href="/#contato" data-i18n="nav_contato">Contato</a>
  </div>
  <div class="footer-col">
    <h4 class="h4" data-i18n="footer_redes">Redes</h4>
    <a href="https://instagram.com/studiocromo" target="_blank" rel="noopener">Instagram</a>
    <a href="https://linkedin.com/company/studiocromo" target="_blank" rel="noopener">LinkedIn</a>
  </div>
  <div class="footer-col">
    <h4 class="h4" data-i18n="footer_contato">Contato</h4>
    <a href="mailto:studio.cromo.studio@gmail.com">
      studio.cromo.studio@gmail.com
    </a>
    <a href="tel:5521969032564">
      (21) 96903-2564
    </a>
  </div>
  <div class="footer-bottom">
    <span data-i18n="footer_copy">&copy; ${year} Studio Cromo. Todos os direitos reservados.</span>
    <span data-i18n="footer_local">Rio de Janeiro &mdash; Brasil</span>
  </div>
</footer>

<a href="https://wa.me/5521969032564" target="_blank" rel="noopener" class="whatsapp-float" aria-label="WhatsApp">
  <svg viewBox="0 0 32 32" fill="#fff" width="24" height="24">
    <path d="M16.004 0h-.008C7.174 0 0 7.176 0 16c0 3.5 1.132 6.744 3.054 9.374L1.054 31.25l6.118-1.97C9.706 30.836 12.752 32 16.004 32 24.83 32 32 24.822 32 16S24.83 0 16.004 0zm9.35 22.604c-.39 1.1-1.932 2.014-3.158 2.28-.84.18-1.936.322-5.596-1.202-4.686-1.95-7.692-6.71-7.922-7.02-.224-.31-1.824-2.43-1.824-4.636 0-2.204 1.156-3.286 1.566-3.734.39-.426.946-.54 1.26-.54.31 0 .62.002.89.016.284.014.664-.106 1.036.79.39.936 1.33 3.236 1.446 3.47.116.234.194.506.038.816-.156.312-.232.506-.464.78-.234.274-.49.612-.7.818-.234.234-.476.486-.204.958.272.472 1.208 1.99 2.596 3.224 1.784 1.586 3.29 2.078 3.762 2.31.472.234.746.194 1.02-.116.274-.31 1.168-1.36 1.48-1.834.312-.472.624-.39 1.056-.234.434.156 2.752 1.298 3.224 1.532.472.234.786.35.904.544.116.194.116 1.12-.274 2.218z"/>
  </svg>
</a>

<script src="${A}js/scripts.js"></script>
</body>
</html>
`;
}

/* ─────────────────────────── home ─────────────────────────── */
function home() {
  const slides = P.map((p, i) => {
    const bg = p.hero ? IMG + p.hero.replace(/^images\//, '') : IMG + 'hero.avif';
    const label = p.location || p.cat || '';
    return `    <div class="portfolio-slide${i === 0 ? ' active' : ''}" data-index="${i}">
      <div class="portfolio-slide-bg" style="background-image:url('${bg}')"></div>
      <div class="portfolio-slide-overlay"></div>
      <div class="portfolio-slide-content">
        ${label ? `<span class="portfolio-slide-cat">${esc(label)}</span>` : ''}
        <h2 class="portfolio-slide-title">${esc(p.title)}</h2>
        <a href="/projeto/${p.slug}/" class="btn btn-white btn-slide" data-i18n="portfolio_btn">Ver Mais</a>
      </div>
    </div>`;
  }).join('\n');

  const dots = Array.from({ length: P.length }, (_, i) =>
    `      <button class="portfolio-dot${i === 0 ? ' active' : ''}" data-index="${i}"></button>`).join('\n');

  const total = String(P.length).padStart(2, '0');

  const solucoes = [
    ['01', 'sol1_title', 'Fotografia', 'sol1_desc', 'Imagens que contam a história da sua marca com identidade visual autêntica e sofisticada.'],
    ['02', 'sol2_title', 'Vídeo', 'sol2_desc', 'Produção audiovisual que emociona e conecta, do conceito à entrega final.'],
    ['03', 'sol3_title', 'Comunicação', 'sol3_desc', 'Estratégia de conteúdo e posicionamento que fortalece sua presença no mercado.'],
    ['04', 'sol4_title', 'Marketing', 'sol4_desc', 'Campanhas digitais focadas em performance, engajamento e resultados mensuráveis.'],
  ].map(([n, tk, tt, dk, dd]) => `      <div class="solution-card">
        <span class="solution-num">${n}</span>
        <h4 class="h4" data-i18n="${tk}">${tt}</h4>
        <p class="body-sm" data-i18n="${dk}">${dd}</p>
      </div>`).join('\n');

  const selOpts = (pairs) => pairs.map(([v, k, l]) =>
    `<button type="button" class="custom-select-option" data-value="${v}" data-i18n="${k}">${l}</button>`).join('\n');
  const selHidden = (pairs) => pairs.map(([v, l]) =>
    `<option value="${v}">${l}</option>`).join('');

  const cats = [['hotelaria', 'cat_hotelaria', 'Hotelaria'], ['gastronomia', 'cat_gastronomia', 'Gastronomia'], ['lifestyle', 'cat_lifestyle', 'Lifestyle'], ['outro', 'cat_outro', 'Outro']];
  const eqs = [['1-5', 'eq_1a5', '1 a 5 pessoas'], ['5-15', 'eq_5a15', '5 a 15 pessoas'], ['15-50', 'eq_15a50', '15 a 50 pessoas'], ['50+', 'eq_50mais', 'Mais de 50 pessoas']];

  const body = `
<section class="hero" id="hero">
  <video class="hero-video" autoplay muted playsinline loop preload="auto" poster="${A}videos/hero-poster.jpg" id="heroVideo">
    <source src="${A}videos/hero.mp4" type="video/mp4">
  </video>
  <div class="hero-overlay"></div>

  <div class="hero-content">
    <p class="hero-eyebrow" data-i18n="hero_eyebrow">COMUNICAÇÃO ESTRATÉGICA PARA</p>
    <h1 class="hero-title">
      <span data-i18n="hero_line1">HOTELARIA</span>
      <span data-i18n="hero_line2">&amp; GASTRONOMIA</span>
    </h1>
    <div class="hero-buttons">
      <a href="#contato" class="btn-hero btn-hero-primary" data-i18n="hero_btn1">COMEÇAR PROJETO</a>
      <a href="#about" class="btn-hero btn-hero-outline" data-i18n="hero_btn2">CONHECER CROMO</a>
    </div>
  </div>

  <div class="hero-metrics" id="heroMetrics">
    <div class="hero-metric">
      <span class="hero-metric-num" data-target="290" data-suffix="+">0</span>
      <span class="hero-metric-label" data-i18n="hero_stat1">PROJETOS ENTREGUES</span>
    </div>
    <div class="hero-metric">
      <span class="hero-metric-num hero-metric-text">AVAILABLE<br>WORLDWIDE</span>
    </div>
    <div class="hero-metric">
      <span class="hero-metric-num" data-target="6" data-suffix="">0</span>
      <span class="hero-metric-label" data-i18n="hero_stat2">ANOS DE MERCADO</span>
    </div>
  </div>
</section>

<div class="section" id="about">
  <div class="container">
    <div class="about-grid">
      <div class="about-content">
        <span class="eyebrow" data-i18n="about_eyebrow">${esc(O.about_eyebrow)}</span>
        <h2 class="h2 about-title" data-i18n="about_title">${esc(O.about_title)}</h2>
        <p class="about-subtitle" data-i18n="about_subtitle">${esc(O.about_subtitle)}</p>
        ${O.about_desc1 ? `<p class="body" style="margin-bottom:1.5rem;" data-i18n="about_desc1">${esc(O.about_desc1)}</p>` : ''}
        ${O.about_desc2 ? `<p class="body" data-i18n="about_desc2">${esc(O.about_desc2)}</p>` : ''}
        <a href="#contato" class="btn btn-outline about-btn" data-i18n="about_btn">Conheça a Cromo</a>
      </div>
      <div class="about-image-wrapper">
        <img src="/assets/${O.about_image}" alt="Studio Cromo" class="about-image" loading="lazy" decoding="async">
        <div class="about-image-info">
          <h3 class="about-image-name" data-i18n="about_name">Renan Blaute</h3>
          <p class="about-image-role" data-i18n="about_role">Sócio e Diretor Criativo</p>
          <p class="about-image-desc" data-i18n="about_desc_role">Hotel &amp; food photographer. Apaixonado por viagens e boas experiências.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<section id="portfolio" class="portfolio-fullscreen">
  <a href="/projetos/" class="portfolio-label" data-i18n="nav_projetos">Projetos</a>
  <div class="portfolio-carousel" id="portfolioCarousel">
${slides}

    <div class="portfolio-nav">
      <button class="portfolio-nav-btn portfolio-prev" id="portfolioPrev">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 18l-6-6 6-6"/></svg>
      </button>
      <div class="portfolio-counter">
        <span class="portfolio-current">01</span>
        <span class="portfolio-sep">/</span>
        <span class="portfolio-total">${total}</span>
      </div>
      <button class="portfolio-nav-btn portfolio-next" id="portfolioNext">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 18l6-6-6-6"/></svg>
      </button>
    </div>

    <div class="portfolio-dots" id="portfolioDots">
${dots}
    </div>
  </div>
</section>

<div id="solucoes" class="section solucoes-bg">
  <div class="container">
    <span class="eyebrow" data-i18n="sol_eyebrow">${esc(O.sol_eyebrow)}</span>
    <h2 class="h2" data-i18n="sol_title">${esc(O.sol_title)}</h2>
    <div class="solutions-grid">
${solucoes}
    </div>
  </div>
</div>

<section id="contato" class="cta-section">
  <div class="cta-grid">
    <div class="cta-heading">
      <span class="eyebrow" data-i18n="contact_eyebrow">${esc(O.contact_eyebrow)}</span>
      <h2 class="h2" data-i18n="contact_title">${esc(O.contact_title)}</h2>
      <p class="body" data-i18n="contact_desc">${esc(O.contact_desc)}</p>
      <div>
        <a href="https://wa.me/5521969032564" target="_blank" rel="noopener" class="btn btn-primary" data-i18n="contact_btn">Fale Conosco</a>
      </div>
    </div>
    <div>
      <form class="cta-form" id="ctaForm" novalidate>
        <div class="form-row">
          <div class="form-field">
            <label class="form-label" for="nome" data-i18n="form_nome">Nome</label>
            <input type="text" id="nome" name="nome" class="form-input" placeholder="Seu nome" required data-i18n-ph="ph_nome">
            <span class="field-error" data-i18n="err_nome">Nome é obrigatório</span>
          </div>
          <div class="form-field">
            <label class="form-label" for="email" data-i18n="form_email">Email</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="seu@email.com" required data-i18n-ph="ph_email">
            <span class="field-error" data-i18n="err_email">Email inválido</span>
          </div>
        </div>
        <div class="form-row">
          <div class="form-field">
            <label class="form-label" for="whatsapp" data-i18n="form_whatsapp">WhatsApp</label>
            <input type="tel" id="whatsapp" name="whatsapp" class="form-input phone-input" placeholder="(21) 99999-9999" data-i18n-ph="ph_whatsapp">
            <span class="field-error" data-i18n="err_phone">Telefone inválido</span>
          </div>
          <div class="form-field">
            <label class="form-label" for="empresa" data-i18n="form_empresa">Empresa</label>
            <input type="text" id="empresa" name="empresa" class="form-input" placeholder="Nome da empresa" data-i18n-ph="ph_empresa">
          </div>
        </div>
        <div class="form-row">
          <div class="form-field">
            <label class="form-label" for="cargo" data-i18n="form_cargo">Cargo</label>
            <input type="text" id="cargo" name="cargo" class="form-input" placeholder="Seu cargo" data-i18n-ph="ph_cargo">
          </div>
          <div class="form-field">
            <label class="form-label" for="instagram" data-i18n="form_instagram">Instagram</label>
            <input type="text" id="instagram" name="instagram" class="form-input" placeholder="@seudepartamento" data-i18n-ph="ph_instagram">
          </div>
        </div>
        <div class="form-row">
          <div class="form-field">
            <label class="form-label" for="categoria" data-i18n="form_categoria">Categoria</label>
            <div class="custom-select" data-name="categoria">
              <button type="button" class="form-select custom-select-trigger"><span data-i18n="sel_selecione">Selecione</span><svg width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.2"/></svg></button>
              <div class="custom-select-options">
                ${selOpts(cats)}
              </div>
              <select name="categoria" class="form-select-hidden" tabindex="-1" aria-hidden="true"><option value="" disabled selected>Selecione</option>${selHidden(cats)}</select>
            </div>
          </div>
          <div class="form-field">
            <label class="form-label" for="equipe" data-i18n="form_equipe">Equipe</label>
            <div class="custom-select" data-name="equipe">
              <button type="button" class="form-select custom-select-trigger"><span data-i18n="sel_selecione">Selecione</span><svg width="10" height="6" viewBox="0 0 10 6" fill="none"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.2"/></svg></button>
              <div class="custom-select-options">
                ${selOpts(eqs)}
              </div>
              <select name="equipe" class="form-select-hidden" tabindex="-1" aria-hidden="true"><option value="" disabled selected>Selecione</option>${selHidden(eqs)}</select>
            </div>
          </div>
        </div>
        <div class="form-field">
          <label class="form-label" for="projeto" data-i18n="form_projeto">Descreva seu projeto</label>
          <textarea id="projeto" name="projeto" class="form-textarea" placeholder="Conte um pouco sobre o que você precisa..." data-i18n-ph="ph_projeto"></textarea>
        </div>
        <button type="submit" class="btn btn-primary form-submit" data-i18n="form_submit">Enviar</button>
      </form>
      <div class="form-success" id="formSuccess" style="display:none;">
        <div class="form-success-icon">&#10003;</div>
        <p class="body" data-i18n="form_soon">Estamos preparando este formulário. Enquanto isso, fale com a gente pelo WhatsApp.</p>
      </div>
    </div>
  </div>
</section>
`;
  return header('home', 'Studio Cromo — Comunicação Estratégica para Hotelaria & Gastronomia',
    'Fotografia, vídeo, assessoria de imprensa e marketing de performance para marcas premium de hotelaria, gastronomia e lifestyle de luxo.') + body + footer();
}

/* ─────────────────────────── hub ─────────────────────────── */
function hub() {
  const items = P.map((p, i) => {
    const bg = p.hero ? IMG + p.hero.replace(/^images\//, '') : IMG + 'hero.avif';
    const label = p.location || p.cat || '';
    return `      <a href="/projeto/${p.slug}/" class="hub-item hub-item-${i % 6}" data-cat="${esc(p.cat)}">
        <div class="hub-item-img">
          <img src="${bg}" alt="${esc(p.title)}" loading="lazy" decoding="async">
        </div>
        <div class="hub-item-overlay">
          ${label ? `<span class="hub-item-cat">${esc(label)}</span>` : ''}
          <h3 class="hub-item-title">${esc(p.title)}</h3>
        </div>
      </a>`;
  }).join('\n');

  const body = `
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
${items}
    </div>
  </div>
</main>
`;
  return header('page page-hub page-template-page-hub', 'Projetos — Studio Cromo',
    'Portfólio de fotografia e vídeo para hotelaria e gastronomia de luxo.') + body + footer();
}

/* ─────────────────────── projeto (single) ─────────────────────── */
function projeto(p, nextP) {
  // Mesma logica de single-projeto.php: ciclo de colunas 3, 4, 3, 4...
  const colPatterns = [3, 4];
  const rows = [];
  let i = 0, pat = 0;
  while (i < p.gallery.length) {
    const cols = colPatterns[pat % colPatterns.length];
    const imgs = [];
    for (let c = 0; c < cols && i < p.gallery.length; c++) imgs.push(p.gallery[i++]);
    rows.push({ cols, imgs });
    pat++;
  }

  const galleryHtml = rows.map(r => `    <div class="proj-row proj-row-${r.cols}col">
${r.imgs.map(u => `      <img src="${IMG + u.replace(/^images\//, '')}" alt="${esc(p.title)}" loading="lazy" decoding="async">`).join('\n')}
    </div>`).join('\n');

  const meta = [p.cat, p.location].filter(Boolean).map(esc).join(' / ');
  const heroSrc = p.hero ? IMG + p.hero.replace(/^images\//, '') : IMG + 'hero.avif';

  const body = `
<section class="proj-hero">
  <img src="${heroSrc}" alt="${esc(p.title)}">
  <div class="proj-hero-overlay">
    <div class="proj-hero-content">
      ${meta ? `<span class="proj-hero-cat">${meta}</span>` : ''}
      <h1 class="proj-hero-title">${esc(p.title)}</h1>
    </div>
  </div>
</section>

<a href="/projetos/" class="proj-back-btn" aria-label="Voltar">
  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
</a>

<div class="proj-gallery">
${galleryHtml}
</div>

<a href="/projeto/${nextP.slug}/" class="proj-next">
  <span class="proj-next-label">Próximo projeto</span>
  <span class="proj-next-title">${esc(nextP.title)}</span>
</a>
`;
  return header('single-projeto', `${p.title} — Studio Cromo`,
    `${p.title}${p.cat ? ' · ' + p.cat : ''} — projeto de fotografia e comunicação visual pela Studio Cromo.`) + body + footer();
}

/* ─────────────────────────── 404 ─────────────────────────── */
function notFound() {
  return header('error404', 'Página não encontrada — Studio Cromo', 'A página que você procura não existe.')
    + `
<main class="hub">
  <div class="hub-container">
    <header class="hub-header">
      <div class="hub-intro">
        <div class="hub-intro-text">
          <h1 class="hub-title">404</h1>
          <p class="hub-desc">Não encontramos esta página. Volte para a <a href="/">home</a> ou veja os <a href="/projetos/">projetos</a>.</p>
        </div>
      </div>
    </header>
  </div>
</main>
` + footer();
}

/* ─────────────────────────── write ─────────────────────────── */
const written = [];

function write(rel, html) {
  const p = path.join(ROOT, rel);
  ensure(path.dirname(p));
  fs.writeFileSync(p, html, 'utf8');
  written.push([rel, (Buffer.byteLength(html) / 1024).toFixed(1) + ' KB']);
}

write('index.html', home());
write('projetos/index.html', hub());

P.forEach((p, idx) => {
  // "proximo": o mais antigo que nao seja o atual (como o fallback do PHP)
  const older = P.slice().reverse().find(x => x.id !== p.id);
  const byNext = p.next ? P.find(x => x.id === p.next) : null;
  const nextP = byNext || older || P[0];
  write(`projeto/${p.slug}/index.html`, projeto(p, nextP));
});

write('404.html', notFound());

console.log('paginas geradas:');
written.forEach(([f, s]) => console.log(`  ${s.padStart(10)}  ${f}`));
console.log(`\ntotal: ${written.length} arquivos`);
