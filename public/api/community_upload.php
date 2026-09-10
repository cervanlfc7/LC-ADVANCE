<?php
@session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../../src/Config/config.php';

$currentUserId = !empty($_SESSION['usuario_es_invitado']) ? null : (int)($_SESSION['usuario_id'] ?? 0);
if (!$currentUserId) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'Inicia sesión para subir archivos.']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'] ?? '';
if ($method !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Método no permitido.']);
    exit;
}

// CSRF check
$csrfToken = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!validarCsrfToken($csrfToken)) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'CSRF inválido.']);
    exit;
}

if (empty($_FILES['files'])) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'No se enviaron archivos.']);
    exit;
}

$uploadDir = __DIR__ . '/../uploads/community/media/' . date('Y/m/');
if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

$allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
$allowedVideoTypes = ['video/mp4', 'video/webm', 'video/quicktime'];
$allowedTypes = array_merge($allowedImageTypes, $allowedVideoTypes);
$maxImageSize = 5 * 1024 * 1024; // 5MB
$maxVideoSize = 50 * 1024 * 1024; // 50MB

$results = [];
$files = $_FILES['files'];

// Handle multiple files
$isMultiple = is_array($files['name']);
$count = $isMultiple ? count($files['name']) : 1;

for ($i = 0; $i < $count; $i++) {
    $name = $isMultiple ? $files['name'][$i] : $files['name'];
    $tmpName = $isMultiple ? $files['tmp_name'][$i] : $files['tmp_name'];
    $error = $isMultiple ? $files['error'][$i] : $files['error'];
    $size = $isMultiple ? $files['size'][$i] : $files['size'];
    $type = $isMultiple ? $files['type'][$i] : $files['type'];

    if ($error !== UPLOAD_ERR_OK) {
        $results[] = ['ok' => false, 'error' => 'Error al subir archivo.'];
        continue;
    }

    if (!in_array($type, $allowedTypes, true)) {
        $results[] = ['ok' => false, 'error' => "Tipo de archivo no permitido: $type"];
        continue;
    }

    $isVideo = in_array($type, $allowedVideoTypes, true);
    $maxSize = $isVideo ? $maxVideoSize : $maxImageSize;

    if ($size > $maxSize) {
        $maxMB = $maxSize / (1024 * 1024);
        $results[] = ['ok' => false, 'error' => "El archivo excede el límite de {$maxMB}MB."];
        continue;
    }

    // Generate unique filename
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $newName = uniqid('cp_', true) . '.' . strtolower($ext);
    $filePath = $uploadDir . $newName;
    $relativePath = 'uploads/community/media/' . date('Y/m/') . $newName;

    if (!move_uploaded_file($tmpName, $filePath)) {
        $results[] = ['ok' => false, 'error' => 'Error al guardar el archivo.'];
        continue;
    }

    // Get dimensions for images
    $width = null;
    $height = null;
    $durationMs = null;

    if (!$isVideo && in_array($type, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
        $info = @getimagesize($filePath);
        if ($info) {
            $width = $info[0];
            $height = $info[1];
        }
    }

    // Generate thumbnail for videos
    $thumbnailPath = null;
    if ($isVideo) {
        // Try to get video duration with ffprobe if available
        $probeCmd = sprintf('ffprobe -v quiet -print_format json -show_format "%s" 2>/dev/null', escapeshellarg($filePath));
        @exec($probeCmd, $probeOutput, $probeReturn);
        if ($probeReturn === 0 && !empty($probeOutput)) {
            $probeData = json_decode(implode('', $probeOutput), true);
            if (isset($probeData['format']['duration'])) {
                $durationMs = (int)($probeData['format']['duration'] * 1000);
            }
        }
    }

    // Store in database
    $stmt = $pdo->prepare('INSERT INTO community_media (user_id, file_path, file_name, file_type, file_size, width, height, duration_ms) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $fileType = $isVideo ? 'video' : ($type === 'image/gif' ? 'gif' : 'image');
    $stmt->execute([$currentUserId, $relativePath, $name, $fileType, $size, $width, $height, $durationMs]);
    $mediaId = (int)$pdo->lastInsertId();

    $results[] = [
        'ok' => true,
        'id' => $mediaId,
        'url' => $relativePath,
        'type' => $fileType,
        'name' => $name,
        'size' => $size,
        'width' => $width,
        'height' => $height,
        'duration_ms' => $durationMs,
    ];
}

echo json_encode(['ok' => true, 'files' => $results], JSON_UNESCAPED_UNICODE);
