<?php
// ==========================================
// LC-ADVANCE - leccion_detalle.php (LaTeX REAL con MathJax v5.0)
// ==========================================
// Autor: LC-TEAM
// ==========================================

session_start();
require_once 'config/config.php';
require_once 'src/content.php'; 

// Reemplaza redirección estricta por permitir invitado
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

// SIN CAMBIOS – MANTIENE TU FUNCIÓN ORIGINAL
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
    
    <!-- === MATHJAX REEMPLAZA A KATEX (LaTeX REAL) === -->
    <script>
      MathJax = {
        tex: {
          inlineMath: [['$', '$'], ['\\(', '\\)']],
          displayMath: [['$$', '$$'], ['\\[', '\\]']],
          processEscapes: true
        },
        startup: {
          ready: () => {
            MathJax.startup.defaultReady();
            MathJax.typesetPromise();
          }
        }
      };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3.2.2/es5/tex-mml-chtml.js" async></script>
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
        
        <h1 class="auth-title">MÓDULO DE APRENDIZAJE</h1>
        
        <div class="navigation-tabs">
            <button id="tab-content" class="tab-btn active">📚 CONTENIDO</button>
            <button id="tab-quiz" class="tab-btn quiz-tab-btn">
                <?php echo $completed ? '✅ REPETIR QUIZ' : '🧠 INICIAR QUIZ'; ?>
            </button>
        </div>

        <div id="content-view" class="view-panel active">
            <div class="content-header">
                <h2><?php echo htmlspecialchars($leccion['titulo']); ?></h2>
                <p class="materia-tag"><?php echo htmlspecialchars($leccion['materia']); ?></p>
                <p class="progress-info-local">Puntuación anterior: <span class="old-score"><?php echo $old_score; ?></span> / <?php echo $NUM_PREGUNTAS_QUIZ_FINAL; ?></p>
            </div>
            
            <div class="content-body">
                <?php echo render_contenido($leccion['contenido']); ?>
            </div>
            
            <div class="content-footer">
                <button id="content-to-quiz-btn" class="btn btn-play full-width-btn">IR AL QUIZ (Pruébate)</button>
            </div>
        </div>

        <div id="quiz-view" class="view-panel hidden">
            <div id="quiz-container">
                <h3 class="loading-message">Generando <?php echo $NUM_PREGUNTAS_QUIZ_FINAL; ?> preguntas...</h3>
                <div class="terminal-loader"></div>
            </div>
        </div>
        
    </div>
</div>

<button id="scrollToTopBtn" class="scroll-to-top-btn" title="Ir arriba">
    <span class="arrow-up">▲</span>
</button>
<script src="assets/js/app.js"></script> 
<script>
    // === VARIABLES DEL CLIENTE ===
    const quizData = <?php echo json_encode($quiz_selected ?? []); ?>;
    const leccionSlug = '<?php echo $slug; ?>';
    const numPreguntas = Array.isArray(quizData) ? quizData.length : 0;
    const isGuest = <?php echo json_encode(!empty($_SESSION['usuario_es_invitado'] ?? false)); ?>;

    // Debug mínimo en consola
    console.log('quizData', quizData);

    // PROTECCIÓN: si no hay preguntas mostrar aviso y evitar errores JS
    if (!Array.isArray(quizData) || quizData.length === 0) {
        const quizContainer = document.getElementById('quiz-container');
        if (quizContainer) {
            quizContainer.innerHTML = `
                <div class="result-box">
                    <h4 class="result-title">Quiz no disponible</h4>
                    <p>No hay preguntas definidas para esta lección. Revisa el contenido en <a href="src/content.php">src/content.php</a> o el slug de la lección.</p>
                    <div class="result-actions">
                        <a href="dashboard.php" class="btn btn-repeat">Volver al dashboard</a>
                    </div>
                </div>`;
        }
        const tabQuizBtn = document.getElementById('tab-quiz');
        if (tabQuizBtn) {
            tabQuizBtn.setAttribute('aria-disabled', 'true');
            tabQuizBtn.classList.add('disabled');
            tabQuizBtn.disabled = true;
        }
        // Evitar continuar con inicialización del quiz
    } else {
        const contentView = document.getElementById('content-view');
        const quizView = document.getElementById('quiz-view');
        const tabContent = document.getElementById('tab-content');
        const tabQuiz = document.getElementById('tab-quiz');
        const quizContainer = document.getElementById('quiz-container');
        const contentToQuizBtn = document.getElementById('content-to-quiz-btn');

        let isQuizSubmitted = false;
        // Normalizar estado inicial: asegurar que el contenido esté visible y el quiz oculto
        try {
            contentView.classList.remove('hidden');
            quizView.classList.add('hidden');
            tabContent.classList.add('active');
            tabQuiz.classList.remove('active');
        } catch (e) {
            console.warn('No se pudo normalizar el estado inicial de pestañas:', e);
        }
        
        function switchTab(view) {
            console.log('switchTab called with view=', view);
            // Normalizar clases: marcar active sólo en el tab seleccionado
            tabContent.classList.toggle('active', view === 'content');
            tabQuiz.classList.toggle('active', view === 'quiz');

            // Mostrar/ocultar vistas de forma determinista (evita tener 'active' + 'hidden')
            contentView.classList.toggle('hidden', view !== 'content');
            quizView.classList.toggle('hidden', view !== 'quiz');

            // Si volvemos al contenido, re-render MathJax de forma segura
            if (view === 'content') {
                setTimeout(() => {
                    if (window.MathJax && MathJax.typesetPromise) {
                        MathJax.typesetPromise([contentView]).catch(() => {});
                    }
                }, 100);
            }

            // Si vamos a quiz, renderizar sólo si no se envió
            if (view === 'quiz') {
                if (!isQuizSubmitted) {
                    renderQuiz();
                }
                // desplazar al top del quiz
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        tabContent.addEventListener('click', () => switchTab('content'));
        tabQuiz.addEventListener('click', () => switchTab('quiz'));
        contentToQuizBtn.addEventListener('click', () => switchTab('quiz'));

        function renderQuiz() {
            if (isQuizSubmitted) return; 

            let quizHTML = `<form id="quiz-form">`;
            
            quizData.forEach((pregunta, index) => {
                const preguntaId = `q${index}`;
                quizHTML += `
                    <div class="quiz-question-card" data-index="${index}">
                        <p class="question-title"><strong>${index + 1}. ${pregunta.pregunta}</strong></p>
                        <div class="options-group">
                `;
                const opcionesMezcladas = [...pregunta.opciones].sort(() => Math.random() - 0.5);

                opcionesMezcladas.forEach(opcion => {
                    const encodedOption = encodeURIComponent(opcion); 
                    quizHTML += `
                        <label class="quiz-option">
                            <input type="radio" 
                                name="${preguntaId}" 
                                value="${encodedOption}" 
                                required>
                            <span class="custom-radio"></span>
                            <span class="quiz-latex">${opcion}</span>
                        </label>
                    `;
                });
                
                quizHTML += `</div></div>`;
            });

            quizHTML += `
                <div class="quiz-footer">
                    <p class="text-center text-muted">Asegúrate de responder las ${numPreguntas} preguntas.</p>
                    <button type="submit" class="btn btn-submit-quiz full-width-btn">✅ ENVIAR Y CALIFICAR</button>
                </div>
            </form>`;
            
            quizContainer.innerHTML = quizHTML;
            // Renderizar MathJax en el quiz
            if (window.MathJax && MathJax.typesetPromise) {
                MathJax.typesetPromise([quizContainer]);
            }
            document.getElementById('quiz-form').addEventListener('submit', handleQuizSubmit);
        }
        
        function handleQuizSubmit(event) {
            event.preventDefault();
            let respuestasUsuario = {};
            let allAnswered = true;

            quizData.forEach((pregunta, index) => {
                const preguntaId = `q${index}`;
                const radioSeleccionado = document.querySelector(`input[name="${preguntaId}"]:checked`);
                if (!radioSeleccionado) {
                    allAnswered = false;
                    document.querySelector(`.quiz-question-card[data-index="${index}"]`).classList.add('not-answered');
                    return;
                }
                document.querySelector(`.quiz-question-card[data-index="${index}"]`).classList.remove('not-answered');
                respuestasUsuario[preguntaId] = decodeURIComponent(radioSeleccionado.value);
            });

            if (!allAnswered) {
                displayMessage('Responde todas las preguntas antes de enviar.', 'error');
                return;
            }

            // Si es invitado: califica localmente y muestra resultado (no intenta guardar)
            if (isGuest) {
                let correctas = 0;
                quizData.forEach((p, i) => {
                    const resp = respuestasUsuario[`q${i}`] || '';
                    if (resp === p.correcta) correctas++;
                });

                const quizView = document.getElementById('quiz-view');
                quizView.innerHTML = `
                    <div class="result-box">
                        <h4 class="result-title">Resultado (Modo Invitado)</h4>
                        <p class="final-message">Obtuviste <strong>${correctas}/${numPreguntas}</strong>. Tu resultado NO fue guardado (modo Invitado).</p>
                        <div class="result-actions">
                            <a href="dashboard.php" class="btn btn-repeat">Volver al Dashboard</a>
                            <button class="btn btn-play" onclick="location.reload()">Reintentar</button>
                        </div>
                    </div>
                `;
                return;
            }

            const bodyAnswers = Object.entries(respuestasUsuario)
                .map(([key, value]) => `${key}=${encodeURIComponent(value)}`)
                .join('&');
                
            isQuizSubmitted = true;
            
            fetch('src/funciones.php', { 
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `accion=calificar_quiz&slug=${leccionSlug}&${bodyAnswers}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.ok) {
                    const correctas = data.score;
                    const porcentaje = (correctas / numPreguntas) * 100;
                    const medalla = porcentaje >= 80 ? '🏆 MEDALLA DE ORO' : 
                                    porcentaje >= 60 ? '🥈 MEDALLA DE PLATA' : 
                                    '🥉 MEDALLA DE BRONCE';
                    
                    const xpGanado = data.xp_ganado;
                    
                    quizContainer.innerHTML = `
                        <div class="result-box">
                            <h4 class="result-title">RESULTADO: ACCESO CONCEDIDO</h4>
                            <div class="result-stats">
                                <p>Puntuación: <strong class="stat-score">${correctas}/${numPreguntas}</strong></p>
                                <p>Efectividad: <strong class="stat-percent">${porcentaje.toFixed(0)}%</strong></p>
                                <p class="result-medal ${porcentaje >= 80 ? 'gold' : porcentaje >= 60 ? 'silver' : 'bronze'}">${medalla}</p>
                            </div>
                            <div class="xp-gain">
                                GANANCIA: <span class="xp-amount">+${xpGanado} XP</span>
                            </div>
                            <p class="final-message">¡Tu progreso ha sido registrado en el servidor central!</p>
                            <div class="result-actions">
                                <a href="dashboard.php" class="btn btn-repeat">Volver al Dashboard</a>
                                <button class="btn btn-play" onclick="location.reload()">Reintentar</button>
                            </div>
                        </div>
                    `;

                    tabQuiz.textContent = `✅ REPETIR QUIZ (${correctas}/${numPreguntas})`;
                    if (oldScoreElement) oldScoreElement.textContent = correctas;
                    localStorage.setItem('needsUpdate', 'true');
                    // Renderizar MathJax en el resultado
                    if (window.MathJax && MathJax.typesetPromise) {
                        MathJax.typesetPromise([quizContainer]);
                    }
                } else {
                    displayMessage(`Error al guardar: ${data.mensaje || 'Error desconocido del servidor.'}`, 'error');
                    isQuizSubmitted = false; 
                }
            })
            .catch(error => {
                console.error('Error de red:', error);
                displayMessage('Error de conexión con el servidor de progreso.', 'error');
                isQuizSubmitted = false;
            });
        }

        function displayMessage(message, type) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `retro-message ${type}`;
            messageDiv.textContent = message;
            quizView.prepend(messageDiv);
            setTimeout(() => messageDiv.remove(), 5000);
        }

        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        window.onscroll = function() {
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        };
        scrollToTopBtn.onclick = function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };

        // === RE-RENDER MATHJAX AL CAMBIAR PESTAÑA (comprobación segura) ===
        document.addEventListener('DOMContentLoaded', () => {
            if (window.MathJax && MathJax.typesetPromise) {
                MathJax.typesetPromise().catch(() => {});
            } else {
                // Si MathJax no ha cargado aún, intentar de nuevo ligeramente más tarde
                setTimeout(() => {
                    if (window.MathJax && MathJax.typesetPromise) {
                        MathJax.typesetPromise().catch(() => {});
                    }
                }, 500);
            }
        });

        // Asegurar inicialización determinista de vistas
        // Símbolo: [`switchTab`](leccion_detalle.php)
        document.addEventListener('DOMContentLoaded', function() {
            // Forzar estado inicial: mostrar content, ocultar quiz
            try {
                // si switchTab está definida (se añadió la versión robusta), usarla
                if (typeof switchTab === 'function') {
                    switchTab('content');
                } else {
                    // fallback: ajustar clases manualmente
                    const contentView = document.getElementById('content-view');
                    const quizView = document.getElementById('quiz-view');
                    if (contentView) {
                        contentView.classList.add('active');
                        contentView.classList.remove('hidden');
                    }
                    if (quizView) {
                        quizView.classList.remove('active');
                        quizView.classList.add('hidden');
                    }
                }
            } catch (e) {
                console.error('Inicializando vistas:', e);
            }
        });
    }
</script>

</body>
</html>