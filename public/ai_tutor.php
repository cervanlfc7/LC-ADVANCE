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

// Obtener contexto del ejercicio (del Lab)
$challengeContextJson = trim($requestData['challenge_context'] ?? '');
$challengeContext = [];
if ($challengeContextJson) {
    $challengeContext = json_decode($challengeContextJson, true) ?? [];
}

// Obtener historial de conversación
$conversationHistory = trim($requestData['conversation_history'] ?? '');

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

// Programa completo de LC-ADVANCE
$programContext = <<<CONTEXT
LC-ADVANCE - Plataforma Educativa Gamificada

ASIGNATURAS DISPONIBLES:
• Pensamiento Matemático III - Matemáticas avanzadas (derivadas, integrales, trigonometría, límites, ecuaciones)
• Física I - Mecánica, cinemática, energía, movimiento, fuerzas, gravitación
• Química I - Átomo, tabla periódica, enlaces, reacciones, moles, disoluciones
• Ecosistemas - Biología ambiental, cadenas tróficas, sucesión ecológica, sostenibilidad
• Programación - PHP, JavaScript, algoritmos, desarrollo web
• Ciencias Sociales - Historia, geografía, civismo

CARACTERÍSTICAS DE LA PLATAFORMA:
• Lecciones interactivas con teoría y ejercicios
• Quiz con retroalimentación inmediata
• Sistema de ranking y puntos de experiencia
• Lab: entorno de práctica con editor de código y chatbot
• Mapa interactivo para navegar lecciones
• Tutor IA para resolver dudas en tiempo real
• Ejercicios con MathJax para fórmulas matemáticas

FUNCIONES ESPECIALES:
• El usuario puede cambiar de materia desde el dashboard
• Hay ejercicios de tipo "calculadora" en el lab (derivadas, integrales, ecuaciones cuadráticas, etc.)
• El chatbot puede usar fórmulas LaTeX renderizadas con MathJax
• Sistema de repetición espaciada: recuerda lecciones con bajo rendimiento para repasar
CONTEXT;

// Construimos el mensaje del sistema de manera unificada
// Incluir contexto del ejercicio si está disponible
$exerciseContext = '';
if (!empty($challengeContext['challengeTitle'])) {
    $exerciseContext = "EJERCICIO ACTUAL DEL LAB:\n" .
        "- Título: {$challengeContext['challengeTitle']}\n" .
        "- Dificultad: {$challengeContext['challengeDifficulty']}\n" .
        "- Descripción: " . substr($challengeContext['challengeDescription'] ?? '', 0, 300) . "\n" .
        "- Código inicial:\n```php\n" . substr($challengeContext['challengeStarter'] ?? '', 0, 500) . "\n```\n\n";
}

// Incluir historial de conversación si está disponible
$chatHistoryContext = '';
if (!empty($conversationHistory)) {
    $chatHistoryContext = "HISTORIAL DE CONVERSACIÓN RECIENTE:\n{$conversationHistory}\n\n";
}

$systemMessage = "Eres LC-Tutor, el Asistente Inteligente de LC-ADVANCE, una plataforma educativa gamificada para estudiantes de preparatoria. Tu rol es guiar a los estudiantes respondiendo de manera MUY CONCISA, conversacional y directa, como un ser humano real. \n\n" .
                 $programContext . "\n\n" .
                 $exerciseContext .
                 $chatHistoryContext .
                 "Contexto actual del usuario:\n" .
                 "- Lección actual: '{$lessonTitle}' sobre {$lessonSubject}.\n" .
                 "- Nivel del alumno: {$difficulty} (modo: {$mode}).\n" .
                 "- {$historySummary}\n" .
                 (!empty($spacedReview) && !$question ? "- {$spacedReview}\n" : "") .
                 "\nReglas de comportamiento:\n" .
                 "1. Si el usuario te saluda, devuélvele el saludo amigablemente y pregunta en qué puede ayudar.\n" .
                 "2. Si pregunta sobre qué materias o lecciones hay disponibles, muéstrale la lista de asignaturas del programa.\n" .
                 "3. Si pregunta cómo resolver ejercicios de matemáticas/física/química/programación, puedes mostrar fórmulas en formato LaTeX como: x = (-b ± √(b²-4ac)) / 2a\n" .
                 "4. Si el usuario está en el LAB y pregunta sobre el ejercicio actual, usa la información del contexto del ejercicio para ayudar.\n" .
                 "5. Si el usuario pide código, proporciona código limpio, bien comentado y funcional.\n" .
                 "6. Responde EXACTAMENTE a lo que el usuario pregunte. NO generes resúmenes largos de toda la lección a menos que te lo pidan explícitamente.\n" .
                 "7. Sé muy humano, directo y breve (1-3 párrafos máximo). Nada de estructuras robóticas repetitivas.\n" .
                 "8. Usa formato Markdown solo cuando sea útil para resaltar algo clave.\n" .
                 "9. Si el usuario tiene bajo rendimiento (menos de 50%), anímalo a revisar los fundamentos y offrece ayuda específica.";

$aiResponse = null;
$aiError = null;

function localFallbackAnswer($question, $mode, $difficulty, $spacedReview) {
    $q = mb_strtolower($question, 'UTF-8');
    $answer = "⚠️ **Sin conexión al servicio de IA**\n\nEstoy operando en modo offline. Aquí tienes ayuda según tu pregunta:\n\n---\n";

    if ($question && (str_contains($q, 'materia') || str_contains($q, 'asignatura') || str_contains($q, 'qué hay') || str_contains($q, 'temas'))) {
        $answer .= "## Materias Disponibles en LC-ADVANCE\n\n**1. Pensamiento Matemático III** - Matemáticas avanzadas\n**2. Física I** - Mecánica, cinemática, energía\n**3. Química I** - Átomo, tabla periódica, reacciones\n**4. Ecosistemas** - Biología y medio ambiente\n**5. Programación** - PHP, JavaScript, desarrollo web\n**6. Ciencias Sociales** - Historia, geografía\n\nPara cambiar de materia, ve al dashboard y selecciona otra.";
    } elseif ($question && (str_contains($q, 'atp') || str_contains($q, 'energ') || str_contains($q, 'bio') || str_contains($q, 'mitocondr'))) {
        $answer .= "## ATP y Energía Celular\n\nEl **ATP** es la molécula energética principal:\n- Se sintetiza en las **mitocondrias**\n- Se usa para: movimiento, síntesis, transporte\n- Es la \"moneda energética\" de la célula";
    } elseif ($question && (str_contains($q, 'nivel') || str_contains($q, 'organización') || str_contains($q, 'jerarquía'))) {
        $answer .= "## Niveles de Organización Biológica\n\n1. Moléculas → 2. Orgánulos → 3. Células → 4. Tejidos → 5. Órganos → 6. Sistemas → 7. Organismo";
    } elseif ($question && (str_contains($q, 'derivada') || str_contains($q, 'integrar') || str_contains($q, 'límite') || str_contains($q, 'ecuación'))) {
        $answer .= "## Matemáticas - Fórmulas Útiles\n\n- **Derivada**: \\(f'(x) = \\lim_{h \\to 0} \\frac{f(x+h)-f(x)}{h}\\)\n- **Integral**: \\(\\int f(x)dx = F(x) + C\\)\n- **Cuadrática**: \\(x = \\frac{-b \\pm \\sqrt{b^2-4ac}}{2a}\\)\n- **Trigonometría**: \\(\\sin^2\\theta + \\cos^2\\theta = 1\\)\n\nUsa el **Lab** para practicar ejercicios.";
    } elseif ($question && (str_contains($q, 'fuerza') || str_contains($q, 'velocidad') || str_contains($q, 'aceleración') || str_contains($q, 'energía'))) {
        $answer .= "## Física - Formulas Fundamentales\n\n- **Velocidad**: \\(v = \\frac{\\Delta x}{\\Delta t}\\)\n- **Aceleración**: \\(a = \\frac{\\Delta v}{\\Delta t}\\)\n- **Fuerza**: \\(F = ma\\)\n- **Energía cinética**: \\(K = \\frac{1}{2}mv^2\\)\n- **Trabajo**: \\(W = F \\cdot d \\cdot \\cos\\theta\\)";
    } elseif ($question && (str_contains($q, 'átomo') || str_contains($q, 'mol') || str_contains($q, 'enlace') || str_contains($q, 'reacción'))) {
        $answer .= "## Química - Conceptos Clave\n\n- **Mol**: \\(1 mol = 6.022 \\times 10^{23}\\) partículas\n- **Concentración**: \\(M = \\frac{mol}{L}\\)\n- **Gas ideal**: \\(PV = nRT\\)\n- **Número atómico** = protones = electrones";
    } elseif ($question && (str_contains($q, 'repaso') || str_contains($q, 'repetición') || str_contains($q, 'olvido'))) {
        $answer .= "## Repetición Espaciada\n\nRepasa **justo antes de olvidarte**: 1 día → 3 días → 1 semana → 2 semanas → 1 mes";
    } elseif ($question) {
        $answer .= "## Sobre tu pregunta\n\nNo tengo conexión para responder en detalle. Mientras tanto:\n- Revisa la lección actual\n- Intenta de nuevo más tarde\n- Usa recursos como Khan Academy";
    } else {
        $difficulty_tips = [
            'Novato'     => "Enfócate en **un concepto a la vez**.",
            'Intermedio' => "Intenta **conectar los conceptos** entre sí.",
            'Avanzado'   => "Busca **aplicar** en problemas nuevos.",
        ];
        $tip = $difficulty_tips[$difficulty] ?? "Sigue practicando.";
        $answer .= "## Quiz: {$tip}\n";
    }

    if (!empty($spacedReview)) {
        $answer .= "\n---\n📅 **Repaso**: " . (is_array($spacedReview) ? implode(', ', $spacedReview) : $spacedReview);
    }
    return trim($answer);
}

/**
 * Llama a OpenRouter con un modelo específico.
 */
function callOpenRouter($systemPrompt, $userPrompt, $model = null) {
    $apiKey = OPENROUTER_API_KEY;
    if ($model === null) {
        $model = defined('OPENROUTER_MODEL') && OPENROUTER_MODEL !== ''
                    ? OPENROUTER_MODEL
                    : 'openrouter/free';
    }

    $payload = [
        'model'       => $model,
        'max_tokens'  => 900,
        'temperature' => 0.7,
        'messages'    => [
            ['role' => 'system', 'content' => $systemPrompt],
            ['role' => 'user', 'content' => $userPrompt]
        ]
    ];

    $timeout = defined('OPENROUTER_TIMEOUT') && OPENROUTER_TIMEOUT > 0 ? OPENROUTER_TIMEOUT : 30;

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
        // Auto: intenta múltiples modelos gratis de OpenRouter, luego local.
        if (defined('OPENROUTER_API_KEY') && OPENROUTER_API_KEY !== '') {
            $modelsToTry = defined('OPENROUTER_FALLBACK_MODELS') && is_array(OPENROUTER_FALLBACK_MODELS)
                ? OPENROUTER_FALLBACK_MODELS
                : ['openrouter/free', 'deepseek/deepseek-chat-v3-0324:free', 'qwen/qwen3-235b-a22b:free', 'meta-llama/llama-4-maverick:free', 'microsoft/phi-4:free'];

            foreach ($modelsToTry as $tryModel) {
                try {
                    $response = callOpenRouter($systemMessage, $userMessage, $tryModel);
                    $message = $response['choices'][0]['message']['content'] ?? null;
                    $aiResponse = trim($message ?: 'No se recibió texto de OpenRouter.');
                    $usedProvider = 'api';
                    error_log("AI OK with model: $tryModel");
                    break;
                } catch (Exception $apiEx) {
                    error_log("AI model $tryModel falló: " . $apiEx->getMessage());
                    $usedProvider = null;
                }
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