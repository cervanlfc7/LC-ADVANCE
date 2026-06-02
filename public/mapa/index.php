<?php
require_once __DIR__ . '/../../src/Config/config.php';
requireLogin();

// Leer género directamente de la BD para evitar problemas de sesión
$usuario_id = $_SESSION['usuario_id'] ?? 0;
$player_gender = 'M';
if ($usuario_id > 0) {
    $stmt = $pdo->prepare("SELECT genero FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!empty($row['genero'])) {
        $player_gender = $row['genero'];
    }
} elseif (!empty($_SESSION['genero'])) {
    $player_gender = $_SESSION['genero'];
}

// Si todavía no hay género, redirigir a selección (excepto invitados)
if ($player_gender === 'M' && empty($_SESSION['usuario_es_invitado']) && $usuario_id > 0) {
    $stmt_check = $pdo->prepare("SELECT genero FROM usuarios WHERE id = ?");
    $stmt_check->execute([$usuario_id]);
    $check = $stmt_check->fetch();
    if (empty($check['genero'])) {
        header('Location: ../seleccionar_personaje.php');
        exit;
    }
}

$session_key = "map.player_pos_" . ($_SESSION['usuario_id'] ?? 'guest') . '_' . session_id();
$npc_key = "map.npc_pos_" . ($_SESSION['usuario_id'] ?? 'guest') . '_' . session_id();
?>
<script>
const P_KEY = "<?php echo $session_key; ?>";
const NPC_KEY = "<?php echo $npc_key; ?>";
</script>
<!DOCTYPE html>
<html lang="es">
<head>
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  <meta charset="UTF-8" />
  <title>LC-ADVANCE.GAME</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, orientation=landscape" />
  <style>
    :root { --neon-cyan: #00ffff; --neon-pink: #ff00ff; --neon-yellow: #ffff00; }
    html, body { margin: 0; padding: 0; background: #000; width: 100vw; height: 100vh; overflow: hidden; font-family: 'Press Start 2P', monospace; }
    .viewport { position: relative; width: 100vw; height: 100vh; overflow: hidden; background: #111; display: flex; justify-content: center; align-items: center; }
    canvas#game { width: 100vw; height: 100vh; image-rendering: pixelated; display: block; filter: contrast(1.1) brightness(1.1); }
    
    .crt::after {
      content: " "; position: absolute; top: 0; left: 0; bottom: 0; right: 0;
      background: linear-gradient(rgba(18, 16, 16, 0.1) 50%, rgba(0, 0, 0, 0.1) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.05), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.05));
      background-size: 100% 4px, 4px 100%; pointer-events: none; z-index: 100;
    }

    #pauseMenu {
      display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
      background: linear-gradient(145deg, rgba(8, 12, 24, 0.96), rgba(4, 6, 16, 0.98));
      border: 2px solid var(--neon-cyan); padding: 36px 40px 32px 40px;
      text-align: center; z-index: 2000; backdrop-filter: blur(16px);
      box-shadow: 
        0 0 40px rgba(0, 255, 255, 0.15),
        0 0 80px rgba(0, 255, 255, 0.08),
        inset 0 0 60px rgba(0, 255, 255, 0.03),
        0 0 0 1px rgba(0, 255, 255, 0.1);
      border-radius: 8px;
      min-width: 340px;
      animation: menuPulse 3s ease-in-out infinite;
    }
    @keyframes menuPulse {
      0%, 100% { box-shadow: 0 0 40px rgba(0, 255, 255, 0.15), 0 0 80px rgba(0, 255, 255, 0.08), inset 0 0 60px rgba(0, 255, 255, 0.03), 0 0 0 1px rgba(0, 255, 255, 0.1); }
      50% { box-shadow: 0 0 50px rgba(0, 255, 255, 0.2), 0 0 100px rgba(0, 255, 255, 0.1), inset 0 0 80px rgba(0, 255, 255, 0.05), 0 0 0 1px rgba(0, 255, 255, 0.15); }
    }
    #pauseMenu::before {
      content: ''; position: absolute; top: -1px; left: 20%; right: 20%; height: 2px;
      background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
    }
    #pauseMenu h2 {
      color: var(--neon-cyan); margin-bottom: 28px; margin-top: 0;
      text-shadow: 0 0 20px var(--neon-cyan), 0 0 40px rgba(0, 255, 255, 0.5);
      font-size: 1em; letter-spacing: 3px; text-transform: uppercase;
      border-bottom: 1px solid rgba(0, 255, 255, 0.2); padding-bottom: 16px;
    }
    .menu-btns { display: flex; flex-direction: column; gap: 16px; }
    .menu-btns button {
      padding: 16px 0; background: linear-gradient(135deg, rgba(20, 20, 35, 0.9), rgba(10, 10, 20, 0.9));
      color: var(--neon-yellow); border: 2px solid var(--neon-yellow);
      cursor: pointer; font-family: 'Press Start 2P', monospace; font-size: 12px;
      letter-spacing: 1px; text-shadow: 0 0 10px var(--neon-yellow);
      box-shadow: 0 0 15px rgba(255, 255, 0, 0.2), inset 0 0 20px rgba(255, 255, 0, 0.05);
      transition: all 0.2s ease; outline: none;
      position: relative; overflow: hidden;
    }
    .menu-btns button::before {
      content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
      transition: left 0.4s ease;
    }
    .menu-btns button:hover::before, .menu-btns button:focus::before { left: 100%; }
    .menu-btns button:hover, .menu-btns button:focus {
      background: var(--neon-yellow); color: #000;
      box-shadow: 0 0 30px var(--neon-yellow), 0 0 60px rgba(255, 255, 0, 0.3);
      text-shadow: none; transform: translateY(-2px);
      border-color: #fff;
    }
    .menu-btns button.exit {
      border-color: var(--neon-pink); color: var(--neon-pink);
      box-shadow: 0 0 15px rgba(255, 0, 255, 0.2), inset 0 0 20px rgba(255, 0, 255, 0.05);
      text-shadow: 0 0 10px var(--neon-pink);
    }
    .menu-btns button.exit:hover, .menu-btns button.exit:focus {
      background: var(--neon-pink); color: #fff;
      box-shadow: 0 0 30px var(--neon-pink), 0 0 60px rgba(255, 0, 255, 0.3);
      text-shadow: none; transform: translateY(-2px); border-color: #fff;
    }
    .menu-btns button.reset {
      border-color: #39ff14; color: #39ff14;
      box-shadow: 0 0 15px rgba(57, 255, 20, 0.2), inset 0 0 20px rgba(57, 255, 20, 0.05);
      text-shadow: 0 0 10px #39ff14;
    }
    .menu-btns button.reset:hover, .menu-btns button.reset:focus {
      background: #39ff14; color: #000;
      box-shadow: 0 0 30px #39ff14, 0 0 60px rgba(57, 255, 20, 0.3);
      text-shadow: none; transform: translateY(-2px); border-color: #fff;
    }
    .char-section { margin-top: 20px; padding-top: 16px; border-top: 1px solid rgba(0,255,255,0.2); }
    .char-section h3 { color: var(--neon-cyan); font-size: 10px; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px; }
    .char-grid { display: flex; gap: 16px; justify-content: center; }
    .char-btn {
      width: 70px; height: 70px; background: rgba(20, 20, 35, 0.9);
      border: 2px solid var(--neon-cyan); border-radius: 8px;
      cursor: pointer; overflow: hidden; transition: all 0.3s ease;
      display: flex; align-items: center; justify-content: center;
    }
    .char-btn:hover { border-color: var(--neon-yellow); transform: scale(1.1); }
    .char-btn.active { border-color: #39ff14; box-shadow: 0 0 20px rgba(57, 255, 20, 0.5); }
    .char-btn img { width: 100%; height: 100%; object-fit: contain; }
    .char-btn span { color: var(--neon-yellow); font-family: 'Press Start 2P', monospace; font-size: 8px; }
    
    #interaction {
      position: fixed; bottom: 80px; left: 50%; transform: translateX(-50%);
      background: linear-gradient(135deg, rgba(0, 20, 30, 0.9), rgba(0, 10, 20, 0.95));
      color: var(--neon-cyan); border: 1px solid var(--neon-cyan);
      padding: 12px 24px; font-size: 10px; z-index: 500; display: block;
      box-shadow: 0 0 20px rgba(0,255,255,0.3), inset 0 0 30px rgba(0,255,255,0.05);
      pointer-events: none; backdrop-filter: blur(8px);
      border-radius: 4px; letter-spacing: 1px; text-transform: uppercase;
      text-shadow: 0 0 10px var(--neon-cyan), 0 0 20px rgba(0,255,255,0.5);
      animation: interactPulse 2s ease-in-out infinite;
    }
    @keyframes interactPulse {
      0%, 100% { box-shadow: 0 0 20px rgba(0,255,255,0.3), inset 0 0 30px rgba(0,255,255,0.05); }
      50% { box-shadow: 0 0 30px rgba(0,255,255,0.5), inset 0 0 40px rgba(0,255,255,0.08); }
    }
    

    .mobile-controls {
      position: fixed; bottom: 10px; left: 10px; right: 10px; display: flex; justify-content: space-between; z-index: 1000;
      pointer-events: none;
    }
    .dpad {
      display: grid; grid-template-columns: repeat(3, 36px); gap: 4px;
      pointer-events: auto;
    }
    .btn {
      background: linear-gradient(135deg, rgba(0,255,255,0.18) 60%, rgba(0,0,0,0.18));
      border: 1.5px solid var(--neon-cyan); color: var(--neon-cyan); border-radius: 50%; height: 36px; width: 36px;
      display: flex; align-items: center; justify-content: center; font-size: 13px; font-family: 'Press Start 2P', monospace;
      box-shadow: 0 0 6px 0 var(--neon-cyan), 0 0 0 2px rgba(0,255,255,0.08);
      transition: background 0.18s, color 0.18s, box-shadow 0.18s, border-color 0.18s, transform 0.12s;
      cursor: pointer; outline: none;
    }
    .btn:active, .btn:focus {
      background: var(--neon-cyan); color: #000; box-shadow: 0 0 12px var(--neon-cyan), 0 0 0 4px rgba(0,255,255,0.18);
      border-color: #fff;
      transform: scale(1.08);
    }
    .act-btn {
      padding: 7px 16px; background: linear-gradient(135deg, rgba(255,255,0,0.13) 60%, rgba(0,0,0,0.13));
      border: 1.5px solid var(--neon-yellow); color: var(--neon-yellow); border-radius: 7px;
      font-family: 'Press Start 2P', monospace; font-size: 9px; margin-bottom: 3px;
      box-shadow: 0 0 4px 0 var(--neon-yellow), 0 0 0 1px rgba(255,255,0,0.08);
      letter-spacing: 1px; text-shadow: 0 0 2px var(--neon-yellow), 0 0 1px #fff;
      transition: background 0.18s, color 0.18s, box-shadow 0.18s, border-color 0.18s, transform 0.12s;
      cursor: pointer; outline: none;
      pointer-events: auto;
    }
    .act-btn:active, .act-btn:focus {
      background: var(--neon-yellow); color: #000; box-shadow: 0 0 8px var(--neon-yellow), 0 0 0 2px rgba(255,255,0,0.18);
      border-color: #fff;
      transform: scale(1.06);
    }
    .act-btn.exit {
      border-color: var(--neon-pink); color: var(--neon-pink); background: #1a001a;
      box-shadow: 0 0 18px 0 var(--neon-pink), 0 0 0 4px rgba(255,0,255,0.08);
      text-shadow: 0 0 8px var(--neon-pink), 0 0 2px #fff;
    }
    .act-btn.exit:active, .act-btn.exit:focus {
      background: var(--neon-pink); color: #fff; box-shadow: 0 0 32px var(--neon-pink), 0 0 0 8px rgba(255,0,255,0.18);
      border-color: #fff;
    }

    .menu-btns button.ctrl-toggle {
      border-color: #ff3c3c; color: #ff3c3c;
      box-shadow: 0 0 15px rgba(255, 60, 60, 0.2), inset 0 0 20px rgba(255, 60, 60, 0.05);
      text-shadow: 0 0 10px #ff3c3c;
    }
    .menu-btns button.ctrl-toggle:hover, .menu-btns button.ctrl-toggle:focus {
      background: #ff3c3c; color: #fff;
      box-shadow: 0 0 30px #ff3c3c, 0 0 60px rgba(255, 60, 60, 0.3);
      text-shadow: none; transform: translateY(-2px); border-color: #fff;
    }
    #ctrlOptions, #musicOptions {
      display: none; gap: 12px; flex-direction: column;
    }
    .ctrl-opt {
      flex: 1; padding: 10px 0; margin: 0;
      background: linear-gradient(135deg, rgba(40, 10, 10, 0.9), rgba(20, 5, 5, 0.9));
      color: #ff6666; border: 2px solid #ff3c3c; cursor: pointer;
      font-family: 'Press Start 2P', monospace; font-size: 9px;
      letter-spacing: 1px; border-radius: 4px;
      transition: all 0.2s ease; outline: none;
    }
    .ctrl-opt.active {
      background: #ff3c3c; color: #fff; border-color: #fff;
      box-shadow: 0 0 20px rgba(255, 60, 60, 0.4);
    }
    .menu-btns button.music-toggle {
      border-color: #00bcd4; color: #00bcd4;
      box-shadow: 0 0 15px rgba(0, 188, 212, 0.2), inset 0 0 20px rgba(0, 188, 212, 0.05);
      text-shadow: 0 0 10px #00bcd4;
    }
    .menu-btns button.music-toggle:hover, .menu-btns button.music-toggle:focus {
      background: #00bcd4; color: #fff;
      box-shadow: 0 0 30px #00bcd4, 0 0 60px rgba(0, 188, 212, 0.3);
      text-shadow: none; transform: translateY(-2px); border-color: #fff;
    }
    #musicOptions .volume-control { padding: 8px 0; }
    @media (max-width: 480px) {
      #pauseMenu {
        padding: 24px 16px 20px 16px; min-width: auto;
        width: 92vw; max-width: 360px;
      }
      #pauseMenu h2 { font-size: 0.8em; margin-bottom: 18px; padding-bottom: 12px; }
      .menu-btns { gap: 10px; }
      .menu-btns button { padding: 12px 0; font-size: 10px; }
      .ctrl-opt { font-size: 8px; padding: 8px 0; }
    }
    @media (orientation: landscape) and (max-height: 500px) {
      #pauseMenu { padding: 14px 12px 12px 12px; width: 85vw; max-width: 480px; }
      #pauseMenu h2 { font-size: 0.65em; margin-bottom: 10px; padding-bottom: 8px; }
      .menu-btns { gap: 6px; flex-direction: row; flex-wrap: wrap; justify-content: center; }
      .menu-btns button { padding: 8px 10px; font-size: 8px; flex: 0 1 auto; min-width: 90px; }
      .menu-btns .ctrl-opt { padding: 6px 8px; font-size: 7px; min-width: 60px; }
      #ctrlOptions, #musicOptions { flex-direction: row; flex-wrap: wrap; justify-content: center; }
      #musicOptions .volume-control { width: 140px; }
    }

    .joystick-area {
      position: fixed; bottom: 70px; left: 24px;
      width: 120px; height: 120px; border-radius: 50%;
      background: rgba(0, 255, 255, 0.08);
      border: 2px solid rgba(0, 255, 255, 0.25);
      z-index: 999; display: none; touch-action: none;
      pointer-events: auto;
    }
    .joystick-knob {
      position: absolute; top: 50%; left: 50%;
      width: 44px; height: 44px; border-radius: 50%;
      background: radial-gradient(circle, rgba(0,255,255,0.5), rgba(0,255,255,0.2));
      border: 2px solid var(--neon-cyan);
      transform: translate(-50%, -50%);
      transition: transform 0.06s ease-out;
      box-shadow: 0 0 15px rgba(0,255,255,0.3);
      pointer-events: none;
    }
    @media (min-width: 1025px) { .mobile-controls { display: none !important; } }

    .volume-control label { display: block; color: var(--neon-yellow); font-size: 9px; margin-bottom: 6px; text-transform: uppercase; font-family: 'Press Start 2P', monospace; }
    .volume-control input[type="range"] { width: 100%; height: 6px; -webkit-appearance: none; appearance: none; background: rgba(255,255,255,0.1); border-radius: 3px; outline: none; }
    .volume-control input[type="range"]::-webkit-slider-thumb { -webkit-appearance: none; appearance: none; width: 14px; height: 14px; background: #00bcd4; border-radius: 50%; cursor: pointer; box-shadow: 0 0 8px #00bcd4; }
    .volume-control input[type="range"]::-moz-range-thumb { width: 14px; height: 14px; background: #00bcd4; border-radius: 50%; cursor: pointer; border: none; }
    .menu-btns button.char {
      border-color: var(--neon-cyan); color: var(--neon-cyan);
      box-shadow: 0 0 15px rgba(0, 229, 255, 0.2), inset 0 0 20px rgba(0, 229, 255, 0.05);
      text-shadow: 0 0 10px var(--neon-cyan);
    }
    .menu-btns button.char {
      border-color: #ff9800; color: #ff9800;
      box-shadow: 0 0 15px rgba(255, 152, 0, 0.2), inset 0 0 20px rgba(255, 152, 0, 0.05);
      text-shadow: 0 0 10px #ff9800;
    }
    .menu-btns button.char:hover, .menu-btns button.char:focus {
      background: #ff9800; color: #000;
      box-shadow: 0 0 30px #ff9800, 0 0 60px rgba(255, 152, 0, 0.3);
      text-shadow: none; transform: translateY(-2px); border-color: #fff;
    }

    .tutorial-overlay {
      position: fixed; inset: 0; z-index: 9999;
      display: flex; align-items: center; justify-content: center;
      background: rgba(0,0,0,0.75);
    }
    .tutorial-overlay img {
      width: min(45vw, 350px); height: auto;
      image-rendering: pixelated;
      animation: tutorialBlink 0.8s ease-in-out infinite;
    }
    @keyframes tutorialBlink {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.2; }
    }
    .tutorial-overlay.dismissed { display: none; }
    @media (max-width: 899px) { .tutorial-overlay { display: none !important; } }
  </style>
</head>
<body onclick="window.focus();">
  <div class="viewport crt">
    <div id="pauseMenu">
      <h2>// SISTEMA_PAUSADO</h2>
      <div class="menu-btns">
        <button onclick="document.getElementById('pauseMenu').style.display='none'">▶ CONTINUAR</button>
        <button class="reset" onclick="localStorage.removeItem('<?php echo $session_key; ?>'); localStorage.removeItem('<?php echo $npc_key; ?>'); location.reload();">⟳ RESET POSICIÓN</button>
        <button class="ctrl-toggle" onclick="toggleControles()">CONTROLES</button>
        <div id="ctrlOptions" style="display:none">
          <button class="ctrl-opt active" onclick="setControl('dpad')">CRUZ</button>
          <button class="ctrl-opt" onclick="setControl('joystick')">JOYSTICK</button>
        </div>
        <button class="music-toggle" onclick="toggleMusica()">MUSICA</button>
        <div id="musicOptions" style="display:none">
          <div class="volume-control">
            <label>Musica Ambiental</label>
            <input type="range" id="volAmbiental" min="0" max="1" step="0.1" value="0.8">
          </div>
        </div>
        <button class="char" onclick="guardarPosYIr(); return false;">CAMBIAR PERSONAJE</button>
        <button class="exit" onclick="window.location.href='../../index.php'">⏻ SALIR</button>
      </div>
    </div>
    <div id="interaction">INTERACTUAR [E]</div>
    <canvas id="game"></canvas>
    <div id="tutorialOverlay" class="tutorial-overlay">
      <img src="../assets/img/ASDW.png" alt="Presiona A S W D para moverte">
    </div>
    <div class="mobile-controls">
      <div class="dpad">
        <div></div><div class="btn" id="btnUp">▲</div><div></div>
        <div class="btn" id="btnLeft">◀</div><div></div><div class="btn" id="btnRight">▶</div>
        <div></div><div class="btn" id="btnDown">▼</div><div></div>
      </div>
      <div id="ctrlActions" style="display:flex; flex-direction:column; gap:15px; margin-left:auto;">
        <button class="act-btn" id="btnE">💬 HABLAR</button>
        <button class="act-btn exit" id="btnEsc">⏸ PAUSA</button>
      </div>
    </div>
    <div class="joystick-area" id="joystickArea">
      <div class="joystick-knob" id="joystickKnob"></div>
    </div>
 <script type="module">

// ===== LÓGICA DE IDENTIFICACIÓN Y MOVIMIENTO DE PROFESORES (ROBUSTA) =====
const PROFESORES = { 130:"Miguel", 132:"Enrique", 135:"Espindola", 137:"Manuel", 138:"Meza", 140:"Herson", 141:"Carolina", 142:"Refugio & Padilla" };

function linesIntersect(p1, p2, p3, p4) {
  const d = (p1.x-p2.x)*(p3.y-p4.y)-(p1.y-p2.y)*(p3.x-p4.x); if (d===0) return false;
  const t = ((p1.x-p3.x)*(p3.y-p4.y)-(p1.y-p3.y)*(p3.x-p4.x))/d, u = ((p1.x-p3.x)*(p1.y-p2.y)-(p1.y-p3.y)*(p1.x-p2.x))/d;
  return t>=0 && t<=1 && u>=0 && u<=1;
}

function intersects(rect, obj) {
  if (obj.points) {
    for (const p of obj.points) {
      if (p.x >= rect.x && p.x <= rect.x + rect.width && p.y >= rect.y && p.y <= rect.y + rect.height) return true;
    }
    const corners = [
      {x: rect.x, y: rect.y}, {x: rect.x + rect.width, y: rect.y},
      {x: rect.x + rect.width, y: rect.y + rect.height}, {x: rect.x, y: rect.y + rect.height}
    ];
    for (const rp of corners) {
      let inside = false;
      for (let i = 0, j = obj.points.length - 1; i < obj.points.length; j = i++) {
        const xi = obj.points[i].x, yi = obj.points[i].y;
        const xj = obj.points[j].x, yj = obj.points[j].y;
        if (((yi > rp.y) !== (yj > rp.y)) && (rp.x < (xj - xi) * (rp.y - yi) / (yj - yi) + xi)) inside = !inside;
      }
      if (inside) return true;
    }
    const edges = [
      {s:{x:rect.x,y:rect.y}, e:{x:rect.x+rect.width,y:rect.y}},
      {s:{x:rect.x+rect.width,y:rect.y}, e:{x:rect.x+rect.width,y:rect.y+rect.height}},
      {s:{x:rect.x+rect.width,y:rect.y+rect.height}, e:{x:rect.x,y:rect.y+rect.height}},
      {s:{x:rect.x,y:rect.y+rect.height}, e:{x:rect.x,y:rect.y}}
    ];
    for (let i = 0; i < obj.points.length; i++) {
      const ps = obj.points[i], pe = obj.points[(i + 1) % obj.points.length];
      for (const re of edges) { if (linesIntersect(ps, pe, re.s, re.e)) return true; }
    }
    return false;
  }
  return rect.x < obj.x + (obj.width||16) && rect.x + rect.width > obj.x &&
         rect.y < obj.y + (obj.height||16) && rect.y + rect.height > obj.y;
}

function getHitbox(x, y) {
  return { x: x - 6, y: y + 4, width: 12, height: 8 };
}

function isInCarpa(x, y) {
  const b = world.carpaBBox;
  if (!b || b.w <= 0) return false;
  return x >= b.x && x <= b.x+b.w && y >= b.y && y <= b.y+b.h;
}

function checkColPlayer(x, y) {
  const r = getHitbox(x, y);
  return world.collisions.some(c => {
    if (!intersects(r, c)) return false;
    const cx = c.x + (c.width||16)/2, cy = c.y + (c.height||16)/2;
    if (isInCarpa(cx, cy)) return false;
    return true;
  });
}

function checkColNPC(x, y) {
  const r = getHitbox(x, y);
  return world.collisions.some(c => {
    if (!intersects(r, c)) return false;
    const cx = c.x + (c.width||16)/2, cy = c.y + (c.height||16)/2;
    if (isInCarpa(cx, cy)) return false;
    return true;
  });
}

function checkEntityCol(x, y, selfNpc) {
  const r = getHitbox(x, y);
  if (selfNpc !== null) {
    const pr = getHitbox(world.player.x, world.player.y);
    if (intersects(r, pr)) return true;
  }
  return world.npcs.some(n => n !== selfNpc && intersects(r, getHitbox(n.x, n.y)));
}

function resolveSpawn(x, y) {
  if (!checkColNPC(x, y)) return {x, y};
  const steps = [8, 16, 24, 32, 48, 64, 80, 96, 128];
  const dirs = [{dx:0,dy:-1},{dx:0,dy:1},{dx:-1,dy:0},{dx:1,dy:0},
                {dx:1,dy:-1},{dx:-1,dy:-1},{dx:1,dy:1},{dx:-1,dy:1},
                {dx:2,dy:-1},{dx:-2,dy:1},{dx:1,dy:2},{dx:-1,dy:-2}];
  for (const s of steps) {
    for (const d of dirs) {
      const nx = x + d.dx*s, ny = y + d.dy*s;
      if (!checkColNPC(nx, ny)) return {x: nx, y: ny};
    }
  }
  return {x, y};
}

let WALKABLE_PTS = [];
function buildWalkableGrid() {
  if (!world.collisions.length) return;
  let minX=Infinity, minY=Infinity, maxX=-Infinity, maxY=-Infinity;
  world.collisions.forEach(c => {
    minX=Math.min(minX,c.x); minY=Math.min(minY,c.y);
    maxX=Math.max(maxX,c.x+(c.width||16)); maxY=Math.max(maxY,c.y+(c.height||16));
  });
  minX-=320; minY-=320; maxX+=320; maxY+=320;
  for (let x=minX; x<=maxX; x+=20)
    for (let y=minY; y<=maxY; y+=20)
      if (!checkColNPC(x,y)) WALKABLE_PTS.push({x,y});
}
function walkableNear(cx, cy, radius) {
  const r2=radius*radius;
  const pool=WALKABLE_PTS.filter(p=>{const dx=p.x-cx,dy=p.y-cy;return dx*dx+dy*dy<=r2;});
  if (pool.length) return pool[Math.floor(Math.random()*pool.length)];
  const pool2=WALKABLE_PTS.filter(p=>{const dx=p.x-cx,dy=p.y-cy;return dx*dx+dy*dy<=r2*4;});
  if (pool2.length) return pool2[Math.floor(Math.random()*pool2.length)];
  return WALKABLE_PTS.length ? WALKABLE_PTS[Math.floor(Math.random()*WALKABLE_PTS.length)] : {x:cx,y:cy};
}

function raycast(ox, oy, angle, maxD) {
  const steps = 6;
  const stepD = maxD / steps;
  for (let i = 1; i <= steps; i++) {
    const d = i * stepD;
    if (checkColNPC(ox + Math.cos(angle)*d, oy + Math.sin(angle)*d)) return d - stepD;
  }
  return maxD;
}
function buildNpcId(x, y, inter) {
  return `npc-${Math.round(x)}-${Math.round(y)}-${identificarProfesor(inter) || 'Profesor'}`;
}

class NPC {
  constructor(name, tiles, x, y, inter) {
    this.name  = name; this.tiles = tiles;
    this.x = x; this.y = y; this.bx = x; this.by = y;
    this.originX = x; this.originY = y;
    this.id = buildNpcId(x, y, inter);
    this.tx = x; this.ty = y; this.inter = inter;
    this.speed      = 42 + Math.random() * 16;
    this.waitTimer  = Math.random() * 0.6;
    this.stuckTimer = 0;
    this.escapeTimer= 0;
    this.steerOffset= 0;
    this.steerDir   = 1;
    this.patrolRadius = Math.random() < 0.4 ? 340 : 190;
    this._pickNewTarget();
  }
  _pickNewTarget() {
    const pt = walkableNear(this.bx, this.by, this.patrolRadius);
    this.tx = pt.x; this.ty = pt.y;
    this.waitTimer  = 0.2 + Math.random() * 0.9;
    this.stuckTimer = 0;
    this.escapeTimer= 0;
    this.steerOffset= 0;
    this.steerDir   = Math.random() < 0.5 ? 1 : -1;
  }
  _hardEscape() {
    const cx=this.x, cy=this.y;
    const near=WALKABLE_PTS
      .map(p=>({p,d:Math.hypot(p.x-cx,p.y-cy)}))
      .filter(o=>o.d>10 && o.d<220)
      .sort((a,b)=>a.d-b.d);
    if (near.length) {
      const pick=near[Math.floor(Math.random()*Math.min(6,near.length))];
      this.x=pick.p.x; this.y=pick.p.y;
    }
    if (Math.hypot(this.x-this.bx,this.y-this.by)>300) {this.bx=this.x; this.by=this.y;}
    this._pickNewTarget();
  }
  update(dt) {
    const playerDist = Math.hypot(this.x - world.player.x, this.y - world.player.y);
    if (playerDist < 26) return;
    if (this.waitTimer > 0) { this.waitTimer -= dt; return; }

    if (Math.hypot(this.x - this.bx, this.y - this.by) > this.patrolRadius * 1.35) {
      const back = walkableNear(this.bx, this.by, 90);
      this.tx = back.x;
      this.ty = back.y;
      this.steerOffset = 0;
    }

    if (Math.hypot(this.x - this.tx, this.y - this.ty) < 8) {
      this._pickNewTarget();
      return;
    }

    const baseAngle = Math.atan2(this.ty - this.y, this.tx - this.x);
    const playerBias = playerDist < 180 ? Math.atan2(this.y - world.player.y, this.x - world.player.x) : baseAngle;
    const smartAngle = (baseAngle * 0.65) + (playerBias * 0.35) + (this.steerOffset * 0.35);

    const candidates = [
      smartAngle - 0.0,
      smartAngle - 0.35,
      smartAngle + 0.35,
      smartAngle - 0.70,
      smartAngle + 0.70,
      smartAngle - 1.05,
      smartAngle + 1.05,
    ];

    let best = null;
    let bestScore = -Infinity;
    for (const angle of candidates) {
      const ray = raycast(this.x, this.y, angle, 28);
      const dx = Math.cos(angle) * this.speed * dt;
      const dy = Math.sin(angle) * this.speed * dt;
      const nextX = this.x + dx;
      const nextY = this.y + dy;
      const collision = checkColNPC(nextX, nextY);
      const toTarget = Math.hypot(this.tx - nextX, this.ty - nextY);
      const toPlayer = Math.hypot(world.player.x - nextX, world.player.y - nextY);
      const avoidOthers = world.npcs
        .filter(other => other !== this)
        .map(other => Math.hypot(nextX - other.x, nextY - other.y))
        .reduce((a, b) => Math.min(a, b), Infinity);
      const openness = ray / 28;
      let score = (1000 / (toTarget + 1)) + (openness * 35) + (avoidOthers > 18 ? 18 : 0);
      if (playerDist < 120) {
        score += toPlayer > 40 ? 10 : -18;
      }
      if (!collision) {
        score += 18;
      }
      if (score > bestScore) {
        bestScore = score;
        best = { angle, dx, dy };
      }
    }

    if (!best) {
      this._pickNewTarget();
      return;
    }

    this.steerOffset = (this.steerOffset * 0.7) + (best.angle - baseAngle) * 0.3;
    let movedX = false;
    let movedY = false;
    if (!checkColNPC(this.x + best.dx, this.y)) { this.x += best.dx; movedX = true; }
    if (!checkColNPC(this.x, this.y + best.dy)) { this.y += best.dy; movedY = true; }

    for (const other of world.npcs) {
      if (other === this) continue;
      const dx = this.x - other.x;
      const dy = this.y - other.y;
      const dist = Math.hypot(dx, dy);
      if (dist < 16 && dist > 0) {
        const push = (16 - dist) / 16 * 2.8;
        this.x += (dx / dist) * push;
        this.y += (dy / dist) * push;
      }
    }

    if (!movedX && !movedY) {
      this.stuckTimer += dt;
      this.escapeTimer += dt;
      if (this.stuckTimer > 0.18) this._pickNewTarget();
      if (this.escapeTimer > 0.8) this._hardEscape();
    } else {
      this.stuckTimer = 0;
      this.escapeTimer = Math.max(0, this.escapeTimer - dt * 1.2);
    }
  }
  draw() {
    ctx.fillStyle = "rgba(0,0,0,0.28)";
    ctx.beginPath();
    ctx.ellipse(Math.floor(this.x), Math.floor(this.y + 3), 7, 3, 0, 0, Math.PI * 2);
    ctx.fill();
    this.tiles.forEach(t => {
      const info = getTile(t.gid);
      if (info) ctx.drawImage(info.ts.img, info.sx, info.sy, 16, 16,
        Math.floor(this.x + t.dx - 16), Math.floor(this.y + t.dy - 16), 16, 16);
    });
  }
}

const canvas = document.getElementById("game");
const ctx = canvas.getContext("2d", { alpha: false });
let ZOOM = 3;
if (window.innerWidth < 900) {
  ZOOM = 1.5;
}

const world = {
  map: null, tilesets: [], cameraX: 0, cameraY: 0,
  player: { x: 0, y: 0, speed: 130, sprite: null, dir: 'D' },
  npcs: [], collisions: [], interactions: [],
  carpaBBox: { x:0, y:0, w:0, h:0 },
  lastTime: 0
};


// ====== PORTED: Robust professor/materia mapping logic from index_old.html ======
const zonasProfesores = {
  130: "Miguel",
  132: "Enrique",
  135: "Espindola",
  137: "Manuel",
  138: "Meza",
  140: "Herson",
  141: "Carolina",
  142: "Refugio & Padilla"
};

function getProp(obj, name) {
  if (!obj) return null;
  if (obj[name] !== undefined) return obj[name];
  const names = [name, name.toLowerCase(), 'profesor','Profesor','maestro','Maestro','nombreProfesor','nombre','teacher'];
  if (Array.isArray(obj.properties)) {
    for (const p of obj.properties) {
      if (names.includes(p.name) || names.includes(String(p.name))) return (p.value !== undefined ? p.value : p);
    }
  } else if (obj.properties && typeof obj.properties === 'object') {
    for (const n of names) {
      if (obj.properties[n] !== undefined) return obj.properties[n].value ?? obj.properties[n];
    }
  }
  return null;
}

function identificarProfesor(obj) {
  if (!obj) return null;
  if (typeof obj.id !== 'undefined' && zonasProfesores[obj.id]) return zonasProfesores[obj.id];
  const candidates = [
    obj.nombreProfesor,
    obj.profesor,
    getProp(obj, 'profesor'),
    getProp(obj, 'maestro'),
    getProp(obj, 'nombreProfesor'),
    obj.name
  ];
  for (const cand of candidates) {
    if (cand && String(cand).trim()) {
      const s = String(cand).trim();
      const m = s.match(/([A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(\s&\s?[A-ZÁÉÍÓÚÑa-záéíóúñ]+)?(\s[A-ZÁÉÍÓÚÑa-záéíóúñ]+)*)$/);
      return (m ? m[0] : s);
    }
  }
  return null;
}

function getInteraccionActual() {
  try {
    const foot = { x: world.player.x - 6, y: world.player.y + 6, width: 12, height: 12 };
    let best = null, bestDist2 = Infinity;
    const centroidOf = (o) => {
      if (Array.isArray(o.points) && o.points.length) {
        let sx = 0, sy = 0;
        for (const p of o.points) { sx += p.x; sy += p.y; }
        return { x: sx / o.points.length, y: sy / o.points.length };
      }
      return { x: (o.x || 0) + (o.width || 0)/2, y: (o.y || 0) + (o.height || 0)/2 };
    };
    for (const obj of (world.interactions || [])) {
      if (!obj) continue;
      let intersects = false;
      if (Array.isArray(obj.points) && obj.points.length) {
        const corners = [
          { x: foot.x, y: foot.y },
          { x: foot.x + foot.width, y: foot.y },
          { x: foot.x, y: foot.y + foot.height },
          { x: foot.x + foot.width, y: foot.y + foot.height }
        ];
        if (corners.some(c => pointInPolygon(c.x, c.y, obj.points))) intersects = true;
      } else {
        const rect = { x: obj.x || 0, y: obj.y || 0, width: obj.width || 0, height: obj.height || 0 };
        if (intersectsRect(foot, rect)) intersects = true;
      }
      if (!intersects) continue;
      const c = centroidOf(obj);
      const dx = c.x - world.player.x, dy = c.y - world.player.y;
      const dist2 = dx*dx + dy*dy;
      if (dist2 < bestDist2) {
        bestDist2 = dist2;
        const nombreProfesor = identificarProfesor(obj) || null;
        const materia = getProp(obj, 'materia') || getProp(obj, 'asignatura') || null;
        best = Object.assign({}, obj, { nombreProfesor, materia });
      }
    }
    return best;
  } catch (err) {
    console.warn("getInteraccionActual fallo:", err);
    return null;
  }
}

function intersectsRect(a, b) {
  return !(a.x + a.width <= b.x ||
           a.x >= b.x + b.width ||
           a.y + a.height <= b.y ||
           a.y >= b.y + b.height);
}

function pointInPolygon(x, y, points) {
  if (!Array.isArray(points) || points.length === 0) return false;
  let inside = false;
  for (let i = 0, j = points.length - 1; i < points.length; j = i++) {
    const xi = points[i].x, yi = points[i].y;
    const xj = points[j].x, yj = points[j].y;
    const intersect = ((yi > y) !== (yj > y)) &&
      (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
    if (intersect) inside = !inside;
  }
  return inside;
}


// ---

const KEYS=new Set(); window.onkeydown=e=>KEYS.add(e.key.toLowerCase()); window.onkeyup=e=>KEYS.delete(e.key.toLowerCase());
const PLAYER_GENDER = '<?php echo $player_gender; ?>';
const dirMap = {L:'Izquierda',R:'Derecha',U:'Atras',D:'Frente'};
const sprites = {L:[],R:[],U:[],D:[]};
function loadSprites() {
  const p = PLAYER_GENDER;
  for (const [d,name] of Object.entries(dirMap)) {
    sprites[d] = [];
    for (let i = 1; i <= 3; i++) {
      const img = new Image();
      img.src = `./${p}_${name}${i}.png`;
      sprites[d].push(img);
    }
  }
}
loadSprites();
let isMoving = false;
let lastDirection = 'D';
let animFrame = 0;
let animTimer = 0;
let autosaveTimer = 0;
const ANIM_SPEED = 160;
function getTile(gid) {
  const raw=gid; gid&=~0xE0000000; if(!gid)return null; const ts=world.tilesets.find(t=>gid>=t.firstgid&&gid<=t.lastgid);
  if(!ts)return null; const lid=gid-ts.firstgid; return {ts,sx:(lid%ts.cols)*16,sy:Math.floor(lid/ts.cols)*16,raw};
}
function updateGame(dt) {
  let dx = 0, dy = 0;
  if (KEYS.has("arrowleft")  || KEYS.has("a")) { dx = -1; world.player.dir = 'L'; }
  else if (KEYS.has("arrowright") || KEYS.has("d")) { dx =  1; world.player.dir = 'R'; }
  if (KEYS.has("arrowup")    || KEYS.has("w")) { dy = -1; world.player.dir = 'U'; }
  else if (KEYS.has("arrowdown")  || KEYS.has("s")) { dy =  1; world.player.dir = 'D'; }

  isMoving = (dx !== 0 || dy !== 0);
  if (isMoving && window.__dismissTutorial) window.__dismissTutorial();

  if (isMoving) {
    lastDirection = world.player.dir;
    animTimer += dt * 1000;
    if (animTimer >= ANIM_SPEED) {
      animTimer -= ANIM_SPEED;
      animFrame = (animFrame + 1) % 3;
    }
  } else {
    animTimer = 0;
    animFrame = 0;
  }

  if (dx || dy) {
    const mag  = Math.hypot(dx, dy);
    const mx   = (dx / mag) * world.player.speed * dt;
    const my   = (dy / mag) * world.player.speed * dt;
    if (!checkColPlayer(world.player.x + mx, world.player.y) &&
        !checkEntityCol(world.player.x + mx, world.player.y, null))
      world.player.x += mx;
    if (!checkColPlayer(world.player.x, world.player.y + my) &&
        !checkEntityCol(world.player.x, world.player.y + my, null))
      world.player.y += my;
  }

  world.cameraX += (world.player.x - canvas.width  / (2 * ZOOM) - world.cameraX) * 0.15;
  world.cameraY += (world.player.y - canvas.height / (2 * ZOOM) - world.cameraY) * 0.15;

  autosaveTimer += dt;
  if (autosaveTimer >= 0.5) {
    saveState();
    autosaveTimer = 0;
  }


  // ====== NUEVA LÓGICA DE INTERACCIÓN CON PROFESORES ======
  const INTERACT_DIST = 28;
  const nearNpc = world.npcs.find(n =>
    Math.hypot(n.x - world.player.x, n.y - world.player.y) < INTERACT_DIST
  );
  const ui = document.getElementById("interaction");
  if (nearNpc) {
    // Buscar la interacción más cercana (como en index_old.html)
    let inter = null;
    if (nearNpc.inter) {
      inter = nearNpc.inter;
    } else {
      // fallback: buscar interacción cercana
      inter = getInteraccionActual();
    }
    let nombre = nearNpc.name;
    let materia = null;
    if (inter) {
      nombre = identificarProfesor(inter) || nearNpc.name;
      materia = getProp(inter, 'materia') || getProp(inter, 'asignatura') || null;
    }
    ui.style.display = "block";
    ui.innerText = `[E] HABLAR CON ${nombre ? nombre.toUpperCase() : 'PROFESOR'}` + (materia ? ` — ${materia}` : '');
    if (KEYS.has("e")) {
      saveState();
      // Redirigir igual que en index_old.html: si hay materia, usarla; si no, usar profesor
      const basePath = window.location.pathname.replace(/\/mapa\/.*$/, '');
      const dashboardUrl = materia 
        ? `${basePath}/dashboard.php?materia=${encodeURIComponent(materia)}`
        : `${basePath}/dashboard.php?profesor=${encodeURIComponent(nombre)}`;
      window.location.href = dashboardUrl;
    }
  } else {
    ui.style.display = "none";
  }

  if (KEYS.has("escape")) { document.getElementById("pauseMenu").style.display = 'block'; KEYS.delete("escape"); }
}
function saveState(){
  localStorage.setItem(P_KEY, JSON.stringify({x:world.player.x,y:world.player.y}));
  localStorage.setItem(NPC_KEY, JSON.stringify(world.npcs.map(n => ({
    id: n.id || `npc-${Math.round(n.x)}-${Math.round(n.y)}-${n.name}`,
    x: n.x, y: n.y,
    bx: n.bx ?? n.x,
    by: n.by ?? n.y,
    tx: n.tx ?? n.x,
    ty: n.ty ?? n.y,
    patrolRadius: n.patrolRadius ?? 190,
    speed: n.speed ?? 42,
    waitTimer: n.waitTimer ?? 0,
    steerOffset: n.steerOffset ?? 0,
    steerDir: n.steerDir ?? 1
  }))));
  localStorage.setItem(P_KEY + '_ts', Date.now().toString());
}
function renderLayer(l){
  if(!l.chunks)return; const vw=canvas.width/ZOOM+32, vh=canvas.height/ZOOM+32;
  l.chunks.forEach(chk=>{
    const cx=chk.x*16, cy=chk.y*16;
    if(cx+chk.width*16<world.cameraX||cx>world.cameraX+vw||cy+chk.height*16<world.cameraY||cy>world.cameraY+vh)return;
    for(let r=0; r<chk.height; r++) {
      for(let c=0; c<chk.width; c++) {
        const gid=chk.data[r*chk.width+c];
        if(!gid) continue;
        const info = getTile(gid);
        if(!info) continue;
        const tx = (chk.x+c)*16, ty = (chk.y+r)*16;
        if(tx+16<world.cameraX||tx>world.cameraX+vw||ty+16<world.cameraY||ty>world.cameraY+vh) continue;
        const fH=info.raw&0x80000000, fV=info.raw&0x40000000, fD=info.raw&0x20000000;
        ctx.save(); ctx.translate(tx+8,ty+8);
        if(fD){ctx.rotate(Math.PI/2); ctx.scale(fV?-1:1,fH?-1:1);} else ctx.scale(fH?-1:1,fV?-1:1);
        ctx.drawImage(info.ts.img, info.sx,info.sy,16,16, -8,-8,16,16); ctx.restore();
      }
    }
  });
}
function draw(){
  ctx.imageSmoothingEnabled=false; ctx.fillStyle="#000"; ctx.fillRect(0,0,canvas.width,canvas.height); ctx.save(); ctx.scale(ZOOM,ZOOM); ctx.translate(-Math.floor(world.cameraX),-Math.floor(world.cameraY));
  if(world.map) world.map.layers.filter(l=>l.type==="tilelayer"&&l.visible&&l.name!=="Techo"&&l.name!=="Maestros"&&l.name!=="Edificios2").forEach(l=>renderLayer(l));
  const pEnt={y:world.player.y,draw(){
    ctx.fillStyle="rgba(0,0,0,0.28)"; ctx.beginPath(); ctx.ellipse(Math.floor(world.player.x),Math.floor(world.player.y+3),7,3,0,0,Math.PI*2); ctx.fill();
    const dir = isMoving ? world.player.dir : 'D';
    const frames = sprites[dir];
    const idx = isMoving ? animFrame : 0;
    const img = frames[idx];
    ctx.drawImage(img, Math.floor(world.player.x-10), Math.floor(world.player.y-17), 20, 20);
  }};
  [...world.npcs,pEnt].sort((a,b)=>a.y-b.y).forEach(e=>e.draw());
  if(world.map) world.map.layers.filter(l=>(l.name==="Techo"||l.name==="Edificios2")&&l.visible).forEach(l=>renderLayer(l)); ctx.restore();
}
function frame(t){ const dt=Math.min((t-world.lastTime)/1000,0.1); world.lastTime=t; if(canvas.width!==window.innerWidth||canvas.height!==window.innerHeight){canvas.width=window.innerWidth; canvas.height=window.innerHeight;} updateGame(dt); world.npcs.forEach(n=>n.update(dt)); draw(); requestAnimationFrame(frame); }
async function init(){
  try {
    // Esperar a que el mapa esté cargado
    if (!world.map) {
      // Cargar el mapa primero
      world.map = await fetch("./Mapa.json").then(r=>r.json());
      // Cargar tilesets
      world.tilesets = await Promise.all(world.map.tilesets.map(async ts=>{
        const resp=await fetch(`./tilesets/${ts.source.split('/').pop()}`); if(!resp.ok)return null;
        const xml=new DOMParser().parseFromString(await resp.text(),"application/xml"), img=new Image(), src=new URL(xml.querySelector("image").getAttribute("source"),new URL(`./tilesets/${ts.source.split('/').pop()}`,window.location.href)).href;
        img.src=src; await new Promise(res=>{img.onload=res; img.onerror=()=>res();});
        return {firstgid:ts.firstgid,lastgid:ts.firstgid+parseInt(xml.querySelector("tileset").getAttribute("tilecount"))-1,cols:parseInt(xml.querySelector("tileset").getAttribute("columns")),img};
      })).then(arr=>arr.filter(Boolean).sort((a,b)=>a.firstgid-b.firstgid));
      // Normalizar objetos de colisión e interacción
      const norm=o=>{const c={...o}; if(o.polygon)c.points=o.polygon.map(p=>({x:o.x+p.x,y:o.y+p.y})); else{c.width=o.width||16; c.height=o.height||16;} return c;};
      world.collisions=(world.map.layers.find(l=>l.name==='Coliciones')?.objects||[]).map(norm); world.interactions=(world.map.layers.find(l=>l.name==='Interacciones')?.objects||[]).map(norm);
      buildWalkableGrid();
    }
    // Calcular spawn del jugador igual que en index_old.html
    const firstLayer = world.map.layers.find(l => l.type === 'tilelayer' && l.chunks && l.chunks.length);
    if (firstLayer) {
      const firstChunk = firstLayer.chunks[0];
      const spawnOffsetY = 960;
      const spawnOffsetX = 490;
      const spawnX = (firstChunk.x + firstChunk.width / 2) * world.map.tilewidth + spawnOffsetX;
      const spawnY = (firstChunk.y + firstChunk.height / 2) * world.map.tileheight + spawnOffsetY;
      // Restaurar posición guardada si existe
      let restored = null;
      try {
        const raw = localStorage.getItem(P_KEY);
        if (raw) {
          const p = JSON.parse(raw);
          if (typeof p.x === 'number' && typeof p.y === 'number') restored = p;
        }
      } catch(e){}
      world.player.x = restored ? restored.x : spawnX;
      world.player.y = restored ? restored.y : spawnY;
      world.cameraX = world.player.x - (canvas.width / (2 * ZOOM));
      world.cameraY = world.player.y - (canvas.height / (2 * ZOOM));
    }
    // Cargar NPCs de la capa Maestros
    const mLayer = world.map.layers.find(l=>l.name==='Maestros');
    if (mLayer?.chunks) {
      const groups = new Map();
      mLayer.chunks.forEach(c => {
        for (let r=0; r<c.height; r++) for (let col=0; col<c.width; col++) {
          const gid = c.data[r*c.width+col]; if (gid < 3200) continue;
          c.data[r*c.width+col] = 0;
          const tx=(c.x+col)*16, ty=(c.y+r)*16;
          let g = [...groups.values()].find(g => Math.hypot(g.x-tx,g.y-ty)<64);
          if (!g) { g={x:tx,y:ty,tiles:[]}; groups.set(`${tx},${ty}`, g); }
          g.tiles.push({dx:tx-g.x, dy:ty-g.y, gid});
        }
      });
      let restoredNpcs = [];
      try { restoredNpcs = JSON.parse(localStorage.getItem(NPC_KEY) || '[]'); } catch (e) { restoredNpcs = []; }
      groups.forEach((g) => {
        const inter = world.interactions.find(i => Math.hypot(i.x-g.x, i.y-g.y)<96);
        const safe = resolveSpawn(g.x, g.y);
        const npc  = new NPC("Profesor", g.tiles, safe.x, safe.y, inter);
        npc.id = buildNpcId(safe.x, safe.y, inter);
        npc.bx = safe.x; npc.by = safe.y;
        const saved = restoredNpcs.find(s => s.id === npc.id || s.id === `npc-${Math.round(safe.x)}-${Math.round(safe.y)}-Profesor`) || null;
        if (saved) {
          npc.x = saved.x ?? npc.x;
          npc.y = saved.y ?? npc.y;
          npc.bx = saved.bx ?? npc.bx;
          npc.by = saved.by ?? npc.by;
          npc.tx = saved.tx ?? npc.tx;
          npc.ty = saved.ty ?? npc.ty;
          npc.patrolRadius = saved.patrolRadius ?? npc.patrolRadius;
          npc.speed = saved.speed ?? npc.speed;
          npc.waitTimer = saved.waitTimer ?? npc.waitTimer;
          npc.steerOffset = saved.steerOffset ?? npc.steerOffset;
          npc.steerDir = saved.steerDir ?? npc.steerDir;
        }
        world.npcs.push(npc);
      });
    }
    requestAnimationFrame(frame);
  } catch(e){
    console.error(e);
  }
  } 
const bind=(id,k,p=false)=>{ const el=document.getElementById(id); if(!el)return; const s=e=>{e.preventDefault(); KEYS.add(k); if(p)setTimeout(()=>KEYS.delete(k),100);}; el.addEventListener('touchstart',s,{passive:false}); el.addEventListener('touchend',e=>{e.preventDefault(); KEYS.delete(k);}); el.addEventListener('mousedown',s); el.addEventListener('mouseup',()=>KEYS.delete(k)); };
bind("btnUp","arrowup"); bind("btnDown","arrowdown"); bind("btnLeft","arrowleft"); bind("btnRight","arrowright"); bind("btnE","e",true); bind("btnEsc","escape",true);

// ── Virtual Joystick ──
(function(){
  var area = document.getElementById('joystickArea');
  var knob = document.getElementById('joystickKnob');
  if (!area || !knob) return;
  var dirKeys = ['arrowleft','arrowright','arrowup','arrowdown'];
  var touchId = null;
  function center() {
    var r = area.getBoundingClientRect();
    return { x: r.left + r.width/2, y: r.top + r.height/2 };
  }
  function update(t) {
    var c = center();
    var dx = t.clientX - c.x, dy = t.clientY - c.y;
    var maxR = area.offsetWidth/2 - 24;
    var dist = Math.sqrt(dx*dx + dy*dy);
    var clamped = Math.min(dist, maxR);
    var angle = Math.atan2(dy, dx);
    knob.style.transform = 'translate(calc(-50% + ' + (Math.cos(angle)*clamped) + 'px), calc(-50% + ' + (Math.sin(angle)*clamped) + 'px))';
    dirKeys.forEach(function(k){KEYS.delete(k);});
    if (dist > 14) {
      if (angle > -Math.PI/4 && angle <= Math.PI/4) KEYS.add('arrowright');
      else if (angle > Math.PI/4 && angle <= 3*Math.PI/4) KEYS.add('arrowdown');
      else if (angle > 3*Math.PI/4 || angle <= -3*Math.PI/4) KEYS.add('arrowleft');
      else KEYS.add('arrowup');
    }
  }
  function reset() {
    touchId = null;
    knob.style.transform = 'translate(-50%, -50%)';
    dirKeys.forEach(function(k){KEYS.delete(k);});
  }
  area.addEventListener('touchstart', function(e){e.preventDefault();if(touchId!==null)return;touchId=e.changedTouches[0].identifier;},{passive:false});
  document.addEventListener('touchmove', function(e){if(touchId===null)return;for(var i=0;i<e.changedTouches.length;i++){if(e.changedTouches[i].identifier===touchId){update(e.changedTouches[i]);break;}}},{passive:false});
  document.addEventListener('touchend', function(e){for(var i=0;i<e.changedTouches.length;i++){if(e.changedTouches[i].identifier===touchId){reset();break;}}},{passive:false});
  document.addEventListener('touchcancel', function(e){for(var i=0;i<e.changedTouches.length;i++){if(e.changedTouches[i].identifier===touchId){reset();break;}}},{passive:false});
})();
init();
</script>
</div>
<audio id="mapMusic1"></audio>
<audio id="mapMusic2"></audio>
<script>
const STORAGE_KEY = 'lc_volume_settings';
function getStoredVolumes() {
  const stored = localStorage.getItem(STORAGE_KEY);
  if (stored) return JSON.parse(stored);
  return { principal: 1.0, ambiental: 0.8, examenes: 0.8 };
}
function saveVolumes(v) {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(v));
}
const volumes = getStoredVolumes();
const mapSongs = [
  { src: '../assets/music/cuco_día_alt.mp3', vol: volumes.ambiental },
  { src: '../assets/music/cuco_dia.mp3', vol: volumes.ambiental * 0.5 },
  { src: '../assets/music/cuco-lost.mp3', vol: volumes.ambiental }
];
let currentTrack = 0;
let activePlayer = 1;
const audio1 = document.getElementById('mapMusic1');
const audio2 = document.getElementById('mapMusic2');
const CROSSFADE_TIME = 2000;

document.getElementById('volAmbiental').value = volumes.ambiental;
document.getElementById('volAmbiental').addEventListener('input', (e) => {
  const v = parseFloat(e.target.value);
  volumes.ambiental = v;
  saveVolumes(volumes);
  mapSongs.forEach((song, i) => { mapSongs[i].vol = i === 1 ? v * 0.5 : v; });
  const currentPlayer = activePlayer === 1 ? audio1 : audio2;
  currentPlayer.volume = v;
});

function crossfadePlay(trackIndex) {
  const song = mapSongs[trackIndex];
  const nextPlayer = activePlayer === 1 ? audio2 : audio1;
  const currentPlayer = activePlayer === 1 ? audio1 : audio2;
  
  nextPlayer.src = song.src;
  nextPlayer.volume = 0;
  nextPlayer.play().then(() => console.log('Map music: ' + song.src)).catch(e => console.log('Audio error:', e));
  
  let start = null;
  function fade(timestamp) {
    if (!start) start = timestamp;
    const progress = Math.min((timestamp - start) / CROSSFADE_TIME, 1);
    nextPlayer.volume = progress * song.vol;
    currentPlayer.volume = (1 - progress) * song.vol;
    if (progress < 1) requestAnimationFrame(fade);
  }
  requestAnimationFrame(fade);
  
  activePlayer = activePlayer === 1 ? 2 : 1;
}

function playNext() {
  currentTrack = (currentTrack + 1) % mapSongs.length;
  crossfadePlay(currentTrack);
}

audio1.addEventListener('ended', playNext);
audio2.addEventListener('ended', playNext);
crossfadePlay(0);

</script>
<script src="../assets/js/volume_manager.js"></script>
<script>if (typeof initPageAudio === 'function') { initPageAudio('mapMusic1'); initPageAudio('mapMusic2'); }</script>

function cambiarPersonaje(genero) {
  PLAYER_GENDER = genero;
  loadSprites();
  const charM = document.getElementById('charM');
  const charW = document.getElementById('charW');
  const charCurrent = document.getElementById('char' + genero);
  if (charM) charM.classList.remove('active');
  if (charW) charW.classList.remove('active');
  if (charCurrent) charCurrent.classList.add('active');
  try { saveState(); } catch (e) { console.warn('No se pudo guardar la posición al cambiar personaje:', e); }

  fetch('../guardar_genero.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'genero=' + genero + '&invitado=' + (<?= !empty($_SESSION['usuario_es_invitado']) ? 'true' : 'false' ?> ? '1' : '0')
  });
}

// ── Controles toggle (Cruz / Joystick) ──
(function(){
  var pref = localStorage.getItem('ctrl_pref') || 'dpad';
  window.toggleControles = function(){
    var o = document.getElementById('ctrlOptions');
    o.style.display = o.style.display === 'none' ? 'flex' : 'none';
  };
  window.setControl = function(type){
    try { localStorage.setItem('ctrl_pref', type); } catch(e) {}
    document.querySelectorAll('.ctrl-opt').forEach(function(b){
      b.classList.toggle('active', b.textContent.trim() === (type==='dpad' ? 'CRUZ' : 'JOYSTICK'));
    });
    var dpad = document.querySelector('.dpad');
    if (dpad) dpad.style.display = type === 'dpad' ? 'grid' : 'none';
    var ja = document.getElementById('joystickArea');
    if (ja) ja.style.display = type === 'joystick' ? 'block' : 'none';
  };
  setControl(pref);
})();

// ── Musica toggle ──
window.toggleMusica = function(){
  var o = document.getElementById('musicOptions');
  if (!o) return;
  o.style.display = o.style.display === 'none' ? 'block' : 'none';
};

// ── Tutorial overlay (ASDW) — first visit only (desktop only) ──
(function() {
  if (window.innerWidth < 900) return;
  var overlay = document.getElementById('tutorialOverlay');
  if (!overlay) return;
  var key = P_KEY + '_tutorial';
  if (localStorage.getItem(key) === '1') {
    overlay.classList.add('dismissed');
    return;
  }
  window.__dismissTutorial = function() {
    if (overlay.classList.contains('dismissed')) return;
    overlay.classList.add('dismissed');
    try { localStorage.setItem(key, '1'); } catch(e) {}
  };
  overlay.addEventListener('click', window.__dismissTutorial);
})();

try { document.getElementById('char' + PLAYER_GENDER).classList.add('active'); } catch(e) {}

function guardarPosYIr() {
  try {
    saveState();
  } catch (e) {
    console.warn('No se pudo guardar la posición antes de cambiar personaje:', e);
  }
  window.location.href = '../seleccionar_personaje.php?from=mapa';
}
</script>
</body>
</html>