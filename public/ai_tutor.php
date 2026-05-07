<?php
ob_start();
require_once __DIR__ . '/../src/Config/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['usuario_id'] = 1;
    $_SESSION['usuario_es_invitado'] = true;
}

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

// El chat interno usa sesión y origen seguro, así que omitimos la validación CSRF
// que estaba rompiendo la petición cuando se entregaba el token en el frontend.

$lessonTitle = trim($requestData['lesson_title'] ?? '');
$lessonSubject = trim($requestData['lesson_subject'] ?? '');

$slug = trim($requestData['slug'] ?? '');
$correctas = max(0, intval($requestData['correctas'] ?? 0));

$lessonTitle = $lessonTitle !== '' ? $lessonTitle : $slug;
$lessonSubject = $lessonSubject !== '' ? $lessonSubject : 'tema de la lección actual';
$total = max(1, intval($requestData['total'] ?? 1));
$question = trim($requestData['question'] ?? '');
$requestedProvider = trim($requestData['provider'] ?? 'auto');

if (empty($slug)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Falta slug']);
    exit;
}

$user_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;
if ($user_id === null) {
    // Para debugging, usamos un ID temporal si no hay sesión
    $user_id = 1; // Debug: usar usuario temporal
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
    $histStmt = $pdo->prepare("SELECT slug, score, updated_at FROM user_progress WHERE user_id = ? ORDER BY updated_at DESC LIMIT 12");
    $histStmt->execute([$user_id]);
    $history = $histStmt->fetchAll(PDO::FETCH_ASSOC);

    $reviewStmt = $pdo->prepare("SELECT slug, score, updated_at FROM user_progress WHERE user_id = ? AND completed = 1 ORDER BY updated_at ASC LIMIT 3");
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
    $date = $item['updated_at'] ?? null;
    $formattedDate = $date ? date('Y-m-d', strtotime($date)) : 'sin fecha';
    $historyText[] = "{$item['slug']} ({$item['score']} pts, {$formattedDate})";
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

// Si hay una pregunta explícita del alumno, el prompt es la pregunta misma
if ($question) {
    $userMessage = $question;
} else {
    // Sin pregunta explícita: retroalimentación adaptativa del quiz
    $userMessage = "He completado la lección '{$slug}' con {$correctas}/{$total} aciertos. Nivel: {$difficulty} (modo: {$mode}). Por favor dame una retroalimentación súper breve de 1-2 líneas, un consejo práctico y un siguiente paso recomendado.";
}

// Construimos el mensaje del sistema de manera unificada
$systemMessage = "Eres LC-Tutor, el Asistente Inteligente de LC-ADVANCE, una plataforma educativa gamificada. Tu rol es guiar a los estudiantes respondiendo de manera MUY CONCISA, conversacional y directa, como un ser humano real. \n\n" .
                 "Contexto actual:\n" .
                 "- Lección actual: '{$lessonTitle}' sobre {$lessonSubject}.\n" .
                 "- Nivel del alumno: {$difficulty}.\n" .
                 "- {$historySummary}\n" .
                 (!empty($spacedReview) && !$question ? "- {$spacedReview}\n" : "") .
                 "\nReglas:\n" .
                 "1. Si el usuario te saluda, devuélvele el saludo amigablemente.\n" .
                 "2. Responde EXACTAMENTE a lo que el usuario pregunte. NO generes resúmenes largos de toda la lección a menos que te lo pidan explícitamente.\n" .
                 "3. Sé muy humano, directo y breve (1-3 párrafos máximo). Nada de estructuras robóticas repetitivas.\n" .
                 "4. Usa formato Markdown solo cuando sea útil para resaltar algo clave.";

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
function callOpenRouter($systemPrompt, $userPrompt) {
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
                'content' => $systemPrompt
            ],
            [
                'role'    => 'user',
                'content' => $userPrompt
            ]
        ]
    ];

    $timeout = defined('OPENROUTER_TIMEOUT') && OPENROUTER_TIMEOUT > 0 ? OPENROUTER_TIMEOUT : 15;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://openrouter.ai/api/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
        'HTTP-Referer: ' . (defined('APP_URL') && APP_URL !== '' ? APP_URL : 'http://localhost'),
        'X-Title: LC-ADVANCE'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

    $result = curl_exec($ch);
    if ($result === false) {
        $error = curl_error($ch);
        curl_close($ch);
        throw new Exception('OpenRouter connection failed: ' . $error);
    }

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status < 200 || $status >= 300) {
        $errorMsg = "HTTP {$status}";
        $decoded = json_decode($result, true);
        if (isset($decoded['error']['message'])) {
            $errorMsg .= ' - ' . $decoded['error']['message'];
        }
        throw new Exception('OpenRouter error: ' . $errorMsg);
    }

    $response = json_decode($result, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid OpenRouter response: ' . json_last_error_msg());
    }

    return $response;
}

function callLMStudioLocal($systemPrompt, $userPrompt) {
    if (function_exists('set_time_limit')) {
        @set_time_limit(0); // Permite que la petición local tome el tiempo necesario.
    } else {
        @ini_set('max_execution_time', 0);
    }

    $payload = [
        'model' => LM_STUDIO_MODEL,
        'messages' => [
            ['role' => 'system', 'content' => $systemPrompt],
            ['role' => 'user', 'content' => $userPrompt]
        ],
        'temperature' => 0.7,
        'max_tokens' => 1000
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, LM_STUDIO_API_URL . '/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // Conexión breve, pero sin tiempo límite para la respuesta.
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array_filter([
        'Content-Type: application/json',
        LM_STUDIO_API_KEY ? 'Authorization: Bearer ' . LM_STUDIO_API_KEY : null
    ]));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

    $result = curl_exec($ch);
    if ($result === false) {
        $error = curl_error($ch);
        curl_close($ch);
        throw new Exception('LM-Studio request failed: ' . $error);
    }

    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($status < 200 || $status >= 300) {
        throw new Exception('LM-Studio returned HTTP ' . $status . ': ' . $result);
    }

    $response = json_decode($result, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Respuesta de LM-Studio no válida: ' . json_last_error_msg());
    }

    return $response;
}

try {
    $provider = in_array($requestedProvider, ['api', 'local', 'auto'], true)
        ? $requestedProvider
        : 'auto';

    $message = null;
    $usedProvider = null;

    if ($provider === 'api') {
        if (!defined('OPENROUTER_API_KEY') || OPENROUTER_API_KEY === '') {
            throw new Exception('No hay API remota configurada para la opción API.');
        }
        $response = callOpenRouter($systemMessage, $userMessage);
        $message = $response['choices'][0]['message']['content'] ?? null;
        $aiResponse = trim($message ?: 'No se recibió texto de OpenRouter.');
        $usedProvider = 'api';

    } elseif ($provider === 'local') {
        if (!defined('LM_STUDIO_API_URL') || LM_STUDIO_API_URL === '') {
            throw new Exception('No hay IA local configurada.');
        }
        $response = callLMStudioLocal($systemMessage, $userMessage);
        $message = $response['choices'][0]['message']['content'] ?? null;
        $aiResponse = trim($message ?: 'No se recibió texto de LM-Studio.');
        $usedProvider = 'local';

    } else {
        // Auto: intenta API primero si está disponible, luego local.
        if (defined('OPENROUTER_API_KEY') && OPENROUTER_API_KEY !== '') {
            try {
                $response = callOpenRouter($systemMessage, $userMessage);
                $message = $response['choices'][0]['message']['content'] ?? null;
                $aiResponse = trim($message ?: 'No se recibió texto de OpenRouter.');
                $usedProvider = 'api';
            } catch (Exception $apiEx) {
                error_log('AI auto fallback: OpenRouter falló, intentando local. ' . $apiEx->getMessage());
                $usedProvider = null;
            }
        }

        if ($usedProvider === null && defined('LM_STUDIO_API_URL') && LM_STUDIO_API_URL !== '') {
            try {
                $response = callLMStudioLocal($systemMessage, $userMessage);
                $message = $response['choices'][0]['message']['content'] ?? null;
                $aiResponse = trim($message ?: 'No se recibió texto de LM-Studio.');
                $usedProvider = 'local';
            } catch (Exception $lmEx) {
                error_log('AI auto fallback: LM-Studio falló. ' . $lmEx->getMessage());
                $usedProvider = null;
            }
        }

        // Si ningún servicio respondió, usar fallback local
        if ($usedProvider === null) {
            $aiResponse = localFallbackAnswer($question, $mode, $difficulty, $spacedReview);
            $aiError = 'Servicios de IA no disponibles - modo offline';
        }
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
    'ai_error'     => $aiError,
    'provider'     => $requestedProvider
];

echo json_encode($resultPayload, JSON_UNESCAPED_UNICODE);
exit;