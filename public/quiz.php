<?php
// ==========================================
// LC-ADVANCE - quiz.php
// ==========================================
// Autor: LC-TEAM
// ==========================================

require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Core/panel_docente.php';
requireStudent();
require_once __DIR__ . '/../src/Content/content.php'; // Incluye el array $lecciones

// Función auxiliar (por compatibilidad si no existe)
if (!function_exists('redirigir')) {
    function redirigir($url) {
        header('Location: ' . $url);
        exit;
    }
}

// =================================================================================
// 2. Lógica de Carga de la Lección (Usa GET o POST para obtener el índice)
// =================================================================================

$leccion_id = -1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si se envía el formulario, usamos el ID oculto
    if (isset($_POST['leccion_id']) && is_numeric($_POST['leccion_id'])) {
        $leccion_id = (int)$_POST['leccion_id'];
    }
} else {
    // Si es una solicitud GET (al cargar la página), usamos el parámetro de la URL
    if (isset($_GET['leccion']) && is_numeric($_GET['leccion'])) {
        $leccion_id = (int)$_GET['leccion'];
    }
}

// Validar el ID de la lección
if ($leccion_id < 0 || !isset($lecciones[$leccion_id])) {
    $_SESSION['mensaje'] = "Error: El quiz solicitado no existe.";
    redirigir('public/dashboard.php');
}

// Cargar la lección y las preguntas correspondientes al índice
$leccion = $lecciones[$leccion_id];
$preguntas = $leccion['quiz'];


// CSRF validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrf_token = $_POST['csrf_token'] ?? '';
    if (!validarCsrfToken($csrf_token)) {
        $_SESSION['mensaje'] = "Error de validación del formulario.";
        redirigir('public/dashboard.php');
    }
}

// 3. Si el usuario envió respuestas (La lógica de procesamiento debe ir después de cargar $preguntas)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $puntosGanados = 0;
    
    foreach ($preguntas as $index => $pregunta) {
        // Verificar si la respuesta fue enviada (el nombre es 'respuesta_0', 'respuesta_1', etc.)
        $respuestaUsuario = $_POST["respuesta_$index"] ?? ''; 
        
        // strcasecmp compara sin distinguir mayúsculas/minúsculas
        if (strcasecmp(trim($respuestaUsuario), trim($pregunta['correcta'])) === 0) {
            $puntosGanados += rand(10, 20); // entre 10 y 20 puntos por pregunta correcta
        }
    }

    // Actualizar puntos
    $stmt = $pdo->prepare("UPDATE usuarios SET puntos = puntos + ? WHERE id = ?");
    $stmt->execute([$puntosGanados, $_SESSION['usuario_id']]);

    $_SESSION['mensaje'] = "¡Ganaste $puntosGanados puntos! 🎉";
    redirigir(getDashboardUrl());
}

$page_title = 'Quiz - LC-ADVANCE';
$page_fonts = 'Press+Start+2P';
$page_css_files = ['assets/css/style.css'];
$page_extra_js = '<script src="' . assetUrl('assets/js/loader.js') . '"></script><script src="' . assetUrl('assets/js/app.js') . '"></script>';
require __DIR__ . '/../src/Templates/page_start.php';
?>
<div class="header-volume">
  <button class="vol-btn" id="volBtn">🔊</button>
  <div class="vol-slider" id="volSlider">
    <input type="range" id="volExamenesSlider" min="0" max="1" step="0.1" value="0.8">
  </div>
</div>

<div class="quiz-container">
    <h1>🧠 Quiz de: <?php echo htmlspecialchars($leccion['titulo']); ?></h1>

    <form method="POST">
        <input type="hidden" name="leccion_id" value="<?php echo $leccion_id; ?>">
        <?= campoTokenCSRF() ?>

        <?php foreach ($preguntas as $index => $pregunta): ?>
            <div class="quiz-question">
                <p><strong><?php echo ($index + 1) . ". " . htmlspecialchars($pregunta['pregunta']); ?></strong></p>

                <?php foreach ($pregunta['opciones'] as $opcion): ?>
                    <label class="quiz-option">
                        <input type="radio" name="respuesta_<?php echo $index; ?>" value="<?php echo htmlspecialchars($opcion); ?>" required>
                        <?php echo htmlspecialchars($opcion); ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="btn btn-submit">Enviar Respuestas</button>
    </form>

    <p><a href="<?= htmlspecialchars(getDashboardUrl()) ?>" class="btn btn-back">Volver al Dashboard</a></p>
</div>

<script src="<?= assetUrl('assets/js/loader.js') ?>"></script>
<script src="<?= assetUrl('assets/js/app.js') ?>"></script>
<?php
$page_volume = [
    'audioId' => 'quizMusic',
    'source' => 'assets/music/cuco_examen.mp3',
    'sliderId' => 'volExamenesSlider',
    'btnId' => 'volBtn',
    'containerId' => 'volSlider',
    'channel' => 'examenes',
    'defaultVol' => 0.8,
];
require __DIR__ . '/../src/Templates/page_end.php';