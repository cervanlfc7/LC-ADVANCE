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
        /* Corporate-Grade Retro Modern Style */
        :root {
            --accent-glow: 0 0 30px rgba(0, 255, 255, 0.3);
            --card-bg: rgba(20, 20, 25, 0.7);
            --transition-smooth: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            --header-blur: blur(12px);
            --section-spacing: clamp(40px, 8vw, 100px);
        }

        .home {
            overflow-x: hidden;
            background-color: #050508;
            scroll-behavior: smooth;
        }

        /* Animated Grid Background */
        .grid-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
            z-index: -1;
            mask-image: radial-gradient(circle at center, black, transparent 80%);
            animation: gridMove 20s linear infinite;
        }

        @keyframes gridMove {
            from { background-position: 0 0; }
            to { background-position: 0 50px; }
        }

        .home .container {
            max-width: 1300px !important;
            width: 100% !important;
            padding: 0 20px !important;
            margin: 0 auto !important;
            box-sizing: border-box;
        }

        /* Refined Header */
        .header {
            background: rgba(0, 0, 0, 0.6) !important;
            backdrop-filter: var(--header-blur);
            -webkit-backdrop-filter: var(--header-blur);
            border-bottom: 1px solid rgba(255, 204, 0, 0.2) !important;
            transition: var(--transition-smooth);
        }

        /* Enhanced Hero Section */
        .hero {
            min-height: 95vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 100px 20px;
            background: none;
            position: relative;
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 150%;
            height: 150%;
            background: radial-gradient(circle at center, rgba(0, 255, 255, 0.08) 0%, transparent 50%);
            z-index: -1;
            animation: pulseHero 8s ease-in-out infinite;
        }

        @keyframes pulseHero {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.2); opacity: 1; }
        }

        .hero h2 {
            font-size: clamp(32px, 8vw, 72px);
            font-family: var(--font-pixel);
            background: linear-gradient(to bottom, #fff, var(--neon-cyan));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: none;
            margin-bottom: 30px;
            letter-spacing: -2px;
        }

        .hero p {
            font-size: clamp(18px, 2.5vw, 24px);
            font-family: var(--font-retro);
            max-width: 900px;
            color: var(--text-dim);
            margin-bottom: 50px;
            line-height: 1.4;
        }

        /* Stats Bar */
        .stats-bar {
            display: flex;
            justify-content: center;
            gap: clamp(20px, 5vw, 80px);
            margin-top: 60px;
            padding: 30px;
            background: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            backdrop-filter: var(--header-blur);
            animation: fadeInUp 1s ease-out 0.9s both;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .stat-value {
            font-family: var(--font-pixel);
            font-size: 24px;
            color: var(--neon-yellow);
        }

        .stat-label {
            font-family: var(--font-retro);
            font-size: 14px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Premium Feature Sections */
        .feature-section {
            padding: var(--section-spacing) 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .feature-text h3 {
            font-size: clamp(28px, 4vw, 42px);
            font-family: var(--font-pixel);
            color: #fff;
            margin-bottom: 25px;
            line-height: 1.1;
        }

        .feature-text p {
            font-size: 20px;
            font-family: var(--font-retro);
            color: var(--text-dim);
            margin-bottom: 30px;
        }

        .feature-asset {
            background: #000;
            border: 2px solid rgba(0, 255, 255, 0.4);
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.8), 0 0 15px rgba(0, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .feature-asset img {
            width: 100%;
            height: auto;
            max-height: 600px;
            object-fit: contain;
            image-rendering: pixelated;
            transition: var(--transition-smooth);
            display: block;
        }

        /* Prevent image glow that can cause artifacts on some gifs */
        .feature-asset img.glow-orange,
        .feature-asset img.glow-cyan {
            filter: none;
        }

        /* Add the glow to the container instead for better performance and look */
        .feature-section:nth-child(odd) .feature-asset {
            border-color: var(--neon-cyan);
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.15);
        }

        .feature-section:nth-child(even) .feature-asset {
            border-color: var(--neon-orange);
            box-shadow: 0 0 25px rgba(255, 152, 0, 0.15);
        }

        .feature-asset::after {
            content: "";
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(45deg, transparent, rgba(0, 255, 255, 0.05), transparent);
            transform: translateX(-100%);
            transition: 0.8s;
        }

        .feature-section:hover .feature-asset::after {
            transform: translateX(100%);
        }

        /* Corporate Footer */
        .corporate-footer {
            padding: 100px 20px 50px;
            background: #000;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            margin-top: var(--section-spacing);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr repeat(3, 1fr);
            gap: 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-brand h4 {
            font-family: var(--font-pixel);
            color: var(--neon-yellow);
            font-size: 20px;
            margin-bottom: 20px;
        }

        .footer-brand p {
            color: var(--text-muted);
            font-family: var(--font-retro);
            line-height: 1.6;
            max-width: 300px;
        }

        .footer-col h5 {
            font-family: var(--font-pixel);
            font-size: 14px;
            color: #fff;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        .footer-col ul {
            list-style: none;
            padding: 0;
        }

        .footer-col ul li {
            margin-bottom: 15px;
        }

        .footer-col ul li a {
            text-decoration: none;
            color: var(--text-dim);
            font-family: var(--font-retro);
            font-size: 16px;
            transition: 0.3s;
        }

        .footer-col ul li a:hover {
            color: var(--neon-cyan);
            padding-left: 5px;
        }

        .footer-bottom {
            margin-top: 80px;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            color: var(--text-muted);
            font-family: var(--font-retro);
            font-size: 14px;
        }

        /* Buttons Enhancement */
        .btn {
            padding: 18px 32px !important;
            font-family: var(--font-pixel) !important;
            font-size: 12px !important;
            border-radius: 12px !important;
            transition: var(--transition-smooth) !important;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-start {
            background: var(--neon-cyan) !important;
            color: #000 !important;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3) !important;
        }

        .btn-start:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 0 40px rgba(0, 255, 255, 0.6) !important;
        }

        .btn-guest {
            background: transparent !important;
            border: 2px solid rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
        }

        .btn-guest:hover {
            border-color: #fff !important;
            background: rgba(255, 255, 255, 0.05) !important;
        }

        @media (max-width: 992px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
            .feature-section {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }
            .feature-section:nth-child(even) {
                direction: ltr;
            }
            .stats-bar {
                flex-wrap: wrap;
                gap: 30px;
            }
        }

        @media (max-width: 600px) {
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body class="home">

<div class="grid-bg"></div>

<header class="header">
    <h1>🎮 LC-ADVANCE</h1>
    <button class="hamburger" type="button" aria-label="Menu">☰</button>
    <nav>
        <?php if ($usuario_logueado): ?>
            <button class="btn btn-dashboard" onclick="window.location='mapa/index.php'">Panel de Control</button>
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

    <!-- HERO SECTION -->
    <section class="hero">
        <?php if (!$usuario_logueado): ?>
            <h2>DOMINA EL CÓDIGO</h2>
            <p>La plataforma educativa que convierte el aprendizaje de programación en una aventura legendaria. Basado en estándares DGETI 2025.</p>
            <div class="hero-btns">
                <button class="btn btn-start" onclick="window.location='register.php'">Empezar Ahora</button>
                <button class="btn btn-guest" onclick="window.location='guest_login.php'">Acceso Invitado</button>
            </div>
        <?php else: ?>
            <h2>BIENVENIDO, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></h2>
            <p>Tu progreso está guardado y listo. Continúa dominando los lenguajes del futuro.</p>
            <div class="hero-btns">
                <button class="btn btn-start" onclick="window.location='mapa/index.php'">Ir al Dashboard</button>
            </div>
        <?php endif; ?>

        <div class="stats-bar">
            <div class="stat-item">
                <span class="stat-value">200+</span>
                <span class="stat-label">Lecciones</span>
            </div>
            <div class="stat-item">
                <span class="stat-value">15k+</span>
                <span class="stat-label">Preguntas</span>
            </div>
            <div class="stat-item">
                <span class="stat-value">24/7</span>
                <span class="stat-label">Acceso</span>
            </div>
            <div class="stat-item">
                <span class="stat-value">100%</span>
                <span class="stat-label">Gratis</span>
            </div>
        </div>
    </section>

    <!-- MAP SECTION -->
    <section class="feature-section">
        <div class="feature-text">
            <h3>Explora el Campus Virtual</h3>
            <p>Navega por un mundo pixelado donde cada edificio representa un área del conocimiento. Habla con maestros, interactúa con el entorno y desbloquea secretos.</p>
            <p>Un entorno inmersivo diseñado para que el aprendizaje se sienta como un RPG clásico.</p>
        </div>
        <div class="feature-asset">
            <img src="assets/img/map.gif" alt="Exploración en el mapa" class="glow-cyan">
        </div>
    </section>

    <!-- LESSONS SECTION -->
    <section class="feature-section">
        <div class="feature-text">
            <h3>Aprendizaje Adaptativo</h3>
            <p>Desde C# y Python hasta desarrollo web moderno con PHP y JavaScript. Nuestras lecciones se adaptan a tu ritmo, con retroalimentación en tiempo real.</p>
            <p>Contenido estructurado por semestres, facilitando el seguimiento del plan de estudios oficial.</p>
        </div>
        <div class="feature-asset">
            <img src="assets/img/lecciones.png" alt="Aprendizaje Adaptativo" class="glow-cyan">
        </div>
    </section>

    <!-- COMBAT SYSTEM SECTION -->
    <section class="feature-section">
        <div class="feature-text">
            <h3>Duelos de Conocimiento</h3>
            <p>Los exámenes ya no son aburridos. Enfrenta a los maestros en un sistema de combate por turnos donde tu arma es el código correcto.</p>
            <p>Gana experiencia, sube de nivel y colecciona medallas que demuestren tu valía ante la comunidad.</p>
        </div>
        <div class="feature-asset">
            <img src="assets/img/systemC.gif" alt="Maestro de Programación" class="glow-orange">
        </div>
    </section>
</main>

<footer class="corporate-footer">
    <div class="footer-grid">
        <div class="footer-brand">
            <h4>LC-ADVANCE</h4>
            <p>Transformando la educación tecnológica mediante la gamificación y el diseño retro-futurista.</p>
        </div>
        <div class="footer-col">
            <h5>Producto</h5>
            <ul>
                <?php if ($usuario_logueado): ?>
                    <li><a href="mapa/index.php">Mapa Interactivo</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="ranking.php">Ranking Global</a></li>
                <?php else: ?>
                    <li><a href="gatekeeper.php?redirect=mapa/index.php">Mapa Interactivo</a></li>
                    <li><a href="gatekeeper.php?redirect=dashboard.php">Dashboard</a></li>
                    <li><a href="gatekeeper.php?redirect=ranking.php">Ranking Global</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="footer-col">
            <h5>Recursos</h5>
            <ul>
                <li><a href="docs.php?file=README.md">Documentación</a></li>
                <li><a href="docs.php?file=DEVELOPMENT.md">Guía de Desarrollo</a></li>
                <li><a href="docs.php?file=API.md">API Reference</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h5>Comunidad</h5>
            <ul>
                <li><a href="https://github.com/cervanlfc7/LC-ADVANCE" target="_blank">GitHub</a></li>
                <li><a href="mailto:lcadvance40@gmail.com">Soporte</a></li>
                <li><a href="register.php">Registrarse</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2025-2026 LC-ADVANCE. Todos los derechos reservados.</p>
        <div class="footer-links">
            <span style="margin-left: 20px;">Hecho con 💚 para estudiantes de DGETI</span>
        </div>
    </div>
</footer>

<script>
    // Advanced Intersection Observer
    const observerOptions = {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px"
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.feature-section').forEach(section => {
        section.style.opacity = "0";
        section.style.transform = "translateY(50px)";
        section.style.transition = "var(--transition-smooth)";
        observer.observe(section);
    });

    // Header effect on scroll
    window.addEventListener('scroll', () => {
        const header = document.querySelector('.header');
        if (window.scrollY > 50) {
            header.style.padding = "10px 20px";
            header.style.background = "rgba(0, 0, 0, 0.8) !important";
        } else {
            header.style.padding = "15px 20px";
            header.style.background = "rgba(0, 0, 0, 0.6) !important";
        }
    });
</script>

</body>
</html>
</html>
