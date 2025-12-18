<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


$conexion = new mysqli("localhost", "root", "", "dialogos");
if ($conexion->connect_error) {
    die(json_encode(["success" => false, "error" => $conexion->connect_error]));
}

// --- Catálogo: nombreProfesor → IDPersonajeC ---
$mapaIDs = [
    "Miguel"    => "1Le",
    "Enrique"   => "1Go",
    "Espindola" => "1Es",
    "Manuel"    => "1Ma",
    "Meza"      => "1Me",
    "Herson"    => "1He",
    "Carolina"  => "1Ca",
    "Refugio & Padilla" => "1Cu"
];

// --- Recibir datos desde el juego ---
$data = json_decode(file_get_contents("php://input"), true);
$maestro = $data["maestro"] ?? null;

if ($maestro && isset($mapaIDs[$maestro])) {
    $idPersonaje = $mapaIDs[$maestro];

    // --- Eliminar cualquier registro previo ---
    $conexion->query("DELETE FROM maestroact");

    // --- Insertar el nuevo maestro ---
    $sql = "INSERT INTO maestroact (IDPersonajeC, Maestro_Actual) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $idPersonaje, $maestro);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Registro insertado"]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "error" => "Maestro no reconocido"]);
}

$conexion->close();
?>