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
    
    /* Efecto CRT Estático Superior */
    .crt::after {
      content: " "; position: absolute; top: 0; left: 0; bottom: 0; right: 0;
      background: linear-gradient(rgba(18, 16, 16, 0.1) 50%, rgba(0, 0, 0, 0.1) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.05), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.05));
      background-size: 100% 4px, 4px 100%; pointer-events: none; z-index: 100;
    }

    #pauseMenu { 
      display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
      background: rgba(10, 10, 15, 0.95); border: 4px solid var(--neon-cyan); padding: 50px;
      text-align: center; z-index: 2000; backdrop-filter: blur(10px); box-shadow: 0 0 50px rgba(0,255,255,0.3);
    }
    #pauseMenu h2 { color: var(--neon-cyan); margin-bottom: 30px; text-shadow: 0 0 10px var(--neon-cyan); }
    .menu-btns { display: flex; flex-direction: column; gap: 20px; }
    .menu-btns button { 
      padding: 20px; background: #000; color: var(--neon-yellow); border: 2px solid var(--neon-yellow);
      cursor: pointer; font-family: 'Press Start 2P', monospace; font-size: 12px; transition: 0.2s;
    }
    .menu-btns button:hover { background: var(--neon-yellow); color: #000; box-shadow: 0 0 20px var(--neon-yellow); }
    
    #interaction {
      position: fixed; top: 30px; left: 50%; transform: translateX(-50%);
      background: rgba(0,0,0,0.8); color: white; border: 2px solid var(--neon-cyan);
      padding: 15px 30px; font-size: 11px; z-index: 500; display: none;
      box-shadow: 0 0 20px rgba(0,255,255,0.2); pointer-events: none;
    }

    .mobile-controls { position: fixed; bottom: 30px; left: 30px; right: 30px; display: flex; justify-content: space-between; z-index: 1000; }
    .dpad { display: grid; grid-template-columns: repeat(3, 70px); gap: 10px; }
    .btn { background: rgba(0,255,255,0.15); border: 2px solid var(--neon-cyan); color: var(--neon-cyan); border-radius: 50%; height: 70px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
    .act-btn { padding: 20px 40px; background: rgba(255,255,0,0.1); border: 2px solid var(--neon-yellow); color: var(--neon-yellow); border-radius: 12px; font-family: 'Press Start 2P', monospace; }
    @media (min-width: 1025px) { .mobile-controls { display: none !important; } }
  </style>
</head>
<body onclick="window.focus();">
  <div class="viewport crt">
    <div id="pauseMenu">
      <h2>// SISTEMA_PAUSADO</h2>
      <div class="menu-btns">
        <button onclick="document.getElementById('pauseMenu').style.display='none'">CONTINUAR</button>
        <button onclick="localStorage.removeItem('<?php echo $session_key; ?>'); localStorage.removeItem('<?php echo $npc_key; ?>'); location.reload();" style="border-color: #39ff14; color: #39ff14;">RESET POSICIÓN</button>
        <button onclick="window.location.href='../index.php'" style="border-color: var(--neon-pink); color: var(--neon-pink);">SALIR</button>
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
        <button class="act-btn" id="btnE">HABLAR</button>
        <button class="act-btn" id="btnEsc" style="border-color: var(--neon-pink); color: var(--neon-pink);">PAUSA</button>
      </div>
    </div>
  </div>

<script type="module">
const P_KEY = "<?php echo $session_key; ?>";
const NPC_KEY = "<?php echo $npc_key; ?>";
const canvas = document.getElementById("game");
const ctx = canvas.getContext("2d", { alpha: false });
const ZOOM = 3; 

const world = {
  map: null, tilesets: [], cameraX: 0, cameraY: 0,
  player: { x: 0, y: 0, speed: 130, sprite: null, dir: 'D' }, // Velocidad más lenta y natural
  npcs: [], collisions: [], interactions: [],
  lastTime: 0
};

const PROFESORES = { 130:"Miguel", 132:"Enrique", 135:"Espindola", 137:"Manuel", 138:"Meza", 140:"Herson", 141:"Carolina", 142:"Refugio & Padilla" };

// Función auxiliar para intersección de líneas
function linesIntersect(p1, p2, p3, p4) {
  const denom = (p1.x - p2.x) * (p3.y - p4.y) - (p1.y - p2.y) * (p3.x - p4.x);
  if (denom === 0) return false;
  const t = ((p1.x - p3.x) * (p3.y - p4.y) - (p1.y - p3.y) * (p3.x - p4.x)) / denom;
  const u = ((p1.x - p3.x) * (p1.y - p2.y) - (p1.y - p3.y) * (p1.x - p2.x)) / denom;
  return t >= 0 && t <= 1 && u >= 0 && u <= 1;
}

function intersects(rect, obj) {
  if (obj.points) { // Polígono
    // 1. Verificar si algún punto del polígono está dentro del rectángulo
    for (const p of obj.points) {
      if (p.x >= rect.x && p.x <= rect.x + rect.width && p.y >= rect.y && p.y <= rect.y + rect.height) return true;
    }

    // 2. Verificar si algún vértice del rectángulo está dentro del polígono (ray-casting para cada esquina)
    const rectPoints = [
      {x: rect.x, y: rect.y},
      {x: rect.x + rect.width, y: rect.y},
      {x: rect.x + rect.width, y: rect.y + rect.height},
      {x: rect.x, y: rect.y + rect.height}
    ];
    for (const rp of rectPoints) {
      let inside = false;
      for (let i = 0, j = obj.points.length - 1; i < obj.points.length; j = i++) {
        const xi = obj.points[i].x, yi = obj.points[i].y;
        const xj = obj.points[j].x, yj = obj.points[j].y;
        if (((yi > rp.y) !== (yj > rp.y)) && (rp.x < (xj - xi) * (rp.y - yi) / (yj - yi) + xi)) {
          inside = !inside;
        }
      }
      if (inside) return true;
    }

    // 3. Verificar si alguna arista del polígono intersecta alguna arista del rectángulo
    const rectEdges = [
      {s: {x: rect.x, y: rect.y}, e: {x: rect.x + rect.width, y: rect.y}},
      {s: {x: rect.x + rect.width, y: rect.y}, e: {x: rect.x + rect.width, y: rect.y + rect.height}},
      {s: {x: rect.x + rect.width, y: rect.y + rect.height}, e: {x: rect.x, y: rect.y + rect.height}},
      {s: {x: rect.x, y: rect.y + rect.height}, e: {x: rect.x, y: rect.y}}
    ];
    for (let i = 0; i < obj.points.length; i++) {
      const ps = obj.points[i];
      const pe = obj.points[(i + 1) % obj.points.length];
      for (const re of rectEdges) {
        if (linesIntersect(ps, pe, re.s, re.e)) return true;
      }
    }

    return false;
  }
  // Rectángulo simple
  return rect.x < obj.x + (obj.width || 16) && rect.x + rect.width > obj.x && rect.y < obj.y + (obj.height || 16) && rect.y + rect.height > obj.y;
}

function checkCol(x, y, w, h) {
  const r = { x, y, width: w, height: h };
  if (world.interactions.some(i => intersects(r, i))) return false; // Permitir pasar por interacciones
  return world.collisions.some(c => intersects(r, c));
}

// Colisión entre profesores (y jugador)
function checkNpcCol(nx, ny, ignoreNpc) {
  const r = { x: nx - 5, y: ny + 2, width: 10, height: 6 };
  return world.npcs.some(n => 
    n !== ignoreNpc && 
    intersects(r, { x: n.x - 5, y: n.y + 2, width: 10, height: 6 })
  );
}

class NPC {
  constructor(name, tiles, x, y, inter) {
    this.name = name; this.tiles = tiles; this.x = x; this.y = y; this.bx = x; this.by = y;
    this.tx = x; this.ty = y; this.inter = inter; this.timer = 1 + Math.random()*2;
    this.speed = 45;
  }
  update(dt) {
    if (Math.hypot(this.x - world.player.x, this.y - world.player.y) < 50) return;

    if (this.timer > 0) { 
      this.timer -= dt; 
      return; 
    }

    if (Math.hypot(this.x - this.tx, this.y - this.ty) < 4) {
      this.tx = this.bx + (Math.random()-0.5)*180;
      this.ty = this.by + (Math.random()-0.5)*180;
      this.timer = 1.8 + Math.random()*3.5;
      return;
    }

    const angle = Math.atan2(this.ty - this.y, this.tx - this.x);
    let sx = Math.cos(angle) * this.speed * dt;
    let sy = Math.sin(angle) * this.speed * dt;

    const newX = this.x + sx;
    const newY = this.y + sy;

    // Colisión con mapa + colisión con otros profesores
    if (!checkCol(newX - 5, newY + 2, 10, 6) && 
        !checkNpcCol(newX, newY, this)) {
      this.x = newX;
      this.y = newY;
      if (this.inter) {
        this.inter.x = this.x - 16;
        this.inter.y = this.y - 16;
      }
    } else {
      this.timer = 1;
      this.tx = this.bx;
      this.ty = this.by;
    }
  }
  draw() {
    ctx.fillStyle = "rgba(0,0,0,0.3)"; ctx.beginPath(); ctx.ellipse(Math.floor(this.x), Math.floor(this.y+3), 7, 3, 0, 0, Math.PI*2); ctx.fill();
    this.tiles.forEach(t => {
      const info = getTile(t.gid);
      if (info) ctx.drawImage(info.ts.img, info.sx, info.sy, 16, 16, Math.floor(this.x+t.dx-16), Math.floor(this.y+t.dy-16), 16, 16);
    });
  }
}

const KEYS = new Set();
window.onkeydown = e => KEYS.add(e.key.toLowerCase());
window.onkeyup = e => KEYS.delete(e.key.toLowerCase());

const sprites = { 
    L: new Image(), R: new Image(), U: new Image(), D: new Image(),
    load: () => { sprites.L.src="./C_L.gif"; sprites.R.src="./C_R.gif"; sprites.U.src="./C_U.gif"; sprites.D.src="./C_D.gif"; }
};
sprites.load();

function getTile(gid) {
  const raw = gid; gid &= ~0xE0000000; if (!gid) return null;
  const ts = world.tilesets.find(t => gid >= t.firstgid && gid <= t.lastgid);
  if (!ts) return null;
  const lid = gid - ts.firstgid;
  return { ts, sx:(lid%ts.cols)*16, sy:Math.floor(lid/ts.cols)*16, raw };
}

function updateGame(dt) {
  let dx=0, dy=0;
  if (KEYS.has("arrowleft") || KEYS.has("a")) { dx = -1; world.player.dir = 'L'; }
  else if (KEYS.has("arrowright") || KEYS.has("d")) { dx = 1; world.player.dir = 'R'; }
  if (KEYS.has("arrowup") || KEYS.has("w")) { dy = -1; world.player.dir = 'U'; }
  else if (KEYS.has("arrowdown") || KEYS.has("s")) { dy = 1; world.player.dir = 'D'; }

  if (dx || dy) {
    const mag = Math.hypot(dx, dy); dx = (dx/mag)*world.player.speed*dt; dy = (dy/mag)*world.player.speed*dt;
    if (!checkCol(world.player.x + dx - 5, world.player.y + 2, 10, 6) && !checkNpcCol(world.player.x + dx, world.player.y, null)) world.player.x += dx;
    if (!checkCol(world.player.x - 5, world.player.y + dy + 2, 10, 6) && !checkNpcCol(world.player.x, world.player.y + dy, null)) world.player.y += dy;
  }

  // Cámara ultra-suave siguiendo al jugador
  world.cameraX += (world.player.x - (canvas.width / (2 * ZOOM)) - world.cameraX) * 0.15;
  world.cameraY += (world.player.y - (canvas.height / (2 * ZOOM)) - world.cameraY) * 0.15;

  const box = { x:world.player.x-16, y:world.player.y-16, width:32, height:32 };
  const inter = world.interactions.find(i => intersects(box, i));
  const ui = document.getElementById("interaction");
  if (inter) {
    const name = PROFESORES[inter.id] || "Profesor"; ui.style.display = "block";
    ui.innerText = `[E] HABLAR CON ${name.toUpperCase()}`;
    if (KEYS.has("e")) {
      saveState();
      window.location.href=`../dashboard.php?profesor=${encodeURIComponent(name)}`;
    }
  } else ui.style.display = "none";
  if (KEYS.has("escape")) { document.getElementById("pauseMenu").style.display='block'; KEYS.delete("escape"); }
}

function saveState() {
  localStorage.setItem(P_KEY, JSON.stringify({x:world.player.x, y:world.player.y}));
  const npcs = world.npcs.map(n => ({ x:n.x, y:n.y }));
  localStorage.setItem(NPC_KEY, JSON.stringify(npcs));
}

function draw() {
  ctx.imageSmoothingEnabled = false;
  ctx.fillStyle = "#000"; ctx.fillRect(0,0,canvas.width,canvas.height);
  ctx.save();
  ctx.scale(ZOOM, ZOOM);
  ctx.translate(-Math.floor(world.cameraX), -Math.floor(world.cameraY));

  if (world.map) {
    world.map.layers.filter(l => l.type === "tilelayer" && l.visible && l.name!=="Techo" && l.name!=="Maestros").forEach(l => {
      l.chunks?.forEach(chk => {
        for(let r=0; r<chk.height; r++) for(let c=0; c<chk.width; c++) {
          const gid = chk.data[r*chk.width+c]; if(!gid) continue;
          const info = getTile(gid); if(!info) continue;
          const dx=(chk.x+c)*16, dy=(chk.y+r)*16, fH=info.raw&0x80000000, fV=info.raw&0x40000000, fD=info.raw&0x20000000;
          ctx.save(); ctx.translate(dx+8, dy+8);
          if (fD) { ctx.rotate(Math.PI/2); ctx.scale(fV?-1:1, fH?-1:1); } else { ctx.scale(fH?-1:1, fV?-1:1); }
          ctx.drawImage(info.ts.img, info.sx, info.sy, 16, 16, -8, -8, 16, 16); ctx.restore();
        }
      });
    });
  }

  const ents = [...world.npcs, { draw:()=> {
    ctx.fillStyle = "rgba(0,0,0,0.3)"; ctx.beginPath(); ctx.ellipse(Math.floor(world.player.x), Math.floor(world.player.y+3), 7, 3, 0, 0, Math.PI*2); ctx.fill();
    ctx.drawImage(sprites[world.player.dir], Math.floor(world.player.x-10), Math.floor(world.player.y-17), 20, 20);
  }, y:world.player.y }];
  ents.sort((a,b)=>a.y-b.y).forEach(e => e.draw());

  if (world.map) {
    world.map.layers.filter(l => (l.name==="Techo" || l.name==="Edificios2") && l.visible).forEach(l => {
      l.chunks?.forEach(chk => {
        for(let r=0; r<chk.height; r++) for(let c=0; c<chk.width; c++) {
          const gid = chk.data[r*chk.width+c]; if(!gid) continue;
          const info = getTile(gid); if(!info) continue;
          ctx.drawImage(info.ts.img, info.sx, info.sy, 16, 16, (chk.x+c)*16, (chk.y+r)*16, 16, 16);
        }
      });
    });
  }
  ctx.restore();
}

function frame(time) {
  const dt = Math.min((time - world.lastTime)/1000, 0.1);
  world.lastTime = time;
  if(canvas.width!==window.innerWidth||canvas.height!==window.innerHeight){canvas.width=window.innerWidth;canvas.height=window.innerHeight;}
  updateGame(dt);
  world.npcs.forEach(n => n.update(dt));
  draw();
  requestAnimationFrame(frame);
}

async function init() {
  try {
    const map = await fetch("./Mapa.json").then(r => r.json());
    world.map = map;

    // CARGA DE TILESETS CON ESPERA REAL DE IMÁGENES
    world.tilesets = await Promise.all(map.tilesets.map(async ts => {
      const resp = await fetch(`./tilesets/${ts.source.split('/').pop()}`);
      if (!resp.ok) return null;
      const xml = new DOMParser().parseFromString(await resp.text(), "application/xml");

      const img = new Image();
      const imageSrc = new URL(xml.querySelector("image").getAttribute("source"), 
                        new URL(`./tilesets/${ts.source.split('/').pop()}`, window.location.href)).href;
      
      img.src = imageSrc;

      // ESPERAMOS que la imagen cargue
      await new Promise(resolve => {
        img.onload = resolve;
        img.onerror = () => { console.error("Error cargando tileset:", imageSrc); resolve(); };
      });

      return {
        firstgid: ts.firstgid,
        lastgid: ts.firstgid + parseInt(xml.querySelector("tileset").getAttribute("tilecount")) - 1,
        cols: parseInt(xml.querySelector("tileset").getAttribute("columns")),
        img: img
      };
    })).then(arr => arr.filter(Boolean).sort((a,b) => a.firstgid - b.firstgid));

    const norm = o => { 
        const c = {...o}; 
        if(o.polygon) c.points = o.polygon.map(p=>({x:o.x+p.x, y:o.y+p.y})); 
        else { c.width=o.width||16; c.height=o.height||16; }
        return c; 
    };
    world.collisions = (map.layers.find(l=>l.name==='Coliciones')?.objects || []).map(norm);
    world.interactions = (map.layers.find(l=>l.name==='Interacciones')?.objects || []).map(norm);

    // Bloqueo estricto infraestructuras (Carpa y Edificios extra)
    map.layers.filter(l => l.name==="carpa" || l.name==="detalles").forEach(l => {
      l.chunks?.forEach(c => {
        for(let i=0; i<c.data.length; i++) if((c.data[i]&~0xE0000000)>=2865) world.collisions.push({x:(c.x+(i%c.width))*16, y:(c.y+Math.floor(i/c.width))*16, width:16, height:16});
      });
    });

    const chk = map.layers.find(l=>l.chunks)?.chunks[0];
    const spawnX = (chk.x + chk.width/2)*16 + 490, spawnY = (chk.y + chk.height/2)*16 + 960;
    const sPos = JSON.parse(localStorage.getItem(P_KEY));
    world.player.x = sPos ? sPos.x : spawnX; world.player.y = sPos ? sPos.y : spawnY;
    world.cameraX = world.player.x - canvas.width/(2*ZOOM); world.cameraY = world.player.y - canvas.height/(2*ZOOM);

    const mLayer = map.layers.find(l=>l.name==='Maestros');
    if (mLayer?.chunks) {
      const groups = new Map();
      mLayer.chunks.forEach(c => {
        for(let r=0; r<c.height; r++) for(let col=0; col<c.width; col++) {
          const gid = c.data[r*c.width+col]; if (gid < 3200) continue;
          c.data[r*c.width+col]=0;
          const tx=(c.x+col)*16, ty=(c.y+r)*16;
          let g = [...groups.values()].find(g => Math.hypot(g.x-tx,g.y-ty)<64);
          if(!g) { g={x:tx,y:ty,tiles:[]}; groups.set(`${tx},${ty}`, g); }
          g.tiles.push({dx:tx-g.x,dy:ty-g.y,gid});
        }
      });
      const sNPC = JSON.parse(localStorage.getItem(NPC_KEY));
      let idx = 0;
      groups.forEach(g => {
        const inter = world.interactions.find(i => Math.hypot(i.x-g.x, i.y-g.y)<96);
        const npc = new NPC("Profesor", g.tiles, g.x, g.y, inter);
        if(sNPC && sNPC[idx]) { npc.x = sNPC[idx].x; npc.y = sNPC[idx].y; }
        world.npcs.push(npc); idx++;
      });
    }
    requestAnimationFrame(frame);
  } catch(e) { console.error(e); }
}

const bind = (id, k, p=false) => {
  const el = document.getElementById(id); if(!el) return;
  const s = e => { e.preventDefault(); KEYS.add(k); if(p) setTimeout(()=>KEYS.delete(k), 100); };
  el.addEventListener('touchstart', s, {passive:false}); el.addEventListener('touchend', e=>{e.preventDefault(); KEYS.delete(k);});
  el.addEventListener('mousedown', s); el.addEventListener('mouseup', ()=>KEYS.delete(k));
};
bind("btnUp", "arrowup"); bind("btnDown", "arrowdown"); bind("btnLeft", "arrowleft"); bind("btnRight", "arrowright");
bind("btnE", "e", true); bind("btnEsc", "escape", true);
init();
</script>
</body>
</html>