<?php
// ==========================================
// LC-ADVANCE - index.php (Rediseño Premium 2025)
// ==========================================
// Diseño Responsivo con Animaciones del Dashboard
// ==========================================

require_once 'config/config.php';
iniciarSesionSegura();
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
require_once 'config/csrf.php';

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
    ],
];
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LC-ADVANCE | Plataforma Educativa Gamificada</title>
    <link rel="manifest" href="manifest.webmanifest">
    
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
            color: #041420;
            background: var(--cyan);
            font-weight: 700;
        }

        .btn-primary:hover {
            background: #33eeff;
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 10px 28px rgba(0, 229, 255, 0.35);
        }

        .toolbar-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: 8px;
        }

        .toolbar-controls select {
            background: var(--surface2);
            border: 1px solid var(--border2);
            color: var(--text);
            border-radius: 7px;
            height: 30px;
            padding: 0 8px;
            font-size: 10px;
            font-family: var(--font-mono);
        }

        .toolbar-controls button {
            height: 30px;
            padding: 0 10px;
            border-radius: 7px;
            border: 1px solid var(--border2);
            background: var(--surface2);
            color: var(--text);
            font-size: 10px;
            font-family: var(--font-mono);
        }

        [data-theme="light"] {
            --bg: #f4f8ff;
            --surface: #ffffff;
            --surface2: #eef4ff;
            --text: #061523;
            --muted: rgba(20, 35, 55, 0.65);
            --border: rgba(0, 120, 170, 0.16);
            --border2: rgba(0, 120, 170, 0.28);
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

        .interactive-preview {
            margin: -20px auto 70px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 22px;
            max-width: 1000px;
        }

        .interactive-preview h3 {
            font-family: var(--font-display);
            margin-bottom: 8px;
            font-size: 22px;
        }

        .interactive-preview p {
            color: var(--muted);
            margin-bottom: 14px;
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 10px;
            margin-bottom: 14px;
        }

        .preview-card {
            border: 1px solid var(--border);
            background: var(--surface2);
            border-radius: 10px;
            padding: 14px;
            color: var(--text);
            text-align: left;
        }

        .preview-card strong {
            display: block;
            margin-bottom: 6px;
            font-size: 12px;
            color: var(--cyan);
            font-family: var(--font-mono);
            text-transform: uppercase;
        }

        .preview-card span {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.5;
        }

        .tour-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 300;
            padding: 16px;
        }

        .tour-modal.open {
            display: flex;
        }

        .tour-content {
            background: var(--surface);
            border: 1px solid var(--border2);
            border-radius: 14px;
            width: min(680px, 100%);
            padding: 22px;
        }

        .tour-content h4 {
            font-family: var(--font-display);
            margin-bottom: 10px;
        }

        .tour-content p {
            color: var(--muted);
            margin-bottom: 12px;
        }

        .tour-steps {
            list-style: none;
            display: grid;
            gap: 8px;
            margin-bottom: 12px;
        }

        .tour-steps li {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 10px;
            background: var(--surface2);
            font-size: 13px;
            transition: border-color 0.2s ease, background 0.2s ease;
        }

        .tour-steps li.active {
            background: rgba(0, 230, 255, 0.12);
            border-color: rgba(0, 230, 255, 0.4);
        }

        .tour-preview {
            display: grid;
            gap: 16px;
            margin-bottom: 16px;
        }

        .tour-frame {
            background: #080d18;
            border: 1px solid rgba(0, 255, 255, 0.18);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 0 40px rgba(0, 255, 255, 0.06);
        }

        .tour-screen {
            min-height: 230px;
            padding: 18px;
            color: #e8f4ff;
            font-family: var(--font-mono);
            display: none;
            gap: 14px;
        }

        .tour-screen.active {
            display: grid;
        }

        .tour-screen h5 {
            margin: 0 0 10px;
            font-size: 14px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .tour-screen p {
            margin: 0;
            font-size: 12px;
            line-height: 1.6;
            color: rgba(232, 244, 255, 0.78);
        }

        .tour-status {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .tour-chip {
            background: rgba(0, 255, 255, 0.08);
            border: 1px solid rgba(0, 255, 255, 0.12);
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 11px;
            color: #c8f4ff;
        }

        .tour-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .tour-controls .btn {
            min-width: 120px;
        }

        .tour-progress {
            color: var(--muted);
            font-size: 12px;
            letter-spacing: 0.6px;
        }

        .landing-section {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 26px;
            margin-bottom: 60px;
        }

        .landing-section h3 {
            font-family: var(--font-display);
            font-size: 30px;
            margin-bottom: 8px;
        }

        .landing-section > p {
            color: var(--muted);
            margin-bottom: 20px;
        }

        .path-grid, .testimonial-grid, .faq-grid {
            display: grid;
            gap: 12px;
        }

        .path-grid {
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        }

        .path-card, .testimonial-card {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px;
        }

        .path-card h4 {
            margin-bottom: 8px;
            font-family: var(--font-display);
            font-size: 18px;
        }

        .path-card p, .testimonial-card p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.55;
        }

        .testimonial-card p {
            margin-bottom: 10px;
        }

        .testimonial-card span {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--cyan);
        }

        .daily-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            background: var(--surface2);
            border: 1px solid var(--border2);
            border-radius: 12px;
            padding: 16px;
        }

        .daily-card .countdown {
            font-family: var(--font-mono);
            font-size: 18px;
            color: var(--green);
        }

        .testimonial-grid {
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        }

        .faq-item {
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            background: var(--surface2);
        }

        .faq-question {
            width: 100%;
            text-align: left;
            background: transparent;
            color: var(--text);
            padding: 14px;
            font-size: 14px;
            border: none;
        }

        .faq-answer {
            display: none;
            padding: 0 14px 14px;
            color: var(--muted);
            line-height: 1.6;
            font-size: 14px;
        }

        .faq-item.open .faq-answer {
            display: block;
        }

        .plans-grid,
        .showcase-grid {
            display: grid;
            gap: 12px;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .plan-card,
        .showcase-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--surface2);
            padding: 16px;
        }

        .plan-card h4,
        .showcase-card h4 {
            font-family: var(--font-display);
            font-size: 18px;
            margin-bottom: 8px;
        }

        .plan-card p,
        .showcase-card p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.55;
            margin-bottom: 12px;
        }

        .plan-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 12px;
        }

        .plan-badge {
            font-family: var(--font-mono);
            font-size: 9px;
            color: var(--cyan);
            border: 1px solid var(--border2);
            border-radius: 999px;
            padding: 4px 8px;
            background: rgba(0, 229, 255, 0.08);
        }

        .mockup-frame {
            border: 1px solid var(--border2);
            border-radius: 10px;
            background: #0a1423;
            min-height: 120px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .mockup-line {
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(90deg, rgba(0,229,255,.4), rgba(255,60,172,.35));
            margin-bottom: 8px;
        }

        .mockup-line.short { width: 56%; }
        .mockup-line.mid { width: 78%; }
        .mockup-line.long { width: 94%; }

        .mobile-sticky-cta {
            display: none;
            position: fixed;
            left: 10px;
            right: 10px;
            bottom: 10px;
            z-index: 220;
            border-radius: 12px;
            padding: 11px 14px;
            text-align: center;
            font-family: var(--font-mono);
            font-size: 11px;
            letter-spacing: 0.6px;
            background: var(--cyan);
            color: #041420;
            border: 1px solid rgba(0, 229, 255, 0.5);
            box-shadow: 0 10px 30px rgba(0,229,255,0.28);
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

            .mobile-sticky-cta {
                display: block;
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
            <button class="btn btn-primary" onclick="window.location='dashboard.php'"><?= htmlspecialchars($t[$lang]['nav_dashboard']) ?></button>
            <button class="btn" onclick="window.location='coding_challenges.php'"><?= htmlspecialchars($t[$lang]['coding_lab']) ?></button>
            <button class="btn" onclick="window.location='logout.php'"><?= htmlspecialchars($t[$lang]['nav_logout']) ?></button>
        <?php else: ?>
            <button class="btn" onclick="window.location='login.php'"><?= htmlspecialchars($t[$lang]['nav_login']) ?></button>
            <button class="btn btn-primary" onclick="window.location='register.php'"><?= htmlspecialchars($t[$lang]['nav_register']) ?></button>
        <?php endif; ?>
        <div class="toolbar-controls">
            <label for="langSelector" style="font-size:10px;color:var(--muted);font-family:var(--font-mono);"><?= htmlspecialchars($t[$lang]['language']) ?></label>
            <select id="langSelector">
                <option value="es" <?= $lang === 'es' ? 'selected' : '' ?>>ES</option>
                <option value="en" <?= $lang === 'en' ? 'selected' : '' ?>>EN</option>
            </select>
        </div>
    </nav>
</header>

<!-- MAIN -->
<main class="container">

    <!-- HERO SECTION -->
    <section class="hero">
        <h1><?php echo $usuario_logueado ? htmlspecialchars($t[$lang]['hero_title_logged']) : htmlspecialchars($t[$lang]['hero_title_guest']); ?></h1>
        <p><?php echo $usuario_logueado 
            ? htmlspecialchars($t[$lang]['hero_sub_logged'])
            : htmlspecialchars($t[$lang]['hero_sub_guest']); 
        ?></p>
        <div class="hero-buttons">
            <?php if ($usuario_logueado): ?>
                <button class="btn btn-primary btn-hero" onclick="window.location='mapa/index.php'"><?= htmlspecialchars($t[$lang]['cta_map']) ?></button>
            <?php else: ?>
                <button class="btn btn-primary btn-hero" onclick="window.location='register.php'"><?= htmlspecialchars($t[$lang]['hero_start']) ?></button>
                <button class="btn btn-hero" onclick="window.location='guest_login.php'"><?= htmlspecialchars($t[$lang]['hero_guest']) ?></button>
            <?php endif; ?>
        </div>
    </section>

    <section class="interactive-preview">
        <h3><?= htmlspecialchars($t[$lang]['tour_title']) ?></h3>
        <p><?= htmlspecialchars($t[$lang]['tour_sub']) ?></p>
        <div class="preview-grid">
            <div class="preview-card">
                <strong>Mapa</strong>
                <span><?= htmlspecialchars($t[$lang]['preview_map_desc']) ?></span>
            </div>
            <div class="preview-card">
                <strong>Dashboard</strong>
                <span><?= htmlspecialchars($t[$lang]['preview_dashboard_desc']) ?></span>
            </div>
            <div class="preview-card">
                <strong>Duelos</strong>
                <span><?= htmlspecialchars($t[$lang]['preview_duels_desc']) ?></span>
            </div>
            <div class="preview-card">
                <strong>Ranking</strong>
                <span><?= htmlspecialchars($t[$lang]['preview_ranking_desc']) ?></span>
            </div>
        </div>
        <button class="btn btn-primary" id="openTourBtn"><?= htmlspecialchars($t[$lang]['tour_btn']) ?></button>
    </section>

    <!-- STATS SECTION -->
    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-value"><span class="stat-number" data-target="200">0</span>+</div>
            <div class="stat-label"><?= htmlspecialchars($t[$lang]['stat_lessons']) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><span class="stat-number" data-target="15">0</span>k+</div>
            <div class="stat-label"><?= htmlspecialchars($t[$lang]['stat_questions']) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><span class="stat-number" data-target="24">0</span>/7</div>
            <div class="stat-label"><?= htmlspecialchars($t[$lang]['stat_access']) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><span class="stat-number" data-target="100">0</span>%</div>
            <div class="stat-label"><?= htmlspecialchars($t[$lang]['stat_free']) ?></div>
        </div>
    </section>

    <!-- FEATURE 1: MAPA -->
    <section class="feature-section" style="animation-delay: 0.15s">
        <div class="feature-text">
            <h2><?= htmlspecialchars($t[$lang]['feature_map_title']) ?></h2>
            <p><?= htmlspecialchars($t[$lang]['feature_map_p1']) ?></p>
            <p><?= htmlspecialchars($t[$lang]['feature_map_p2']) ?></p>
        </div>
        <div class="feature-visual">
            <img src="assets/img/mapa.png" alt="Mapa Interactivo" style="width:100%; height:auto; border-radius:10px; display:block;">
        </div>
    </section>

    <!-- FEATURE 2: LECCIONES -->
    <section class="feature-section" style="animation-delay: 0.25s">
        <div class="feature-text">
            <h2><?= htmlspecialchars($t[$lang]['feature_learning_title']) ?></h2>
            <p><?= htmlspecialchars($t[$lang]['feature_learning_p1']) ?></p>
            <p><?= htmlspecialchars($t[$lang]['feature_learning_p2']) ?></p>
        </div>
        <div class="feature-visual">
            <img src="assets/img/dashboard.png" alt="Lecciones Interactivas" style="width:100%; height:auto; border-radius:10px; display:block;">
        </div>
    </section>

    <!-- FEATURE 3: COMBATE -->
    <section class="feature-section" style="animation-delay: 0.35s">
        <div class="feature-text">
            <h2><?= htmlspecialchars($t[$lang]['feature_duel_title']) ?></h2>
            <p><?= htmlspecialchars($t[$lang]['feature_duel_p1']) ?></p>
            <p><?= htmlspecialchars($t[$lang]['feature_duel_p2']) ?></p>
        </div>
        <div class="feature-visual">
            <img src="assets/img/duelo.png" alt="Sistema de Duelos" style="width:100%; height:auto; border-radius:10px; display:block;">
        </div>
    </section>

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
            <button class="btn btn-primary" onclick="window.location='<?= $usuario_logueado ? 'mapa/index.php' : 'register.php' ?>'"><?= htmlspecialchars($t[$lang]['daily_btn']) ?></button>
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
                <button class="btn btn-primary" onclick="window.location='register.php'"><?= htmlspecialchars($t[$lang]['plan_btn_free']) ?></button>
            </article>
            <article class="plan-card">
                <h4><?= htmlspecialchars($t[$lang]['plan_plus']) ?></h4>
                <p><?= htmlspecialchars($t[$lang]['plan_plus_desc']) ?></p>
                <div class="plan-badges">
                    <span class="plan-badge">Mentorías</span>
                    <span class="plan-badge">Eventos</span>
                    <span class="plan-badge">Labs</span>
                </div>
                <button class="btn" onclick="window.location='community.php'"><?= htmlspecialchars($t[$lang]['plan_btn_plus']) ?></button>
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
                <button class="btn btn-primary btn-hero" onclick="window.location='mapa/index.php'"><?= htmlspecialchars($t[$lang]['cta_map']) ?></button>
            <?php else: ?>
                <button class="btn btn-primary btn-hero" onclick="window.location='register.php'"><?= htmlspecialchars($t[$lang]['cta_register']) ?></button>
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
                    <li><a href="<?php echo $usuario_logueado ? 'mapa/index.php' : 'gatekeeper.php?redirect=mapa/index.php'; ?>"><?= htmlspecialchars($t[$lang]['footer_map']) ?></a></li>
                    <li><a href="<?php echo $usuario_logueado ? 'dashboard.php' : 'gatekeeper.php?redirect=dashboard.php'; ?>"><?= htmlspecialchars($t[$lang]['nav_dashboard']) ?></a></li>
                    <li><a href="<?php echo $usuario_logueado ? 'ranking.php' : 'gatekeeper.php?redirect=ranking.php'; ?>">Ranking</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4><?= htmlspecialchars($t[$lang]['footer_resources']) ?></h4>
                <ul>
                    <li><a href="docs.php?file=README.md">Documentación</a></li>
                    <li><a href="docs.php?file=DEVELOPMENT.md">Guía de Desarrollo</a></li>
                    <li><a href="docs.php?file=API.md">API Reference</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4><?= htmlspecialchars($t[$lang]['footer_community']) ?></h4>
                <ul>
                    <li><a href="https://github.com" target="_blank">GitHub</a></li>
                    <li><a href="mailto:lcadvance40@gmail.com">Soporte</a></li>
                    <li><a href="<?php echo $usuario_logueado ? 'community.php' : 'gatekeeper.php?redirect=community.php'; ?>"><?= htmlspecialchars($t[$lang]['community']) ?></a></li>
                    <li><a href="register.php">Unirse</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025-2026 LC-ADVANCE. Todos los derechos reservados. | Hecho con 💚 para estudiantes DGETI.</p>
        </div>
    </div>
</footer>

<a class="mobile-sticky-cta" href="<?= $usuario_logueado ? 'dashboard.php' : 'register.php' ?>">
    <?= htmlspecialchars($t[$lang]['mobile_cta']) ?>
</a>

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

document.addEventListener('DOMContentLoaded', () => {

    const langSelector = document.getElementById('langSelector');
    if (langSelector) {
        langSelector.addEventListener('change', (e) => {
            const u = new URL(window.location.href);
            u.searchParams.set('lang', e.target.value);
            window.location.href = u.toString();
        });
    }

    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach((btn) => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.faq-item');
            if (!item) return;
            item.classList.toggle('open');
        });
    });

    const countdownEl = document.getElementById('dailyCountdown');
    if (countdownEl) {
        const updateCountdown = () => {
            const now = new Date();
            const tomorrow = new Date(now);
            tomorrow.setHours(24, 0, 0, 0);
            const diff = Math.max(0, tomorrow.getTime() - now.getTime());
            const hours = String(Math.floor(diff / (1000 * 60 * 60))).padStart(2, '0');
            const minutes = String(Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
            const seconds = String(Math.floor((diff % (1000 * 60)) / 1000)).padStart(2, '0');
            countdownEl.textContent = `${hours}:${minutes}:${seconds}`;
        };
        updateCountdown();
        setInterval(updateCountdown, 1000);
    }

    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('service-worker.js').catch(() => {});
    }

    const statNumbers = document.querySelectorAll('.stat-number');
    if (statNumbers.length) {
        const statsSection = document.querySelector('.stats-grid');
        let hasAnimated = false;
        const runStatAnimation = () => {
            if (hasAnimated) return;
            hasAnimated = true;
            statNumbers.forEach((el) => {
                const target = Number(el.dataset.target || 0);
                const duration = 900;
                const start = performance.now();
                const step = (now) => {
                    const progress = Math.min(1, (now - start) / duration);
                    const value = Math.round(target * progress);
                    el.textContent = String(value);
                    if (progress < 1) requestAnimationFrame(step);
                };
                requestAnimationFrame(step);
            });
        };

        if ('IntersectionObserver' in window && statsSection) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        runStatAnimation();
                        observer.disconnect();
                    }
                });
            }, { threshold: 0.3 });
            observer.observe(statsSection);
        } else {
            runStatAnimation();
        }
    }
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

document.addEventListener('DOMContentLoaded', () => {
    const tourModal = document.getElementById('tourModal');
    const openTourBtn = document.getElementById('openTourBtn');
    const closeTourBtn = document.getElementById('closeTourBtn');
    const tourPrev = document.getElementById('tourPrev');
    const tourNext = document.getElementById('tourNext');
    const tourProgress = document.getElementById('tourProgress');
    const tourScreens = Array.from(document.querySelectorAll('.tour-screen'));
    const tourSteps = Array.from(document.querySelectorAll('.tour-steps li'));
    let tourIndex = 0;

    if (!tourModal || !openTourBtn || !closeTourBtn || !tourPrev || !tourNext || !tourProgress) return;

    const updateTourView = () => {
        tourScreens.forEach((screen, index) => {
            screen.classList.toggle('active', index === tourIndex);
        });
        tourSteps.forEach((step, index) => {
            step.classList.toggle('active', index === tourIndex);
        });
        tourPrev.disabled = tourIndex === 0;
        tourNext.textContent = tourIndex === tourScreens.length - 1 ? 'Cerrar' : 'Siguiente';
        tourProgress.textContent = `${tourIndex + 1} / ${tourScreens.length}`;
    };

    openTourBtn.addEventListener('click', () => {
        tourModal.classList.add('open');
        tourIndex = 0;
        updateTourView();
    });
    closeTourBtn.addEventListener('click', () => tourModal.classList.remove('open'));
    tourModal.addEventListener('click', (event) => {
        if (event.target === tourModal) {
            tourModal.classList.remove('open');
        }
    });

    tourPrev.addEventListener('click', () => {
        if (tourIndex > 0) {
            tourIndex -= 1;
            updateTourView();
        }
    });

    tourNext.addEventListener('click', () => {
        if (tourIndex < tourScreens.length - 1) {
            tourIndex += 1;
            updateTourView();
        } else {
            tourModal.classList.remove('open');
        }
    });

    updateTourView();
});
</script>

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

</body>
</html>
