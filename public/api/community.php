<?php
@session_start();
header('Content-Type: application/json; charset=utf-8');
header('X-Powered-By: LC-Advance');

require_once __DIR__ . '/../../src/Config/config.php';

$currentUserId = !empty($_SESSION['usuario_es_invitado']) ? null : (int)($_SESSION['usuario_id'] ?? 0);
$currentUserName = $_SESSION['usuario_nombre'] ?? 'Invitado';

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

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $since = isset($_GET['since']) ? (int)$_GET['since'] : 0;
    
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
    
    $latestId = !empty($posts) ? (int)$posts[0]['id'] : 0;
    
    echo json_encode([
        'ok' => true,
        'posts' => array_reverse($posts),
        'comments' => $commentsByPost,
        'current_user_id' => $currentUserId,
        'latest_id' => $latestId
    ]);
    exit;
}

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!empty($_POST)) $input = array_merge($input ?? [], $_POST);
    
    $action = $input['action'] ?? '';
    
    if ($action === 'create_post') {
        $title = trim((string)($input['title'] ?? ''));
        $body = trim((string)($input['body'] ?? ''));
        
        if ($title === '' || $body === '') {
            echo json_encode(['ok' => false, 'error' => 'Título y cuerpo son requeridos']);
            exit;
        }
        
        $stmt = $pdo->prepare("INSERT INTO community_posts (user_id, author_name, post_title, post_body) VALUES (?, ?, ?, ?)");
        $stmt->execute([$currentUserId, $currentUserName, $title, $body]);
        
        echo json_encode(['ok' => true, 'post_id' => $pdo->lastInsertId()]);
        exit;
    }
    
    if ($action === 'create_comment') {
        $postId = (int)($input['post_id'] ?? 0);
        $comment = trim((string)($input['comment_body'] ?? ''));
        
        if ($postId <= 0 || $comment === '') {
            echo json_encode(['ok' => false, 'error' => 'Datos inválidos']);
            exit;
        }
        
        $stmt = $pdo->prepare("INSERT INTO community_comments (post_id, user_id, author_name, comment_body) VALUES (?, ?, ?, ?)");
        $stmt->execute([$postId, $currentUserId, $currentUserName, $comment]);
        
        echo json_encode(['ok' => true, 'comment_id' => $pdo->lastInsertId()]);
        exit;
    }
    
    if ($action === 'delete_post') {
        $postId = (int)($input['post_id'] ?? 0);
        
        if ($postId <= 0 || !$currentUserId) {
            echo json_encode(['ok' => false, 'error' => 'No autorizado']);
            exit;
        }
        
        $pdo->prepare("DELETE FROM community_comments WHERE post_id=?")->execute([$postId]);
        $stmt = $pdo->prepare("DELETE FROM community_posts WHERE id=? AND user_id=?");
        $stmt->execute([$postId, $currentUserId]);
        
        echo json_encode(['ok' => true]);
        exit;
    }
    
    if ($action === 'delete_comment') {
        $commentId = (int)($input['comment_id'] ?? 0);
        
        if ($commentId <= 0 || !$currentUserId) {
            echo json_encode(['ok' => false, 'error' => 'No autorizado']);
            exit;
        }
        
        $stmt = $pdo->prepare("DELETE FROM community_comments WHERE id=? AND user_id=?");
        $stmt->execute([$commentId, $currentUserId]);
        
        echo json_encode(['ok' => true]);
        exit;
    }
    
    if ($action === 'update_post') {
        $postId = (int)($input['post_id'] ?? 0);
        $title = trim((string)($input['title'] ?? ''));
        $body = trim((string)($input['body'] ?? ''));
        
        if ($postId <= 0 || $title === '' || $body === '' || !$currentUserId) {
            echo json_encode(['ok' => false, 'error' => 'Datos inválidos']);
            exit;
        }
        
        $stmt = $pdo->prepare("UPDATE community_posts SET post_title=?, post_body=? WHERE id=? AND user_id=?");
        $stmt->execute([$title, $body, $postId, $currentUserId]);
        
        echo json_encode(['ok' => true]);
        exit;
    }
    
    if ($action === 'update_comment') {
        $commentId = (int)($input['comment_id'] ?? 0);
        $comment = trim((string)($input['comment_body'] ?? ''));
        
        if ($commentId <= 0 || $comment === '' || !$currentUserId) {
            echo json_encode(['ok' => false, 'error' => 'Datos inválidos']);
            exit;
        }
        
        $stmt = $pdo->prepare("UPDATE community_comments SET comment_body=? WHERE id=? AND user_id=?");
        $stmt->execute([$comment, $commentId, $currentUserId]);
        
        echo json_encode(['ok' => true]);
        exit;
    }
    
    echo json_encode(['ok' => false, 'error' => 'Acción desconocida']);
    exit;
}

http_response_code(405);
echo json_encode(['ok' => false, 'error' => 'Método no permitido']);