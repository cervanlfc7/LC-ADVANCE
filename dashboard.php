<?php
// ==========================================
// LC-ADVANCE - dashboard.php (Rediseño Premium)
// ==========================================
require_once 'config/config.php';
requireLogin(true);
require_once 'src/content.php';


// Determinar profesor/materia por defecto según usuario si no hay filtro
$filter_profesor = isset($_GET['profesor']) ? trim($_GET['profesor']) : null;
$filter_materia = null;

if (!$filter_profesor && !$filter_materia) {
    // Si el usuario tiene materia/profesor asignado, usarlo
    // Ejemplo: por nivel, asignar materia/profesor
    $nivel = $usuario['nivel'] ?? 1;
    $materia_por_nivel = [
        1 => 'Temas Selectos de Matemáticas I y II',
        2 => 'Inglés',
        3 => 'Pensamiento Matemático III',
        4 => 'Programación',
        5 => 'Física I',
        6 => 'Química I',
        7 => 'Ecosistemas',
        8 => 'Ciencias Sociales',
        9 => 'Historia de México'
    ];
    $profesor_por_nivel = [
        1 => 'Miguel Marquez',
        2 => 'Enrique',
        3 => 'Espindola',
        4 => 'Manuel',
        5 => 'Herson',
        6 => 'Herson',
        7 => 'Carolina',
        8 => 'Refugio & Padilla',
        9 => 'Armando'
    ];
    $filter_materia = $materia_por_nivel[$nivel] ?? null;
    $filter_profesor = $profesor_por_nivel[$nivel] ?? null;
}

if ($filter_profesor) {
    $filter_materia = isset($_GET['materia']) ? trim($_GET['materia']) : null;
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
    $stmt->execute([(int)($_SESSION['usuario_id'] ?? 0)]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        session_destroy();
        header('Location: login.php');
        exit;
    }
}

$puntos_por_nivel = 500;
$puntos_necesarios = ($usuario['nivel'] + 1) * $puntos_por_nivel;
$puntos_base = $usuario['nivel'] * $puntos_por_nivel;
$progreso = max(0, min(100, (($usuario['puntos'] - $puntos_base) / $puntos_por_nivel) * 100));

$badges = [];
if ($usuario['puntos'] >= 500) $badges[] = ['nombre'=>'Novato','tipo'=>'bronze', 'icon' => '🥉'];
if ($usuario['puntos'] >= 1000) $badges[] = ['nombre'=>'Explorador','tipo'=>'silver', 'icon' => '🥈'];
if ($usuario['puntos'] >= 2000) $badges[] = ['nombre'=>'Élite','tipo'=>'gold', 'icon' => '🥇'];

// ------------------ FILTRADO POR PROFESOR ------------------
function norm($s){
    return mb_strtolower(trim(strtr($s,[
        'á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n','&'=>'y'
    ])), 'UTF-8');
}

$profesor_materia_map = [
    'Miguel Marquez' => ['Temas Selectos de Matemáticas I y II'],
    'Enrique' => ['Inglés'],
    'Espindola' => ['Pensamiento Matemático III'],
    'Manuel' => ['Programación'],
    'Meza' => ['Programación'],
    'Herson' => ['Física I','Química I'],
    'Carolina' => ['Ecosistemas'],
    'Refugio & Padilla' => ['Ciencias Sociales'],
    'Armando' => ['Historia de México']
];

$materia_a_profesor_id = [
    'Temas Selectos de Matemáticas I y II' => '1Le',
    'Inglés'                               => '1Go',
    'Pensamiento Matemático III'           => '1Es',
    'Programación'                         => '1Ma',
    'Física I'                             => '1He',
    'Química I'                            => '1He',
    'Ecosistemas'                          => '1Ca',
    'Ciencias Sociales'                    => '1Pa',
    'Historia de México'                   => '1Ar',
];

$profesor_a_id = [
    'Miguel Marquez'    => '1Le',
    'Enrique'           => '1Go',
    'Espindola'         => '1Es',
    'Manuel'            => '1Ma',
    'Meza'              => '1Me',
    'Herson'            => '1He',
    'Carolina'          => '1Ca',
    'Refugio & Padilla' => '1Pa',
    'Armando'           => '1Ar'
];

$filter_materias = [];
if ($filter_materia) {
    $filter_materias[] = $filter_materia;
} elseif ($filter_profesor) {
    $nf = norm($filter_profesor);
    foreach ($profesor_materia_map as $prof => $mats) {
        $np = norm($prof);
        if ($np === $nf || strpos($np, $nf) !== false || strpos($nf, $np) !== false) {
            $filter_materias = $mats;
            break;
        }
    }
}

$lecciones_agrupadas = [];
$seen_slugs = [];

foreach ($lecciones as $le) {
    $slug = $le['slug'] ?? null;
    if ($slug !== null) {
        if (isset($seen_slugs[$slug])) continue;
        $seen_slugs[$slug] = true;
    }
    $m = $le['materia'] ?? 'Sin Materia';
    
    // Aplicar filtro si existe
    if (!empty($filter_materias)) {
        $match = false;
        foreach ($filter_materias as $fm) {
            if (norm($m) === norm($fm)) {
                $match = true;
                break;
            }
        }
        if (!$match) continue;
    }
    
    $lecciones_agrupadas[$m][] = $le;
}

$completadas = [];
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
    <title>Dashboard | LC-ADVANCE</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <style>
        :root {
            --accent-glow: 0 0 30px rgba(0, 255, 255, 0.3);
            --card-bg: rgba(20, 20, 25, 0.7);
            --glass-bg: rgba(255, 255, 255, 0.03);
            --border-glass: rgba(255, 255, 255, 0.1);
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            --neon-cyan: #00ffff;
            --neon-pink: #ff00ff;
            --neon-yellow: #ffff00;
            --neon-green: #39ff14;
        }

        body {
            background-color: #050508;
            color: #fff;
            font-family: 'Roboto Mono', monospace;
            overflow-x: hidden;
        }

        .grid-bg {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: 
                linear-gradient(rgba(0, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: -1;
            mask-image: radial-gradient(circle at center, black, transparent 85%);
            animation: gridMove 25s linear infinite;
        }

        @keyframes gridMove {
            from { background-position: 0 0; }
            to { background-position: 0 60px; }
        }

        .header {
            background: rgba(0, 0, 0, 0.8) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-glass) !important;
            padding: 15px 30px !important;
        }

        .header h1 {
            font-family: 'Press Start 2P', cursive;
            font-size: 14px;
            color: #fff;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
        }

        /* Profile Section */
        .profile-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-glass);
            border-radius: 24px;
            padding: 30px;
            height: fit-content;
            position: sticky;
            top: 100px;
            max-height: calc(100vh - 140px);
            overflow-y: auto;
        }

        /* Estilo de scrollbar para la sidebar */
        .profile-card::-webkit-scrollbar {
            width: 4px;
        }
        .profile-card::-webkit-scrollbar-track {
            background: transparent;
        }
        .profile-card::-webkit-scrollbar-thumb {
            background: var(--border-glass);
            border-radius: 10px;
        }
        .profile-card::-webkit-scrollbar-thumb:hover {
            background: var(--neon-cyan);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .avatar-glow {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, var(--neon-cyan), var(--neon-pink));
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex; align-items: center; justify-content: center;
            font-size: 32px;
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.3);
        }

        .username-premium {
            font-family: 'Orbitron', sans-serif;
            font-size: 18px;
            color: var(--neon-cyan);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-box {
            background: var(--glass-bg);
            border: 1px solid var(--border-glass);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 15px;
            text-align: center;
        }

        .stat-label {
            font-family: 'Press Start 2P', cursive;
            font-size: 8px;
            color: rgba(255, 255, 255, 0.4);
            margin-bottom: 10px;
            display: block;
        }

        .stat-value {
            font-family: 'Orbitron', sans-serif;
            font-size: 24px;
            color: #fff;
        }

        .progress-container {
            margin-top: 25px;
        }

        .progress-bar-premium {
            height: 8px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 4px;
            overflow: hidden;
            margin: 10px 0;
        }

        .progress-fill-premium {
            height: 100%;
            background: linear-gradient(90deg, var(--neon-cyan), var(--neon-pink));
            box-shadow: 0 0 15px var(--neon-cyan);
            transition: width 1s ease;
        }

        /* Search Bar */
        .search-container {
            margin-bottom: 30px;
            position: relative;
            animation: fadeInDown 0.8s ease-out;
        }

        .search-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-glass);
            border-radius: 12px;
            padding: 15px 20px 15px 50px;
            color: #fff;
            font-family: 'Roboto Mono', monospace;
            font-size: 16px;
            transition: all 0.3s ease;
            outline: none;
        }

        .search-input:focus {
            border-color: var(--neon-cyan);
            background: rgba(0, 255, 255, 0.05);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 20px;
            color: var(--neon-cyan);
            font-size: 18px;
            pointer-events: none;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Área de Lecciones */
        .lessons-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .materia-group {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-glass);
            border-radius: 24px;
            padding: 30px;
        }

        .materia-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 20px;
            color: var(--neon-pink);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .materia-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, var(--neon-pink), transparent);
        }

        .leccion-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 15px;
        }

        .leccion-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-glass);
            border-radius: 16px;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 20px;
            transition: var(--transition-smooth);
            text-decoration: none;
            color: inherit;
            min-height: 120px;
            height: auto;
            position: relative;
            overflow: hidden;
        }

        .leccion-info {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            min-width: 0; /* Crucial para evitar desbordamiento en grid/flex */
        }

        .leccion-status {
            font-size: 20px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .leccion-name {
            font-family: 'Orbitron', sans-serif; /* Cambiado a una fuente más legible y moderna */
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            line-height: 1.5;
            margin: 0;
            word-break: break-word;
            overflow-wrap: break-word;
            display: block;
        }

        .leccion-action {
            font-family: 'Press Start 2P', cursive;
            font-size: 8px;
            color: var(--neon-cyan);
            background: rgba(0, 255, 255, 0.1);
            border: 1px solid var(--neon-cyan);
            padding: 10px 15px;
            border-radius: 8px;
            text-transform: uppercase;
            white-space: nowrap;
            flex-shrink: 0;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .leccion-card:hover {
            border-color: var(--neon-cyan);
            transform: translateY(-5px);
            background: rgba(0, 255, 255, 0.05);
            box-shadow: 0 10px 30px rgba(0, 255, 255, 0.1);
        }

        .leccion-card:hover .leccion-action {
            background: var(--neon-cyan);
            color: #000;
            box-shadow: 0 0 20px var(--neon-cyan);
        }

        .leccion-card.completed {
            border-color: rgba(57, 255, 20, 0.2);
        }

        .leccion-card.completed .leccion-name {
            color: var(--neon-green);
        }

        .btn-premium {
            padding: 12px 24px;
            font-family: 'Press Start 2P', cursive;
            font-size: 9px;
            border-radius: 10px;
            text-transform: uppercase;
            transition: var(--transition-smooth);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
        }

        .btn-cyan {
            background: var(--neon-cyan);
            color: #000;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.2);
        }

        .btn-cyan:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.4);
        }

        .badge-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .badge-item {
            padding: 8px 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-glass);
            border-radius: 8px;
            font-size: 11px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge-item.gold { border-color: var(--neon-yellow); color: var(--neon-yellow); }
        .badge-item.silver { border-color: #ccc; color: #ccc; }
        .badge-item.bronze { border-color: #cd7f32; color: #cd7f32; }

        @media (max-width: 992px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            .profile-card {
                position: relative;
                top: 0;
            }
        }
    </style>
</head>
<body>

<div class="grid-bg"></div>

<header class="header">
    <div style="display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; width: 100%;">
        <h1>LC-ADVANCE <span style="color: var(--neon-green); font-size: 10px; margin-left: 10px;">// SYSTEM_DASHBOARD</span></h1>
        <nav style="display: flex; gap: 15px;">
            <a href="index.php" class="btn-premium" style="color: #fff; font-size: 8px;">Inicio</a>
            <a href="mapa/index.php" class="btn-premium btn-cyan">Ir al Mapa</a>
            <a href="logout.php" class="btn-premium" style="color: var(--neon-pink); font-size: 8px;">Cerrar Sesión</a>
        </nav>
    </div>
</header>

<main class="container">
    <div class="dashboard-grid">
        
        <!-- Sidebar Perfil -->
        <aside class="profile-card">
            <div class="profile-header">
                <div class="avatar-glow">🎮</div>
                <h2 class="username-premium"><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></h2>
            </div>

            <div class="stat-box">
                <span class="stat-label">NIVEL ACTUAL</span>
                <span class="stat-value"><?php echo $usuario['nivel']; ?></span>
            </div>

            <div class="stat-box">
                <span class="stat-label">PUNTOS XP</span>
                <span class="stat-value"><?php echo number_format($usuario['puntos']); ?></span>
            </div>

            <div class="progress-container">
                <div style="display: flex; justify-content: space-between; font-size: 10px; color: rgba(255,255,255,0.5);">
                    <span>PROGRESO NIVEL <?php echo $usuario['nivel'] + 1; ?></span>
                    <span><?php echo round($progreso); ?>%</span>
                </div>
                <div class="progress-bar-premium">
                    <div class="progress-fill-premium" style="width: <?php echo $progreso; ?>%;"></div>
                </div>
                <div style="text-align: center; font-size: 11px; color: var(--neon-yellow); margin-top: 10px;">
                    <?php echo $puntos_necesarios - $usuario['puntos']; ?> XP para subir
                </div>
            </div>

            <div style="margin-top: 30px;">
                <span class="stat-label" style="text-align: left;">LOGROS DESBLOQUEADOS</span>
                <div class="badge-list">
                    <?php if (empty($badges)): ?>
                        <p style="font-size: 11px; color: rgba(255,255,255,0.3);">No hay insignias aún.</p>
                    <?php else: ?>
                        <?php foreach ($badges as $b): ?>
                            <div class="badge-item <?php echo $b['tipo']; ?>">
                                <span><?php echo $b['icon']; ?></span>
                                <span><?php echo $b['nombre']; ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <div style="margin-top: 30px;">
                <a href="ranking.php" class="btn-premium btn-secondary" style="width: 100%; border: 1px solid var(--border-glass); color: #fff; box-sizing: border-box;">Ver Ranking Global</a>
            </div>
        </aside>

        <!-- Área de Lecciones -->
        <section class="lessons-container">
            <div class="search-container">
                <div class="search-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="lessonSearch" class="search-input" placeholder="Buscar lección por título o tema..." autocomplete="off">
                </div>
            </div>

            <div id="filter-and-combat-area">
                <?php if ($filter_profesor): ?>
                    <div class="materia-group" style="border-color: var(--neon-cyan); background: rgba(0, 255, 255, 0.05); padding: 15px 25px;">
                        <p style="margin: 0; font-family: 'Press Start 2P', cursive; font-size: 10px; color: var(--neon-cyan);">
                            👨‍🏫 Filtrado por Profesor: <?php echo htmlspecialchars($filter_profesor); ?>
                            <a href="dashboard.php" style="margin-left: 20px; color: #fff; text-decoration: underline; font-size: 8px;">Quitar filtro</a>
                        </p>
                    </div>
                <?php endif; ?>

                <?php if ($filter_materia || !empty($filter_materias)): ?>
                    <?php
                    $id_profesor_final = '1Cu'; // fallback
                    $materia_usada = $filter_materia ?: ($filter_materias[0] ?? 'General');

                    if ($filter_profesor) {
                        $nf = norm($filter_profesor);
                        foreach ($profesor_a_id as $prof => $id) {
                            if (norm($prof) === $nf || strpos(norm($prof), $nf) !== false || strpos($nf, norm($prof)) !== false) {
                                $id_profesor_final = $id;
                                break;
                            }
                        }
                    } else {
                        $materia_norm = norm($materia_usada);
                        foreach ($materia_a_profesor_id as $mat_map => $id) {
                            if (norm($mat_map) === $materia_norm || str_contains($materia_norm, norm($mat_map))) {
                                $id_profesor_final = $id;
                                break;
                            }
                        }
                    }
                    ?>
                    <div class="materia-group" style="text-align: center; border-color: var(--neon-yellow); background: rgba(255, 255, 0, 0.05);">
                        <h3 class="materia-title" style="color: var(--neon-yellow); justify-content: center;">⚔️ SISTEMA DE COMBATE</h3>
                        <p style="margin-bottom: 20px; font-size: 14px;">¿Estás listo para el examen? Enfrenta al profesor y demuestra tus conocimientos.</p>
                        <?php 
                            $current_url = urlencode($_SERVER['REQUEST_URI']);
                            $examen_slug = "examen_final_" . norm($materia_usada);
                        ?>
                        <a href="Examen/sistemC.php?personaje=<?= $id_profesor_final ?>&dialogo=1&pregunta=0&return_url=<?= $current_url ?>&slug=<?= $examen_slug ?>" class="btn-premium btn-cyan" style="background: var(--neon-yellow); box-shadow: 0 0 20px rgba(255, 255, 0, 0.3);">
                            INICIAR EXAMEN
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (empty($lecciones_agrupadas)): ?>
                <div class="materia-group">
                    <p style="text-align: center; color: rgba(255,255,255,0.5);">No hay módulos disponibles para esta selección.</p>
                </div>
            <?php else: ?>
                <?php foreach ($lecciones_agrupadas as $materia => $temas): ?>
                    <div class="materia-group">
                        <h3 class="materia-title"><?php echo htmlspecialchars($materia); ?></h3>
                        <div class="leccion-grid">
                            <?php foreach ($temas as $tema): 
                                $es_completada = in_array($tema['slug'], $completadas);
                                $href = 'leccion_detalle.php?slug=' . urlencode($tema['slug']) . '&materia=' . urlencode($materia);
                                if ($filter_profesor) $href .= '&profesor=' . urlencode($filter_profesor);
                            ?>
                                <a href="<?php echo $href; ?>" class="leccion-card <?php echo $es_completada ? 'completed' : ''; ?>">
                                    <div class="leccion-info">
                                        <span class="leccion-status"><?php echo $es_completada ? '✅' : '▶️'; ?></span>
                                        <span class="leccion-name"><?php echo htmlspecialchars($tema['titulo']); ?></span>
                                    </div>
                                    <span class="leccion-action">
                                        <?php echo $es_completada ? 'REPETIR' : 'ENTRAR'; ?>
                                    </span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

    </div>
</main>

<script src="assets/js/app.js"></script>
<script>
    // Scroll reveal logic
    const observerOptions = {
        threshold: 0.1,
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

    document.querySelectorAll('.materia-group').forEach(el => {
        el.style.opacity = "0";
        el.style.transform = "translateY(30px)";
        el.style.transition = "var(--transition-smooth)";
        observer.observe(el);
    });

    // Search functionality
    const searchInput = document.getElementById('lessonSearch');
    const materiaGroups = document.querySelectorAll('.materia-group');
    const combatArea = document.getElementById('filter-and-combat-area');

    searchInput.addEventListener('input', (e) => {
        const term = e.target.value.toLowerCase().trim();
        
        // El área de combate y filtros NO debe desaparecer si hay un término de búsqueda,
        // a menos que el usuario lo prefiera. Según tu petición, debe mantenerse.
        if (term !== "") {
            combatArea.style.opacity = "0.5"; // Lo atenuamos un poco para dar foco a los resultados
            combatArea.style.pointerEvents = "none"; // Evitamos clics accidentales durante búsqueda
        } else {
            combatArea.style.opacity = "1";
            combatArea.style.pointerEvents = "all";
        }

        materiaGroups.forEach(group => {
            // Ignorar el área de combate en el filtrado de lecciones
            if (group.closest('#filter-and-combat-area')) return;

            const leccionCards = group.querySelectorAll('.leccion-card');
            let hasVisibleLecciones = false;

            leccionCards.forEach(card => {
                const title = card.querySelector('.leccion-name').textContent.toLowerCase();
                const isMatch = title.includes(term);
                
                card.style.display = isMatch ? 'grid' : 'none';
                if (isMatch) hasVisibleLecciones = true;
            });

            // Hide/Show the entire materia group based on results
            group.style.display = hasVisibleLecciones ? 'block' : 'none';
            
            // Re-trigger observer for visible elements
            if (hasVisibleLecciones) {
                group.style.opacity = "1";
                group.style.transform = "translateY(0)";
            }
        });
    });
</script>

</body>
</html>
