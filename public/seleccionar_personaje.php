<?php
require_once __DIR__ . '/../src/Config/config.php';
iniciarSesionSegura();

$es_invitado = !empty($_SESSION['usuario_es_invitado']);
$es_usuario = isset($_SESSION['usuario_id']) && !$es_invitado;
$usuario_id = $_SESSION['usuario_id'] ?? 0;
$genero_actual = null;

if ($es_usuario && $usuario_id > 0) {
    $stmt = $pdo->prepare("SELECT genero FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $genero_actual = $row['genero'] ?? null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegir Personaje - LC ADVANCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        :root {
            --cyber-cyan: #00e5ff;
            --cyber-pink: #ff6b9d;
            --neon-yellow: #ffea00;
            --cyber-dark: #080c18;
            --cyber-purple: #9d00ff;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: linear-gradient(135deg, #0a0a1a 0%, #1a0a2e 50%, #0a0a1a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Press Start 2P', monospace;
            overflow: hidden;
        }
        .bg-grid {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: 
                linear-gradient(rgba(0,229,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,229,255,0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: 0;
        }
        #charSelect {
            position: fixed;
            top: 50%; left: 50%; transform: translate(-50%, -50%);
            background: linear-gradient(145deg, rgba(8, 12, 24, 0.96), rgba(4, 6, 16, 0.98));
            border: 2px solid var(--cyber-cyan);
            padding: 40px;
            text-align: center;
            z-index: 1000;
            backdrop-filter: blur(16px);
            box-shadow: 
                0 0 40px rgba(0, 255, 255, 0.15),
                0 0 80px rgba(0, 255, 255, 0.08),
                inset 0 0 60px rgba(0, 255, 255, 0.03);
            border-radius: 12px;
            min-width: 600px;
            animation: menuPulse 3s ease-in-out infinite;
        }
        @keyframes menuPulse {
            0%, 100% { box-shadow: 0 0 40px rgba(0, 255, 255, 0.15), 0 0 80px rgba(0, 255, 255, 0.08), inset 0 0 60px rgba(0, 255, 255, 0.03); }
            50% { box-shadow: 0 0 50px rgba(0, 255, 255, 0.2), 0 0 100px rgba(0, 255, 255, 0.1), inset 0 0 80px rgba(0, 255, 255, 0.05); }
        }
        #charSelect::before {
            content: ''; position: absolute; top: -1px; left: 20%; right: 20%; height: 2px;
            background: linear-gradient(90deg, transparent, var(--cyber-cyan), transparent);
        }
        h2 {
            color: var(--cyber-cyan);
            margin-bottom: 12px;
            text-shadow: 0 0 20px var(--cyber-cyan);
            font-size: 1em;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        p.subtitle {
            color: var(--cyber-pink);
            margin-bottom: 32px;
            font-size: 0.6em;
            text-shadow: 0 0 10px var(--cyber-pink);
        }
        .char-grid {
            display: flex;
            gap: 40px;
            justify-content: center;
            align-items: center;
        }
        .char-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .char-card:hover {
            transform: scale(1.05);
        }
        .char-card:hover .char-bg {
            border-color: var(--neon-yellow);
            box-shadow: 0 0 30px rgba(255, 234, 0, 0.3);
        }
        .char-bg {
            width: 160px;
            height: 200px;
            background: rgba(0, 229, 255, 0.05);
            border: 2px solid var(--cyber-cyan);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            transition: all 0.3s ease;
            margin-bottom: 16px;
        }
        .char-bg img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 4px;
        }
        .char-label {
            color: var(--neon-yellow);
            font-size: 0.7em;
            text-shadow: 0 0 10px var(--neon-yellow);
            letter-spacing: 2px;
        }
        .char-icon {
            font-size: 2em;
            margin-bottom: 8px;
        }
        @media (max-width: 768px) {
            #charSelect {
                min-width: 90vw;
                padding: 24px 20px;
            }
            .char-grid {
                gap: 20px;
            }
            .char-bg {
                width: 120px;
                height: 150px;
            }
            h2 { font-size: 0.8em; }
            .char-label { font-size: 0.55em; }
        }
    </style>
<style>
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
  .vol-btn {
    padding: 4px 6px;
    font-size: 14px;
  }
  .vol-slider {
    padding: 6px;
  }
  .vol-slider input {
    width: 80px;
    height: 10px;
  }
  .vol-slider input::-webkit-slider-thumb {
    width: 14px;
    height: 16px;
  }
}
</style>
</head>
<body>
    <div class="bg-grid"></div>
    <div class="header-volume">
      <button class="vol-btn" id="volBtn" onclick="toggleVolumeSlider()">🔊</button>
      <div class="vol-slider" id="volSlider">
        <input type="range" id="volPrincipalSlider" min="0" max="1" step="0.1" value="0.1">
      </div>
    </div>
    <div id="charSelect">
        <h2>// SELECCIONA_TU_PERSONAJE</h2>
        <p class="subtitle">Elige tu género para continuar</p>
        <div class="char-grid">
            <div class="char-card" onclick="seleccionar('M')">
                <div class="char-bg">
                    <img src="assets/pj/Eleccion_M.png" alt="Hombre">
                </div>
                <span class="char-label">HOMBRE</span>
            </div>
            <div class="char-card" onclick="seleccionar('W')">
                <div class="char-bg">
                    <img src="assets/pj/Eleccion_W.png" alt="Mujer">
                </div>
                <span class="char-label">MUJER</span>
            </div>
        </div>
    </div>

<?php
$from_mapa = !empty($_GET['from']) && $_GET['from'] === 'mapa';

if ($from_mapa && isset($_SESSION['player_pos_x']) && isset($_SESSION['player_pos_y'])) {
    $_SESSION['return_to_pos'] = true;
}
?>
    <script>
    function seleccionar(genero) {
        const esInvitado = <?= $es_invitado ? 'true' : 'false' ?>;
        
        fetch('guardar_genero.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'genero=' + genero + '&invitado=' + (esInvitado ? '1' : '0')
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                window.location.href = 'mapa/index.php';
            }
        })
        .catch(err => {
            console.error(err);
            window.location.href = 'mapa/index.php';
        });
    }
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