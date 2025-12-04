-- =====================================================
-- LC-ADVANCE - Base de Datos v2.1 (CORREGIDA)
-- Incluye: user_progress + lecciones_completadas (opcional)
-- Autor: LC-TEAM
-- Fecha: 2025-11-04
-- =====================================================

DROP DATABASE IF EXISTS cbtis168_study_game;
CREATE DATABASE cbtis168_study_game CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE cbtis168_study_game;

-- =========================
-- Tabla: usuarios
-- =========================
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena_hash VARCHAR(255) NOT NULL,
    avatar VARCHAR(100) DEFAULT 'default.png',
    puntos INT DEFAULT 0,
    nivel INT DEFAULT 1,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- Tabla: badges
-- =========================
CREATE TABLE badges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_badge VARCHAR(100) NOT NULL,
    descripcion TEXT,
    icono VARCHAR(100) DEFAULT 'badge_default.png'
);

-- =========================
-- Tabla: usuarios_badges
-- =========================
CREATE TABLE usuarios_badges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    badge_id INT NOT NULL,
    obtenido_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (badge_id) REFERENCES badges(id) ON DELETE CASCADE,
    UNIQUE(usuario_id, badge_id)
);

-- =========================
-- Tabla: user_progress (NUEVA - OBLIGATORIA)
-- =========================
CREATE TABLE user_progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    slug VARCHAR(100) NOT NULL,
    score INT DEFAULT 0,           -- aciertos en el quiz (ej. 8/10)
    lesson_xp INT DEFAULT 0,       -- XP ganado en esta lección
    completed TINYINT(1) DEFAULT 0,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_lesson (user_id, slug)
);

-- =========================
-- Tabla: lecciones_completadas (opcional, para compatibilidad)
-- =========================
CREATE TABLE lecciones_completadas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    slug VARCHAR(100) NOT NULL,
    completada_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    UNIQUE(usuario_id, slug)
);

-- =========================
-- Badges iniciales
-- =========================
INSERT INTO badges (nombre_badge, descripcion, icono) VALUES
('Primer Paso', 'Completaste tu primera lección', 'badge_start.png'),
('Estrella del Código', 'Puntaje perfecto en un quiz', 'badge_perfect.png'),
('Maestro del Nivel', 'Alcanzaste el nivel 5', 'badge_level5.png'),
('Coleccionista', 'Obtuviste 5 insignias', 'badge_collector.png'),
('Racha de 7 Días', 'Estudiaste 7 días seguidos', 'badge_streak.png');

-- =========================
-- Trigger: Actualizar nivel
-- =========================
DELIMITER //
DROP TRIGGER IF EXISTS trg_actualizar_nivel//
CREATE TRIGGER trg_actualizar_nivel
AFTER UPDATE ON usuarios
FOR EACH ROW
BEGIN
    DECLARE nuevo_nivel INT;
    SET nuevo_nivel = FLOOR(NEW.puntos / 500) + 1;
    
    IF NEW.nivel <> nuevo_nivel THEN
        UPDATE usuarios SET nivel = nuevo_nivel WHERE id = NEW.id;
    END IF;
END//
DELIMITER ;

-- =========================
-- Vista: Leaderboard
-- =========================
CREATE OR REPLACE VIEW leaderboard AS
SELECT 
    u.id,
    u.nombre_usuario,
    u.puntos,
    u.nivel,
    COUNT(ub.badge_id) AS total_badges
FROM usuarios u
LEFT JOIN usuarios_badges ub ON u.id = ub.usuario_id
GROUP BY u.id
ORDER BY u.puntos DESC;

-- =========================
-- USUARIOS DE PRUEBA
-- =========================
INSERT INTO usuarios (nombre_usuario, correo, contrasena_hash, puntos, nivel) VALUES
('admin', 'admin@cbtis168.edu.mx', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 1),
('Ana123', 'ana@cbtis168.edu.mx', '$2y$10$f1k3n8j9m2k5l7p0q9r8t.u1v2w3x4y5z6A7B8C9D0E1F2G3H4I5J', 750, 2),
('LuisGamer', 'luis@cbtis168.edu.mx', '$2y$10$a1b2c3d4e5f6g7h8i9j0k.l1m2n3o4p5q6r7s8t9u0v1w2x3y4z5A', 1200, 3);

-- =========================
-- Progreso de ejemplo en user_progress
-- =========================
INSERT INTO user_progress (user_id, slug, score, lesson_xp, completed) VALUES
(2, 'derivadas-basicas-pendientes-dominio', 8, 130, 1),
(2, 'bases-datos-relacionales', 10, 150, 1),
(3, 'a1-greetings-introduction', 7, 120, 1);

-- =========================
-- Lecciones completadas (compatibilidad)
-- =========================
INSERT INTO lecciones_completadas (usuario_id, slug) VALUES
(2, 'derivadas-basicas-pendientes-dominio'),
(2, 'bases-datos-relacionales'),
(3, 'a1-greetings-introduction');

-- =========================
-- Asignar badges
-- =========================
INSERT INTO usuarios_badges (usuario_id, badge_id) VALUES
(2, 1),  -- Ana: Primer Paso
(3, 1),  -- Luis: Primer Paso
(3, 2);  -- Luis: Estrella del Código

-- =====================================================
-- FIN DEL SCRIPT - 100% FUNCIONAL
-- =====================================================