<?php
/**
 * LC-ADVANCE Teacher Panel Helpers
 */

function esProfesor(): bool {
    return !empty($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'teacher';
}

function esAdmin(): bool {
    return !empty($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin';
}

function esAlumno(): bool {
    return !empty($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'student';
}

function requireStudent(): void {
    requireLogin(true);
    if (!esAlumno() && empty($_SESSION['usuario_es_invitado'])) {
        if (esProfesor() || esAdmin()) {
            redirigir('public/panel_docente.php');
        }
        redirigir(getDashboardUrl());
    }
}

function requireProfesor(): void {
    requireLogin(true);
    if (!esProfesor() && !esAdmin()) {
        redirigir('dashboard.php');
    }
}

function obtenerGrupos(int $profesor_id): array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT g.*, (SELECT COUNT(*) FROM grupo_usuarios WHERE grupo_id = g.id) AS total_estudiantes
         FROM grupos g WHERE g.profesor_id = ? ORDER BY g.created_at DESC"
    );
    $stmt->execute([$profesor_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function crearGrupo(int $profesor_id, string $nombre): array {
    global $pdo;
    $codigo = strtoupper(substr(bin2hex(random_bytes(4)), 0, 8));
    $pdo->prepare("INSERT INTO grupos (nombre, profesor_id, codigo_acceso) VALUES (?, ?, ?)")
        ->execute([$nombre, $profesor_id, $codigo]);
    return [
        'id' => (int)$pdo->lastInsertId(),
        'nombre' => $nombre,
        'codigo_acceso' => $codigo,
    ];
}

function eliminarGrupo(int $grupo_id, int $profesor_id): bool {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM grupos WHERE id = ? AND profesor_id = ?");
    $stmt->execute([$grupo_id, $profesor_id]);
    return $stmt->rowCount() > 0;
}

function obtenerEstudiantesGrupo(int $grupo_id, int $profesor_id): array {
    global $pdo;
    // Verify group belongs to teacher
    $stmt = $pdo->prepare("SELECT id FROM grupos WHERE id = ? AND profesor_id = ?");
    $stmt->execute([$grupo_id, $profesor_id]);
    if (!$stmt->fetchColumn()) return [];

    $stmt = $pdo->prepare(
        "SELECT u.id, u.nombre_usuario, u.correo, u.puntos, u.nivel, u.genero, u.creado_en,
                (SELECT COUNT(*) FROM user_progress up WHERE up.user_id = u.id AND up.completed = 1) AS lecciones_completadas
         FROM grupo_usuarios gu
         JOIN usuarios u ON gu.usuario_id = u.id
         WHERE gu.grupo_id = ?
         ORDER BY u.nombre_usuario"
    );
    $stmt->execute([$grupo_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerEstudianteEnGrupo(int $grupo_id, int $estudiante_id, int $profesor_id): array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT g.nombre AS grupo_nombre, u.id, u.nombre_usuario, u.correo, u.genero, u.creado_en, u.ultimo_login, u.puntos, u.nivel
         FROM grupos g
         JOIN grupo_usuarios gu ON gu.grupo_id = g.id
         JOIN usuarios u ON u.id = gu.usuario_id
         WHERE g.id = ? AND g.profesor_id = ? AND u.id = ?"
    );
    $stmt->execute([$grupo_id, $profesor_id, $estudiante_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
}

function agregarEstudianteAGrupo(string $codigo_acceso, int $usuario_id): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, nombre FROM grupos WHERE codigo_acceso = ?");
    $stmt->execute([$codigo_acceso]);
    $grupo = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$grupo) return ['success' => false, 'error' => 'Código inválido'];

    try {
        $pdo->prepare("INSERT INTO grupo_usuarios (grupo_id, usuario_id) VALUES (?, ?)")
            ->execute([$grupo['id'], $usuario_id]);
        return ['success' => true, 'grupo' => $grupo['nombre']];
    } catch (Exception $e) {
        return ['success' => false, 'error' => 'Ya estás en este grupo'];
    }
}

function obtenerLeccionesAsignadasGrupo(int $grupo_id, int $profesor_id): array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT gl.slug FROM group_lecciones gl
         JOIN grupos g ON gl.grupo_id = g.id
         WHERE g.id = ? AND g.profesor_id = ?
         ORDER BY gl.slug"
    );
    $stmt->execute([$grupo_id, $profesor_id]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function obtenerLeccionesAsignadasPorGrupoParaEstudiante(int $usuario_id): array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT gu.grupo_id, gl.slug
         FROM group_lecciones gl
         JOIN grupo_usuarios gu ON gl.grupo_id = gu.grupo_id
         WHERE gu.usuario_id = ?
         ORDER BY gu.grupo_id, gl.slug"
    );
    $stmt->execute([$usuario_id]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result = [];
    foreach ($rows as $row) {
        $result[(int)$row['grupo_id']][] = $row['slug'];
    }
    return $result;
}

function asignarLeccionAGrupo(int $grupo_id, string $slug, int $profesor_id): bool {
    global $pdo;
    $slug = trim($slug);
    if ($slug === '') {
        return false;
    }
    if (!buscarLeccion($slug)) {
        return false;
    }
    $stmt = $pdo->prepare("SELECT id FROM grupos WHERE id = ? AND profesor_id = ?");
    $stmt->execute([$grupo_id, $profesor_id]);
    if (!$stmt->fetchColumn()) {
        return false;
    }
    try {
        $pdo->prepare("INSERT INTO group_lecciones (grupo_id, slug) VALUES (?, ?)")
            ->execute([$grupo_id, $slug]);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function removerLeccionAsignadaGrupo(int $grupo_id, string $slug, int $profesor_id): bool {
    global $pdo;
    $stmt = $pdo->prepare(
        "DELETE gl FROM group_lecciones gl
         JOIN grupos g ON gl.grupo_id = g.id
         WHERE gl.grupo_id = ? AND g.profesor_id = ? AND gl.slug = ?"
    );
    $stmt->execute([$grupo_id, $profesor_id, trim($slug)]);
    return $stmt->rowCount() > 0;
}

function esLeccionAsignadaParaUsuario(int $usuario_id, string $slug): bool {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT 1 FROM group_lecciones gl
         JOIN grupo_usuarios gu ON gl.grupo_id = gu.grupo_id
         WHERE gu.usuario_id = ? AND gl.slug = ? LIMIT 1"
    );
    $stmt->execute([$usuario_id, trim($slug)]);
    return (bool)$stmt->fetchColumn();
}

function obtenerGruposDelEstudiante(int $usuario_id): array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT g.id, g.nombre, g.codigo_acceso,
                u.nombre_usuario AS profesor_nombre
         FROM grupo_usuarios gu
         JOIN grupos g ON gu.grupo_id = g.id
         JOIN usuarios u ON g.profesor_id = u.id
         WHERE gu.usuario_id = ?
         ORDER BY g.nombre"
    );
    $stmt->execute([$usuario_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get stats of a student within a group (rank, lessons, XP)
 */
function obtenerEstadisticasEstudianteEnGrupo(int $grupo_id, int $usuario_id): array {
    global $pdo;
    // Get all members ranked by points
    $stmt = $pdo->prepare(
        "SELECT u.id, u.puntos,
                (SELECT COUNT(*) FROM user_progress up WHERE up.user_id = u.id AND up.completed = 1) AS lecciones_completadas
         FROM grupo_usuarios gu
         JOIN usuarios u ON gu.usuario_id = u.id
         WHERE gu.grupo_id = ?
         ORDER BY u.puntos DESC"
    );
    $stmt->execute([$grupo_id]);
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total = count($members);
    $rank = 1;
    $my_lecciones = 0;
    foreach ($members as $i => $m) {
        if ((int)$m['id'] === $usuario_id) {
            $rank = $i + 1;
            $my_lecciones = (int)$m['lecciones_completadas'];
            break;
        }
    }

    // Total lessons in system
    $total_lecciones = (int)$pdo->query("SELECT COUNT(DISTINCT leccion_slug) FROM user_progress")->fetchColumn();

    return [
        'rank'        => $rank,
        'total'       => $total,
        'lecciones'   => $my_lecciones,
        'total_lec'   => $total_lecciones,
        'pct'         => $total_lecciones > 0 ? round(100 * $my_lecciones / $total_lecciones) : 0,
    ];
}

/**
 * Rename a group
 */
function renombrarGrupo(int $grupo_id, int $profesor_id, string $nuevo_nombre): bool {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE grupos SET nombre = ? WHERE id = ? AND profesor_id = ?");
    $stmt->execute([trim($nuevo_nombre), $grupo_id, $profesor_id]);
    return $stmt->rowCount() > 0;
}

/**
 * Send notification to all students in a group
 */
function enviarNotificacionGrupo(int $grupo_id, int $profesor_id, string $titulo, string $mensaje): int {
    global $pdo;
    // Verify group belongs to teacher
    $stmt = $pdo->prepare("SELECT id FROM grupos WHERE id = ? AND profesor_id = ?");
    $stmt->execute([$grupo_id, $profesor_id]);
    if (!$stmt->fetchColumn()) return 0;

    // Get all students
    $stmt = $pdo->prepare("SELECT usuario_id FROM grupo_usuarios WHERE grupo_id = ?");
    $stmt->execute([$grupo_id]);
    $students = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $count = 0;
    $ins = $pdo->prepare("INSERT INTO notificaciones (usuario_id, tipo, titulo, mensaje, leida, created_at) VALUES (?, 'teacher_msg', ?, ?, 0, NOW())");
    foreach ($students as $uid) {
        $ins->execute([$uid, $titulo, $mensaje]);
        $count++;
    }
    return $count;
}

/**
 * Get detailed lesson progress for a student
 */
function obtenerProgresoDetalleEstudiante(int $estudiante_id, int $grupo_id, int $profesor_id): array {
    global $pdo;
    // Verify group belongs to teacher
    $stmt = $pdo->prepare("SELECT id FROM grupos WHERE id = ? AND profesor_id = ?");
    $stmt->execute([$grupo_id, $profesor_id]);
    if (!$stmt->fetchColumn()) return [];

    $stmt = $pdo->prepare(
        "SELECT leccion_slug, completed, score, lesson_xp, updated_at
         FROM user_progress
         WHERE user_id = ? AND completed = 1
         ORDER BY updated_at DESC"
    );
    $stmt->execute([$estudiante_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get aggregated group statistics for teacher panel
 */
function obtenerEstadisticasGrupo(int $grupo_id, int $profesor_id): array {
    global $pdo;
    // Verify group belongs to teacher
    $stmt = $pdo->prepare("SELECT id FROM grupos WHERE id = ? AND profesor_id = ?");
    $stmt->execute([$grupo_id, $profesor_id]);
    if (!$stmt->fetchColumn()) return [];

    $stmt = $pdo->prepare(
        "SELECT
            COUNT(DISTINCT gu.usuario_id) AS total_estudiantes,
            ROUND(AVG(u.nivel), 1) AS nivel_promedio,
            ROUND(AVG(u.puntos), 0) AS xp_promedio,
            ROUND(AVG(
                (SELECT COUNT(*) FROM user_progress up WHERE up.user_id = u.id AND up.completed = 1)
            ), 1) AS lecciones_promedio
         FROM grupo_usuarios gu
         JOIN usuarios u ON gu.usuario_id = u.id
         WHERE gu.grupo_id = ?"
    );
    $stmt->execute([$grupo_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
}

/**
 * Get historical aggregated completions for a group (timeseries)
 * Returns array of ['date' => 'YYYY-MM-DD', 'completed' => int]
 */
function obtenerProgresoHistoricoGrupo(int $grupo_id, int $profesor_id, int $days = 30): array {
    global $pdo;
    // Verify ownership
    $stmt = $pdo->prepare("SELECT id FROM grupos WHERE id = ? AND profesor_id = ?");
    $stmt->execute([$grupo_id, $profesor_id]);
    if (!$stmt->fetchColumn()) return [];

    // Get list of user ids in group
    $stmt = $pdo->prepare("SELECT usuario_id FROM grupo_usuarios WHERE grupo_id = ?");
    $stmt->execute([$grupo_id]);
    $users = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (empty($users)) return [];

    // Prepare date buckets
    $days = max(1, min(180, $days));
    $labels = [];
    $now = new DateTimeImmutable('now');
    for ($i = $days - 1; $i >= 0; $i--) {
        $d = $now->sub(new DateInterval('P' . $i . 'D'));
        $labels[$d->format('Y-m-d')] = 0;
    }

    // Query completions grouped by date
    $in = implode(',', array_fill(0, count($users), '?'));
    $sql = "SELECT DATE(updated_at) AS d, COUNT(*) AS cnt
            FROM user_progress
            WHERE user_id IN ($in) AND completed = 1 AND updated_at >= DATE_SUB(NOW(), INTERVAL ? DAY)
            GROUP BY DATE(updated_at)
            ORDER BY DATE(updated_at)";
    $params = $users;
    $params[] = $days;
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $r) {
        $date = $r['d'];
        if (isset($labels[$date])) $labels[$date] = (int)$r['cnt'];
    }

    $result = [];
    foreach ($labels as $date => $cnt) {
        $result[] = ['date' => $date, 'completed' => $cnt];
    }
    return $result;
}

function obtenerLeccionesRecientesGrupo(int $grupo_id, int $profesor_id, int $limit = 5): array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT up.slug, MAX(up.updated_at) AS ultima_fecha
         FROM user_progress up
         JOIN grupo_usuarios gu ON up.user_id = gu.usuario_id
         JOIN grupos g ON gu.grupo_id = g.id
         WHERE g.id = ? AND g.profesor_id = ? AND up.completed = 1
         GROUP BY up.slug
         ORDER BY ultima_fecha DESC
         LIMIT ?"
    );
    $stmt->execute([$grupo_id, $profesor_id, $limit]);
    return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'slug');
}

/**
 * Get last grade change per user in a group.
 * Returns map user_id => ['changed_at'=>..., 'changed_by_name'=>...]
 */
function obtenerUltimoCambioPorUsuarios(int $grupo_id, array $userIds): array {
    global $pdo;
    if (empty($userIds)) return [];
    $placeholders = implode(',', array_fill(0, count($userIds), '?'));
        $sql = "SELECT gc.id, gc.user_id, gc.slug, gc.old_score, gc.new_score, gc.changed_at, u.nombre_usuario AS changed_by_name
            FROM grade_changes gc
            JOIN usuarios u ON u.id = gc.changed_by
            WHERE gc.grupo_id = ? AND gc.user_id IN ($placeholders)
            ORDER BY gc.changed_at DESC";
    $params = array_merge([$grupo_id], $userIds);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result = [];
    foreach ($rows as $r) {
        $uid = (int)$r['user_id'];
        if (!isset($result[$uid])) {
            $result[$uid] = [
                'change_id' => (int)$r['id'],
                'slug' => $r['slug'],
                'old_score' => $r['old_score'] === null ? null : (int)$r['old_score'],
                'new_score' => $r['new_score'] === null ? null : (int)$r['new_score'],
                'changed_at' => $r['changed_at'],
                'changed_by_name' => $r['changed_by_name']
            ];
        }
    }
    return $result;
}

function obtenerEstudiantesGrupoConResumen(int $grupo_id, int $profesor_id, array $recent_slugs = []): array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT u.id, u.nombre_usuario, u.correo, u.nivel, u.puntos, u.ultimo_login,
                COALESCE(ROUND(AVG(up.score), 1), 0) AS promedio_score,
                SUM(CASE WHEN up.completed = 1 THEN 1 ELSE 0 END) AS lecciones_completadas
         FROM grupo_usuarios gu
         JOIN usuarios u ON gu.usuario_id = u.id
         LEFT JOIN user_progress up ON up.user_id = u.id
         WHERE gu.grupo_id = ?
         GROUP BY u.id
         ORDER BY u.nombre_usuario"
    );
    $stmt->execute([$grupo_id]);
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result = [];
    foreach ($students as $student) {
        $result[(int)$student['id']] = $student + ['progress' => []];
    }
    if (!empty($recent_slugs) && !empty($result)) {
        $userIds = array_keys($result);
        $slugPlaceholders = implode(',', array_fill(0, count($recent_slugs), '?'));
        $userPlaceholders = implode(',', array_fill(0, count($userIds), '?'));
        $params = array_merge($userIds, $recent_slugs);
        $sql = "SELECT user_id, slug, score FROM user_progress WHERE user_id IN ($userPlaceholders) AND slug IN ($slugPlaceholders) AND completed = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[(int)$row['user_id']]['progress'][$row['slug']] = (int)$row['score'];
        }
    }
    return array_values($result);
}

function obtenerRiesgoGrupo(int $grupo_id, int $profesor_id): array {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT
            SUM(IF(u.ultimo_login IS NULL OR u.ultimo_login < DATE_SUB(CURDATE(), INTERVAL 7 DAY), 1, 0)) AS inactivos_7d,
            SUM(IF(up_count.lecciones_completadas > 0 AND up_avg.promedio_score < 60, 1, 0)) AS promedio_bajo,
            SUM(IF(IFNULL(up_count.lecciones_completadas, 0) = 0, 1, 0)) AS sin_lecciones
         FROM grupo_usuarios gu
         JOIN usuarios u ON gu.usuario_id = u.id
         LEFT JOIN (
             SELECT user_id, ROUND(AVG(score), 1) AS promedio_score
             FROM user_progress WHERE completed = 1 GROUP BY user_id
         ) up_avg ON up_avg.user_id = u.id
         LEFT JOIN (
             SELECT user_id, COUNT(*) AS lecciones_completadas
             FROM user_progress WHERE completed = 1 GROUP BY user_id
         ) up_count ON up_count.user_id = u.id
         WHERE gu.grupo_id = ?"
    );
    $stmt->execute([$grupo_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: ['inactivos_7d' => 0, 'promedio_bajo' => 0, 'sin_lecciones' => 0];
}
