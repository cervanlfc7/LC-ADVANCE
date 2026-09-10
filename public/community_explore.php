<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Core/panel_docente.php';
requireStudent();

$currentUserId = !empty($_SESSION['usuario_es_invitado']) ? null : (int)($_SESSION['usuario_id'] ?? 0);
?>
<!doctype html>
<html lang="es" data-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="<?= htmlspecialchars(csrfToken()) ?>">
<title>Explorar | LC•PULSO</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/community/styles.css">
</head>
<body>

<nav class="cp-nav">
  <a class="cp-nav__brand" href="community.php">LC<span>·</span>PULSO</a>
  <div class="cp-nav__links">
    <a class="cp-nav__link" href="community.php"><span class="cp-nav__icon">🏠</span> Inicio</a>
    <a class="cp-nav__link cp-nav__link--active" href="community_explore.php"><span class="cp-nav__icon">🔍</span> Explorar</a>
    <a class="cp-nav__link" href="community_bookmarks.php"><span class="cp-nav__icon">🔖</span> Guardados</a>
  </div>
  <div class="cp-nav__search">
    <span class="cp-nav__search-icon">🔍</span>
    <input type="text" id="cp-explore-search" placeholder="Buscar personas, hashtags, temas..." autofocus>
  </div>
  <div class="cp-nav__actions">
    <button class="cp-notif-btn" id="cp-notif-btn">🔔<span class="cp-notif-badge" id="cp-notif-badge" style="display:none">0</span></button>
    <a class="cp-nav__avatar" href="community_profile.php"><?= htmlspecialchars(strtoupper(mb_substr($_SESSION['usuario_nombre'] ?? 'E', 0, 1))) ?></a>
  </div>
</nav>

<div class="cp-shell">
  <div class="cp-explore">
    <section class="cp-hero" style="padding-bottom:16px">
      <div>
        <div class="cp-hero__eyebrow">LC-ADVANCE / COMUNIDAD</div>
        <h1 style="font-size:clamp(26px,5vw,44px)">Descubrir</h1>
        <p style="color:var(--cp-ink-muted);font-size:14px">Explora tendencias, personas y contenido de tu comunidad.</p>
      </div>
    </section>

    <!-- Search -->
    <input class="cp-explore__search" id="cp-explore-search-main" placeholder="Buscar personas, posts, hashtags o materias...">

    <!-- Trending Tags -->
    <div class="cp-explore__section-title"><span>🔥</span> Tendencias</div>
    <div class="cp-trending" id="cp-explore-trending"></div>

    <!-- Suggested Users -->
    <div class="cp-explore__section-title" style="margin-top:28px"><span>👤</span> Personas sugeridas</div>
    <div id="cp-explore-users" style="display:grid;gap:8px;"></div>

    <!-- Trending Posts -->
    <div class="cp-explore__section-title" style="margin-top:28px"><span>📈</span> Posts populares</div>
    <div id="cp-explore-posts"></div>

    <!-- Search Results (hidden by default) -->
    <div id="cp-explore-results" style="display:none">
      <div class="cp-explore__section-title"><span>🔎</span> Resultados</div>
      <div id="cp-explore-results-list"></div>
    </div>
  </div>
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
  <a class="cp-bottom-nav__item cp-bottom-nav__item--active" href="community_explore.php"><span class="cp-bottom-nav__icon">🔍</span> Explorar</a>
  <a class="cp-bottom-nav__item" href="community_bookmarks.php"><span class="cp-bottom-nav__icon">🔖</span> Guardados</a>
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

async function loadExplore(search = '') {
  const params = new URLSearchParams({ view: 'explore' });
  if (search) params.set('search', search);
  const res = await fetch(`api/community.php?${params}`);
  const data = await res.json();
  if (!data.ok) return;

  // Trending
  const trendingEl = document.getElementById('cp-explore-trending');
  if (data.trending?.length) {
    trendingEl.innerHTML = data.trending.map(h => `
      <div class="cp-trending__item" onclick="location.href='community.php?search=${encodeURIComponent('#'+h.tag)}'">
        <span class="cp-trending__tag">#${esc(h.tag)}</span>
        <span class="cp-trending__count">${h.post_count} posts</span>
      </div>
    `).join('');
  }

  // Users
  const usersEl = document.getElementById('cp-explore-users');
  if (data.suggested_users?.length) {
    usersEl.innerHTML = data.suggested_users.map(u => `
      <div class="cp-follow-suggestion">
        <div class="cp-follow-suggestion__avatar" onclick="location.href='community_profile.php?id=${u.user_id}'">${initials(u.display_name)}</div>
        <div class="cp-follow-suggestion__info">
          <div class="cp-follow-suggestion__name" onclick="location.href='community_profile.php?id=${u.user_id}'">${esc(u.display_name)}</div>
          <div class="cp-follow-suggestion__sub">${u.post_count || 0} publicaciones · ${u.follower_count || 0} seguidores</div>
        </div>
        <button class="cp-follow-suggestion__btn" onclick="exploreFollow(${u.user_id},this)">Seguir</button>
      </div>
    `).join('');
  }

  // Posts
  const postsEl = document.getElementById('cp-explore-posts');
  if (data.trending_posts?.length) {
    postsEl.innerHTML = data.trending_posts.slice(0, 10).map(p => `
      <article class="cp-post" style="margin-bottom:8px">
        <div class="cp-post__header">
          <div class="cp-post__avatar" onclick="location.href='community_profile.php?id=${p.user_id}'">${initials(p.author_name)}</div>
          <div class="cp-post__meta">
            <div class="cp-post__author">${esc(p.author_name)}</div>
            <div class="cp-post__time">${timeAgo(p.created_at)} · ${esc(p.subject||'General')}</div>
          </div>
        </div>
        ${p.post_title ? `<h3 class="cp-post__title">${esc(p.post_title)}</h3>` : ''}
        <div class="cp-post__body">${esc(p.post_body).substring(0, 200)}${p.post_body.length > 200 ? '...' : ''}</div>
        <div class="cp-post__actions">
          <span class="cp-action"><span class="cp-action__icon">❤️</span> ${p.like_count || 0}</span>
          <span class="cp-action"><span class="cp-action__icon">💬</span> ${p.comment_count || 0}</span>
          <a class="cp-action" href="community.php#post-${p.id}"><span class="cp-action__icon">↗</span> Ver</a>
        </div>
      </article>
    `).join('');
  }

  // Search results
  if (search && data.search_results?.length) {
    document.getElementById('cp-explore-results').style.display = 'block';
    document.getElementById('cp-explore-results-list').innerHTML = data.search_results.map(r => {
      if (r.type === 'user') {
        return `<div class="cp-follow-suggestion">
          <div class="cp-follow-suggestion__avatar" onclick="location.href='community_profile.php?id=${r.id}'">${initials(r.title)}</div>
          <div class="cp-follow-suggestion__info">
            <div class="cp-follow-suggestion__name" onclick="location.href='community_profile.php?id=${r.id}'">${esc(r.title)}</div>
            <div class="cp-follow-suggestion__sub">${r.like_count || 0} publicaciones</div>
          </div>
        </div>`;
      }
      return `<article class="cp-post" style="margin-bottom:8px">
        <div class="cp-post__header">
          <div class="cp-post__meta">
            <div class="cp-post__author">${esc(r.author_name)}</div>
            <div class="cp-post__time">${esc(r.subject||'General')}</div>
          </div>
        </div>
        <h3 class="cp-post__title"><a href="community.php#post-${r.id}">${esc(r.title)}</a></h3>
        <div class="cp-post__actions">
          <span class="cp-action"><span class="cp-action__icon">❤️</span> ${r.like_count || 0}</span>
        </div>
      </article>`;
    }).join('');
  } else if (search) {
    document.getElementById('cp-explore-results').style.display = 'block';
    document.getElementById('cp-explore-results-list').innerHTML = '<div class="cp-empty"><div class="cp-empty__text">No se encontraron resultados para "' + esc(search) + '"</div></div>';
  } else {
    document.getElementById('cp-explore-results').style.display = 'none';
  }
}

async function exploreFollow(userId, btn) {
  const csrf = document.querySelector('meta[name="csrf-token"]').content;
  const res = await fetch('api/community.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ action: 'toggle_follow', user_id: userId, csrf_token: csrf })
  });
  const data = await res.json();
  if (data.ok) {
    btn.classList.toggle('cp-follow-suggestion__btn--following', data.active);
    btn.textContent = data.active ? 'Siguiendo' : 'Seguir';
  }
}

let searchTimeout;
document.getElementById('cp-explore-search-main')?.addEventListener('input', (e) => {
  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(() => loadExplore(e.target.value.trim()), 350);
});

document.getElementById('cp-notif-btn')?.addEventListener('click', () => document.getElementById('cp-notif-panel').classList.toggle('hidden'));

loadExplore();
</script>
</body>
</html>
