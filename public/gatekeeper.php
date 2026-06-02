<?php
/**
 * LC-ADVANCE Gatekeeper
 * Interstitial page to choose between Login or Guest access
 */

require_once __DIR__ . '/../src/Config/config.php';
iniciarSesionSegura();

$redirect = $_GET['redirect'] ?? 'public/mapa/index.php';
// Si no tiene el prefijo public/, agregarlo
if (strpos($redirect, 'public/') !== 0 && strpos($redirect, '/') !== 0) {
    $redirect = 'public/' . $redirect;
}

// Si ya está logueado, redirigir directamente
if (isset($_SESSION['usuario_id'])) {
    redirigir($redirect);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Requerido | LC-ADVANCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;600;700&family=Syne:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #060a12;
            --cyan: #00e5ff;
            --pink: #ff3cac;
            --green: #00ff87;
            --yellow: #ffd23f;
            --text-primary: #ffffff;
            --text-secondary: #b0b0b0;
            --text-dim: #666666;
            --card-bg: rgba(15, 15, 20, 0.9);
            --border: rgba(0, 229, 255, 0.2);
            --shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            --transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg);
            color: var(--text-primary);
            font-family: 'Space Grotesk', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }

        .grid-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 229, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 229, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: -1;
            mask-image: radial-gradient(circle at center, black, transparent 80%);
            animation: gridMove 20s linear infinite;
        }

        @keyframes gridMove {
            0% { background-position: 0 0; }
            100% { background-position: 50px 50px; }
        }

        .gatekeeper-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 60px;
            text-align: center;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: var(--shadow);
            max-width: 500px;
            width: 90%;
            animation: fadeInUp 0.8s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            overflow: hidden;
        }

        .gatekeeper-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 229, 255, 0.1), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        h2 {
            font-family: 'Syne', sans-serif;
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--cyan);
            margin-bottom: 30px;
            text-shadow: 0 0 30px rgba(0, 229, 255, 0.5);
            position: relative;
            z-index: 1;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 40px;
            color: var(--text-secondary);
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .options {
            display: flex;
            flex-direction: column;
            gap: 25px;
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }

        .btn {
            padding: 22px 30px;
            font-family: 'Syne', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 12px;
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            line-height: 1;
            border: none;
            position: relative;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            min-height: 60px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-login {
            background: var(--cyan);
            color: #000;
            box-shadow: 0 0 30px rgba(0, 229, 255, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 50px rgba(0, 229, 255, 0.6);
        }

        .btn-guest {
            background: transparent;
            border: 2px solid var(--pink);
            color: var(--pink);
            box-shadow: 0 0 20px rgba(255, 60, 172, 0.2);
        }

        .btn-guest:hover {
            background: rgba(255, 60, 172, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 0 40px rgba(255, 60, 172, 0.4);
        }

        .btn:active {
            transform: translateY(1px);
        }

        .back-link {
            margin-top: 30px;
            color: var(--text-dim);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
            position: relative;
            z-index: 1;
        }

        .back-link:hover {
            color: var(--cyan);
            text-shadow: 0 0 10px rgba(0, 229, 255, 0.5);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .gatekeeper-card {
                padding: 40px 30px;
                margin: 20px;
            }

            h2 {
                font-size: 2rem;
            }

            p {
                font-size: 1rem;
            }

            .btn {
                padding: 18px 24px;
                font-size: 0.8rem;
                min-height: 50px;
            }
        }

        @media (max-width: 480px) {
            .gatekeeper-card {
                padding: 30px 20px;
            }

            h2 {
                font-size: 1.8rem;
            }

            .options {
                gap: 20px;
            }
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
    </style>
</head>
<body>
    <div class="grid-bg"></div>

    <div class="header-volume">
      <button class="vol-btn" id="volBtn" onclick="toggleVolumeSlider()">🔊</button>
      <div class="vol-slider" id="volSlider">
        <input type="range" id="volPrincipalSlider" min="0" max="1" step="0.1" value="0.1">
      </div>
    </div>

    <div class="gatekeeper-card">
        <h2>IDENTIDAD REQUERIDA</h2>
        <p>Para acceder a esta sección del campus, necesitas iniciar sesión o entrar como invitado temporal.</p>
        
        <div class="options">
            <a href="login.php?redirect=<?php echo urlencode($redirect); ?>" class="btn btn-login">INICIAR SESIÓN</a>
            <a href="guest_login.php?redirect=<?php echo urlencode($redirect); ?>" class="btn btn-guest">ACCESO INVITADO</a>
            <a href="../index.php" class="back-link">VOLVER AL INICIO</a>
        </div>
    </div>
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
<script>
function toggleVolumeSlider() {
  document.getElementById('volSlider').classList.toggle('show');
}
const volSlider = document.getElementById('volPrincipalSlider');
volSlider.value = volumes.principal;
volSlider.addEventListener('input', function(e) {
  volumes.principal = parseFloat(e.target.value);
  localStorage.setItem(STORAGE_KEY, JSON.stringify(volumes));
  pAudio.volume = volumes.principal;
  document.getElementById('volBtn').textContent = volumes.principal > 0 ? '🔊' : '🔇';
});
</script>
</body>
</html>