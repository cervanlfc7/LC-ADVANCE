<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Core/panel_docente.php';
requireStudent();

$currentUserId = !empty($_SESSION['usuario_es_invitado']) ? null : (int)($_SESSION['usuario_id'] ?? 0);
$profileUserId = (int)($_GET['id'] ?? $currentUserId);
$isOwnProfile = $currentUserId === $profileUserId;
?>
<!doctype html>
<html lang="es" data-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="<?= htmlspecialchars(csrfToken()) ?>">
<title>Perfil | LC•PULSO</title>
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
    <a class="cp-nav__link" href="community_bookmarks.php"><span class="cp-nav__icon">🔖</span> Guardados</a>
  </div>
  <div class="cp-nav__actions">
    <button class="cp-notif-btn" id="cp-notif-btn">🔔<span class="cp-notif-badge" id="cp-notif-badge" style="display:none">0</span></button>
    <button class="cp-nav__avatar" onclick="location.href='community_profile.php'"><?= htmlspecialchars(strtoupper(mb_substr($_SESSION['usuario_nombre'] ?? 'E', 0, 1))) ?></button>
  </div>
</nav>

<div class="cp-shell">
  <section class="cp-profile" id="cp-profile">
    <div class="cp-profile__banner"></div>
    <div class="cp-profile__info">
      <div class="cp-profile__avatar" id="cp-profile-avatar">...</div>
      <div class="cp-profile__name" id="cp-profile-name">Cargando...</div>
      <div class="cp-profile__username" id="cp-profile-username"></div>
      <div class="cp-profile__bio" id="cp-profile-bio"></div>
      <div class="cp-profile__stats" id="cp-profile-stats"></div>
      <div class="cp-profile__actions" id="cp-profile-actions"></div>
      <div class="cp-profile__subjects" id="cp-profile-subjects"></div>
    </div>
  </section>

  <div style="margin-top: 16px;">
    <div class="cp-tabs">
      <button class="cp-tab cp-tab--active" data-tab="posts" onclick="switchProfileTab('posts',this)">Publicaciones</button>
      <button class="cp-tab" data-tab="likes" onclick="switchProfileTab('likes',this)">Me gusta</button>
      <button class="cp-tab" data-tab="media" onclick="switchProfileTab('media',this)">Medios</button>
    </div>
    <section id="cp-profile-feed"></section>
  </div>
</div>

<div class="cp-notif-panel hidden" id="cp-notif-panel">
  <div class="cp-notif-panel__header">
    <span class="cp-notif-panel__title">Actividad reciente</span>
    <button class="cp-notif-panel__close" onclick="document.getElementById('cp-notif-panel').classList.add('hidden')">✕</button>
  </div>
  <div id="cp-notif-list"></div>
</div>

<nav class="cp-bottom-nav">
  <a class="cp-bottom-nav__item" href="community.php"><span class="cp-bottom-nav__icon">🏠</span> Inicio</a>
  <a class="cp-bottom-nav__item" href="community_explore.php"><span class="cp-bottom-nav__icon">🔍</span> Explorar</a>
  <a class="cp-bottom-nav__item" href="community_bookmarks.php"><span class="cp-bottom-nav__icon">🔖</span> Guardados</a>
  <a class="cp-bottom-nav__item" onclick="document.getElementById('cp-notif-panel').classList.toggle('hidden')"><span class="cp-bottom-nav__icon">🔔</span> Notif</a>
  <a class="cp-bottom-nav__item cp-bottom-nav__item--active" href="community_profile.php"><span class="cp-bottom-nav__icon">👤</span> Perfil</a>
</nav>

<script src="assets/js/community/app.js"></script>
<script>
const PROFILE_USER_ID = <?= json_encode($profileUserId) ?>;
const CURRENT_USER_ID = <?= json_encode($currentUserId) ?>;
let profileData = null;

async function loadProfile() {
  const res = await fetch(`api/community.php?view=profile&user_id=${PROFILE_USER_ID}`);
  const data = await res.json();
  if (!data.ok) {
    document.getElementById('cp-profile').innerHTML = '<div class="cp-empty"><div class="cp-empty__icon">👤</div><div class="cp-empty__text">Usuario no encontrado</div></div>';
    return;
  }
  profileData = data.profile;
  const p = profileData;
  const name = p.display_name || p.author_name || 'Estudiante';
  document.getElementById('cp-profile-avatar').textContent = name.charAt(0).toUpperCase();
  document.getElementById('cp-profile-name').innerHTML = esc(name) + (p.is_verified ? ' <span class="cp-post__verified">✓</span>' : '');
  document.getElementById('cp-profile-username').textContent = `@${name.toLowerCase().replace(/\s+/g, '_')}`;
  document.getElementById('cp-profile-bio').textContent = p.bio || '';

  const statsHtml = `
    <div class="cp-profile__stat"><div class="cp-profile__stat-value">${p.post_count || 0}</div><div class="cp-profile__stat-label">Publicaciones</div></div>
    <div class="cp-profile__stat"><div class="cp-profile__stat-value">${p.follower_count || 0}</div><div class="cp-profile__stat-label">Seguidores</div></div>
    <div class="cp-profile__stat"><div class="cp-profile__stat-value">${p.following_count || 0}</div><div class="cp-profile__stat-label">Siguiendo</div></div>
    <div class="cp-profile__stat"><div class="cp-profile__stat-value">${p.total_likes_received || 0}</div><div class="cp-profile__stat-label">Me gusta</div></div>
  `;
  document.getElementById('cp-profile-stats').innerHTML = statsHtml;

  let actionsHtml = '';
  if (p.is_self) {
    actionsHtml = '<button class="cp-profile__follow-btn" onclick="editProfile()" style="background:transparent;border:1px solid var(--cp-line);color:var(--cp-ink-secondary)">Editar perfil</button>';
  } else {
    actionsHtml = `<button class="cp-profile__follow-btn ${p.is_following ? 'cp-profile__follow-btn--following' : ''}" onclick="toggleProfileFollow(this)">${p.is_following ? 'Siguiendo' : 'Seguir'}</button>`;
    actionsHtml += `<button class="cp-profile__follow-btn" style="background:transparent;border:1px solid var(--cp-line);color:var(--cp-ink-secondary)" onclick="location.href='community_chat.php?user=${PROFILE_USER_ID}'">💬 Mensaje</button>`;
  }
  document.getElementById('cp-profile-actions').innerHTML = actionsHtml;

  if (p.subjects) {
    const subjects = typeof p.subjects === 'string' ? JSON.parse(p.subjects) : p.subjects;
    document.getElementById('cp-profile-subjects').innerHTML = subjects.map(s => `<span class="cp-profile__subject-tag">${esc(s)}</span>`).join('');
  }

  loadProfilePosts();
}

async function loadProfilePosts() {
  const res = await fetch(`api/community.php?mode=following&limit=20`);
  const data = await res.json();
  if (!data.ok) return;
  const userPosts = data.posts.filter(p => p.user_id == PROFILE_USER_ID);
  const feed = document.getElementById('cp-profile-feed');
  if (!userPosts.length) {
    feed.innerHTML = '<div class="cp-empty"><div class="cp-empty__icon">📝</div><div class="cp-empty__text">Aún no hay publicaciones</div></div>';
    return;
  }
  feed.innerHTML = userPosts.map(post => {
    const tags = (post.tags || '').split(',').filter(Boolean);
    const tagsHtml = tags.length ? `<div class="cp-tags">${tags.map(t => `<span class="cp-tag">#${esc(t)}</span>`).join('')}</div>` : '';
    return `<article class="cp-post" data-post-id="${post.id}">
      <div class="cp-post__header">
        <div class="cp-post__meta">
          <div class="cp-post__author">${esc(post.author_name)}</div>
          <div class="cp-post__time">${timeAgo(post.created_at)}</div>
        </div>
        <span class="cp-post__badge">${esc(post.subject||'General')}</span>
      </div>
      ${post.post_title ? `<h3 class="cp-post__title">${esc(post.post_title)}</h3>` : ''}
      <div class="cp-post__body">${esc(post.post_body)}</div>
      ${tagsHtml}
      <div class="cp-post__actions">
        <span class="cp-action"><span class="cp-action__icon">❤️</span> ${post.like_count || 0}</span>
        <span class="cp-action"><span class="cp-action__icon">💬</span> ${post.comment_count || 0}</span>
      </div>
    </article>`;
  }).join('');
}

async function toggleProfileFollow(btn) {
  const res = await fetch('api/community.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ action: 'toggle_follow', user_id: PROFILE_USER_ID, csrf_token: document.querySelector('meta[name="csrf-token"]').content })
  });
  const data = await res.json();
  if (data.ok) {
    btn.classList.toggle('cp-profile__follow-btn--following', data.active);
    btn.textContent = data.active ? 'Siguiendo' : 'Seguir';
    loadProfile();
  }
}

function editProfile() {
  const name = prompt('Nombre para mostrar:', profileData?.display_name || '');
  if (name === null) return;
  const bio = prompt('Biografía (máx 300 caracteres):', profileData?.bio || '');
  if (bio === null) return;
  fetch('api/community.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ action: 'update_profile', display_name: name, bio: bio, csrf_token: document.querySelector('meta[name="csrf-token"]').content })
  }).then(r => r.json()).then(d => {
    if (d.ok) { CP.toast?.('Perfil actualizado'); loadProfile(); }
    else alert(d.error || 'Error');
  });
}

function switchProfileTab(tab, btn) {
  document.querySelectorAll('[data-tab]').forEach(b => b.classList.remove('cp-tab--active'));
  btn.classList.add('cp-tab--active');
  loadProfilePosts();
}

function esc(v) { const n = document.createElement('div'); n.textContent = v ?? ''; return n.innerHTML; }
function timeAgo(v) {
  const d = Math.floor((Date.now() - new Date(v.replace(' ','T')).getTime()) / 1000);
  if (d < 60) return 'ahora'; if (d < 3600) return Math.floor(d/60)+'m'; if (d < 86400) return Math.floor(d/3600)+'h'; return Math.floor(d/86400)+'d';
}

document.getElementById('cp-notif-btn')?.addEventListener('click', () => document.getElementById('cp-notif-panel').classList.toggle('hidden'));
loadProfile();
</script>
</body>
</html>
