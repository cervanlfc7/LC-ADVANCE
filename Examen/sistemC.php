<?php
@ini_set('display_errors', '0');
require_once dirname(__DIR__) . '/config/config.php';
iniciarSesionSegura();
requireLogin(true);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

$idPersonaje = $_GET['personaje'] ?? '1Cu';
$idDialogo = intval($_GET['dialogo'] ?? 1);
$indicePregunta = intval($_GET['pregunta'] ?? 0);

try {
  $stmt = $pdo->prepare("SELECT DialogoC, TipodialogoC FROM dilogoscombate WHERE IDPersonajeC = ? AND IDDialogoC = ?");
  $stmt->execute([$idPersonaje, $idDialogo]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $texto = "...";
  $tipoDialogo = "Pregunta";
  if ($row) {
    $texto = strtoupper($row["DialogoC"]);
    $tipoDialogo = $row["TipodialogoC"];
  }

  $stmt = $pdo->prepare("SELECT IDDialogoC, DialogoC, TipodialogoC FROM dilogoscombate WHERE IDPersonajeC = ? ORDER BY IDDialogoC ASC");
  $stmt->execute([$idPersonaje]);
  $dialogos = [];
  while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $dialogos[] = [
      "id" => intval($r["IDDialogoC"]),
      "texto" => strtoupper($r["DialogoC"]),
      "tipo" => $r["TipodialogoC"]
    ];
  }

  $ids = array_column($dialogos, 'id');
  if (!in_array($idDialogo, $ids, true)) {
    $idDialogo = $dialogos[0]['id'] ?? 1;
  }

  $stmt = $pdo->prepare("SELECT PersonajeC FROM idsmaestros WHERE IDPersonajeC = ?");
  $stmt->execute([$idPersonaje]);
  $r = $stmt->fetch(PDO::FETCH_ASSOC);
  $nombreMaestro = "MAESTRO DESCONOCIDO";
  if ($r) {
    $nombreMaestro = "MAESTRO " . strtoupper($r["PersonajeC"]);
  }

  $imgProfesor = $idPersonaje . ".png";
  $imgPorDefecto = "default.png";
  $imgFinal = file_exists($imgProfesor) ? $imgProfesor : $imgPorDefecto;

  $stmt = $pdo->prepare("SELECT * FROM preguntas WHERE IDPersonajeC = ? ORDER BY IDPregunta ASC");
  $stmt->execute([$idPersonaje]);
  $preguntas = [];
  while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
} catch (Throwable $e) {
  http_response_code(500);
  echo "Error interno";
  exit;
}

// Diálogo actual
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Combate modular</title>
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      background-color: #050505;
      background-image: 
        radial-gradient(circle at center, rgba(0, 243, 255, 0.05) 0%, transparent 70%),
        linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%),
        linear-gradient(90deg, rgba(255, 0, 0, 0.06), rgba(0, 255, 0, 0.02), rgba(0, 0, 255, 0.06));
      background-size: 100% 100%, 100% 4px, 3px 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      overflow: hidden;
      color: #fff;
    }

    .cuadro {
      width: 95vw;
      max-width: 600px;
      height: 95vh;
      max-height: 800px;
      box-sizing: border-box;
      position: relative;
      border: 2px solid #00f3ff;
      box-shadow: 0 0 15px rgba(0, 243, 255, 0.3), inset 0 0 15px rgba(0, 243, 255, 0.2);
      background-color: rgba(10, 10, 15, 0.95);
      overflow: hidden;
      border-radius: 8px;
    }

    .imagen-personaje {
      position: absolute;
      top: 5%;
      left: 50%;
      transform: translateX(-50%);
      width: 45vh;
      max-width: 280px;
      height: 45vh;
      max-height: 280px;
      background-color: transparent;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1;
      filter: drop-shadow(0 0 10px rgba(0, 243, 255, 0.5));
    }

    .imagen-personaje img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      image-rendering: pixelated;
    }

    .barra-estado {
      position: absolute;
      bottom: 165px;
      left: 5%;
      width: 90%;
      height: 25%;
      min-height: 140px;
      max-height: 200px;
      border: 2px solid #00f3ff;
      box-shadow: 0 0 10px rgba(0, 243, 255, 0.2);
      background: rgba(0, 20, 30, 0.85);
      backdrop-filter: blur(5px);
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 15px;
      font-family: 'Press Start 2P', monospace;
      font-size: 11px;
      color: #00f3ff;
      text-shadow: 0 0 5px rgba(0, 243, 255, 0.5);
      text-align: center;
      line-height: 1.6;
      white-space: pre-wrap;
      overflow-y: auto;
      z-index: 2;
      border-radius: 4px;
    }

    #estadoMaestro {
      position: absolute;
      bottom: 115px;
      left: 5%;
      width: 90%;
      height: 40px;
      box-sizing: border-box;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 12px;
      font-family: 'Press Start 2P', monospace;
      font-size: 9px;
      color: #fff;
      text-transform: uppercase;
      z-index: 2;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 4px;
      border: 1px solid rgba(0, 243, 255, 0.2);
    }

    .barra-vida {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .etiqueta {
      font-size: 9px;
      color: #fff;
      font-family: 'Press Start 2P', monospace;
    }

    .vida-contenedor {
      width: 100px;
      height: 12px;
      border: 1px solid #fff;
      background-color: #222;
      position: relative;
      box-shadow: 0 0 5px rgba(255, 255, 255, 0.2);
    }

    .vida-relleno {
      height: 100%;
      background: linear-gradient(90deg, #ff0055, #ff00ff);
      box-shadow: 0 0 10px rgba(255, 0, 255, 0.5);
      width: 100%;
      transition: width 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .botonera {
      position: absolute;
      bottom: 20px;
      left: 0;
      width: 100%;
      display: flex;
      justify-content: space-around;
      padding: 0 10px;
      box-sizing: border-box;
      gap: 5px;
    }

    .boton {
      background: rgba(0, 243, 255, 0.1);
      color: #00f3ff;
      border: 1px solid #00f3ff;
      padding: 15px 10px;
      font-family: 'Press Start 2P', monospace;
      font-size: 9px;
      cursor: pointer;
      text-transform: uppercase;
      transition: all 0.3s ease;
      box-shadow: 0 0 5px rgba(0, 243, 255, 0.2);
      border-radius: 4px;
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    @media (max-width: 480px) {
      .cuadro {
        height: 100vh;
        width: 100vw;
        border-radius: 0;
        border: none;
      }

      .imagen-personaje {
        width: 35vh;
        height: 35vh;
        top: 2%;
      }

      .barra-estado {
        bottom: 180px;
        font-size: 10px;
        padding: 10px;
        height: 30%;
      }

      #estadoMaestro {
        bottom: 130px;
        font-size: 8px;
        height: 35px;
      }

      .vida-contenedor {
        width: 70px;
      }

      .botonera {
        flex-direction: column;
        bottom: 10px;
        padding: 0 15px;
        gap: 8px;
      }

      .boton {
        padding: 12px;
        font-size: 9px;
        width: 100%;
        margin: 0;
      }

      .opcion {
        font-size: 8px;
        padding: 12px 8px;
      }

      .pregunta {
        font-size: 9px;
        margin-bottom: 10px;
      }
    }

    @media (max-height: 600px) {
      .imagen-personaje {
        width: 25vh;
        height: 25vh;
      }
      .barra-estado {
        bottom: 140px;
        height: 35%;
      }
      #estadoMaestro {
        bottom: 100px;
      }
      .botonera {
        bottom: 10px;
      }
    }

    .boton:disabled {
      opacity: 0.3;
      cursor: not-allowed;
      border-color: #444;
      color: #444;
      box-shadow: none;
    }

    .boton:hover:enabled {
      background: #00f3ff;
      color: #000;
      box-shadow: 0 0 15px rgba(0, 243, 255, 0.6);
      transform: translateY(-2px);
    }

    .pregunta {
      font-size: 10px;
      margin-bottom: 15px;
      line-height: 1.5;
      text-align: center;
      color: #fff;
    }

    .opciones {
      display: flex;
      flex-direction: column;
      gap: 8px;
      align-items: center;
      width: 100%;
    }

    .opcion {
      font-size: 9px;
      width: 100%;
      padding: 10px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      background: rgba(255, 255, 255, 0.05);
      color: #fff;
      font-family: 'Press Start 2P', monospace;
      text-transform: uppercase;
      cursor: pointer;
      transition: all 0.2s ease;
      border-radius: 4px;
    }

    .opcion:hover {
      background: rgba(0, 243, 255, 0.2);
      border-color: #00f3ff;
      color: #00f3ff;
      box-shadow: 0 0 10px rgba(0, 243, 255, 0.3);
    }

    .palomita {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 80px;
      color: #00ff88;
      text-shadow: 0 0 20px #00ff88;
      opacity: 0;
      animation: aparecer 1s ease-out forwards;
      z-index: 5;
    }

    @keyframes aparecer {
      0% { transform: translate(-50%, 0%) scale(0.5); opacity: 0; }
      50% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
      100% { transform: translate(-50%, -150%) scale(1); opacity: 0; }
    }

    @keyframes temblor {
      0% { transform: translateX(0); }
      10% { transform: translateX(-8px); }
      20% { transform: translateX(8px); }
      30% { transform: translateX(-10px); }
      40% { transform: translateX(10px); }
      50% { transform: translateX(-6px); }
      60% { transform: translateX(6px); }
      70% { transform: translateX(-4px); }
      80% { transform: translateX(4px); }
      90% { transform: translateX(-2px); }
      100% { transform: translateX(0); }
    }

    .temblando {
      animation: temblor 0.5s ease;
    }
  </style>
</head>
<body>
  <div class="cuadro">
    <div class="imagen-personaje">
      <img id="imgProfesor" src="<?= htmlspecialchars($imgFinal) ?>" alt="Profesor <?= $nombreMaestro ?>">
    </div>

    <div class="barra-estado">
      <div class="dialogo-texto" id="dialogo"></div>
    </div>

    <div id="estadoMaestro">
      <span class="etiqueta"><?= $nombreMaestro ?></span>
      <div class="barra-vida">
        <span class="etiqueta">CALIF</span>
        <div class="vida-contenedor">
          <div id="vidaRelleno" class="vida-relleno"></div>
        </div>
        <span id="calificacionTexto" class="etiqueta">10/10</span>
      </div>
    </div>

    <!-- Botonera actualizada -->
    <div class="botonera">
      <button class="boton" id="btnExamen" disabled>SIGUIENTE</button>
      <button class="boton" id="btnSalir">SALIR</button>
      <button class="boton" id="btnReintentar" disabled>REINTENTAR EXAMEN</button>
    </div>

    <div id="palomita" class="palomita" style="display: none;">✔️</div>
  </div>

<script>
const preguntas = <?= json_encode($preguntas) ?>;
const dialogos = <?= json_encode($dialogos) ?>;
const personaje = "<?= $idPersonaje ?>";
let dialogoActual = <?= $idDialogo ?>;
let preguntaActual = <?= $indicePregunta ?>;

const contenedor = document.getElementById("dialogo");
const btnExamen = document.getElementById("btnExamen");
const btnSalir = document.getElementById("btnSalir");
const btnReintentar = document.getElementById("btnReintentar");

let vidaActual = 10;
let reprobado = false; // Ahora también usaremos esta bandera para bloquear avances

// Construir la URL de retorno: preferimos el referrer si viene de dashboard, sino usamos dashboard preservando profesor o materia si vinieran por GET
const phpReturnParam = "<?= !empty($_GET['profesor']) ? '?profesor=' . urlencode($_GET['profesor']) : (!empty($_GET['materia']) ? '?materia=' . urlencode($_GET['materia']) : '') ?>";
const computedDashboard = window.location.origin + '/LC-ADVANCE/dashboard.php' + phpReturnParam;
btnSalir.addEventListener("click", () => {
  try {
    if (document.referrer && document.referrer.includes('/dashboard.php')) {
      // Si venimos del dashboard, volvemos a esa URL exacta (preserva filtros y anclas)
      window.location.href = document.referrer;
    } else {
      // Fallback: dashboard con parámetros si existían
      window.location.href = computedDashboard;
    }
  } catch (e) {
    // En caso de error, fallback seguro al dashboard
    window.location.href = window.location.origin + '/LC-ADVANCE/dashboard.php';
  }
});

btnReintentar.addEventListener("click", () => {
  if (!btnReintentar.disabled) {
    window.location.href = `?personaje=<?= $idPersonaje ?>&dialogo=1&pregunta=0`;
  }
});

function reducirVida() {
  vidaActual = Math.max(0, vidaActual - 1);
  const porcentaje = (vidaActual / 10) * 100;
  document.getElementById("vidaRelleno").style.width = porcentaje + "%";
  document.getElementById("calificacionTexto").textContent = `${vidaActual}/10`;

  const estado = document.getElementById("estadoMaestro");
  estado.classList.add("temblando");
  setTimeout(() => estado.classList.remove("temblando"), 500);

  if (vidaActual <= 5 && !reprobado) {
    reprobado = true;
    contenedor.innerHTML = `<div class="pregunta" style="font-size: 12px; color: red;">❌ REPROBASTE EL EXAMEN</div>`;
    btnExamen.disabled = true;
    
    // Deshabilitamos opciones si las hay visibles
    document.querySelectorAll(".opcion").forEach(btn => {
      btn.disabled = true;
      btn.style.opacity = "0.5";
    });
    
    btnReintentar.disabled = false;
    
    // ¡Importante! Ya no avanzamos más ni mostramos más preguntas
  }
}

function mostrarDialogo(texto, tipo) {
  if (reprobado) return; // Bloqueamos si ya reprobó

  let i = 0;
  contenedor.textContent = "";
  btnExamen.disabled = true;
  btnExamen.onclick = null;

  const intervalo = setInterval(() => {
    contenedor.textContent += texto.charAt(i);
    i++;
    if (i >= texto.length) {
      clearInterval(intervalo);
      btnExamen.disabled = false;

      if (tipo === "Pregunta") {
        btnExamen.onclick = () => {
          mostrarPregunta(preguntaActual);
          btnExamen.disabled = true;
        };
      } else {
        btnExamen.onclick = () => {
          dialogoActual++;
          avanzarDialogo();
          btnExamen.disabled = true;
        };
      }
    }
  }, 20);
}

function mostrarPregunta(index) {
  if (reprobado) return; // Bloqueamos si ya reprobó

  const actual = preguntas[index];
  if (!actual) {
    dialogoActual++;
    avanzarDialogo();
    return;
  }

  const html = `
    <div class="pregunta">${actual.Pregunta}</div>
    <div class="opciones">
      <button class="opcion" data-opcion="1">${actual.Opcion1}</button>
      <button class="opcion" data-opcion="2">${actual.Opcion2}</button>
      <button class="opcion" data-opcion="3">${actual.Opcion3}</button>
    </div>
  `;
  contenedor.innerHTML = html;
  btnExamen.disabled = true;

  document.querySelectorAll(".opcion").forEach(btn => {
    btn.addEventListener("click", function handler() {
      // Removemos listeners para evitar clics múltiples
      document.querySelectorAll(".opcion").forEach(b => b.removeEventListener("click", handler));

      const seleccion = parseInt(btn.getAttribute("data-opcion"));
      
      if (seleccion === actual.RespuestaCorrecta) {
        // ACIERTO
        document.getElementById("palomita").style.display = "block";
        setTimeout(() => {
          document.getElementById("palomita").style.display = "none";
          
          if (!reprobado) { // Solo avanza si no ha reprobado aún
            preguntaActual++;
            if (actual.TipoPreguntaC === "Dialogo") {
              dialogoActual++;
              avanzarDialogo();
            } else {
              mostrarPregunta(preguntaActual);
            }
          }
        }, 1000);
      } else {
        // ERROR
        reducirVida();
        
        setTimeout(() => {
          if (!reprobado) { // Solo avanza si no ha reprobado aún
            preguntaActual++;
            if (actual.TipoPreguntaC === "Dialogo") {
              dialogoActual++;
              avanzarDialogo();
            } else {
              mostrarPregunta(preguntaActual);
            }
          }
        }, 800);
      }
    });
  });
}

function avanzarDialogo() {
  if (reprobado) return; // Bloqueamos si ya reprobó

  const siguiente = dialogos.find(d => d.id === dialogoActual);
  if (!siguiente) {
    contenedor.textContent = "✅ COMBATE FINALIZADO";
    btnExamen.disabled = true;
    return;
  }

  mostrarDialogo(siguiente.texto, siguiente.tipo);
}

// Inicio
const primero = dialogos.find(d => d.id === dialogoActual);
if (primero) {
  mostrarDialogo(primero.texto, primero.tipo);
} else {
  contenedor.textContent = "⚠️ No se encontró el diálogo inicial.";
}

// Tecla 0 para cambiar profesor
document.addEventListener('keydown', function(e) {
  if (e.key === '0') {
    e.preventDefault();
    const nuevoID = prompt("Ingresa el IDPersonajeC del profesor (ej: 1Cu, 1Es, 1He...):");
    if (nuevoID && nuevoID.trim() !== '') {
      window.location.href = `?personaje=${encodeURIComponent(nuevoID)}&dialogo=1&pregunta=0`;
    }
  }
});
</script>
