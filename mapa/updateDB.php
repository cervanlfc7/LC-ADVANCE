<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


$conexion = new mysqli("localhost", "root", "", "lc_advance");
if ($conexion->connect_error) {
    die(json_encode(["success" => false, "error" => $conexion->connect_error]));
}

// --- Catálogo: nombreProfesor → IDPersonajeC --- (usando nombres cortos como en original)
$mapaIDs = [
    "Miguel"    => "1Le",
    "Enrique"   => "1Go",
    "Espindola" => "1Es",
    "Manuel"    => "1Ma",
    "Meza"      => "1Me",
    "Herson"    => "1He",
    "Carolina"  => "1Ca",
    "Refugio & Padilla" => "1Cu",
    "Armando"   => "1Ar" // Si existe
];

// --- Recibir datos desde el juego ---
$data = json_decode(file_get_contents("php://input"), true);
$maestro = $data["maestro"] ?? null;
$materia_received = $data["materia"] ?? null;

// Normalizar nombre...
function normalize_name($s) {
    if ($s === null) return null;
    $s = trim(mb_strtolower($s, 'UTF-8'));
    $trans = ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n'];
    $s = strtr($s, $trans);
    $s = preg_replace('/\s+/', ' ', $s);
    return $s;
}

$received_norm = normalize_name($maestro);
$foundKey = null;
foreach ($mapaIDs as $name => $id) {
    if (normalize_name($name) === $received_norm) { $foundKey = $name; break; }
}

if ($maestro && $foundKey) {
    $idPersonaje = $mapaIDs[$foundKey];
    $conexion->query("DELETE FROM maestroact");
    $sql = "INSERT INTO maestroact (IDPersonajeC, Maestro_Actual) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $idPersonaje, $foundKey);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Registro insertado", "maestro" => $foundKey, "materia" => $materia_received]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->error, "received_materia" => $materia_received]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "error" => "Maestro no reconocido", "received" => $maestro, "received_materia" => $materia_received]);
}

$conexion->close();
?>