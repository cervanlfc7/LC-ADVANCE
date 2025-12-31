<?php
// ==========================================
// LC-ADVANCE - leccion_detalle.php (Versión Corregida y 100% Funcional 2025)
// Quiz en modal overlay separado del contenido principal
// Botones "Ir al Quiz" funcionan perfectamente sin bugs
// ==========================================

require_once 'config/config.php';
requireLogin(true); // permitir invitados
require_once 'src/content.php';


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
    // Redirigir al dashboard manteniendo la materia si existe
    if (!empty($_GET['materia'])) {
        header('Location: dashboard.php?materia=' . urlencode($_GET['materia']) . '&error=leccion_no_encontrada');
    } else {
        header('Location: dashboard.php?error=leccion_no_encontrada');
    }
    exit;
}

// Progreso del usuario
$stmt = $pdo->prepare("SELECT * FROM user_progress WHERE user_id = ? AND slug = ?");
$stmt->execute([$user_id, $slug]);
$progress = $stmt->fetch(PDO::FETCH_ASSOC);
$completed = $progress ? (bool)$progress['completed'] : false;
$old_score = $progress ? $progress['score'] : 0;

// Preparar quiz
$NUM_PREGUNTAS_QUIZ = 10;
$quiz_pool = $leccion['quiz'] ?? [];
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

$progress_percent = $NUM_PREGUNTAS_QUIZ_FINAL ? round(($old_score / $NUM_PREGUNTAS_QUIZ_FINAL) * 100) : 0;
// Construir parámetros de retorno preservando `profesor` si venía en la URL (prioritario), si no usar `materia`
$return_params = '';
if (!empty($_GET['profesor'])) {
    $return_params = '?profesor=' . urlencode($_GET['profesor']);
} elseif (isset($_GET['materia']) && $_GET['materia'] !== '') {
    $return_params = '?materia=' . urlencode($_GET['materia']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($leccion['titulo']); ?> | LC-ADVANCE</title>
    
    <!-- Fuentes cyberpunk -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- MathJax -->
    <script>
      MathJax = {
        tex: { inlineMath: [['$', '$'], ['\\(', '\\)']] },
        svg: { fontCache: 'global' }
      };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js" async></script>
    <!-- EN EL HEAD DEL HTML PRINCIPAL -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <!-- Css para el contenido -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="<?php echo ($slug === 'contaminacion-ambiental') ? 'page-lesson-contaminacion' : ''; ?>">

<div class="page-wrapper">

    <header class="main-header">
        <div class="header-title">
            <h1>LC-ADVANCE <span class="access">ACCESS: ONLINE</span></h1>
        </div>
        <nav class="header-nav">
            <a href="dashboard.php<?php echo $return_params; ?>" class="btn btn-nav">⬅️ Dashboard</a>
            <a href="ranking.php" class="btn btn-nav">🏆 Ranking</a>
            <a href="logout.php" class="btn btn-logout">🚪 Salir</a>
        </nav>
    </header>

    <main class="main-content">
        <div class="lesson-layout">

            <!-- Contenido principal (siempre visible) -->
            <section class="lesson-main">
                <h2 class="module-title">MÓDULO DE APRENDIZAJE</h2>

                <div class="tabs">
                    <button class="tab-btn active" data-tab="content">📚 Contenido</button>
                    <button class="tab-btn" data-tab="quiz">
                        <?php echo $completed ? '✅ Repetir Quiz' : '🧠 Iniciar Quiz'; ?>
                    </button>
                </div>

                <div id="content-panel" class="panel">
                    <div class="lesson-header">
                        <div class="lesson-title-row">
                            <?php echo $leccion['icon'] ?? '<span class="icon-tema">💾</span>'; ?>
                            <h3 class="lesson-title"><?php echo htmlspecialchars($leccion['titulo']); ?></h3>
                        </div>
                        <span class="lesson-materia"><?php echo htmlspecialchars($leccion['materia']); ?></span>
                        <p class="previous-score">
                            Puntuación anterior: <strong><?php echo $old_score; ?></strong> / <?php echo $NUM_PREGUNTAS_QUIZ_FINAL; ?>
                        </p>
                    </div>

                    <div class="lesson-content">
                        <?php echo $leccion['contenido']; ?>
                    </div>

                    <div class="lesson-actions">
                        <button class="btn btn-primary btn-small open-quiz-btn">🧠 Ir al Quiz</button>
                    </div>
                </div>
            </section>

            <!-- Sidebar -->
            <aside class="lesson-sidebar">
                <div class="sidebar-card">
                    <div class="info-item">
                        <span class="label">Materia</span>
                        <span class="value"><?php echo htmlspecialchars($leccion['materia']); ?></span>
                    </div>
                    <div class="info-item">
                        <span class="label">Puntuación</span>
                        <span class="value"><?php echo $old_score; ?> / <?php echo $NUM_PREGUNTAS_QUIZ_FINAL; ?></span>
                    </div>
                    <div class="info-item progress-item">
                        <span class="label">Progreso</span>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?php echo $progress_percent; ?>%;"></div>
                        </div>
                        <span class="percent"><?php echo $progress_percent; ?>%</span>
                    </div>

                    <div class="sidebar-actions">
                        <button class="btn btn-primary btn-small open-quiz-btn">
                            <?php echo $completed ? '✅ Repetir Quiz' : '🧠 Iniciar Quiz'; ?>
                        </button>
                        <a href="dashboard.php<?php echo $return_params; ?>#leccion-<?php echo htmlspecialchars($slug); ?>"
                           class="btn btn-secondary btn-small back-dashboard-btn">
                            ← Volver al Dashboard
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <!-- MODAL QUIZ (separado del contenido principal) -->
    <div id="quiz-overlay" class="overlay hidden">
        <div class="quiz-modal">
            <div class="quiz-header">
                <h3>🧠 Quiz: <?php echo htmlspecialchars($leccion['titulo']); ?></h3>
                <button class="close-btn" aria-label="Cerrar quiz">✖</button>
            </div>
            <div id="quiz-content" class="quiz-body">
                <div class="loading">Cargando preguntas...</div>
            </div>
        </div>
    </div>

    <button id="scroll-top" class="scroll-top-btn" aria-label="Subir">▲</button>
</div>

<script>
// JavaScript 100% funcional y sin bugs
document.addEventListener('DOMContentLoaded', () => {
    const quizOverlay = document.getElementById('quiz-overlay');
    const quizContent = document.getElementById('quiz-content');
    const openQuizBtns = document.querySelectorAll('.open-quiz-btn');
    const closeBtn = document.querySelector('.close-btn');
    const tabQuiz = document.querySelector('.tab-btn[data-tab="quiz"]');
    const tabContent = document.querySelector('.tab-btn[data-tab="content"]');
    const scrollTopBtn = document.getElementById('scroll-top');
    const backBtn = document.querySelector('.back-dashboard-btn');

    const quizData = <?php echo json_encode($quiz_selected); ?>;

    // Guardar posición y slug de la lección al volver al dashboard
    if (backBtn) {
        backBtn.addEventListener('click', () => {
            sessionStorage.setItem('scrollPos_leccion_' + '<?php echo addslashes($slug); ?>', window.scrollY);
            // Asegurar que el dashboard sepa cuál fue la última lección visitada
            sessionStorage.setItem('last_leccion_slug', '<?php echo addslashes($slug); ?>');
        });
    }

    // Scroll to top
    window.addEventListener('scroll', () => {
        scrollTopBtn.classList.toggle('visible', window.scrollY > 400);
    });
    scrollTopBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    // ABRIR QUIZ (todos los botones)
    openQuizBtns.forEach(btn => btn.addEventListener('click', openQuiz));
    if (tabQuiz) tabQuiz.addEventListener('click', openQuiz);

    function openQuiz() {
        quizOverlay.classList.remove('hidden');
        if (tabQuiz) tabQuiz.classList.add('active');
        tabContent.classList.remove('active');

        // Cargar quiz solo la primera vez. En caso de error, mostrar mensaje claro.
        try {
            if (quizContent.querySelector('.loading')) {
                renderQuiz();
            }
        } catch (err) {
            console.error('Error al renderizar quiz:', err);
            quizContent.innerHTML = `<div class="result-panel"><strong>Error:</strong> No se pudo cargar el quiz. Intenta recargar la página.</div>`;
        }
    }

    // CERRAR QUIZ
    if (closeBtn) closeBtn.addEventListener('click', closeQuiz);
    quizOverlay.addEventListener('click', (e) => {
        if (e.target === quizOverlay) closeQuiz();
    });

    function closeQuiz() {
        quizOverlay.classList.add('hidden');
        tabContent.classList.add('active');
        tabQuiz.classList.remove('active');
    }

    // RENDERIZAR QUIZ
    function renderQuiz() {
        if (quizData.length === 0) {
            quizContent.innerHTML = '<p class="no-questions">No hay preguntas disponibles para este módulo.</p>';
            return;
        }

        // helper para escapar HTML
        function escapeHtml(str) {
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }

        let html = '<form id="quiz-form" class="quiz-form">';
        quizData.forEach((q, i) => {
            const name = `q${i}`;
            const shuffled = [...q.opciones].sort(() => Math.random() - 0.5);

            html += `
                <div class="question-card">
                    <p class="question-text"><strong>${i + 1}.</strong> ${escapeHtml(q.pregunta)}</p>
                    <div class="options">`;

            shuffled.forEach((op, idx) => {
                // required en el primer input de cada grupo es suficiente
                const required = idx === 0 ? 'required' : '';
                html += `
                    <label class="option-label">
                        <input type="radio" name="${name}" value="${escapeHtml(op)}" ${required}>
                        <span class="radio-custom"></span>
                        <span class="option-text">${escapeHtml(op)}</span>
                    </label>`;
            });

            html += `</div></div>`;
        });

        html += `
            <div class="quiz-submit">
                <button type="submit" class="btn btn-submit">✅ Enviar y Calificar</button>
            </div>
        </form>`;

        quizContent.innerHTML = html;

        // Manejar envío y calificación usando el endpoint servidor
        document.getElementById('quiz-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const form = e.target;

            // obtener estado antes de enviar para detectar subida de nivel
            let oldState = { puntos: 0, nivel: 1 };
            try {
                const s = await fetch('src/funciones.php', { method: 'POST', body: new URLSearchParams({ accion: 'obtener_estado' }) });
                oldState = await s.json();
            } catch (ex) {
                console.warn('No se pudo obtener estado previo', ex);
            }

            const formData = new FormData(form);
            formData.append('accion', 'calificar_quiz');
            formData.append('slug', '<?php echo addslashes($slug); ?>');

            try {
                const resp = await fetch('src/funciones.php', { method: 'POST', body: formData });
                const data = await resp.json();

                if (!data.ok) {
                    // Ej.: modo invitado, o error
                    quizContent.innerHTML = `<div class="result-panel"><strong>Error:</strong> ${escapeHtml(data.mensaje || data.error || 'Error al calificar')}</div>`;
                    return;
                }

                const score = data.score || 0;
                const xp = data.xp_ganado || 0;

                // obtener estado actualizado
                const stateResp = await fetch('src/funciones.php', { method: 'POST', body: new URLSearchParams({ accion: 'obtener_estado' }) });
                const state = await stateResp.json();

                // mostrar detalle por pregunta
                let detailHtml = '<div class="result-panel">';
                detailHtml += `<h4>Resultado</h4><p>Puntos correctos: <strong>${score}</strong> / ${quizData.length}</p>`;
                detailHtml += `<p>XP ganado: <strong>${xp}</strong></p>`;
                detailHtml += `<p>Nuevo total de puntos: <strong>${state.puntos ?? '—'}</strong></p>`;
                detailHtml += `<p>Nivel actual: <strong>${state.nivel ?? '—'}</strong></p>`;

                if (Array.isArray(data.details)) {
                    detailHtml += '<hr style="margin:0.6rem 0">';
                    detailHtml += '<div class="details-list">';
                    data.details.forEach((d, idx) => {
                        const ok = d.acertada ? 'correct' : 'wrong';
                        detailHtml += `
                            <div class="detail-item ${ok}">
                                <div class="detail-q"><strong>${idx + 1}.</strong> ${escapeHtml(d.pregunta)}</div>
                                <div class="detail-a">Tu respuesta: <span class="user-answer">${escapeHtml(d.respuesta || '—')}</span></div>
                                ${d.acertada ? '<div class="detail-ok">✔ Correcto</div>' : `<div class="detail-wrong">✖ Incorrecto — Respuesta correcta: <strong>${escapeHtml(d.correcta)}</strong></div>`}
                            </div>`;
                    });
                    detailHtml += '</div>';
                }

                detailHtml += `<div style="margin-top:0.6rem"><button class="btn btn-primary" id="close-result">Cerrar</button></div>`;
                detailHtml += '</div>';

                quizContent.innerHTML = detailHtml;

                // animación de XP (fly up)
                if (xp > 0) {
                    const xpEl = document.createElement('div');
                    xpEl.className = 'xp-fly';
                    xpEl.textContent = `+${xp} XP`;
                    document.body.appendChild(xpEl);
                    // eliminar después de animación
                    setTimeout(() => xpEl.remove(), 2100);
                }

                // mostrar toast si subió de nivel
                if (state.nivel > (oldState.nivel || 1)) {
                    showToast(`¡Subiste al nivel ${state.nivel}! 🎉`);
                }

                // Actualizar la barra de progreso lateral si existe
                const fill = document.querySelector('.progress-fill');
                const percent = document.querySelector('.percent');
                if (fill) {
                    const pct = Math.round(state.progreso || ((state.puntos % 500) / 5));
                    fill.style.width = pct + '%';
                    if (percent) percent.textContent = pct + '%';
                }
                const closeBtnRes = document.getElementById('close-result');
                if (closeBtnRes) closeBtnRes.addEventListener('click', closeQuiz);

            } catch (err) {
                console.error(err);
                quizContent.innerHTML = `<div class="result-panel"><strong>Error:</strong> No se pudo conectar con el servidor.</div>`;
            }
        });

        // Helper: mostrar toast simple (si no existe el contenedor lo crea)
        function showToast(message, timeout = 3000) {
            let container = document.querySelector('.toast-container');
            if (!container) {
                container = document.createElement('div');
                container.className = 'toast-container';
                document.body.appendChild(container);
            }
            const t = document.createElement('div');
            t.className = 'toast';
            t.textContent = message;
            container.appendChild(t);
            setTimeout(() => {
                t.classList.add('hide');
                setTimeout(() => t.remove(), 420);
            }, timeout);
        }

        // Renderizar fórmulas MathJax
        if (window.MathJax && MathJax.typesetPromise) {
            MathJax.typesetPromise([quizContent]);
        }
    }

    // MathJax inicial para el contenido de la lección
    if (window.MathJax && MathJax.typesetPromise) {
        MathJax.typesetPromise();
    }
});
</script>

</body>
</html>