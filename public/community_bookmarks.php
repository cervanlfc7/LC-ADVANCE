<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Core/panel_docente.php';
requireStudent();

$currentUserId = !empty($_SESSION['usuario_es_invitado']) ? null : (int)($_SESSION['usuario_id'] ?? 0);
if (!$currentUserId) { header('Location: community.php'); exit; }
?>
<!doctype html>
<html lang="es" data-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="<?= htmlspecialchars(csrfToken()) ?>">
<title>Guardados | LC•PULSO</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/community/styles.css">
</head>
<body>

<nav class="cp-nav">
  <a class="cp-nav__brand" href="community.php">LC<span>·</span>PULSO</a>
  <div class="cp-nav__links">
    <a class="cp-nav__link" href="community.php"><span class="cp-nav__icon">🏠</span> Inicio</a>
    <a class="cp-nav__link" href="community_explore.php"><span class="cp-nav__icon">🔍</span> Explorar</a>
    <a class="cp-nav__link cp-nav__link--active" href="community_bookmarks.php"><span class="cp-nav__icon">🔖</span> Guardados</a>
  </div>
  <div class="cp-nav__actions">
    <button class="cp-notif-btn" id="cp-notif-btn">🔔<span class="cp-notif-badge" id="cp-notif-badge" style="display:none">0</span></button>
    <a class="cp-nav__avatar" href="community_profile.php"><?= htmlspecialchars(strtoupper(mb_substr($_SESSION['usuario_nombre'] ?? 'E', 0, 1))) ?></a>
  </div>
</nav>

<div class="cp-shell">
  <section class="cp-hero" style="padding-bottom:16px">
    <div>
      <div class="cp-hero__eyebrow">LC-ADVANCE / COMUNIDAD</div>
      <h1 style="font-size:clamp(26px,5vw,44px)">Guardados</h1>
      <p style="color:var(--cp-ink-muted);font-size:14px">Publicaciones que guardaste para consultar después.</p>
    </div>
  </section>

  <section id="cp-bookmarks-feed"></section>
</div>

<div class="cp-notif-panel hidden" id="cp-notif-panel">
  <div class="cp-notif-panel__header">
    <span class="cp-notif-panel__title">Notificaciones</span>
    <button class="cp-notif-panel__close" onclick="document.getElementById('cp-notif-panel').classList.add('hidden')">✕</button>
  </div>
  <div id="cp-notif-list"></div>
</div>

<nav class="cp-bottom-nav">
  <a class="cp-bottom-nav__item" href="community.php"><span class="cp-bottom-nav__icon">🏠</span> Inicio</a>
  <a class="cp-bottom-nav__item" href="community_explore.php"><span class="cp-bottom-nav__icon">🔍</span> Explorar</a>
  <a class="cp-bottom-nav__item cp-bottom-nav__item--active" href="community_bookmarks.php"><span class="cp-bottom-nav__icon">🔖</span> Guardados</a>
  <a class="cp-bottom-nav__item" onclick="document.getElementById('cp-notif-panel').classList.toggle('hidden')"><span class="cp-bottom-nav__icon">🔔</span> Notif</a>
  <a class="cp-bottom-nav__item" href="community_profile.php"><span class="cp-bottom-nav__icon">👤</span> Perfil</a>
</nav>

<script src="assets/js/community/app.js"></script>
<script>
function esc(v) { const n = document.createElement('div'); n.textContent = v ?? ''; return n.innerHTML; }
function timeAgo(v) {
  const d = Math.floor((Date.now() - new Date(v.replace(' ','T')).getTime()) / 1000);
  if (d < 60) return 'ahora'; if (d < 3600) return Math.floor(d/60)+'m'; if (d < 86400) return Math.floor(d/3600)+'h'; return Math.floor(d/86400)+'d';
}
function initials(name) { return esc((name||'?').trim().charAt(0).toUpperCase()); }
function categoryLabel(key) { return {general:'General',pregunta:'Pregunta',logro:'Logro',proyecto:'Proyecto',recursos:'Recurso'}[key]||'General'; }

async function loadBookmarks() {
  const res = await fetch('api/community.php?view=bookmarks');
  const data = await res.json();
  const feed = document.getElementById('cp-bookmarks-feed');
  if (!data.ok || !data.posts?.length) {
    feed.innerHTML = '<div class="cp-empty"><div class="cp-empty__icon">🔖</div><div class="cp-empty__text">Aún no guardaste ninguna publicación.<br>Guarda posts con el botón ▱ para verlos aquí.</div></div>';
    return;
  }
  feed.innerHTML = data.posts.map(post => {
    const tags = (post.tags || '').split(',').filter(Boolean);
    const tagsHtml = tags.length ? `<div class="cp-tags">${tags.map(t => `<span class="cp-tag">#${esc(t)}</span>`).join('')}</div>` : '';
    return `<article class="cp-post" data-post-id="${post.id}">
      <div class="cp-post__header">
        <div class="cp-post__avatar" onclick="location.href='community_profile.php?id=${post.user_id}'">${initials(post.author_name)}</div>
        <div class="cp-post__meta">
          <div class="cp-post__author" onclick="location.href='community_profile.php?id=${post.user_id}'">${esc(post.author_name)}</div>
          <div class="cp-post__time">${timeAgo(post.created_at)}</div>
        </div>
        <span class="cp-post__badge">${esc(post.subject||'General')} · ${categoryLabel(post.category)}</span>
      </div>
      ${post.post_title ? `<h3 class="cp-post__title">${esc(post.post_title)}</h3>` : ''}
      <div class="cp-post__body">${esc(post.post_body)}</div>
      ${tagsHtml}
      <div class="cp-post__actions">
        <span class="cp-action"><span class="cp-action__icon">❤️</span> ${post.like_count || 0}</span>
        <span class="cp-action"><span class="cp-action__icon">💬</span> ${post.comment_count || 0}</span>
        <a class="cp-action" href="community.php#post-${post.id}"><span class="cp-action__icon">↗</span> Ver en feed</a>
      </div>
    </article>`;
  }).join('');
}

document.getElementById('cp-notif-btn')?.addEventListener('click', () => document.getElementById('cp-notif-panel').classList.toggle('hidden'));
loadBookmarks();
</script>
</body>
</html>
