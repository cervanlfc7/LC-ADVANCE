<?php
@session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../../src/Config/config.php';

$currentUserId = !empty($_SESSION['usuario_es_invitado']) ? null : (int)($_SESSION['usuario_id'] ?? 0);
$currentUserName = trim((string)($_SESSION['usuario_nombre'] ?? 'Invitado')) ?: 'Invitado';

/* ── Auto-migrate tables ──────────────────────────────────────── */
$tables = [
"CREATE TABLE IF NOT EXISTS community_posts (
    id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NULL, author_name VARCHAR(100) NOT NULL,
    post_title VARCHAR(180) NOT NULL DEFAULT '', post_body TEXT NOT NULL,
    category VARCHAR(30) NOT NULL DEFAULT 'general', subject VARCHAR(120) NOT NULL DEFAULT 'General',
    tags VARCHAR(500) NOT NULL DEFAULT '', post_type VARCHAR(20) NOT NULL DEFAULT 'text',
    media JSON NULL, poll_data JSON NULL, quote_parent_id INT NULL, thread_parent_id INT NULL,
    is_pinned TINYINT(1) NOT NULL DEFAULT 0, is_featured TINYINT(1) NOT NULL DEFAULT 0,
    is_edited TINYINT(1) NOT NULL DEFAULT 0, is_deleted TINYINT(1) NOT NULL DEFAULT 0,
    like_count INT NOT NULL DEFAULT 0, comment_count INT NOT NULL DEFAULT 0,
    save_count INT NOT NULL DEFAULT 0, share_count INT NOT NULL DEFAULT 0,
    view_count INT NOT NULL DEFAULT 0, engagement_score DECIMAL(12,4) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, updated_at DATETIME NULL DEFAULT NULL,
    INDEX idx_cp_created (created_at), INDEX idx_cp_category (category),
    INDEX idx_cp_subject (subject), INDEX idx_cp_type (post_type),
    INDEX idx_cp_user (user_id), INDEX idx_cp_engagement (engagement_score DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_comments (
    id INT AUTO_INCREMENT PRIMARY KEY, post_id INT NOT NULL, user_id INT NULL,
    author_name VARCHAR(100) NOT NULL, comment_body TEXT NOT NULL,
    parent_id INT NULL, reply_to_user_id INT NULL, reply_to_user_name VARCHAR(100) NULL,
    media JSON NULL, like_count INT NOT NULL DEFAULT 0, is_edited TINYINT(1) NOT NULL DEFAULT 0,
    is_deleted TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cc_post (post_id), INDEX idx_cc_parent (parent_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_likes (
    user_id INT NOT NULL, target_type ENUM('post','comment') NOT NULL DEFAULT 'post',
    target_id INT NOT NULL, created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, target_type, target_id),
    INDEX idx_cl_target (target_type, target_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_saves (
    user_id INT NOT NULL, post_id INT NOT NULL, collection_name VARCHAR(60) NOT NULL DEFAULT 'default',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, post_id), INDEX idx_cs_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_collections (
    id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, name VARCHAR(60) NOT NULL,
    description VARCHAR(200) NOT NULL DEFAULT '', is_public TINYINT(1) NOT NULL DEFAULT 0,
    post_count INT NOT NULL DEFAULT 0, created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_cc_user_name (user_id, name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_follows (
    follower_id INT NOT NULL, followed_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (follower_id, followed_id), INDEX idx_cf_followed (followed_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_reactions (
    post_id INT NOT NULL, user_id INT NOT NULL, reaction VARCHAR(16) NOT NULL DEFAULT 'like',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (post_id, user_id), INDEX idx_cr_post (post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_notifications (
    id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, actor_id INT NULL,
    actor_name VARCHAR(100) NULL, type VARCHAR(32) NOT NULL,
    post_id INT NULL, comment_id INT NULL, message VARCHAR(255) NOT NULL,
    url VARCHAR(255) NULL, is_read TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cn_user_read (user_id, is_read, id DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_stories (
    id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, author_name VARCHAR(100) NOT NULL,
    story_text VARCHAR(280) NOT NULL DEFAULT '', media_url VARCHAR(500) NULL,
    media_type VARCHAR(10) NULL, subject VARCHAR(120) NOT NULL DEFAULT 'General',
    bg_color VARCHAR(20) NULL, view_count INT NOT NULL DEFAULT 0,
    expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cs_expiry (expires_at, id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_story_views (
    story_id INT NOT NULL, user_id INT NOT NULL,
    viewed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (story_id, user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_reports (
    id INT AUTO_INCREMENT PRIMARY KEY, reporter_id INT NOT NULL,
    target_type VARCHAR(16) NOT NULL, target_id INT NOT NULL,
    reason VARCHAR(64) NOT NULL, details TEXT NULL,
    status VARCHAR(16) NOT NULL DEFAULT 'open',
    moderator_id INT NULL, moderator_note TEXT NULL, resolved_at DATETIME NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_crpt_status (status, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_profiles (
    user_id INT PRIMARY KEY, display_name VARCHAR(60) NOT NULL DEFAULT '',
    bio VARCHAR(300) NOT NULL DEFAULT '', avatar_url VARCHAR(500) NULL,
    banner_url VARCHAR(500) NULL, website VARCHAR(200) NULL, location VARCHAR(100) NULL,
    subjects JSON NULL, badges JSON NULL,
    post_count INT NOT NULL DEFAULT 0, follower_count INT NOT NULL DEFAULT 0,
    following_count INT NOT NULL DEFAULT 0, total_likes_received INT NOT NULL DEFAULT 0,
    streak_days INT NOT NULL DEFAULT 0, last_active_at DATETIME NULL,
    is_verified TINYINT(1) NOT NULL DEFAULT 0, is_private TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, updated_at DATETIME NULL DEFAULT NULL,
    INDEX idx_cp_name (display_name), INDEX idx_cp_streak (streak_days DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_media (
    id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL,
    file_path VARCHAR(500) NOT NULL, file_name VARCHAR(200) NOT NULL,
    file_type VARCHAR(20) NOT NULL, file_size INT NOT NULL DEFAULT 0,
    width INT NULL, height INT NULL, duration_ms INT NULL,
    alt_text VARCHAR(200) NULL, thumbnail_path VARCHAR(500) NULL,
    is_processed TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cm_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_polls (
    id INT AUTO_INCREMENT PRIMARY KEY, post_id INT NOT NULL,
    question VARCHAR(300) NOT NULL, options JSON NOT NULL,
    total_votes INT NOT NULL DEFAULT 0, ends_at DATETIME NULL,
    is_anonymous TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cpl_post (post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_poll_votes (
    poll_id INT NOT NULL, user_id INT NOT NULL, option_index TINYINT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (poll_id, user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_mentions (
    id INT AUTO_INCREMENT PRIMARY KEY, source_type VARCHAR(16) NOT NULL,
    source_id INT NOT NULL, mentioned_user_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cm_user (mentioned_user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_hashtags (
    id INT AUTO_INCREMENT PRIMARY KEY, tag VARCHAR(100) NOT NULL,
    post_count INT NOT NULL DEFAULT 0, trend_score DECIMAL(12,4) NOT NULL DEFAULT 0,
    last_used_at DATETIME NULL, created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_ch_tag (tag), INDEX idx_ch_trend (trend_score DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_bookmarks (
    user_id INT NOT NULL, post_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_drafts (
    id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL,
    title VARCHAR(180) NOT NULL DEFAULT '', body TEXT NOT NULL,
    category VARCHAR(30) NOT NULL DEFAULT 'general',
    subject VARCHAR(120) NOT NULL DEFAULT 'General',
    tags VARCHAR(500) NOT NULL DEFAULT '', media JSON NULL,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_cd_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_blocks (
    blocker_id INT NOT NULL, blocked_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (blocker_id, blocked_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_restrictions (
    id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL,
    type VARCHAR(20) NOT NULL, reason VARCHAR(200) NOT NULL,
    expires_at DATETIME NULL, created_by INT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cr_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_search_history (
    id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL,
    query VARCHAR(200) NOT NULL, result_count INT NOT NULL DEFAULT 0,
    searched_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_csh_user (user_id, searched_at DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
"CREATE TABLE IF NOT EXISTS community_post_views (
    post_id INT NOT NULL, user_id INT NULL, session_id VARCHAR(64) NULL,
    viewed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cpv_post (post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
];

foreach ($tables as $sql) {
    try { $pdo->exec($sql); } catch (Throwable $e) {}
}

// Legacy ALTERs
$legacyAlters = [
    "ALTER TABLE community_posts ADD COLUMN category VARCHAR(30) NOT NULL DEFAULT 'general'",
    "ALTER TABLE community_posts ADD COLUMN subject VARCHAR(120) NOT NULL DEFAULT 'General'",
    "ALTER TABLE community_posts ADD COLUMN tags VARCHAR(500) NOT NULL DEFAULT ''",
    "ALTER TABLE community_posts ADD COLUMN updated_at DATETIME NULL DEFAULT NULL",
    "ALTER TABLE community_posts ADD COLUMN post_type VARCHAR(20) NOT NULL DEFAULT 'text'",
    "ALTER TABLE community_posts ADD COLUMN media JSON NULL",
    "ALTER TABLE community_posts ADD COLUMN poll_data JSON NULL",
    "ALTER TABLE community_posts ADD COLUMN quote_parent_id INT NULL",
    "ALTER TABLE community_posts ADD COLUMN is_pinned TINYINT(1) NOT NULL DEFAULT 0",
    "ALTER TABLE community_posts ADD COLUMN is_edited TINYINT(1) NOT NULL DEFAULT 0",
    "ALTER TABLE community_posts ADD COLUMN is_deleted TINYINT(1) NOT NULL DEFAULT 0",
    "ALTER TABLE community_posts ADD COLUMN like_count INT NOT NULL DEFAULT 0",
    "ALTER TABLE community_posts ADD COLUMN comment_count INT NOT NULL DEFAULT 0",
    "ALTER TABLE community_posts ADD COLUMN engagement_score DECIMAL(12,4) NOT NULL DEFAULT 0",
    "ALTER TABLE community_comments ADD COLUMN parent_id INT NULL",
    "ALTER TABLE community_comments ADD COLUMN reply_to_user_id INT NULL",
    "ALTER TABLE community_comments ADD COLUMN reply_to_user_name VARCHAR(100) NULL",
    "ALTER TABLE community_comments ADD COLUMN like_count INT NOT NULL DEFAULT 0",
    "ALTER TABLE community_notifications ADD COLUMN actor_name VARCHAR(100) NULL",
    "ALTER TABLE community_notifications ADD COLUMN is_read TINYINT(1) NOT NULL DEFAULT 0",
    "ALTER TABLE community_notifications ADD COLUMN url VARCHAR(255) NULL",
];
foreach ($legacyAlters as $sql) {
    try { $pdo->exec($sql); } catch (Throwable $e) {}
}

/* ── Helpers ──────────────────────────────────────────────────── */
function communityJson(array $payload, int $status = 200): void {
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}
function requireCommunityUser(?int $userId): int {
    if (!$userId) communityJson(['ok' => false, 'error' => 'Inicia sesión para participar.'], 401);
    return $userId;
}
function normalizedTags(string $tags): string {
    $items = preg_split('/[,\s]+/', trim($tags), -1, PREG_SPLIT_NO_EMPTY);
    $items = array_values(array_unique(array_filter(array_map(static function ($tag) {
        return preg_replace('/[^\p{L}\p{N}_-]/u', '', ltrim($tag, '#'));
    }, $items))));
    return implode(',', array_slice($items, 0, 8));
}
function communityNotify(PDO $pdo, int $userId, ?int $actorId, string $type, ?int $postId, ?int $commentId, string $message): void {
    if ($userId <= 0 || $userId === $actorId) return;
    $actorName = '';
    if ($actorId) {
        $stmt = $pdo->prepare('SELECT usuario_nombre FROM usuarios WHERE id = ?');
        $stmt->execute([$actorId]);
        $actorName = $stmt->fetchColumn() ?: '';
    }
    $stmt = $pdo->prepare('INSERT INTO community_notifications (user_id, actor_id, actor_name, type, post_id, comment_id, message) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$userId, $actorId, $actorName, $type, $postId, $commentId, mb_substr($message, 0, 255)]);
}

/* ── Seed data (run once) ─────────────────────────────────────── */
$communitySeed = [
    ['pregunta', 'Programación', '¿Cómo organizan sus funciones antes de empezar a programar?', 'Compartir pseudocódigo y dividir el problema en pasos me ayudó bastante.', 'programacion,estudio'],
    ['recursos', 'Ciencias Sociales', 'Mapa de ideas para preparar el examen', 'Dejo una forma rápida de conectar causas, consecuencias y actores históricos.', 'historia,repaso'],
    ['logro', 'Pensamiento Matemático III', 'Por fin entendí las derivadas', 'La clave fue interpretar la pendiente como cambio instantáneo y practicar con gráficas.', 'matematicas,logro'],
    ['proyecto', 'Ecosistemas', 'Busco equipo para proyecto de ecosistemas', '¿Alguien quiere comparar soluciones para recuperar un ecosistema después de una perturbación?', 'proyecto,equipo'],
];
$seedCount = (int)$pdo->query("SELECT COUNT(*) FROM community_posts WHERE author_name = 'LC-ADVANCE'")->fetchColumn();
if ($seedCount === 0) {
    $seedStmt = $pdo->prepare('INSERT INTO community_posts (user_id, author_name, post_title, post_body, category, subject, tags) VALUES (NULL, ?, ?, ?, ?, ?, ?)');
    foreach ($communitySeed as $seed) $seedStmt->execute(['LC-ADVANCE', $seed[2], $seed[3], $seed[0], $seed[1], $seed[4]]);
}

/* ── Hashtag sync ─────────────────────────────────────────────── */
function syncHashtags(PDO $pdo, string $tags, ?int $postId): void {
    if (!$postId || !$tags) return;
    $tags = array_filter(explode(',', $tags));
    foreach ($tags as $tag) {
        $tag = strtolower(trim($tag));
        if (!$tag) continue;
        $pdo->prepare('INSERT INTO community_hashtags (tag, post_count, last_used_at) VALUES (?, 1, NOW()) ON DUPLICATE KEY UPDATE post_count = post_count + 1, last_used_at = NOW(), trend_score = post_count * 3 + GREATEST(0, 86400 - TIMESTAMPDIFF(HOUR, last_used_at, NOW())) / 24')->execute([$tag]);
    }
}

/* ── POST / GET Router ────────────────────────────────────────── */
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET') {
    $view = $_GET['view'] ?? '';

    // Stories
    if ($view === 'stories') {
        $pdo->exec('DELETE FROM community_stories WHERE expires_at < NOW()');
        $stories = $pdo->query('SELECT id, user_id, author_name, story_text, subject, media_url, media_type, created_at, expires_at FROM community_stories ORDER BY id DESC LIMIT 30')->fetchAll(PDO::FETCH_ASSOC);
        communityJson(['ok' => true, 'stories' => $stories]);
    }

    // Notifications
    if ($view === 'notifications') {
        if (!$currentUserId) communityJson(['ok' => true, 'notifications' => [], 'unread' => 0]);
        $stmt = $pdo->prepare('SELECT id, type, post_id, comment_id, message, is_read, actor_name, created_at FROM community_notifications WHERE user_id = ? ORDER BY id DESC LIMIT 40');
        $stmt->execute([$currentUserId]);
        $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $unread = count(array_filter($notifications, static fn($item) => !$item['is_read']));
        communityJson(['ok' => true, 'notifications' => $notifications, 'unread' => $unread]);
    }

    // Sidebar data (trending + suggested users)
    if ($view === 'sidebar') {
        $hashtags = $pdo->query('SELECT tag, post_count, trend_score FROM community_hashtags ORDER BY trend_score DESC LIMIT 10')->fetchAll(PDO::FETCH_ASSOC);
        $suggested = [];
        if ($currentUserId) {
            $suggested = $pdo->query("SELECT u.id AS user_id, COALESCE(p.display_name, u.usuario_nombre) AS display_name, p.avatar_url, p.post_count, 0 AS is_following FROM usuarios u LEFT JOIN community_profiles p ON p.user_id = u.id WHERE u.id != $currentUserId AND u.rol = 'estudiante' ORDER BY p.post_count DESC, RAND() LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
        }
        communityJson(['ok' => true, 'hashtags' => $hashtags, 'suggested_users' => $suggested]);
    }

    // User profile
    if ($view === 'profile') {
        $profileUserId = (int)($_GET['user_id'] ?? 0);
        if (!$profileUserId) communityJson(['ok' => false, 'error' => 'Usuario no encontrado.'], 404);
        $stmt = $pdo->prepare("SELECT u.id, COALESCE(p.display_name, u.usuario_nombre) AS display_name, COALESCE(p.bio, '') AS bio, p.avatar_url, p.banner_url, p.website, p.location, p.subjects, p.badges, p.post_count, p.follower_count, p.following_count, p.total_likes_received, p.streak_days, p.is_verified, p.created_at FROM usuarios u LEFT JOIN community_profiles p ON p.user_id = u.id WHERE u.id = ?");
        $stmt->execute([$profileUserId]);
        $profile = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$profile) communityJson(['ok' => false, 'error' => 'Usuario no encontrado.'], 404);
        $isFollowing = false;
        if ($currentUserId && $currentUserId !== $profileUserId) {
            $fstmt = $pdo->prepare('SELECT 1 FROM community_follows WHERE follower_id = ? AND followed_id = ?');
            $fstmt->execute([$currentUserId, $profileUserId]);
            $isFollowing = (bool)$fstmt->fetchColumn();
        }
        $profile['is_following'] = $isFollowing;
        $profile['is_self'] = $currentUserId === $profileUserId;
        communityJson(['ok' => true, 'profile' => $profile]);
    }

    // Explore page data
    if ($view === 'explore') {
        $search = trim((string)($_GET['search'] ?? ''));
        $trending = $pdo->query('SELECT tag, post_count, trend_score FROM community_hashtags ORDER BY trend_score DESC LIMIT 20')->fetchAll(PDO::FETCH_ASSOC);
        $trendingPosts = $pdo->query('SELECT p.id, p.user_id, p.author_name, p.post_title, p.post_body, p.category, p.subject, p.tags, p.post_type, p.media, p.like_count, p.comment_count, p.created_at FROM community_posts p WHERE p.is_deleted = 0 ORDER BY p.engagement_score DESC, p.like_count DESC, p.created_at DESC LIMIT 20')->fetchAll(PDO::FETCH_ASSOC);
        $suggestedUsers = $pdo->query("SELECT u.id AS user_id, COALESCE(p.display_name, u.usuario_nombre) AS display_name, p.avatar_url, p.bio, p.post_count, p.follower_count FROM usuarios u LEFT JOIN community_profiles p ON p.user_id = u.id WHERE u.rol = 'estudiante' ORDER BY p.follower_count DESC, p.post_count DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
        $results = [];
        if ($search !== '') {
            $like = "%$search%";
            $rstmt = $pdo->prepare("(SELECT 'post' AS type, p.id, p.post_title AS title, p.author_name, p.subject, p.like_count, p.created_at FROM community_posts p WHERE p.is_deleted = 0 AND (p.post_title LIKE ? OR p.post_body LIKE ? OR p.tags LIKE ?) ORDER BY p.engagement_score DESC LIMIT 20) UNION (SELECT 'user' AS type, u.id, COALESCE(p.display_name, u.usuario_nombre) AS title, '' AS author_name, '' AS subject, p.post_count AS like_count, u.id AS created_at FROM usuarios u LEFT JOIN community_profiles p ON p.user_id = u.id WHERE (u.usuario_nombre LIKE ? OR p.display_name LIKE ?) LIMIT 10)");
            $rstmt->execute([$like, $like, $like, $like, $like]);
            $results = $rstmt->fetchAll(PDO::FETCH_ASSOC);
        }
        communityJson(['ok' => true, 'trending' => $trending, 'trending_posts' => $trendingPosts, 'suggested_users' => $suggestedUsers, 'search_results' => $results]);
    }

    // Bookmarks
    if ($view === 'bookmarks') {
        if (!$currentUserId) communityJson(['ok' => true, 'posts' => []]);
        $stmt = $pdo->prepare("SELECT p.id, p.user_id, p.author_name, p.post_title, p.post_body, p.category, p.subject, p.tags, p.post_type, p.media, p.created_at, 1 AS saved FROM community_posts p INNER JOIN community_bookmarks b ON b.post_id = p.id WHERE b.user_id = ? AND p.is_deleted = 0 ORDER BY b.created_at DESC LIMIT 30");
        $stmt->execute([$currentUserId]);
        communityJson(['ok' => true, 'posts' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
    }

    // ── Feed ──
    $category = trim((string)($_GET['category'] ?? 'all'));
    $search = trim((string)($_GET['search'] ?? ''));
    $mode = in_array(($_GET['mode'] ?? 'for_you'), ['for_you', 'following', 'recent'], true) ? $_GET['mode'] : 'for_you';
    $sort = ($_GET['sort'] ?? 'recent') === 'popular' ? 'popular' : 'recent';
    $limit = min(30, max(1, (int)($_GET['limit'] ?? 12)));
    $cursor = max(0, (int)($_GET['cursor'] ?? 0));

    $where = ['p.is_deleted = 0'];
    $params = [$currentUserId ?: 0, $currentUserId ?: 0, $currentUserId ?: 0];

    $subject = trim((string)($_GET['subject'] ?? 'all'));
    if ($category !== '' && $category !== 'all') { $where[] = 'p.category = ?'; $params[] = $category; }
    if ($subject !== '' && $subject !== 'all') { $where[] = 'p.subject = ?'; $params[] = $subject; }
    if ($cursor > 0) { $where[] = 'p.id < ?'; $params[] = $cursor; }
    if ($mode === 'following' && $currentUserId) {
        $where[] = '(p.user_id = ? OR EXISTS (SELECT 1 FROM community_follows f WHERE f.follower_id = ? AND f.followed_id = p.user_id))';
        $params[] = $currentUserId;
        $params[] = $currentUserId;
    }
    if ($search !== '') {
        $where[] = '(p.post_title LIKE ? OR p.post_body LIKE ? OR p.tags LIKE ? OR p.author_name LIKE ?)';
        array_push($params, "%$search%", "%$search%", "%$search%", "%$search%");
    }

    $whereSql = 'WHERE ' . implode(' AND ', $where);
    $orderSql = $mode === 'for_you' || $sort === 'popular'
        ? 'ORDER BY p.is_pinned DESC, (p.like_count * 3 + p.comment_count * 4 + p.view_count * 0.5 + GREATEST(0, 86400 - TIMESTAMPDIFF(HOUR, p.created_at, NOW())) / 24) DESC, p.id DESC'
        : 'ORDER BY p.is_pinned DESC, p.id DESC';

    $sql = "SELECT p.id, p.user_id, p.author_name, p.post_title, p.post_body, p.category, p.subject, p.tags,
            p.post_type, p.media, p.poll_data, p.quote_parent_id, p.is_pinned, p.is_edited,
            p.like_count, p.comment_count, p.view_count, p.engagement_score, p.created_at, p.updated_at,
            MAX(CASE WHEN l.user_id = ? THEN 1 ELSE 0 END) AS liked,
            MAX(CASE WHEN s.user_id = ? THEN 1 ELSE 0 END) AS saved,
            MAX(CASE WHEN r.user_id = ? THEN r.reaction ELSE NULL END) AS my_reaction,
            GROUP_CONCAT(DISTINCT r.reaction ORDER BY r.reaction SEPARATOR ',') AS reactions
            FROM community_posts p
            LEFT JOIN community_likes l ON l.target_type = 'post' AND l.target_id = p.id
            LEFT JOIN community_saves s ON s.post_id = p.id
            LEFT JOIN community_reactions r ON r.post_id = p.id
            $whereSql GROUP BY p.id $orderSql LIMIT $limit";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $comments = [];
    if ($posts) {
        $ids = array_map(static fn($post) => (int)$post['id'], $posts);
        $marks = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $pdo->prepare("SELECT id, post_id, parent_id, user_id, author_name, comment_body, reply_to_user_name, created_at FROM community_comments WHERE post_id IN ($marks) AND is_deleted = 0 ORDER BY id ASC");
        $stmt->execute($ids);
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $comment) $comments[(int)$comment['post_id']][] = $comment;
    }

    $latest = (int)($pdo->query('SELECT COALESCE(MAX(id), 0) FROM community_posts WHERE is_deleted = 0')->fetchColumn() ?: 0);
    $nextCursor = count($posts) === $limit && $posts ? (int)$posts[count($posts) - 1]['id'] : null;

    // Increment view counts
    if ($posts && $currentUserId) {
        $viewStmt = $pdo->prepare('INSERT IGNORE INTO community_post_views (post_id, user_id) VALUES (?, ?)');
        foreach ($posts as $p) $viewStmt->execute([$p['id'], $currentUserId]);
    }

    communityJson(['ok' => true, 'posts' => $posts, 'comments' => $comments, 'latest_id' => $latest, 'next_cursor' => $nextCursor, 'current_user_id' => $currentUserId]);
}

if ($method !== 'POST') communityJson(['ok' => false, 'error' => 'Método no permitido.'], 405);
$input = json_decode(file_get_contents('php://input'), true) ?: [];
if (!empty($_POST)) $input = array_merge($input, $_POST);
if (!validarCsrfToken($input['csrf_token'] ?? '')) communityJson(['ok' => false, 'error' => 'CSRF inválido.'], 403);
$action = (string)($input['action'] ?? '');

/* ── Create Post ──────────────────────────────────────────────── */
if ($action === 'create_post') {
    requireCommunityUser($currentUserId);
    $title = trim((string)($input['title'] ?? ''));
    $body = trim((string)($input['body'] ?? ''));
    $subject = trim((string)($input['subject'] ?? 'General'));
    $validCategories = ['general', 'pregunta', 'logro', 'proyecto', 'recursos'];
    $category = in_array(($input['category'] ?? ''), $validCategories, true) ? $input['category'] : 'general';
    $tags = normalizedTags((string)($input['tags'] ?? ''));
    if ($body === '') communityJson(['ok' => false, 'error' => 'Escribe algo para publicar.'], 422);
    if (mb_strlen($title) > 180 || mb_strlen($body) > 5000) communityJson(['ok' => false, 'error' => 'La publicación supera el límite permitido.'], 422);

    $media = null;
    if (!empty($input['media']) && is_array($input['media'])) {
        $media = json_encode(array_slice($input['media'], 0, 10));
    }

    $postType = 'text';
    if ($media) $postType = 'image';
    if (!empty($input['poll_data'])) $postType = 'poll';
    if (!empty($input['quote_parent_id'])) $postType = 'quote';

    $stmt = $pdo->prepare('INSERT INTO community_posts (user_id, author_name, post_title, post_body, category, subject, tags, post_type, media, poll_data, quote_parent_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([
        $currentUserId, $currentUserName, $title ?: '', $body, $category,
        mb_substr($subject ?: 'General', 0, 120), $tags, $postType,
        $media, !empty($input['poll_data']) ? json_encode($input['poll_data']) : null,
        !empty($input['quote_parent_id']) ? (int)$input['quote_parent_id'] : null
    ]);
    $postId = (int)$pdo->lastInsertId();

    // Update post count
    $pdo->prepare('UPDATE community_profiles SET post_count = post_count + 1 WHERE user_id = ?')->execute([$currentUserId]);
    if (!$pdo->prepare('SELECT 1 FROM community_profiles WHERE user_id = ?')->execute([$currentUserId]) || !$pdo->prepare('SELECT 1 FROM community_profiles WHERE user_id = ?')->fetchColumn()) {
        $pdo->prepare('INSERT IGNORE INTO community_profiles (user_id, display_name, post_count) VALUES (?, ?, 1)')->execute([$currentUserId, $currentUserName]);
    }

    // Sync hashtags
    if ($tags) syncHashtags($pdo, $tags, $postId);

    // Mention notifications
    if (preg_match_all('/@(\w+)/', $body, $mentions)) {
        foreach (array_unique($mentions[1]) as $mentionedName) {
            $mstmt = $pdo->prepare('SELECT id FROM usuarios WHERE usuario_nombre = ?');
            $mstmt->execute([$mentionedName]);
            $mentionedId = (int)$mstmt->fetchColumn();
            if ($mentionedId && $mentionedId !== $currentUserId) {
                communityNotify($pdo, $mentionedId, $currentUserId, 'mention', $postId, null, "$currentUserName te mencionó en una publicación");
            }
        }
    }

    communityJson(['ok' => true, 'post_id' => $postId]);
}

/* ── Create Story ─────────────────────────────────────────────── */
if ($action === 'create_story') {
    requireCommunityUser($currentUserId);
    $text = trim((string)($input['story_text'] ?? ''));
    $subject = mb_substr(trim((string)($input['subject'] ?? 'General')) ?: 'General', 0, 120);
    if ($text === '' || mb_strlen($text) > 280) communityJson(['ok' => false, 'error' => 'La historia debe tener entre 1 y 280 caracteres.'], 422);
    $stmt = $pdo->prepare("INSERT INTO community_stories (user_id, author_name, story_text, subject, expires_at) VALUES (?, ?, ?, ?, DATE_ADD(NOW(), INTERVAL 24 HOUR))");
    $stmt->execute([$currentUserId, $currentUserName, $text, $subject]);
    communityJson(['ok' => true, 'story_id' => (int)$pdo->lastInsertId()]);
}

/* ── Create Comment ───────────────────────────────────────────── */
if ($action === 'create_comment') {
    requireCommunityUser($currentUserId);
    $postId = (int)($input['post_id'] ?? 0);
    $body = trim((string)($input['comment_body'] ?? ''));
    if ($postId <= 0 || $body === '') communityJson(['ok' => false, 'error' => 'Comentario inválido.'], 422);
    $parentId = (int)($input['parent_id'] ?? 0) ?: null;
    $replyToUserId = null;
    $replyToUserName = null;
    if ($parentId) {
        $pstmt = $pdo->prepare('SELECT user_id, author_name FROM community_comments WHERE id = ?');
        $pstmt->execute([$parentId]);
        $parent = $pstmt->fetch(PDO::FETCH_ASSOC);
        if ($parent) {
            $replyToUserId = (int)$parent['user_id'];
            $replyToUserName = $parent['author_name'];
        }
    }
    $stmt = $pdo->prepare('INSERT INTO community_comments (post_id, parent_id, user_id, author_name, comment_body, reply_to_user_id, reply_to_user_name) SELECT ?, ?, ?, ?, ?, ?, ? FROM community_posts WHERE id = ?');
    $stmt->execute([$postId, $parentId, $currentUserId, $currentUserName, $body, $replyToUserId, $replyToUserName, $postId]);

    // Update comment count
    $pdo->prepare('UPDATE community_posts SET comment_count = comment_count + 1 WHERE id = ?')->execute([$postId]);

    // Notify post owner
    $ownerStmt = $pdo->prepare('SELECT user_id FROM community_posts WHERE id = ?');
    $ownerStmt->execute([$postId]);
    communityNotify($pdo, (int)$ownerStmt->fetchColumn(), $currentUserId, $parentId ? 'reply' : 'comment', $postId, (int)$pdo->lastInsertId(), $parentId ? "$currentUserName respondió a tu hilo" : "$currentUserName comentó tu publicación");

    // Notify parent comment author
    if ($parentId && $replyToUserId && $replyToUserId !== $currentUserId) {
        communityNotify($pdo, $replyToUserId, $currentUserId, 'reply', $postId, (int)$pdo->lastInsertId(), "$currentUserName te respondió");
    }

    // Mention notifications in comment
    if (preg_match_all('/@(\w+)/', $body, $mentions)) {
        foreach (array_unique($mentions[1]) as $mentionedName) {
            $mstmt = $pdo->prepare('SELECT id FROM usuarios WHERE usuario_nombre = ?');
            $mstmt->execute([$mentionedName]);
            $mentionedId = (int)$mstmt->fetchColumn();
            if ($mentionedId && $mentionedId !== $currentUserId) {
                communityNotify($pdo, $mentionedId, $currentUserId, 'mention', $postId, null, "$currentUserName te mencionó en un comentario");
            }
        }
    }

    communityJson(['ok' => true]);
}

/* ── Toggle Like ──────────────────────────────────────────────── */
if ($action === 'toggle_like') {
    requireCommunityUser($currentUserId);
    $postId = (int)($input['post_id'] ?? 0);
    if ($postId <= 0) communityJson(['ok' => false, 'error' => 'Publicación inválida.'], 422);
    $stmt = $pdo->prepare('SELECT 1 FROM community_likes WHERE user_id = ? AND target_type = ? AND target_id = ?');
    $stmt->execute([$currentUserId, 'post', $postId]);
    if ($stmt->fetchColumn()) {
        $pdo->prepare('DELETE FROM community_likes WHERE user_id = ? AND target_type = ? AND target_id = ?')->execute([$currentUserId, 'post', $postId]);
        $pdo->prepare('UPDATE community_posts SET like_count = GREATEST(0, like_count - 1) WHERE id = ?')->execute([$postId]);
        communityJson(['ok' => true, 'active' => false]);
    }
    $pdo->prepare('INSERT INTO community_likes (user_id, target_type, target_id) VALUES (?, ?, ?)')->execute([$currentUserId, 'post', $postId]);
    $pdo->prepare('UPDATE community_posts SET like_count = like_count + 1 WHERE id = ?')->execute([$postId]);
    // Notify
    $ownerStmt = $pdo->prepare('SELECT user_id FROM community_posts WHERE id = ?');
    $ownerStmt->execute([$postId]);
    communityNotify($pdo, (int)$ownerStmt->fetchColumn(), $currentUserId, 'like', $postId, null, "$currentUserName apoyó tu publicación");
    communityJson(['ok' => true, 'active' => true]);
}

/* ── Toggle Save ──────────────────────────────────────────────── */
if ($action === 'toggle_save') {
    requireCommunityUser($currentUserId);
    $postId = (int)($input['post_id'] ?? 0);
    if ($postId <= 0) communityJson(['ok' => false, 'error' => 'Publicación inválida.'], 422);
    $stmt = $pdo->prepare('SELECT 1 FROM community_saves WHERE user_id = ? AND post_id = ?');
    $stmt->execute([$currentUserId, $postId]);
    if ($stmt->fetchColumn()) {
        $pdo->prepare('DELETE FROM community_saves WHERE user_id = ? AND post_id = ?')->execute([$currentUserId, $postId]);
        $pdo->prepare('DELETE FROM community_bookmarks WHERE user_id = ? AND post_id = ?')->execute([$currentUserId, $postId]);
        communityJson(['ok' => true, 'active' => false]);
    }
    $pdo->prepare('INSERT INTO community_saves (user_id, post_id) VALUES (?, ?)')->execute([$currentUserId, $postId]);
    $pdo->prepare('INSERT IGNORE INTO community_bookmarks (user_id, post_id) VALUES (?, ?)')->execute([$currentUserId, $postId]);
    communityJson(['ok' => true, 'active' => true]);
}

/* ── Toggle Follow ────────────────────────────────────────────── */
if ($action === 'toggle_follow') {
    requireCommunityUser($currentUserId);
    $followedId = (int)($input['user_id'] ?? 0);
    if ($followedId <= 0 || $followedId === $currentUserId) communityJson(['ok' => false, 'error' => 'Usuario inválido.'], 422);
    $stmt = $pdo->prepare('SELECT 1 FROM community_follows WHERE follower_id = ? AND followed_id = ?');
    $stmt->execute([$currentUserId, $followedId]);
    if ($stmt->fetchColumn()) {
        $pdo->prepare('DELETE FROM community_follows WHERE follower_id = ? AND followed_id = ?')->execute([$currentUserId, $followedId]);
        $pdo->prepare('UPDATE community_profiles SET following_count = GREATEST(0, following_count - 1) WHERE user_id = ?')->execute([$currentUserId]);
        $pdo->prepare('UPDATE community_profiles SET follower_count = GREATEST(0, follower_count - 1) WHERE user_id = ?')->execute([$followedId]);
        communityJson(['ok' => true, 'active' => false]);
    }
    $pdo->prepare('INSERT INTO community_follows (follower_id, followed_id) VALUES (?, ?)')->execute([$currentUserId, $followedId]);
    // Update counts
    $pdo->prepare('INSERT IGNORE INTO community_profiles (user_id, display_name, following_count) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE following_count = following_count + 1')->execute([$currentUserId, $currentUserName]);
    $pdo->prepare('INSERT IGNORE INTO community_profiles (user_id, follower_count) VALUES (?, 1) ON DUPLICATE KEY UPDATE follower_count = follower_count + 1')->execute([$followedId]);
    communityNotify($pdo, $followedId, $currentUserId, 'follow', null, null, "$currentUserName comenzó a seguirte");
    communityJson(['ok' => true, 'active' => true]);
}

/* ── React ────────────────────────────────────────────────────── */
if ($action === 'react') {
    requireCommunityUser($currentUserId);
    $postId = (int)($input['post_id'] ?? 0);
    $reaction = preg_replace('/[^a-z_]/', '', strtolower((string)($input['reaction'] ?? '')));
    if (!in_array($reaction, ['like', 'love', 'fire', 'mind', 'idea'], true)) communityJson(['ok' => false, 'error' => 'Reacción inválida.'], 422);
    $pdo->prepare('INSERT INTO community_reactions (post_id, user_id, reaction) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE reaction = VALUES(reaction)')->execute([$postId, $currentUserId, $reaction]);
    communityJson(['ok' => true, 'reaction' => $reaction]);
}

/* ── Report ───────────────────────────────────────────────────── */
if ($action === 'report') {
    requireCommunityUser($currentUserId);
    $type = in_array(($input['target_type'] ?? ''), ['post', 'comment', 'user'], true) ? $input['target_type'] : 'post';
    $reason = trim((string)($input['reason'] ?? ''));
    if ($reason === '') communityJson(['ok' => false, 'error' => 'Indica un motivo.'], 422);
    $stmt = $pdo->prepare('INSERT INTO community_reports (reporter_id, target_type, target_id, reason, details) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$currentUserId, $type, (int)($input['target_id'] ?? 0), mb_substr($reason, 0, 64), mb_substr((string)($input['details'] ?? ''), 0, 1000)]);
    communityJson(['ok' => true]);
}

/* ── Mark Notifications Read ──────────────────────────────────── */
if ($action === 'mark_notifications_read') {
    requireCommunityUser($currentUserId);
    $pdo->prepare('UPDATE community_notifications SET is_read = 1 WHERE user_id = ? AND is_read = 0')->execute([$currentUserId]);
    communityJson(['ok' => true]);
}

/* ── Delete Post ──────────────────────────────────────────────── */
if ($action === 'delete_post') {
    requireCommunityUser($currentUserId);
    $postId = (int)($input['post_id'] ?? 0);
    $stmt = $pdo->prepare('UPDATE community_posts SET is_deleted = 1 WHERE id = ? AND user_id = ?');
    $stmt->execute([$postId, $currentUserId]);
    if ($stmt->rowCount()) {
        $pdo->prepare('UPDATE community_posts SET is_deleted = 1 WHERE quote_parent_id = ?')->execute([$postId]);
    }
    communityJson(['ok' => true]);
}

/* ── Delete Comment ───────────────────────────────────────────── */
if ($action === 'delete_comment') {
    requireCommunityUser($currentUserId);
    $commentId = (int)($input['comment_id'] ?? 0);
    $stmt = $pdo->prepare('UPDATE community_comments SET is_deleted = 1 WHERE id = ? AND user_id = ?');
    $stmt->execute([$commentId, $currentUserId]);
    if ($stmt->rowCount()) {
        $comment = $pdo->prepare('SELECT post_id FROM community_comments WHERE id = ?');
        $comment->execute([$commentId]);
        $row = $comment->fetch(PDO::FETCH_ASSOC);
        if ($row) $pdo->prepare('UPDATE community_posts SET comment_count = GREATEST(0, comment_count - 1) WHERE id = ?')->execute([$row['post_id']]);
    }
    communityJson(['ok' => true]);
}

/* ── Update Profile ───────────────────────────────────────────── */
if ($action === 'update_profile') {
    requireCommunityUser($currentUserId);
    $displayName = mb_substr(trim((string)($input['display_name'] ?? '')), 0, 60);
    $bio = mb_substr(trim((string)($input['bio'] ?? '')), 0, 300);
    $website = mb_substr(trim((string)($input['website'] ?? '')), 0, 200);
    $location = mb_substr(trim((string)($input['location'] ?? '')), 0, 100);
    if ($displayName === '') communityJson(['ok' => false, 'error' => 'El nombre no puede estar vacío.'], 422);
    $pdo->prepare('INSERT INTO community_profiles (user_id, display_name, bio, website, location, updated_at) VALUES (?, ?, ?, ?, ?, NOW()) ON DUPLICATE KEY UPDATE display_name = VALUES(display_name), bio = VALUES(bio), website = VALUES(website), location = VALUES(location), updated_at = NOW()')->execute([$currentUserId, $displayName, $bio, $website, $location]);
    communityJson(['ok' => true]);
}

/* ── Vote Poll ────────────────────────────────────────────────── */
if ($action === 'vote_poll') {
    requireCommunityUser($currentUserId);
    $postId = (int)($input['post_id'] ?? 0);
    $optionIndex = (int)($input['option_index'] ?? -1);
    if ($postId <= 0 || $optionIndex < 0) communityJson(['ok' => false, 'error' => 'Voto inválido.'], 422);
    $pstmt = $pdo->prepare('SELECT id, options, total_votes FROM community_polls WHERE post_id = ?');
    $pstmt->execute([$postId]);
    $poll = $pstmt->fetch(PDO::FETCH_ASSOC);
    if (!$poll) communityJson(['ok' => false, 'error' => 'Encuesta no encontrada.'], 404);
    $existing = $pdo->prepare('SELECT option_index FROM community_poll_votes WHERE poll_id = ? AND user_id = ?');
    $existing->execute([$poll['id'], $currentUserId]);
    if ($existing->fetchColumn() !== false) communityJson(['ok' => false, 'error' => 'Ya votaste en esta encuesta.'], 422);
    $pdo->prepare('INSERT INTO community_poll_votes (poll_id, user_id, option_index) VALUES (?, ?, ?)')->execute([$poll['id'], $currentUserId, $optionIndex]);
    $pdo->prepare('UPDATE community_polls SET total_votes = total_votes + 1 WHERE id = ?')->execute([$poll['id']]);
    communityJson(['ok' => true]);
}

/* ── Pin Post (admin only) ────────────────────────────────────── */
if ($action === 'pin_post') {
    requireCommunityUser($currentUserId);
    $postId = (int)($input['post_id'] ?? 0);
    // Check if user is admin or post owner
    $stmt = $pdo->prepare('SELECT user_id FROM community_posts WHERE id = ?');
    $stmt->execute([$postId]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$post) communityJson(['ok' => false, 'error' => 'Publicación no encontrada.'], 404);
    $isAdmin = false;
    if ($currentUserId) {
        $adminCheck = $pdo->prepare('SELECT rol FROM usuarios WHERE id = ?');
        $adminCheck->execute([$currentUserId]);
        $isAdmin = $adminCheck->fetchColumn() === 'admin';
    }
    if (!$isAdmin && $post['user_id'] != $currentUserId) communityJson(['ok' => false, 'error' => 'No autorizado.'], 403);
    $pdo->prepare('UPDATE community_posts SET is_pinned = NOT is_pinned WHERE id = ?')->execute([$postId]);
    communityJson(['ok' => true]);
}

/* ── Bookmark (separate from save for collections) ────────────── */
if ($action === 'toggle_bookmark') {
    requireCommunityUser($currentUserId);
    $postId = (int)($input['post_id'] ?? 0);
    $stmt = $pdo->prepare('SELECT 1 FROM community_bookmarks WHERE user_id = ? AND post_id = ?');
    $stmt->execute([$currentUserId, $postId]);
    if ($stmt->fetchColumn()) {
        $pdo->prepare('DELETE FROM community_bookmarks WHERE user_id = ? AND post_id = ?')->execute([$currentUserId, $postId]);
        communityJson(['ok' => true, 'active' => false]);
    }
    $pdo->prepare('INSERT IGNORE INTO community_bookmarks (user_id, post_id) VALUES (?, ?)')->execute([$currentUserId, $postId]);
    communityJson(['ok' => true, 'active' => true]);
}

communityJson(['ok' => false, 'error' => 'Acción desconocida.'], 400);
