<?php
require_once __DIR__ . '/../src/Config/config.php';
requireLogin(true);

$supported_langs = ['es', 'en'];
if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_langs, true)) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'es';
if (!in_array($lang, $supported_langs, true)) {
    $lang = 'es';
}
$i18n = [
    'es' => [
        'title' => 'Comunidad LC-ADVANCE',
        'subtitle' => 'Comparte dudas, tips y avances con otros estudiantes.',
        'new_post' => 'Nueva publicación',
        'placeholder_title' => 'Título del tema',
        'placeholder_body' => 'Escribe tu mensaje...',
        'publish' => 'Publicar',
        'recent' => 'Publicaciones recientes',
        'empty' => 'Aún no hay publicaciones. Sé el primero en participar.',
        'comment' => 'Comentar',
        'comment_placeholder' => 'Escribe un comentario...',
        'save' => 'Guardar',
        'edit' => 'Editar',
        'delete' => 'Eliminar',
        'my_post' => 'Tu publicación',
        'comments' => 'Comentarios',
        'no_comments' => 'Sin comentarios por ahora.',
        'confirm_delete' => '¿Eliminar este contenido?',
    ],
    'en' => [
        'title' => 'LC-ADVANCE Community',
        'subtitle' => 'Share questions, tips, and progress with other students.',
        'new_post' => 'New post',
        'placeholder_title' => 'Topic title',
        'placeholder_body' => 'Write your message...',
        'publish' => 'Publish',
        'recent' => 'Recent posts',
        'empty' => 'No posts yet. Be the first to participate.',
        'comment' => 'Comment',
        'comment_placeholder' => 'Write a comment...',
        'save' => 'Save',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'my_post' => 'Your post',
        'comments' => 'Comments',
        'no_comments' => 'No comments yet.',
        'confirm_delete' => 'Delete this content?',
    ],
];

$pdo->exec("CREATE TABLE IF NOT EXISTS community_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    author_name VARCHAR(100) NOT NULL,
    post_title VARCHAR(180) NOT NULL,
    post_body TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$pdo->exec("CREATE TABLE IF NOT EXISTS community_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NULL,
    author_name VARCHAR(100) NOT NULL,
    comment_body TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_post_id (post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$currentUserId = !empty($_SESSION['usuario_es_invitado']) ? null : (int)($_SESSION['usuario_id'] ?? 0);
$currentUserName = $_SESSION['usuario_nombre'] ?? 'Invitado';
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($i18n[$lang]['title']) ?></title>
  <style>
    body { margin:0; font-family: Arial, sans-serif; background:#0a111d; color:#e8f4ff; }
    .wrap { max-width: 940px; margin: 0 auto; padding: 24px 16px 44px; }
    .top { display:flex; gap:8px; flex-wrap:wrap; align-items:center; margin-bottom:20px; }
    .top a { color:#00e5ff; text-decoration:none; border:1px solid rgba(0,229,255,.25); padding:8px 12px; border-radius:8px; }
    h1 { margin:0 0 6px; font-size:28px; }
    .sub { color:rgba(220,236,255,.7); margin-bottom:22px; }
    .card { background:#101828; border:1px solid rgba(0,229,255,.15); border-radius:12px; padding:14px; margin-bottom:14px; }
    .card h2 { margin:0 0 12px; font-size:14px; text-transform:uppercase; letter-spacing:1px; color:#9edbff; }
    input, textarea, button {
      width:100%; background:#0c1525; color:#e8f4ff; border:1px solid rgba(0,229,255,.2);
      border-radius:8px; padding:10px; font-size:14px; margin-bottom:10px; box-sizing:border-box;
    }
    button { cursor:pointer; background:#00e5ff; color:#061523; font-weight:700; }
    button:hover { background:#33ebff; }
    .btn-inline { width:auto; display:inline-block; padding:7px 10px; font-size:12px; margin:0; }
    .btn-secondary { background:transparent; border:1px solid rgba(0,229,255,.3); color:#00e5ff; }
    .btn-secondary:hover { background:rgba(0,229,255,.15); }
    .btn-danger { background:#ff4757; color:#fff; }
    .btn-danger:hover { background:#ff6b7a; }
    .actions { display:flex; gap:6px; flex-wrap:wrap; margin-top:10px; }
    .post-title { font-weight:700; margin-bottom:6px; font-size:16px; }
    .post-meta { color:rgba(220,236,255,.6); font-size:12px; margin-bottom:8px; }
    .post-body { line-height:1.55; white-space:pre-wrap; }
    .comments { margin-top:12px; border-top:1px solid rgba(0,229,255,.12); padding-top:10px; }
    .comment-item { background:#0c1525; border:1px solid rgba(0,229,255,.1); border-radius:8px; padding:8px; margin-bottom:8px; }
    .comment-meta { font-size:11px; color:rgba(220,236,255,.6); margin-bottom:5px; }
    .comment-body { white-space:pre-wrap; line-height:1.45; font-size:13px; }
    .muted { color:rgba(220,236,255,.6); font-size:12px; }
    .loading { text-align:center; padding:20px; color:rgba(220,236,255,.6); }
    .spinner { display:inline-block; width:16px; height:16px; border:2px solid rgba(0,229,255,.3); border-top-color:#00e5ff; border-radius:50%; animation:spin .8s linear infinite; }
    @keyframes spin { to { transform:rotate(360deg); } }
    .post-form { display:flex; flex-direction:column; gap:10px; }
    .post-form button { margin-top:4px; }
    .notification { position:fixed; bottom:20px; right:20px; background:#101828; border:1px solid #00e5ff; border-radius:8px; padding:12px 20px; color:#e8f4ff; z-index:1000; animation:slideIn .3s ease; box-shadow:0 4px 12px rgba(0,0,0,.4); }
    @keyframes slideIn { from { transform:translateX(100%); opacity:0; } to { transform:translateX(0); opacity:1; } }
    .empty-state { text-align:center; padding:30px; color:rgba(220,236,255,.6); }
    #posts-container { display:flex; flex-direction:column; gap:14px; }
    .edit-form { display:none; gap:10px; flex-direction:column; margin-top:10px; padding:12px; background:rgba(0,229,255,.05); border-radius:8px; }
    .edit-form.active { display:flex; }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="top">
      <a href="../index.php">Inicio</a>
      <a href="dashboard.php?materia=<?= urlencode($_SESSION['selected_materia'] ?? '') ?>">Dashboard</a>
      <a href="mapa/index.php">Mapa</a>
    </div>

    <h1><?= htmlspecialchars($i18n[$lang]['title']) ?></h1>
    <div class="sub"><?= htmlspecialchars($i18n[$lang]['subtitle']) ?></div>

    <section class="card">
      <h2><?= htmlspecialchars($i18n[$lang]['new_post']) ?></h2>
      <div class="post-form">
        <input type="text" id="post-title" maxlength="180" required placeholder="<?= htmlspecialchars($i18n[$lang]['placeholder_title']) ?>">
        <textarea id="post-body" rows="5" required placeholder="<?= htmlspecialchars($i18n[$lang]['placeholder_body']) ?>"></textarea>
        <button onclick="createPost()" id="btn-post"><?= htmlspecialchars($i18n[$lang]['publish']) ?></button>
      </div>
    </section>

    <section class="card">
      <h2><?= htmlspecialchars($i18n[$lang]['recent']) ?></h2>
      <div id="posts-container">
        <div class="loading"><span class="spinner"></span> Cargando...</div>
      </div>
    </section>
  </div>

  <script>
    const i18n = <?= json_encode($i18n[$lang]) ?>;
    let currentUserId = <?= json_encode($currentUserId) ?>;
    let latestId = 0;
    let pollInterval = null;

    function $(id) { return document.getElementById(id); }

    async function apiCall(endpoint, data = null) {
      const opts = { headers: { 'Content-Type': 'application/json' } };
      if (data) opts.method = 'POST', opts.body = JSON.stringify(data);
      const res = await fetch(endpoint, opts);
      return res.json();
    }

    function showNotification(msg) {
      const div = document.createElement('div');
      div.className = 'notification';
      div.textContent = msg;
      document.body.appendChild(div);
      setTimeout(() => div.remove(), 3000);
    }

    function escapeHtml(str) {
      const div = document.createElement('div');
      div.textContent = str;
      return div.innerHTML;
    }

    function toggleEdit(id) {
      const el = $(id);
      if (el) el.classList.toggle('active');
    }

    function formatDate(dateStr) {
      const d = new Date(dateStr);
      return d.toLocaleString('es-MX', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
    }

    async function createPost() {
      const title = $('post-title').value.trim();
      const body = $('post-body').value.trim();
      if (!title || !body) return;
      
      $('btn-post').disabled = true;
      const res = await apiCall('api/community.php', { action: 'create_post', title, body });
      
      if (res.ok) {
        $('post-title').value = '';
        $('post-body').value = '';
        showNotification('✅ Publicación creada');
        loadPosts();
      } else {
        showNotification('❌ ' + (res.error || 'Error'));
      }
      $('btn-post').disabled = false;
    }

    async function deletePost(id) {
      if (!confirm(i18n.confirm_delete)) return;
      const res = await apiCall('api/community.php', { action: 'delete_post', post_id: id });
      if (res.ok) {
        showNotification('✅ Eliminado');
        loadPosts();
      } else showNotification('❌ ' + (res.error || 'Error'));
    }

    async function updatePost(id) {
      const title = $('edit-title-' + id).value.trim();
      const body = $('edit-body-' + id).value.trim();
      if (!title || !body) return;
      
      const res = await apiCall('api/community.php', { action: 'update_post', post_id: id, title, body });
      if (res.ok) {
        showNotification('✅ Actualizado');
        loadPosts();
      } else showNotification('❌ ' + (res.error || 'Error'));
    }

    async function createComment(postId) {
      const textarea = $('comment-input-' + postId);
      const body = textarea.value.trim();
      if (!body) return;
      
      const res = await apiCall('api/community.php', { action: 'create_comment', post_id: postId, comment_body: body });
      if (res.ok) {
        textarea.value = '';
        showNotification('✅ Comentario añadido');
        loadPosts();
      } else showNotification('❌ ' + (res.error || 'Error'));
    }

    async function deleteComment(id) {
      if (!confirm(i18n.confirm_delete)) return;
      const res = await apiCall('api/community.php', { action: 'delete_comment', comment_id: id });
      if (res.ok) {
        showNotification('✅ Eliminado');
        loadPosts();
      } else showNotification('❌ ' + (res.error || 'Error'));
    }

    async function updateComment(id) {
      const body = $('edit-comment-' + id).value.trim();
      if (!body) return;
      
      const res = await apiCall('api/community.php', { action: 'update_comment', comment_id: id, comment_body: body });
      if (res.ok) {
        showNotification('✅ Actualizado');
        loadPosts();
      } else showNotification('❌ ' + (res.error || 'Error'));
    }

    function renderPost(post) {
      const isOwner = currentUserId && post.user_id == currentUserId;
      const comments = post.comments || [];
      
      let commentsHtml = `<div class="muted" style="margin-top:6px;">${i18n.no_comments}</div>`;
      if (comments.length > 0) {
        commentsHtml = `<div style="margin-top:8px;">${comments.map(c => renderComment(c)).join('')}</div>`;
      }
      
      const actionsHtml = isOwner ? `
        <div class="actions">
          <button class="btn-inline btn-secondary" onclick="toggleEdit('post-edit-${post.id}')">${i18n.edit}</button>
          <button class="btn-inline btn-danger" onclick="deletePost(${post.id})">${i18n.delete}</button>
        </div>
        <div id="post-edit-${post.id}" class="edit-form">
          <input type="text" id="edit-title-${post.id}" value="${escapeHtml(post.post_title)}" maxlength="180">
          <textarea id="edit-body-${post.id}" rows="4">${escapeHtml(post.post_body)}</textarea>
          <button class="btn-inline" onclick="updatePost(${post.id})">${i18n.save}</button>
        </div>
      ` : '';
      
      return `
        <article class="card" style="margin-bottom:10px;">
          <div class="post-title">${escapeHtml(post.post_title)}</div>
          <div class="post-meta">${escapeHtml(post.author_name)} · ${formatDate(post.created_at)}</div>
          <div class="post-body">${escapeHtml(post.post_body)}</div>
          ${actionsHtml}
          <div class="comments">
            <strong>${i18n.comments}</strong>
            ${commentsHtml}
            <form style="margin-top:10px;" onsubmit="event.preventDefault(); createComment(${post.id})">
              <textarea id="comment-input-${post.id}" rows="2" required placeholder="${i18n.comment_placeholder}"></textarea>
              <button type="submit" class="btn-inline">${i18n.comment}</button>
            </form>
          </div>
        </article>
      `;
    }

    function renderComment(comment) {
      const isOwner = currentUserId && comment.user_id == currentUserId;
      const actionsHtml = isOwner ? `
        <div class="actions">
          <button class="btn-inline btn-secondary" style="padding:4px 8px;font-size:10px;" onclick="toggleEdit('comment-edit-${comment.id}')">${i18n.edit}</button>
          <button class="btn-inline btn-danger" style="padding:4px 8px;font-size:10px;" onclick="deleteComment(${comment.id})">${i18n.delete}</button>
        </div>
        <div id="comment-edit-${comment.id}" class="edit-form">
          <textarea id="edit-comment-${comment.id}" rows="3">${escapeHtml(comment.comment_body)}</textarea>
          <button class="btn-inline" onclick="updateComment(${comment.id})">${i18n.save}</button>
        </div>
      ` : '';
      
      return `
        <div class="comment-item">
          <div class="comment-meta">${escapeHtml(comment.author_name)} · ${formatDate(comment.created_at)}</div>
          <div class="comment-body">${escapeHtml(comment.comment_body)}</div>
          ${actionsHtml}
        </div>
      `;
    }

    async function loadPosts() {
      const res = await apiCall('api/community.php');
      const container = $('posts-container');
      
      if (!res.ok) {
        container.innerHTML = '<div class="empty-state">Error al cargar</div>';
        return;
      }
      
      if (res.posts.length === 0) {
        container.innerHTML = `<div class="empty-state">${i18n.empty}</div>`;
        return;
      }
      
      if (res.latest_id !== latestId) {
        latestId = res.latest_id;
      }
      
      container.innerHTML = res.posts.map(post => renderPost(post)).join('');
    }

    loadPosts();
    pollInterval = setInterval(loadPosts, 3000);
  </script>
</body>
</html>