<?php
define('CROMO_VERSION', '1.0.0');

// ─── Theme Setup ───
add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

  register_nav_menus([
    'primary' => __('Menu Principal', 'cromo'),
  ]);
});

// ─── Assets ───
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('cromo', get_template_directory_uri() . '/assets/css/style.css', [], CROMO_VERSION);
  wp_enqueue_script('cromo', get_template_directory_uri() . '/assets/js/scripts.js', [], CROMO_VERSION, true);
});

// ─── CPT: Projeto ───
add_action('init', function () {
  register_post_type('projeto', [
    'labels' => [
      'name' => __('Projetos', 'cromo'),
      'singular_name' => __('Projeto', 'cromo'),
      'add_new_item' => __('Adicionar Novo Projeto', 'cromo'),
      'edit_item' => __('Editar Projeto', 'cromo'),
      'view_item' => __('Ver Projeto', 'cromo'),
      'search_items' => __('Buscar Projetos', 'cromo'),
      'not_found' => __('Nenhum projeto encontrado', 'cromo'),
      'not_found_in_trash' => __('Nenhum projeto na lixeira', 'cromo'),
    ],
    'public' => true,
    'has_archive' => true,
    'rewrite' => ['slug' => 'projeto'],
    'menu_icon' => 'dashicons-format-gallery',
    'supports' => ['title', 'editor', 'thumbnail'],
    'show_in_rest' => true,
  ]);
});

// ─── Meta Box: Projeto ───
add_action('add_meta_boxes', function () {
  add_meta_box('cromo_projeto_box', 'Dados do Projeto', function ($post) {
    wp_nonce_field('cromo_projeto_save', 'cromo_projeto_nonce');
    $hero = get_post_meta($post->ID, '_cromo_hero', true);
    $cat  = get_post_meta($post->ID, '_cromo_cat', true);
    $year = get_post_meta($post->ID, '_cromo_year', true);
    $next = get_post_meta($post->ID, '_cromo_next', true);
    $gallery = get_post_meta($post->ID, '_cromo_gallery', true) ?: [];
    ?>
    <style>
      .cromo-field { margin-bottom: 14px; }
      .cromo-field label { display: block; font-weight: 600; margin-bottom: 4px; }
      .cromo-field input, .cromo-field select { width: 100%; }
      .cromo-field .cromo-desc { color: #666; font-size: 12px; margin-top: 2px; }
      .gallery-row { background: #f6f7f7; border: 1px solid #ddd; padding: 12px; margin-bottom: 8px; border-radius: 3px; }
      .gallery-row-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; font-weight: 600; }
      .gallery-row-fields { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
      .gallery-row-fields.three-col { grid-template-columns: 1fr 1fr 1fr; }
      .gallery-row-fields.full-col { grid-template-columns: 1fr; }
      .gallery-row-fields label { display: block; font-size: 11px; color: #666; margin-bottom: 2px; }
      .gallery-row-fields input, .gallery-row-fields select { width: 100%; }
      .gallery-row .remove-row { color: #b32d2e; cursor: pointer; font-size: 12px; }
      .gallery-row .remove-row:hover { color: #d63638; }
      .add-row-btn { margin-top: 8px; }
    </style>
    <?php wp_enqueue_media(); ?>
    <div class="cromo-field">
      <label>Imagem Hero</label>
      <div style="display:flex;gap:6px;">
        <input type="text" name="cromo_hero" id="cromo_hero_input" value="<?php echo esc_attr($hero); ?>" placeholder="URL ou escolha na biblioteca" style="flex:1;">
        <button type="button" class="button" onclick="openMedia('cromo_hero_input')">Escolher</button>
      </div>
      <div class="cromo-desc">Imagem principal do topo da página do projeto</div>
    </div>
    <div class="cromo-field" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
      <div>
        <label>Categoria</label>
        <input type="text" name="cromo_cat" value="<?php echo esc_attr($cat); ?>" placeholder="Hotel, Gastronomia...">
      </div>
      <div>
        <label>Ano</label>
        <input type="text" name="cromo_year" value="<?php echo esc_attr($year); ?>" placeholder="2024">
      </div>
    </div>
    <div class="cromo-field">
      <label>Próximo Projeto (ID)</label>
      <input type="number" name="cromo_next" value="<?php echo esc_attr($next); ?>" placeholder="Deixe 0 para automático">
      <div class="cromo-desc">ID do post do próximo projeto na navegação</div>
    </div>
    <hr>
    <h4 style="margin:16px 0 8px;">Galeria</h4>
    <div id="cromo-gallery-wrap">
      <?php foreach ($gallery as $i => $row): $layout = $row['layout'] ?? 'full'; ?>
      <div class="gallery-row" data-index="<?php echo $i; ?>">
        <div class="gallery-row-head">
          <span>Linha <?php echo $i + 1; ?></span>
          <span class="remove-row" onclick="this.closest('.gallery-row').remove()">Remover</span>
        </div>
        <div style="margin-bottom:8px;">
          <select name="cromo_gallery[<?php echo $i; ?>][layout]" onchange="updateGalleryRow(this)">
            <option value="full" <?php selected($layout, 'full'); ?>>1 Imagem (Full)</option>
            <option value="two_equal" <?php selected($layout, 'two_equal'); ?>>2 Colunas Iguais</option>
            <option value="two_wide_left" <?php selected($layout, 'two_wide_left'); ?>>2 Colunas (Esq. maior)</option>
            <option value="two_wide_right" <?php selected($layout, 'two_wide_right'); ?>>2 Colunas (Dir. maior)</option>
            <option value="three_equal" <?php selected($layout, 'three_equal'); ?>>3 Colunas Iguais</option>
          </select>
        </div>
        <div class="gallery-row-fields <?php echo $layout === 'full' ? 'full-col' : ($layout === 'three_equal' ? 'three-col' : ''); ?>">
          <?php for ($img = 1; $img <= 3; $img++):
            $val = $row['img_' . $img] ?? '';
            $cls = $row['class_' . $img] ?? 'img-h';
            if ($layout === 'full' && $img > 1) continue;
            if (in_array($layout, ['two_equal', 'two_wide_left', 'two_wide_right']) && $img > 2) continue;
          ?>
          <div>
            <label>Imagem <?php echo $img; ?></label>
            <div style="display:flex;gap:4px;">
              <input type="text" name="cromo_gallery[<?php echo $i; ?>][img_<?php echo $img; ?>]" id="cromo_g_<?php echo $i; ?>_<?php echo $img; ?>" value="<?php echo esc_attr($val); ?>" placeholder="URL" style="flex:1;">
              <button type="button" class="button" style="font-size:11px;padding:0 8px;min-height:28px;line-height:26px;" onclick="openMedia('cromo_g_<?php echo $i; ?>_<?php echo $img; ?>')">+</button>
            </div>
            <select name="cromo_gallery[<?php echo $i; ?>][class_<?php echo $img; ?>]" style="margin-top:4px;">
              <option value="img-h" <?php selected($cls, 'img-h'); ?>>Horizontal (16:9)</option>
              <option value="img-v" <?php selected($cls, 'img-v'); ?>>Vertical (3:4)</option>
              <option value="img-sq" <?php selected($cls, 'img-sq'); ?>>Quadrado (1:1)</option>
              <option value="img-tall" <?php selected($cls, 'img-tall'); ?>>Retrato (4:5)</option>
            </select>
          </div>
          <?php endfor; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <button type="button" class="button add-row-btn" onclick="addGalleryRow()">+ Adicionar Linha</button>
    <script>
      function openMedia(inputId) {
        var frame = wp.media({ title: 'Selecionar imagem', multiple: false, library: { type: 'image' } });
        frame.on('select', function() {
          var url = frame.state().get('selection').first().toJSON().url;
          document.getElementById(inputId).value = url;
        });
        frame.open();
      }
      var galleryIndex = <?php echo count($gallery); ?>;
      function addGalleryRow() {
        var i = galleryIndex++;
        var h = '<div class="gallery-row" data-index="'+i+'">';
        h += '<div class="gallery-row-head"><span>Linha '+(i+1)+'</span><span class="remove-row" onclick="this.closest(\'.gallery-row\').remove()">Remover</span></div>';
        h += '<div style="margin-bottom:8px;"><select name="cromo_gallery['+i+'][layout]" onchange="updateGalleryRow(this)">';
        h += '<option value="full">1 Imagem (Full)</option><option value="two_equal">2 Colunas Iguais</option><option value="two_wide_left">2 Colunas (Esq. maior)</option><option value="two_wide_right">2 Colunas (Dir. maior)</option><option value="three_equal">3 Colunas Iguais</option>';
        h += '</select></div>';
        h += '<div class="gallery-row-fields full-col">';
        h += '<div><label>Imagem 1</label><div style="display:flex;gap:4px;"><input type="text" name="cromo_gallery['+i+'][img_1]" id="cromo_g_'+i+'_1" placeholder="URL" style="flex:1;"><button type="button" class="button" style="font-size:11px;padding:0 8px;min-height:28px;line-height:26px;" onclick="openMedia(\'cromo_g_'+i+'_1\')">+</button></div><select name="cromo_gallery['+i+'][class_1]" style="margin-top:4px;"><option value="img-h">Horizontal (16:9)</option><option value="img-v">Vertical (3:4)</option><option value="img-sq">Quadrado (1:1)</option><option value="img-tall">Retrato (4:5)</option></select></div>';
        h += '</div></div>';
        document.getElementById('cromo-gallery-wrap').insertAdjacentHTML('beforeend', h);
      }
      function updateGalleryRow(sel) {
        var row = sel.closest('.gallery-row');
        var fields = row.querySelector('.gallery-row-fields');
        var layout = sel.value;
        var cols = layout === 'full' ? 1 : (layout === 'three_equal' ? 3 : 2);
        var currentInputs = fields.querySelectorAll('div');
        if (currentInputs.length === cols) return;
        var i = parseInt(row.dataset.index);
        var h = '';
        for (var n = 1; n <= cols; n++) {
          h += '<div><label>Imagem '+n+'</label><div style="display:flex;gap:4px;"><input type="text" name="cromo_gallery['+i+'][img_'+n+']" id="cromo_g_'+i+'_'+n+'" placeholder="URL" style="flex:1;"><button type="button" class="button" style="font-size:11px;padding:0 8px;min-height:28px;line-height:26px;" onclick="openMedia(\'cromo_g_'+i+'_'+n+'\')">+</button></div><select name="cromo_gallery['+i+'][class_'+n+']" style="margin-top:4px;"><option value="img-h">Horizontal (16:9)</option><option value="img-v">Vertical (3:4)</option><option value="img-sq">Quadrado (1:1)</option><option value="img-tall">Retrato (4:5)</option></select></div>';
        }
        fields.className = 'gallery-row-fields' + (layout === 'full' ? ' full-col' : '') + (layout === 'three_equal' ? ' three-col' : '');
        fields.innerHTML = h;
      }
    </script>
    <?php
  }, 'projeto', 'normal', 'high');
});

add_action('save_post', function ($post_id) {
  if (!isset($_POST['cromo_projeto_nonce']) || !wp_verify_nonce($_POST['cromo_projeto_nonce'], 'cromo_projeto_save')) return;
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
  if (!current_user_can('edit_post', $post_id)) return;

  $fields = ['cromo_hero', 'cromo_cat', 'cromo_year'];
  foreach ($fields as $f) {
    if (isset($_POST[$f])) update_post_meta($post_id, '_' . $f, sanitize_text_field($_POST[$f]));
  }

  if (isset($_POST['cromo_next'])) {
    update_post_meta($post_id, '_cromo_next', intval($_POST['cromo_next']));
  }

  if (isset($_POST['cromo_gallery']) && is_array($_POST['cromo_gallery'])) {
    $clean = [];
    foreach ($_POST['cromo_gallery'] as $row) {
      $r = ['layout' => sanitize_text_field($row['layout'] ?? 'full')];
      $cols = $r['layout'] === 'full' ? 1 : ($r['layout'] === 'three_equal' ? 3 : 2);
      for ($n = 1; $n <= $cols; $n++) {
        $r['img_' . $n] = esc_url_raw($row['img_' . $n] ?? '');
        $r['class_' . $n] = sanitize_text_field($row['class_' . $n] ?? 'img-h');
      }
      $clean[] = $r;
    }
    update_post_meta($post_id, '_cromo_gallery', $clean);
  } else {
    delete_post_meta($post_id, '_cromo_gallery');
  }
});

// ─── Theme Options Page ───
add_action('admin_menu', function () {
  add_menu_page('Cromo - Home', 'Cromo Home', 'manage_options', 'cromo-home', function () {
    if (!current_user_can('manage_options')) return;
    if (isset($_POST['cromo_save'])) {
      check_admin_referer('cromo_home_save');
      $data = [];
      $raw = $_POST['cromo'] ?? [];
      $text_fields = ['hero_desktop','hero_mobile','hero_desc','hero_btn1_text','hero_btn1_url','hero_btn2_text','hero_btn2_url','hero_stat_num','hero_stat_suffix','hero_stat_label','about_eyebrow','about_title','about_desc1','about_desc2','about_image','sol_eyebrow','sol_title','port_eyebrow','port_title','port_desc','port_btn','stats_eyebrow','stats_title','meth_eyebrow','meth_title','meth_desc','clients_eyebrow','clients_title','contact_eyebrow','contact_title','contact_desc','contact_phone','contact_email','contact_insta','footer_desc','footer_logo'];
      foreach ($text_fields as $f) {
        $data[$f] = sanitize_text_field($raw[$f] ?? '');
      }
      // Repeaters
      $repeaters = ['hero_title_lines','sol_items','stats_items','meth_steps','clients_list'];
      foreach ($repeaters as $r) {
        $items = [];
        if (isset($raw[$r]) && is_array($raw[$r])) {
          foreach ($raw[$r] as $idx => $row) {
            if (is_array($row)) {
              $clean = [];
              foreach ($row as $k => $v) {
                $clean[sanitize_text_field($k)] = sanitize_text_field($v);
              }
              $items[] = $clean;
            }
          }
        }
        $data[$r] = $items;
      }
      update_option('cromo_home', $data);
      echo '<div class="notice notice-success"><p>Salvo!</p></div>';
    }
    $o = get_option('cromo_home', []);
    ?>
    <div class="wrap">
      <h1>Cromo - Configurações da Home</h1>
      <form method="post">
        <?php wp_nonce_field('cromo_home_save'); ?>
        <div id="cromo-tabs" style="margin-top:16px;">
          <h2 class="nav-tab-wrapper">
            <a class="nav-tab nav-tab-active" data-tab="hero" onclick="switchTab(this,'hero')">Hero</a>
            <a class="nav-tab" data-tab="about" onclick="switchTab(this,'about')">Sobre</a>
            <a class="nav-tab" data-tab="sol" onclick="switchTab(this,'sol')">Soluções</a>
            <a class="nav-tab" data-tab="port" onclick="switchTab(this,'port')">Portfólio</a>
            <a class="nav-tab" data-tab="stats" onclick="switchTab(this,'stats')">Estatísticas</a>
            <a class="nav-tab" data-tab="meth" onclick="switchTab(this,'meth')">Metodologia</a>
            <a class="nav-tab" data-tab="clients" onclick="switchTab(this,'clients')">Clientes</a>
            <a class="nav-tab" data-tab="contact" onclick="switchTab(this,'contact')">Contato</a>
            <a class="nav-tab" data-tab="footer" onclick="switchTab(this,'footer')">Rodapé</a>
          </h2>

          <?php wp_enqueue_media(); ?>
          <div id="tab-hero" class="cromo-tab">
            <table class="form-table">
              <tr><th>Imagem Desktop</th><td><div style="display:flex;gap:6px"><input type="text" name="cromo[hero_desktop]" id="cromo_hero_desktop" value="<?php echo esc_attr($o['hero_desktop'] ?? ''); ?>" class="regular-text" style="flex:1"><button type="button" class="button" onclick="openOptMedia('cromo_hero_desktop')">Escolher</button></div></td></tr>
              <tr><th>Imagem Mobile</th><td><div style="display:flex;gap:6px"><input type="text" name="cromo[hero_mobile]" id="cromo_hero_mobile" value="<?php echo esc_attr($o['hero_mobile'] ?? ''); ?>" class="regular-text" style="flex:1"><button type="button" class="button" onclick="openOptMedia('cromo_hero_mobile')">Escolher</button></div></td></tr>
              <tr><th>Descrição</th><td><textarea name="cromo[hero_desc]" rows="2" class="large-text"><?php echo esc_textarea($o['hero_desc'] ?? ''); ?></textarea></td></tr>
              <tr><th>Botão 1 - Texto</th><td><input type="text" name="cromo[hero_btn1_text]" value="<?php echo esc_attr($o['hero_btn1_text'] ?? 'Começar Projeto'); ?>"></td></tr>
              <tr><th>Botão 1 - URL</th><td><input type="text" name="cromo[hero_btn1_url]" value="<?php echo esc_attr($o['hero_btn1_url'] ?? '#contato'); ?>" class="regular-text"></td></tr>
              <tr><th>Botão 2 - Texto</th><td><input type="text" name="cromo[hero_btn2_text]" value="<?php echo esc_attr($o['hero_btn2_text'] ?? 'Conhecer Cromo'); ?>"></td></tr>
              <tr><th>Botão 2 - URL</th><td><input type="text" name="cromo[hero_btn2_url]" value="<?php echo esc_attr($o['hero_btn2_url'] ?? '#portfolio'); ?>" class="regular-text"></td></tr>
              <tr><th>Stat - Número</th><td><input type="text" name="cromo[hero_stat_num]" value="<?php echo esc_attr($o['hero_stat_num'] ?? '300'); ?>"></td></tr>
              <tr><th>Stat - Sufixo</th><td><input type="text" name="cromo[hero_stat_suffix]" value="<?php echo esc_attr($o['hero_stat_suffix'] ?? '+'); ?>"></td></tr>
              <tr><th>Stat - Label</th><td><textarea name="cromo[hero_stat_label]" rows="2" class="large-text"><?php echo esc_textarea($o['hero_stat_label'] ?? "Hotéis & Restaurantes\natendidos desde 2019"); ?></textarea></td></tr>
            </table>
            <h3>Linhas do Título</h3>
            <div class="cromo-repeater" data-name="hero_title_lines">
              <?php $lines = $o['hero_title_lines'] ?? []; foreach ($lines as $i => $line): ?>
              <div class="repeater-row">
                <input type="text" name="cromo[hero_title_lines][<?php echo $i; ?>][text]" value="<?php echo esc_attr($line['text'] ?? ''); ?>" placeholder="Texto">
                <input type="text" name="cromo[hero_title_lines][<?php echo $i; ?>][weight]" value="<?php echo esc_attr($line['weight'] ?? '900'); ?>" placeholder="Peso (ex: 900)" style="width:80px">
                <input type="text" name="cromo[hero_title_lines][<?php echo $i; ?>][size]" value="<?php echo esc_attr($line['size'] ?? ''); ?>" placeholder="Tamanho (ex: 0.9em)" style="width:100px">
                <input type="text" name="cromo[hero_title_lines][<?php echo $i; ?>][color]" value="<?php echo esc_attr($line['color'] ?? ''); ?>" placeholder="Cor (ex: rgba(...))" style="width:180px">
                <button type="button" class="button remove-row" onclick="this.closest('.repeater-row').remove()">-</button>
              </div>
              <?php endforeach; ?>
              <button type="button" class="button add-row" onclick="var w=this.closest('.cromo-repeater'),i=w.querySelectorAll('.repeater-row').length;this.insertAdjacentHTML('beforebegin','<div class=\'repeater-row\'><input type=\'text\' name=\'cromo[hero_title_lines]['+i+'][text]\' placeholder=\'Texto\'><input type=\'text\' name=\'cromo[hero_title_lines]['+i+'][weight]\' placeholder=\'Peso\' style=\'width:80px\'><input type=\'text\' name=\'cromo[hero_title_lines]['+i+'][size]\' placeholder=\'Tamanho\' style=\'width:100px\'><input type=\'text\' name=\'cromo[hero_title_lines]['+i+'][color]\' placeholder=\'Cor\' style=\'width:180px\'><button type=\'button\' class=\'button remove-row\' onclick=\'this.closest(\\\'.repeater-row\\\').remove()\'>-</button></div>')">+ Adicionar Linha</button>
            </div>
          </div>

          <div id="tab-about" class="cromo-tab" style="display:none;">
            <table class="form-table">
              <tr><th>Eyebrow</th><td><input type="text" name="cromo[about_eyebrow]" value="<?php echo esc_attr($o['about_eyebrow'] ?? 'Quem somos'); ?>" class="regular-text"></td></tr>
              <tr><th>Título</th><td><textarea name="cromo[about_title]" rows="2" class="large-text"><?php echo esc_textarea($o['about_title'] ?? "Cromo\nComunicação"); ?></textarea></td></tr>
              <tr><th>Descrição 1</th><td><textarea name="cromo[about_desc1]" rows="3" class="large-text"><?php echo esc_textarea($o['about_desc1'] ?? ''); ?></textarea></td></tr>
              <tr><th>Descrição 2</th><td><textarea name="cromo[about_desc2]" rows="3" class="large-text"><?php echo esc_textarea($o['about_desc2'] ?? ''); ?></textarea></td></tr>
              <tr><th>Imagem</th><td><div style="display:flex;gap:6px"><input type="text" name="cromo[about_image]" id="cromo_about_image" value="<?php echo esc_attr($o['about_image'] ?? ''); ?>" class="regular-text" style="flex:1"><button type="button" class="button" onclick="openOptMedia('cromo_about_image')">Escolher</button></div></td></tr>
            </table>
          </div>

          <div id="tab-sol" class="cromo-tab" style="display:none;">
            <table class="form-table">
              <tr><th>Eyebrow</th><td><input type="text" name="cromo[sol_eyebrow]" value="<?php echo esc_attr($o['sol_eyebrow'] ?? 'O que fazemos'); ?>" class="regular-text"></td></tr>
              <tr><th>Título</th><td><input type="text" name="cromo[sol_title]" value="<?php echo esc_attr($o['sol_title'] ?? 'Soluções integradas para potencializar sua marca'); ?>" class="large-text"></td></tr>
            </table>
            <h3>Soluções</h3>
            <div class="cromo-repeater" data-name="sol_items">
              <?php $items = $o['sol_items'] ?? []; foreach ($items as $i => $item): ?>
              <div class="repeater-row">
                <input type="text" name="cromo[sol_items][<?php echo $i; ?>][number]" value="<?php echo esc_attr($item['number'] ?? ''); ?>" placeholder="Número" style="width:60px">
                <input type="text" name="cromo[sol_items][<?php echo $i; ?>][title]" value="<?php echo esc_attr($item['title'] ?? ''); ?>" placeholder="Título">
                <input type="text" name="cromo[sol_items][<?php echo $i; ?>][description]" value="<?php echo esc_attr($item['description'] ?? ''); ?>" placeholder="Descrição" class="regular-text">
                <button type="button" class="button remove-row" onclick="this.closest('.repeater-row').remove()">-</button>
              </div>
              <?php endforeach; ?>
              <button type="button" class="button add-row" onclick="var w=this.closest('.cromo-repeater'),i=w.querySelectorAll('.repeater-row').length;this.insertAdjacentHTML('beforebegin','<div class=\'repeater-row\'><input type=\'text\' name=\'cromo[sol_items]['+i+'][number]\' placeholder=\'Nº\' style=\'width:60px\'><input type=\'text\' name=\'cromo[sol_items]['+i+'][title]\' placeholder=\'Título\'><input type=\'text\' name=\'cromo[sol_items]['+i+'][description]\' placeholder=\'Descrição\' class=\'regular-text\'><button type=\'button\' class=\'button remove-row\' onclick=\'this.closest(\\\'.repeater-row\\\').remove()\'>-</button></div>')">+ Adicionar</button>
            </div>
          </div>

          <div id="tab-port" class="cromo-tab" style="display:none;">
            <table class="form-table">
              <tr><th>Eyebrow</th><td><input type="text" name="cromo[port_eyebrow]" value="<?php echo esc_attr($o['port_eyebrow'] ?? 'Projetos'); ?>"></td></tr>
              <tr><th>Título</th><td><textarea name="cromo[port_title]" rows="2" class="large-text"><?php echo esc_textarea($o['port_title'] ?? "Nosso\nPortfólio"); ?></textarea></td></tr>
              <tr><th>Descrição</th><td><textarea name="cromo[port_desc]" rows="2" class="large-text"><?php echo esc_textarea($o['port_desc'] ?? 'Casos selecionados que mostram o poder da comunicação visual estratégica.'); ?></textarea></td></tr>
              <tr><th>Botão</th><td><input type="text" name="cromo[port_btn]" value="<?php echo esc_attr($o['port_btn'] ?? 'Ver Todos'); ?>"></td></tr>
            </table>
          </div>

          <div id="tab-stats" class="cromo-tab" style="display:none;">
            <table class="form-table">
              <tr><th>Eyebrow</th><td><input type="text" name="cromo[stats_eyebrow]" value="<?php echo esc_attr($o['stats_eyebrow'] ?? 'Métricas'); ?>"></td></tr>
              <tr><th>Título</th><td><input type="text" name="cromo[stats_title]" value="<?php echo esc_attr($o['stats_title'] ?? 'Números que falam por si'); ?>" class="large-text"></td></tr>
            </table>
            <h3>Estatísticas</h3>
            <div class="cromo-repeater" data-name="stats_items">
              <?php $items = $o['stats_items'] ?? []; foreach ($items as $i => $item): ?>
              <div class="repeater-row">
                <input type="text" name="cromo[stats_items][<?php echo $i; ?>][number]" value="<?php echo esc_attr($item['number'] ?? ''); ?>" placeholder="Número" style="width:120px">
                <input type="text" name="cromo[stats_items][<?php echo $i; ?>][description]" value="<?php echo esc_attr($item['description'] ?? ''); ?>" placeholder="Descrição">
                <button type="button" class="button remove-row" onclick="this.closest('.repeater-row').remove()">-</button>
              </div>
              <?php endforeach; ?>
              <button type="button" class="button add-row" onclick="var w=this.closest('.cromo-repeater'),i=w.querySelectorAll('.repeater-row').length;this.insertAdjacentHTML('beforebegin','<div class=\'repeater-row\'><input type=\'text\' name=\'cromo[stats_items]['+i+'][number]\' placeholder=\'Número\' style=\'width:120px\'><input type=\'text\' name=\'cromo[stats_items]['+i+'][description]\' placeholder=\'Descrição\'><button type=\'button\' class=\'button remove-row\' onclick=\'this.closest(\\\'.repeater-row\\\').remove()\'>-</button></div>')">+ Adicionar</button>
            </div>
          </div>

          <div id="tab-meth" class="cromo-tab" style="display:none;">
            <table class="form-table">
              <tr><th>Eyebrow</th><td><input type="text" name="cromo[meth_eyebrow]" value="<?php echo esc_attr($o['meth_eyebrow'] ?? 'Como fazemos'); ?>"></td></tr>
              <tr><th>Título</th><td><input type="text" name="cromo[meth_title]" value="<?php echo esc_attr($o['meth_title'] ?? 'Metodologia'); ?>" class="large-text"></td></tr>
              <tr><th>Descrição</th><td><textarea name="cromo[meth_desc]" rows="2" class="large-text"><?php echo esc_textarea($o['meth_desc'] ?? 'Cinco passos para transformar sua marca em referência visual.'); ?></textarea></td></tr>
            </table>
            <h3>Passos</h3>
            <div class="cromo-repeater" data-name="meth_steps">
              <?php $items = $o['meth_steps'] ?? []; foreach ($items as $i => $item): ?>
              <div class="repeater-row">
                <input type="text" name="cromo[meth_steps][<?php echo $i; ?>][number]" value="<?php echo esc_attr($item['number'] ?? ''); ?>" placeholder="Número" style="width:60px">
                <input type="text" name="cromo[meth_steps][<?php echo $i; ?>][title]" value="<?php echo esc_attr($item['title'] ?? ''); ?>" placeholder="Título">
                <input type="text" name="cromo[meth_steps][<?php echo $i; ?>][description]" value="<?php echo esc_attr($item['description'] ?? ''); ?>" placeholder="Descrição" class="regular-text">
                <button type="button" class="button remove-row" onclick="this.closest('.repeater-row').remove()">-</button>
              </div>
              <?php endforeach; ?>
              <button type="button" class="button add-row" onclick="var w=this.closest('.cromo-repeater'),i=w.querySelectorAll('.repeater-row').length;this.insertAdjacentHTML('beforebegin','<div class=\'repeater-row\'><input type=\'text\' name=\'cromo[meth_steps]['+i+'][number]\' placeholder=\'Nº\' style=\'width:60px\'><input type=\'text\' name=\'cromo[meth_steps]['+i+'][title]\' placeholder=\'Título\'><input type=\'text\' name=\'cromo[meth_steps]['+i+'][description]\' placeholder=\'Descrição\' class=\'regular-text\'><button type=\'button\' class=\'button remove-row\' onclick=\'this.closest(\\\'.repeater-row\\\').remove()\'>-</button></div>')">+ Adicionar</button>
            </div>
          </div>

          <div id="tab-clients" class="cromo-tab" style="display:none;">
            <table class="form-table">
              <tr><th>Eyebrow</th><td><input type="text" name="cromo[clients_eyebrow]" value="<?php echo esc_attr($o['clients_eyebrow'] ?? 'Parceiros'); ?>"></td></tr>
              <tr><th>Título</th><td><input type="text" name="cromo[clients_title]" value="<?php echo esc_attr($o['clients_title'] ?? 'Marcas que confiam na Cromo'); ?>" class="large-text"></td></tr>
            </table>
            <h3>Clientes</h3>
            <div class="cromo-repeater" data-name="clients_list">
              <?php $items = $o['clients_list'] ?? []; foreach ($items as $i => $item): ?>
              <div class="repeater-row">
                <input type="text" name="cromo[clients_list][<?php echo $i; ?>][name]" value="<?php echo esc_attr($item['name'] ?? ''); ?>" placeholder="Nome do cliente">
                <button type="button" class="button remove-row" onclick="this.closest('.repeater-row').remove()">-</button>
              </div>
              <?php endforeach; ?>
              <button type="button" class="button add-row" onclick="var w=this.closest('.cromo-repeater'),i=w.querySelectorAll('.repeater-row').length;this.insertAdjacentHTML('beforebegin','<div class=\'repeater-row\'><input type=\'text\' name=\'cromo[clients_list]['+i+'][name]\' placeholder=\'Nome\'><button type=\'button\' class=\'button remove-row\' onclick=\'this.closest(\\\'.repeater-row\\\').remove()\'>-</button></div>')">+ Adicionar</button>
            </div>
          </div>

          <div id="tab-contact" class="cromo-tab" style="display:none;">
            <table class="form-table">
              <tr><th>Eyebrow</th><td><input type="text" name="cromo[contact_eyebrow]" value="<?php echo esc_attr($o['contact_eyebrow'] ?? 'Contato'); ?>"></td></tr>
              <tr><th>Título</th><td><input type="text" name="cromo[contact_title]" value="<?php echo esc_attr($o['contact_title'] ?? 'Vamos conversar?'); ?>" class="large-text"></td></tr>
              <tr><th>Descrição</th><td><textarea name="cromo[contact_desc]" rows="2" class="large-text"><?php echo esc_textarea($o['contact_desc'] ?? 'Conte-nos sobre seu projeto e descubra como podemos transformar sua comunicação visual.'); ?></textarea></td></tr>
              <tr><th>Telefone</th><td><input type="text" name="cromo[contact_phone]" value="<?php echo esc_attr($o['contact_phone'] ?? ''); ?>"></td></tr>
              <tr><th>Email</th><td><input type="text" name="cromo[contact_email]" value="<?php echo esc_attr($o['contact_email'] ?? ''); ?>"></td></tr>
              <tr><th>Instagram</th><td><input type="text" name="cromo[contact_insta]" value="<?php echo esc_attr($o['contact_insta'] ?? ''); ?>"></td></tr>
            </table>
          </div>

          <div id="tab-footer" class="cromo-tab" style="display:none;">
            <table class="form-table">
              <tr><th>Logo</th><td><div style="display:flex;gap:6px"><input type="text" name="cromo[footer_logo]" id="cromo_footer_logo" value="<?php echo esc_attr($o['footer_logo'] ?? ''); ?>" class="regular-text" style="flex:1"><button type="button" class="button" onclick="openOptMedia('cromo_footer_logo')">Escolher</button></div></td></tr>
              <tr><th>Descrição</th><td><textarea name="cromo[footer_desc]" rows="2" class="large-text"><?php echo esc_textarea($o['footer_desc'] ?? 'Fotografia, vídeo e estratégia digital para hotelaria, gastronomia & lifestyle de luxo.'); ?></textarea></td></tr>
            </table>
          </div>
        </div>
        <p><button type="submit" name="cromo_save" class="button button-primary">Salvar</button></p>
      </form>
    </div>
    <style>
      .cromo-tab { padding: 16px; background: #fff; border: 1px solid #ccc; border-top: none; }
      .repeater-row { display: flex; gap: 8px; align-items: center; margin-bottom: 8px; flex-wrap: wrap; }
      .repeater-row input { flex: 1; min-width: 100px; }
      .repeater-row .remove-row { flex: 0 0 auto; }
      .cromo-repeater { padding: 8px; border: 1px dashed #ddd; border-radius: 3px; }
    </style>
    <script>
    function openOptMedia(id) {
      var frame = wp.media({ title: 'Selecionar imagem', multiple: false, library: { type: 'image' } });
      frame.on('select', function() {
        document.getElementById(id).value = frame.state().get('selection').first().toJSON().url;
      });
      frame.open();
    }
    function switchTab(el, tab) {
      document.querySelectorAll('.nav-tab').forEach(function(t){t.classList.remove('nav-tab-active')});
      document.querySelectorAll('.cromo-tab').forEach(function(t){t.style.display = 'none'});
      el.classList.add('nav-tab-active');
      document.getElementById('tab-' + tab).style.display = 'block';
    }
    </script>
    <?php
  }, 'dashicons-admin-home', 30);
});

// ─── Auto-populate defaults on first load ───
add_action('init', function () {
  if (!get_option('cromo_home')) {
    $defaults = [
      'hero_desktop' => '',
      'hero_mobile' => '',
      'hero_title_lines' => [
        ['text' => 'Comunicação', 'weight' => '200', 'size' => '0.65em', 'color' => 'rgba(255,255,255,0.25)'],
        ['text' => 'Estratégica para', 'weight' => '200', 'size' => '0.65em', 'color' => 'rgba(255,255,255,0.25)'],
        ['text' => 'Hotelaria', 'weight' => '900', 'size' => '0.9em', 'color' => ''],
        ['text' => '& Gastronomia', 'weight' => '900', 'size' => '0.9em', 'color' => ''],
      ],
      'hero_desc' => 'Fotografia, vídeo, assessoria de imprensa e marketing de performance para marcas premium de hotelaria, gastronomia e lifestyle de luxo.',
      'hero_btn1_text' => 'Começar Projeto',
      'hero_btn1_url' => '#contato',
      'hero_btn2_text' => 'Conhecer Cromo',
      'hero_btn2_url' => '#portfolio',
      'hero_stat_num' => '300',
      'hero_stat_suffix' => '+',
      'hero_stat_label' => "Hotéis & Restaurantes\natendidos desde 2019",
      'about_eyebrow' => 'Quem somos',
      'about_title' => "Cromo\nComunicação",
      'about_desc1' => 'Somos uma agência de comunicação visual especializada em hotelaria, gastronomia e lifestyle de luxo. Combinamos fotografia, vídeo, assessoria de imprensa e marketing de performance para criar narrativas visuais que posicionam marcas premium no mercado.',
      'about_desc2' => 'Com mais de 300 hotéis e restaurantes atendidos, desenvolvemos estratégias de conteúdo editorial que geram conexão, autoridade e resultado.',
      'about_image' => '',
      'sol_eyebrow' => 'O que fazemos',
      'sol_title' => 'Soluções integradas para potencializar sua marca',
      'sol_items' => [
        ['number' => '01', 'title' => 'Fotografia', 'description' => 'Ensaios gastronômicos, arquitetura hoteleira, still e lifestyle com curadoria editorial.'],
        ['number' => '02', 'title' => 'Vídeo', 'description' => 'Videografias institucionais, videomarketing para redes sociais e tours imersivos.'],
        ['number' => '03', 'title' => 'Assessoria', 'description' => 'Assessoria de imprensa, relações públicas e posicionamento de marca no mercado.'],
        ['number' => '04', 'title' => 'Otimização', 'description' => 'Estratégia digital, SEO, performance e gestão de conteúdo para multiplataforma.'],
      ],
      'port_eyebrow' => 'Projetos',
      'port_title' => "Nosso\nPortfólio",
      'port_desc' => 'Casos selecionados que mostram o poder da comunicação visual estratégica.',
      'port_btn' => 'Ver Todos',
      'stats_eyebrow' => 'Métricas',
      'stats_title' => 'Números que falam por si',
      'stats_items' => [
        ['number' => '300+', 'description' => 'Hotéis & Restaurantes'],
        ['number' => '50k-100k', 'description' => 'Audiência Qualificada'],
        ['number' => '6', 'description' => 'Linhas Editoriais'],
        ['number' => '100%', 'description' => 'Conteúdo Editorial'],
      ],
      'meth_eyebrow' => 'Como fazemos',
      'meth_title' => 'Metodologia',
      'meth_desc' => 'Cinco passos para transformar sua marca em referência visual.',
      'meth_steps' => [
        ['number' => '01', 'title' => 'Briefing', 'description' => 'Mapeamos objetivos, público-alvo e concorrência para alinhar expectativas.'],
        ['number' => '02', 'title' => 'Planejamento', 'description' => 'Criamos um plano de conteúdo editorial com cronograma e entregas definidas.'],
        ['number' => '03', 'title' => 'Produção', 'description' => 'Executamos fotografia, vídeo e criação de conteúdo com direção criativa.'],
        ['number' => '04', 'title' => 'Distribuição', 'description' => 'Veiculamos o conteúdo nos canais certos para maximizar alcance e engajamento.'],
        ['number' => '05', 'title' => 'Otimização', 'description' => 'Analisamos resultados e ajustamos a estratégia para melhoria contínua.'],
      ],
      'clients_eyebrow' => 'Parceiros',
      'clients_title' => 'Marcas que confiam na Cromo',
      'clients_list' => [
        ['name' => 'Bam Bam'], ['name' => 'Esplanada'], ['name' => 'Mamma Gorda'],
        ['name' => 'La Gare'], ['name' => 'Loire Bistro'], ['name' => 'Kitchin'],
        ['name' => 'Macaw'], ['name' => 'Bar do Zé'], ['name' => 'Abracadabra'],
        ['name' => 'Zendaya'], ['name' => 'Atelier dos Sabores'],
      ],
      'contact_eyebrow' => 'Contato',
      'contact_title' => 'Vamos conversar?',
      'contact_desc' => 'Conte-nos sobre seu projeto e descubra como podemos transformar sua comunicação visual.',
      'contact_phone' => '(21) 99999-9999',
      'contact_email' => 'ola@studiocromo.com',
      'contact_insta' => '@studiocromo',
      'footer_desc' => 'Fotografia, vídeo e estratégia digital para hotelaria, gastronomia & lifestyle de luxo.',
      'footer_logo' => '',
    ];
    update_option('cromo_home', $defaults);
  }
});

// ─── Helpers ───
function cromo_get($key, $default = '') {
  $opts = get_option('cromo_home', []);
  return $opts[$key] ?? $default;
}

function cromo_img($key, $fallback = '') {
  $v = cromo_get($key, '');
  return $v ?: ($fallback ? get_template_directory_uri() . '/assets/images/' . $fallback : '');
}
