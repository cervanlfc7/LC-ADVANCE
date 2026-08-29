<?php
// ================================================
// LC-ADVANCE — Logros (Achievements/Badges)
// Verifica y otorga automáticamente insignias
// ================================================

/**
 * Verificar y otorgar badges automáticamente según el progreso del usuario.
 * Llamar después de completar lección, quiz, login, etc.
 */
function verificarLogros($usuario_id, $pdo) {
    $otorgados = [];

    // Obtener datos del usuario
    $stmt = $pdo->prepare("SELECT puntos, nivel FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $user = $stmt->fetch();
    if (!$user) return $otorgados;

    $puntos = (int)$user['puntos'];
    $nivel = (int)$user['nivel'];

    // Contar lecciones completadas
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_progress WHERE user_id = ? AND completed = 1");
    $stmt->execute([$usuario_id]);
    $lecciones = (int)$stmt->fetchColumn();

    // Contar quizzes completados (lecciones que tienen un quiz con preguntas)
    $stmt = $pdo->prepare("SELECT slug, score FROM user_progress WHERE user_id = ? AND completed = 1");
    $stmt->execute([$usuario_id]);
    $user_progress_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $quizzes = 0;
    $perfect_score_exists = false;
    foreach ($user_progress_data as $upd) {
        $lec = buscarLeccion($upd['slug']);
        if ($lec && isset($lec['quiz']) && count($lec['quiz']) > 0) {
            $quizzes++;
            // Comprobación para Badge 2 (perfect score)
            $num_preguntas = count($lec['quiz']);
            if ((int)$upd['score'] === $num_preguntas) {
                $perfect_score_exists = true;
            }
        }
    }

    // Obtener racha actual
    $stmt = $pdo->prepare("SELECT racha_actual FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $racha = (int)$stmt->fetchColumn();

    // Mapeo de condiciones a badge_id
    $checks = [
        // Estrella del Código (badge 2)
        2  => $perfect_score_exists,
        // XP milestones (badge 6-10)
        6  => $puntos >= 500,
        7  => $puntos >= 1000,
        8  => $puntos >= 2000,
        9  => $puntos >= 5000,
        10 => $puntos >= 10000,
        // Lesson milestones (badge 1, 11-14)
        1  => $lecciones >= 1,
        11 => $lecciones >= 10,
        12 => $lecciones >= 25,
        13 => $lecciones >= 50,
        14 => $lecciones >= 100,
        // Quiz milestones (badge 15-16)
        15 => $quizzes >= 10,
        16 => $quizzes >= 50,
        // Level milestone (badge 3)
        3  => $nivel >= 5,
        // Streak milestones (badge 5, 17-18)
        5  => $racha >= 7,
        17 => $racha >= 14,
        18 => $racha >= 30,
    ];

    // Materia completada (badge 19-22)
    // Verificar progreso por materia usando slugs desde content.php
    $materias_map = [
        19 => 'Pensamiento Matemático III',
        21 => 'Humanidades I',
        22 => 'Inglés',
    ];
    $todas_materias = obtenerLeccionesPorMateria();
    foreach ($materias_map as $bid => $materia) {
        $slugs = [];
        $lecciones_materia = $todas_materias[$materia] ?? [];
        foreach ($lecciones_materia as $l) $slugs[] = $l['slug'];
        if (empty($slugs)) continue;
        $placeholders = implode(',', array_fill(0, count($slugs), '?'));
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_progress WHERE user_id = ? AND completed = 1 AND slug IN ($placeholders)");
        $stmt->execute(array_merge([$usuario_id], $slugs));
        if ($stmt->fetchColumn() == count($slugs)) {
            $checks[$bid] = true;
        }
    }

    // Ciencia (Química I + Física I) — badge 20
    $ciencias = ['Química I', 'Física I'];
    $todas_ciencias = true;
    foreach ($ciencias as $mat) {
        $slugs = [];
        $lecciones_materia = $todas_materias[$mat] ?? [];
        foreach ($lecciones_materia as $l) $slugs[] = $l['slug'];
        if (empty($slugs)) { $todas_ciencias = false; continue; }
        $placeholders = implode(',', array_fill(0, count($slugs), '?'));
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_progress WHERE user_id = ? AND completed = 1 AND slug IN ($placeholders)");
        $stmt->execute(array_merge([$usuario_id], $slugs));
        if ($stmt->fetchColumn() < count($slugs)) $todas_ciencias = false;
    }
    $checks[20] = $todas_ciencias;

    // Coleccionista: tener 5 badges (badge 4)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios_badges WHERE usuario_id = ?");
    $stmt->execute([$usuario_id]);
    $total_badges = (int)$stmt->fetchColumn();

    // Otorgar badges
    foreach ($checks as $badge_id => $condicion) {
        if ($condicion) {
            $ya_otorgado = false;
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios_badges WHERE usuario_id = ? AND badge_id = ?");
            $stmt->execute([$usuario_id, $badge_id]);
            if ($stmt->fetchColumn() > 0) $ya_otorgado = true;

            if (!$ya_otorgado) {
                otorgarBadge($usuario_id, $badge_id, $pdo);
                $otorgados[] = $badge_id;

                // Notificación del badge
                $stmt = $pdo->prepare("SELECT nombre_badge FROM badges WHERE id = ?");
                $stmt->execute([$badge_id]);
                $nombre = $stmt->fetchColumn();

                if (function_exists('crearNotificacion')) {
                    crearNotificacion($usuario_id, "🏆 Logro desbloqueado: $nombre", "¡Has obtenido la insignia '$nombre'!", $pdo);
                }
            }
        }
    }

    // Badge de coleccionista (lo chequeamos después de otorgar los demás)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios_badges WHERE usuario_id = ?");
    $stmt->execute([$usuario_id]);
    $total = (int)$stmt->fetchColumn();

    if ($total >= 5) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios_badges WHERE usuario_id = ? AND badge_id = 4");
        $stmt->execute([$usuario_id]);
        if ($stmt->fetchColumn() == 0) {
            otorgarBadge($usuario_id, 4, $pdo);
            $otorgados[] = 4;
            if (function_exists('crearNotificacion')) {
                crearNotificacion($usuario_id, '🏆 Logro desbloqueado: Coleccionista', '¡Has obtenido 5 insignias!', $pdo);
            }
        }
    }

    return $otorgados;
}

/**
 * Obtener los badges del usuario con su estado.
 */
function obtenerLogrosUsuario($usuario_id, $pdo) {
    $stmt = $pdo->query("SELECT id, nombre_badge, descripcion, icono FROM badges ORDER BY orden ASC, id ASC");
    $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT badge_id FROM usuarios_badges WHERE usuario_id = ?");
    $stmt->execute([$usuario_id]);
    $obtenidos = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $resultados = [];
    foreach ($todos as $b) {
        $resultados[] = [
            'id' => (int)$b['id'],
            'nombre' => $b['nombre_badge'],
            'descripcion' => $b['descripcion'],
            'icono' => $b['icono'],
            'obtenido' => in_array((int)$b['id'], $obtenidos),
        ];
    }
    return $resultados;
}
