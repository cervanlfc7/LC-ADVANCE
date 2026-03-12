<?php
require_once '../config/config.php';
requireLogin();
$session_key = "map.player_pos_" . ($_SESSION['usuario_id'] ?? 'guest');
$npc_key = "map.npc_pos_" . ($_SESSION['usuario_id'] ?? 'guest');
?>
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
      background: rgba(10, 10, 20, 0.98); border: 3px solid var(--neon-cyan); padding: 44px 32px 36px 32px;
      text-align: center; z-index: 2000; backdrop-filter: blur(12px); box-shadow: 0 0 60px 0 var(--neon-cyan), 0 0 0 8px rgba(0,255,255,0.08);
      border-radius: 22px;
      min-width: 320px;
    }
    #pauseMenu h2 {
      color: var(--neon-cyan); margin-bottom: 32px; text-shadow: 0 0 16px var(--neon-cyan), 0 0 2px #fff;
      font-size: 1.2em;
      letter-spacing: 2px;
    }
    .menu-btns { display: flex; flex-direction: column; gap: 22px; }
    .menu-btns button {
      padding: 18px 0; background: #0a0a15; color: var(--neon-yellow); border: 2.5px solid var(--neon-yellow);
      cursor: pointer; font-family: 'Press Start 2P', monospace; font-size: 15px; border-radius: 12px;
      letter-spacing: 1px; text-shadow: 0 0 8px var(--neon-yellow), 0 0 2px #fff;
      box-shadow: 0 0 18px 0 var(--neon-yellow), 0 0 0 4px rgba(255,255,0,0.08);
      transition: background 0.18s, color 0.18s, box-shadow 0.18s, border-color 0.18s, transform 0.12s;
      outline: none;
    }
    .menu-btns button:hover, .menu-btns button:focus {
      background: var(--neon-yellow); color: #000; box-shadow: 0 0 32px var(--neon-yellow), 0 0 0 8px rgba(255,255,0,0.18);
      border-color: #fff700;
      transform: scale(1.04);
    }
    .menu-btns button.exit {
      border-color: var(--neon-pink); color: var(--neon-pink); background: #1a001a;
      box-shadow: 0 0 18px 0 var(--neon-pink), 0 0 0 4px rgba(255,0,255,0.08);
      text-shadow: 0 0 8px var(--neon-pink), 0 0 2px #fff;
    }
    .menu-btns button.exit:hover, .menu-btns button.exit:focus {
      background: var(--neon-pink); color: #fff; box-shadow: 0 0 32px var(--neon-pink), 0 0 0 8px rgba(255,0,255,0.18);
      border-color: #fff;
    }
    .menu-btns button.reset {
      border-color: #39ff14; color: #39ff14; background: #0a1a0a;
      box-shadow: 0 0 18px 0 #39ff14, 0 0 0 4px rgba(57,255,20,0.08);
      text-shadow: 0 0 8px #39ff14, 0 0 2px #fff;
    }
    .menu-btns button.reset:hover, .menu-btns button.reset:focus {
      background: #39ff14; color: #000; box-shadow: 0 0 32px #39ff14, 0 0 0 8px rgba(57,255,20,0.18);
      border-color: #fff;
    }
    
    #interaction {
      position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
      background: rgba(0,0,0,0.8); color: white; border: 2px solid var(--neon-cyan);
      padding: 15px 30px; font-size: 11px; z-index: 500; display: none;
      box-shadow: 0 0 20px rgba(0,255,255,0.2); pointer-events: none;
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
    @media (min-width: 1025px) { .mobile-controls { display: none !important; } }
  </style>
</head>
<body onclick="window.focus();">
  <div class="viewport crt">
    <div id="pauseMenu">
      <h2>// SISTEMA_PAUSADO</h2>
      <div class="menu-btns">
        <button onclick="document.getElementById('pauseMenu').style.display='none'">▶ CONTINUAR</button>
        <button class="reset" onclick="localStorage.removeItem('<?php echo $session_key; ?>'); localStorage.removeItem('<?php echo $npc_key; ?>'); location.reload();">⟳ RESET POSICIÓN</button>
        <button class="exit" onclick="window.location.href='../index.php'">⏻ SALIR</button>
      </div>
    </div>
    <div id="interaction">INTERACTUAR [E]</div>
    <canvas id="game"></canvas>
    <div class="mobile-controls">
      <div class="dpad">
        <div></div><div class="btn" id="btnUp">▲</div><div></div>
        <div class="btn" id="btnLeft">◀</div><div></div><div class="btn" id="btnRight">▶</div>
        <div></div><div class="btn" id="btnDown">▼</div><div></div>
      </div>
      <div style="display:flex; flex-direction:column; gap:15px;">
        <button class="act-btn" id="btnE">💬 HABLAR</button>
        <button class="act-btn exit" id="btnEsc">⏸ PAUSA</button>
      </div>
    </div>
 <script type="module">

// ===== LÓGICA DE IDENTIFICACIÓN Y MOVIMIENTO DE PROFESORES (ROBUSTA) =====
const PROFESORES = { 130:"Miguel", 132:"Enrique", 135:"Espindola", 137:"Manuel", 138:"Meza", 140:"Herson", 141:"Carolina", 142:"Refugio & Padilla" };

function linesIntersect(p1, p2, p3, p4) {
  const denom = (p1.x - p2.x) * (p3.y - p4.y) - (p1.y - p2.y) * (p3.x - p4.x);
  if (denom === 0) return false;
  const t = ((p1.x - p3.x) * (p3.y - p4.y) - (p1.y - p3.y) * (p3.x - p4.x)) / denom;
  const u = ((p1.x - p3.x) * (p1.y - p2.y) - (p1.y - p3.y) * (p1.x - p2.x)) / denom;
  return t >= 0 && t <= 1 && u >= 0 && u <= 1;
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

class NPC {
  constructor(name, tiles, x, y, inter) {
    this.name  = name; this.tiles = tiles;
    this.x = x; this.y = y; this.bx = x; this.by = y;
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
    if (Math.hypot(this.x-world.player.x, this.y-world.player.y) < 26) return;
    if (this.waitTimer > 0) { this.waitTimer -= dt; return; }
    if (Math.hypot(this.x-this.bx, this.y-this.by) > this.patrolRadius*1.3) {
      const back=walkableNear(this.bx, this.by, 80);
      this.tx=back.x; this.ty=back.y; this.steerOffset=0;
    }
    if (Math.hypot(this.x-this.tx, this.y-this.ty) < 6) {
      this._pickNewTarget(); return;
    }
    const baseAngle = Math.atan2(this.ty-this.y, this.tx-this.x);
    const RAY = 32;
    const freeAhead = raycast(this.x, this.y, baseAngle + this.steerOffset, RAY);
    if (freeAhead < RAY * 0.55) {
      this.steerOffset += this.steerDir * (Math.PI / 8);
      if (Math.abs(this.steerOffset) > Math.PI * 1.1) {
        this.steerDir   *= -1;
        this.steerOffset = this.steerDir * Math.PI / 8;
      }
    } else {
      this.steerOffset *= 0.82;
      if (Math.abs(this.steerOffset) < 0.05) this.steerOffset = 0;
    }
    const moveAngle = baseAngle + this.steerOffset;
    const sx = Math.cos(moveAngle) * this.speed * dt;
    const sy = Math.sin(moveAngle) * this.speed * dt;
    let movedX = false, movedY = false;
    if (!checkColNPC(this.x+sx, this.y)) { this.x += sx; movedX = true; }
    if (!checkColNPC(this.x, this.y+sy)) { this.y += sy; movedY = true; }
    for (const other of world.npcs) {
      if (other === this) continue;
      const dx = this.x - other.x, dy = this.y - other.y;
      const dist = Math.hypot(dx, dy);
      if (dist < 14 && dist > 0) {
        const push = (14 - dist) / 14 * 2.5;
        this.x += (dx/dist)*push; this.y += (dy/dist)*push;
      }
    }
    if (!movedX && !movedY) {
      this.stuckTimer  += dt;
      this.escapeTimer += dt;
      if (this.stuckTimer > 0.25) {
        this._pickNewTarget();
      }
      if (this.escapeTimer > 1.2) {
        this._hardEscape();
      }
    } else {
      this.stuckTimer  = 0;
      this.escapeTimer = Math.max(0, this.escapeTimer - dt*1.5);
    }
  }
  draw() {
    ctx.fillStyle = "rgba(0,0,0,0.28)";
    ctx.beginPath();
    ctx.ellipse(Math.floor(this.x), Math.floor(this.y + 6), 7, 3, 0, 0, Math.PI * 2);
    ctx.fill();
    this.tiles.forEach(t => {
      const info = getTile(t.gid);
      if (info) ctx.drawImage(info.ts.img, info.sx, info.sy, 16, 16,
        Math.floor(this.x + t.dx - 16), Math.floor(this.y + t.dy - 16), 16, 16);
    });
  }
}

const P_KEY = "<?php echo $session_key; ?>";
const NPC_KEY = "<?php echo $npc_key; ?>";
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
const sprites={ L:new Image(),R:new Image(),U:new Image(),D:new Image(), load:()=>{ sprites.L.src="./C_L.gif"; sprites.R.src="./C_R.gif"; sprites.U.src="./C_U.gif"; sprites.D.src="./C_D.gif"; } }; sprites.load();
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
      if (materia) {
        window.location.href = `../dashboard.php?materia=${encodeURIComponent(materia)}`;
      } else {
        window.location.href = `../dashboard.php?profesor=${encodeURIComponent(nombre)}`;
      }
    }
  } else {
    ui.style.display = "none";
  }

  if (KEYS.has("escape")) { document.getElementById("pauseMenu").style.display = 'block'; KEYS.delete("escape"); }
}
function saveState(){ localStorage.setItem(P_KEY,JSON.stringify({x:world.player.x,y:world.player.y})); localStorage.setItem(NPC_KEY,JSON.stringify(world.npcs.map(n=>({x:n.x,y:n.y})))); }
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
  const pEnt={y:world.player.y,draw(){ctx.fillStyle="rgba(0,0,0,0.28)"; ctx.beginPath(); ctx.ellipse(Math.floor(world.player.x),Math.floor(world.player.y+6),7,3,0,0,Math.PI*2); ctx.fill(); ctx.drawImage(sprites[world.player.dir],Math.floor(world.player.x-10),Math.floor(world.player.y-17),20,20);}};
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
      groups.forEach(g => {
        const inter = world.interactions.find(i => Math.hypot(i.x-g.x, i.y-g.y)<96);
        // Resolver spawn: empujar al NPC fuera de cualquier colisión
        const safe = resolveSpawn(g.x, g.y);
        const npc  = new NPC("Profesor", g.tiles, safe.x, safe.y, inter);
        // Actualizar base al punto seguro para que el rango de patrulla sea correcto
        npc.bx = safe.x; npc.by = safe.y;
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
init();
</script>
</div>
</body>
</html>