<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

$idPersonaje = $_GET['personaje'] ?? '1Cu';
$idDialogo = intval($_GET['dialogo'] ?? 1);
$indicePregunta = intval($_GET['pregunta'] ?? 0);

$conexion = new mysqli("localhost", "root", "", "dialogos");
if ($conexion->connect_error) die("Error de conexión: " . $conexion->connect_error);

// Diálogo actual
$sql = "SELECT DialogoC, TipodialogoC FROM dilogoscombate WHERE IDPersonajeC = ? AND IDDialogoC = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("si", $idPersonaje, $idDialogo);
$stmt->execute();
$result = $stmt->get_result();
$texto = "...";
$tipoDialogo = "Pregunta";
if ($row = $result->fetch_assoc()) {
  $texto = strtoupper($row["DialogoC"]);
  $tipoDialogo = $row["TipodialogoC"];
}
$stmt->close();

// Todos los diálogos
$sql = "SELECT IDDialogoC, DialogoC, TipodialogoC FROM dilogoscombate WHERE IDPersonajeC = ? ORDER BY IDDialogoC ASC";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $idPersonaje);
$stmt->execute();
$result = $stmt->get_result();
$dialogos = [];
while ($row = $result->fetch_assoc()) {
  $dialogos[] = [
    "id" => intval($row["IDDialogoC"]),
    "texto" => strtoupper($row["DialogoC"]),
    "tipo" => $row["TipodialogoC"]
  ];
}
$stmt->close();

// Maestro
$sql = "SELECT PersonajeC FROM idsmaestros WHERE IDPersonajeC = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $idPersonaje);
$stmt->execute();
$result = $stmt->get_result();
$nombreMaestro = "MAESTRO DESCONOCIDO";
if ($row = $result->fetch_assoc()) {
  $nombreMaestro = "MAESTRO " . strtoupper($row["PersonajeC"]);
}
$stmt->close();

// Imagen del profesor
$imgProfesor = $idPersonaje . ".png";
$imgPorDefecto = "default.png";
$imgFinal = file_exists($imgProfesor) ? $imgProfesor : $imgPorDefecto;

// Preguntas
$sql = "SELECT * FROM preguntas WHERE IDPersonajeC = ? ORDER BY IDPregunta ASC";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $idPersonaje);
$stmt->execute();
$result = $stmt->get_result();
$preguntas = [];
while ($row = $result->fetch_assoc()) {
  $preguntas[] = [
    "id" => intval($row["IDPregunta"]),
    "Pregunta" => strtoupper($row["Pregunta"]),
    "Opcion1" => strtoupper($row["Opcion1"]),
    "Opcion2" => strtoupper($row["Opcion2"]),
    "Opcion3" => strtoupper($row["Opcion3"]),
    "RespuestaCorrecta" => intval($row["RespuestaCorrecta"]),
    "TipoPreguntaC" => $row["TipoPreguntaC"]
  ];
}
$stmt->close();

$conexion->close();
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
      background-color: black;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .cuadro {
      width: 100vh;
      height: 100vh;
      box-sizing: border-box;
      position: relative;
      border: 2px solid white;
      overflow: hidden;
    }

    .imagen-personaje {
      position: absolute;
      top: 3px;
      left: 50%;
      transform: translateX(-50%);
      width: 350px;
      height: 350px;
      background-color: transparent;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1;
    }

    .imagen-personaje img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      image-rendering: pixelated;
    }

    .barra-estado {
      position: absolute;
      bottom: 140px;
      left: 5%;
      width: 90%;
      height: 200px;
      border: 2px solid white;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 10px;
      font-family: 'Press Start 2P', monospace;
      font-size: 10px;
      color: white;
      text-align: center;
      line-height: 1.8;
      white-space: pre-wrap;
      overflow: hidden;
      z-index: 2;
    }

    #estadoMaestro {
      position: absolute;
      bottom: 100px;
      left: 5%;
      width: 90%;
      height: 40px;
      box-sizing: border-box;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 12px;
      font-family: 'Press Start 2P', monospace;
      font-size: 10px;
      color: white;
      text-transform: uppercase;
      z-index: 2;
    }

    .barra-vida {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .etiqueta {
      font-size: 10px;
      color: white;
      font-family: 'Press Start 2P', monospace;
    }

    .vida-contenedor {
      width: 120px;
      height: 16px;
      border: 2px solid white;
      background-color: black;
      position: relative;
    }

    .vida-relleno {
      height: 100%;
      background-color: darkred;
      width: 100%;
      transition: width 0.3s ease;
    }

    .botonera {
      position: absolute;
      bottom: 60px;
      left: 0;
      width: 100%;
      display: flex;
      justify-content: space-around;
    }

    .boton {
      background-color: black;
      color: white;
      border: 2px solid white;
      padding: 10px 20px;
      font-family: 'Press Start 2P', monospace;
      font-size: 12px;
      cursor: pointer;
      text-transform: uppercase;
      transition: background-color 0.2s;
    }

    .boton:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    .boton:hover:enabled {
      background-color: white;
      color: black;
    }

    .pregunta {
      font-size: 8px;
      margin-bottom: 10px;
      line-height: 1.4;
      text-align: center;
    }

    .opciones {
      display: flex;
      flex-direction: column;
      gap: 6px;
      align-items: center;
    }

    .opcion {
      font-size: 8px;
      padding: 6px 12px;
      border: 2px solid white;
      background-color: black;
      color: white;
      font-family: 'Press Start 2P', monospace;
      text-transform: uppercase;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    .opcion:hover {
      background-color: white;
      color: black;
    }

    .palomita {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 80px;
      color: lime;
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

btnSalir.addEventListener("click", () => {
  window.location.href = "http://localhost/LC-ADVANCE/LC-ADVANCE/index.php";
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