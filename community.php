<?php
require_once 'config/config.php';
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validarCsrfToken($_POST['csrf_token'] ?? '')) {
        http_response_code(403);
        exit('Token CSRF inválido');
    }
    $action = $_POST['action'] ?? 'create_post';
    if ($action === 'create_post') {
        $title = trim((string)($_POST['title'] ?? ''));
        $body = trim((string)($_POST['body'] ?? ''));
        if ($title !== '' && $body !== '') {
            $stmt = $pdo->prepare("INSERT INTO community_posts (user_id, author_name, post_title, post_body) VALUES (?, ?, ?, ?)");
            $stmt->execute([$currentUserId, $currentUserName, $title, $body]);
        }
    } elseif ($action === 'update_post') {
        $postId = (int)($_POST['post_id'] ?? 0);
        $title = trim((string)($_POST['title'] ?? ''));
        $body = trim((string)($_POST['body'] ?? ''));
        if ($postId > 0 && $title !== '' && $body !== '' && $currentUserId) {
            $stmt = $pdo->prepare("UPDATE community_posts SET post_title=?, post_body=? WHERE id=? AND user_id=?");
            $stmt->execute([$title, $body, $postId, $currentUserId]);
        }
    } elseif ($action === 'delete_post') {
        $postId = (int)($_POST['post_id'] ?? 0);
        if ($postId > 0 && $currentUserId) {
            $pdo->prepare("DELETE FROM community_comments WHERE post_id=?")->execute([$postId]);
            $pdo->prepare("DELETE FROM community_posts WHERE id=? AND user_id=?")->execute([$postId, $currentUserId]);
        }
    } elseif ($action === 'create_comment') {
        $postId = (int)($_POST['post_id'] ?? 0);
        $comment = trim((string)($_POST['comment_body'] ?? ''));
        if ($postId > 0 && $comment !== '') {
            $stmt = $pdo->prepare("INSERT INTO community_comments (post_id, user_id, author_name, comment_body) VALUES (?, ?, ?, ?)");
            $stmt->execute([$postId, $currentUserId, $currentUserName, $comment]);
        }
    } elseif ($action === 'delete_comment') {
        $commentId = (int)($_POST['comment_id'] ?? 0);
        if ($commentId > 0 && $currentUserId) {
            $stmt = $pdo->prepare("DELETE FROM community_comments WHERE id=? AND user_id=?");
            $stmt->execute([$commentId, $currentUserId]);
        }
    } elseif ($action === 'update_comment') {
        $commentId = (int)($_POST['comment_id'] ?? 0);
        $comment = trim((string)($_POST['comment_body'] ?? ''));
        if ($commentId > 0 && $comment !== '' && $currentUserId) {
            $stmt = $pdo->prepare("UPDATE community_comments SET comment_body=? WHERE id=? AND user_id=?");
            $stmt->execute([$comment, $commentId, $currentUserId]);
        }
    }
    header('Location: community.php');
    exit;
}

$posts = $pdo->query("SELECT id, user_id, author_name, post_title, post_body, created_at FROM community_posts ORDER BY id DESC LIMIT 30")->fetchAll(PDO::FETCH_ASSOC);
$commentsByPost = [];
if (!empty($posts)) {
    $postIds = array_map(static fn($p) => (int)$p['id'], $posts);
    $placeholders = implode(',', array_fill(0, count($postIds), '?'));
    $stmt = $pdo->prepare("SELECT id, post_id, user_id, author_name, comment_body, created_at FROM community_comments WHERE post_id IN ($placeholders) ORDER BY id ASC");
    $stmt->execute($postIds);
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $comment) {
        $commentsByPost[(int)$comment['post_id']][] = $comment;
    }
}
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
    .btn-inline { width:auto; display:inline-block; padding:7px 10px; font-size:12px; margin:0; }
    .actions { display:flex; gap:6px; flex-wrap:wrap; margin-top:10px; }
    .post-title { font-weight:700; margin-bottom:6px; }
    .post-meta { color:rgba(220,236,255,.6); font-size:12px; margin-bottom:8px; }
    .post-body { line-height:1.55; white-space:pre-wrap; }
    .comments { margin-top:12px; border-top:1px solid rgba(0,229,255,.12); padding-top:10px; }
    .comment-item { background:#0c1525; border:1px solid rgba(0,229,255,.1); border-radius:8px; padding:8px; margin-bottom:8px; }
    .comment-meta { font-size:11px; color:rgba(220,236,255,.6); margin-bottom:5px; }
    .comment-body { white-space:pre-wrap; line-height:1.45; font-size:13px; }
    .muted { color:rgba(220,236,255,.6); font-size:12px; }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="top">
      <a href="index.php">Inicio</a>
      <a href="dashboard.php">Dashboard</a>
      <a href="mapa/index.php">Mapa</a>
    </div>

    <h1><?= htmlspecialchars($i18n[$lang]['title']) ?></h1>
    <div class="sub"><?= htmlspecialchars($i18n[$lang]['subtitle']) ?></div>

    <section class="card">
      <h2><?= htmlspecialchars($i18n[$lang]['new_post']) ?></h2>
      <form method="post">
        <input type="hidden" name="action" value="create_post">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
        <input type="text" name="title" maxlength="180" required placeholder="<?= htmlspecialchars($i18n[$lang]['placeholder_title']) ?>">
        <textarea name="body" rows="5" required placeholder="<?= htmlspecialchars($i18n[$lang]['placeholder_body']) ?>"></textarea>
        <button type="submit"><?= htmlspecialchars($i18n[$lang]['publish']) ?></button>
      </form>
    </section>

    <section class="card">
      <h2><?= htmlspecialchars($i18n[$lang]['recent']) ?></h2>
      <?php if (empty($posts)): ?>
        <div><?= htmlspecialchars($i18n[$lang]['empty']) ?></div>
      <?php else: ?>
        <?php foreach ($posts as $post): ?>
          <article class="card" style="margin-bottom:10px;">
            <div class="post-title"><?= htmlspecialchars($post['post_title']) ?></div>
            <div class="post-meta"><?= htmlspecialchars($post['author_name']) ?> · <?= htmlspecialchars($post['created_at']) ?></div>
            <div class="post-body"><?= htmlspecialchars($post['post_body']) ?></div>
            <?php if ($currentUserId && (int)$post['user_id'] === $currentUserId): ?>
              <div class="actions">
                <button class="btn-inline" type="button" onclick="toggleEdit('post-edit-<?= (int)$post['id'] ?>')"><?= htmlspecialchars($i18n[$lang]['edit']) ?></button>
                <form method="post" onsubmit="return confirm(<?= json_encode($i18n[$lang]['confirm_delete']) ?>)">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                  <input type="hidden" name="action" value="delete_post">
                  <input type="hidden" name="post_id" value="<?= (int)$post['id'] ?>">
                  <button class="btn-inline" type="submit"><?= htmlspecialchars($i18n[$lang]['delete']) ?></button>
                </form>
              </div>
              <form method="post" id="post-edit-<?= (int)$post['id'] ?>" style="display:none;margin-top:10px;">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                <input type="hidden" name="action" value="update_post">
                <input type="hidden" name="post_id" value="<?= (int)$post['id'] ?>">
                <input type="text" name="title" maxlength="180" required value="<?= htmlspecialchars($post['post_title']) ?>">
                <textarea name="body" rows="4" required><?= htmlspecialchars($post['post_body']) ?></textarea>
                <button type="submit"><?= htmlspecialchars($i18n[$lang]['save']) ?></button>
              </form>
            <?php endif; ?>

            <div class="comments">
              <strong><?= htmlspecialchars($i18n[$lang]['comments']) ?></strong>
              <?php $postComments = $commentsByPost[(int)$post['id']] ?? []; ?>
              <?php if (empty($postComments)): ?>
                <div class="muted" style="margin-top:6px;"><?= htmlspecialchars($i18n[$lang]['no_comments']) ?></div>
              <?php else: ?>
                <div style="margin-top:8px;">
                  <?php foreach ($postComments as $comment): ?>
                    <div class="comment-item">
                      <div class="comment-meta"><?= htmlspecialchars($comment['author_name']) ?> · <?= htmlspecialchars($comment['created_at']) ?></div>
                      <div class="comment-body"><?= htmlspecialchars($comment['comment_body']) ?></div>
                      <?php if ($currentUserId && (int)$comment['user_id'] === $currentUserId): ?>
                        <div class="actions">
                          <button class="btn-inline" type="button" onclick="toggleEdit('comment-edit-<?= (int)$comment['id'] ?>')"><?= htmlspecialchars($i18n[$lang]['edit']) ?></button>
                          <form method="post" onsubmit="return confirm(<?= json_encode($i18n[$lang]['confirm_delete']) ?>)">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                            <input type="hidden" name="action" value="delete_comment">
                            <input type="hidden" name="comment_id" value="<?= (int)$comment['id'] ?>">
                            <button class="btn-inline" type="submit"><?= htmlspecialchars($i18n[$lang]['delete']) ?></button>
                          </form>
                        </div>
                        <form method="post" id="comment-edit-<?= (int)$comment['id'] ?>" style="display:none;margin-top:8px;">
                          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                          <input type="hidden" name="action" value="update_comment">
                          <input type="hidden" name="comment_id" value="<?= (int)$comment['id'] ?>">
                          <textarea name="comment_body" rows="3" required><?= htmlspecialchars($comment['comment_body']) ?></textarea>
                          <button type="submit"><?= htmlspecialchars($i18n[$lang]['save']) ?></button>
                        </form>
                      <?php endif; ?>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
              <form method="post" style="margin-top:10px;">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                <input type="hidden" name="action" value="create_comment">
                <input type="hidden" name="post_id" value="<?= (int)$post['id'] ?>">
                <textarea name="comment_body" rows="2" required placeholder="<?= htmlspecialchars($i18n[$lang]['comment_placeholder']) ?>"></textarea>
                <button type="submit"><?= htmlspecialchars($i18n[$lang]['comment']) ?></button>
              </form>
            </div>
          </article>
        <?php endforeach; ?>
      <?php endif; ?>
    </section>
  </div>
  <script>
    function toggleEdit(id) {
      const el = document.getElementById(id);
      if (!el) return;
      el.style.display = el.style.display === 'none' || !el.style.display ? 'block' : 'none';
    }
  </script>
</body>
</html>
