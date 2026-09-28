/**
 * Verifica se todo caminho referenciado nos HTML/CSS existe no disco,
 * e se todo link interno aponta para uma pagina que existe.
 * Roda depois de build-pages.js.
 */

const fs = require('fs');
const path = require('path');

const ROOT = 'C:/Users/jmgvh/Desktop/Github/Cromo-WebsiteTemplate/site';

const htmlFiles = [];
(function walk(dir) {
  for (const e of fs.readdirSync(dir, { withFileTypes: true })) {
    if (e.name === '_data') continue;
    const p = path.join(dir, e.name);
    if (e.isDirectory()) walk(p);
    else if (e.name.endsWith('.html')) htmlFiles.push(p);
  }
})(ROOT);

let bad = 0;
const missingAssets = new Set();
const deadLinks = new Set();

/** resolve um path de raiz (/assets/x) para arquivo; null se nao for asset */
function assetExists(p) {
  return fs.existsSync(path.join(ROOT, p.replace(/^\//, '')));
}

for (const file of htmlFiles) {
  const html = fs.readFileSync(file, 'utf8');
  const rel = path.relative(ROOT, file).replace(/\\/g, '/');

  // --- URLs de asset: src=, poster=, background-image:url(), <source src>
  const assetRefs = new Set();
  for (const m of html.matchAll(/(?:src|poster)\s*=\s*"([^"]+)"/g)) assetRefs.add(m[1]);
  for (const m of html.matchAll(/url\(['"]?(\/[^'")]+)['"]?\)/g)) assetRefs.add(m[1]);
  for (const m of html.matchAll(/href\s*=\s*"(\/assets\/[^"]+)"/g)) assetRefs.add(m[1]);

  for (const ref of assetRefs) {
    if (/^(https?:|data:|#|mailto:|tel:)/.test(ref)) continue;
    if (!assetExists(ref)) {
      missingAssets.add(`${ref}   <- ${rel}`);
      bad++;
    }
  }

  // --- links internos de pagina
  for (const m of html.matchAll(/href\s*=\s*"(\/[^"]*)"/g)) {
    const href = m[1];
    if (href.startsWith('/assets/')) continue;
    if (/^(\/|#[^/])/.test(href) && !href.includes('.')) {
      // rota estatica: precisa existir como <rota>/index.html
      const clean = href.split('#')[0].split('?')[0];
      if (clean === '' || clean === '/') continue;
      const candidates = [path.join(ROOT, clean, 'index.html'), path.join(ROOT, clean)];
      if (!candidates.some(c => fs.existsSync(c))) {
        deadLinks.add(`${href}   <- ${rel}`);
        bad++;
      }
    }
  }
}

// --- CSS: fontes referenciadas (../fonts/x a partir de assets/css/)
const css = fs.readFileSync(path.join(ROOT, 'assets/css/style.css'), 'utf8');
for (const m of css.matchAll(/url\(['"]?(\.\.\/[^'")]+)['"]?\)/g)) {
  // path.join normaliza o "..": assets/css + ../fonts/x -> assets/fonts/x
  const p = path.join(ROOT, 'assets/css', m[1]);
  if (!fs.existsSync(p)) {
    missingAssets.add(`${m[1]} (em style.css)`);
    bad++;
  }
}

console.log(`arquivos .html analisados: ${htmlFiles.length}`);
if (missingAssets.size) {
  console.log(`\nASSETS FALTANDO (${missingAssets.size}):`);
  [...missingAssets].forEach(x => console.log('  ' + x));
} else console.log('\nassets: todos os caminhos resolvem');

if (deadLinks.size) {
  console.log(`\nLINKS INTERNOS QUEBRADOS (${deadLinks.size}):`);
  [...deadLinks].forEach(x => console.log('  ' + x));
} else console.log('links internos: todos resolvem');

console.log(bad === 0 ? '\nOK: nada quebrado' : `\n${bad} problema(s)`);
