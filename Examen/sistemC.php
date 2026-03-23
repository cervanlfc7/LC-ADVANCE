<?php
// ==========================================
// LC-ADVANCE - sistemC.php (Rediseño Premium)
// ==========================================
require_once '../config/config.php';
iniciarSesionSegura();
requireLogin(true);

$idPersonaje = $_GET['personaje'] ?? '1Cu';
$idDialogo = intval($_GET['dialogo'] ?? 1);
$indicePregunta = intval($_GET['pregunta'] ?? 0);
$returnUrl = $_GET['return_url'] ?? '../dashboard.php';
$slugExamen = $_GET['slug'] ?? 'examen_' . $idPersonaje;

try {
    $stmt = $pdo->prepare("SELECT DialogoC, TipodialogoC FROM dilogoscombate WHERE IDPersonajeC = ? AND IDDialogoC = ?");
    $stmt->execute([$idPersonaje, $idDialogo]);
    $row = $stmt->fetch();
    $texto = "...";
    $tipoDialogo = "Pregunta";
    if ($row) {
        $texto = strtoupper($row["DialogoC"]);
        $tipoDialogo = $row["TipodialogoC"];
    }

    $stmt = $pdo->prepare("SELECT IDDialogoC, DialogoC, TipodialogoC FROM dilogoscombate WHERE IDPersonajeC = ? ORDER BY CAST(IDDialogoC AS UNSIGNED) ASC");
    $stmt->execute([$idPersonaje]);
    $dialogos = [];
    while ($r = $stmt->fetch()) {
        $dialogos[] = [
            "id" => intval($r["IDDialogoC"]),
            "texto" => strtoupper($r["DialogoC"]),
            "tipo" => $r["TipodialogoC"]
        ];
    }

    $stmt = $pdo->prepare("SELECT PersonajeC FROM idsmaestros WHERE IDPersonajeC = ?");
    $stmt->execute([$idPersonaje]);
    $r = $stmt->fetch();
    $nombreMaestro = "MAESTRO DESCONOCIDO";
    if ($r) {
        $nombreMaestro = "MAESTRO " . strtoupper($r["PersonajeC"]);
    }

    $stmt = $pdo->prepare("SELECT * FROM preguntas WHERE IDPersonajeC = ? ORDER BY IDPregunta ASC");
    $stmt->execute([$idPersonaje]);
    $preguntas = [];
    while ($r = $stmt->fetch()) {
        $preguntas[] = [
            "id" => intval($r["IDPregunta"]),
            "Pregunta" => strtoupper($r["Pregunta"]),
            "Opcion1" => strtoupper($r["Opcion1"]),
            "Opcion2" => strtoupper($r["Opcion2"]),
            "Opcion3" => strtoupper($r["Opcion3"]),
            "RespuestaCorrecta" => intval($r["RespuestaCorrecta"]),
            "TipoPreguntaC" => $r["TipoPreguntaC"]
        ];
    }

    $imgProfesor = $idPersonaje . ".png";
    if (!file_exists($imgProfesor)) {
        $imgProfesor = "1Cu.png";
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA DE COMBATE | LC-ADVANCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --neon-cyan: #00ffff;
            --neon-pink: #ff00ff;
            --neon-yellow: #ffff00;
            --neon-green: #39ff14;
            --glass-bg: rgba(255, 255, 255, 0.03);
            --border-glass: rgba(255, 255, 255, 0.1);
            --card-bg: rgba(10, 10, 15, 0.92);
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background-color: #050508;
            color: #fff;
            font-family: 'Roboto Mono', monospace;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Animated Grid Background */
        .grid-bg {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: 
                linear-gradient(rgba(0, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
            mask-image: radial-gradient(circle at center, black, transparent 85%);
            animation: gridMove 25s linear infinite;
        }

        @keyframes gridMove {
            from { background-position: 0 0; }
            to { background-position: 0 60px; }
        }

        /* ============================
           MAIN LAYOUT: 3 rows
           - Header (fixed height)
           - Middle (character + dialog stacked)
           - Footer (fixed height)
        ============================ */
        .combat-container {
            width: 98vw;
            max-width: 1200px;
            height: 98vh;
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-glass);
            border-radius: 24px;
            position: relative;
            display: grid;
            grid-template-rows: auto 1fr auto auto;
            gap: 0;
            box-shadow: 0 0 60px rgba(0, 0, 0, 0.6), 0 0 30px rgba(0, 255, 255, 0.08);
            overflow: hidden;
            z-index: 1;
        }

        /* ── HEADER ─────────────────────────── */
        .combat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-glass);
            background: rgba(0,0,0,0.3);
            flex-shrink: 0;
            gap: 12px;
            flex-wrap: wrap;
        }

        .maestro-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .maestro-name {
            font-family: 'Press Start 2P', cursive;
            font-size: clamp(10px, 2vw, 16px);
            color: var(--neon-cyan);
            text-shadow: 0 0 15px var(--neon-cyan);
        }

        .health-bar-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .health-label {
            font-family: 'Press Start 2P', cursive;
            font-size: clamp(9px, 1.2vw, 12px);
            color: var(--neon-yellow);
            white-space: nowrap;
        }

        .health-bar-bg {
            width: clamp(120px, 25vw, 280px);
            height: 14px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-glass);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: inset 0 0 8px rgba(0,0,0,0.5);
        }

        .health-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #ff2222, #ff6666);
            width: 100%;
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 0 12px rgba(255, 0, 0, 0.5);
        }

        /* ── CHARACTER AREA ─────────────────── */
        .character-area {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: flex-end; /* Personaje pegado abajo del área */
            overflow: hidden;
            min-height: 0; /* Permite que el grid comprima correctamente */
        }

        /* Glow ambiental detrás del personaje */
        .character-glow {
            position: absolute;
            bottom: -10%;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 120%;
            background: radial-gradient(ellipse at bottom center,
                rgba(0, 255, 255, 0.18) 0%,
                rgba(0, 255, 255, 0.05) 45%,
                transparent 70%);
            pointer-events: none;
            animation: pulseGlow 4s ease-in-out infinite;
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 0.6; transform: translateX(-50%) scaleX(1); }
            50%       { opacity: 1;   transform: translateX(-50%) scaleX(1.06); }
        }

        /* El personaje ocupa hasta el 75% de la altura disponible del área,
           con un máximo absoluto para que no sea gigante */
        .character-img {
            position: relative;
            z-index: 2;
            /* Altura grande pero controlada */
            height: clamp(320px, 85%, 620px);
            width: auto;
            object-fit: contain;
            image-rendering: pixelated;
            filter: drop-shadow(0 0 30px rgba(0, 255, 255, 0.4))
                    drop-shadow(0 20px 20px rgba(0,0,0,0.6));
            transition: transform 0.3s ease, filter 0.3s ease;
            margin-bottom: -32px;
        }

        .character-img:hover {
            transform: scale(1.02) translateY(-4px);
            filter: drop-shadow(0 0 45px rgba(0, 255, 255, 0.6))
                    drop-shadow(0 20px 20px rgba(0,0,0,0.6));
        }

        /* Efecto correcto ✔ */
        .palomita {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            font-size: clamp(60px, 10vw, 110px);
            z-index: 10;
            pointer-events: none;
            text-shadow: 0 0 30px var(--neon-green);
            display: none;
            animation: popCheck 0.8s ease-out forwards;
        }

        @keyframes popCheck {
            0%   { transform: translate(-50%, -50%) scale(0); opacity: 0; }
            50%  { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(1); opacity: 0; }
        }

        /* ── DIALOG BOX ─────────────────────── */
        .dialog-box {
            background: rgba(5, 5, 12, 0.88);
            backdrop-filter: blur(16px);
            border: 2px solid var(--neon-cyan);
            border-radius: 18px;
            padding: clamp(16px, 3vh, 30px) clamp(16px, 3vw, 36px);
            /* Altura mínima fija, máx flexible */
            min-height: clamp(140px, 22vh, 220px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            box-shadow: 0 0 24px rgba(0, 255, 255, 0.12), inset 0 0 16px rgba(0, 255, 255, 0.04);
            margin: 0 16px;
            z-index: 5;
        }

        .dialog-text {
            font-family: 'Press Start 2P', cursive;
            font-size: clamp(10px, 1.4vw, 14px);
            line-height: 1.9;
            text-align: center;
            color: #fff;
        }

        .question-text {
            font-family: 'Orbitron', sans-serif;
            font-size: clamp(14px, 2vw, 20px);
            font-weight: 700;
            color: var(--neon-yellow);
            margin-bottom: 16px;
            text-align: center;
            display: block;
        }

        /* ── OPTIONS ────────────────────────── */
        .options-grid {
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
        }

        .option-btn {
            background: var(--glass-bg);
            border: 1px solid var(--border-glass);
            border-radius: 10px;
            padding: clamp(10px, 1.5vh, 14px) clamp(14px, 2vw, 22px);
            color: #fff;
            font-family: 'Roboto Mono', monospace;
            font-size: clamp(12px, 1.5vw, 15px);
            text-align: left;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            line-height: 1.4;
        }

        .option-btn:hover:not(:disabled) {
            background: rgba(0, 255, 255, 0.1);
            border-color: var(--neon-cyan);
            transform: translateX(8px);
            box-shadow: 0 0 12px rgba(0,255,255,0.15);
        }

        .option-btn span {
            font-family: 'Press Start 2P', cursive;
            font-size: clamp(8px, 1vw, 11px);
            color: var(--neon-cyan);
            flex-shrink: 0;
        }

        /* ── FOOTER ─────────────────────────── */
        .combat-footer {
            display: flex;
            justify-content: center;
            gap: 16px;
            padding: 14px 24px 20px;
            background: rgba(0,0,0,0.2);
            border-top: 1px solid var(--border-glass);
            flex-wrap: wrap;
        }

        .btn-combat {
            padding: clamp(10px, 1.5vh, 15px) clamp(20px, 3vw, 32px);
            font-family: 'Press Start 2P', cursive;
            font-size: clamp(8px, 1.1vw, 10px);
            border-radius: 10px;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-next {
            background: var(--neon-cyan);
            color: #000;
            box-shadow: 0 0 16px rgba(0, 255, 255, 0.3);
        }

        .btn-next:hover:not(:disabled) {
            box-shadow: 0 0 28px rgba(0, 255, 255, 0.6);
            transform: translateY(-2px);
        }

        .btn-next:disabled {
            background: #2a2a2a;
            color: #555;
            cursor: not-allowed;
            box-shadow: none;
        }

        .btn-exit {
            background: transparent;
            border: 1px solid var(--neon-pink);
            color: var(--neon-pink);
        }

        .btn-exit:hover {
            background: rgba(255, 0, 255, 0.1);
            box-shadow: 0 0 16px rgba(255, 0, 255, 0.2);
            transform: translateY(-2px);
        }

        /* ── FEEDBACK ANIMATIONS ────────────── */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%       { transform: translateX(-8px); }
            40%       { transform: translateX(8px); }
            60%       { transform: translateX(-6px); }
            80%       { transform: translateX(6px); }
        }

        .shaking {
            animation: shake 0.4s ease;
        }

        /* ── MOBILE ─────────────────────────── */
        @media (max-width: 600px) {
            .combat-container {
                width: 100vw;
                height: 100dvh;
                border-radius: 0;
            }

            .character-img {
                height: clamp(240px, 55vw, 380px);
                margin-bottom: -20px;
            }

            .health-label {
                display: none;
            }

            .dialog-box {
                margin: 0 10px;
                min-height: 160px;
            }

            .combat-footer {
                padding: 10px 16px 14px;
            }
        }

        @media (max-height: 600px) {
            .character-img {
                height: clamp(180px, 45vh, 300px);
            }
            .dialog-box {
                min-height: 120px;
            }
        }
    </style>
</head>
<body>

<div class="grid-bg"></div>

<div class="combat-container" id="combatUI">

    <!-- Header Stats -->
    <header class="combat-header">
        <div class="maestro-info">
            <span class="maestro-name"><?= htmlspecialchars($nombreMaestro) ?></span>
            <span style="font-size: clamp(8px,1vw,10px); color: rgba(255,255,255,0.35); letter-spacing:1px;">MODO: EXAMEN_FINAL</span>
        </div>
        <div class="health-bar-container">
            <span class="health-label">CALIF:</span>
            <div class="health-bar-bg">
                <div id="vidaRelleno" class="health-bar-fill"></div>
            </div>
            <span id="calificacionTexto" style="font-family:'Press Start 2P',cursive; font-size:clamp(10px,1.5vw,13px); color:var(--neon-pink); min-width:48px; text-align:right;">10/10</span>
        </div>
    </header>

    <!-- Character Area -->
    <div class="character-area">
        <div class="character-glow"></div>
        <img id="imgCuco" src="<?= $imgProfesor ?>" alt="Profesor" class="character-img">
        <div id="palomita" class="palomita">✔️</div>
    </div>

    <!-- Dialog / Questions -->
    <div class="dialog-box" id="dialogBox">
        <div id="dialogContent" class="dialog-text"></div>
    </div>

    <!-- Footer Controls -->
    <footer class="combat-footer">
        <button class="btn-combat btn-exit" onclick="window.location.href='../dashboard.php'">HUIR</button>
        <button class="btn-combat btn-next" id="btnSiguiente" disabled>SIGUIENTE</button>
    </footer>

</div>

<script>
const preguntas   = <?= json_encode($preguntas) ?>;
const dialogos    = <?= json_encode($dialogos) ?>;
const personaje   = "<?= $idPersonaje ?>";
let dialogoActual = <?= $idDialogo ?>;
let preguntaActual = <?= $indicePregunta ?>;

const dialogContent = document.getElementById("dialogContent");
const btnSiguiente  = document.getElementById("btnSiguiente");
const vidaRelleno   = document.getElementById("vidaRelleno");
const califTexto    = document.getElementById("calificacionTexto");
const combatUI      = document.getElementById("combatUI");

let vidaActual = 10;

function reducirVida() {
    vidaActual = Math.max(0, vidaActual - 1);
    const porcentaje = (vidaActual / 10) * 100;
    vidaRelleno.style.width = porcentaje + "%";
    califTexto.textContent  = `${vidaActual}/10`;

    combatUI.classList.add("shaking");
    document.body.style.backgroundColor = "rgba(255,0,0,0.08)";
    setTimeout(() => {
        combatUI.classList.remove("shaking");
        document.body.style.backgroundColor = "#050508";
    }, 450);

    if (vidaActual <= 5) {
        dialogContent.innerHTML = `
            <div style="color:var(--neon-pink); font-size:clamp(14px,2vw,20px);">❌ REPROBASTE EL EXAMEN</div>
            <p style="margin-top:14px; font-size:clamp(8px,1vw,10px); color:rgba(255,255,255,0.6);">TU CALIFICACIÓN ES INSUFICIENTE.</p>`;
        btnSiguiente.textContent = "VOLVER";
        btnSiguiente.disabled = false;
        btnSiguiente.onclick = () => window.location.href = '<?= $returnUrl ?>';
        registrarResultado(vidaActual);
    }
}

async function registrarResultado(score) {
    const isGuest = <?= !empty($_SESSION['usuario_es_invitado']) ? 'true' : 'false' ?>;
    if (isGuest) return;

    const formData = new FormData();
    formData.append('accion', 'calificar_examen_final');
    formData.append('slug', '<?= $slugExamen ?>');
    formData.append('score', score);

    try {
        const resp = await fetch('../src/funciones.php', { method: 'POST', body: formData });
        return await resp.json();
    } catch (err) {
        console.error("Error al registrar resultado:", err);
    }
}

function mostrarDialogo(texto, tipo) {
    let i = 0;
    dialogContent.textContent = "";
    btnSiguiente.disabled = true;
    btnSiguiente.onclick = null;

    const intervalo = setInterval(() => {
        dialogContent.textContent += texto.charAt(i);
        i++;
        if (i >= texto.length) {
            clearInterval(intervalo);
            btnSiguiente.disabled = false;

            if (tipo === "Pregunta") {
                btnSiguiente.onclick = () => mostrarPregunta(preguntaActual);
            } else {
                btnSiguiente.onclick = () => {
                    dialogoActual++;
                    avanzarDialogo();
                };
            }
        }
    }, 25);
}

function mostrarPregunta(index) {
    const actual = preguntas[index];
    if (!actual) {
        dialogoActual++;
        avanzarDialogo();
        return;
    }

    dialogContent.innerHTML = `
        <span class="question-text">${actual.Pregunta}</span>
        <div class="options-grid">
            <button class="option-btn" onclick="verificarRespuesta(1,${actual.RespuestaCorrecta})"><span>A</span>${actual.Opcion1}</button>
            <button class="option-btn" onclick="verificarRespuesta(2,${actual.RespuestaCorrecta})"><span>B</span>${actual.Opcion2}</button>
            <button class="option-btn" onclick="verificarRespuesta(3,${actual.RespuestaCorrecta})"><span>C</span>${actual.Opcion3}</button>
        </div>`;
    btnSiguiente.disabled = true;
}

window.verificarRespuesta = function(seleccion, correcta) {
    if (seleccion === correcta) {
        const palomita = document.getElementById("palomita");
        palomita.style.display = "block";
        setTimeout(() => {
            palomita.style.display = "none";
            preguntaActual++;
            const actual = preguntas[preguntaActual - 1];
            if (actual && actual.TipoPreguntaC === "Dialogo") {
                dialogoActual++;
                avanzarDialogo();
            } else {
                mostrarPregunta(preguntaActual);
            }
        }, 1000);
    } else {
        reducirVida();
    }
};

function avanzarDialogo() {
    const siguiente = dialogos.find(d => d.id === dialogoActual);
    if (!siguiente) {
        dialogContent.innerHTML = `
            <div style="color:var(--neon-green); font-size:clamp(14px,2vw,20px);">✅ COMBATE FINALIZADO</div>
            <p style="margin-top:14px; font-size:clamp(8px,1vw,10px); color:rgba(255,255,255,0.6);">HAS DEMOSTRADO TU VALÍA.</p>`;
        btnSiguiente.textContent = "FINALIZAR";
        btnSiguiente.disabled = false;
        btnSiguiente.onclick = () => window.location.href = '<?= $returnUrl ?>';
        registrarResultado(vidaActual);
        return;
    }
    mostrarDialogo(siguiente.texto, siguiente.tipo);
}

// Iniciar
const primero = dialogos.find(d => d.id === dialogoActual);
if (primero) {
    mostrarDialogo(primero.texto, primero.tipo);
} else {
    dialogContent.textContent = "⚠️ No se encontró el diálogo inicial.";
}
</script>

</body>
</html>