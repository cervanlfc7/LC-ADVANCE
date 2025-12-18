<?php
// ==========================================
// LC-ADVANCE - dashboard.php
// ==========================================
// Autor: LC-TEAM
// Fecha: 2025-11-07 (Final)
// Descripción: Panel de control principal del jugador con navegación mejorada
// ==========================================

session_start();
require_once 'config/config.php';
// Asegúrate de que 'src/content.php' exista y contenga el array $lecciones
require_once 'src/content.php'; 

// Reemplaza la restricción estricta por permitir modo invitado
if (!isset($_SESSION['usuario_id']) && empty($_SESSION['usuario_es_invitado'])) {
    header('Location: login.php');
    exit;
}

// Cargar usuario real o construir usuario invitado
if (!empty($_SESSION['usuario_es_invitado'])) {
    $usuario = [
        'id' => 0,
        'nombre_usuario' => $_SESSION['usuario_nombre'] ?? 'Invitado',
        'puntos' => $_SESSION['usuario_puntos'] ?? 0,
        'nivel' => $_SESSION['usuario_nivel'] ?? 1,
        'avatar' => 'default.png'
    ];
} else {
    $user_id = (int)$_SESSION['usuario_id'];
    $stmt = $pdo->prepare("SELECT id, nombre_usuario, puntos, nivel FROM usuarios WHERE id = ?");
    $stmt->execute([$user_id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        session_destroy();
        header('Location: login.php');
        exit;
    }
}

// === LÓGICA DE PROGRESO ===
$puntos_por_nivel = 500;
$puntos_necesarios = ($usuario['nivel'] + 1) * $puntos_por_nivel;
$puntos_nivel_actual_base = $usuario['nivel'] * $puntos_por_nivel;
$puntos_ganados_en_nivel = $usuario['puntos'] - $puntos_nivel_actual_base;
// El progreso es el porcentaje de avance hacia el siguiente nivel
$progreso = ($puntos_ganados_en_nivel / $puntos_por_nivel) * 100; 
// Asegura que el progreso no sea mayor a 100% si hay un error de cálculo
$progreso = min(100, $progreso);

// === LÓGICA DE BADGES ===
$badges = [];
if ($usuario['puntos'] >= 500) $badges[] = ['nombre' => 'Nivel 1: Novato', 'tipo' => 'bronze'];
if ($usuario['puntos'] >= 1000) $badges[] = ['nombre' => 'Nivel 2: Explorador', 'tipo' => 'silver'];
if ($usuario['puntos'] >= 2000) $badges[] = ['nombre' => 'Nivel 3: Élite', 'tipo' => 'gold'];

// === AGRUPACIÓN DE LECCIONES Y MENÚ RÁPIDO ===
$lecciones_agrupadas = [];
$materias_disponibles = [];
foreach ($lecciones as $leccion) {
    $materia = $leccion['materia'] ?? 'Sin Materia';
    if (!in_array($materia, $materias_disponibles)) {
        $materias_disponibles[] = $materia;
    }
    $lecciones_agrupadas[$materia][] = $leccion;
}

// === PROGRESO DEL JUGADOR (Lecciones Completadas) ===
$completadas = [];
// Identificador del usuario en sesión (0 = Invitado)
$user_id = (int)($usuario['id'] ?? 0);

if ($user_id > 0) {
    $stmt = $pdo->prepare("
        SELECT slug 
        FROM user_progress 
        WHERE user_id = ? AND completed = 1
    ");
    $stmt->execute([$user_id]);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $completadas[] = $row['slug'];
    }
} else {
    // Invitado: no hay progreso guardado
    $completadas = [];
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
    <nav>
        <a href="index.php" class="btn btn-dashboard">🏠 Inicio</a>
        <a href="ranking.php" class="btn btn-dashboard">🏆 Ranking</a>
        <a href="logout.php" class="btn btn-logout">🚪 SALIR</a>
    </nav>
</header>
<div class="container">
    <div class="dashboard-container">
    
        <h1 class="auth-title">💻 PANEL DE JUGADOR</h1>
        
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
            </div>
            
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
        <div class="lessons-area">
            <h3>📖 MÓDULOS DE ESTUDIO DISPONIBLES</h3>
            <?php foreach ($lecciones_agrupadas as $materia => $temas): ?>
                <div class="materia-group mb-4" id="materia-<?php echo urlencode($materia); ?>"> 
                    <h4 class="materia-title"><?php echo htmlspecialchars($materia); ?></h4>
                    <div class="leccion-list">
                        <?php foreach ($temas as $tema): 
                            $es_completada = in_array($tema['slug'], $completadas);
                        ?>
                            <div class="leccion-item <?php echo $es_completada ? 'leccion-completed' : 'leccion-pending'; ?>">
                                <span class="leccion-status">
                                    <?php echo $es_completada ? '✅' : '▶️'; ?> 
                                </span>
                                <span class="leccion-name">
                                    <?php echo htmlspecialchars($tema['titulo']); ?>
                                </span>
                                <a href="leccion_detalle.php?slug=<?php echo urlencode($tema['slug']); ?>" 
                                    class="btn btn-small <?php echo $es_completada ? 'btn-repeat' : 'btn-play'; ?>">
                                    <?php echo $es_completada ? 'REPETIR' : 'JUGAR'; ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="ranking-panel">
            <h3>🔝 TOP 10 JUGADORES</h3>
            <div class="ranking-scroll-area">
                <table class="ranking-table">
                    <thead>
                        <tr><th>#</th><th>JUGADOR</th><th>PUNTOS</th></tr>
                    </thead>
                    <tbody id="ranking-body">
                        </tbody>
                </table>
            </div>
        </div>
        </div>
</div>

<div class="materia-nav-quick fixed-quick-menu"> 
    <label for="materia-select">⚡ JUMP TO MODULE:</label>
    <select id="materia-select" class="retro-select">
        <option value="">-- SELECCIONA UN MÓDULO --</option>
        <?php foreach ($materias_disponibles as $materia): ?>
            <option value="<?php echo urlencode($materia); ?>"><?php echo htmlspecialchars($materia); ?></option>
        <?php endforeach; ?>
    </select>
</div>
<button id="scrollToTopBtn" class="scroll-to-top-btn" title="Ir arriba">
    <span class="arrow-up">▲</span>
</button>
<script src="assets/js/app.js"></script> 
<script>
    // Función de actualización de estado del usuario y ranking
    function fetchAndUpdateDashboard() {
        fetch('src/funciones.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'accion=obtener_estado'
        })
        .then(r => r.json())
        .then(data => {
            if (data.ok) {
                // Progreso
                document.getElementById('nivel-actual').textContent = data.nivel;
                document.getElementById('nivel-siguiente').textContent = data.nivel + 1;
                document.getElementById('puntos-actuales').textContent = data.puntos;
                document.getElementById('puntos-necesarios').textContent = (data.nivel + 1) * 500;
                document.getElementById('progress-fill').style.width = data.progreso + '%';
                
                const puntosMini = document.getElementById('puntos-actuales-mini');
                if (puntosMini) puntosMini.textContent = data.puntos; 

                // Badges
                const badgesDiv = document.getElementById('badges-container');
                badgesDiv.innerHTML = data.badges?.length 
                    ? data.badges.map(b => `<span class="badge ${b.tipo}">${b.nombre}</span>`).join('')
                    : '<p class="text-muted">¡Completa lecciones para obtener tu primer Badge (500 pts)!</p>';

                // Ranking
                const tbody = document.getElementById('ranking-body');
                tbody.innerHTML = data.ranking.map((u, i) => `
                    <tr class="${u.es_actual ? 'actual-user' : ''}">
                        <td>${i + 1}</td>
                        <td>${u.nombre_usuario}</td>
                        <td>${u.puntos}</td>
                    </tr>
                `).join('');
            }
        });
    }

    // Funcionalidad de Navegación (Scroll-to-Top y Jump Menu)
    document.addEventListener('DOMContentLoaded', () => {
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');
        const materiaSelect = document.getElementById('materia-select');
        
        // 1. Scroll-to-Top
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

        // 2. Jump Menu por Materia
        if (materiaSelect) {
            materiaSelect.addEventListener('change', function() {
                const selectedValue = this.value;
                if (selectedValue) {
                    const targetId = 'materia-' + selectedValue;
                    const targetElement = document.getElementById(targetId);
                    
                    if (targetElement) {
                        // Desplazamiento suave al elemento
                        targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });

                        // Resaltar la sección momentáneamente
                        targetElement.classList.add('materia-highlight');
                        setTimeout(() => {
                            targetElement.classList.remove('materia-highlight');
                        }, 1500);
                        
                        // Opcional: Resetear el select después del salto (para que el 'change' se active de nuevo)
                        // this.value = ''; 
                    }
                }
            });
        }
        
        // Ejecución al cargar
        fetchAndUpdateDashboard();

        // Si viene del quiz
        if (localStorage.getItem('needsUpdate') === 'true') {
            fetchAndUpdateDashboard();
            localStorage.removeItem('needsUpdate');
        }
    });

    // === RESTAURAR SCROLL Y RESALTAR LECCIÓN AL VOLVER ===
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