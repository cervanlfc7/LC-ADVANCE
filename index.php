<?php
// ==========================================
// LC-ADVANCE - index.php (Rediseño Premium 2025)
// ==========================================
// Diseño Responsivo con Animaciones del Dashboard
// ==========================================

require_once 'config/config.php';
iniciarSesionSegura();
require_once 'config/csrf.php';

$usuario_logueado = isset($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LC-ADVANCE | Plataforma Educativa Gamificada</title>
    
    <!-- Fuentes de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎮</text></svg>">
    
    <style>
        /* ════════════════════════════════════════════════
           VARIABLES (DASHBOARD THEME)
           ════════════════════════════════════════════════ */
        :root {
            --bg: #060a12;
            --surface: #0c1220;
            --surface2: #101828;
            --border: rgba(0, 230, 255, 0.12);
            --border2: rgba(0, 230, 255, 0.22);
            --cyan: #00e5ff;
            --cyan-dim: rgba(0, 229, 255, 0.12);
            --pink: #ff3cac;
            --green: #00ff87;
            --yellow: #ffd23f;
            --text: #e8f4ff;
            --muted: rgba(200, 230, 255, 0.5);
            --font-display: "Syne", sans-serif;
            --font-body: "Space Grotesk", sans-serif;
            --font-mono: "JetBrains Mono", monospace;
            --transition: all 0.22s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font-body);
            font-size: 14px;
            line-height: 1.6;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button {
            font-family: var(--font-body);
            cursor: pointer;
            border: none;
        }

        /* ════════════════════════════════════════════════
           ANIMATED BACKGROUND
           ════════════════════════════════════════════════ */
        .grid-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image:
                linear-gradient(rgba(0, 229, 255, 0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 229, 255, 0.018) 1px, transparent 1px);
            background-size: 48px 48px;
            animation: gridScroll 30s linear infinite;
        }

        @keyframes gridScroll {
            to { background-position: 0 48px; }
        }

        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(90px);
            pointer-events: none;
            z-index: 0;
        }

        .bg-orb-1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(0, 229, 255, 0.07), transparent 70%);
            top: -120px;
            right: -100px;
            animation: orbPulse 9s ease-in-out infinite;
        }

        .bg-orb-2 {
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(255, 60, 172, 0.055), transparent 70%);
            bottom: 0;
            left: -80px;
            animation: orbPulse 11s ease-in-out infinite reverse;
        }

        @keyframes orbPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.14); }
        }

        /* ════════════════════════════════════════════════
           HEADER
           ════════════════════════════════════════════════ */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 0 28px;
            min-height: 58px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(6, 10, 18, 0.88);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid var(--border);
            animation: fadeInDown 0.6s ease-out;
            gap: 12px;
            flex-wrap: wrap;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-text {
            font-family: var(--font-display);
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.5px;
            background: linear-gradient(90deg, var(--cyan), var(--pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: all 0.3s ease;
        }

        .logo-text:hover {
            letter-spacing: -0.3px;
        }

        .logo-tag {
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--green);
            opacity: 0.85;
            animation: floatUp 3s ease-in-out infinite;
            animation-delay: 0.1s;
        }

        nav {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            align-items: center;
            animation: fadeInRight 0.5s ease-out;
        }

        /* ════════════════════════════════════════════════
           BUTTONS
           ════════════════════════════════════════════════ */
        .btn {
            font-family: var(--font-mono);
            font-size: 10px;
            padding: 7px 16px;
            border-radius: 8px;
            border: 1px solid var(--border2);
            color: var(--muted);
            background: transparent;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.35s cubic-bezier(0.23, 1, 0.32, 1);
            display: inline-flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            animation: fadeInRight 0.5s ease-out backwards;
        }

        .btn:nth-child(1) { animation-delay: 0.15s; }
        .btn:nth-child(2) { animation-delay: 0.22s; }

        .btn::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            transform: translate(-50%, -50%);
            pointer-events: none;
            transition: all 0.4s ease;
        }

        .btn:active::before {
            width: 100px;
            height: 100px;
            opacity: 0;
        }

        .btn:hover {
            color: var(--cyan);
            border-color: rgba(0, 229, 255, 0.5);
            background: rgba(0, 229, 255, 0.08);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 229, 255, 0.15);
        }

        .btn-primary {
            border-color: var(--cyan);
            color: var(--bg);
            background: var(--cyan);
            font-weight: 700;
        }

        .btn-primary:hover {
            background: #33eeff;
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 10px 28px rgba(0, 229, 255, 0.35);
        }

        /* ════════════════════════════════════════════════
           CONTAINER
           ════════════════════════════════════════════════ */
        .container {
            position: relative;
            z-index: 1;
            width: min(100%, 1320px);
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ════════════════════════════════════════════════
           HERO SECTION
           ════════════════════════════════════════════════ */
        .hero {
            min-height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 60px 20px;
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        .hero h1 {
            font-family: var(--font-display);
            font-size: clamp(32px, 8vw, 72px);
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 20px;
            background: linear-gradient(90deg, var(--cyan), var(--pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.1;
        }

        .hero p {
            font-size: clamp(16px, 2vw, 20px);
            color: var(--muted);
            max-width: 800px;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 60px;
        }

        .btn-hero {
            padding: 12px 32px;
            font-size: 11px;
        }

        /* ════════════════════════════════════════════════
           STATS SECTION
           ════════════════════════════════════════════════ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 80px;
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            animation: scaleInCubic 0.4s ease-out backwards;
        }

        .stat-card:nth-child(1) { animation-delay: 0.05s; }
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.15s; }
        .stat-card:nth-child(4) { animation-delay: 0.2s; }

        .stat-card:hover {
            border-color: rgba(0, 229, 255, 0.35);
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 12px 32px rgba(0, 229, 255, 0.12);
        }

        .stat-value {
            font-family: var(--font-display);
            font-size: 32px;
            font-weight: 800;
            color: var(--cyan);
            margin-bottom: 8px;
        }

        .stat-label {
            font-family: var(--font-mono);
            font-size: 11px;
            text-transform: uppercase;
            color: var(--muted);
            letter-spacing: 1px;
        }

        /* ════════════════════════════════════════════════
           FEATURE SECTION
           ════════════════════════════════════════════════ */
        .feature-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            margin-bottom: 100px;
            animation: fadeInUp 0.6s ease-out backwards;
        }

        .feature-section:nth-child(even) {
            direction: rtl;
        }

        .feature-section:nth-child(even) > * {
            direction: ltr;
        }

        .feature-text h2 {
            font-family: var(--font-display);
            font-size: clamp(28px, 5vw, 48px);
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 24px;
            color: #fff;
            line-height: 1.2;
        }

        .feature-text p {
            font-size: 16px;
            color: var(--muted);
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .feature-visual {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-visual:hover {
            border-color: rgba(0, 229, 255, 0.35);
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(0, 229, 255, 0.12);
        }

        .feature-icon {
            font-size: 80px;
            margin-bottom: 16px;
            display: block;
        }

        /* ════════════════════════════════════════════════
           CARDS GRID
           ════════════════════════════════════════════════ */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 80px;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
            animation: fadeInUp 0.55s ease-out backwards;
        }

        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.18s; }
        .card:nth-child(3) { animation-delay: 0.26s; }

        .card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(0, 229, 255, 0.03), transparent 60%);
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .card:hover {
            border-color: rgba(0, 229, 255, 0.35);
            transform: translateY(-3px) scale(1.01);
            box-shadow: 0 12px 32px rgba(0, 229, 255, 0.12);
        }

        .card:hover::before {
            background: linear-gradient(135deg, rgba(0, 229, 255, 0.08), transparent 60%);
        }

        .card-icon {
            font-size: 40px;
            margin-bottom: 16px;
        }

        .card h3 {
            font-family: var(--font-display);
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #fff;
        }

        .card p {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.6;
        }

        /* ════════════════════════════════════════════════
           CTA SECTION
           ════════════════════════════════════════════════ */
        .cta-section {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 60px;
            text-align: center;
            margin-bottom: 80px;
            animation: fadeInUp 0.6s ease-out 0.3s both;
        }

        .cta-section h2 {
            font-family: var(--font-display);
            font-size: clamp(28px, 5vw, 48px);
            font-weight: 800;
            margin-bottom: 20px;
            background: linear-gradient(90deg, var(--cyan), var(--pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .cta-section p {
            font-size: 18px;
            color: var(--muted);
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ════════════════════════════════════════════════
           FOOTER
           ════════════════════════════════════════════════ */
        footer {
            background: rgba(0, 0, 0, 0.4);
            border-top: 1px solid var(--border);
            padding: 60px 0 30px;
            margin-top: 100px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr repeat(3, 1fr);
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-brand h3 {
            font-family: var(--font-display);
            font-size: 16px;
            color: var(--cyan);
            margin-bottom: 12px;
        }

        .footer-brand p {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
        }

        .footer-col h4 {
            font-family: var(--font-display);
            font-size: 12px;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 16px;
            letter-spacing: 1px;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            font-size: 13px;
            color: var(--muted);
            transition: all 0.3s ease;
        }

        .footer-col ul li a:hover {
            color: var(--cyan);
            padding-left: 5px;
        }

        .footer-bottom {
            border-top: 1px solid var(--border);
            padding-top: 30px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
        }

        /* ════════════════════════════════════════════════
           KEYFRAMES
           ════════════════════════════════════════════════ */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleInCubic {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes floatUp {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        /* ════════════════════════════════════════════════
           RESPONSIVE
           ════════════════════════════════════════════════ */
        @media (max-width: 768px) {
            header {
                padding: 10px 14px;
                justify-content: flex-start;
            }

            .logo {
                flex: 1;
            }

            .logo-text {
                font-size: 15px;
            }

            .logo-tag {
                font-size: 8px;
            }

            nav {
                width: 100%;
                gap: 6px;
                justify-content: flex-end;
            }

            .btn {
                font-size: 9px;
                padding: 6px 12px;
            }

            .feature-section,
            .feature-section:nth-child(even) {
                direction: ltr;
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .feature-section:nth-child(even) > * {
                direction: ltr;
            }

            .cta-section {
                padding: 40px 20px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        @media (max-width: 640px) {
            header {
                padding: 10px 12px;
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .logo {
                width: 100%;
                order: 1;
            }

            nav {
                width: 100%;
                order: 2;
                justify-content: space-between;
            }

            .btn {
                flex: 1;
                font-size: 7px;
                padding: 5px 8px;
                min-height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .hero {
                padding: 40px 14px;
            }

            .hero h1 {
                font-size: 28px;
            }

            .hero p {
                font-size: 14px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .stat-card {
                padding: 16px;
            }

            .stat-value {
                font-size: 24px;
            }

            .cards-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .cta-section {
                padding: 30px 16px;
            }

            .cta-section h2 {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .logo-text {
                font-size: 13px;
            }

            .logo-tag {
                font-size: 7px;
            }

            .hero h1 {
                font-size: 24px;
            }

            .stats-grid {
                gap: 10px;
            }

            .stat-card {
                padding: 12px;
            }

            .stat-value {
                font-size: 20px;
            }
        }

        .hamburger {
            display: none !important;
        }
    </style>
</head>
<body>


<!-- Animated Background -->
<div class="grid-bg"></div>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>

<!-- HEADER -->
<header>
    <div class="logo">
        <span class="logo-text">LC-ADVANCE</span>
        <span class="logo-tag">// HOME</span>
    </div>
    <nav>
        <?php if ($usuario_logueado): ?>
            <button class="btn btn-primary" onclick="window.location='dashboard.php'">Dashboard</button>
            <button class="btn" onclick="window.location='logout.php'">Cerrar Sesión</button>
        <?php else: ?>
            <button class="btn" onclick="window.location='login.php'">Iniciar Sesión</button>
            <button class="btn btn-primary" onclick="window.location='register.php'">Registrarse</button>
        <?php endif; ?>
    </nav>
</header>

<!-- MAIN -->
<main class="container">

    <!-- HERO SECTION -->
    <section class="hero">
        <h1><?php echo $usuario_logueado ? 'Bienvenido de vuelta' : 'Domina todas tus materias'; ?></h1>
        <p><?php echo $usuario_logueado 
            ? 'Tu progreso está guardado. Continúa tu aventura educativa.' 
            : 'La plataforma educativa gamificada que transforma el aprendizaje en una experiencia épica.'; 
        ?></p>
        <div class="hero-buttons">
            <?php if ($usuario_logueado): ?>
                <button class="btn btn-primary btn-hero" onclick="window.location='dashboard.php'">Ir al Dashboard</button>
            <?php else: ?>
                <button class="btn btn-primary btn-hero" onclick="window.location='register.php'">Comenzar Ahora</button>
                <button class="btn btn-hero" onclick="window.location='guest_login.php'">Acceso Invitado</button>
            <?php endif; ?>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-value">200+</div>
            <div class="stat-label">Lecciones</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">15k+</div>
            <div class="stat-label">Preguntas</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">24/7</div>
            <div class="stat-label">Acceso</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">100%</div>
            <div class="stat-label">Gratis</div>
        </div>
    </section>

    <!-- FEATURE 1: MAPA -->
    <section class="feature-section" style="animation-delay: 0.15s">
        <div class="feature-text">
            <h2>Explora el Campus Virtual</h2>
            <p>Navega por un mundo pixelado donde cada zona representa un área del conocimiento. Interactúa con maestros, descubre secretos y desbloquea contenido oculto.</p>
            <p>Un entorno inmersivo diseñado para que el aprendizaje se sienta como un RPG clásico.</p>
        </div>
        <div class="feature-visual">
            <span class="feature-icon">🗺️</span>
            <p style="color: var(--muted);">Exploración Interactiva</p>
        </div>
    </section>

    <!-- FEATURE 2: LECCIONES -->
    <section class="feature-section" style="animation-delay: 0.25s">
        <div class="feature-text">
            <h2>Aprendizaje Estructurado</h2>
            <p>Desde las materias más difíciles como química, matemáticas, hasta el dominio de la programación con lenguajes como Python y JavaScript. Lecciones adaptativas con retroalimentación en tiempo real y contenido estructurado por semestres.</p>
            <p>Sigue el plan de estudios oficial DGETI 2025 con herramientas modernas.</p>
        </div>
        <div class="feature-visual">
            <span class="feature-icon">📚</span>
            <p style="color: var(--muted);">Contenido Premium</p>
        </div>
    </section>

    <!-- FEATURE 3: COMBATE -->
    <section class="feature-section" style="animation-delay: 0.35s">
        <div class="feature-text">
            <h2>Duelos de Conocimiento</h2>
            <p>Los exámenes se transforman en épicos enfrentamientos. Enfrenta a los maestros en un sistema de combate por turnos donde tu arma es el código correcto.</p>
            <p>Gana experiencia, sube de nivel y colecciona insignias que demuestren tu valía.</p>
        </div>
        <div class="feature-visual">
            <span class="feature-icon">⚔️</span>
            <p style="color: var(--muted);">Gamificación Avanzada</p>
        </div>
    </section>

    <!-- FEATURES GRID -->
    <section class="cards-grid" style="margin-top: 100px;">
        <div class="card">
            <div class="card-icon">🏆</div>
            <h3>Sistema de Ranking</h3>
            <p>Compite globalmente con otros estudiantes. Sube en el ranking, gana insignias y demuestra tu dominio en cada materia.</p>
        </div>
        <div class="card">
            <div class="card-icon">⚡</div>
            <h3>Progreso Guardado</h3>
            <p>Tu avance se sincroniza automáticamente. Retoma desde donde dejaste en cualquier dispositivo, en cualquier momento.</p>
        </div>
        <div class="card">
            <div class="card-icon">🎯</div>
            <h3>Análisis Detallado</h3>
            <p>Dashboard interactivo con métricas de tu desempeño, áreas de mejora y estadísticas visuales en tiempo real.</p>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-section">
        <h2><?php echo $usuario_logueado ? '¡Sigue Aprendiendo!' : '¿Listo para comenzar?'; ?></h2>
        <p><?php echo $usuario_logueado 
            ? 'Tu jornada educativa te espera. Accede a todas las lecciones y domina las tecnologías del futuro.'
            : 'Únete a miles de estudiantes que ya están transformando su educación con LC-ADVANCE.'; 
        ?></p>
        <div class="hero-buttons">
            <?php if ($usuario_logueado): ?>
                <button class="btn btn-primary btn-hero" onclick="window.location='mapa/index.php'">Ir al Mapa</button>
            <?php else: ?>
                <button class="btn btn-primary btn-hero" onclick="window.location='register.php'">Registrarse Gratis</button>
            <?php endif; ?>
        </div>
    </section>

</main>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <h3>🎮 LC-ADVANCE</h3>
                <p>Transformando la educación tecnológica mediante gamificación y diseño moderno.</p>
            </div>
            <div class="footer-col">
                <h4>Producto</h4>
                <ul>
                    <li><a href="<?php echo $usuario_logueado ? 'mapa/index.php' : 'gatekeeper.php?redirect=mapa/index.php'; ?>">Mapa Interactivo</a></li>
                    <li><a href="<?php echo $usuario_logueado ? 'dashboard.php' : 'gatekeeper.php?redirect=dashboard.php'; ?>">Dashboard</a></li>
                    <li><a href="<?php echo $usuario_logueado ? 'ranking.php' : 'gatekeeper.php?redirect=ranking.php'; ?>">Ranking</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Recursos</h4>
                <ul>
                    <li><a href="docs.php?file=README.md">Documentación</a></li>
                    <li><a href="docs.php?file=DEVELOPMENT.md">Guía de Desarrollo</a></li>
                    <li><a href="docs.php?file=API.md">API Reference</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Comunidad</h4>
                <ul>
                    <li><a href="https://github.com" target="_blank">GitHub</a></li>
                    <li><a href="mailto:lcadvance40@gmail.com">Soporte</a></li>
                    <li><a href="register.php">Unirse</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025-2026 LC-ADVANCE. Todos los derechos reservados. | Hecho con 💚 para estudiantes DGETI.</p>
        </div>
    </div>
</footer>

<script>
// Smooth scroll behavior
document.querySelectorAll('a[href*="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#') {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
});

// Header sticky effect
window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {
        header.style.background = 'rgba(6, 10, 18, 0.95)';
    } else {
        header.style.background = 'rgba(6, 10, 18, 0.88)';
    }
});
</script>

</body>
</html>
