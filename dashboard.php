<?php
// ==========================================
// LC-ADVANCE - dashboard.php (VERSIÓN FINAL CON DISTINCIÓN MANUEL/MEZA)
// ==========================================

session_start();
require_once 'config/config.php';
require_once 'src/content.php';

// ------------------ AUTENTICACIÓN ------------------
if (!isset($_SESSION['usuario_id']) && empty($_SESSION['usuario_es_invitado'])) {
    header('Location: login.php');
    exit;
}

// ------------------ USUARIO ------------------
if (!empty($_SESSION['usuario_es_invitado'])) {
    $usuario = [
        'id' => 0,
        'nombre_usuario' => $_SESSION['usuario_nombre'] ?? 'Invitado',
        'puntos' => $_SESSION['usuario_puntos'] ?? 0,
        'nivel' => $_SESSION['usuario_nivel'] ?? 1,
        'avatar' => 'default.png'
    ];
} else {
    $stmt = $pdo->prepare("SELECT id, nombre_usuario, puntos, nivel FROM usuarios WHERE id = ?");
    $stmt->execute([(int)$_SESSION['usuario_id']]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        session_destroy();
        header('Location: login.php');
        exit;
    }
}

// ------------------ PROGRESO ------------------
$puntos_por_nivel = 500;
$puntos_necesarios = ($usuario['nivel'] + 1) * $puntos_por_nivel;
$puntos_base = $usuario['nivel'] * $puntos_por_nivel;
$progreso = max(0, min(100, (($usuario['puntos'] - $puntos_base) / $puntos_por_nivel) * 100));

// ------------------ BADGES ------------------
$badges = [];
if ($usuario['puntos'] >= 500) $badges[] = ['nombre'=>'Nivel 1: Novato','tipo'=>'bronze'];
if ($usuario['puntos'] >= 1000) $badges[] = ['nombre'=>'Nivel 2: Explorador','tipo'=>'silver'];
if ($usuario['puntos'] >= 2000) $badges[] = ['nombre'=>'Nivel 3: Élite','tipo'=>'gold'];

// ------------------ AGRUPAR LECCIONES ------------------
$lecciones_agrupadas = [];
$materias_disponibles = [];

foreach ($lecciones as $l) {
    $m = $l['materia'] ?? 'Sin Materia';
    $materias_disponibles[] = $m;
    $lecciones_agrupadas[$m][] = $l;
}

$materias_disponibles = array_unique($materias_disponibles);

// ------------------ FILTROS ------------------
$filter_materia   = isset($_GET['materia']) ? trim($_GET['materia']) : null;
$filter_profesor  = empty($filter_materia) && isset($_GET['profesor']) ? trim($_GET['profesor']) : null;
$filter_materias  = [];
$highlight_materia = null;

// ---- MAPEO PROFESOR -> MATERIAS ----
$profesor_materia_map = [
    'Miguel Marquez' => ['Temas Selectos de Matemáticas I y II'],
    'Enrique' => ['Inglés'],
    'Espindola' => ['Pensamiento Matemático III'],
    'Manuel' => ['Programación'],
    'Meza' => ['Programación'],
    'Herson' => ['Física','Química'],
    'Carolina' => ['Ecosistemas'],
    'Refugio & Padilla' => ['Ciencias Sociales'],
    'Armando' => ['Historia']
];

// ==================== MAPEO MATERIA → ID PROFESOR (por defecto) ====================
$materia_a_profesor_id = [
    'Temas Selectos de Matemáticas I y II' => '1Le',   // Miguel Márquez
    'Inglés'                                      => '1Go',   // Enrique
    'Pensamiento Matemático III'                  => '1Es',   // Espindola
    'Programación'                                => '1Ma',   // Manuel por defecto
    'Física'                                      => '1He',   // Herson
    'Química'                                     => '1He',   // Herson
    'Ecosistemas'                                 => '1Ca',   // Carolina
    'Ciencias Sociales'                           => '1Pa',   // Refugio & Padilla
    'Historia'                                    => '1Ar',   // Armando
];

// ==================== MAPEO DIRECTO PROFESOR → ID (prioridad máxima) ====================
$profesor_a_id = [
    'Miguel Marquez'    => '1Le',
    'Enrique'           => '1Go',
    'Espindola'         => '1Es',
    'Manuel'            => '1Ma',
    'Meza'              => '1Me',  // ¡Distinción clave!
    'Herson'            => '1He',
    'Carolina'          => '1Ca',
    'Refugio & Padilla' => '1Pa',
    'Armando'           => '1Ar'
];

function norm($s){
    return mb_strtolower(trim(strtr($s,[
        'á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n','&'=>'y'
    ])), 'UTF-8');
}

// ---- FILTRO DIRECTO POR MATERIA ----
if ($filter_materia) {
    $filter_materias[] = $filter_materia;
    $highlight_materia = $filter_materia;
}

// ---- FILTRO POR PROFESOR ----
elseif ($filter_profesor) {
    $nf = norm($filter_profesor);
    foreach ($profesor_materia_map as $prof => $mats) {
        $np = norm($prof);
        if ($np === $nf || strpos($np, $nf) !== false || strpos($nf, $np) !== false) {
            foreach ($mats as $mat) {
                foreach ($materias_disponibles as $real) {
                    if (norm($real) === norm($mat) || str_contains(norm($real), norm($mat))) {
                        $filter_materias[] = $real;
                    }
                }
            }
            break;
        }
    }
    $filter_materias = array_unique($filter_materias);
    $highlight_materia = $filter_materias[0] ?? null;
}

// ---- APLICAR FILTRO ----
if ($filter_materias) {
    $lecciones_agrupadas = array_filter(
        $lecciones_agrupadas,
        fn($k)=> in_array(norm($k), array_map('norm',$filter_materias)),
        ARRAY_FILTER_USE_KEY
    );
}

// ------------------ PROGRESO LECCIONES ------------------
$completadas = $_SESSION['completadas'] ?? [];

if (empty($_SESSION['usuario_es_invitado'])) {
    try {
        $stmt = $pdo->prepare("SELECT slug FROM user_progress WHERE user_id=? AND completed=1");
        $stmt->execute([$usuario['id']]);
        $completadas = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch(Exception $e){}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD | LC-ADVANCE</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>

<header class="header">
    <h1>LC-ADVANCE <span style="color: #00ff00;">// ACCESS: ONLINE</span></h1>
    <?php
        $ranking_href = 'ranking.php';
        if (!empty($filter_materia)) $ranking_href .= '?materia=' . urlencode($filter_materia);
    ?>
    <nav>
        <a href="index.php" class="btn btn-dashboard">🏠 Inicio</a>
        <a href="mapa/index.html" class="btn btn-dashboard">🎮 Ir al Mapa</a>
        <a href="<?php echo $ranking_href; ?>" class="btn btn-dashboard">🏆 Ranking</a>
        <a href="logout.php" class="btn btn-logout">🚪 SALIR</a>
    </nav>
</header>

<div class="container">
    <div class="dashboard-container">
    
        <h1 class="auth-title">💻 PANEL DE JUGADOR</h1>
        
        <div class="ranking-floating" id="ranking-floating">
            <h3>🔝 TOP 10</h3>
            <div class="ranking-scroll-area">
                <table class="ranking-table">
                    <thead>
                        <tr><th>#</th><th>JUGADOR</th><th>PUNTOS</th></tr>
                    </thead>
                    <tbody id="ranking-body"></tbody>
                </table>
            </div>
        </div>
        <div class="profile-summary"> 
            <h2 class="profile-name">¡Bienvenido, <span class="username-glow"><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></span>!</h2>
            
            <div class="stats-grid">
                <div class="stat-card level-card">
                    <h4>NIVEL ACTUAL</h4>
                    <span class="big-stat user-nivel" id="nivel-actual"><?php echo $usuario['nivel']; ?></span>
                </div>
                <div class="stat-card points-card">
                    <h4>PUNTOS (XP)</h4>
                    <span class="big-stat" id="puntos-actuales"><?php echo $usuario['puntos']; ?></span>
                </div>
            </div>

            <div class="progress-section">
                <h3>PROGRESO AL NIVEL <span id="nivel-siguiente"><?php echo $usuario['nivel'] + 1; ?></span></h3>
                <div class="progress-bar">
                    <div id="progress-fill" class="progress-fill" style="width: <?php echo $progreso; ?>%;"></div>
                </div>
                <p class="progress-info">
                    <span id="puntos-actuales-mini"><?php echo $usuario['puntos']; ?></span> / 
                    <span id="puntos-necesarios"><?php echo $puntos_necesarios; ?></span> PUNTOS REQUERIDOS
                </p>
                
                <div class="badges-section">
                    <h3>🏆 INSIGNIAS OBTENIDAS</h3>
                    <div id="badges-container" class="badges-list">
                        <?php if (empty($badges)): ?>
                            <p class="text-muted">¡Completa lecciones para obtener tu primer Badge (500 pts)!</p>
                        <?php else: ?>
                            <?php foreach ($badges as $b): ?>
                                <span class="badge <?php echo $b['tipo']; ?>"><?php echo $b['nombre']; ?></span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="lessons-area">
            <h3>📖 MÓDULOS DE ESTUDIO DISPONIBLES</h3>
            <?php if (empty($lecciones_agrupadas)): ?>
                <p class="text-muted">No hay lecciones disponibles.</p>
            <?php else: ?>
                <?php foreach ($lecciones_agrupadas as $materia => $temas): ?>
                    <div class="materia-group mb-4" id="materia-<?php echo urlencode($materia); ?>"> 
                        <h4 class="materia-title"><?php echo htmlspecialchars($materia); ?></h4>
                        <div class="leccion-list">
                            <?php foreach ($temas as $tema): 
                                $es_completada = in_array($tema['slug'], $completadas);
                                $leccion_href = 'leccion_detalle.php?slug=' . urlencode($tema['slug']);
                                if (!empty($filter_materia)) $leccion_href .= '&materia=' . urlencode($filter_materia);
                            ?>
                                <div class="leccion-item <?php echo $es_completada ? 'leccion-completed' : 'leccion-pending'; ?>">
                                    <span class="leccion-status">
                                        <?php echo $es_completada ? '✅' : '▶️'; ?> 
                                    </span>
                                    <span class="leccion-name">
                                        <?php echo htmlspecialchars($tema['titulo']); ?>
                                    </span>
                                    <a href="<?php echo $leccion_href; ?>" 
                                        class="btn btn-small <?php echo $es_completada ? 'btn-repeat' : 'btn-play'; ?>">
                                        <?php echo $es_completada ? 'REPETIR' : 'JUGAR'; ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<button id="scrollToTopBtn" class="scroll-to-top-btn" title="Ir arriba">
    <span class="arrow-up">▲</span>
</button>

<!-- ==================== BOTONES DE EXAMEN CON ID CORRECTO ==================== -->
<?php if ($filter_materia || !empty($filter_materias)): ?>
    <?php
    $id_profesor_final = '1Cu'; // fallback

    // Prioridad 1: Filtro por profesor directo
    if ($filter_profesor) {
        $nf = norm($filter_profesor);
        foreach ($profesor_a_id as $prof => $id) {
            if (norm($prof) === $nf || strpos(norm($prof), $nf) !== false || strpos($nf, norm($prof)) !== false) {
                $id_profesor_final = $id;
                break;
            }
        }
    }
    // Prioridad 2: Filtro por materia
    else {
        $materia_usada = $filter_materia ?: ($filter_materias[0] ?? '');
        $materia_norm = norm($materia_usada);
        foreach ($materia_a_profesor_id as $mat_map => $id) {
            if (norm($mat_map) === $materia_norm || str_contains($materia_norm, norm($mat_map))) {
                $id_profesor_final = $id;
                break;
            }
        }
    }
    ?>

    <div class="exam-cta" style="margin-top:18px; text-align:center;">
        <?php if ($filter_materia): ?>
            <a href="Examen/sistemC.php?personaje=<?= $id_profesor_final ?>&dialogo=1&pregunta=0" 
               class="btn btn-exam">
                📝 Ir al Examen de <?= htmlspecialchars($filter_materia) ?>
            </a>
        <?php endif; ?>

        <?php if (!empty($filter_materias) && empty($filter_materia)): ?>
            <?php foreach ($filter_materias as $fm): ?>
                <?php
                $materia_norm = norm($fm);
                $id_temp = '1Cu';
                foreach ($materia_a_profesor_id as $mat_map => $id) {
                    if (norm($mat_map) === $materia_norm || str_contains($materia_norm, norm($mat_map))) {
                        $id_temp = $id;
                        break;
                    }
                }
                ?>
                <a href="Examen/sistemC.php?personaje=<?= $id_temp ?>&dialogo=1&pregunta=0" 
                   class="btn btn-exam" style="margin:6px;">
                    📝 Examen: <?= htmlspecialchars($fm) ?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>

<script src="assets/js/app.js"></script>
<script>
    // ... (todo el JavaScript original que ya tenías, sin cambios) ...
    // (fetchAndUpdateDashboard, scrollToTop, highlight al volver, etc.)
    // Lo mantengo igual para no alargar el código, pero debes pegarlo tal como estaba.

    document.addEventListener('DOMContentLoaded', () => {
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
        fetchAndUpdateDashboard();
        if (localStorage.getItem('needsUpdate') === 'true') {
            fetchAndUpdateDashboard();
            localStorage.removeItem('needsUpdate');
        }

        <?php if (!empty($highlight_materia) || $filter_materia): ?>
            (function(){
                const name = <?php echo json_encode($filter_materia ?: $highlight_materia); ?>;
                const targetId = 'materia-' + encodeURIComponent(name);
                const target = document.getElementById(targetId);
                if (target) {
                    target.classList.add('materia-highlight');
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    setTimeout(() => target.classList.remove('materia-highlight'), 1800);
                }
            })();
        <?php endif; ?>
    });

    // Manejo de highlight al volver de lección (tu código original)
    document.addEventListener('DOMContentLoaded', function () {
      function handleLesson(slug) {
        if (!slug) return false;
        const id = 'leccion-' + slug;
        const el = document.getElementById(id);
        if (!el) return false;

        const saved = sessionStorage.getItem('scrollPos_leccion_' + slug);
        setTimeout(() => {
          if (saved !== null) {
            window.scrollTo({ top: parseInt(saved, 10), behavior: 'smooth' });
            sessionStorage.removeItem('scrollPos_leccion_' + slug);
          } else {
            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
          el.classList.add('highlight-return');
          setTimeout(() => el.classList.remove('highlight-return'), 3000);
        }, 200);

        sessionStorage.removeItem('last_leccion_slug');
        return true;
      }

      const hash = window.location.hash;
      if (hash && hash.startsWith('#leccion-')) {
        handleLesson(decodeURIComponent(hash.replace('#leccion-','')));
      } else {
        const last = sessionStorage.getItem('last_leccion_slug');
        if (last) handleLesson(last);
      }
    });
</script>

</body>
</html>