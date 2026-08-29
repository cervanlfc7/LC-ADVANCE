<?php
/**
 * LC-ADVANCE Daily Quests System
 * Generates, tracks, and completes daily missions for gamification.
 */

// ─── TIPOS DE MISIONES DISPONIBLES ───────────────────────────────────────────
function obtenerTiposMision(): array {
    return [
        'completar_lecciones' => [
            'label_es' => 'Completar lecciones',
            'label_en' => 'Complete lessons',
            'objetivo_base' => 1,
            'objetivo_por_nivel' => 1,
            'recompensa_base' => 30,
            'max_objetivo' => 5,
        ],
        'ganar_xp' => [
            'label_es' => 'Ganar XP',
            'label_en' => 'Earn XP',
            'objetivo_base' => 100,
            'objetivo_por_nivel' => 50,
            'recompensa_base' => 20,
            'max_objetivo' => 1000,
        ],
        'quiz_perfecto' => [
            'label_es' => 'Obtener 10/10 en un quiz',
            'label_en' => 'Get a perfect quiz score',
            'objetivo_base' => 1,
            'objetivo_por_nivel' => 0,
            'recompensa_base' => 50,
            'max_objetivo' => 3,
        ],
        'racha_inicio' => [
            'label_es' => 'Días consecutivos iniciando sesión',
            'label_en' => 'Consecutive login days',
            'objetivo_base' => 3,
            'objetivo_por_nivel' => 1,
            'recompensa_base' => 40,
            'max_objetivo' => 14,
        ],
        'desafio_lab' => [
            'label_es' => 'Resolver desafíos del laboratorio',
            'label_en' => 'Complete lab challenges',
            'objetivo_base' => 1,
            'objetivo_por_nivel' => 1,
            'recompensa_base' => 35,
            'max_objetivo' => 5,
        ],
        'examen_aprobado' => [
            'label_es' => 'Aprobar exámenes (80%+)',
            'label_en' => 'Pass exams (80%+)',
            'objetivo_base' => 1,
            'objetivo_por_nivel' => 0,
            'recompensa_base' => 45,
            'max_objetivo' => 3,
        ],
    ];
}

// ─── GENERAR MISIONES DIARIAS ────────────────────────────────────────────────
function generarMisionesDiarias(int $usuario_id): array {
    global $pdo;
    $hoy = date('Y-m-d');

    // No regenerar si ya tiene misiones hoy
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM daily_quests WHERE usuario_id = ? AND fecha = ?");
    $stmt->execute([$usuario_id, $hoy]);
    if ($stmt->fetchColumn() > 0) {
        return obtenerMisiones($usuario_id);
    }

    // Obtener nivel del usuario
    $stmt = $pdo->prepare("SELECT nivel FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $nivel = (int)$stmt->fetchColumn();

    $tipos = obtenerTiposMision();
    $keys = array_keys($tipos);
    shuffle($keys);
    $seleccionados = array_slice($keys, 0, 3);

    $insert = $pdo->prepare(
        "INSERT INTO daily_quests (usuario_id, fecha, quest_type, titulo, descripcion, objetivo, recompensa_xp)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    $lang = $_SESSION['lang'] ?? 'es';
    $misiones = [];

    foreach ($seleccionados as $tipo) {
        $cfg = $tipos[$tipo];
        $objetivo = min(
            $cfg['objetivo_base'] + $cfg['objetivo_por_nivel'] * $nivel,
            $cfg['max_objetivo']
        );
        $recompensa = $cfg['recompensa_base'] + $nivel * 5;

        $titulo = $lang === 'en' ? $cfg['label_en'] : $cfg['label_es'];
        $descripcion = ($lang === 'en' ? "Progress: 0/{$objetivo}" : "Progreso: 0/{$objetivo}");

        $insert->execute([$usuario_id, $hoy, $tipo, $titulo, $descripcion, $objetivo, $recompensa]);
        $misiones[] = [
            'id' => $pdo->lastInsertId(),
            'tipo' => $tipo,
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'objetivo' => $objetivo,
            'progreso' => 0,
            'recompensa_xp' => $recompensa,
            'completada' => false,
            'reclamada' => false,
        ];
    }

    return $misiones;
}

// ─── OBTENER MISIONES ACTIVAS ────────────────────────────────────────────────
function obtenerMisiones(int $usuario_id): array {
    global $pdo;
    $hoy = date('Y-m-d');
    $stmt = $pdo->prepare(
        "SELECT id, quest_type, titulo, descripcion, objetivo, progreso, recompensa_xp, completada, reclamada
         FROM daily_quests WHERE usuario_id = ? AND fecha = ?
         ORDER BY id"
    );
    $stmt->execute([$usuario_id, $hoy]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ─── ACTUALIZAR PROGRESO ────────────────────────────────────────────────────
function actualizarProgresoMision(int $usuario_id, string $tipo, int $incremento = 1): void {
    global $pdo;
    $hoy = date('Y-m-d');

    // Actualizar progreso y marcar completada en una sola sentencia
    $pdo->prepare(
        "UPDATE daily_quests
         SET progreso = LEAST(progreso + ?, objetivo),
             completada = IF(progreso + ? >= objetivo, 1, completada)
         WHERE usuario_id = ? AND fecha = ? AND quest_type = ? AND reclamada = 0"
    )->execute([$incremento, $incremento, $usuario_id, $hoy, $tipo]);
}

// ─── RECLAMAR RECOMPENSA ────────────────────────────────────────────────────
function reclamarRecompensaMision(int $quest_id, int $usuario_id): array {
    global $pdo;

    $stmt = $pdo->prepare(
        "SELECT id, quest_type, recompensa_xp, completada, reclamada
         FROM daily_quests WHERE id = ? AND usuario_id = ?"
    );
    $stmt->execute([$quest_id, $usuario_id]);
    $quest = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$quest) return ['success' => false, 'error' => 'Misión no encontrada'];
    if (!$quest['completada']) return ['success' => false, 'error' => 'Misión no completada'];
    if ($quest['reclamada']) return ['success' => false, 'error' => 'Recompensa ya reclamada'];

    $pdo->beginTransaction();
    try {
        $pdo->prepare("UPDATE daily_quests SET reclamada = 1 WHERE id = ?")->execute([$quest_id]);
        $pdo->prepare("UPDATE usuarios SET puntos = puntos + ? WHERE id = ?")->execute([$quest['recompensa_xp'], $usuario_id]);
        $pdo->commit();
        return [
            'success' => true,
            'xp_ganado' => (int)$quest['recompensa_xp'],
        ];
    } catch (Exception $e) {
        $pdo->rollBack();
        return ['success' => false, 'error' => 'Error al reclamar recompensa'];
    }
}

// ─── RECLAMAR TODAS LAS RECOMPENSAS COMPLETADAS ──────────────────────────────
function reclamarTodasMisiones(int $usuario_id): array {
    global $pdo;
    $hoy = date('Y-m-d');
    $total_xp = 0;

    $stmt = $pdo->prepare(
        "SELECT id, recompensa_xp FROM daily_quests
         WHERE usuario_id = ? AND fecha = ? AND completada = 1 AND reclamada = 0"
    );
    $stmt->execute([$usuario_id, $hoy]);

    $pdo->beginTransaction();
    try {
        while ($q = $stmt->fetch()) {
            $pdo->prepare("UPDATE daily_quests SET reclamada = 1 WHERE id = ?")->execute([$q['id']]);
            $total_xp += (int)$q['recompensa_xp'];
        }
        if ($total_xp > 0) {
            $pdo->prepare("UPDATE usuarios SET puntos = puntos + ? WHERE id = ?")->execute([$total_xp, $usuario_id]);
        }
        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        return ['success' => false, 'error' => 'Error al reclamar recompensas'];
    }
    return ['success' => true, 'total_xp' => $total_xp];
}
