<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Core/panel_docente.php';
require_once __DIR__ . '/../src/Core/notificaciones.php';
requireProfesor();

$usuario_id = (int)$_SESSION['usuario_id'];
$mensaje = '';
$error = '';

$stmt = $pdo->prepare('SELECT nombre_usuario, correo FROM usuarios WHERE id = ?');
$stmt->execute([$usuario_id]);
$profesor_info = $stmt->fetch(PDO::FETCH_ASSOC) ?: ['nombre_usuario' => 'Profesor', 'correo' => ''];

$availableLessons = obtenerLecciones();
$lessonOptionsByMateria = [];
foreach ($availableLessons as $lesson) {
    $materia = $lesson['materia'] ?? 'Sin Materia';
    $lessonOptionsByMateria[$materia][] = $lesson;
}

// ─── ACCIONES ─────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    if (!validarCsrfToken($token)) {
        $error = 'Error de validación.';
    } else {
        $action = $_POST['action'] ?? '';
        if ($action === 'crear_grupo' && !empty($_POST['nombre_grupo'])) {
            $r = crearGrupo($usuario_id, trim($_POST['nombre_grupo']));
            $mensaje = "Grupo '{$r['nombre']}' creado. Código: {$r['codigo_acceso']}";
        } elseif ($action === 'eliminar_grupo' && !empty($_POST['grupo_id'])) {
            if (eliminarGrupo((int)$_POST['grupo_id'], $usuario_id)) {
                $mensaje = 'Grupo eliminado.';
            } else { $error = 'No se pudo eliminar.'; }
        } elseif ($action === 'exportar_csv' && !empty($_POST['grupo_id'])) {
            $estudiantes = obtenerEstudiantesGrupo((int)$_POST['grupo_id'], $usuario_id);
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=grupo_'.(int)$_POST['grupo_id'].'.csv');
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Usuario','Correo','Nivel','XP','Lecciones Completadas','Género','Registrado']);
            foreach ($estudiantes as $e) {
                fputcsv($out, [$e['nombre_usuario'],$e['correo'],$e['nivel'],$e['puntos'],$e['lecciones_completadas'],$e['genero'],$e['creado_en']]);
            }
            fclose($out); exit;
        } elseif ($action === 'rename_group' && !empty($_POST['grupo_id']) && isset($_POST['nuevo_nombre'])) {
            $g = (int)$_POST['grupo_id'];
            $nuevo = trim($_POST['nuevo_nombre']);
            if ($nuevo === '') { $error = 'Nombre vacío.'; }
            else {
                if (renombrarGrupo($g, $usuario_id, $nuevo)) {
                    $mensaje = 'Nombre del grupo actualizado.';
                } else { $error = 'No se pudo renombrar el grupo.'; }
            }
        } elseif ($action === 'send_notification' && !empty($_POST['grupo_id']) && !empty($_POST['titulo']) && !empty($_POST['mensaje'])) {
            $g = (int)$_POST['grupo_id'];
            $titulo = trim($_POST['titulo']);
            $msg = trim($_POST['mensaje']);
            $sent = enviarNotificacionGrupo($g, $usuario_id, $titulo, $msg);
            if ($sent > 0) {
                $mensaje = "Notificación enviada a {$sent} estudiante(s).";
            } else {
                $error = 'No se pudo enviar la notificación (verifica permisos).';
            }
        } elseif ($action === 'assign_lesson' && !empty($_POST['grupo_id']) && !empty($_POST['lesson_slug'])) {
            $g = (int)$_POST['grupo_id'];
            $slug = trim($_POST['lesson_slug']);
            if (asignarLeccionAGrupo($g, $slug, $usuario_id)) {
                $mensaje = "Lección '{$slug}' asignada al grupo.";
            } else {
                $error = 'No se pudo asignar la lección. Revisa el slug o tus permisos.';
            }
        } elseif ($action === 'unassign_lesson' && !empty($_POST['grupo_id']) && !empty($_POST['lesson_slug'])) {
            $g = (int)$_POST['grupo_id'];
            $slug = trim($_POST['lesson_slug']);
            if (removerLeccionAsignadaGrupo($g, $slug, $usuario_id)) {
                $mensaje = "Lección '{$slug}' removida del grupo.";
            } else {
                $error = 'No se pudo remover la lección asignada.';
            }
        }
    }
}

$grupos = obtenerGrupos($usuario_id);
$globalRisk = ['inactivos_7d' => 0, 'promedio_bajo' => 0, 'sin_lecciones' => 0];
$groupOverview = ['count' => count($grupos), 'students' => 0, 'xp_sum' => 0, 'level_sum' => 0, 'stats_count' => 0];
$groupAssignments = [];
$totalAssignedLessons = 0;
$pdf_autoload = __DIR__ . '/../vendor/autoload.php';
$pdfExportAvailable = false;
if (file_exists($pdf_autoload)) {
    require_once $pdf_autoload;
    if (class_exists('\Dompdf\Dompdf')) {
        $pdfExportAvailable = true;
    }
}
foreach ($grupos as $g) {
    $groupOverview['students'] += (int)$g['total_estudiantes'];
    $stats = obtenerEstadisticasGrupo((int)$g['id'], $usuario_id);
    if ($stats) {
        $groupOverview['xp_sum'] += (int)$stats['xp_promedio'];
        $groupOverview['level_sum'] += (float)$stats['nivel_promedio'];
        $groupOverview['stats_count']++;
    }
    $assigned = obtenerLeccionesAsignadasGrupo((int)$g['id'], $usuario_id);
    $groupAssignments[(int)$g['id']] = $assigned;
    $totalAssignedLessons += count($assigned);
    $risk = obtenerRiesgoGrupo((int)$g['id'], $usuario_id);
    foreach (['inactivos_7d','promedio_bajo','sin_lecciones'] as $key) {
        $globalRisk[$key] += (int)($risk[$key] ?? 0);
    }
}
$avgGroupXp = $groupOverview['stats_count'] ? round($groupOverview['xp_sum'] / $groupOverview['stats_count']) : 0;
$avgGroupLevel = $groupOverview['stats_count'] ? round($groupOverview['level_sum'] / $groupOverview['stats_count'], 1) : 0;
$page_css_files = ['assets/css/dashboard.css'];
$page_show_bg_orb = false;

$t = [
    'title' => 'Panel Docente',
    'welcome' => 'Bienvenido, Profesor',
    'my_groups' => 'Mis Grupos',
    'create_group' => 'Crear Grupo',
    'group_name' => 'Nombre del grupo',
    'access_code' => 'Código de acceso',
    'students' => 'Estudiantes',
    'no_groups' => 'Aún no tienes grupos. ¡Crea tu primer grupo!',
    'export_csv' => 'Exportar CSV',
    'delete' => 'Eliminar',
    'back_dashboard' => 'Volver al Dashboard',
    'student_name' => 'Nombre',
    'level' => 'Nivel',
    'xp' => 'XP',
    'completed_lessons' => 'Lecciones',
    'no_students' => 'Sin estudiantes en este grupo',
    'risk_summary' => 'Resumen de riesgo',
    'inactive_last_week' => 'Inactivos 7d',
    'low_score' => 'Promedio <60%',
    'no_lessons' => 'Sin lecciones',
    'gradebook' => 'Cuadro de calificaciones',
    'avg_score' => 'Promedio',
    'last_login' => 'Último login',
    'download_report' => 'Descargar Reporte',
    'recent_lessons' => 'Lecciones recientes',
    'group_overview' => 'Resumen del grupo',
    'risk_alert' => 'Alumnos en riesgo',
];
?>
<?php $page_title = $t['title'] . ' | LC-ADVANCE'; ?>
<?php require __DIR__ . '/../src/Templates/page_start.php'; ?>

<div class="pd-container">
    <header class="pd-header">
        <div>
            <h1><?= htmlspecialchars($t['title']) ?></h1>
            <p class="pd-subtitle">Un espacio exclusivo para docentes con métricas, alumnos y herramientas de clase.</p>
        </div>
        <div class="pd-header-actions">
            <a href="dashboard.php" class="pd-btn pd-btn-secondary"><?= htmlspecialchars($t['back_dashboard']) ?></a>
        </div>
    </header>

    <section class="pd-card pd-teacher-card">
        <div class="pd-teacher-profile">
            <div>
                <h2>Perfil del Profesor</h2>
                <p class="pd-teacher-intro">Administra grupos, asigna lecciones a tus alumnos y revisa su avance en un solo lugar.</p>
            </div>
            <div class="pd-teacher-meta">
                <div><strong><?= htmlspecialchars($profesor_info['nombre_usuario']) ?></strong></div>
                <div><?= htmlspecialchars($profesor_info['correo']) ?></div>
            </div>
        </div>
        <div class="pd-teacher-stats">
            <div class="pd-stat-card"><span>Grupos</span><strong><?= count($grupos) ?></strong></div>
            <div class="pd-stat-card"><span>Estudiantes</span><strong><?= $groupOverview['students'] ?></strong></div>
            <div class="pd-stat-card"><span>Lecciones asignadas</span><strong><?= $totalAssignedLessons ?></strong></div>
        </div>
    </section>

    <?php if ($mensaje): ?><div class="pd-alert pd-success"><?= htmlspecialchars($mensaje) ?></div><?php endif; ?>
    <?php if ($error): ?><div class="pd-alert pd-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if ($globalRisk['inactivos_7d'] || $globalRisk['promedio_bajo'] || $globalRisk['sin_lecciones']): ?>
        <div class="pd-alert pd-warning">
            <strong>Alerta de riesgo:</strong>
            <?= (int)$globalRisk['inactivos_7d'] ?> inactivos 7d, <?= (int)$globalRisk['promedio_bajo'] ?> promedios bajos y <?= (int)$globalRisk['sin_lecciones'] ?> sin lecciones completadas.
        </div>
    <?php endif; ?>

    <div class="pd-grid pd-grid-3">
        <section class="pd-card pd-card-highlight">
            <h2><?= htmlspecialchars($t['create_group']) ?></h2>
            <form method="POST" class="pd-form-inline">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                <input type="hidden" name="action" value="crear_grupo">
                <input type="text" name="nombre_grupo" id="nombre-grupo" class="pd-input" aria-label="<?= htmlspecialchars($t['group_name']) ?>" placeholder="<?= htmlspecialchars($t['group_name']) ?>" required>
                <button type="submit" class="pd-btn pd-btn-primary"><?= htmlspecialchars($t['create_group']) ?></button>
            </form>
        </section>

            <section class="pd-card pd-card-metric">
            <h3><?= htmlspecialchars($t['risk_summary']) ?></h3>
            <div class="pd-metric-row"><span><?= htmlspecialchars($t['inactive_last_week']) ?></span><strong><?= $globalRisk['inactivos_7d'] ?></strong></div>
            <div class="pd-metric-row"><span><?= htmlspecialchars($t['low_score']) ?></span><strong><?= $globalRisk['promedio_bajo'] ?></strong></div>
            <div class="pd-metric-row"><span><?= htmlspecialchars($t['no_lessons']) ?></span><strong><?= $globalRisk['sin_lecciones'] ?></strong></div>
        </section>

            <section class="pd-card pd-card-metric">
            <h3><?= htmlspecialchars($t['group_overview']) ?></h3>
            <div class="pd-metric-row"><span>Grupos creados</span><strong><?= $groupOverview['count'] ?></strong></div>
            <div class="pd-metric-row"><span>Total estudiantes</span><strong><?= $groupOverview['students'] ?></strong></div>
            <div class="pd-metric-row"><span>XP promedio</span><strong><?= $avgGroupXp ?></strong></div>
            <div class="pd-metric-row"><span>Nivel promedio</span><strong><?= $avgGroupLevel ?></strong></div>
        </section>
    </div>

    <section class="pd-card">
        <h2><?= htmlspecialchars($t['my_groups']) ?> (<?= count($grupos) ?>)</h2>
        <?php if (empty($grupos)): ?>
            <p class="pd-empty"><?= htmlspecialchars($t['no_groups']) ?></p>
        <?php else: ?>
            <?php foreach ($grupos as $g): ?>
                <?php $risk = obtenerRiesgoGrupo((int)$g['id'], $usuario_id); ?>
                <?php $assignedLessons = $groupAssignments[(int)$g['id']] ?? []; ?>
                <?php $students = obtenerEstudiantesGrupoConResumen((int)$g['id'], $usuario_id, $assignedLessons); ?>
                <?php $studentIds = array_map(function($s){ return (int)$s['id']; }, $students); ?>
                <?php $lastChanges = obtenerUltimoCambioPorUsuarios((int)$g['id'], $studentIds); ?>
                <?php $recent = obtenerLeccionesRecientesGrupo((int)$g['id'], $usuario_id, 5); ?>
                <div class="pd-grupo">
                    <div class="pd-grupo-header">
                        <div>
                            <h3><?= htmlspecialchars($g['nombre']) ?></h3>
                            <p class="pd-group-meta">Código <?= htmlspecialchars($g['codigo_acceso']) ?> · <?= (int)$g['total_estudiantes'] ?> estudiantes</p>
                        </div>
                        <div class="pd-grupo-badges">
                            <span class="pd-badge pd-badge-alert"><?= htmlspecialchars($t['inactive_last_week']) ?>: <?= (int)$risk['inactivos_7d'] ?></span>
                            <span class="pd-badge pd-badge-warning"><?= htmlspecialchars($t['low_score']) ?>: <?= (int)$risk['promedio_bajo'] ?></span>
                            <span class="pd-badge pd-badge-muted"><?= htmlspecialchars($t['no_lessons']) ?>: <?= (int)$risk['sin_lecciones'] ?></span>
                        </div>
                    </div>

                    <div class="pd-group-chart" role="button" tabindex="0" onclick="openChartModal(<?= (int)$g['id'] ?>)" aria-label="Ver gráfico de progreso completo del grupo">
                        <div class="pd-chart-label">Progreso reciente</div>
                        <div class="pd-chart" style="position:relative;">
                            <canvas id="chart-<?= (int)$g['id'] ?>" width="400" height="96"></canvas>
                            <div id="chart-tip-<?= (int)$g['id'] ?>" class="pd-chart-tip" style="display:none;position:absolute;top:10px;left:10px;pointer-events:none;">&nbsp;</div>
                        </div>
                        <div class="pd-chart-note">Haz clic para ver el gráfico completo</div>
                    </div>

                    <div class="pd-assigned-lessons">
                        <div class="pd-assigned-header">
                            <strong>Lecciones asignadas</strong>
                            <span><?= count($groupAssignments[(int)$g['id']]) ?> asignadas</span>
                        </div>
                        <?php $assignedSlugs = array_flip($groupAssignments[(int)$g['id']]); ?>
                        <?php if (!empty($groupAssignments[(int)$g['id']])): ?>
                            <ul class="pd-assigned-list">
                                <?php foreach ($groupAssignments[(int)$g['id']] as $assigned_slug): 
                                    $lessonInfo = buscarLeccion($assigned_slug);
                                ?>
                                    <li>
                                        <span class="pd-assigned-slug"><?= htmlspecialchars($lessonInfo['titulo'] ?? $assigned_slug) ?> <em>(<?= htmlspecialchars($assigned_slug) ?>)</em></span>
                                        <form method="POST" class="pd-inline-form" style="margin:0;">
                                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                                            <input type="hidden" name="action" value="unassign_lesson">
                                            <input type="hidden" name="grupo_id" value="<?= (int)$g['id'] ?>">
                                            <input type="hidden" name="lesson_slug" value="<?= htmlspecialchars($assigned_slug, ENT_QUOTES) ?>">
                                            <button type="submit" class="pd-btn pd-btn-small pd-btn-danger">Remover</button>
                                        </form>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="pd-muted">No hay lecciones asignadas para este grupo.</p>
                        <?php endif; ?>
                        <form method="POST" class="pd-form-inline pd-assign-form">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                            <input type="hidden" name="action" value="assign_lesson">
                            <input type="hidden" name="grupo_id" value="<?= (int)$g['id'] ?>">
                            <input type="hidden" name="lesson_slug" class="pd-hidden-lesson" value="">
                            <div class="pd-select-group">
                                <button type="button" class="pd-btn pd-open-lesson-modal" data-assigned='<?= htmlspecialchars(json_encode($groupAssignments[(int)$g['id']]), ENT_QUOTES) ?>'>Seleccionar lección…</button>
                                <div class="pd-lesson-preview" aria-live="polite">
                                    <strong class="pd-lesson-title">Selecciona una lección</strong>
                                    <p class="pd-lesson-excerpt pd-muted">Haz clic en el botón para elegir una lección con el selector visual.</p>
                                </div>
                                <button type="submit" class="pd-btn pd-btn-primary pd-assign-submit" disabled>Asignar</button>
                            </div>
                        </form>
                    </div>

                    <div class="pd-group-summary">
                        <div class="pd-summary-card">
                            <strong><?= htmlspecialchars($t['recent_lessons']) ?></strong>
                            <p><?= $recent ? implode(', ', array_map('htmlspecialchars', $recent)) : 'Sin datos recientes' ?></p>
                        </div>
                        <div class="pd-summary-card">
                            <strong><?= htmlspecialchars($t['gradebook']) ?></strong>
                            <p>Promedio de calificación por alumno y lecciones recientes.</p>
                        </div>
                    </div>

                    <div class="pd-tabla-wrapper">
                        <table class="pd-tabla pd-tabla-gradebook">
                            <thead>
                                <tr>
                                    <th><?= htmlspecialchars($t['student_name']) ?></th>
                                    <th><?= htmlspecialchars($t['avg_score']) ?></th>
                                    <th><?= htmlspecialchars($t['last_login']) ?></th>
                                    <th>Últ. mod.</th>
                                    <?php foreach ($assignedLessons as $slug): $lessonInfo = buscarLeccion($slug); ?>
                                        <th title="<?= htmlspecialchars($lessonInfo['titulo'] ?? $slug) ?>"><?= htmlspecialchars($lessonInfo['titulo'] ?? $slug) ?></th>
                                    <?php endforeach; ?>
                                    <th><?= htmlspecialchars($t['download_report']) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $e): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($e['nombre_usuario']) ?></td>
                                        <td><?= htmlspecialchars($e['promedio_score']) ?>%</td>
                                        <td><?= htmlspecialchars($e['ultimo_login'] ?? '—') ?></td>
                                        <?php $lc = $lastChanges[(int)$e['id']] ?? null; ?>
                                        <td class="pd-muted" style="font-size:0.85rem"><?= $lc ? htmlspecialchars($lc['changed_at'].' • '.$lc['changed_by_name']) : '—' ?></td>
                                        <?php foreach ($assignedLessons as $slug): ?>
                                            <?php $score = $e['progress'][$slug] ?? null; $scoreDisplay = $score === null ? '' : (int)$score; ?>
                                            <td class="pd-score-cell <?= $score === null ? 'empty' : ($score < 60 ? 'score-low' : ($score < 80 ? 'score-medium' : 'score-high')) ?>">
                                                <div style="display:flex;gap:6px;align-items:center">
                                                    <input type="number" min="0" max="100" step="1" class="pd-grade-input" data-user="<?= (int)$e['id'] ?>" data-slug="<?= htmlspecialchars($slug, ENT_QUOTES) ?>" data-grupo="<?= (int)$g['id'] ?>" value="<?= $scoreDisplay ?>" style="width:68px;padding:6px;border-radius:6px;border:1px solid var(--border);background:transparent;color:var(--text)" placeholder="-">
                                                    <button type="button" class="pd-btn pd-btn-small pd-save-grade">Guardar</button>
                                                </div>
                                            </td>
                                        <?php endforeach; ?>
                                        <td class="pd-table-actions">
                                            <button type="button" class="pd-btn pd-btn-small" onclick="openStudentProgress(<?= (int)$g['id'] ?>, <?= (int)$e['id'] ?>)">🔎 Ver progreso</button>
                                            <a href="panel_docente_report.php?grupo_id=<?= (int)$g['id'] ?>&student_id=<?= (int)$e['id'] ?>" class="pd-btn pd-btn-small pd-btn-ghost">📄 Descargar CSV</a>
                                            <?php if ($pdfExportAvailable): ?>
                                                <a href="panel_docente_report.php?format=pdf&grupo_id=<?= (int)$g['id'] ?>&student_id=<?= (int)$e['id'] ?>" class="pd-btn pd-btn-small pd-btn-ghost" style="margin-left:6px">📄 Descargar PDF</a>
                                            <?php else: ?>
                                                <button type="button" class="pd-btn pd-btn-small pd-btn-ghost" style="margin-left:6px" disabled title="Dompdf no está instalado. Ejecuta composer install para habilitar PDF">📄 PDF no disponible</button>
                                            <?php endif; ?>
                                            <button type="button" class="pd-btn pd-btn-small" onclick="openGradeHistory(<?= (int)$g['id'] ?>, <?= (int)$e['id'] ?>)">📜 Historial</button>
                                            <?php if ($lc): ?>
                                                <button type="button" class="pd-btn pd-btn-small pd-undo-btn" data-change-id="<?= (int)$lc['change_id'] ?>" data-old-score="<?= $lc['old_score'] === null ? '' : (int)$lc['old_score'] ?>" data-slug="<?= htmlspecialchars($lc['slug'], ENT_QUOTES) ?>" data-user="<?= (int)$e['id'] ?>" data-grupo="<?= (int)$g['id'] ?>">↶ Deshacer</button>
                                            <?php else: ?>
                                                <button type="button" class="pd-btn pd-btn-small pd-undo-btn" disabled title="No hay cambios">↶ Deshacer</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="pd-grupo-actions">
                        <button type="button" class="pd-btn pd-btn-small" onclick="copyGroupCode('<?= htmlspecialchars($g['codigo_acceso'], ENT_QUOTES) ?>', this)">📋 Copiar código</button>
                        <form method="POST" style="display:inline; margin:0;">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                            <input type="hidden" name="action" value="exportar_csv">
                            <input type="hidden" name="grupo_id" value="<?= (int)$g['id'] ?>">
                            <button type="submit" class="pd-btn pd-btn-small">📥 Exportar CSV</button>
                        </form>
                        <a href="panel_docente_api.php?action=export_gradebook_csv&grupo_id=<?= (int)$g['id'] ?>" class="pd-btn pd-btn-small" style="margin-left:6px">📊 Exportar Libreta (CSV)</a>
                        <button type="button" class="pd-btn pd-btn-small" onclick="toggleNotify(<?= (int)$g['id'] ?>)">✉️ Enviar notificación</button>
                        <button type="button" class="pd-btn pd-btn-small" onclick="showRename(<?= (int)$g['id'] ?>)">✏️ Renombrar</button>
                        <form method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar grupo?')">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                            <input type="hidden" name="action" value="eliminar_grupo">
                            <input type="hidden" name="grupo_id" value="<?= (int)$g['id'] ?>">
                            <button type="submit" class="pd-btn pd-btn-small pd-btn-danger">🗑️ Eliminar</button>
                        </form>
                    </div>

                    <div id="rename-<?= (int)$g['id'] ?>" class="pd-hidden-panel" style="display:none;">
                        <form method="POST" class="pd-form-vertical">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                            <input type="hidden" name="action" value="rename_group">
                            <input type="hidden" name="grupo_id" value="<?= (int)$g['id'] ?>">
                            <label>Nuevo nombre</label>
                            <input type="text" name="nuevo_nombre" class="pd-input" placeholder="Nuevo nombre del grupo" required>
                            <div style="display:flex; gap:8px; flex-wrap:wrap; margin-top:8px;">
                                <button type="submit" class="pd-btn pd-btn-small pd-btn-primary">Guardar</button>
                                <button type="button" class="pd-btn pd-btn-small pd-btn-ghost" onclick="hideRename(<?= (int)$g['id'] ?>)">Cancelar</button>
                            </div>
                        </form>
                    </div>

                    <div id="notify-<?= (int)$g['id'] ?>" class="pd-hidden-panel" style="display:none;">
                        <form method="POST" class="pd-form-vertical">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken()) ?>">
                            <input type="hidden" name="action" value="send_notification">
                            <input type="hidden" name="grupo_id" value="<?= (int)$g['id'] ?>">
                            <label>Título</label>
                            <input type="text" name="titulo" class="pd-input" placeholder="Asunto de la notificación" required>
                            <label>Mensaje</label>
                            <textarea name="mensaje" class="pd-input" placeholder="Mensaje para los estudiantes" rows="3" required></textarea>
                            <div style="display:flex; gap:8px; flex-wrap:wrap; margin-top:8px;">
                                <button type="submit" class="pd-btn pd-btn-small pd-btn-primary">Enviar</button>
                                <button type="button" class="pd-btn pd-btn-small pd-btn-ghost" onclick="toggleNotify(<?= (int)$g['id'] ?>)">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</div>

<style>
.pd-container { max-width:1000px; margin:0 auto; padding:24px 16px; }
.pd-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
.pd-header h1 { font-family:'Syne',sans-serif; font-size:1.5rem; color:var(--cyan); margin:0; }
.pd-header-actions { display:flex; gap:8px; }
.pd-alert { padding:12px 16px; border-radius:10px; margin-bottom:16px; font-size:0.85rem; font-weight:500; }
.pd-success { background:rgba(0,255,135,0.1); color:var(--green); border:1px solid rgba(0,255,135,0.2); }
.pd-error { background:rgba(255,60,172,0.1); color:var(--pink); border:1px solid rgba(255,60,172,0.2); }
.pd-card { background:var(--surface); border:1px solid var(--border); border-radius:14px; padding:20px; margin-bottom:20px; }
.pd-card h2 { font-family:'Syne',sans-serif; font-size:1.1rem; color:var(--text); margin:0 0 16px; }
.pd-form-inline { display:flex; gap:8px; flex-wrap:wrap; }
.pd-input { flex:1; min-width:200px; background:var(--surface2); border:1px solid var(--border2); border-radius:8px; padding:10px 14px; color:var(--text); font-family:var(--font-body); font-size:0.85rem; }
.pd-btn { border:none; border-radius:8px; padding:10px 18px; font-family:'Space Grotesk',sans-serif; font-size:0.8rem; font-weight:600; cursor:pointer; transition:all 0.3s; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
.pd-btn-primary { background:var(--cyan); color:#000; }
.pd-btn-primary:hover { box-shadow:0 0 20px rgba(0,229,255,0.3); }
.pd-btn-secondary { background:rgba(0,229,255,0.1); color:var(--cyan); border:1px solid rgba(0,229,255,0.3); }
.pd-btn-secondary:hover { background:rgba(0,229,255,0.2); }
.pd-btn-small { padding:6px 12px; font-size:0.75rem; background:rgba(0,229,255,0.1); color:var(--cyan); }
.pd-btn-small:hover { background:rgba(0,229,255,0.2); }
.pd-btn-danger { background:rgba(255,60,172,0.15); color:var(--pink); }
.pd-btn-danger:hover { background:rgba(255,60,172,0.25); }
.pd-empty { color:var(--muted); font-size:0.85rem; text-align:center; padding:16px; }
.pd-grupo { background:var(--surface2); border:1px solid var(--border); border-radius:12px; padding:16px; margin-bottom:12px; }
.pd-grupo-header { display:flex; align-items:center; gap:12px; margin-bottom:12px; flex-wrap:wrap; }
.pd-grupo-header h3 { margin:0; font-size:1rem; color:var(--text); flex:1; }
.pd-codigo { font-family:var(--font-mono); font-size:0.85rem; color:var(--yellow); background:rgba(255,210,63,0.1); padding:4px 10px; border-radius:6px; }
.pd-estudiantes-count { font-family:var(--font-mono); font-size:0.8rem; color:var(--muted); }
.pd-tabla-wrapper { overflow-x:auto; }
.pd-tabla { width:100%; border-collapse:collapse; font-size:0.85rem; }
.pd-tabla th { text-align:left; padding:8px 12px; border-bottom:1px solid var(--border); color:var(--muted); font-family:var(--font-mono); font-size:0.7rem; text-transform:uppercase; letter-spacing:0.5px; }
.pd-tabla td { padding:8px 12px; border-bottom:1px solid rgba(255,255,255,0.04); color:var(--text); }
.pd-tabla tr:last-child td { border-bottom:none; }
.pd-grupo-actions { display:flex; flex-wrap:wrap; gap:8px; margin-top:16px; }
.pd-table-actions { display:flex; flex-wrap:wrap; gap:8px; }
.pd-btn-ghost { background:rgba(255,255,255,0.06); color:var(--text); border:1px solid rgba(255,255,255,0.08); }
.pd-btn-ghost:hover { background:rgba(255,255,255,0.12); }
.pd-summary-card { background:rgba(0,229,255,0.06); border:1px solid rgba(0,229,255,0.12); border-radius:12px; padding:14px; flex:1; min-width:160px; }
.pd-group-summary { display:flex; gap:12px; margin-bottom:16px; flex-wrap:wrap; }
.pd-assigned-lessons { background:rgba(0,255,255,0.04); border:1px solid rgba(0,255,255,0.12); border-radius:16px; padding:16px; margin-bottom:16px; }
.pd-assigned-header { display:flex; justify-content:space-between; align-items:center; gap:12px; margin-bottom:10px; font-size:0.9rem; color:var(--muted); }
.pd-assigned-list { list-style:none; margin:0; padding:0; display:grid; gap:10px; }
.pd-assigned-list li { display:flex; justify-content:space-between; align-items:center; gap:12px; padding:10px 12px; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08); border-radius:12px; }
.pd-assigned-slug { font-size:0.85rem; color:var(--text); }
.pd-inline-form { display:inline-flex; flex-wrap:wrap; gap:8px; align-items:center; }
.pd-assign-form { margin-top:10px; }
.pd-select-group { display:flex; gap:10px; flex-wrap:wrap; align-items:center; }
.pd-select { min-width:240px; max-width:100%; background:var(--surface3); border:1px solid var(--border); color:var(--text); border-radius:10px; padding:12px 14px; appearance:none; }
.pd-select option[disabled] { color:var(--muted); }
.pd-lesson-preview { max-width:480px; min-width:180px; margin-left:8px; padding:8px 10px; background:rgba(255,255,255,0.02); border-radius:8px; border:1px solid rgba(255,255,255,0.03); }
.pd-lesson-title { display:block; font-weight:600; margin-bottom:6px; color:var(--text); }
.pd-lesson-excerpt { margin:0; font-size:0.9rem; color:var(--muted); }
.pd-lesson-search { width:100%; min-width:220px; padding:10px 12px; border:1px solid var(--border); border-radius:10px; background:var(--surface2); color:var(--text); }
.pd-lesson-modal { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.65); z-index:12000; align-items:center; justify-content:center; }
.pd-lesson-modal .inner { background:var(--surface); padding:18px; border-radius:12px; max-width:1100px; width:95%; max-height:80vh; overflow:auto; }
.pd-lesson-modal h3 { margin-top:0; }
.pd-lesson-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:12px; margin-top:8px; }
.pd-lesson-card { background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.04); padding:10px; border-radius:10px; cursor:pointer; }
.pd-lesson-card.disabled { opacity:0.45; cursor:not-allowed; }
.pd-lesson-card h4 { margin:0 0 6px 0; font-size:0.95rem; }
.pd-lesson-card p { margin:0; font-size:0.85rem; color:var(--muted); }
.pd-lesson-modal .modal-close { float:right; background:none;border:none;color:var(--muted); font-size:1.1rem; }
.pd-teacher-card { background:rgba(0,229,255,0.06); border-color:rgba(0,229,255,0.18); }
.pd-teacher-profile { display:flex; justify-content:space-between; align-items:flex-start; gap:16px; margin-bottom:18px; }
.pd-teacher-profile h2 { margin:0; font-size:1.15rem; }
.pd-teacher-intro { margin:6px 0 0; color:var(--muted); max-width:640px; }
.pd-teacher-meta { text-align:right; font-size:0.9rem; color:var(--text); }
.pd-teacher-stats { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:12px; }
.pd-stat-card { background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08); border-radius:14px; padding:16px; text-align:center; }
.pd-stat-card span { display:block; color:var(--muted); margin-bottom:6px; font-size:0.8rem; }
.pd-stat-card strong { font-size:1.3rem; }
.pd-chart-label { font-size:0.85rem; color:var(--muted); margin-bottom:6px; }
.pd-chart-note { font-size:0.82rem; color:var(--muted); margin-top:8px; }
.pd-hidden-panel { background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); border-radius:12px; padding:14px; margin-top:12px; }
.pd-form-vertical { display:flex; flex-direction:column; gap:12px; }
.pd-form-vertical label { font-size:0.82rem; color:var(--muted); }
.pd-input textarea { resize: vertical; }
.pd-badge { display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:999px; font-size:0.8rem; }
.pd-badge-alert { background:rgba(255,90,90,0.1); color:var(--pink); }
.pd-badge-warning { background:rgba(255,200,50,0.14); color:var(--yellow); }
.pd-badge-muted { background:rgba(255,255,255,0.08); color:var(--muted); }
.pd-score-cell.empty { color:var(--muted); }
.pd-score-cell.score-low { background:rgba(255,100,100,0.08); color:var(--pink); }
.pd-score-cell.score-medium { background:rgba(255,195,0,0.12); color:var(--yellow); }
.pd-score-cell.score-high { background:rgba(0,200,120,0.12); color:var(--green); }
.pd-grid { display:grid; gap:16px; grid-template-columns: repeat(3, minmax(0, 1fr)); margin-bottom:20px; }
.pd-card-highlight { background:rgba(0,229,255,0.06); border-color:rgba(0,229,255,0.18); }
.pd-card-metric { min-height:180px; }
.pd-subtitle { margin:8px 0 0; color:var(--muted); font-size:0.95rem; }
.pd-group-meta { margin:4px 0 0; color:var(--muted); font-size:0.88rem; }
.pd-grupo-badges { display:flex; flex-wrap:wrap; gap:8px; }
.pd-chart-tip { box-shadow: 0 12px 32px rgba(0,0,0,0.24); border-radius:14px; padding:10px 12px; backdrop-filter: blur(8px); }
.pd-chart { position:relative; border-radius:20px; overflow:hidden; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); }
.pd-group-chart { cursor:pointer; border-radius:24px; padding:18px; background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08); transition:transform 0.2s ease, background 0.2s ease; }
.pd-group-chart:hover { transform:translateY(-2px); background:rgba(255,255,255,0.06); }
.pd-chart-label { font-size:0.9rem; color:var(--muted); margin-bottom:10px; }
.pd-chart-note { font-size:0.85rem; color:var(--muted); margin-top:10px; }
.pd-hidden-panel { background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); border-radius:22px; padding:18px; margin-top:16px; }
.pd-form-vertical { display:flex; flex-direction:column; gap:14px; }
.pd-form-vertical label { font-size:0.88rem; color:var(--muted); }
.pd-input textarea { resize: vertical; min-height:110px; }
@media (max-width:1024px) {
    .pd-grid { grid-template-columns: 1fr; }
    .pd-group-summary { grid-template-columns: 1fr; }
}
@media (max-width:700px) {
    .pd-header { flex-direction:column; align-items:flex-start; }
    .pd-form-inline { display:grid; grid-template-columns: 1fr; }
    .pd-input { min-width:auto; }
}
</style>

<!-- Student progress modal -->
<div id="pd-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.6);align-items:center;justify-content:center;z-index:9999">
  <div style="background:var(--surface);padding:18px;border-radius:12px;max-width:720px;width:95%;max-height:80vh;overflow:auto;">
    <button onclick="closeModal()" style="float:right;background:none;border:none;color:var(--muted);font-size:1.1rem">✖</button>
    <h3 id="pd-modal-title"></h3>
    <div id="pd-modal-body" style="margin-top:12px;font-size:0.9rem"></div>
  </div>
</div>
<!-- Lesson selection modal -->
<div id="pd-lesson-modal" class="pd-lesson-modal" aria-hidden="true">
    <div class="inner" role="dialog" aria-modal="true" aria-label="Seleccionar lección">
        <button class="modal-close" onclick="closeLessonModal()">✖</button>
        <h3>Seleccionar lección</h3>
        <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center; margin-bottom:12px;">
            <div style="flex:1; min-width:220px;">
                <p class="pd-muted">Haz clic en una lección para seleccionarla. Las lecciones ya asignadas se muestran deshabilitadas.</p>
            </div>
            <div style="min-width:240px; width:100%; max-width:320px;">
                <input id="pd-lesson-search" class="pd-lesson-search" type="search" placeholder="Buscar lección por título o palabra clave" aria-label="Buscar lección" autocomplete="off">
            </div>
        </div>
        <div id="pd-lesson-no-results" class="pd-muted" style="display:none; margin-bottom:12px;" aria-live="polite">No se encontraron lecciones coincidentes.</div>
        <div class="pd-lesson-grid">
            <?php foreach ($lessonOptionsByMateria as $materia => $lessons): ?>
                <?php foreach ($lessons as $lesson): ?>
                    <?php $excerpt = strip_tags($lesson['contenido'] ?? ''); $excerpt = mb_substr($excerpt,0,160); if(mb_strlen(strip_tags($lesson['contenido'] ?? ''))>160) $excerpt .= '...'; ?>
                    <div class="pd-lesson-card" data-slug="<?= htmlspecialchars($lesson['slug'], ENT_QUOTES) ?>" data-titulo="<?= htmlspecialchars($lesson['titulo'], ENT_QUOTES) ?>" data-desc="<?= htmlspecialchars($excerpt, ENT_QUOTES) ?>">
                        <h4><?= htmlspecialchars($lesson['titulo']) ?></h4>
                        <p><?= htmlspecialchars($excerpt) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Grade history modal -->
<div id="pd-gradehistory-modal" class="pd-lesson-modal" aria-hidden="true">
    <div class="inner" role="dialog" aria-modal="true">
        <button class="modal-close" onclick="closeGradeHistory()">✖</button>
        <h3 class="gh-title">Historial de calificaciones</h3>
        <div class="gh-body" style="margin-top:8px"></div>
    </div>
</div>

<!-- Large chart modal -->
<div id="pd-chart-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.65);align-items:center;justify-content:center;z-index:10000">
  <div style="background:var(--surface);padding:18px;border-radius:12px;max-width:1100px;width:95%;max-height:90vh;overflow:auto;">
    <button onclick="closeChartModal()" style="float:right;background:none;border:none;color:var(--muted);font-size:1.1rem">✖</button>
    <h3 id="pd-chart-modal-title">Progreso del grupo</h3>
    <div style="display:flex;gap:8px;align-items:center;margin:8px 0">
      <label style="font-size:0.9rem;color:var(--muted)">Rango:</label>
      <select id="pd-chart-range" class="pd-input" style="width:120px;padding:6px;font-size:0.9rem">
        <option value="7">7 días</option>
        <option value="30" selected>30 días</option>
        <option value="90">90 días</option>
        <option value="180">180 días</option>
      </select>
      <button id="pd-chart-export-png" class="pd-btn">Export PNG</button>
      <button id="pd-chart-export-csv" class="pd-btn">Export CSV</button>
    </div>
    <canvas id="pd-chart-canvas" width="1000" height="300" style="width:100%;height:320px;border-radius:8px;border:1px solid var(--border)"></canvas>
    <div id="pd-chart-legend" style="margin-top:8px;font-size:0.9rem;color:var(--muted)"></div>
  </div>
</div>

<script>
function toggleNotify(id){var el=document.getElementById('notify-'+id); if(el) el.style.display = el.style.display==='none' ? 'block' : 'none';}
function showRename(id,name){document.getElementById('rename-'+id).style.display='block';}
function hideRename(id){document.getElementById('rename-'+id).style.display='none';}

async function openStudentProgress(grupoId, studentId, studentName){
  var modal = document.getElementById('pd-modal');
  var title = document.getElementById('pd-modal-title');
  var body = document.getElementById('pd-modal-body');
    // if studentName not provided, try to read from the table row
    if (!studentName) {
        var row = document.querySelector(`.pd-tabla-gradebook tbody tr td .pd-grade-input[data-user="${studentId}"]`);
        if (row) {
            // the input is inside a td; find the row and first cell
            var tr = row.closest('tr');
            if (tr) studentName = tr.querySelector('td') ? tr.querySelector('td').textContent.trim() : '';
        }
    }
    title.textContent = 'Progreso de ' + (studentName || 'estudiante');
  body.innerHTML = '<p>Cargando...</p>';
  modal.style.display = 'flex';
  try{
    var resp = await fetch('panel_docente_api.php?action=get_student_progress&grupo_id='+grupoId+'&student_id='+studentId, {credentials:'same-origin'});
    if(!resp.ok) throw new Error('HTTP '+resp.status);
    var json = await resp.json();
    if(json.error){ body.innerHTML = '<div style="color:var(--pink)">'+json.error+'</div>'; return; }
    var html = '<div style="margin-bottom:8px"><strong>Estadísticas</strong>: Rank '+json.stats.rank+' / '+json.stats.total+' • Lecciones completadas: '+json.stats.lecciones+' ('+json.stats.pct+'%)</div>';
    html += '<table style="width:100%;border-collapse:collapse"><thead><tr><th style="text-align:left; padding:6px 8px">Lección</th><th style="text-align:left">Score</th><th style="text-align:left">Fecha</th></tr></thead><tbody>';
    json.progreso.forEach(function(p){ html += '<tr><td style="padding:6px 8px">'+(p.leccion_slug || '')+'</td><td style="padding:6px 8px">'+(p.score===null?'-':p.score)+'</td><td style="padding:6px 8px">'+(p.updated_at||'')+'</td></tr>'; });
    html += '</tbody></table>';
    body.innerHTML = html;
  }catch(e){ body.innerHTML = '<div style="color:var(--pink)">Error cargando progreso.</div>'; console.error(e);} 
}
function closeModal(){document.getElementById('pd-modal').style.display='none';}

// Render small bar charts for each group using simple canvas drawing (no external lib)
async function loadGroupCharts(){
    // only select actual <canvas> elements whose id starts with chart-
    var canvases = document.querySelectorAll('canvas[id^="chart-"]');
    canvases.forEach(async function(cv){
        var id = cv.id.replace('chart-','');
        await loadChartFor(cv, id, 30);
    });
}

async function loadChartFor(canvas, grupoId, days){
  try{
    var resp = await fetch('panel_docente_api.php?action=group_progress_timeseries&grupo_id='+encodeURIComponent(grupoId)+'&days='+encodeURIComponent(days), {credentials:'same-origin'});
    if(!resp.ok) throw new Error('HTTP '+resp.status);
    var json = await resp.json();
    if(json.error) { drawEmptyChart(canvas); return; }
    // attach timeseries to canvas element for tooltip/export
    canvas._timeseries = json.timeseries || [];
    drawTinyBarChart(canvas, canvas._timeseries);
    attachChartHover(canvas, grupoId);
  }catch(e){ console.error('Chart load error',e); drawEmptyChart(canvas); }
}

function reloadChart(selectEl, grupoId){
  var days = parseInt(selectEl.value) || 30;
  var canvas = document.getElementById('chart-'+grupoId);
  if(canvas) loadChartFor(canvas, grupoId, days);
}

function exportChartPNG(grupoId){
  var canvas = document.getElementById('chart-'+grupoId);
  if(!canvas) return;
  var url = canvas.toDataURL('image/png');
  var a = document.createElement('a'); a.href = url; a.download = 'grupo_'+grupoId+'_progress.png'; document.body.appendChild(a); a.click(); a.remove();
}

function drawEmptyChart(canvas){
  var ctx = canvas.getContext('2d'); ctx.clearRect(0,0,canvas.width,canvas.height);
  ctx.fillStyle = 'rgba(255,255,255,0.06)'; ctx.fillRect(0, canvas.height/2 - 4, canvas.width, 8);
}

function drawTinyBarChart(canvas, timeseries){
  var ctx = canvas.getContext('2d');
  var w = canvas.width, h = canvas.height; ctx.clearRect(0,0,w,h);
  if(!timeseries || timeseries.length===0){ drawEmptyChart(canvas); return; }
  var values = timeseries.map(function(r){ return r.completed; });
  var max = Math.max.apply(null, values); if(max===0) max=1;
  var gap = 2; var barW = Math.max(1, Math.floor((w - (values.length-1)*gap) / values.length));
  canvas._barW = barW; canvas._gap = gap;
  for(var i=0;i<values.length;i++){
    var val = values[i];
    var barH = Math.round((val/max) * (h - 4));
    var x = i*(barW+gap);
    var y = h - barH;
    // color gradient
    var g = Math.round(120 * (val/max));
    ctx.fillStyle = 'rgba(0,'+g+',200,0.9)';
    ctx.fillRect(x, y, barW, barH);
  }
}

function attachChartHover(canvas, grupoId){
  if(canvas._hoverAttached) return; canvas._hoverAttached = true;
  var tip = document.getElementById('chart-tip-'+grupoId);
  canvas.addEventListener('mousemove', function(e){
    var rect = canvas.getBoundingClientRect(); var x = e.clientX - rect.left;
    var barW = canvas._barW || 3; var gap = canvas._gap || 2;
    var idx = Math.floor(x / (barW+gap));
    var ts = canvas._timeseries || [];
    if(idx < 0 || idx >= ts.length){ tip.style.display='none'; return; }
    var item = ts[idx];
    tip.innerHTML = '<strong>'+item.date+'</strong><div style="font-size:0.85rem;color:var(--muted)">Completadas: '+item.completed+'</div>';
    tip.style.display='block';
    tip.style.left = (e.pageX + 12) + 'px'; tip.style.top = (e.pageY + 6) + 'px';
  });
  canvas.addEventListener('mouseleave', function(){ if(tip) tip.style.display='none'; });
}

document.addEventListener('DOMContentLoaded', function(){ loadGroupCharts(); // attach events for chart modal controls
  var modalRange = document.getElementById('pd-chart-range');
  var exportPngBtn = document.getElementById('pd-chart-export-png');
  var exportCsvBtn = document.getElementById('pd-chart-export-csv');
  if(modalRange){ modalRange.addEventListener('change', function(){ if(window.pdChartCurrentGroup) loadChartModal(window.pdChartCurrentGroup, parseInt(this.value)); }); }
  if(exportPngBtn){ exportPngBtn.addEventListener('click', function(){ if(window.pdChartCurrentGroup) exportLargeChartPNG(window.pdChartCurrentGroup); }); }
  if(exportCsvBtn){ exportCsvBtn.addEventListener('click', function(){ if(window.pdChartCurrentGroup) exportLargeChartCSV(window.pdChartCurrentGroup); }); }
});

// Lesson modal logic
function openLessonModalFor(form, assignedJson){
    window._activeLessonForm = form;
    var assigned = [];
    try{ assigned = JSON.parse(assignedJson || '[]'); }catch(e){ assigned = []; }
    var modal = document.getElementById('pd-lesson-modal');
    modal.style.display = 'flex'; modal.setAttribute('aria-hidden','false');
    var search = modal.querySelector('#pd-lesson-search');
    var noResults = modal.querySelector('#pd-lesson-no-results');
    if(search){ search.value = ''; }
    if(noResults){ noResults.style.display = 'none'; }
    // enable/disable cards based on assigned
    var cards = modal.querySelectorAll('.pd-lesson-card');
    cards.forEach(function(c){
        var slug = c.getAttribute('data-slug');
        c.style.display = '';
        if(assigned.indexOf(slug)!==-1){ c.classList.add('disabled'); c.setAttribute('aria-disabled','true'); }
        else { c.classList.remove('disabled'); c.removeAttribute('aria-disabled'); }
    });
}
function closeLessonModal(){ var modal = document.getElementById('pd-lesson-modal'); modal.style.display='none'; modal.setAttribute('aria-hidden','true'); window._activeLessonForm = null; }
document.addEventListener('DOMContentLoaded', function(){
    // open modal buttons
    document.querySelectorAll('.pd-open-lesson-modal').forEach(function(btn){ btn.addEventListener('click', function(e){ var form = btn.closest('form'); openLessonModalFor(form, btn.getAttribute('data-assigned')); }); });
    // card selection
    var modal = document.getElementById('pd-lesson-modal');
    if(modal){
        modal.addEventListener('click', function(e){ var card = e.target.closest('.pd-lesson-card'); if(!card) return; if(card.classList.contains('disabled')) return; var slug = card.getAttribute('data-slug'); var titulo = card.getAttribute('data-titulo'); var desc = card.getAttribute('data-desc');
            var form = window._activeLessonForm; if(!form) return; var hidden = form.querySelector('input[name="lesson_slug"]'); if(hidden){ hidden.value = slug; }
            var titleEl = form.querySelector('.pd-lesson-title'); var descEl = form.querySelector('.pd-lesson-excerpt'); if(titleEl) titleEl.textContent = titulo; if(descEl) descEl.textContent = desc;
            var submit = form.querySelector('.pd-assign-submit'); if(submit){ submit.disabled = false; }
            closeLessonModal();
        });
        modal.querySelector('.modal-close').addEventListener('click', closeLessonModal);
        modal.addEventListener('click', function(e){ if(e.target === modal) closeLessonModal(); });
        document.addEventListener('keydown', function(e){ if(e.key==='Escape') closeLessonModal(); });
        var search = document.getElementById('pd-lesson-search');
        var noResults = document.getElementById('pd-lesson-no-results');
        if (search) {
            search.addEventListener('input', function(){
                var query = search.value.trim().toLowerCase();
                var cards = modal.querySelectorAll('.pd-lesson-card');
                var visible = 0;
                cards.forEach(function(card){
                    var title = card.getAttribute('data-titulo') || '';
                    var desc = card.getAttribute('data-desc') || '';
                    var slug = card.getAttribute('data-slug') || '';
                    var text = (title + ' ' + desc + ' ' + slug).toLowerCase();
                    if(query === '' || text.indexOf(query) !== -1) {
                        card.style.display = '';
                        visible++;
                    } else {
                        card.style.display = 'none';
                    }
                });
                if(noResults) noResults.style.display = visible ? 'none' : 'block';
            });
        }
    }
});

function copyGroupCode(code, btn){
  if (!navigator.clipboard) {
    return alert('Tu navegador no soporta copiar al portapapeles.');
  }
  navigator.clipboard.writeText(code).then(function(){
    var original = btn.textContent;
    btn.textContent = '✅ Copiado';
    setTimeout(function(){ btn.textContent = original; }, 1800);
  }).catch(function(){ alert('No se pudo copiar el código.'); });
}

// Chart modal functions
function openChartModal(grupoId){
  window.pdChartCurrentGroup = grupoId;
  var modal = document.getElementById('pd-chart-modal');
  var title = document.getElementById('pd-chart-modal-title');
  var range = document.getElementById('pd-chart-range');
  title.textContent = 'Progreso del grupo '+grupoId;
  modal.style.display = 'flex';
  loadChartModal(grupoId, parseInt(range.value)||30);
}
function closeChartModal(){
  var modal = document.getElementById('pd-chart-modal');
  modal.style.display = 'none';
  // destroy canvas state
  var c = document.getElementById('pd-chart-canvas'); if(c) c.getContext('2d').clearRect(0,0,c.width,c.height);
}

// Grade history modal
function openGradeHistory(grupoId, userId, userName){
    var modal = document.getElementById('pd-gradehistory-modal');
        if(!modal) return;
        // obtain name if not provided
        if (!userName) {
            var input = document.querySelector(`.pd-grade-input[data-user="${userId}"]`);
            if (input) {
                var tr = input.closest('tr');
                if (tr) userName = tr.querySelector('td') ? tr.querySelector('td').textContent.trim() : '';
            }
        }
        modal.style.display = 'flex'; modal.setAttribute('aria-hidden','false');
        modal.querySelector('.gh-title').textContent = 'Historial de calificaciones — ' + (userName || 'estudiante');
    var body = modal.querySelector('.gh-body'); body.innerHTML = '<p class="pd-muted">Cargando…</p>';
    fetch('panel_docente_api.php?action=grade_history&grupo_id='+encodeURIComponent(grupoId)+'&user_id='+encodeURIComponent(userId), {credentials:'same-origin'})
        .then(function(r){ return r.json(); }).then(function(json){ if(json.error){ body.innerHTML = '<div style="color:var(--pink)">'+json.error+'</div>'; return; }
            if(!json.history || json.history.length===0){ body.innerHTML = '<p class="pd-muted">No hay cambios registrados.</p>'; return; }
            var html = '<table style="width:100%;border-collapse:collapse"><thead><tr><th>Fecha</th><th>Lección</th><th>Anterior</th><th>Nueva</th><th>Cambiado por</th></tr></thead><tbody>';
            json.history.forEach(function(h){ html += '<tr><td style="padding:6px">'+h.changed_at+'</td><td style="padding:6px">'+h.slug+'</td><td style="padding:6px">'+(h.old_score===null?'-':h.old_score)+'</td><td style="padding:6px">'+(h.new_score===null?'-':h.new_score)+'</td><td style="padding:6px">'+h.changed_by_name+'</td></tr>'; });
            html += '</tbody></table>';
            body.innerHTML = html;
        }).catch(function(){ body.innerHTML = '<div style="color:var(--pink)">Error cargando historial.</div>'; });
}
function closeGradeHistory(){ var m = document.getElementById('pd-gradehistory-modal'); if(m){ m.style.display='none'; m.setAttribute('aria-hidden','true'); } }

async function loadChartModal(grupoId, days){
  var canvas = document.getElementById('pd-chart-canvas');
  var ctx = canvas.getContext('2d');
  ctx.clearRect(0,0,canvas.width,canvas.height);
  try{
    var resp = await fetch('panel_docente_api.php?action=group_progress_timeseries&grupo_id='+encodeURIComponent(grupoId)+'&days='+encodeURIComponent(days), {credentials:'same-origin'});
    if(!resp.ok) throw new Error('HTTP '+resp.status);
    var json = await resp.json();
    if(json.error){ ctx.fillStyle='rgba(255,0,0,0.06)'; ctx.fillText('Error: '+json.error,10,20); return; }
    window.pdChartSeries = json.timeseries || [];
    renderLargeChart(canvas, window.pdChartSeries);
    document.getElementById('pd-chart-legend').textContent = 'Últimos '+days+' días — puntos: completadas por día';
  }catch(e){ console.error(e); ctx.fillStyle='rgba(255,0,0,0.06)'; ctx.fillText('Error cargando datos',10,20); }
}

function renderLargeChart(canvas, timeseries){
  var ctx = canvas.getContext('2d');
  var w = canvas.width = canvas.clientWidth * 2; // Hi-DPI
  var h = canvas.height = canvas.clientHeight * 2;
  ctx.scale(2,2);
  // simple margins
  var margin = {left:48, right:12, top:18, bottom:36};
  var innerW = canvas.clientWidth - (margin.left+margin.right);
  var innerH = canvas.clientHeight - (margin.top+margin.bottom);
  ctx.clearRect(0,0,canvas.width,canvas.height);
  // prepare arrays
  var labels = timeseries.map(function(r){ return r.date; });
  var values = timeseries.map(function(r){ return r.completed; });
  var max = Math.max.apply(null, values); if(max===0) max = 1;
  // draw axes
  ctx.save(); ctx.translate(0,0);
  ctx.strokeStyle = 'rgba(255,255,255,0.06)'; ctx.lineWidth = 1;
  // Y grid lines
  ctx.font = '12px "Space Grotesk", sans-serif'; ctx.fillStyle = 'var(--muted)';
  var steps = 4;
  for(var i=0;i<=steps;i++){
    var y = margin.top + i*(innerH/steps);
    ctx.beginPath(); ctx.moveTo(margin.left, y); ctx.lineTo(margin.left+innerW, y); ctx.stroke();
    var val = Math.round(max * (1 - i/steps)); ctx.fillText(val, 6, y+4);
  }
  // X labels every N
  var skip = Math.ceil(labels.length / 8);
  ctx.fillStyle = 'var(--muted)';
  for(var i=0;i<labels.length;i+=skip){
    var x = margin.left + (i/(labels.length-1 || 1)) * innerW;
    ctx.fillText(labels[i], x-16, margin.top+innerH+16);
  }
  // draw line
  ctx.beginPath();
  for(var i=0;i<values.length;i++){
    var x = margin.left + (i/(values.length-1 || 1)) * innerW;
    var y = margin.top + (1 - (values[i]/max)) * innerH;
    if(i===0) ctx.moveTo(x,y); else ctx.lineTo(x,y);
  }
  ctx.strokeStyle = 'rgba(0,180,255,0.95)'; ctx.lineWidth = 2; ctx.stroke();
  // draw area
  ctx.lineTo(margin.left+innerW, margin.top+innerH);
  ctx.lineTo(margin.left, margin.top+innerH);
  ctx.closePath();
  ctx.fillStyle = 'rgba(0,180,255,0.12)'; ctx.fill();
  // draw points
  canvas._points = [];
  for(var i=0;i<values.length;i++){
    var x = margin.left + (i/(values.length-1 || 1)) * innerW;
    var y = margin.top + (1 - (values[i]/max)) * innerH;
    ctx.beginPath(); ctx.arc(x, y, 3, 0, Math.PI*2); ctx.fillStyle='rgba(0,180,255,1)'; ctx.fill();
    canvas._points.push({x:x, y:y, date:labels[i], val:values[i]});
  }
  ctx.restore();
  // attach interaction
  attachLargeChartHover(canvas);
}

function attachLargeChartHover(canvas){
  if(canvas._hover) return; canvas._hover = true;
  var tip = document.getElementById('pd-chart-modal');
  var ctx = canvas.getContext('2d');
  canvas.addEventListener('mousemove', function(e){
    var rect = canvas.getBoundingClientRect(); var mx = (e.clientX - rect.left) * 2; var my = (e.clientY - rect.top) * 2; // hi-dpi
    var nearest = null; var dist = Infinity;
    for(var i=0;i<canvas._points.length;i++){
      var p = canvas._points[i]; var dx = mx - p.x*2; var dy = my - p.y*2; var d = dx*dx + dy*dy;
      if(d < dist){ dist = d; nearest = p; }
    }
    // redraw to highlight
    renderLargeChartHighlight(canvas, nearest);
  });
  canvas.addEventListener('mouseleave', function(){ renderLargeChartHighlight(canvas, null); });
}

function renderLargeChartHighlight(canvas, point){
  // re-render and draw tooltip for point
  var ctx = canvas.getContext('2d');
  if(!window.pdChartSeries) return;
  renderLargeChart(canvas, window.pdChartSeries); // expensive but simple
  if(point){
    ctx.beginPath(); ctx.arc(point.x, point.y, 6, 0, Math.PI*2); ctx.fillStyle='rgba(255,255,255,0.9)'; ctx.fill();
  }
}

function exportLargeChartPNG(grupoId){
  var canvas = document.getElementById('pd-chart-canvas'); if(!canvas) return;
  // scale down to client size for PNG
  var link = document.createElement('a'); link.href = canvas.toDataURL('image/png'); link.download = 'grupo_'+grupoId+'_progress_large.png'; document.body.appendChild(link); link.click(); link.remove();
}

function exportLargeChartCSV(grupoId){
  var series = window.pdChartSeries || [];
  var rows = ['date,completed'];
  series.forEach(function(r){ rows.push(r.date+','+r.completed); });
  var blob = new Blob([rows.join('\n')], {type:'text/csv;charset=utf-8;'});
  var url = URL.createObjectURL(blob);
  var a = document.createElement('a'); a.href = url; a.download = 'grupo_'+grupoId+'_timeseries.csv'; document.body.appendChild(a); a.click(); a.remove(); URL.revokeObjectURL(url);
}

// Gradebook: AJAX save handlers
// Note: lesson selection uses a modal + hidden input, not a native select.
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.pd-save-grade').forEach(function(btn){
        btn.addEventListener('click', function(e){
            var input = btn.parentElement.querySelector('.pd-grade-input');
            if(!input) return;
            var raw = input.value.trim();
            if (raw !== '' && !/^[0-9]+$/.test(raw)) {
                alert('Ingresa un valor numérico válido entre 0 y 100.');
                input.focus();
                return;
            }
            var score = raw === '' ? null : parseInt(raw, 10);
            if (score !== null && (score < 0 || score > 100)) {
                alert('El puntaje debe estar entre 0 y 100.');
                input.focus();
                return;
            }
            var userId = input.getAttribute('data-user');
            var slug = input.getAttribute('data-slug');
            var grupo = input.getAttribute('data-grupo');
            var csrfMeta = document.querySelector('meta[name="csrf-token"]');
            var csrf = csrfMeta ? csrfMeta.getAttribute('content') : '';
            btn.disabled = true; btn.textContent = 'Guardando...';
            fetch('panel_docente_api.php?action=grade_update', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {'Content-Type':'application/json'},
                body: JSON.stringify({csrf_token: csrf, grupo_id: grupo, user_id: userId, slug: slug, score: score})
            }).then(function(r){ return r.json(); }).then(function(json){
                if(json.success){
                    btn.textContent = 'Guardado';
                    setTimeout(function(){ btn.textContent = 'Guardar'; }, 1200);
                    var cell = input.closest('.pd-score-cell');
                    if(cell){ cell.classList.remove('empty','score-low','score-medium','score-high'); if(score===null){ cell.classList.add('empty'); } else if(score<60){ cell.classList.add('score-low'); } else if(score<80){ cell.classList.add('score-medium'); } else { cell.classList.add('score-high'); } }
                    if(json.change_id && json.change_id > 0){
                        var undoBtn = btn.closest('tr').querySelector('.pd-undo-btn');
                        if(undoBtn){
                            undoBtn.disabled = false;
                            undoBtn.setAttribute('data-change-id', json.change_id);
                            undoBtn.setAttribute('data-old-score', json.old_score === null ? '' : json.old_score);
                            undoBtn.setAttribute('data-slug', slug);
                            undoBtn.setAttribute('data-user', userId);
                        }
                    }
                    var row = btn.closest('tr');
                    if(row){ var lastTd = row.querySelectorAll('td')[3]; if(lastTd){ lastTd.textContent = new Date().toLocaleString(); } }
                } else {
                    alert(json.error || 'Error guardando');
                    btn.textContent = 'Guardar';
                }
            }).catch(function(){ alert('Error de red'); btn.textContent='Guardar'; }).finally(function(){ btn.disabled = false; });
        });
    });
    // auto-save on blur
    document.querySelectorAll('.pd-grade-input').forEach(function(inp){
        var timer = null;
        inp.addEventListener('blur', function(e){
            var btn = inp.closest('td').querySelector('.pd-save-grade');
            if(btn) btn.click();
            // visual feedback handled by save promise
        });
        // optional: debounce while typing and save after pause
        inp.addEventListener('input', function(){
            if(timer) clearTimeout(timer);
            timer = setTimeout(function(){ var btn = inp.closest('td').querySelector('.pd-save-grade'); if(btn) btn.click(); }, 1200);
        });
    });
    // undo last change
    document.querySelectorAll('.pd-undo-btn').forEach(function(btn){
        btn.addEventListener('click', function(e){
            if(btn.disabled) return;
            if(!confirm('¿Deshacer el último cambio para este estudiante?')) return;
            var changeId = btn.getAttribute('data-change-id');
            if(!changeId) return alert('No hay cambio para deshacer');
            var csrfMeta = document.querySelector('meta[name="csrf-token"]');
            var csrf = csrfMeta ? csrfMeta.getAttribute('content') : '';
            btn.disabled = true; btn.textContent = 'Deshaciendo...';
            fetch('panel_docente_api.php?action=grade_undo', {
                method: 'POST', credentials: 'same-origin', headers: {'Content-Type':'application/json'},
                body: JSON.stringify({csrf_token: csrf, change_id: parseInt(changeId,10)})
            }).then(function(r){ return r.json(); }).then(function(json){
                if(json.success){
                    var userId = btn.getAttribute('data-user');
                    var slug = btn.getAttribute('data-slug');
                    var restored = json.restored_score;
                    var input = document.querySelector(`.pd-grade-input[data-user="${userId}"][data-slug="${slug}"]`);
                    if(input){ input.value = restored === null ? '' : restored; var cell = input.closest('.pd-score-cell'); if(cell){ cell.classList.remove('empty','score-low','score-medium','score-high'); if(restored === null){ cell.classList.add('empty'); } else if(restored < 60){ cell.classList.add('score-low'); } else if(restored < 80){ cell.classList.add('score-medium'); } else { cell.classList.add('score-high'); } } }
                    btn.textContent = 'Deshecho';
                    setTimeout(function(){ btn.textContent = '↶ Deshacer'; btn.disabled = true; }, 1200);
                    var row = btn.closest('tr'); if(row){ var lastTd = row.querySelectorAll('td')[3]; if(lastTd) lastTd.textContent = '—'; }
                    if(document.getElementById('pd-gradehistory-modal').style.display === 'flex'){
                        openGradeHistory(json.grupo_id, json.user_id);
                    }
                } else {
                    alert(json.error || 'Error al deshacer'); btn.textContent = '↶ Deshacer';
                }
            }).catch(function(){ alert('Error de red'); btn.textContent = '↶ Deshacer'; }).finally(function(){ /*btn.disabled = false; leave disabled after success*/ });
        });
    });
    // show temporary success border when saved (listen to clicks that succeed)
    document.addEventListener('click', function(e){ if(e.target && e.target.classList && e.target.classList.contains('pd-save-grade')){
        var btn = e.target; setTimeout(function(){ var cell = btn.closest('.pd-score-cell'); if(cell){ cell.style.boxShadow = '0 0 8px rgba(0,200,120,0.25)'; setTimeout(function(){ cell.style.boxShadow = ''; }, 1100); } }, 600);
    }});
});
</script>

<?php require __DIR__ . '/../src/Templates/page_end.php'; ?>
