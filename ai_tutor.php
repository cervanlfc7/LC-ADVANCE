<?php
require_once 'config/config.php';
requireLogin(true);
header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($method === 'OPTIONS') {
    header('Allow: POST, OPTIONS');
    http_response_code(204);
    exit;
}

if (!in_array($method, ['POST', 'GET'], true)) {
    http_response_code(405);
    echo json_encode([
        'ok' => false,
        'error' => 'Método no permitido',
        'method' => $method,
        'request_uri' => $_SERVER['REQUEST_URI'] ?? ''
    ]);
    exit;
}

$requestData = $method === 'POST' ? $_POST : $_REQUEST;
$csrf_token = $requestData['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!validarCsrfToken($csrf_token)) {
    http_response_code(403);
    $errorPayload = ['ok' => false, 'error' => 'Token CSRF inválido'];
    if (defined('DEBUG_MODE') && DEBUG_MODE) {
        $errorPayload['csrf_received'] = $csrf_token;
        $errorPayload['csrf_session_exists'] = isset($_SESSION['csrf_token']);
        $errorPayload['csrf_session'] = $_SESSION['csrf_token'] ?? null;
        $errorPayload['method'] = $method;
        $errorPayload['request_uri'] = $_SERVER['REQUEST_URI'] ?? '';
    }
    echo json_encode($errorPayload);
    exit;
}

$slug = trim($requestData['slug'] ?? '');
$correctas = max(0, intval($requestData['correctas'] ?? 0));
$total = max(1, intval($requestData['total'] ?? 1));
$question = trim($requestData['question'] ?? '');

if (empty($slug)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Falta slug']);
    exit;
}

$user_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;
if ($user_id === null) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'Usuario no autenticado']);
    exit;
}

$ratio = min(1, $correctas / $total);
if ($ratio < 0.5) {
    $mode = 'repaso';
    $difficulty = 'Novato';
    $default_advice = 'Tu desempeño indica que necesitas reforzar los fundamentos antes de avanzar. Repite los ejercicios básicos y revisa cada error paso a paso.';
} elseif ($ratio < 0.85) {
    $mode = 'normal';
    $difficulty = 'Intermedio';
    $default_advice = 'Tu avance es sólido, pero vale la pena reforzar los conceptos con ejercicios adicionales y momentos de comparación entre problemas similares.';
} else {
    $mode = 'reto';
    $difficulty = 'Avanzado';
    $default_advice = 'Gran trabajo. Sigue con problemas más complejos y busca aplicar los conceptos en ejercicios que mezclen varios temas.';
}

try {
    $histStmt = $pdo->prepare("SELECT slug, score, completed_at FROM user_progress WHERE user_id = ? ORDER BY completed_at DESC LIMIT 12");
    $histStmt->execute([$user_id]);
    $history = $histStmt->fetchAll(PDO::FETCH_ASSOC);

    $reviewStmt = $pdo->prepare("SELECT slug, score, completed_at FROM user_progress WHERE user_id = ? AND completed = 1 ORDER BY completed_at ASC LIMIT 3");
    $reviewStmt->execute([$user_id]);
    $reviewRows = $reviewStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    error_log("Error ai_tutor query: " . $e->getMessage());
    $history = [];
    $reviewRows = [];
}

$poorLessons = [];
$historyText = [];
foreach ($history as $item) {
    if ($item['score'] < 4) {
        $poorLessons[] = $item['slug'];
    }
    $date = $item['completed_at'] ? date('Y-m-d', strtotime($item['completed_at'])) : 'sin fecha';
    $historyText[] = "{$item['slug']} ({$item['score']} pts, {$date})";
}

$reviewSlugs = array_map(fn($item) => $item['slug'], $reviewRows);
if (empty($reviewSlugs) && !empty($history)) {
    $reviewSlugs = array_slice(array_map(fn($item) => $item['slug'], $history), -3);
}

$historySummary = empty($historyText)
    ? 'No hay historial suficiente para análisis.'
    : 'Historial reciente: ' . implode(', ', $historyText) . '.';

$spacedReview = !empty($reviewSlugs)
    ? 'Revisa de nuevo: ' . implode(', ', $reviewSlugs) . '.'
    : 'No hay lecciones antiguas suficientes para una recomendación de repetición espaciada.';

// Si hay una pregunta explícita del alumno, el prompt es más libre y conversacional
if ($question) {
    $modelPrompt =
        "Eres un asistente educativo inteligente y versátil llamado LC-Tutor. " .
        "El estudiante está trabajando en la lección '{$slug}' (nivel {$difficulty}). " .
        "Contexto de progreso: {$correctas}/{$total} aciertos en esta sesión. " .
        "{$historySummary}\n\n" .
        "El alumno te hace la siguiente pregunta:\n\"{$question}\"\n\n" .
        "Instrucciones:\n" .
        "- Responde con libertad y profundidad, no te limites al tema de la lección si la pregunta va más allá.\n" .
        "- Si la pregunta es sobre conceptos generales, matemáticas, ciencias, historia, programación u otro tema, respóndela directamente y con detalle.\n" .
        "- Usa ejemplos concretos, analogías y pasos numerados cuando sea útil.\n" .
        "- Usa formato Markdown: encabezados ##, listas -, negritas **texto**, bloques de código ```.\n" .
        "- Sé amigable, claro y pedagógico. Responde siempre en español.\n" .
        "- Al final, si es relevante, menciona brevemente cómo relaciona con la lección actual o el siguiente paso de aprendizaje.";
} else {
    // Sin pregunta explícita: retroalimentación adaptativa del quiz
    $modelPrompt =
        "Eres LC-Tutor, un mentor pedagógico adaptativo dentro de la plataforma LC-ADVANCE. " .
        "El estudiante acaba de completar la lección '{$slug}' con {$correctas}/{$total} aciertos. " .
        "Nivel detectado: {$difficulty} (modo: {$mode}).\n" .
        "{$historySummary}\n" .
        "{$spacedReview}\n\n" .
        "Genera una retroalimentación personalizada en Markdown con:\n" .
        "1. **Evaluación breve** del desempeño (1-2 líneas, motivadora y honesta).\n" .
        "2. **Consejo práctico** específico para reforzar o avanzar.\n" .
        "3. **Sugerencia de repaso** con temporización (ej: 'vuelve en 2 días').\n" .
        "4. **Siguiente paso recomendado** concreto.\n" .
        "Usa Markdown. Sé conciso pero útil. Responde en español.";
}

$aiResponse = null;
$aiError = null;

function localFallbackAnswer($question, $mode, $difficulty, $spacedReview) {
    $q = mb_strtolower($question, 'UTF-8');
    $answer = "**⚠️ Sin conexión al servicio de IA**\n\nNo puedo conectar con el asistente en este momento, pero aquí tienes una guía de respaldo.\n\n";

    if ($question) {
        $answer .= "**Tu pregunta:** _{$question}_\n\n";
    }

    if ($question && (str_contains($q, 'atp') || str_contains($q, 'energ') || str_contains($q, 'bio'))) {
        $answer .= "## Sobre ATP y Energía Celular\n\nEl **ATP (adenosín trifosfato)** es la molécula energética principal de la célula. Es una **biomolécula**, no un nivel de organización biológica.\n\n- Los niveles van: molécula → orgánulo → célula → tejido → órgano → sistema → organismo\n- El ATP se sintetiza en las **mitocondrias** mediante la respiración celular\n- Se usa para casi todo: contracción muscular, síntesis de proteínas, transporte activo\n\nRevisa la diferencia entre moléculas funcionales y niveles estructurales.";
    } elseif ($question && (str_contains($q, 'nivel') || str_contains($q, 'organización') || str_contains($q, 'jerarquía'))) {
        $answer .= "## Niveles de Organización Biológica\n\nDe menor a mayor complejidad:\n\n1. **Moléculas** — ADN, proteínas, lípidos\n2. **Orgánulos** — mitocondria, ribosomas\n3. **Células** — unidad básica de vida\n4. **Tejidos** — células del mismo tipo\n5. **Órganos** — corazón, pulmón\n6. **Sistemas** — circulatorio, nervioso\n7. **Organismo** — individuo completo\n\nCada nivel *integra* el anterior y añade nuevas propiedades.";
    } elseif ($question && (str_contains($q, 'repaso') || str_contains($q, 'repetición') || str_contains($q, 'olvido'))) {
        $answer .= "## Repetición Espaciada\n\nLa **repetición espaciada** es una técnica que aprovecha la curva del olvido:\n\n- Repasas el material **justo antes de olvidarlo**\n- Intervalos típicos: 1 día → 3 días → 1 semana → 2 semanas → 1 mes\n- Cada repaso exitoso **alarga el intervalo** siguiente\n\n> 💡 Vuelve a esta lección en **2-3 días** y enfócate en las preguntas que fallaste.";
    } elseif ($question) {
        $answer .= "## Respuesta General\n\nEsta pregunta requiere conexión con el asistente IA para una respuesta detallada. Mientras tanto:\n\n- Revisa el contenido de la lección\n- Consulta un recurso externo como Khan Academy o Wikipedia\n- Intenta de nuevo en unos minutos cuando se restaure la conexión";
    } else {
        $difficulty_tips = [
            'Novato'     => "Enfócate en entender **un concepto a la vez**. No avances hasta que el anterior sea claro.",
            'Intermedio' => "Estás progresando bien. Intenta **conectar los conceptos** entre sí con un mapa mental.",
            'Avanzado'   => "Excelente dominio. Busca **aplicar los conceptos** en problemas nuevos o contextos reales.",
        ];
        $tip = $difficulty_tips[$difficulty] ?? "Sigue practicando con constancia.";
        $answer .= "## Retroalimentación de tu Quiz\n\n{$tip}\n";
    }

    if (!empty($spacedReview)) {
        $answer .= "\n\n---\n📅 **Repaso sugerido:** " . (is_array($spacedReview) ? implode(', ', $spacedReview) : $spacedReview);
    }
    return trim($answer);
}

/**
 * Llama a OpenRouter (compatible con OpenAI chat/completions).
 * Modelo por defecto: google/gemini-2.0-flash-001 (gratuito en OpenRouter).
 * Se puede cambiar con la constante OPENROUTER_MODEL en config.php.
 */
function callOpenRouter($prompt) {
    $apiKey = OPENROUTER_API_KEY;
    $model  = defined('OPENROUTER_MODEL') && OPENROUTER_MODEL !== ''
                ? OPENROUTER_MODEL
                : 'google/gemini-2.0-flash-001';

    $payload = [
        'model'       => $model,
        'max_tokens'  => 900,
        'temperature' => 0.7,
        'messages'    => [
            [
                'role'    => 'system',
                'content' => 'Eres LC-Tutor, un asistente educativo inteligente y versátil integrado en la plataforma LC-ADVANCE. Puedes responder cualquier duda académica o general del estudiante: matemáticas, ciencias, historia, programación, idiomas, etc. Siempre respondes en español, usas formato Markdown (encabezados, listas, negritas, código), y adaptas tu nivel al contexto del alumno. Eres amigable, preciso y pedagógico.'
            ],
            [
                'role'    => 'user',
                'content' => $prompt
            ]
        ]
    ];

    $timeout = defined('OPENROUTER_TIMEOUT') ? OPENROUTER_TIMEOUT : 20;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://openrouter.ai/api/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
        'HTTP-Referer: ' . (defined('APP_URL') ? APP_URL : 'https://localhost'),
        'X-Title: AI Tutor'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

    $result = curl_exec($ch);
    if ($result === false) {
        $error = curl_error($ch);
        curl_close($ch);
        throw new Exception('OpenRouter request failed: ' . $error);
    }

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status < 200 || $status >= 300) {
        throw new Exception("OpenRouter returned HTTP {$status}: " . $result);
    }

    $response = json_decode($result, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Respuesta de OpenRouter no válida: ' . json_last_error_msg());
    }

    return $response;
}

function callOllamaLocal($prompt) {
    $payload = [
        'model' => OLLAMA_MODEL,
        'messages' => [
            ['role' => 'system', 'content' => 'Eres LC-Tutor, un asistente educativo inteligente y versátil. Respondes cualquier duda académica en español usando formato Markdown. Eres amigable, preciso y pedagógico.'],
            ['role' => 'user', 'content' => $prompt]
        ],
        'temperature' => 0.7,
        'max_tokens' => 450
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, OLLAMA_API_URL . '/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, OLLAMA_REQUEST_TIMEOUT);
    curl_setopt($ch, CURLOPT_TIMEOUT, OLLAMA_REQUEST_TIMEOUT);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array_filter([
        'Content-Type: application/json',
        OLLAMA_API_KEY ? 'Authorization: Bearer ' . OLLAMA_API_KEY : null
    ]));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

    $result = curl_exec($ch);
    if ($result === false) {
        $error = curl_error($ch);
        curl_close($ch);
        throw new Exception('Ollama request failed: ' . $error);
    }

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status < 200 || $status >= 300) {
        throw new Exception('Ollama returned HTTP ' . $status . ': ' . $result);
    }

    $response = json_decode($result, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Respuesta de Ollama no válida: ' . json_last_error_msg());
    }

    return $response;
}

try {
    if (defined('OPENROUTER_API_KEY') && OPENROUTER_API_KEY !== '') {
        $response = callOpenRouter($modelPrompt);

        // Estructura estándar OpenAI-compatible: choices[0].message.content
        $message = $response['choices'][0]['message']['content'] ?? null;
        $aiResponse = trim($message ?: 'No se recibió texto de OpenRouter.');

    } elseif (defined('OLLAMA_API_URL') && OLLAMA_API_URL !== '') {
        $response = callOllamaLocal($modelPrompt);
        $message = $response['choices'][0]['message']['content'] ?? null;
        $aiResponse = trim($message ?: 'No se recibió texto de Ollama.');
    } else {
        throw new Exception('No hay servicio de IA configurado.');
    }
} catch (Exception $e) {
    $aiError = $e->getMessage();
    error_log('AI error: ' . $aiError);
    $aiResponse = localFallbackAnswer($question, $mode, $difficulty, $spacedReview);
}

$resultPayload = [
    'ok'           => true,
    'mode'         => $mode,
    'difficulty'   => $difficulty,
    'advice'       => $default_advice,
    'spaced_review'=> $reviewSlugs,
    'history'      => $historySummary,
    'ai_text'      => $aiResponse,
    'ai_error'     => $aiError
];

echo json_encode($resultPayload, JSON_UNESCAPED_UNICODE);
exit;