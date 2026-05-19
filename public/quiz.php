<?php
// ==========================================
// LC-ADVANCE - quiz.php
// ==========================================
// Autor: LC-TEAM
// ==========================================

require_once __DIR__ . '/../src/Config/config.php';
requireLogin(true); // permite invitados
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
    $dashboardTarget = 'dashboard.php';
    if (!empty($leccion['materia'])) $dashboardTarget .= '?materia=' . urlencode($leccion['materia']);
    redirigir($dashboardTarget);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - LC-ADVANCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="quiz-container">
    <h1>🧠 Quiz de: <?php echo htmlspecialchars($leccion['titulo']); ?></h1>

    <form method="POST">
        <input type="hidden" name="leccion_id" value="<?php echo $leccion_id; ?>"> 

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

    <p><a href="dashboard.php<?php echo !empty($leccion['materia']) ? '?materia=' . urlencode($leccion['materia']) : ''; ?>" class="btn btn-back">Volver al Dashboard</a></p>
</div>

<script src="assets/js/app.js"></script>
<audio id="quizMusic" loop>
  <source src="assets/music/cuco_examen.mp3" type="audio/mpeg">
</audio>
<script>
const STORAGE_KEY = 'lc_volume_settings';
function getStoredVolumes() {
  const stored = localStorage.getItem(STORAGE_KEY);
  if (stored) return JSON.parse(stored);
  return { principal: 0.1, ambiental: 0.8, examenes: 0.8 };
}
const volumes = getStoredVolumes();
const qAudio = document.getElementById('quizMusic');
qAudio.volume = volumes.examenes;
qAudio.play().then(() => console.log('Quiz music playing')).catch(e => console.log('Audio error:', e));
</script>
</body>
</html>