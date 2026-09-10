<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Core/panel_docente.php';
requireStudent();

$currentUserId = !empty($_SESSION['usuario_es_invitado']) ? null : (int)($_SESSION['usuario_id'] ?? 0);
$currentUserName = $_SESSION['usuario_nombre'] ?? 'Estudiante';
$communityName = 'LC•PULSO';

$categories = [
    'all' => ['Todos', '⌁'],
    'pregunta' => ['Preguntas', '?'],
    'logro' => ['Logros', '★'],
    'proyecto' => ['Proyectos', '⌘'],
    'recursos' => ['Recursos', '▱'],
    'general' => ['General', '◌'],
];
$subjects = [
    'all' => 'Todas las materias',
    'Programación' => 'Programación',
    'Pensamiento Matemático III' => 'Pensamiento Matemático III',
    'Ciencias Sociales' => 'Ciencias Sociales',
    'Historia de México' => 'Historia de México',
    'Física I' => 'Física I',
    'Química I' => 'Química I',
    'Ecosistemas' => 'Ecosistemas',
    'Inglés' => 'Inglés'
];
?>
<!doctype html>
<html lang="es" data-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="<?= htmlspecialchars(csrfToken()) ?>">
<title><?= htmlspecialchars($communityName) ?> | LC-ADVANCE</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/community/styles.css">
</head>
<body>

<!-- ── Navigation ────────────────────────────────────────────── -->
<nav class="cp-nav">
  <a class="cp-nav__brand" href="<?= htmlspecialchars(getDashboardUrl()) ?>">LC<span>·</span>PULSO</a>
  <div class="cp-nav__links">
    <a class="cp-nav__link cp-nav__link--active" href="community.php">
      <span class="cp-nav__icon">🏠</span> Inicio
    </a>
    <a class="cp-nav__link" href="community_explore.php">
      <span class="cp-nav__icon">🔍</span> Explorar
    </a>
    <a class="cp-nav__link" href="community_bookmarks.php">
      <span class="cp-nav__icon">🔖</span> Guardados
    </a>
  </div>
  <div class="cp-nav__search">
    <span class="cp-nav__search-icon">🔍</span>
    <input type="text" id="cp-search" placeholder="Buscar publicaciones, personas o temas..." aria-label="Buscar">
  </div>
  <div class="cp-nav__actions">
    <button class="cp-notif-btn" id="cp-notif-btn" title="Notificaciones" aria-label="Notificaciones">
      🔔
      <span class="cp-notif-badge" id="cp-notif-badge" style="display:none">0</span>
    </button>
    <button class="cp-nav__avatar" onclick="CP.viewProfile(<?= json_encode($currentUserId) ?>)" title="Mi perfil">
      <?= htmlspecialchars(strtoupper(mb_substr($currentUserName, 0, 1))) ?>
    </button>
  </div>
</nav>

<!-- ── Notification Panel ────────────────────────────────────── -->
<div class="cp-notif-panel hidden" id="cp-notif-panel">
  <div class="cp-notif-panel__header">
    <span class="cp-notif-panel__title">Actividad reciente</span>
    <button class="cp-notif-panel__close" onclick="CP.toggleNotifications()">✕</button>
  </div>
  <div id="cp-notif-list">
    <div class="cp-empty"><div class="cp-empty__icon">🔔</div><div class="cp-empty__text">Sin actividad nueva</div></div>
  </div>
</div>

<!-- ── Pull to Refresh indicator ─────────────────────────────── -->
<div class="cp-pull-indicator" id="cp-pull-indicator"></div>

<!-- ── Main Shell ────────────────────────────────────────────── -->
<div class="cp-shell">

  <!-- Hero -->
  <section class="cp-hero">
    <div>
      <div class="cp-hero__eyebrow">LC-ADVANCE / <?= htmlspecialchars($communityName) ?></div>
      <h1>Ideas que se vuelven<br><span>aprendizaje.</span></h1>
      <p>Pregunta, comparte avances y encuentra compañeros para resolver lo que estás estudiando.</p>
    </div>
    <div class="cp-hero__status" id="cp-live-status">FEED EN VIVO</div>
  </section>

  <!-- 3-Column Layout -->
  <div class="cp-layout">

    <!-- ── Left Sidebar ──────────────────────────────────── -->
    <aside class="cp-sidebar cp-sidebar--left">
      <div class="cp-side-card">
        <div class="cp-side-card__title"><span>⌁</span> Explorar</div>
        <div class="cp-categories" id="cp-categories">
          <?php foreach ($categories as $key => $category): ?>
            <button class="cp-category <?= $key === 'all' ? 'cp-category--active' : '' ?>" data-category="<?= $key ?>">
              <span class="cp-category__icon"><?= $category[1] ?></span>
              <?= htmlspecialchars($category[0]) ?>
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="cp-side-card">
        <div class="cp-side-card__title"><span>◈</span> Materias</div>
        <div class="cp-categories" id="cp-subjects">
          <?php foreach ($subjects as $key => $label): ?>
            <button class="cp-category <?= $key === 'all' ? 'cp-category--active' : '' ?>" data-subject="<?= htmlspecialchars($key) ?>">
              <span class="cp-category__icon">◈</span>
              <?= htmlspecialchars($label) ?>
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="cp-side-card" style="border-top: 3px solid var(--cp-lime); background: rgba(0,255,135,.05);">
        <div class="cp-side-card__title" style="color: var(--cp-lime);">💡 Hazlo útil</div>
        <p style="font-size: 12px; line-height: 1.55; color: var(--cp-ink-muted); margin: 0;">Comparte el proceso, cita tus fuentes y deja espacio para que otra persona aprenda contigo.</p>
      </div>
    </aside>

    <!-- ── Main Feed ─────────────────────────────────────── -->
    <main>
      <!-- Stories -->
      <section class="cp-stories" id="cp-stories">
        <button class="cp-story cp-story--add" id="cp-add-story" type="button">Historia</button>
      </section>

      <!-- Composer -->
      <div class="cp-composer">
        <form id="cp-post-form">
          <div class="cp-composer__top">
            <div class="cp-composer__avatar"><?= htmlspecialchars(strtoupper(mb_substr($currentUserName, 0, 1))) ?></div>
            <div class="cp-composer__input-wrap">
              <input class="cp-composer__title" id="cp-post-title" maxlength="180" placeholder="¿Qué está pasando en tu aprendizaje?">
              <textarea class="cp-composer__body" id="cp-post-body" maxlength="5000" placeholder="Comparte una pregunta, avance, recurso o idea..." required></textarea>
            </div>
          </div>
          <div id="cp-media-preview" class="cp-composer__media-preview"></div>
          <div class="cp-composer__tools">
            <button type="button" class="cp-composer__tool-btn" title="Añadir imagen" onclick="document.getElementById('cp-file-input').click()">📷</button>
            <button type="button" class="cp-composer__tool-btn" title="Crear encuesta">📊</button>
            <button type="button" class="cp-composer__tool-btn" title="Citar publicación">🔀</button>
            <input type="file" id="cp-file-input" accept="image/*,video/*" multiple style="display:none" onchange="CP.handleMediaUpload(this)">
            <div class="cp-composer__selects">
              <select class="cp-composer__select" id="cp-post-category" aria-label="Tipo de publicación">
                <option value="general">General</option>
                <option value="pregunta">Pregunta</option>
                <option value="logro">Logro</option>
                <option value="proyecto">Proyecto</option>
                <option value="recursos">Recurso</option>
              </select>
              <select class="cp-composer__select" id="cp-post-subject" aria-label="Materia">
                <?php foreach ($subjects as $key => $label): ?>
                  <?php if ($key !== 'all'): ?>
                    <option value="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($label) ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
            <input class="cp-composer__select" id="cp-post-tags" maxlength="120" placeholder="#tags opcionales" style="flex: 1;">
            <button class="cp-composer__publish" id="cp-publish-btn" type="submit">Publicar</button>
          </div>
        </form>
      </div>

      <!-- Feed Tabs -->
      <div class="cp-tabs" id="cp-tabs">
        <button class="cp-tab cp-tab--active" data-mode="for_you">Para ti</button>
        <button class="cp-tab" data-mode="following">Siguiendo</button>
        <button class="cp-tab" data-mode="recent">Recientes</button>
      </div>

      <!-- New posts banner -->
      <button class="cp-new-banner" id="cp-new-banner">Hay publicaciones nuevas · ver ahora</button>

      <!-- Feed header -->
      <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:8px;">
        <h2 style="font-size:15px; font-weight:700;">Conversación de estudiantes</h2>
        <select class="cp-composer__select" id="cp-sort" style="width:auto; min-width:130px;">
          <option value="recent">Relevantes</option>
          <option value="popular">Más apoyadas</option>
        </select>
      </div>

      <!-- Feed -->
      <section id="cp-feed">
        <article class="cp-post cp-post--skeleton"><div class="cp-post__header"><div class="cp-post__avatar">L</div><div class="cp-post__meta"><div class="cp-post__body" style="width:120px;height:14px;">&nbsp;</div><div class="cp-post__body" style="width:80px;height:10px;margin-top:4px;">&nbsp;</div></div></div><div class="cp-post__title">&nbsp;</div><div class="cp-post__body" style="height:40px;">&nbsp;</div></article>
        <article class="cp-post cp-post--skeleton"><div class="cp-post__header"><div class="cp-post__avatar">A</div><div class="cp-post__meta"><div class="cp-post__body" style="width:100px;height:14px;">&nbsp;</div></div></div><div class="cp-post__body" style="height:60px;">&nbsp;</div></article>
      </section>

      <!-- Scroll sentinel for infinite scroll -->
      <div id="cp-scroll-sentinel" style="height:1px;"></div>

      <!-- Load more -->
      <button class="cp-load-more" id="cp-load-more" type="button">Cargar más</button>
    </main>

    <!-- ── Right Sidebar ─────────────────────────────────── -->
    <aside class="cp-sidebar">
      <!-- Trending -->
      <div class="cp-side-card">
        <div class="cp-side-card__title"><span>🔥</span> Tendencias</div>
        <div class="cp-trending" id="cp-trending-list">
          <div class="cp-trending__item"><span class="cp-trending__tag">#programacion</span><span class="cp-trending__count">En curso</span></div>
          <div class="cp-trending__item"><span class="cp-trending__tag">#examen</span><span class="cp-trending__count">Ayuda mutua</span></div>
          <div class="cp-trending__item"><span class="cp-trending__tag">#proyectos</span><span class="cp-trending__count">Creando</span></div>
          <div class="cp-trending__item"><span class="cp-trending__tag">#ciencias</span><span class="cp-trending__count">Debate</span></div>
        </div>
      </div>

      <!-- Who to follow -->
      <div class="cp-side-card">
        <div class="cp-side-card__title"><span>👤</span> A quién seguir</div>
        <div id="cp-follow-suggestions"></div>
      </div>

      <!-- Rules -->
      <div class="cp-side-card">
        <div class="cp-side-card__title"><span>📋</span> Normas de la casa</div>
        <p class="cp-rules">Sé claro, respetuoso y útil. Esta comunidad existe para que aprender con otras personas sea más fácil.</p>
      </div>
    </aside>

  </div>
</div>

<!-- ── Bottom Navigation (Mobile) ──────────────────────────── -->
<nav class="cp-bottom-nav">
  <a class="cp-bottom-nav__item cp-bottom-nav__item--active" href="community.php">
    <span class="cp-bottom-nav__icon">🏠</span>
    Inicio
  </a>
  <a class="cp-bottom-nav__item" href="community_explore.php">
    <span class="cp-bottom-nav__icon">🔍</span>
    Explorar
  </a>
  <a class="cp-bottom-nav__item" href="community_bookmarks.php">
    <span class="cp-bottom-nav__icon">🔖</span>
    Guardados
  </a>
  <a class="cp-bottom-nav__item" onclick="CP.toggleNotifications()" style="position:relative">
    <span class="cp-bottom-nav__icon">🔔</span>
    Notif
    <span class="cp-bottom-nav__badge" id="cp-bottom-notif-badge" style="display:none">0</span>
  </a>
  <a class="cp-bottom-nav__item" href="community_profile.php?id=<?= json_encode($currentUserId) ?>">
    <span class="cp-bottom-nav__icon">👤</span>
    Perfil
  </a>
</nav>

<!-- ── Scripts ──────────────────────────────────────────────── -->
<script src="assets/js/community/app.js"></script>

</body>
</html>
