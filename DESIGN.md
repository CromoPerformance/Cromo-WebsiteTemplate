# 🎨 CROMO - DESIGN SYSTEM & ARCHITECTURE

## IDENTIDADE VISUAL (Do Media Kit)

### Paleta de Cores
```
PRIMARY:     #000000 (Preto absoluto - marca)
SECONDARY:   #FFFFFF (Branco - breathing room)
ACCENT:      #D4AF37 (Ouro luxo - CTA e destaque)
DARK_BG:     #1A1A1A (Fundo escuro alternativo)
TEXT_LIGHT:  #F5F5F5 (Cinza muito claro)
TEXT_MUTED:  #999999 (Cinza médio)
```

### Tipografia
```
HEADLINE:    Inter Bold / 56-72px (hero, títulos)
SUBTITLE:    Inter Semibold / 28-32px (seções)
BODY:        Inter Regular / 16-18px (copy)
CAPTION:     Inter Regular Italic / 14-16px (subtítulos editoriais)
ACCENT_TEXT: Inter Bold / 14px (labels, CTAs)
```

### Características de Design
- ✅ Minimalismo extremo
- ✅ Muito espaço branco (padding 40px-80px)
- ✅ Imagens GRANDES e impactantes (full-width onde possível)
- ✅ Hierarquia clara com tipografia
- ✅ Sem gradientes, sem efeitos
- ✅ Hover effects sutis (fade, scale leve)
- ✅ Transições suaves (0.3s ease)
- ✅ Alto contraste (preto/branco)
- ✅ Espaçamento generoso entre elementos

---

## ARQUITETURA DO SITE

```
📄 Estrutura de Páginas

├── index.html (Home - Hero + Pitch)
├── sobre.html (Quem Somos + Equipe)
├── solucoes.html (Soluções - Grid interativo)
├── cronicas-panoramas.html (Projeto especial)
├── portfolio.html (Casos/Clientes - Galeria filtrada)
├── blog.html (Artigos editoriais)
└── contato.html (Formulário + Info)
```

---

## COMPONENTES PRINCIPAIS

### 1. Header/Navegação
- Logo "cromo" centered ou left-aligned
- Menu horizontal (desktop) / hamburger (mobile)
- CTA "Get in Touch" com background ouro
- Sticky ao scroll com efeito fade

### 2. Hero Section
- Imagem FULL-WIDTH (above the fold)
- Headline grande centered: "O que você precisa para se comunicar?"
- Subheadline em itálico
- CTA primária (ouro)
- Seta animada para scroll

### 3. Pitch Section (Quem Somos)
- Layout 2 colunas: Texto esquerda + Foto direita
- Texto bold em negrito para palavras-chave
- Foto grande e impactante
- Muito espaço em branco

### 4. Grid de Soluções
- 4 cards: Fotografia | Assessoria | Vídeo | Marketing
- Hover: scale(1.05) + sombra sutil
- Ícone + texto + imagem de fundo
- Transição suave

### 5. Linhas Editoriais
- 6 cards grandes (2x3 grid responsivo)
- Cada card: imagem grande + título overlay
- Hover: efeito de parallax leve
- Click leva para detalhe

### 6. Portfolio/Casos
- Galeria masonry (3-4 colunas)
- Filtros por categoria (Hotelaria, Food, Lifestyle)
- Lightbox ao clique
- Lazy-load de imagens

### 7. Numbers Section
- 4 métricas (300+ clientes, 50k-100k reach, etc)
- Estilo minimalista: apenas número + label
- Background alternado (preto/branco)

### 8. Equipe
- Grid de círculos (avatares)
- Nome + cargo
- Hover: card com bio breve

### 9. CTA Final
- Newsletter + contato lado a lado
- Ou just "Vamos criar conteúdo extraordinário juntos?"
- Imagem grande de background

### 10. Footer
- Contato: telefone + email + Instagram
- Links rápidos
- Logo pequena
- Copyright

---

## ANIMAÇÕES & INTERATIVIDADE

### Scroll Animations
- Fade in ao aparecer na viewport (AOS.js)
- Parallax suave em imagens hero
- Fade de elementos ao scroll (typing effect optional)

### Hover States
- Botões: background ouro, texto preto
- Cards: scale 1.02-1.05, shadow sutil
- Links: underline animado (width 0 → 100%)
- Imagens: zoom leve (1.02x) + fade

### Transições
- Duração padrão: 300ms
- Easing: cubic-bezier(0.4, 0, 0.2, 1)
- Smooth scroll ao clique

---

## BREAKPOINTS RESPONSIVOS

```
Mobile:  < 480px   (1 coluna, full-width)
Tablet:  480-768px (2 colunas)
Desktop: > 768px   (3-4 colunas, layouts complexos)
```

---

## IMAGENS & OTIMIZAÇÃO

### Estratégia
- Imagens em WebP (fallback JPG)
- Lazy-load (Intersection Observer API)
- srcset para responsividade
- Compressão sem perda (TinyPNG)

### Tamanhos
- Hero: 1920x1080 mín
- Card: 800x600 mín
- Thumbnail: 400x400 mín
- Logo: SVG ou PNG 300x100

---

## PERFORMANCE

```
Lighthouse Goals:
- Performance: > 90
- Accessibility: > 95
- Best Practices: > 95
- SEO: > 90

Técnicas:
✅ CSS minificado
✅ JS bundled com Vite
✅ Imagens otimizadas
✅ Critical CSS inlined
✅ Prefetch de fontes
✅ Caching headers
```

---

## CMS / WORDPRESS (Depois)

- Usar Elementor ou Brizy para migração
- Manter design system via CSS variables
- Implementar ACF para campos customizados
- Plugins: WP Rocket, Yoast SEO, MailerLite

---

## STACK FINAL

| Camada | Tecnologia | Justificativa |
|--------|-----------|---------------|
| Build | Vite | Rápido, moderno, HMR excelente |
| CSS | CSS3 + Variables | Sem overhead, full control |
| JS | Vanilla JS | Performance, sem dependências |
| Animations | GSAP + AOS.js | Smoothness profissional |
| Forms | Netlify Forms ou EmailJS | Sem backend necessário |
| Hosting | Netlify ou Vercel | Deploy automático, free SSL |
| SEO | Structured Data + Sitemap | Schema.org para rich snippets |

---

## PRÓXIMOS PASSOS

1. ✅ Criar protótipo HTML/CSS/JS baseado neste design
2. ✅ Testar responsividade (mobile-first)
3. ✅ Otimizar imagens do media kit
4. ✅ Integrar animations (GSAP + AOS)
5. ✅ Validar acessibilidade (WCAG AA)
6. ✅ Deploy no Netlify (você testa)
7. ✅ Feedback e ajustes
8. ✅ Migração para WordPress/Elementor