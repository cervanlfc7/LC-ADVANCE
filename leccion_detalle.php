<?php
// ==========================================
// LC-ADVANCE - leccion_detalle.php (Versión corregida y funcional 2025)
// Con "Volver al Dashboard" que regresa a la posición exacta de la lección
// ==========================================

session_start();
require_once 'config/config.php';
require_once 'src/content.php';

if (!isset($_SESSION['usuario_id']) && empty($_SESSION['usuario_es_invitado'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['usuario_id'] ?? null;
$slug = $_GET['slug'] ?? '';
$leccion = null;

foreach ($lecciones as $l) {
    if ($l['slug'] === $slug) {
        $leccion = $l;
        break;
    }
}

if (!$leccion) {
    header('Location: dashboard.php?error=leccion_no_encontrada');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM user_progress WHERE user_id = ? AND slug = ?");
$stmt->execute([$user_id, $slug]);
$progress = $stmt->fetch(PDO::FETCH_ASSOC);
$completed = $progress ? (bool)$progress['completed'] : false;
$old_score = $progress ? $progress['score'] : 0;

$NUM_PREGUNTAS_QUIZ = 10;
$quiz_pool = $leccion['quiz'];
if (count($quiz_pool) > $NUM_PREGUNTAS_QUIZ) {
    shuffle($quiz_pool);
    $quiz_selected = array_slice($quiz_pool, 0, $NUM_PREGUNTAS_QUIZ);
} else {
    $quiz_selected = $quiz_pool;
}
$NUM_PREGUNTAS_QUIZ_FINAL = count($quiz_selected);

$_SESSION['current_quiz'] = [
    'slug' => $slug,
    'preguntas' => $quiz_selected,
    'num_preguntas' => $NUM_PREGUNTAS_QUIZ_FINAL
];

function render_contenido($html_content) {
    return $html_content;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($leccion['titulo']); ?> | CBTIS168</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&display=swap" rel="stylesheet">
    
    <!-- MathJax -->
    <script>
      MathJax = {
        tex: {
          inlineMath: [['$', '$'], ['\\(', '\\)']],
          displayMath: [['$$', '$$'], ['\\[', '\\]']],
          processEscapes: true
        }
      };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js" async></script>
</head>
<body>

<header class="header">
    <h1>LC-ADVANCE <span style="color: #00ff00;">// ACCESS: ONLINE</span></h1>
    <nav>
        <a href="dashboard.php" class="btn btn-dashboard">⬅️ Dashboard</a>
        <a href="ranking.php" class="btn btn-dashboard">🏆 Ranking</a>
        <a href="logout.php" class="btn btn-logout">🚪 SALIR</a>
    </nav>
</header>

<div class="container">
    <div class="lesson-quiz-container">
        <div class="main-column">
            <h1 class="auth-title">MÓDULO DE APRENDIZAJE</h1>
            
            <div class="navigation-tabs">
                <button id="tab-content" class="tab-btn active">📚 CONTENIDO</button>
                <button id="tab-quiz" class="tab-btn">
                    <?php echo $completed ? '✅ REPETIR QUIZ' : '🧠 INICIAR QUIZ'; ?>
                </button>
            </div>

            <!-- Vista de Contenido -->
            <div id="content-view" class="view-panel active">
                <div class="content-header">
                    <h2><?php echo htmlspecialchars($leccion['titulo']); ?></h2>
                    <p class="materia-tag"><?php echo htmlspecialchars($leccion['materia']); ?></p>
                    <p class="progress-info-local">
                        Puntuación anterior: <span class="old-score"><?php echo $old_score; ?></span> / <?php echo $NUM_PREGUNTAS_QUIZ_FINAL; ?>
                    </p>
                </div>

                <div class="content-body">
                    <?php echo render_contenido($leccion['contenido']); ?>
                </div>

                <div class="content-footer">
                    <button id="content-to-quiz-btn" class="btn toggle-quiz-btn">🧠 Ir al Quiz</button>
                </div>
            </div>
        </div>

        <!-- Barra lateral -->
        <?php $progress_percent = $NUM_PREGUNTAS_QUIZ_FINAL ? round(($old_score / $NUM_PREGUNTAS_QUIZ_FINAL) * 100) : 0; ?>
        <aside class="side-panel" aria-label="Información de la lección">
            <div class="stat"><strong>Materia</strong><span><?php echo htmlspecialchars($leccion['materia']); ?></span></div>
            <div class="stat"><strong>Puntuación</strong><span><?php echo $old_score; ?> / <?php echo $NUM_PREGUNTAS_QUIZ_FINAL; ?></span></div>
            <div class="stat">
                <strong>Progreso</strong>
                <div class="progress" style="width:100%; background:#111; border-radius:8px; padding:6px;">
                    <div class="progress-fill" style="width:<?php echo $progress_percent; ?>%; height:12px; border-radius:6px; background: linear-gradient(90deg,var(--neon-green),var(--neon-cyan));"></div>
                </div>
            </div>
            <div class="actions">
                <button id="start-quiz-btn" class="btn btn-play">
                    <?php echo $completed ? '✅ REPETIR QUIZ' : '🧠 INICIAR QUIZ'; ?>
                </button>
                <!-- BOTÓN QUE VUELVE A LA POSICIÓN EXACTA EN DASHBOARD -->
                <?php
                // Determinar materia de retorno (preferir ?materia= si existe)
                $materia_return = isset($_GET['materia']) ? trim($_GET['materia']) : ($leccion['materia'] ?? '');
                ?>
                <a href="dashboard.php<?php echo $materia_return ? '?materia=' . urlencode($materia_return) : ''; ?>#leccion-<?php echo htmlspecialchars($slug); ?>" 
                   class="btn btn-small" id="back-to-dashboard-btn">
                   Volver al Dashboard
                </a>
                <button id="scrollToTopBtn" class="btn btn-small" title="Ir arriba">▲</button>
            </div>
        </aside>
    </div>

    <!-- Panel del Quiz (oculto por defecto) -->
    <section id="quiz-panel" class="quiz-panel hidden" aria-hidden="true">
        <header class="quiz-panel-header">
            <h3>🧠 Quiz: <?php echo htmlspecialchars($leccion['titulo']); ?></h3>
            <button id="close-quiz-btn" class="btn btn-small">✖ Cerrar</button>
        </header>
        <div id="quiz-panel-container" class="quiz-panel-container">
            <div class="loading-message">Cargando preguntas...</div>
        </div>
    </section>
</div>

<script>
// === JavaScript LIMPIO Y FUNCIONAL ===
document.addEventListener('DOMContentLoaded', function () {
    // Elementos
    const quizOverlay = document.getElementById('quiz-panel');
    const quizContainer = document.getElementById('quiz-panel-container');
    const tabContent = document.getElementById('tab-content');
    const tabQuiz = document.getElementById('tab-quiz');
    const contentToQuizBtn = document.getElementById('content-to-quiz-btn');
    const startQuizBtn = document.getElementById('start-quiz-btn');
    const closeQuizBtn = document.getElementById('close-quiz-btn');
    const backBtn = document.getElementById('back-to-dashboard-btn');
    const scrollBtn = document.getElementById('scrollToTopBtn');

    // Datos del quiz
    const quizData = <?php echo json_encode($quiz_selected); ?>;

    // === VOLVER AL DASHBOARD CON POSICIÓN EXACTA ===
    if (backBtn) {
        backBtn.addEventListener('click', function(e) {
            // Guardamos la posición actual de scroll de esta lección
            sessionStorage.setItem('scrollPos_leccion_' + '<?php echo addslashes($slug); ?>', window.pageYOffset);
        });
    }

    // Abrir quiz
    function openQuiz() {
        document.getElementById('content-view').classList.add('hidden');
        quizOverlay.classList.remove('hidden');
        tabQuiz.classList.add('active');
        tabContent.classList.remove('active');

        if (quizContainer.innerHTML.includes('Cargando')) {
            renderQuiz();
        }
    }

    // Cerrar quiz
    function closeQuiz() {
        quizOverlay.classList.add('hidden');
        document.getElementById('content-view').classList.remove('hidden');
        tabContent.classList.add('active');
        tabQuiz.classList.remove('active');
    }

    // Eventos
    tabQuiz.addEventListener('click', openQuiz);
    contentToQuizBtn.addEventListener('click', openQuiz);
    startQuizBtn.addEventListener('click', openQuiz);
    closeQuizBtn.addEventListener('click', closeQuiz);
    tabContent.addEventListener('click', closeQuiz);

    // Renderizar quiz
    function renderQuiz() {
        if (quizData.length === 0) {
            quizContainer.innerHTML = '<p class="text-center">No hay preguntas disponibles para este quiz.</p>';
            return;
        }

        let html = '<form id="quiz-form">';
        quizData.forEach((q, i) => {
            const id = `q${i}`;
            html += `
                <div class="quiz-question-card">
                    <p class="question-title"><strong>${i + 1}. ${q.pregunta}</strong></p>
                    <div class="options-group">`;

            const opciones = [...q.opciones].sort(() => Math.random() - 0.5);
            opciones.forEach(op => {
                const encoded = encodeURIComponent(op);
                html += `
                    <label class="quiz-option">
                        <input type="radio" name="${id}" value="${encoded}" required>
                        <span class="custom-radio"></span>
                        <span>${op}</span>
                    </label>`;
            });

            html += `</div></div>`;
        });

        html += `
            <div class="quiz-footer">
                <button type="submit" class="btn btn-submit-quiz full-width-btn">✅ ENVIAR Y CALIFICAR</button>
            </div>
        </form>`;

        quizContainer.innerHTML = html;

        // Submit (simulación - reemplaza con tu backend real)
        document.getElementById('quiz-form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('¡Quiz enviado! (Funcionalidad completa requiere backend)');
            closeQuiz();
        });

        if (window.MathJax && MathJax.typesetPromise) {
            MathJax.typesetPromise([quizContainer]);
        }
    }

    // Scroll to top
    window.addEventListener('scroll', () => {
        scrollBtn.style.display = window.pageYOffset > 300 ? 'block' : 'none';
    });
    scrollBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    // MathJax inicial
    if (window.MathJax && MathJax.typesetPromise) {
        MathJax.typesetPromise();
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Ajusta el selector al botón/ enlace de "Volver"
  const backBtn = document.querySelector('.btn-back-dashboard') || document.querySelector('#backBtn');
  const slug = '<?php echo addslashes($slug ?? ""); ?>'; // asegúrate de que $slug exista

  if (backBtn && slug) {
    backBtn.addEventListener('click', function () {
      // Guardamos solo la slug, no la coordenada absoluta
      sessionStorage.setItem('last_leccion_slug', slug);
      // Nota: no prevenimos la navegación; el link puede seguir funcionando como antes
    });
  }

  // --- Opcional: guardar posición por lección como fallback ---
  if (slug) {
    window.addEventListener('beforeunload', function () {
      sessionStorage.setItem('scrollPos_leccion_' + slug, window.pageYOffset || document.documentElement.scrollTop || 0);
    });
  }
});

document.addEventListener('DOMContentLoaded', function () {
  // Ajusta el selector al botón/ enlace de "Volver"
  const backBtn = document.querySelector('.btn-back-dashboard') || document.querySelector('#backBtn');
  const slug = '<?php echo addslashes($slug ?? ""); ?>'; // asegúrate de que $slug exista

  if (backBtn && slug) {
    backBtn.addEventListener('click', function () {
      // Guardamos solo la slug, no la coordenada absoluta
      sessionStorage.setItem('last_leccion_slug', slug);
      // Nota: no prevenimos la navegación; el link puede seguir funcionando como antes
    });
  }

  // --- Opcional: guardar posición por lección como fallback ---
  if (slug) {
    window.addEventListener('beforeunload', function () {
      sessionStorage.setItem('scrollPos_leccion_' + slug, window.pageYOffset || document.documentElement.scrollTop || 0);
    });
  }
});
</script>
</body>
</html>