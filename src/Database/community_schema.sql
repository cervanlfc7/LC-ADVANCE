-- =============================================================
-- LC-PULSO Community Schema — Instagram/Twitter-level tables
-- =============================================================

-- ──────────────────────────────────────────────────────────────
-- POSTS (enhanced with media, poll, thread support)
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    author_name VARCHAR(100) NOT NULL,
    post_title VARCHAR(180) NOT NULL DEFAULT '',
    post_body TEXT NOT NULL,
    category VARCHAR(30) NOT NULL DEFAULT 'general',
    subject VARCHAR(120) NOT NULL DEFAULT 'General',
    tags VARCHAR(500) NOT NULL DEFAULT '',
    post_type VARCHAR(20) NOT NULL DEFAULT 'text' COMMENT 'text, image, video, poll, thread, quote',
    media JSON NULL COMMENT 'array of media objects [{type,url,alt,width,height}]',
    poll_data JSON NULL COMMENT '{"options":["a","b"],"ends_at":"...","votes":{uid:opt}}',
    quote_parent_id INT NULL COMMENT 'for quote posts, references original post_id',
    thread_parent_id INT NULL COMMENT 'for threaded posts, references first post_id',
    is_pinned TINYINT(1) NOT NULL DEFAULT 0,
    is_featured TINYINT(1) NOT NULL DEFAULT 0,
    is_edited TINYINT(1) NOT NULL DEFAULT 0,
    is_deleted TINYINT(1) NOT NULL DEFAULT 0,
    like_count INT NOT NULL DEFAULT 0,
    comment_count INT NOT NULL DEFAULT 0,
    save_count INT NOT NULL DEFAULT 0,
    share_count INT NOT NULL DEFAULT 0,
    view_count INT NOT NULL DEFAULT 0,
    engagement_score DECIMAL(12,4) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL DEFAULT NULL,
    INDEX idx_cp_created (created_at),
    INDEX idx_cp_category (category),
    INDEX idx_cp_subject (subject),
    INDEX idx_cp_type (post_type),
    INDEX idx_cp_user (user_id),
    INDEX idx_cp_engagement (engagement_score DESC),
    INDEX idx_cp_pinned (is_pinned, created_at DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- COMMENTS (enhanced with nested replies, mentions, media)
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NULL,
    author_name VARCHAR(100) NOT NULL,
    comment_body TEXT NOT NULL,
    parent_id INT NULL COMMENT 'for nested replies',
    reply_to_user_id INT NULL COMMENT 'when replying to a specific user',
    reply_to_user_name VARCHAR(100) NULL,
    media JSON NULL COMMENT 'single image/video attachment',
    like_count INT NOT NULL DEFAULT 0,
    is_edited TINYINT(1) NOT NULL DEFAULT 0,
    is_deleted TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cc_post (post_id),
    INDEX idx_cc_parent (parent_id),
    INDEX idx_cc_user (user_id),
    INDEX idx_cc_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- LIKES (on posts AND comments)
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_likes (
    user_id INT NOT NULL,
    target_type ENUM('post','comment') NOT NULL DEFAULT 'post',
    target_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, target_type, target_id),
    INDEX idx_cl_target (target_type, target_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- SAVES / COLLECTIONS
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_saves (
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    collection_name VARCHAR(60) NOT NULL DEFAULT 'default',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, post_id),
    INDEX idx_cs_user (user_id),
    INDEX idx_cs_collection (user_id, collection_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS community_collections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(60) NOT NULL,
    description VARCHAR(200) NOT NULL DEFAULT '',
    is_public TINYINT(1) NOT NULL DEFAULT 0,
    post_count INT NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_cc_user_name (user_id, name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- FOLLOWS
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_follows (
    follower_id INT NOT NULL,
    followed_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (follower_id, followed_id),
    INDEX idx_cf_followed (followed_id),
    INDEX idx_cf_follower (follower_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- REACTIONS (emoji on posts)
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_reactions (
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    reaction VARCHAR(16) NOT NULL DEFAULT 'like',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (post_id, user_id),
    INDEX idx_cr_post (post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- NOTIFICATIONS
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    actor_id INT NULL,
    actor_name VARCHAR(100) NULL,
    type VARCHAR(32) NOT NULL COMMENT 'comment,reply,like,follow,mention,quote,repost,story_like,milestone',
    post_id INT NULL,
    comment_id INT NULL,
    message VARCHAR(255) NOT NULL,
    url VARCHAR(255) NULL,
    is_read TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cn_user_read (user_id, is_read, id DESC),
    INDEX idx_cn_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- STORIES (24h expiry, with media support)
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_stories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    author_name VARCHAR(100) NOT NULL,
    story_text VARCHAR(280) NOT NULL DEFAULT '',
    media_url VARCHAR(500) NULL,
    media_type VARCHAR(10) NULL COMMENT 'image,video',
    subject VARCHAR(120) NOT NULL DEFAULT 'General',
    bg_color VARCHAR(20) NULL,
    view_count INT NOT NULL DEFAULT 0,
    expires_at DATETIME NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cs_expiry (expires_at, id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS community_story_views (
    story_id INT NOT NULL,
    user_id INT NOT NULL,
    viewed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (story_id, user_id),
    INDEX idx_csv_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- REPORTS / MODERATION
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reporter_id INT NOT NULL,
    target_type VARCHAR(16) NOT NULL COMMENT 'post,comment,user',
    target_id INT NOT NULL,
    reason VARCHAR(64) NOT NULL,
    details TEXT NULL,
    status VARCHAR(16) NOT NULL DEFAULT 'open' COMMENT 'open,reviewing,resolved,dismissed',
    moderator_id INT NULL,
    moderator_note TEXT NULL,
    resolved_at DATETIME NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_crpt_status (status, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- USER PROFILES (community-specific)
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_profiles (
    user_id INT PRIMARY KEY,
    display_name VARCHAR(60) NOT NULL DEFAULT '',
    bio VARCHAR(300) NOT NULL DEFAULT '',
    avatar_url VARCHAR(500) NULL,
    banner_url VARCHAR(500) NULL,
    website VARCHAR(200) NULL,
    location VARCHAR(100) NULL,
    subjects JSON NULL COMMENT '["Programación","Física I"]',
    badges JSON NULL COMMENT '["_Helper","_TopContributor"]',
    post_count INT NOT NULL DEFAULT 0,
    follower_count INT NOT NULL DEFAULT 0,
    following_count INT NOT NULL DEFAULT 0,
    total_likes_received INT NOT NULL DEFAULT 0,
    streak_days INT NOT NULL DEFAULT 0,
    last_active_at DATETIME NULL,
    is_verified TINYINT(1) NOT NULL DEFAULT 0,
    is_private TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL DEFAULT NULL,
    INDEX idx_cp_name (display_name),
    INDEX idx_cp_streak (streak_days DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- MEDIA UPLOADS
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    file_name VARCHAR(200) NOT NULL,
    file_type VARCHAR(20) NOT NULL COMMENT 'image,video,gif',
    file_size INT NOT NULL DEFAULT 0,
    width INT NULL,
    height INT NULL,
    duration_ms INT NULL COMMENT 'for video, length in ms',
    alt_text VARCHAR(200) NULL,
    thumbnail_path VARCHAR(500) NULL,
    is_processed TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cm_user (user_id),
    INDEX idx_cm_type (file_type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- POLLS
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_polls (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    question VARCHAR(300) NOT NULL,
    options JSON NOT NULL COMMENT '["Option A","Option B","Option C"]',
    total_votes INT NOT NULL DEFAULT 0,
    ends_at DATETIME NULL,
    is_anonymous TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cpl_post (post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS community_poll_votes (
    poll_id INT NOT NULL,
    user_id INT NOT NULL,
    option_index TINYINT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (poll_id, user_id),
    INDEX idx_cpv_poll (poll_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- MENTIONS
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_mentions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    source_type VARCHAR(16) NOT NULL COMMENT 'post,comment',
    source_id INT NOT NULL,
    mentioned_user_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cm_user (mentioned_user_id),
    INDEX idx_cm_source (source_type, source_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- HASHTAGS (auto-extracted, with trending counters)
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_hashtags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tag VARCHAR(100) NOT NULL,
    post_count INT NOT NULL DEFAULT 0,
    trend_score DECIMAL(12,4) NOT NULL DEFAULT 0,
    last_used_at DATETIME NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_ch_tag (tag),
    INDEX idx_ch_trend (trend_score DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- BOOKMARKS / SAVED POSTS LIST
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_bookmarks (
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, post_id),
    INDEX idx_cb_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- DRAFTS (auto-saved post drafts)
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_drafts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(180) NOT NULL DEFAULT '',
    body TEXT NOT NULL,
    category VARCHAR(30) NOT NULL DEFAULT 'general',
    subject VARCHAR(120) NOT NULL DEFAULT 'General',
    tags VARCHAR(500) NOT NULL DEFAULT '',
    media JSON NULL,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_cd_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- USER BLOCKS (block/mute other users)
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_blocks (
    blocker_id INT NOT NULL,
    blocked_id INT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (blocker_id, blocked_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- SHADOWBAN / RESTRICTIONS
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_restrictions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type VARCHAR(20) NOT NULL COMMENT 'shadowban,tempban,mute',
    reason VARCHAR(200) NOT NULL,
    expires_at DATETIME NULL,
    created_by INT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cr_user (user_id),
    INDEX idx_cr_expires (expires_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- SEARCH HISTORY
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_search_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    query VARCHAR(200) NOT NULL,
    result_count INT NOT NULL DEFAULT 0,
    searched_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_csh_user (user_id, searched_at DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ──────────────────────────────────────────────────────────────
-- POST VIEWS (analytics)
-- ──────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS community_post_views (
    post_id INT NOT NULL,
    user_id INT NULL,
    session_id VARCHAR(64) NULL,
    viewed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_cpv_post (post_id),
    INDEX idx_cpv_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
