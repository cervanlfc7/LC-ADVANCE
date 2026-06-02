<?php
// ==========================================
// LC-ADVANCE - index.php (Versión Mejorada 2025 v2.1 - Self-Contained)
// ==========================================

require_once 'src/Config/config.php';
iniciarSesionSegura();

$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$baseUrl = $scriptDir === '/' || $scriptDir === '\\' ? '' : $scriptDir;

$usuario_logueado = isset($_SESSION['usuario_id']);
$supported_langs = ['es', 'en'];
if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_langs, true)) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'es';
if (!in_array($lang, $supported_langs, true)) $lang = 'es';

$t = [
    'es' => [
        'nav_dashboard' => 'Dashboard',
        'nav_logout' => 'Cerrar Sesión',
        'nav_login' => 'Iniciar Sesión',
        'nav_register' => 'Registrarse',
        'coding_lab' => 'Laboratorio',
        'hero_title_logged' => 'Bienvenido de vuelta',
        'hero_title_guest' => 'Domina todas tus materias',
        'hero_sub_logged' => 'Tu progreso está guardado. Continúa tu aventura educativa.',
        'hero_sub_guest' => 'La plataforma educativa gamificada que transforma el aprendizaje en una experiencia épica.',
        'hero_go_dashboard' => 'Ir al Dashboard',
        'hero_start' => 'Comenzar Ahora',
        'hero_guest' => 'Acceso Invitado',
        'cta_map' => 'Ir al Mapa',
        'mobile_cta' => 'Comenzar gratis',
        'cards_rank_title' => 'Sistema de Ranking',
        'cards_rank_desc' => 'Compite globalmente. Sube en el ranking, gana insignias y demuestra tu dominio en cada materia.',
        'cards_progress_title' => 'Progreso Guardado',
        'cards_progress_desc' => 'Tu avance se sincroniza automáticamente. Retoma desde donde dejaste en cualquier dispositivo.',
        'cards_analytics_title' => 'Análisis Detallado',
        'cards_analytics_desc' => 'Dashboard interactivo con métricas de tu desempeño y estadísticas visuales en tiempo real.',
        'paths_title' => 'Rutas destacadas',
        'paths_sub' => 'Elige un camino recomendado y avanza con metas claras.',
        'path_1_title' => 'Ruta Programación Fullstack',
        'path_1_desc' => 'Fundamentos, lógica, frontend y backend con retos progresivos.',
        'path_2_title' => 'Ruta Ciencias Aplicadas',
        'path_2_desc' => 'Física, química y matemáticas con simulaciones y práctica guiada.',
        'path_3_title' => 'Ruta Alto Rendimiento',
        'path_3_desc' => 'Entrenamiento intensivo con ranking competitivo y duelos semanales.',
        'select_materia_title' => 'Selecciona una materia',
        'select_materia_sub' => 'Elige el área que quieres estudiar para continuar.',
        'select_materia_btn' => 'Continuar',
    ],
    'en' => [
        'nav_dashboard' => 'Dashboard',
        'nav_logout' => 'Log Out',
        'nav_login' => 'Log In',
        'nav_register' => 'Sign Up',
        'coding_lab' => 'Lab',
        'hero_title_logged' => 'Welcome back',
        'hero_title_guest' => 'Master all your subjects',
        'hero_sub_logged' => 'Your progress is saved. Continue your learning adventure.',
        'hero_sub_guest' => 'The gamified learning platform that turns studying into an epic experience.',
        'hero_go_dashboard' => 'Go to Dashboard',
        'hero_start' => 'Start Now',
        'hero_guest' => 'Guest Access',
        'cta_map' => 'Go to Map',
        'mobile_cta' => 'Start free',
        'cards_rank_title' => 'Ranking System',
        'cards_rank_desc' => 'Compete globally. Climb the ranking, earn badges, and prove your mastery.',
        'cards_progress_title' => 'Saved Progress',
        'cards_progress_desc' => 'Your progress syncs automatically. Resume from where you left off on any device.',
        'cards_analytics_title' => 'Detailed Analytics',
        'cards_analytics_desc' => 'Interactive dashboard with performance metrics and real-time visual stats.',
        'paths_title' => 'Featured paths',
        'paths_sub' => 'Choose a recommended path and progress with clear milestones.',
        'path_1_title' => 'Fullstack Programming Path',
        'path_1_desc' => 'Foundations, logic, frontend, and backend with progressive challenges.',
        'path_2_title' => 'Applied Sciences Path',
        'path_2_desc' => 'Physics, chemistry, and math with simulations and guided practice.',
        'path_3_title' => 'High Performance Path',
        'path_3_desc' => 'Intensive training with competitive ranking and weekly duels.',
        'select_materia_title' => 'Select a subject',
        'select_materia_sub' => 'Choose the area you want to study to continue.',
        'select_materia_btn' => 'Continue',
    ],
];
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LC-ADVANCE</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎮</text></svg>">
<style>
/* ═══════════════════════════════════════════════════
   LC-ADVANCE  ·  index.php (Dark-Cyber Theme v2025)
   Consistent with dashboard.css styling
   ═══════════════════════════════════════════════════ */

@import url("https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&family=Syne:wght@700;800&display=swap");

/* ── Reset ── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
img { display: block; max-width: 100%; }
a { text-decoration: none; color: inherit; }
button { cursor: pointer; font-family: inherit; }

/* ── Design Tokens ── */
:root {
    /* Colors - Cleaner & Less Saturated */
    --bg:          #0a0d14;
    --surface:     #0f1423;
    --surface2:    #141a2f;
    --surface3:    #1a1f35;
    --border:      rgba(0, 229, 255, 0.12);
    --border2:     rgba(0, 229, 255, 0.18);

    --cyan:        #00e5ff;
    --cyan-dim:    rgba(0, 229, 255, 0.1);
    --cyan-glow:   rgba(0, 229, 255, 0.2);
    --pink:        #ff3cac;
    --pink-glow:   rgba(255, 60, 172, 0.15);
    --green:       #00ff87;
    --yellow:      #ffd23f;

    --text:        #e4f2ff;
    --text-secondary: rgba(200, 230, 255, 0.75);
    --text-muted:  rgba(200, 230, 255, 0.45);

    /* Typography */
    --font-display: "Syne", sans-serif;
    --font-body:    "Space Grotesk", sans-serif;
    --font-mono:    "JetBrains Mono", monospace;

    /* Effects */
    --section-gap: clamp(100px, 14vw, 160px);
    --radius:      14px;
    --radius-lg:   20px;
    --transition:  all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    --blur:        blur(16px);
}

/* ── Base ── */
html { scroll-behavior: smooth; }

body {
    background-color: var(--bg);
    color: var(--text);
    font-family: var(--font-body);
    font-size: 14px;
    line-height: 1.5;
    overflow-x: hidden;
    min-height: 100vh;
}

/* ── Animated grid background ── */
.grid-bg {
    position: fixed;
    inset: 0;
    background-image:
        linear-gradient(rgba(0, 229, 255, 0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0, 229, 255, 0.02) 1px, transparent 1px);
    background-size: 60px 60px;
    pointer-events: none;
    z-index: 0;
    animation: gridScroll 45s linear infinite;
    opacity: 0.5;
}
@keyframes gridScroll {
    to {
        background-position: 0 60px;
    }
}

/* Ambient glow orbs - Subtle */
.bg-orb {
    position: fixed;
    border-radius: 50%;
    filter: blur(120px);
    pointer-events: none;
    z-index: 0;
}
.bg-orb-1 {
    width: 700px;
    height: 700px;
    background: radial-gradient(circle, rgba(0, 229, 255, 0.08), transparent 70%);
    top: -200px;
    right: -200px;
    animation: orbPulse 20s ease-in-out infinite;
}
.bg-orb-2 {
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(255, 60, 172, 0.06), transparent 70%);
    bottom: -150px;
    left: -150px;
    animation: orbPulse 22s ease-in-out infinite reverse;
}
@keyframes orbPulse {
    0%, 100% { transform: scale(1) translateY(0px); }
    50%       { transform: scale(1.15) translateY(-40px); }
}

/* ── Layout ── */
.wrap {
    position: relative;
    z-index: 1;
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 clamp(20px, 4vw, 48px);
}

/* ─────────────────────────────────────────────────
   HEADER
   ───────────────────────────────────────────────── */
header.header {
    position: sticky;
    top: 0;
    z-index: 100;
    padding: 0 28px;
    min-height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(180deg, rgba(10, 13, 20, 0.95) 0%, rgba(10, 13, 20, 0.9) 100%);
    backdrop-filter: var(--blur);
    border-bottom: 1px solid var(--border);
    animation: fadeInDown 0.6s ease-out;
    gap: 16px;
    flex-wrap: wrap;
}

.logo-text {
    font-family: var(--font-display);
    font-size: 16px;
    font-weight: 800;
    letter-spacing: -0.6px;
    background: linear-gradient(135deg, var(--cyan), var(--pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    transition: var(--transition);
}

.logo-text:hover {
    letter-spacing: -0.3px;
}

.site-header {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 100;
    background: linear-gradient(180deg, rgba(10, 13, 20, 0.95) 0%, rgba(10, 13, 20, 0.9) 100%);
    backdrop-filter: var(--blur);
    border-bottom: 1px solid var(--border);
    padding: 0 28px;
    transition: var(--transition);
}
.header-inner {
    max-width: 1440px;
    margin: 0 auto;
    height: 60px;
    display: flex;
    align-items: center;
    gap: 18px;
}
.header-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    flex-shrink: 0;
}
.brand-icon {
    font-size: 22px;
    animation: float 3.5s ease-in-out infinite;
}
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-3px); }
}
.brand-name {
    font-family: var(--font-display);
    font-size: 15px;
    font-weight: 800;
    letter-spacing: -0.5px;
    background: linear-gradient(135deg, var(--cyan), var(--pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    white-space: nowrap;
    transition: var(--transition);
}

.header-nav {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-left: auto;
}

/* Nav buttons */
.nav-btn {
    display: inline-flex;
    align-items: center;
    height: 36px;
    padding: 0 16px;
    font-family: var(--font-body);
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0px;
    border-radius: var(--radius);
    border: 1px solid var(--border2);
    transition: var(--transition);
    white-space: nowrap;
    color: var(--text);
    background: rgba(15, 20, 35, 0.3);
}
.nav-btn:hover {
    background: rgba(0, 229, 255, 0.08);
    border-color: var(--cyan);
    color: var(--cyan);
    transform: translateY(-1px);
}
.nav-btn-primary {
    background: linear-gradient(135deg, var(--cyan), var(--pink));
    border-color: transparent;
    color: var(--bg);
    font-weight: 700;
}
.nav-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px var(--cyan-glow);
}

/* Hamburger (mobile) */
.hamburger {
    display: none;
    background: none;
    border: 1px solid var(--border);
    color: var(--text);
    width: 38px; height: 38px;
    border-radius: var(--radius);
    font-size: 18px;
    margin-left: auto;
}

/* ─────────────────────────────────────────────────
   HERO
   ───────────────────────────────────────────────── */
.hero {
    margin-top: 60px;
    min-height: calc(100vh - 60px);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 120px 24px;
    position: relative;
    overflow: hidden;
}

.hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 120% 80% at 50% 30%, rgba(0, 229, 255, 0.03) 0%, transparent 60%);
    pointer-events: none;
    z-index: 0;
}

.hero-content {
    position: relative;
    z-index: 1;
    max-width: 850px;
}

.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-family: var(--font-mono);
    font-size: 12px;
    color: var(--cyan);
    border: 1px solid var(--border);
    background: rgba(0, 229, 255, 0.05);
    padding: 6px 16px;
    border-radius: 999px;
    margin-bottom: 32px;
    animation: fadeDown 0.8s ease both;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.hero-title {
    font-family: var(--font-display);
    font-size: clamp(40px, 6.5vw, 64px);
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 24px;
    background: linear-gradient(135deg, var(--cyan) 0%, var(--pink) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: fadeDown 0.9s ease 0.1s both;
    letter-spacing: -1.2px;
}

.hero-subtitle {
    font-size: clamp(16px, 2vw, 18px);
    color: var(--text-secondary);
    max-width: 680px;
    margin: 0 auto 56px;
    line-height: 1.65;
    animation: fadeDown 0.9s ease 0.2s both;
}

.hero-actions {
    display: flex;
    gap: 14px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 80px;
    animation: fadeDown 0.9s ease 0.3s both;
}

/* CTA buttons */
.cta-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    height: 48px;
    padding: 0 32px;
    border-radius: var(--radius-lg);
    font-family: var(--font-body);
    font-size: 14px;
    font-weight: 700;
    border: none;
    transition: var(--transition);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.cta-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.08) 50%, transparent 100%);
    transform: translateX(-100%);
    transition: transform 0.5s ease;
}

.cta-btn:hover::before {
    transform: translateX(100%);
}

.cta-primary {
    background: linear-gradient(135deg, var(--cyan) 0%, var(--pink) 100%);
    color: var(--bg);
    box-shadow: 0 8px 28px rgba(0, 229, 255, 0.15);
    z-index: 1;
}

.cta-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 40px rgba(0, 229, 255, 0.25);
}

.cta-secondary {
    background: transparent;
    border: 1.5px solid var(--border);
    color: var(--text);
}

.cta-secondary:hover {
    background: rgba(0, 229, 255, 0.05);
    border-color: var(--cyan);
    color: var(--cyan);
    transform: translateY(-1px);
}

/* Stats strip */
.hero-stats {
    display: flex;
    justify-content: center;
    gap: clamp(40px, 8vw, 80px);
    padding: 40px 48px;
    background: rgba(15, 20, 35, 0.4);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    backdrop-filter: var(--blur);
    animation: fadeDown 0.9s ease 0.4s both;
}

.stat-item {
    text-align: center;
}

.stat-value {
    font-family: var(--font-display);
    font-size: clamp(24px, 3vw, 32px);
    font-weight: 800;
    color: var(--cyan);
    display: block;
    margin-bottom: 6px;
}

.stat-label {
    font-family: var(--font-body);
    font-size: 11px;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.8px;
    font-weight: 700;
}

/* ─────────────────────────────────────────────────
   FEATURE SECTIONS
   ───────────────────────────────────────────────── */
.features-wrap {
    padding: var(--section-gap) 0;
}

.feature-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: clamp(48px, 8vw, 100px);
    align-items: center;
    margin-bottom: var(--section-gap);
    opacity: 0;
    transform: translateY(60px);
    transition: opacity 0.8s ease, transform 0.8s ease;
}
.feature-row.visible {
    opacity: 1;
    transform: translateY(0);
}
.feature-row.reverse { direction: rtl; }
.feature-row.reverse > * { direction: ltr; }

/* Feature text */
.feature-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-family: var(--font-mono);
    font-size: 11px;
    color: var(--cyan);
    background: rgba(0, 229, 255, 0.06);
    border: 1px solid var(--border);
    padding: 6px 14px;
    border-radius: 999px;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    font-weight: 700;
}
.feature-title {
    font-family: var(--font-display);
    font-size: clamp(32px, 5vw, 48px);
    font-weight: 800;
    color: var(--text);
    line-height: 1.15;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
}
.feature-desc {
    font-size: 15px;
    color: var(--text-secondary);
    line-height: 1.7;
    margin-bottom: 14px;
}

/* Feature image card */
.feature-visual {
    position: relative;
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 1px solid var(--border);
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.3);
    background: var(--surface2);
    aspect-ratio: 16 / 10;
    transition: var(--transition);
}
.feature-visual::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(0, 229, 255, 0.04) 0%, transparent 50%);
    z-index: 1;
    pointer-events: none;
}
.feature-visual:hover {
    transform: translateY(-6px);
    border-color: var(--cyan);
    box-shadow: 0 24px 60px rgba(0, 229, 255, 0.12);
}
.feature-visual img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}
.feature-visual:hover img {
    transform: scale(1.03);
}
    display: block;
    transition: transform 0.6s ease;
}
.feature-visual:hover img { transform: scale(1.03); }
/* Corner chrome decoration */
.feature-visual::after {
    content: '';
    position: absolute;
    top: 10px; left: 10px;
    width: 28px; height: 28px;
    border-top: 2px solid var(--cyan);
    border-left: 2px solid var(--cyan);
    border-radius: 2px;
    opacity: 0.6;
    z-index: 2;
}
.feature-row.accent-orange .feature-visual {
    border-color: rgba(255,152,0,0.25);
    box-shadow: 0 0 0 1px rgba(0,0,0,0.5), 0 24px 60px rgba(0,0,0,0.6), 0 0 40px rgba(255,152,0,0.06);
}

.feature-row.accent-orange .feature-badge { color: var(--pink); background: rgba(255, 60, 172, 0.08); border-color: var(--border); }

/* ─────────────────────────────────────────────────
   CARDS GRID
   ───────────────────────────────────────────────── */
.cards-section {
    padding: var(--section-gap) 0;
    text-align: center;
}
.section-label {
    font-family: var(--font-mono);
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--cyan);
    margin-bottom: 14px;
    font-weight: 700;
}
.section-title {
    font-family: var(--font-display);
    font-size: clamp(36px, 5.5vw, 52px);
    font-weight: 800;
    color: var(--text);
    margin-bottom: 14px;
    letter-spacing: -0.8px;
}
.section-sub {
    font-size: 16px;
    color: var(--text-secondary);
    max-width: 640px;
    margin: 0 auto 60px;
    line-height: 1.65;
}
.cards-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
.info-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 36px 28px;
    text-align: left;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}
.info-card:hover {
    transform: translateY(-6px);
    border-color: var(--cyan);
    background: var(--surface2);
    box-shadow: 0 16px 40px rgba(0, 229, 255, 0.1);
}
.card-icon-wrap {
    width: 50px;
    height: 50px;
    border-radius: var(--radius);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin-bottom: 20px;
    background: rgba(0, 229, 255, 0.08);
    border: 1px solid var(--border);
    transition: var(--transition);
}
.info-card:hover .card-icon-wrap {
    transform: scale(1.08);
    background: rgba(0, 229, 255, 0.12);
}
.info-card h3 {
    font-family: var(--font-display);
    font-size: 19px;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 10px;
    letter-spacing: -0.2px;
}
.info-card p {
    font-size: 14px;
    color: var(--text-secondary);
    line-height: 1.65;
}

/* ─────────────────────────────────────────────────
   PATHS
   ───────────────────────────────────────────────── */
.paths-section { padding: var(--section-gap) 0; }
.paths-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-top: 56px;
}
.path-card {
    background: linear-gradient(135deg, rgba(15, 22, 35, 0.6), rgba(10, 15, 26, 0.4));
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 36px 32px;
    position: relative;
    overflow: hidden;
    transition: var(--transition);
    backdrop-filter: var(--blur);
}
.path-card::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--cyan), var(--pink), transparent);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.5s cubic-bezier(0.23, 1, 0.320, 1);
}
.path-card::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 100% 100% at 50% 50%, rgba(0, 229, 255, 0.05) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
}
.path-card:hover {
    transform: translateY(-12px);
    border-color: var(--cyan);
    background: linear-gradient(135deg, rgba(0, 229, 255, 0.08), rgba(255, 60, 172, 0.04));
    box-shadow: 0 24px 64px var(--cyan-glow), inset 0 0 40px rgba(0, 229, 255, 0.04);
}
.path-card:hover::before { transform: scaleX(1); }
.path-card:hover::after { opacity: 1; }
.path-num {
    font-family: var(--font-mono);
    font-size: 11px;
    color: var(--cyan);
    margin-bottom: 16px;
    display: block;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}
.path-card h4 {
    font-family: var(--font-display);
    font-size: 22px;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 14px;
    line-height: 1.3;
    letter-spacing: -0.3px;
}
.path-card p {
    font-size: 15px;
    color: var(--text-secondary);
    line-height: 1.7;
}

/* ─────────────────────────────────────────────────
   CTA BANNER
   ───────────────────────────────────────────────── */
.cta-banner {
    margin: var(--section-gap) 0;
    padding: 80px 60px;
    background: linear-gradient(135deg, rgba(0, 229, 255, 0.12) 0%, rgba(255, 60, 172, 0.08) 100%);
    border: 1.5px solid var(--border2);
    border-radius: var(--radius-lg);
    text-align: center;
    position: relative;
    overflow: hidden;
    backdrop-filter: var(--blur);
}

.cta-banner::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 100% 100% at 50% 0%, rgba(0, 229, 255, 0.1), transparent 60%);
    pointer-events: none;
}

.cta-banner h2 {
    font-family: var(--font-display);
    font-size: clamp(36px, 5vw, 52px);
    font-weight: 800;
    color: var(--text);
    margin-bottom: 20px;
    position: relative;
    letter-spacing: -0.8px;
    background: linear-gradient(135deg, var(--text) 0%, var(--cyan) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.cta-banner p {
    font-size: 18px;
    color: var(--text-secondary);
    max-width: 620px;
    margin: 0 auto 40px;
    position: relative;
    line-height: 1.7;
}

.cta-banner .hero-actions { position: relative; }


/* ─────────────────────────────────────────────────
   FOOTER
   ───────────────────────────────────────────────── */
.site-footer {
    background: linear-gradient(180deg, var(--bg) 0%, rgba(5, 7, 9, 0.95) 100%);
    border-top: 1px solid var(--border);
    padding: 100px clamp(16px, 4vw, 48px) 48px;
}
.footer-inner {
    max-width: 1440px;
    margin: 0 auto;
}
.footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 64px;
    margin-bottom: 60px;
}
.footer-brand-name {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: 18px;
    margin-bottom: 16px;
    background: linear-gradient(135deg, var(--cyan), var(--pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: -0.5px;
}
.footer-brand-desc {
    font-size: 15px;
    color: var(--text-secondary);
    max-width: 300px;
    line-height: 1.7;
}
.footer-col h5 {
    font-family: var(--font-body);
    font-size: 13px;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 24px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.footer-col ul { list-style: none; }
.footer-col ul li { margin-bottom: 14px; }
.footer-col ul li a {
    font-size: 15px;
    color: var(--text-secondary);
    transition: var(--transition);
    position: relative;
}
.footer-col ul li a::before {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 1px;
    background: var(--cyan);
    transition: width 0.3s ease;
}
.footer-col ul li a:hover {
    color: var(--cyan);
}
.footer-col ul li a:hover::before {
    width: 100%;
}
.footer-bottom {
    border-top: 1px solid var(--border);
    padding-top: 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    font-size: 14px;
    color: var(--text-muted);
}

/* ─────────────────────────────────────────────────
   MOBILE STICKY CTA
   ───────────────────────────────────────────────── */
.mobile-cta {
    display: none;
    position: fixed;
    bottom: 24px; left: 50%;
    transform: translateX(-50%);
    z-index: 90;
    background: linear-gradient(135deg, var(--cyan), var(--pink));
    color: var(--bg);
    font-family: var(--font-body);
    font-size: 15px;
    font-weight: 700;
    padding: 14px 40px;
    border-radius: 999px;
    box-shadow: 0 12px 40px var(--cyan-glow), 0 0 20px var(--pink-glow);
    white-space: nowrap;
    letter-spacing: 0.3px;
    transition: var(--transition);
}
.mobile-cta:hover {
    transform: translateX(-50%) translateY(-3px);
    box-shadow: 0 16px 56px var(--cyan-glow), 0 0 32px var(--pink-glow);
}

/* ─────────────────────────────────────────────────
   MATERIA MODAL
   ───────────────────────────────────────────────── */
.materia-modal {
    display: none;
    position: fixed; inset: 0;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.8), rgba(0, 229, 255, 0.05));
    z-index: 9999;
    align-items: center;
    justify-content: center;
    backdrop-filter: var(--blur);
}
.materia-modal-card {
    background: linear-gradient(135deg, var(--surface3), var(--surface2));
    border: 1.5px solid var(--border2);
    border-radius: var(--radius-lg);
    padding: 48px;
    max-width: 560px; width: 90%;
    text-align: center;
    box-shadow: 0 32px 96px rgba(0, 0, 0, 0.6), inset 0 0 40px rgba(0, 229, 255, 0.05);
}
.materia-modal-card h2 {
    font-family: var(--font-display);
    font-size: 32px;
    font-weight: 800;
    background: linear-gradient(135deg, var(--cyan), var(--pink));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 12px;
    letter-spacing: -0.5px;
}
.materia-modal-card p {
    font-size: 16px;
    color: var(--text-secondary);
    margin-bottom: 32px;
    line-height: 1.6;
}
.materia-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 24px; }
.materia-btn {
    background: linear-gradient(135deg, rgba(0, 229, 255, 0.08), rgba(255, 60, 172, 0.04));
    border: 1.5px solid var(--border);
    color: var(--text);
    padding: 14px 12px;
    border-radius: var(--radius);
    font-size: 14px;
    font-family: var(--font-body);
    font-weight: 600;
    transition: var(--transition);
    cursor: pointer;
}
.materia-btn:hover {
    border-color: var(--cyan);
    background: linear-gradient(135deg, rgba(0, 229, 255, 0.15), rgba(255, 60, 172, 0.08));
    color: var(--cyan);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px var(--cyan-glow);
}
.materia-btn.selected {
    background: linear-gradient(135deg, var(--cyan), var(--pink));
    color: var(--bg);
    border-color: transparent;
    font-weight: 700;
    box-shadow: 0 8px 24px var(--cyan-glow);
}
.materia-modal-card .submit-btn {
    width: 100%; padding: 16px;
    background: linear-gradient(135deg, var(--cyan), var(--pink));
    color: var(--bg);
    border: none;
    border-radius: var(--radius);
    font-family: var(--font-body);
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 8px 24px var(--cyan-glow);
}
.materia-modal-card .submit-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 12px 40px var(--cyan-glow), 0 0 20px var(--pink-glow);
}
.materia-modal-card .submit-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

/* ─────────────────────────────────────────────────
   ANIMATIONS
   ───────────────────────────────────────────────── */
@keyframes fadeDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ─────────────────────────────────────────────────
   RESPONSIVE
   ───────────────────────────────────────────────── */
@media (max-width: 1200px) {
    .footer-grid { grid-template-columns: 2fr 1fr 1fr; }
}

@media (max-width: 1024px) {
    .feature-row { grid-template-columns: 1fr; gap: 48px; }
    .feature-row.reverse { direction: ltr; }
    .cards-grid, .paths-grid { grid-template-columns: 1fr 1fr; gap: 20px; }
    .footer-grid { grid-template-columns: 1fr 1fr; gap: 48px; }
    .hero-stats { gap: 32px; padding: 32px 40px; flex-wrap: wrap; }
}

@media (max-width: 768px) {
    .header-inner { height: 56px; }
    .site-header { padding: 0 20px; }
    .hero { margin-top: 56px; padding: 40px 20px; }
    .hero-stats { gap: 24px; padding: 24px 20px; }
    .cards-grid { grid-template-columns: 1fr; gap: 16px; }
    .paths-grid { grid-template-columns: 1fr; gap: 16px; }
    .footer-grid { grid-template-columns: 1fr; gap: 40px; }
    .cta-banner { padding: 48px 28px; }
    .header-inner { height: auto; gap: 10px; flex-wrap: wrap; }
    .header-nav { width: 100%; display: flex; flex-wrap: wrap; gap: 8px; justify-content: flex-end; overflow-x: auto; padding-bottom: 8px; }
    .header-nav .nav-btn { flex: 0 0 auto; white-space: nowrap; }
    .mobile-cta { display: block; }
    .hamburger { display: none; }
    .hero-actions { flex-direction: column; width: 100%; }
    .cta-btn { width: 100%; }
    .materia-modal-card { padding: 32px; }
}
</style>
</head>
<body>

<!-- Background effects -->
<div class="grid-bg"></div>
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>

<!-- ═══════════════ HEADER ═══════════════ -->
<header class="site-header" id="siteHeader">
    <div class="header-inner">
        <a class="header-brand" href="<?= $baseUrl ?>/">
            <span class="brand-icon">🎮</span>
            <span class="brand-name">LC-ADVANCE</span>
        </a>

        <nav class="header-nav">
            <?php if ($usuario_logueado): ?>
                <a href="<?= $baseUrl ?>/public/dashboard.php" class="nav-btn"><?= $t[$lang]['nav_dashboard'] ?></a>
                <a href="public/coding_challenges.php" class="nav-btn"><?= $t[$lang]['coding_lab'] ?></a>
                <a href="public/logout.php" class="nav-btn"><?= $t[$lang]['nav_logout'] ?></a>
            <?php else: ?>
                <a href="<?= $baseUrl ?>/public/login.php" class="nav-btn"><?= $t[$lang]['nav_login'] ?></a>
                <a href="<?= $baseUrl ?>/public/register.php" class="nav-btn nav-btn-primary"><?= $t[$lang]['nav_register'] ?></a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<!-- ═══════════════ HERO ═══════════════ -->
<section class="hero">
    <div class="hero-content wrap">
        <p class="hero-eyebrow">Plataforma Educativa Gamificada · DGETI 2026</p>

        <h1 class="hero-title">
            <?= $usuario_logueado
                ? htmlspecialchars($t[$lang]['hero_title_logged'])
                : htmlspecialchars($t[$lang]['hero_title_guest']) ?>
        </h1>

        <p class="hero-subtitle">
            <?= $usuario_logueado
                ? htmlspecialchars($t[$lang]['hero_sub_logged'])
                : htmlspecialchars($t[$lang]['hero_sub_guest']) ?>
        </p>

        <div class="hero-actions">
            <?php if ($usuario_logueado): ?>
                <a href="<?= $baseUrl ?>/public/mapa/index.php" class="cta-btn cta-primary">🗺 <?= $t[$lang]['cta_map'] ?></a>
                <a href="<?= $baseUrl ?>/public/dashboard.php" class="cta-btn cta-secondary">📊 <?= $t[$lang]['nav_dashboard'] ?></a>
            <?php else: ?>
                <a href="<?= $baseUrl ?>/public/register.php" class="cta-btn cta-primary">⚡ <?= $t[$lang]['hero_start'] ?></a>
                <a href="public/guest_login.php" class="cta-btn cta-secondary">👤 <?= $t[$lang]['hero_guest'] ?></a>
            <?php endif; ?>
        </div>

        <div class="hero-stats">
            <div class="stat-item">
                <span class="stat-value">200+</span>
                <span class="stat-label">Lecciones</span>
            </div>
            <div class="stat-item">
                <span class="stat-value">1000+</span>
                <span class="stat-label">Preguntas</span>
            </div>
            <div class="stat-item">
                <span class="stat-value">6</span>
                <span class="stat-label">Materias</span>
            </div>
            <div class="stat-item">
                <span class="stat-value">FREE</span>
                <span class="stat-label">Acceso</span>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════ FEATURES ═══════════════ -->
<div class="wrap features-wrap">

    <!-- Mapa -->
    <div class="feature-row js-reveal">
        <div class="feature-text">
            <span class="feature-badge">🗺 Exploración Interactiva</span>
            <h2 class="feature-title">Explora el Campus Virtual</h2>
            <p class="feature-desc">Navega por un mundo pixelado donde cada edificio representa un área del conocimiento. Habla con maestros, interactúa con el entorno y desbloquea secretos.</p>
            <p class="feature-desc" style="color:var(--text-muted); font-size:17px;">Un entorno inmersivo diseñado para que el aprendizaje se sienta como un RPG clásico.</p>
        </div>
        <div class="feature-visual">
            <img src="public/assets/img/map.gif" alt="Campus virtual — mapa interactivo">
        </div>
    </div>

    <!-- Lecciones -->
    <div class="feature-row reverse js-reveal">
        <div class="feature-text">
            <span class="feature-badge">📚 Contenido Premium</span>
            <h2 class="feature-title">Aprendizaje Adaptativo</h2>
            <p class="feature-desc">Desde C# y Python hasta desarrollo web moderno. Lecciones adaptativas con retroalimentación en tiempo real y contenido estructurado por semestres.</p>
            <p class="feature-desc" style="color:var(--text-muted); font-size:17px;">Sigue el plan de estudios oficial DGETI 2025 con herramientas modernas.</p>
        </div>
        <div class="feature-visual">
            <img src="public/assets/img/dashboard.png" alt="Sistema de lecciones adaptativas">
        </div>
    </div>

    <!-- Duelos -->
    <div class="feature-row accent-orange js-reveal">
        <div class="feature-text">
            <span class="feature-badge">⚔ Gamificación Avanzada</span>
            <h2 class="feature-title">Duelos de Conocimiento</h2>
            <p class="feature-desc">Los exámenes se convierten en épicos enfrentamientos. Enfrenta a los maestros en combate por turnos donde tu arma es el código correcto.</p>
            <p class="feature-desc" style="color:var(--text-muted); font-size:17px;">Gana experiencia, sube de nivel y colecciona insignias que demuestren tu valía.</p>
        </div>
        <div class="feature-visual">
            <img src="public/assets/img/systemC.gif" alt="Sistema de duelos y combate">
        </div>
    </div>

</div>

<!-- ═══════════════ CARDS ═══════════════ -->
<section class="cards-section">
    <div class="wrap">
        <p class="section-label">Características</p>
        <h2 class="section-title">Todo lo que necesitas para aprender</h2>
        <p class="section-sub">Una plataforma completa diseñada para el estudiante moderno.</p>
        <div class="cards-grid">
            <div class="info-card">
                <div class="card-icon-wrap">🏆</div>
                <h3><?= htmlspecialchars($t[$lang]['cards_rank_title']) ?></h3>
                <p><?= htmlspecialchars($t[$lang]['cards_rank_desc']) ?></p>
            </div>
            <div class="info-card">
                <div class="card-icon-wrap">⚡</div>
                <h3><?= htmlspecialchars($t[$lang]['cards_progress_title']) ?></h3>
                <p><?= htmlspecialchars($t[$lang]['cards_progress_desc']) ?></p>
            </div>
            <div class="info-card">
                <div class="card-icon-wrap">🎯</div>
                <h3><?= htmlspecialchars($t[$lang]['cards_analytics_title']) ?></h3>
                <p><?= htmlspecialchars($t[$lang]['cards_analytics_desc']) ?></p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════ PATHS ═══════════════ -->
<section class="paths-section">
    <div class="wrap">
        <p class="section-label">Rutas de Aprendizaje</p>
        <h2 class="section-title"><?= htmlspecialchars($t[$lang]['paths_title']) ?></h2>
        <p class="section-sub"><?= htmlspecialchars($t[$lang]['paths_sub']) ?></p>
        <div class="paths-grid">
            <div class="path-card">
                <span class="path-num">RUTA 01</span>
                <h4><?= htmlspecialchars($t[$lang]['path_1_title']) ?></h4>
                <p><?= htmlspecialchars($t[$lang]['path_1_desc']) ?></p>
            </div>
            <div class="path-card">
                <span class="path-num">RUTA 02</span>
                <h4><?= htmlspecialchars($t[$lang]['path_2_title']) ?></h4>
                <p><?= htmlspecialchars($t[$lang]['path_2_desc']) ?></p>
            </div>
            <div class="path-card">
                <span class="path-num">RUTA 03</span>
                <h4><?= htmlspecialchars($t[$lang]['path_3_title']) ?></h4>
                <p><?= htmlspecialchars($t[$lang]['path_3_desc']) ?></p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════ CTA BANNER ═══════════════ -->
<div class="wrap">
    <div class="cta-banner">
        <h2>¿Listo para comenzar tu aventura?</h2>
        <p>Únete a estudiantes que ya están transformando su educación con LC-ADVANCE.</p>
        <div class="hero-actions">
            <?php if ($usuario_logueado): ?>
                <a href="<?= $baseUrl ?>/public/mapa/index.php" class="cta-btn cta-primary">🗺 <?= $t[$lang]['cta_map'] ?></a>
            <?php else: ?>
                <a href="<?= $baseUrl ?>/public/register.php" class="cta-btn cta-primary">⚡ Registrarse Gratis</a>
                <a href="public/guest_login.php" class="cta-btn cta-secondary">👤 <?= $t[$lang]['hero_guest'] ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- ═══════════════ FOOTER ═══════════════ -->
<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-grid">
            <div>
                <p class="footer-brand-name">🎮 LC-ADVANCE</p>
                <p class="footer-brand-desc">Plataforma educativa gamificada para estudiantes DGETI. Aprende, compite y crece.</p>
            </div>
            <div class="footer-col">
                <h5>Producto</h5>
                <ul>
                    <?php if ($usuario_logueado): ?>
                        <li><a href="<?= $baseUrl ?>/public/mapa/index.php">Mapa Interactivo</a></li>
                        <li><a href="<?= $baseUrl ?>/public/dashboard.php">Dashboard</a></li>
                        <li><a href="<?= $baseUrl ?>/public/ranking.php">Ranking Global</a></li>
                    <?php else: ?>
                        <li><a href="<?= $baseUrl ?>/public/gatekeeper.php?redirect=mapa/index.php">Mapa Interactivo</a></li>
                        <li><a href="<?= $baseUrl ?>/public/gatekeeper.php?redirect=dashboard.php">Dashboard</a></li>
                        <li><a href="<?= $baseUrl ?>/public/gatekeeper.php?redirect=ranking.php">Ranking Global</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Recursos</h5>
                <ul>
                    <li><a href="<?= $baseUrl ?>/public/docs.php?file=README.md">Documentación</a></li>
                    <li><a href="<?= $baseUrl ?>/public/docs.php?file=DEVELOPMENT.md">Desarrollo</a></li>
                    <li><a href="<?= $baseUrl ?>/public/docs.php?file=API.md">API Reference</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Comunidad</h5>
                <ul>
                    <li><a href="https://github.com/cervanlfc7/LC-ADVANCE" target="_blank">GitHub</a></li>
                    <li><a href="mailto:lcadvance40@gmail.com">Soporte</a></li>
                    <li><a href="<?= $baseUrl ?>/public/register.php">Registrarse</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© 2025–2026 LC-ADVANCE · Todos los derechos reservados.</span>
            <span>Hecho con 💚 para estudiantes de DGETI</span>
        </div>
    </div>
</footer>

<!-- Mobile sticky CTA -->
<a class="mobile-cta" href="<?= $usuario_logueado ? $baseUrl.'/public/dashboard.php' : $baseUrl.'/public/register.php' ?>">
    <?= htmlspecialchars($t[$lang]['mobile_cta']) ?>
</a>

<!-- ═══════════════ MATERIA MODAL ═══════════════ -->
<?php if (!empty($_GET['seleccionar_materia'])): ?>
<?php
$todas_materias = [
    'Ciencias Sociales',
    'Ecosistemas',
    'Física I',
    'Historia de México',
    'Inglés',
    'Pensamiento Matemático III',
    'Programación',
    'Química I',
    'Temas Selectos de Matemáticas I y II',
];
?>
<div id="materiaModal" class="materia-modal" style="display:flex;">
    <div class="materia-modal-card">
        <h2>📚 <?= htmlspecialchars($t[$lang]['select_materia_title']) ?></h2>
        <p><?= htmlspecialchars($t[$lang]['select_materia_sub']) ?></p>
        <form method="get" action="<?= $baseUrl ?>/public/dashboard.php">
            <input type="hidden" name="materia" id="selectedMateriaInput" value="">
            <div class="materia-grid">
                <?php foreach ($todas_materias as $m): ?>
                    <button type="button" class="materia-btn"
                        data-materia="<?= htmlspecialchars($m) ?>"
                        onclick="selectMateria(this, '<?= htmlspecialchars(addslashes($m)) ?>')">
                        <?= htmlspecialchars($m) ?>
                    </button>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="submit-btn" id="materiaContinueBtn" disabled>
                <?= htmlspecialchars($t[$lang]['select_materia_btn']) ?>
            </button>
        </form>
    </div>
</div>
<script>
function selectMateria(btn, materia) {
    document.querySelectorAll('.materia-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    document.getElementById('selectedMateriaInput').value = materia;
    document.getElementById('materiaContinueBtn').disabled = false;
}
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('materiaModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) modal.style.display = 'none';
        });
    }
});
</script>
<?php endif; ?>

<script>
// ── Scroll-triggered reveal ──────────────────────
(function() {
    var els = document.querySelectorAll('.js-reveal');
    if (!('IntersectionObserver' in window)) {
        els.forEach(function(el) { el.classList.add('visible'); });
        return;
    }
    var obs = new IntersectionObserver(function(entries) {
        entries.forEach(function(e) {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    els.forEach(function(el) { obs.observe(el); });
})();

// ── Header shrink on scroll ──────────────────────
(function() {
    var header = document.getElementById('siteHeader');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 60) {
            header.style.background = 'rgba(5,5,8,0.92)';
            header.style.borderBottomColor = 'rgba(255,204,0,0.10)';
        } else {
            header.style.background = 'rgba(5,5,8,0.70)';
            header.style.borderBottomColor = 'rgba(255,204,0,0.18)';
        }
    }, { passive: true });
})();
</script>

</body>
</html>