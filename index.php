<?php
// ==========================================
// LC-ADVANCE - index.php (Versión Mejorada 2025 v2.0)
// ==========================================
// Fecha: 07 Noviembre 2025
// ==========================================

require_once 'config/config.php';
// Asegurar que la sesión se inicie con las políticas definidas
iniciarSesionSegura();
require_once 'config/csrf.php';

// Verificar si el usuario está autenticado
$usuario_logueado = isset($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LC-ADVANCE</title>

    <!-- Fuente retro y Google Fonts para más variety -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Force dark theme for lesson pages early to avoid flash -->
    <script>(function(){try{const KEY='lc_advance_theme'; const saved=localStorage.getItem(KEY); if(!saved && (location.pathname.indexOf('leccion_detalle.php')!==-1 || location.search.indexOf('slug=')!==-1)){ document.documentElement.classList.add('dark'); try{localStorage.setItem(KEY,'dark')}catch(e){} } }catch(e){} })();</script>
    <!-- Icono favicon retro -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎮</text></svg>">

    <script src="assets/js/app.js" defer></script>
    <style>
        /* Ajustes para que el index ocupe todo el ancho en PC */
        .home .container {
            max-width: 100% !important;
            width: 100% !important;
            padding: 20px !important;
            margin: 0 !important;
            box-sizing: border-box;
        }

        .home .intro {
            max-width: 100% !important;
            width: 100% !important;
            margin: 40px 0 !important;
            box-sizing: border-box;
        }

        /* Asegurar que los párrafos no se estiren demasiado para legibilidad */
        .home .intro p {
            max-width: 1200px !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }
    </style>
</head>
<body class="home">

<header class="header">
    <h1>🎮 LC-ADVANCE</h1>
    <button class="hamburger" type="button" aria-label="Menu">☰</button>
    <nav>
        <?php if ($usuario_logueado): ?>
            <button class="btn btn-dashboard" onclick="window.location='mapa/index.html'">Panel de Control</button>
            <button class="btn btn-logout" onclick="window.location='logout.php'">Cerrar Sesión</button>
        <?php else: ?>
            <button class="btn btn-login" onclick="window.location='login.php'">Iniciar Sesión</button>
            <button class="btn btn-register" onclick="window.location='register.php'">Registrarse</button>
        <?php endif; ?>
    </nav>
</header>

<main class="container">
    <?php if (!empty($_GET['seleccionar_materia']) && (!empty($_GET['from']) && $_GET['from'] === 'dashboard')): 
        require_once 'src/content.php';
        $materias = [];
        foreach ($lecciones as $l) $materias[] = $l['materia'] ?? 'Sin Materia';
        $materias = array_values(array_unique($materias));
    ?>
    <!-- Modal select-materia -->
    <div id="selectMateriaModal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="selectMateriaTitle">
      <div class="modal-card">
        <button class="modal-close" aria-label="Cerrar">✖</button>
        <h2 id="selectMateriaTitle">📚 Elige una materia para continuar</h2>
        <p>Selecciona la materia que deseas estudiar hoy — esto configurará tu panel de estudio.</p>
        <div class="materias-grid">
          <?php foreach ($materias as $m): ?>
            <a class="btn btn-primary btn-small" href="dashboard.php?materia=<?php echo urlencode($m); ?>"><?php echo htmlspecialchars($m); ?></a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function(){
      const modal = document.getElementById('selectMateriaModal');
      if (!modal) return;
      // Auto-show the modal
      modal.style.display = 'flex';
      // Close handlers
      modal.querySelector('.modal-close').addEventListener('click', ()=> modal.style.display = 'none');
      modal.addEventListener('click', (e)=> { if (e.target === modal) modal.style.display = 'none';});
    });
    </script>
    <?php endif; ?>

    <?php if (!$usuario_logueado): ?>
        <section class="intro">
            <h2>💾 ¡Bienvenido al reto de Programación LC-ADVANCE!</h2>
            <p>Aprende programación de forma divertida con lecciones interactivas, cuestionarios y recompensas.</p>
            <p>Domina C#, Python, JavaScript, HTML/CSS y PHP en los 6 semestres del plan oficial DGETI.</p>
            <button class="btn btn-start" onclick="window.location='register.php'">¡Comienza a jugar!</button>
            <!-- NUEVO: acceso rápido como invitado (no guarda progreso) -->
            <button class="btn btn-guest" onclick="window.location='guest_login.php'">Entrar como invitado</button>
        </section>
    <?php else: ?>
        <section class="dashboard-preview">
            <h2>👋 ¡Hola, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>!</h2>
            <p>Tu progreso te espera. Continúa tu aventura.</p>
            <button class="btn btn-dashboard" onclick="window.location='mapa/index.html'">Ir al Panel</button>
        </section>
    <?php endif; ?>

    <section class="features">
        <h3>✨ Características</h3>
        <ul>
            <li>📘 Lecciones interactivas y ejemplos en código</li>
            <li>🧩 Quizzes dinámicos no repetitivos</li>
            <li>🏅 Badges y niveles</li>
            <li>👾 Avatares pixelados personalizables</li>
            <li>🏆 Leaderboard de los mejores programadores</li>
        </ul>
    </section>
</main>

<footer class="footer">
    <p>© 2025 LC-ADVANCE</p>
</footer>

</body>
</html>
