<?php
// ==========================================
// LC-ADVANCE - sistemC.php (Rediseño Premium)
// ==========================================
require_once __DIR__ . '/../../src/Config/config.php';
iniciarSesionSegura();
requireLogin(true);

$idPersonaje = $_GET['personaje'] ?? '1Cu';
$idDialogo = intval($_GET['dialogo'] ?? 1);
$indicePregunta = intval($_GET['pregunta'] ?? 0);
$returnUrl = $_GET['return_url'] ?? '../dashboard.php';
$slugExamen = $_GET['slug'] ?? 'examen_' . $idPersonaje;

try {
    // Diálogo actual
    $stmt = $pdo->prepare("SELECT DialogoC, TipodialogoC FROM dilogoscombate WHERE IDPersonajeC = ? AND IDDialogoC = ?");
    $stmt->execute([$idPersonaje, $idDialogo]);
    $row = $stmt->fetch();
    $texto = "...";
    $tipoDialogo = "Pregunta";
    if ($row) {
        $texto = strtoupper($row["DialogoC"]);
        $tipoDialogo = $row["TipodialogoC"];
    }

    // Todos los diálogos
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

    // Maestro
    $stmt = $pdo->prepare("SELECT PersonajeC FROM idsmaestros WHERE IDPersonajeC = ?");
    $stmt->execute([$idPersonaje]);
    $r = $stmt->fetch();
    $nombreMaestro = "MAESTRO DESCONOCIDO";
    if ($r) {
        $nombreMaestro = "MAESTRO " . strtoupper($r["PersonajeC"]);
    }

    // Preguntas
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

    // Imagen del profesor (buscamos en la carpeta Examen que es donde están)
    $imgProfesor = "../Examen/" . $idPersonaje . ".png";
    if (!file_exists($imgProfesor)) {
        $imgProfesor = "../Examen/1Cu.png"; // Fallback
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
            --card-bg: rgba(10, 10, 15, 0.85);
        }

        body {
            margin: 0;
            background-color: #050508;
            color: #fff;
            font-family: 'Roboto Mono', monospace;
            height: 100vh;
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
            z-index: -1;
            mask-image: radial-gradient(circle at center, black, transparent 85%);
            animation: gridMove 25s linear infinite;
        }

        @keyframes gridMove {
            from { background-position: 0 0; }
            to { background-position: 0 60px; }
        }

        .combat-container {
            width: 95vw;
            max-width: 1200px;
            height: 95vh;
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-glass);
            border-radius: 30px;
            position: relative;
            display: flex;
            flex-direction: column;
            padding: 30px;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.5), 0 0 20px rgba(0, 255, 255, 0.1);
            overflow: hidden;
        }

        /* Header / Stats */
        .combat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 10px 20px;
            border-bottom: 1px solid var(--border-glass);
            flex-shrink: 0;
            z-index: 10;
        }

        .maestro-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .maestro-name {
            font-family: 'Press Start 2P', cursive;
            font-size: 16px;
            color: var(--neon-cyan);
            text-shadow: 0 0 15px var(--neon-cyan);
        }

        .health-bar-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .health-label {
            font-family: 'Press Start 2P', cursive;
            font-size: 12px;
            color: var(--neon-yellow);
        }

        .health-bar-bg {
            width: 300px;
            height: 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid var(--border-glass);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.5);
        }

        .health-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #ff0000, #ff4444);
            width: 100%;
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.6);
        }

        /* Character Area */
        .character-area {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .character-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90vh;
            height: 90vh;
            background: radial-gradient(circle, rgba(0, 255, 255, 0.2) 0%, transparent 70%);
            z-index: 0;
            animation: pulse 4s infinite ease-in-out;
        }

        @keyframes pulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
            50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.8; }
        }

        .character-img {
            position: absolute;
            bottom: -100px; /* Se apoya sobre el cuadro de diálogo */
            height: 100vh; /* Altura masiva */
            width: auto;
            object-fit: contain;
            image-rendering: pixelated;
            z-index: 2;
            filter: drop-shadow(0 0 50px rgba(0, 255, 255, 0.5));
            transition: transform 0.3s ease;
        }

        .character-img:hover {
            transform: scale(1.02);
        }

        /* Dialog / Question Box */
        .dialog-box {
            background: rgba(5, 5, 10, 0.8);
            backdrop-filter: blur(15px);
            border: 2px solid var(--neon-cyan);
            border-radius: 24px;
            padding: 35px;
            height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.15), inset 0 0 20px rgba(0, 255, 255, 0.05);
            flex-shrink: 0;
            z-index: 5; /* Por encima del personaje */
            margin-bottom: 20px;
        }

        .dialog-text {
            font-family: 'Press Start 2P', cursive;
            font-size: 14px;
            line-height: 1.8;
            text-align: center;
            color: #fff;
        }

        .question-text {
            font-family: 'Orbitron', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--neon-yellow);
            margin-bottom: 25px;
            text-align: center;
            display: block;
        }

        /* Options */
        .options-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
            width: 100%;
            margin-top: 10px;
        }

        .option-btn {
            background: var(--glass-bg);
            border: 1px solid var(--border-glass);
            border-radius: 12px;
            padding: 15px 25px;
            color: #fff;
            font-family: 'Roboto Mono', monospace;
            font-size: 16px;
            text-align: left;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .option-btn:hover:not(:disabled) {
            background: rgba(0, 255, 255, 0.1);
            border-color: var(--neon-cyan);
            transform: translateX(10px);
        }

        .option-btn span {
            font-family: 'Press Start 2P', cursive;
            font-size: 12px;
            color: var(--neon-cyan);
        }

        /* Footer Buttons */
        .combat-footer {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
        }

        .btn-combat {
            padding: 15px 30px;
            font-family: 'Press Start 2P', cursive;
            font-size: 10px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-next {
            background: var(--neon-cyan);
            color: #000;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
        }

        .btn-next:disabled {
            background: #333;
            color: #666;
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
            box-shadow: 0 0 20px rgba(255, 0, 255, 0.2);
        }

        /* Correct/Wrong Visuals */
        .palomita {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            font-size: 120px;
            color: var(--neon-green);
            z-index: 10;
            pointer-events: none;
            text-shadow: 0 0 30px var(--neon-green);
            display: none;
            animation: popCheck 0.8s ease-out forwards;
        }

        @keyframes popCheck {
            0% { transform: translate(-50%, -50%) scale(0); opacity: 0; }
            50% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(1); opacity: 0; }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .shaking {
            animation: shake 0.1s infinite;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .combat-container { padding: 15px; height: 95vh; }
            .health-bar-bg { width: 150px; }
            .health-label { display: none; }
            .character-img { max-height: 250px; }
            .dialog-text { font-size: 10px; }
            .question-text { font-size: 16px; }
            .option-btn { font-size: 14px; padding: 12px; }
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
            <span style="font-size: 10px; color: rgba(255,255,255,0.4);">MODO: EXAMEN_FINAL</span>
        </div>
        <div class="health-bar-container">
            <span class="health-label">CALIF:</span>
            <div class="health-bar-bg">
                <div id="vidaRelleno" class="health-bar-fill"></div>
            </div>
            <span id="calificacionTexto" style="font-family: 'Press Start 2P', cursive; font-size: 12px; color: var(--neon-pink);">10/10</span>
        </div>
    </header>

    <!-- Center Character Area -->
    <div class="character-area">
        <div class="character-glow"></div>
        <img id="imgCuco" src="<?= $imgProfesor ?>" alt="Profesor" class="character-img">
        <div id="palomita" class="palomita">✔️</div>
    </div>

    <!-- Bottom Dialog/Action Area -->
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
const preguntas = <?= json_encode($preguntas) ?>;
const dialogos = <?= json_encode($dialogos) ?>;
const personaje = "<?= $idPersonaje ?>";
let dialogoActual = <?= $idDialogo ?>;
let preguntaActual = <?= $indicePregunta ?>;

const dialogContent = document.getElementById("dialogContent");
const btnSiguiente = document.getElementById("btnSiguiente");
const vidaRelleno = document.getElementById("vidaRelleno");
const califTexto = document.getElementById("calificacionTexto");
const combatUI = document.getElementById("combatUI");

let vidaActual = 10;

function reducirVida() {
    vidaActual = Math.max(0, vidaActual - 1);
    const porcentaje = (vidaActual / 10) * 100;
    vidaRelleno.style.width = porcentaje + "%";
    califTexto.textContent = `${vidaActual}/10`;

    // Visual feedback
    combatUI.classList.add("shaking");
    document.body.style.backgroundColor = "rgba(255,0,0,0.1)";
    setTimeout(() => {
        combatUI.classList.remove("shaking");
        document.body.style.backgroundColor = "#050508";
    }, 500);

    if (vidaActual <= 5) {
        dialogContent.innerHTML = `<div style="color:var(--neon-pink); font-size:20px;">❌ REPROBASTE EL EXAMEN</div><p style="margin-top:20px; font-size:10px;">TU CALIFICACIÓN ES INSUFICIENTE.</p>`;
        btnSiguiente.textContent = "VOLVER";
        btnSiguiente.disabled = false;
        btnSiguiente.onclick = () => window.location.href = '<?= $returnUrl ?>';
        
        // Registrar intento aunque falle
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
        const resp = await fetch('../src/Core/funciones.php', { method: 'POST', body: formData });
        const data = await resp.json();
        return data;
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
                btnSiguiente.onclick = () => {
                    mostrarPregunta(preguntaActual);
                };
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

    const html = `
        <span class="question-text">${actual.Pregunta}</span>
        <div class="options-grid">
            <button class="option-btn" onclick="verificarRespuesta(1, ${actual.RespuestaCorrecta})"><span>A</span> ${actual.Opcion1}</button>
            <button class="option-btn" onclick="verificarRespuesta(2, ${actual.RespuestaCorrecta})"><span>B</span> ${actual.Opcion2}</button>
            <button class="option-btn" onclick="verificarRespuesta(3, ${actual.RespuestaCorrecta})"><span>C</span> ${actual.Opcion3}</button>
        </div>
    `;
    dialogContent.innerHTML = html;
    btnSiguiente.disabled = true;
}

window.verificarRespuesta = function(seleccion, correcta) {
    if (seleccion === correcta) {
        document.getElementById("palomita").style.display = "block";
        setTimeout(() => {
            document.getElementById("palomita").style.display = "none";
            preguntaActual++;
            const actual = preguntas[preguntaActual-1];
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
        dialogContent.innerHTML = `<div style="color:var(--neon-green); font-size:20px;">✅ COMBATE FINALIZADO</div><p style="margin-top:20px; font-size:10px;">HAS DEMOSTRADO TU VALÍA.</p>`;
        btnSiguiente.textContent = "FINALIZAR";
        btnSiguiente.disabled = false;
        btnSiguiente.onclick = () => window.location.href = '<?= $returnUrl ?>';
        
        // Registrar éxito y dar puntos
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
