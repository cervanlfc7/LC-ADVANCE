<?php
header("Content-Type: application/json; charset=utf-8");
$allowedOrigin = (!empty($_SERVER['HTTP_ORIGIN']) && parse_url($_SERVER['HTTP_ORIGIN'], PHP_URL_HOST) === ($_SERVER['HTTP_HOST'] ?? '')) ? $_SERVER['HTTP_ORIGIN'] : '';
if ($allowedOrigin) {
    header("Access-Control-Allow-Origin: $allowedOrigin");
}
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once __DIR__ . '/../../src/Config/config.php';

$pdo->exec("CREATE TABLE IF NOT EXISTS `maestroact` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `IDPersonajeC` VARCHAR(100) NOT NULL,
  `Maestro_Actual` VARCHAR(255) NOT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");

$mapaIDs = [
    "Miguel"    => "1Le",
    "Enrique"   => "1Go",
    "Espindola" => "1Es",
    "Manuel"    => "1Ma",
    "Meza"      => "1Me",
    "Herson"    => "1He",
    "Carolina"  => "1Ca",
    "Refugio & Padilla" => "1Cu",
    "Armando"   => "1Ar"
];

$raw_input = file_get_contents("php://input");
$data = json_decode($raw_input, true);
if (!is_array($data)) {
    $data = $_POST;
}

$csrf_token = $data['csrf_token'] ?? '';
if (!validarCsrfToken($csrf_token)) {
    http_response_code(403);
    echo json_encode(["success" => false, "error" => "CSRF inválido"]);
    exit;
}

if (empty($data) && !empty($raw_input)) {
    parse_str($raw_input, $parsed);
    if (!empty($parsed)) {
        $data = $parsed;
    } else {
        $decoded = json_decode($raw_input, true);
        if (is_array($decoded)) $data = $decoded;
    }
}
$maestro = $data["maestro"] ?? null;
$materia_received = $data["materia"] ?? null;

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
    $pdo->exec("DELETE FROM maestroact");
    $stmt = $pdo->prepare("INSERT INTO maestroact (IDPersonajeC, Maestro_Actual) VALUES (?, ?)");
    $stmt->execute([$idPersonaje, $foundKey]);

    echo json_encode(["success" => true, "message" => "Registro insertado", "maestro" => $foundKey, "materia" => $materia_received]);
} else {
    echo json_encode(["success" => false, "error" => "Maestro no reconocido", "received" => $maestro, "received_materia" => $materia_received]);
}
