# PENDENCIAS - Tema Cromo

## Design / UX

- [ ] **Formulário de contato sem backend** — O `#ctaForm` tem botão "Enviar" mas não envia para lugar nenhum. Precisa de um handler (WP AJAX, CF7, ou redirecionar para WhatsApp/email). O div `.form-success` nunca aparece.
- [ ] **Vídeo hero com MIME type errado** — O `<source>` é `.mov` mas o `type` está `video/mp4`. Navegadores ignoram. Corrigir para `type="video/quicktime"` ou converter o vídeo para `.mp4`.
- [ ] **Language switcher só visual** — Muda o texto do botão (PT-BR/EN/ES) mas não muda conteúdo da página. Pode manter se for apenas visual por enquanto, mas precisa ser decidido.
- [ ] **Portfolio vazio se não tiver projetos** — Se o CPT `projeto` estiver vazio, o carousel fica vazio (só botões de navegação visíveis sem nenhum slide). Adicionar empty state ou esconder a seção.
- [ ] **Formulário sem validação visual** — Inputs não têm feedback de erro/suporte. Validação HTML5 básica existe (required) mas sem estilo customizado.
- [ ] **Botão "Ver Mais" no slide do carousel** — Funcional mas pode ser confuso se o projeto não tiver imagem hero (usa fallback genérico).

## Infra / Deploy (já documentado separadamente)

- Vídeo hero não vai pro deploy (.gitignore)
- GitHub Actions secrets precisam estar configurados
- Permalinks do WP precisam ser "Nome do post"
- Favicon ausente
- SEO meta tags ausentes
- Tracking (GA4/Meta Pixel) não instalado
