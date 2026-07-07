# Passo a Passo - Ambiente Local + GitHub

---

## Parte 1: Rodar o tema no LocalWP

### 1. Abrir o LocalWP
- Abra o programa **Local** (ícone na área de trabalho ou no menu Iniciar)

### 2. Criar um novo site
- Clique em **"Create a new site"** (canto inferior direito)
- Escolha **"Basic"** (recomendado)
- **Name:** `cromo` (ou qualquer nome)
- **Domain:** `cromo.local` (padrão)
- **Path:** mantenha o sugerido
- **PHP / Web Server / MySQL:** mantenha os padrões
- Clique em **"Add Site"**

### 3. Instalar o tema
- No painel do Local, clique no site **cromo** > aba **"Shell"** (botão "Open site shell")
- Ou vá em **Admin** > **"Open Admin"** para abrir o WordPress
- Faça login (usuário/senha foram criados na instalação)

**Pelo Admin WordPress:**
- Vá em **Appearance > Themes > Add New > Upload Theme**
- Selecione o arquivo `wp-theme/cromo.zip` (precisa zipar a pasta primeiro)
- Ou copie a pasta manualmente:
  - No Local, clique com botão direito no site > **"Reveal in Finder/Explorer"**
  - Vá em `app/public/wp-content/themes/`
  - Copie a pasta `cromo/` para lá

### 4. Configurar a Home
- No WordPress admin, vá em **Settings > Reading**
- Em "Your homepage displays", marque **"A static page"**
- Em "Front page", selecione **"Front Page"** (criada automaticamente pelo tema)
- Salve

### 5. Preencher dados
- No menu do WordPress, aparecerá **"Cromo Home"**
- Preencha cada aba (Hero, Sobre, Soluções, etc.)
- Clique em **Salvar**

### 6. Criar projetos
- Vá em **Projetos > Adicionar Novo**
- Preencha título, a imagem Hero (URL), categoria, ano
- Na galeria, adicione linhas com imagens
- Publique

### 7. Visualizar
- Abra `http://cromo.local` no navegador

---

## Parte 2: Versionar no GitHub

### 1. Criar .gitignore
Já vou criar. Ignora arquivos desnecessários.

### 2. Inicializar o git
```bash
cd C:\Users\jmgvh\Desktop\test_antigravity\minimalista-cromocomu2
git init
git add .
git commit -m "feat: tema WordPress Cromo + site estático"
```

### 3. Criar repositório no GitHub
- Acesse https://github.com
- Clique em **"+" (canto superior direito) > "New repository"**
- Nome: `cromo-site` (ou outro)
- Deixe público ou privado (sua escolha)
- **NÃO** marque "Initialize this repository with a README"
- Clique em **"Create repository"**

### 4. Conectar e enviar
O GitHub vai mostrar comandos. Copie e cole no terminal:
```bash
git remote add origin https://github.com/SEU_USUARIO/cromo-site.git
git branch -M main
git push -u origin main
```

### 5. Verificar
- Recarregue a página do repositório no GitHub
- Os arquivos já devem estar lá

---

## Parte 3: Fluxo de trabalho (edições futuras)

Quando quiser alterar algo:

```bash
# 1. Ver o que mudou
git status
git diff

# 2. Adicionar as alterações
git add .

# 3. Comitar
git commit -m "descrição do que mudou"

# 4. Enviar pro GitHub
git push
```

Para **atualizar o site no HostGator** depois:
- Acessar o servidor via FTP ou cPanel
- Baixar a pasta do tema que está lá
- Substituir pelos arquivos atualizados do GitHub
- Ou fazer `git pull` se tiver Git instalado no servidor

---

## Estrutura final dos arquivos

```
minimalista-cromocomu2/
├── wp-theme/cromo/       ← TEMA WORDPRESS (é isso que vai para o Local e depois pro HostGator)
├── website/              ← SITE ESTÁTICO ATUAL (já na Vercel)
├── design system/images/ ← IMAGENS ORIGINAIS
├── SETUP.md              ← ESTE GUIA
```
