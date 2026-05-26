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

<<<<<<< Updated upstream
// Verificar si el usuario está autenticado
$usuario_logueado = isset($_SESSION['usuario_id']);
=======
// Base URL dinámica - detecta la ruta correcta
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$baseUrl = $scriptDir === '/' || $scriptDir === '\\' ? '' : $scriptDir;

$usuario_logueado = isset($_SESSION['usuario_id']);
$supported_langs = ['es', 'en'];
if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_langs, true)) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'es';
if (!in_array($lang, $supported_langs, true)) {
    $lang = 'es';
}
$t = [
    'es' => [
        'language' => 'Idioma',
        'theme' => 'Tema',
        'community' => 'Comunidad',
        'nav_dashboard' => 'Dashboard',
        'nav_logout' => 'Cerrar Sesión',
        'nav_login' => 'Iniciar Sesión',
        'nav_register' => 'Registrarse',
        'hero_title_logged' => 'Bienvenido de vuelta',
        'hero_title_guest' => 'Domina todas tus materias',
        'hero_sub_logged' => 'Tu progreso está guardado. Continúa tu aventura educativa.',
        'hero_sub_guest' => 'La plataforma educativa gamificada que transforma el aprendizaje en una experiencia épica.',
        'hero_go_dashboard' => 'Ir al Dashboard',
        'hero_start' => 'Comenzar Ahora',
        'hero_guest' => 'Acceso Invitado',
        'tour_title' => 'Tour interactivo rápido',
        'tour_sub' => 'Conoce en menos de 1 minuto las funciones clave de LC-ADVANCE.',
        'tour_btn' => 'Ver tour guiado',
        'feature_map_title' => 'Explora el Campus Virtual',
        'feature_map_p1' => 'Navega por un mundo pixelado donde cada zona representa un área del conocimiento. Interactúa con maestros, descubre secretos y desbloquea contenido oculto.',
        'feature_map_p2' => 'Un entorno inmersivo diseñado para que el aprendizaje se sienta como un RPG clásico.',
        'feature_map_badge' => 'Exploración Interactiva',
        'feature_learning_title' => 'Aprendizaje Estructurado',
        'feature_learning_p1' => 'Desde las materias más difíciles como química, matemáticas, hasta el dominio de la programación con lenguajes como Python y JavaScript. Lecciones adaptativas con retroalimentación en tiempo real y contenido estructurado por semestres.',
        'feature_learning_p2' => 'Sigue el plan de estudios oficial DGETI 2025 con herramientas modernas.',
        'feature_learning_badge' => 'Contenido Premium',
        'feature_duel_title' => 'Duelos de Conocimiento',
        'feature_duel_p1' => 'Los exámenes se transforman en épicos enfrentamientos. Enfrenta a los maestros en un sistema de combate por turnos donde tu arma es el código correcto.',
        'feature_duel_p2' => 'Gana experiencia, sube de nivel y colecciona insignias que demuestren tu valía.',
        'feature_duel_badge' => 'Gamificación Avanzada',
        'cta_logged' => '¡Sigue Aprendiendo!',
        'cta_guest' => '¿Listo para comenzar?',
        'cta_sub_logged' => 'Tu jornada educativa te espera. Accede a todas las lecciones y domina las tecnologías del futuro.',
        'cta_sub_guest' => 'Únete a miles de estudiantes que ya están transformando su educación con LC-ADVANCE.',
        'cta_map' => 'Ir al Mapa',
        'cta_register' => 'Registrarse Gratis',
        'footer_product' => 'Producto',
        'footer_resources' => 'Recursos',
        'footer_community' => 'Comunidad',
        'footer_map' => 'Mapa Interactivo',
        'tour_close' => 'Cerrar tour',
        'tour_modal_title' => 'Recorrido LC-ADVANCE',
        'tour_modal_sub' => 'Este flujo ayuda a nuevos usuarios a entender cómo avanzar rápido.',
        'tour_step_1' => '1) Entra al Mapa para elegir profesor o materia.',
        'tour_step_2' => '2) Abre el Dashboard y activa filtros por objetivo.',
        'tour_step_3' => '3) Completa una lección y ejecuta un duelo/examen.',
        'tour_step_4' => '4) Revisa tu posición en Ranking y repite.',
        'preview_map_desc' => 'Explora zonas, habla con profesores y entra a retos desde el campus virtual.',
        'preview_dashboard_desc' => 'Filtra materias, revisa tu progreso y ejecuta exámenes por enfoque.',
        'preview_duels_desc' => 'Convierte evaluaciones en combates de conocimiento con XP real.',
        'preview_ranking_desc' => 'Compite con otros estudiantes y sigue tu crecimiento semanal.',
        'cards_rank_title' => 'Sistema de Ranking',
        'cards_rank_desc' => 'Compite globalmente con otros estudiantes. Sube en el ranking, gana insignias y demuestra tu dominio en cada materia.',
        'cards_progress_title' => 'Progreso Guardado',
        'cards_progress_desc' => 'Tu avance se sincroniza automáticamente. Retoma desde donde dejaste en cualquier dispositivo, en cualquier momento.',
        'cards_analytics_title' => 'Análisis Detallado',
        'cards_analytics_desc' => 'Dashboard interactivo con métricas de tu desempeño, áreas de mejora y estadísticas visuales en tiempo real.',
        'paths_title' => 'Rutas destacadas',
        'paths_sub' => 'Elige un camino recomendado y avanza con metas claras.',
        'path_1_title' => 'Ruta Programación Fullstack',
        'path_1_desc' => 'Fundamentos, lógica, frontend y backend con retos progresivos.',
        'path_2_title' => 'Ruta Ciencias Aplicadas',
        'path_2_desc' => 'Física, química y matemáticas con simulaciones y práctica guiada.',
        'path_3_title' => 'Ruta Alto Rendimiento',
        'path_3_desc' => 'Entrenamiento intensivo con ranking competitivo y duelos semanales.',
        'daily_title' => 'Reto del día',
        'daily_sub' => 'Completa un mini objetivo para mantener tu racha activa.',
        'daily_goal' => 'Meta de hoy: resolver 3 lecciones y 1 duelo.',
        'daily_btn' => 'Comenzar reto',
        'testimonials_title' => 'Lo que dice la comunidad',
        'testimonials_sub' => 'Experiencias reales de estudiantes que ya usan LC-ADVANCE.',
        'testi_1' => '"Antes me costaba mantener ritmo. Con los duelos y retos diarios ahora estudio todos los días."',
        'testi_1_author' => 'Ana, 5to semestre',
        'testi_2' => '"El mapa y el dashboard hacen súper claro qué tema sigue y cómo voy comparado con el grupo."',
        'testi_2_author' => 'Carlos, área de programación',
        'testi_3' => '"Me gustó que todo se siente como juego pero sí aprendes. Subí mi promedio en matemáticas."',
        'testi_3_author' => 'Valeria, 4to semestre',
        'faq_title' => 'Preguntas frecuentes',
        'faq_sub' => 'Respuestas rápidas para empezar sin fricción.',
        'faq_1_q' => '¿Necesito pagar para usar la plataforma?',
        'faq_1_a' => 'No, el acceso base es gratuito. Puedes avanzar por materias, mapa y duelos sin costo.',
        'faq_2_q' => '¿Puedo usarla desde celular?',
        'faq_2_a' => 'Sí. La experiencia es responsive y el mapa incluye controles táctiles.',
        'faq_3_q' => '¿Cómo mejoro en el ranking?',
        'faq_3_a' => 'Completa lecciones, aprueba evaluaciones y mantén actividad diaria para subir más rápido.',
        'faq_4_q' => '¿Dónde veo mi progreso?',
        'faq_4_a' => 'En tu dashboard encuentras progreso por materia, reportes y rutas sugeridas.',
        'plans_title' => 'Planes y acceso',
        'plans_sub' => 'Empieza gratis hoy y escala tu experiencia cuando liberes nuevas funciones.',
        'plan_free' => 'Plan Gratis',
        'plan_free_desc' => 'Ideal para iniciar y dominar lo esencial.',
        'plan_plus' => 'Plan Plus (próximamente)',
        'plan_plus_desc' => 'Funciones avanzadas para rendimiento competitivo.',
        'plan_btn_free' => 'Empezar gratis',
        'plan_btn_plus' => 'Notificarme',
        'showcase_title' => 'Vista previa de la plataforma',
        'showcase_sub' => 'Así se ve la experiencia dentro de LC-ADVANCE.',
        'showcase_1_title' => 'Dashboard inteligente',
        'showcase_1_desc' => 'Seguimiento por materia, progreso y recomendaciones.',
        'showcase_2_title' => 'Mapa inmersivo',
        'showcase_2_desc' => 'Exploración, interacción con profesores y acceso directo a retos.',
        'showcase_3_title' => 'Duelos y ranking',
        'showcase_3_desc' => 'Combates de conocimiento y competitividad sana.',
        'mobile_cta' => 'Comenzar gratis',
        'coding_lab' => 'Laboratorio de código',
        'stat_lessons' => 'Lecciones',
        'stat_questions' => 'Preguntas',
        'stat_access' => 'Acceso',
        'stat_free' => 'Gratis',
        'select_materia_title' => 'Selecciona una materia',
        'select_materia_sub' => 'Elige el área que quieres estudiar para continuar.',
        'select_materia_btn' => 'Continuar',
    ],
    'en' => [
        'language' => 'Language',
        'theme' => 'Theme',
        'community' => 'Community',
        'nav_dashboard' => 'Dashboard',
        'nav_logout' => 'Log Out',
        'nav_login' => 'Log In',
        'nav_register' => 'Sign Up',
        'hero_title_logged' => 'Welcome back',
        'hero_title_guest' => 'Master all your subjects',
        'hero_sub_logged' => 'Your progress is saved. Continue your learning adventure.',
        'hero_sub_guest' => 'The gamified learning platform that turns studying into an epic experience.',
        'hero_go_dashboard' => 'Go to Dashboard',
        'hero_start' => 'Start Now',
        'hero_guest' => 'Guest Access',
        'tour_title' => 'Quick interactive tour',
        'tour_sub' => 'Learn the key LC-ADVANCE features in under one minute.',
        'tour_btn' => 'View guided tour',
        'feature_map_title' => 'Explore the Virtual Campus',
        'feature_map_p1' => 'Navigate a pixel world where each zone represents a knowledge area. Interact with teachers, discover secrets, and unlock hidden content.',
        'feature_map_p2' => 'An immersive environment designed to make learning feel like a classic RPG.',
        'feature_map_badge' => 'Interactive Exploration',
        'feature_learning_title' => 'Structured Learning',
        'feature_learning_p1' => 'From challenging subjects like chemistry and math to mastering programming with Python and JavaScript. Adaptive lessons with real-time feedback and semester-based structure.',
        'feature_learning_p2' => 'Follow the official DGETI 2025 curriculum with modern tools.',
        'feature_learning_badge' => 'Premium Content',
        'feature_duel_title' => 'Knowledge Duels',
        'feature_duel_p1' => 'Exams become epic battles. Face teachers in a turn-based combat system where your weapon is correct code.',
        'feature_duel_p2' => 'Gain experience, level up, and collect badges that prove your mastery.',
        'feature_duel_badge' => 'Advanced Gamification',
        'cta_logged' => 'Keep Learning!',
        'cta_guest' => 'Ready to begin?',
        'cta_sub_logged' => 'Your learning journey is waiting. Access all lessons and master future technologies.',
        'cta_sub_guest' => 'Join thousands of students already transforming their education with LC-ADVANCE.',
        'cta_map' => 'Go to Map',
        'cta_register' => 'Register Free',
        'footer_product' => 'Product',
        'footer_resources' => 'Resources',
        'footer_community' => 'Community',
        'footer_map' => 'Interactive Map',
        'tour_close' => 'Close tour',
        'tour_modal_title' => 'LC-ADVANCE Walkthrough',
        'tour_modal_sub' => 'This flow helps new users understand how to progress quickly.',
        'tour_step_1' => '1) Enter the Map to choose a teacher or subject.',
        'tour_step_2' => '2) Open the Dashboard and apply goal-based filters.',
        'tour_step_3' => '3) Complete a lesson and start a duel/exam.',
        'tour_step_4' => '4) Check your Ranking position and repeat.',
        'preview_map_desc' => 'Explore zones, talk to teachers, and launch challenges from the virtual campus.',
        'preview_dashboard_desc' => 'Filter subjects, review progress, and run focused exams.',
        'preview_duels_desc' => 'Turn assessments into knowledge duels with real XP.',
        'preview_ranking_desc' => 'Compete with other students and track your weekly growth.',
        'cards_rank_title' => 'Ranking System',
        'cards_rank_desc' => 'Compete globally with other students. Climb the ranking, earn badges, and prove your mastery in every subject.',
        'cards_progress_title' => 'Saved Progress',
        'cards_progress_desc' => 'Your progress syncs automatically. Resume from where you left off on any device, anytime.',
        'cards_analytics_title' => 'Detailed Analytics',
        'cards_analytics_desc' => 'Interactive dashboard with performance metrics, improvement areas, and real-time visual stats.',
        'paths_title' => 'Featured paths',
        'paths_sub' => 'Choose a recommended path and progress with clear milestones.',
        'path_1_title' => 'Fullstack Programming Path',
        'path_1_desc' => 'Foundations, logic, frontend, and backend with progressive challenges.',
        'path_2_title' => 'Applied Sciences Path',
        'path_2_desc' => 'Physics, chemistry, and math with simulations and guided practice.',
        'path_3_title' => 'High Performance Path',
        'path_3_desc' => 'Intensive training with competitive ranking and weekly duels.',
        'daily_title' => 'Daily challenge',
        'daily_sub' => 'Complete a mini goal to keep your streak active.',
        'daily_goal' => "Today's goal: solve 3 lessons and 1 duel.",
        'daily_btn' => 'Start challenge',
        'testimonials_title' => 'What the community says',
        'testimonials_sub' => 'Real experiences from students already using LC-ADVANCE.',
        'testi_1' => '"I used to struggle with consistency. With daily challenges and duels, now I study every day."',
        'testi_1_author' => 'Ana, 5th semester',
        'testi_2' => '"The map and dashboard make it super clear what topic comes next and how I compare to my class."',
        'testi_2_author' => 'Carlos, programming track',
        'testi_3' => '"I like that it feels like a game but you actually learn. My math grades improved."',
        'testi_3_author' => 'Valeria, 4th semester',
        'faq_title' => 'Frequently asked questions',
        'faq_sub' => 'Quick answers to get started without friction.',
        'faq_1_q' => 'Do I need to pay to use the platform?',
        'faq_1_a' => 'No, core access is free. You can progress through subjects, map, and duels at no cost.',
        'faq_2_q' => 'Can I use it from mobile?',
        'faq_2_a' => 'Yes. The experience is responsive and the map includes touch controls.',
        'faq_3_q' => 'How do I improve my ranking?',
        'faq_3_a' => 'Complete lessons, pass assessments, and stay active daily to climb faster.',
        'faq_4_q' => 'Where can I see my progress?',
        'faq_4_a' => 'In your dashboard you can see progress by subject, reports, and suggested paths.',
        'plans_title' => 'Plans and access',
        'plans_sub' => 'Start free today and scale your experience as new features unlock.',
        'plan_free' => 'Free Plan',
        'plan_free_desc' => 'Ideal to begin and master core fundamentals.',
        'plan_plus' => 'Plus Plan (coming soon)',
        'plan_plus_desc' => 'Advanced features for competitive performance.',
        'plan_btn_free' => 'Start free',
        'plan_btn_plus' => 'Notify me',
        'showcase_title' => 'Platform preview',
        'showcase_sub' => 'This is how the LC-ADVANCE experience looks inside.',
        'showcase_1_title' => 'Smart dashboard',
        'showcase_1_desc' => 'Subject tracking, progress analytics, and recommendations.',
        'showcase_2_title' => 'Immersive map',
        'showcase_2_desc' => 'Exploration, teacher interaction, and direct challenge access.',
        'showcase_3_title' => 'Duels and ranking',
        'showcase_3_desc' => 'Knowledge battles and healthy competitiveness.',
        'mobile_cta' => 'Start free',
        'coding_lab' => 'Coding lab',
        'stat_lessons' => 'Lessons',
        'stat_questions' => 'Questions',
        'stat_access' => 'Access',
        'stat_free' => 'Free',
        'select_materia_title' => 'Select a subject',
        'select_materia_sub' => 'Choose the area you want to study to continue.',
        'select_materia_btn' => 'Continue',
    ],
];
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
            <button class="btn btn-dashboard" onclick="window.location='mapa/index.php'">Panel de Control</button>
            <button class="btn btn-logout" onclick="window.location='logout.php'">Cerrar Sesión</button>
        <?php else: ?>
            <button class="btn btn-login" onclick="window.location='login.php'">Iniciar Sesión</button>
            <button class="btn btn-register" onclick="window.location='register.php'">Registrarse</button>
=======
            <button class="btn btn-primary" onclick="window.location.href='<?= $baseUrl ?>/public/dashboard.php'"><?= htmlspecialchars($t[$lang]['nav_dashboard']) ?></button>
            <button class="btn" onclick="window.location='public/coding_challenges.php'"><?= htmlspecialchars($t[$lang]['coding_lab']) ?></button>
            <button class="btn" onclick="window.location='public/logout.php'"><?= htmlspecialchars($t[$lang]['nav_logout']) ?></button>
        <?php else: ?>
            <button class="btn" onclick="window.location.href='<?= $baseUrl ?>/public/login.php'"><?= htmlspecialchars($t[$lang]['nav_login']) ?></button>
            <button class="btn btn-primary" onclick="window.location.href='<?= $baseUrl ?>/public/register.php'"><?= htmlspecialchars($t[$lang]['nav_register']) ?></button>
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
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
=======
        <h1><?php echo $usuario_logueado ? htmlspecialchars($t[$lang]['hero_title_logged']) : htmlspecialchars($t[$lang]['hero_title_guest']); ?></h1>
        <p><?php echo $usuario_logueado 
            ? htmlspecialchars($t[$lang]['hero_sub_logged'])
            : htmlspecialchars($t[$lang]['hero_sub_guest']); 
        ?></p>
        <div class="hero-buttons">
            <?php if ($usuario_logueado): ?>
                <button class="btn btn-primary btn-hero" onclick="window.location.href='<?= $baseUrl ?>/public/mapa/index.php'"><?= htmlspecialchars($t[$lang]['cta_map']) ?></button>
            <?php else: ?>
                <button class="btn btn-primary btn-hero" onclick="window.location.href='<?= $baseUrl ?>/public/register.php'"><?= htmlspecialchars($t[$lang]['hero_start']) ?></button>
                <button class="btn btn-hero" onclick="window.location='public/guest_login.php'"><?= htmlspecialchars($t[$lang]['hero_guest']) ?></button>
            <?php endif; ?>
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
</main>

<footer class="corporate-footer">
    <div class="footer-grid">
        <div class="footer-brand">
            <h4>LC-ADVANCE</h4>
            <p>Transformando la educación tecnológica mediante la gamificación y el diseño retro-futurista.</p>
=======

    <!-- FEATURES GRID -->
    <section class="cards-grid" style="margin-top: 100px;">
        <div class="card">
            <div class="card-icon">🏆</div>
            <h3><?= htmlspecialchars($t[$lang]['cards_rank_title']) ?></h3>
            <p><?= htmlspecialchars($t[$lang]['cards_rank_desc']) ?></p>
        </div>
        <div class="card">
            <div class="card-icon">⚡</div>
            <h3><?= htmlspecialchars($t[$lang]['cards_progress_title']) ?></h3>
            <p><?= htmlspecialchars($t[$lang]['cards_progress_desc']) ?></p>
        </div>
        <div class="card">
            <div class="card-icon">🎯</div>
            <h3><?= htmlspecialchars($t[$lang]['cards_analytics_title']) ?></h3>
            <p><?= htmlspecialchars($t[$lang]['cards_analytics_desc']) ?></p>
        </div>
    </section>

    <section class="landing-section">
        <h3><?= htmlspecialchars($t[$lang]['paths_title']) ?></h3>
        <p><?= htmlspecialchars($t[$lang]['paths_sub']) ?></p>
        <div class="path-grid">
            <article class="path-card">
                <h4><?= htmlspecialchars($t[$lang]['path_1_title']) ?></h4>
                <p><?= htmlspecialchars($t[$lang]['path_1_desc']) ?></p>
            </article>
            <article class="path-card">
                <h4><?= htmlspecialchars($t[$lang]['path_2_title']) ?></h4>
                <p><?= htmlspecialchars($t[$lang]['path_2_desc']) ?></p>
            </article>
            <article class="path-card">
                <h4><?= htmlspecialchars($t[$lang]['path_3_title']) ?></h4>
                <p><?= htmlspecialchars($t[$lang]['path_3_desc']) ?></p>
            </article>
        </div>
    </section>

    <section class="landing-section">
        <h3><?= htmlspecialchars($t[$lang]['daily_title']) ?></h3>
        <p><?= htmlspecialchars($t[$lang]['daily_sub']) ?></p>
        <div class="daily-card">
            <div>
                <strong style="display:block;margin-bottom:6px;"><?= htmlspecialchars($t[$lang]['daily_goal']) ?></strong>
                <span class="countdown" id="dailyCountdown">23:59:59</span>
            </div>
            <button class="btn btn-primary" onclick="window.location.href='<?= $usuario_logueado ? $baseUrl.'/public/mapa/index.php' : $baseUrl.'/public/register.php' ?>'"><?= htmlspecialchars($t[$lang]['daily_btn']) ?></button>
        </div>
    </section>

    <section class="landing-section">
        <h3><?= htmlspecialchars($t[$lang]['testimonials_title']) ?></h3>
        <p><?= htmlspecialchars($t[$lang]['testimonials_sub']) ?></p>
        <div class="testimonial-grid">
            <article class="testimonial-card">
                <p><?= htmlspecialchars($t[$lang]['testi_1']) ?></p>
                <span>— <?= htmlspecialchars($t[$lang]['testi_1_author']) ?></span>
            </article>
            <article class="testimonial-card">
                <p><?= htmlspecialchars($t[$lang]['testi_2']) ?></p>
                <span>— <?= htmlspecialchars($t[$lang]['testi_2_author']) ?></span>
            </article>
            <article class="testimonial-card">
                <p><?= htmlspecialchars($t[$lang]['testi_3']) ?></p>
                <span>— <?= htmlspecialchars($t[$lang]['testi_3_author']) ?></span>
            </article>
        </div>
    </section>

    <section class="landing-section">
        <h3><?= htmlspecialchars($t[$lang]['faq_title']) ?></h3>
        <p><?= htmlspecialchars($t[$lang]['faq_sub']) ?></p>
        <div class="faq-grid">
            <div class="faq-item">
                <button class="faq-question"><?= htmlspecialchars($t[$lang]['faq_1_q']) ?></button>
                <div class="faq-answer"><?= htmlspecialchars($t[$lang]['faq_1_a']) ?></div>
            </div>
            <div class="faq-item">
                <button class="faq-question"><?= htmlspecialchars($t[$lang]['faq_2_q']) ?></button>
                <div class="faq-answer"><?= htmlspecialchars($t[$lang]['faq_2_a']) ?></div>
            </div>
            <div class="faq-item">
                <button class="faq-question"><?= htmlspecialchars($t[$lang]['faq_3_q']) ?></button>
                <div class="faq-answer"><?= htmlspecialchars($t[$lang]['faq_3_a']) ?></div>
            </div>
            <div class="faq-item">
                <button class="faq-question"><?= htmlspecialchars($t[$lang]['faq_4_q']) ?></button>
                <div class="faq-answer"><?= htmlspecialchars($t[$lang]['faq_4_a']) ?></div>
            </div>
        </div>
    </section>

    <section class="landing-section">
        <h3><?= htmlspecialchars($t[$lang]['plans_title']) ?></h3>
        <p><?= htmlspecialchars($t[$lang]['plans_sub']) ?></p>
        <div class="plans-grid">
            <article class="plan-card">
                <h4><?= htmlspecialchars($t[$lang]['plan_free']) ?></h4>
                <p><?= htmlspecialchars($t[$lang]['plan_free_desc']) ?></p>
                <div class="plan-badges">
                    <span class="plan-badge">Mapa</span>
                    <span class="plan-badge">Dashboard</span>
                    <span class="plan-badge">Ranking</span>
                </div>
                <button class="btn btn-primary" onclick="window.location.href='<?= $baseUrl ?>/public/register.php'"><?= htmlspecialchars($t[$lang]['plan_btn_free']) ?></button>
            </article>
            <article class="plan-card">
                <h4><?= htmlspecialchars($t[$lang]['plan_plus']) ?></h4>
                <p><?= htmlspecialchars($t[$lang]['plan_plus_desc']) ?></p>
                <div class="plan-badges">
                    <span class="plan-badge">Mentorías</span>
                    <span class="plan-badge">Eventos</span>
                    <span class="plan-badge">Labs</span>
                </div>
                <button class="btn" onclick="window.location='public/community.php'"><?= htmlspecialchars($t[$lang]['plan_btn_plus']) ?></button>
            </article>
        </div>
    </section>

    <section class="landing-section">
        <h3><?= htmlspecialchars($t[$lang]['showcase_title']) ?></h3>
        <p><?= htmlspecialchars($t[$lang]['showcase_sub']) ?></p>
        <div class="showcase-grid">
            <article class="showcase-card">
                <div class="mockup-frame">
                    <div class="mockup-line long"></div>
                    <div class="mockup-line mid"></div>
                    <div class="mockup-line short"></div>
                </div>
                <h4><?= htmlspecialchars($t[$lang]['showcase_1_title']) ?></h4>
                <p><?= htmlspecialchars($t[$lang]['showcase_1_desc']) ?></p>
            </article>
            <article class="showcase-card">
                <div class="mockup-frame">
                    <div class="mockup-line mid"></div>
                    <div class="mockup-line long"></div>
                    <div class="mockup-line short"></div>
                </div>
                <h4><?= htmlspecialchars($t[$lang]['showcase_2_title']) ?></h4>
                <p><?= htmlspecialchars($t[$lang]['showcase_2_desc']) ?></p>
            </article>
            <article class="showcase-card">
                <div class="mockup-frame">
                    <div class="mockup-line short"></div>
                    <div class="mockup-line long"></div>
                    <div class="mockup-line mid"></div>
                </div>
                <h4><?= htmlspecialchars($t[$lang]['showcase_3_title']) ?></h4>
                <p><?= htmlspecialchars($t[$lang]['showcase_3_desc']) ?></p>
            </article>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-section">
        <h2><?php echo $usuario_logueado ? htmlspecialchars($t[$lang]['cta_logged']) : htmlspecialchars($t[$lang]['cta_guest']); ?></h2>
        <p><?php echo $usuario_logueado 
            ? htmlspecialchars($t[$lang]['cta_sub_logged'])
            : htmlspecialchars($t[$lang]['cta_sub_guest']); 
        ?></p>
        <div class="hero-buttons">
            <?php if ($usuario_logueado): ?>
                <button class="btn btn-primary btn-hero" onclick="window.location.href='<?= $baseUrl ?>/public/mapa/index.php'"><?= htmlspecialchars($t[$lang]['cta_map']) ?></button>
            <?php else: ?>
                <button class="btn btn-primary btn-hero" onclick="window.location.href='<?= $baseUrl ?>/public/register.php'"><?= htmlspecialchars($t[$lang]['cta_register']) ?></button>
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
                <h4><?= htmlspecialchars($t[$lang]['footer_product']) ?></h4>
                <ul>
                    <li><a href="<?php echo $usuario_logueado ? $baseUrl.'/public/mapa/index.php' : $baseUrl.'/public/gatekeeper.php?redirect=public/mapa/index.php'; ?>"><?= htmlspecialchars($t[$lang]['footer_map']) ?></a></li>
                    <li><a href="<?php echo $usuario_logueado ? $baseUrl.'/public/dashboard.php' : $baseUrl.'/public/gatekeeper.php?redirect=public/dashboard.php'; ?>"><?= htmlspecialchars($t[$lang]['nav_dashboard']) ?></a></li>
                    <li><a href="<?php echo $usuario_logueado ? 'public/ranking.php' : 'public/gatekeeper.php?redirect=ranking.php'; ?>">Ranking</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4><?= htmlspecialchars($t[$lang]['footer_resources']) ?></h4>
                <ul>
                    <li><a href="public/docs.php?file=README.md">Documentación</a></li>
                    <li><a href="public/docs.php?file=DEVELOPMENT.md">Guía de Desarrollo</a></li>
                    <li><a href="public/docs.php?file=API.md">API Reference</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4><?= htmlspecialchars($t[$lang]['footer_community']) ?></h4>
                <ul>
                    <li><a href="https://github.com" target="_blank">GitHub</a></li>
                    <li><a href="mailto:lcadvance40@gmail.com">Soporte</a></li>
                    <li><a href="<?php echo $usuario_logueado ? 'public/community.php' : 'public/gatekeeper.php?redirect=community.php'; ?>"><?= htmlspecialchars($t[$lang]['community']) ?></a></li>
                    <li><a href="public/register.php">Unirse</a></li>
                </ul>
            </div>
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
=======
<a class="mobile-sticky-cta" href="<?= $usuario_logueado ? $baseUrl.'/public/dashboard.php' : $baseUrl.'/public/register.php' ?>">
    <?= htmlspecialchars($t[$lang]['mobile_cta']) ?>
</a>

>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
=======
<div class="tour-modal" id="tourModal" aria-hidden="true">
    <div class="tour-content">
        <h4><?= htmlspecialchars($t[$lang]['tour_modal_title']) ?></h4>
        <p><?= htmlspecialchars($t[$lang]['tour_modal_sub']) ?></p>
        <div class="tour-preview" id="tourPreview">
            <div class="tour-frame">
                <div class="tour-screen active" data-step="1">
                    <h5>Mapa interactivo</h5>
                    <div class="tour-status">
                        <span class="tour-chip">Explora el campus</span>
                        <span class="tour-chip">Habla con profesores</span>
                    </div>
                    <p>Visualiza la zona principal del mapa, los puntos de acceso y la guía para entrar desde el campus virtual directamente a lecciones y retos.</p>
                </div>
                <div class="tour-screen" data-step="2">
                    <h5>Dashboard dinámico</h5>
                    <div class="tour-status">
                        <span class="tour-chip">Filtros por materia</span>
                        <span class="tour-chip">Progreso guardado</span>
                    </div>
                    <p>El dashboard muestra tu progreso real, los objetivos del día y las métricas que te ayudan a avanzar con enfoque.</p>
                </div>
                <div class="tour-screen" data-step="3">
                    <h5>Duelo y examen</h5>
                    <div class="tour-status">
                        <span class="tour-chip">Combates de conocimiento</span>
                        <span class="tour-chip">XP y nivel</span>
                    </div>
                    <p>Cada evaluación funciona como un duelo: responde, acumula puntos y desbloquea nuevas rutas en el mapa.</p>
                </div>
                <div class="tour-screen" data-step="4">
                    <h5>Ranking y logros</h5>
                    <div class="tour-status">
                        <span class="tour-chip">Posición global</span>
                        <span class="tour-chip">Rutas recomendadas</span>
                    </div>
                    <p>Consulta tu posición frente a otros estudiantes y usa el ranking para mejorar punto por punto.</p>
                </div>
            </div>
        </div>
        <ul class="tour-steps" id="tourStepList">
            <li class="active"><?= htmlspecialchars($t[$lang]['tour_step_1']) ?></li>
            <li><?= htmlspecialchars($t[$lang]['tour_step_2']) ?></li>
            <li><?= htmlspecialchars($t[$lang]['tour_step_3']) ?></li>
            <li><?= htmlspecialchars($t[$lang]['tour_step_4']) ?></li>
        </ul>
        <div class="tour-controls">
            <button class="btn" id="tourPrev" disabled>Anterior</button>
            <span class="tour-progress" id="tourProgress">1 / 4</span>
            <button class="btn btn-primary" id="tourNext">Siguiente</button>
        </div>
        <button class="btn btn-primary" id="closeTourBtn"><?= htmlspecialchars($t[$lang]['tour_close']) ?></button>
    </div>
</div>

<!-- MATERIA SELECTION MODAL -->
<?php if (!empty($_GET['seleccionar_materia'])): ?>
<?php
$todas_materias = [
    'Pensamiento Matemático III',
    'Física I',
    'Química I',
    'Programación',
    'Inglés',
    'Temas Selectos de Matemáticas I y II',
    'Historia de México',
    'Ciencias Sociales',
    'Ecosistemas',
    'Biología',
    'Economía',
    'Taller de Lectura y Redacción',
];
sort($todas_materias);
?>
<div id="materiaModal" class="materia-modal" style="display:flex;">
    <div class="materia-modal-content">
        <h2><?= htmlspecialchars($t[$lang]['select_materia_title']) ?></h2>
        <p><?= htmlspecialchars($t[$lang]['select_materia_sub']) ?></p>
        <form method="get" action="<?= $baseUrl ?>/public/dashboard.php">
            <input type="hidden" name="materia" id="selectedMateriaInput" value="">
            <div class="materia-grid">
                <?php foreach ($todas_materias as $m): ?>
                    <button type="button" class="materia-btn" data-materia="<?= htmlspecialchars($m) ?>" onclick="selectMateria('<?= htmlspecialchars(addslashes($m)) ?>')">
                        <?= htmlspecialchars($m) ?>
                    </button>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-primary" id="materiaContinueBtn" disabled><?= htmlspecialchars($t[$lang]['select_materia_btn']) ?></button>
        </form>
    </div>
</div>
<style>
.materia-modal { position:fixed; inset:0; background:rgba(0,0,0,0.85); z-index:9999; display:none; align-items:center; justify-content:center; }
.materia-modal-content { background:#101828; border:1px solid rgba(0,229,255,.3); border-radius:16px; padding:32px; max-width:500px; width:90%; text-align:center; }
.materia-modal-content h2 { color:#00e5ff; margin:0 0 12px; font-size:24px; }
.materia-modal-content p { color:rgba(220,236,255,.7); margin:0 0 24px; }
.materia-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:10px; margin-bottom:20px; }
.materia-btn { background:#0c1525; border:1px solid rgba(0,229,255,.2); color:#e8f4ff; padding:12px 8px; border-radius:8px; cursor:pointer; font-size:13px; transition:all .2s; }
.materia-btn:hover { border-color:#00e5ff; background:rgba(0,229,255,.1); }
.materia-btn.selected { background:#00e5ff; color:#061523; border-color:#00e5ff; font-weight:700; }
.materia-modal-content .btn-primary { width:100%; padding:14px; font-size:16px; }
.materia-modal-content .btn-primary:disabled { opacity:.5; cursor:not-allowed; }
</style>
<script>
function selectMateria(materia) {
    document.querySelectorAll('.materia-btn').forEach(b => b.classList.remove('selected'));
    document.querySelector('.materia-btn[data-materia="'+materia+'"]').classList.add('selected');
    document.getElementById('selectedMateriaInput').value = materia;
    document.getElementById('materiaContinueBtn').disabled = false;
}
</script>
<?php endif; ?>

>>>>>>> Stashed changes
</body>
</html>
</html>
