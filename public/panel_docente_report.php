<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Core/panel_docente.php';
requireProfesor();

$grupo_id = isset($_GET['grupo_id']) ? (int)$_GET['grupo_id'] : 0;
$student_id = isset($_GET['student_id']) ? (int)$_GET['student_id'] : 0;
if (!$grupo_id || !$student_id) {
    http_response_code(400);
    echo 'Parámetros inválidos.';
    exit;
}

$profesor_id = (int)$_SESSION['usuario_id'];
$estudiante = obtenerEstudianteEnGrupo($grupo_id, $student_id, $profesor_id);
if (empty($estudiante)) {
    http_response_code(404);
    echo 'Estudiante o grupo no encontrados.';
    exit;
}

$progreso = obtenerProgresoDetalleEstudiante($student_id, $grupo_id, $profesor_id);
$profesor = $pdo->prepare('SELECT nombre_usuario FROM usuarios WHERE id = ?');
$profesor->execute([$profesor_id]);
$profesor_nombre = $profesor->fetchColumn() ?: 'Profesor';
$format = isset($_GET['format']) ? strtolower(trim($_GET['format'])) : 'csv';

if ($format === 'pdf') {
    // Try to render PDF via Dompdf if available
    $autoload = __DIR__ . '/../vendor/autoload.php';
    if (file_exists($autoload)) {
        require_once $autoload;
    }
    if (!class_exists('\Dompdf\Dompdf')) {
        http_response_code(501);
        echo 'PDF export requiere dompdf. Instala dependencias con Composer y ejecuta: composer install';
        exit;
    }
    // Build simple HTML report
    $html = '<!doctype html><html><head><meta charset="utf-8"><title>Reporte '.$estudiante['nombre_usuario'].'</title>';
    $html .= '<style>body{font-family:Arial,Helvetica,sans-serif;font-size:12px}table{width:100%;border-collapse:collapse}th,td{padding:6px;border:1px solid #ddd}h1,h2{margin:0}</style></head><body>';
    $html .= '<h1>Reporte de ' . htmlspecialchars($estudiante['nombre_usuario']) . '</h1>';
    $html .= '<p>Profesor: ' . htmlspecialchars($profesor_nombre) . '<br>Grupo: ' . htmlspecialchars($estudiante['grupo_nombre']) . '<br>Correo: ' . htmlspecialchars($estudiante['correo']) . '</p>';
    $html .= '<h2>Lecciones</h2>';
    $html .= '<table><thead><tr><th>Slug</th><th>Título</th><th>Score</th><th>XP</th><th>Completado</th><th>Actualizado</th></tr></thead><tbody>';
    foreach ($progreso as $fila) {
        $leccion = buscarLeccion($fila['leccion_slug']);
        $titulo = $leccion['titulo'] ?? $fila['leccion_slug'];
        $html .= '<tr><td>' . htmlspecialchars($fila['leccion_slug']) . '</td><td>' . htmlspecialchars($titulo) . '</td><td>' . htmlspecialchars($fila['score']) . '</td><td>' . htmlspecialchars($fila['lesson_xp'] ?? '') . '</td><td>' . ($fila['completed'] ? 'Sí' : 'No') . '</td><td>' . htmlspecialchars($fila['updated_at']) . '</td></tr>';
    }
    $html .= '</tbody></table>';
    $html .= '</body></html>';

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $pdf = $dompdf->output();
    $filename = 'reporte_estudiante_'.preg_replace('/[^a-zA-Z0-9_-]/', '', $estudiante['nombre_usuario']).'_'.date('Ymd').'.pdf';
    header('Content-Type: application/pdf');
    header('Content-Length: ' . strlen($pdf));
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    echo $pdf; exit;
}

// Fallback: CSV (default)
$filename = 'reporte_estudiante_'.preg_replace('/[^a-zA-Z0-9_-]/', '', $estudiante['nombre_usuario']).'_'.date('Ymd').'.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="'.$filename.'"');
$out = fopen('php://output', 'w');
fputcsv($out, ['Profesor', 'Grupo', 'Estudiante', 'Correo', 'Último login', 'Nivel', 'XP']);
fputcsv($out, [$profesor_nombre, $estudiante['grupo_nombre'], $estudiante['nombre_usuario'], $estudiante['correo'], $estudiante['ultimo_login'] ?? '', $estudiante['nivel'], $estudiante['puntos']]);
fputcsv($out, []);
fputcsv($out, ['Lección', 'Título', 'Score', 'XP lección', 'Completado', 'Actualizado en']);

foreach ($progreso as $fila) {
    $leccion = buscarLeccion($fila['leccion_slug']);
    $titulo = $leccion['titulo'] ?? $fila['leccion_slug'];
    fputcsv($out, [
        $fila['leccion_slug'],
        $titulo,
        $fila['score'],
        $fila['lesson_xp'] ?? '',
        $fila['completed'] ? 'Sí' : 'No',
        $fila['updated_at'],
    ]);
}

fclose($out);
exit;
