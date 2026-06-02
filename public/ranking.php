<?php
// ==========================================
// LC-ADVANCE - ranking.php
// ==========================================
// Autor: LC-TEAM
// Fecha: 2025-10-29
// Descripción: Muestra el Top 10 de usuarios por puntos
// ==========================================

require_once __DIR__ . '/../src/Config/config.php';
requireLogin(true); // permitir invitados

// Obtener los 10 mejores jugadores
$stmt = $pdo->query("SELECT nombre_usuario, puntos, nivel FROM usuarios ORDER BY puntos DESC LIMIT 10");
$ranking = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener información del jugador actual (soporta invitado)
if (!empty($_SESSION['usuario_es_invitado'])) {
    $usuarioActual = [
        'nombre_usuario' => $_SESSION['usuario_nombre'] ?? 'Invitado',
        'puntos' => $_SESSION['usuario_puntos'] ?? 0,
        'nivel' => $_SESSION['usuario_nivel'] ?? 0
    ];
} else {
    $stmt2 = $pdo->prepare("SELECT nombre_usuario, puntos, nivel FROM usuarios WHERE id = ?");
    $stmt2->execute([$_SESSION['usuario_id']]);
    $usuarioActual = $stmt2->fetch();
    if (!$usuarioActual || !is_array($usuarioActual)) {
        $usuarioActual = ['nombre_usuario' => '—', 'puntos' => 0, 'nivel' => 0];
    }
}

// Ruta de retorno lógico para el botón "Volver"
$return_link = $_GET['return_url'] ?? 'dashboard.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Leaderboard | LC-ADVANCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #060a12;
            --surface: #0d142b;
            --surface2: #101b33;
            --border: rgba(0, 229, 255, 0.2);
            --border2: rgba(0, 229, 255, 0.28);
            --cyan: #00e5ff;
            --pink: #ff3cac;
            --green: #00ff87;
            --yellow: #ffd23f;
            --text: #e8f4ff;
            --muted: rgba(180, 215, 255, 0.66);
            --font-display: "Syne", sans-serif;
            --font-body: "Space Grotesk", sans-serif;
            --font-mono: "JetBrains Mono", monospace;
            --transition: all 0.25s cubic-bezier(0.23, 1, 0.32, 1);
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: var(--font-body);
            color: var(--text);
            background: radial-gradient(circle at 20% -10%, rgba(0, 229, 255, 0.16), transparent 40%), radial-gradient(circle at 80% 100%, rgba(255, 50, 180, 0.14), transparent 45%), var(--bg);
            overflow-x: hidden;
        }

        .grid-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image: linear-gradient(rgba(0, 229, 255, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 229, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridScroll 40s linear infinite;
            opacity: 0.28;
        }

        .bg-orb { position: fixed; border-radius: 50%; pointer-events: none; filter: blur(90px); z-index: 0; }
        .bg-orb-1 { width: 520px; height: 520px; top: -160px; right: -120px; background: radial-gradient(circle, rgba(0, 229, 255, 0.2), transparent 68%); animation: orbPulse 11s ease-in-out infinite; }
        .bg-orb-2 { width: 380px; height: 380px; bottom: -100px; left: -100px; background: radial-gradient(circle, rgba(255, 50, 180, 0.16), transparent 70%); animation: orbPulse 12s ease-in-out infinite reverse; }

        .ranking-container {
            position: relative;
            z-index: 1;
            width: min(100%, 1100px);
            margin: 30px auto 45px;
            padding: 26px;
            background: linear-gradient(145deg, rgba(10, 17, 32, 0.98), rgba(6, 12, 22, 0.94));
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(12px);
        }

        .ranking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .ranking-title {
            font-family: var(--font-display);
            font-size: clamp(1.3rem, 2.8vw, 2.4rem);
            color: var(--text);
            margin: 0;
        }

        .ranking-title span { color: var(--cyan); }

        .ranking-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
            box-shadow: inset 0 0 0 1px rgba(0, 229, 255, 0.1);
        }

        .ranking-table th,
        .ranking-table td {
            padding: 12px 14px;
            text-align: left;
            font-family: var(--font-mono);
            font-size: 0.93rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .ranking-table th {
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-size: 0.79rem;
            background: rgba(0, 229, 255, 0.04);
        }

        .ranking-table tbody tr {
            transition: var(--transition);
        }

        .ranking-table tbody tr:hover {
            background: rgba(0, 229, 255, 0.06);
            transform: translateX(2px);
        }

        .actual-user {
            background: linear-gradient(120deg, rgba(0, 255, 135, 0.17), rgba(0, 229, 255, 0.1));
            border-left: 3px solid var(--green);
            color: #e9ffeb;
        }

        .user-section {
            padding: 14px 12px;
            border: 1px solid rgba(0, 229, 255, 0.15);
            border-radius: 12px;
            background: rgba(0, 0, 0, 0.25);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .user-section p { margin: 0; font-family: var(--font-mono); font-size: 0.95rem; }
        .user-section strong { color: var(--cyan); }

        .menu {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn,
        .logout {
            border: 1px solid var(--border2);
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-family: var(--font-mono);
            font-size: 0.9rem;
            background: rgba(0, 0, 0, 0.35);
            color: var(--text);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .btn:hover,
        .logout:hover {
            transform: translateY(-1px);
            border-color: rgba(0, 229, 255, 0.5);
            box-shadow: 0 10px 20px rgba(0, 229, 255, 0.25);
        }

        .logout {
            background: linear-gradient(90deg, var(--cyan), var(--pink));
            color: #060a12;
        }

        @keyframes gridScroll {
            from { background-position: 0 0, 0 0; }
            to { background-position: 120px 120px, 120px 120px; }
        }

        @keyframes orbPulse {
            0%, 100% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.06); opacity: 1; }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 900px) {
            .ranking-container { width: min(100%, 92%); margin: 16px auto; padding: 18px; }
            .ranking-title { font-size: 1.6rem; }
            .ranking-table th, .ranking-table td { font-size: 0.82rem; padding: 10px; }
        }

        @media (max-width: 640px) {
            .ranking-container { padding: 14px; }
            .ranking-header { flex-direction: column; align-items: flex-start; }
            .user-section { flex-direction: column; align-items: flex-start; gap: 4px; }
            .menu { width: 100%; justify-content: space-between; }
            .btn, .logout { width: calc(50% - 6px); white-space: nowrap; }
            .ranking-table-wrapper { width: 100%; overflow-x: auto; }
            .ranking-table { width: 100%; min-width: 320px; border-collapse: collapse; }
            .ranking-table th, .ranking-table td { font-size: 0.78rem; padding: 8px; white-space: nowrap; }
            .ranking-table th { font-size: 0.72rem; }
            .ranking-table td { font-size: 0.78rem; }
        }

        .header-volume {
          display: flex;
          align-items: center;
          gap: 8px;
          position: fixed;
          top: 15px;
          right: 15px;
          z-index: 9999;
        }
        .vol-btn {
          background: rgba(0,229,255,0.1);
          border: 1px solid rgba(0,229,255,0.5);
          border-radius: 6px;
          padding: 6px 10px;
          cursor: pointer;
          color: #00e5ff;
          font-size: 16px;
          transition: all 0.3s ease;
        }
        .vol-btn:hover {
          background: rgba(0,229,255,0.2);
          border-color: #00e5ff;
        }
        .vol-slider {
          display: none;
          background: rgba(0,0,0,0.9);
          border: 1px solid rgba(0,229,255,0.5);
          border-radius: 6px;
          padding: 8px;
        }
        .vol-slider.show {
          display: block;
        }
        .vol-slider input {
          width: 100px;
          cursor: pointer;
          -webkit-appearance: none;
          background: #222;
          height: 12px;
          border: 2px solid #00e5ff;
          border-radius: 4px;
        }
        .vol-slider input::-webkit-slider-thumb {
          -webkit-appearance: none;
          width: 16px;
          height: 20px;
          background: #c9408a;
          border: 2px solid #fff;
          cursor: pointer;
          border-radius: 4px;
        }
        @media (max-width: 768px) {
          .vol-btn { padding: 4px 6px; font-size: 14px; }
          .vol-slider { padding: 6px; }
          .vol-slider input { width: 80px; height: 10px; }
          .vol-slider input::-webkit-slider-thumb { width: 14px; height: 16px; }
        }

        @media (orientation: landscape) and (max-height: 520px) {
            .ranking-container {
                width: 100vw;
                height: 100dvh;
                max-height: 100dvh;
                overflow-y: auto;
                margin: 0;
                border-radius: 0;
                padding: 10px;
            }
            .ranking-header { margin-bottom: 10px; }
            .ranking-title { font-size: 1.5rem; }
            .ranking-table { display: block; overflow-x: auto; }
            .ranking-table th, .ranking-table td { font-size: 0.72rem; padding: 8px; }
            .user-section { font-size: 0.86rem; }
            .menu { flex-direction: column; gap: 8px; }
            .btn, .logout { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="grid-bg"></div>
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>

    <div class="header-volume">
      <button class="vol-btn" id="volBtn" onclick="toggleVolumeSlider()">🔊</button>
      <div class="vol-slider" id="volSlider">
        <input type="range" id="volPrincipalSlider" min="0" max="1" step="0.1" value="0.1">
      </div>
    </div>

    <div class="ranking-container">
        <div class="ranking-header">
            <h1 class="ranking-title">🏆 Top <span>10</span> Jugadores</h1>
            <p style="color: var(--muted); font-family: var(--font-mono); margin:0;">Actualizado en tiempo real desde la base de datos</p>
        </div>

        <div class="ranking-table-wrapper">
        <table class="ranking-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jugador</th>
                    <th>Puntos</th>
                    <th>Nivel</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ranking as $i => $jugador): ?>
                    <tr class="<?php echo ($jugador['nombre_usuario'] === $usuarioActual['nombre_usuario']) ? 'actual-user' : ''; ?>">
                        <td><?php echo $i + 1; ?></td>
                        <td><?php echo htmlspecialchars($jugador['nombre_usuario']); ?></td>
                        <td><?php echo (int)$jugador['puntos']; ?></td>
                        <td><?php echo (int)$jugador['nivel']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>

        <div class="user-section">
            <p>🎮 Jugador: <strong><?php echo htmlspecialchars($usuarioActual['nombre_usuario']); ?></strong></p>
            <p>⭐ Puntos: <?php echo (int)$usuarioActual['puntos']; ?> | 🏅 Nivel: <?php echo (int)$usuarioActual['nivel']; ?></p>
        </div>

        <div class="menu">
            <button id="back-btn" class="btn" type="button" data-fallback="<?php echo htmlspecialchars($return_link, ENT_QUOTES, 'UTF-8'); ?>">⬅️ Volver</button>
            <a href="logout.php" class="logout">🚪 Cerrar Sesión</a>
        </div>
    </div>

    <script>
      (function(){
        const btn = document.getElementById('back-btn');
        btn.addEventListener('click', function(e){
          e.preventDefault();
          const ref = document.referrer || '';
          const fallback = btn.dataset.fallback || '<?php echo addslashes($return_link); ?>';

          if (window.history.length > 1 && ref && ref !== window.location.href) {
            // Volver a la página anterior si el historial lo permite
            history.back();
            setTimeout(() => {
              if (window.location.href === window.location.origin + window.location.pathname) {
                window.location.href = fallback;
              }
            }, 250);
            return;
          }

          // En cualquier otro caso, usar fallback (debe ser la URL previa lógica)
          window.location.href = fallback;
        }, { passive: true });
      })();
    </script>
<audio id="pageMusic" loop>
  <source src="assets/music/cuco_pantalla_inicio.mp3" type="audio/mpeg">
</audio>
<script>
const STORAGE_KEY = 'lc_volume_settings';
function getStoredVolumes() {
  const stored = localStorage.getItem(STORAGE_KEY);
  if (stored) return JSON.parse(stored);
    return { principal: 1.0, ambiental: 0.8, examenes: 0.8 };
}
const volumes = getStoredVolumes();
const pAudio = document.getElementById('pageMusic');
if (pAudio) pAudio.volume = volumes.principal;
</script>
<script src="assets/js/volume_manager.js"></script>
<script>if (typeof initPageAudio === 'function') initPageAudio('pageMusic');</script>
</body>
</html>
