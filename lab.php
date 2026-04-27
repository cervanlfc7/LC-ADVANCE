<?php
require_once 'config/config.php';
requireLogin(true);

// Obtener materia activa de sesión o parámetro
$materia_activa = $_GET['materia'] ?? $_SESSION['materia_activa'] ?? null;
if ($materia_activa) {
    $_SESSION['materia_activa'] = $materia_activa;
}

$supported_langs = ['es', 'en'];
if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_langs, true)) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'es';
if (!in_array($lang, $supported_langs, true)) {
    $lang = 'es';
}

$i18n = [
    'es' => [
        'title' => 'Lab Interactivo',
        'subtitle' => '🧪 Desafíos prácticos de todas las materias con evaluación automática.',
        'materia' => 'Materia',
        'challenge' => 'Desafío',
        'run' => '▶ Verificar Respuesta',
        'reset' => '🔄 Reiniciar',
        'result' => 'Resultado',
        'all_ok' => '✅ Correcto. ¡Excelente!',
        'go_dashboard' => '← Volver al Dashboard',
        'go_map' => '🗺️ Ir al Mapa',
        'difficulty' => 'Nivel',
        'type' => 'Tipo',
        'theory' => '📖 Teoría',
        'hints' => '💡 Pistas',
        'show_hint' => 'Mostrar pista',
        'examples' => '📝 Ejemplos',
        'points' => 'Puntos',
        'xp_earned' => '+{xp} XP',
    ],
    'en' => [
        'title' => 'Interactive Lab',
        'subtitle' => '🧪 Practical challenges from all subjects with automatic grading.',
        'materia' => 'Subject',
        'challenge' => 'Challenge',
        'run' => '▶ Check Answer',
        'reset' => '🔄 Reset',
        'result' => 'Result',
        'all_ok' => '✅ Correct. Great job!',
        'go_dashboard' => '← Back to Dashboard',
        'go_map' => '🗺️ Go to Map',
        'difficulty' => 'Level',
        'type' => 'Type',
        'theory' => '📖 Theory',
        'hints' => '💡 Hints',
        'show_hint' => 'Show hint',
        'examples' => '📝 Examples',
        'points' => 'Points',
        'xp_earned' => '+{xp} XP',
    ],
];
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($i18n[$lang]['title']) ?> | LC-ADVANCE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.16.0/katex.min.css">
    <style>
        :root {
            --bg-dark: #060a12;
            --bg-light: #f5f7fb;
            --surface-dark: #0c1220;
            --surface-light: #ffffff;
            --surface2-dark: #111a2d;
            --surface2-light: #f0f2f8;
            --border-dark: rgba(0,230,255,0.2);
            --border-light: rgba(0,150,200,0.15);
            --cyan: #00e5ff;
            --cyan-light: #0088bb;
            --green: #00ff87;
            --pink: #ff3cac;
            --red: #ff6b6b;
            --yellow: #ffd23f;
            --text-dark: #e8f4ff;
            --text-light: #0f1419;
            --muted-dark: rgba(200,230,255,0.62);
            --muted-light: rgba(80,100,140,0.7);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
            overflow-x: hidden;
            transition: background 0.4s, color 0.4s;
        }

        body.theme-dark {
            background: var(--bg-dark);
            color: var(--text-dark);
        }

        body.theme-light {
            background: var(--bg-light);
            color: var(--text-light);
        }

        .wrap { width: min(1400px, 96%); margin: 0 auto; padding: 20px 0 80px; }

        .top {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: center;
            margin-bottom: 28px;
            flex-wrap: wrap;
            padding: 20px 24px;
            border-radius: 14px;
            background: var(--surface-dark);
        }

        body.theme-light .top {
            background: var(--surface-light);
            border: 1px solid var(--border-light);
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .top-left h1 { margin: 0 0 6px; font-size: 26px; font-weight: 800; }
        .top-left .subtitle { font-size: 13px; opacity: 0.75; }

        .top-right {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .top-right a {
            text-decoration: none;
            border: 1px solid var(--border-dark);
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
            cursor: pointer;
            background: transparent;
            color: var(--cyan);
        }

        body.theme-light .top-right a {
            border-color: var(--border-light);
            color: var(--cyan-light);
        }

        .top-right a:hover {
            background: var(--cyan);
            color: #000;
            border-color: var(--cyan);
            transform: translateY(-2px);
        }

        .grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 18px;
        }

        .card {
            border: 1px solid var(--border-dark);
            border-radius: 14px;
            padding: 20px;
            background: var(--surface-dark);
        }

        body.theme-light .card {
            border-color: var(--border-light);
            background: var(--surface-light);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 16px;
            font-size: 16px;
            font-weight: 700;
        }

        .materias-list {
            display: grid;
            gap: 8px;
            max-height: 640px;
            overflow-y: auto;
        }

        .materia-group {
            border: 1px solid var(--border-dark);
            border-radius: 10px;
            overflow: hidden;
            background: var(--surface2-dark);
        }

        body.theme-light .materia-group {
            border-color: var(--border-light);
            background: var(--surface2-light);
        }

        .materia-title {
            padding: 12px 14px;
            font-weight: 700;
            font-size: 12px;
            cursor: pointer;
            user-select: none;
            transition: all 0.2s;
            border-bottom: 1px solid var(--border-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        body.theme-light .materia-title {
            border-bottom-color: var(--border-light);
        }

        .materia-title:hover {
            background: rgba(0,229,255,0.1);
        }

        .materia-title.active {
            background: rgba(0,229,255,0.18);
            color: var(--cyan);
            border-bottom-color: var(--cyan);
        }

        .challenges-in-materia {
            display: grid;
            gap: 0;
        }

        .challenge-item {
            padding: 12px 14px;
            border-bottom: 1px solid var(--border-dark);
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s;
        }

        body.theme-light .challenge-item {
            border-bottom-color: var(--border-light);
        }

        .challenge-item:last-child { border-bottom: none; }

        .challenge-item:hover {
            background: rgba(0,229,255,0.12);
        }

        .challenge-item.active {
            border-left: 3px solid var(--cyan);
            background: rgba(0,229,255,0.16);
            padding-left: 11px;
            font-weight: 600;
        }

        .challenge-item-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .challenge-item-meta {
            font-size: 11px;
            opacity: 0.65;
        }

        .editor-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .editor-title-section h2 {
            margin: 0 0 10px;
            font-size: 20px;
            font-weight: 800;
        }

        .pills {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .pill {
            font-size: 11px;
            border: 1px solid var(--border-dark);
            border-radius: 999px;
            padding: 6px 12px;
            background: rgba(0,229,255,0.08);
            color: var(--cyan);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        body.theme-light .pill {
            border-color: var(--border-light);
            background: rgba(0,150,200,0.08);
            color: var(--cyan-light);
        }

        .theory-box {
            background: rgba(0,229,255,0.06);
            border-left: 4px solid var(--cyan);
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 18px;
            font-size: 14px;
            line-height: 1.7;
        }

        body.theme-light .theory-box {
            background: rgba(0,150,200,0.06);
            border-left-color: var(--cyan-light);
        }

        .theory-box strong { color: var(--cyan); }
        body.theme-light .theory-box strong { color: var(--cyan-light); }

        .challenge-description {
            background: var(--surface2-dark);
            border: 1px solid var(--border-dark);
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 18px;
            font-size: 14px;
            line-height: 1.8;
        }

        body.theme-light .challenge-description {
            border-color: var(--border-light);
            background: var(--surface2-light);
        }

        .description-example {
            background: rgba(0,255,135,0.06);
            padding: 12px;
            border-radius: 6px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            color: var(--green);
            margin: 12px 0;
            border-left: 2px solid var(--green);
            line-height: 1.6;
        }

        body.theme-light .description-example {
            background: rgba(0,150,200,0.06);
            color: var(--cyan-light);
            border-left-color: var(--cyan-light);
        }

        .hint-box {
            background: rgba(255,209,63,0.08);
            border-left: 3px solid var(--yellow);
            border-radius: 8px;
            padding: 12px;
            margin: 16px 0;
            font-size: 13px;
            color: var(--yellow);
            display: none;
            line-height: 1.6;
        }

        body.theme-light .hint-box {
            background: rgba(255,200,0,0.08);
        }

        .hint-box.shown {
            display: block;
        }

        .code-input, .math-input, .select-input {
            width: 100%;
            padding: 14px;
            border: 1px solid var(--border-dark);
            border-radius: 10px;
            background: var(--surface2-dark);
            color: var(--text-dark);
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            transition: all 0.3s;
            line-height: 1.6;
        }

        body.theme-light .code-input,
        body.theme-light .math-input,
        body.theme-light .select-input {
            border-color: var(--border-light);
            background: var(--surface2-light);
            color: var(--text-light);
        }

        .code-input:focus, .math-input:focus, .select-input:focus {
            border-color: var(--cyan);
            outline: none;
            box-shadow: 0 0 0 2px rgba(0,229,255,0.2);
        }

        body.theme-light .code-input:focus,
        body.theme-light .math-input:focus,
        body.theme-light .select-input:focus {
            border-color: var(--cyan-light);
            box-shadow: 0 0 0 2px rgba(0,150,200,0.2);
        }

        .code-input { min-height: 180px; resize: vertical; }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 18px;
            flex-wrap: wrap;
        }

        button {
            border: 1px solid var(--border-dark);
            border-radius: 8px;
            padding: 11px 18px;
            background: var(--surface2-dark);
            color: var(--text-dark);
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
            transition: all 0.3s;
            font-family: 'Space Grotesk', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        body.theme-light button {
            border-color: var(--border-light);
            background: var(--surface2-light);
            color: var(--text-light);
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        button.primary {
            background: var(--cyan);
            color: #030814;
            border-color: var(--cyan);
            font-weight: 800;
        }

        button.primary:hover {
            background: #33eeff;
            box-shadow: 0 6px 20px rgba(0,229,255,0.3);
        }

        .result {
            margin-top: 18px;
            background: var(--surface2-dark);
            border: 1px solid var(--border-dark);
            border-radius: 10px;
            padding: 18px;
            min-height: 100px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            white-space: pre-wrap;
            word-break: break-word;
            line-height: 1.7;
        }

        body.theme-light .result {
            background: var(--surface2-light);
            border-color: var(--border-light);
        }

        .ok { color: var(--green); font-weight: 800; }
        .fail { color: var(--red); font-weight: 800; }
        .info { color: var(--cyan); font-weight: 800; }

        .xp-badge {
            display: inline-block;
            background: var(--green);
            color: #000;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 800;
            margin-top: 10px;
        }

        @media (max-width: 1100px) {
            .grid {
                grid-template-columns: 1fr;
            }
            .materias-list {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                max-height: none;
            }
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--surface-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-dark);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--cyan);
        }
    </style>
</head>
<body class="theme-dark">
<div class="wrap">
    <div class="top">
        <div class="top-left">
            <h1><?= htmlspecialchars($i18n[$lang]['title']) ?></h1>
            <div class="subtitle"><?= htmlspecialchars($i18n[$lang]['subtitle']) ?></div>
        </div>
        <div class="top-right">
            <a href="dashboard.php<?= $materia_activa ? '?materia=' . urlencode($materia_activa) : '' ?>"><?= htmlspecialchars($i18n[$lang]['go_dashboard']) ?></a>
            <a href="mapa/index.php"><?= htmlspecialchars($i18n[$lang]['go_map']) ?></a>
        </div>
    </div>

    <div class="grid">
        <!-- SIDEBAR: MATERIAS Y DESAFÍOS -->
        <section class="card">
            <h3><?= htmlspecialchars($i18n[$lang]['materia']) ?></h3>
            <div class="materias-list" id="materiasList"></div>
        </section>

        <!-- MAIN: EDITOR Y RESULTADO -->
        <section class="card">
            <div class="editor-header">
                <div class="editor-title-section">
                    <h2 id="challengeTitle">—</h2>
                    <div class="pills">
                        <span class="pill"><span id="challengeDifficulty">—</span></span>
                        <span class="pill"><span id="challengeType">—</span></span>
                        <span class="pill" style="color:var(--green);"><span id="challengePoints">10</span> pts</span>
                    </div>
                </div>
            </div>

            <div id="theoryBox" class="theory-box" style="display:none;"></div>
            <div class="challenge-description" id="challengeDescription"></div>
            <div id="hintBox" class="hint-box"></div>

            <div id="editorWrapper">
                <!-- Inserted dynamically -->
            </div>

            <div class="actions">
                <button class="primary" id="runBtn"><?= htmlspecialchars($i18n[$lang]['run']) ?></button>
                <button id="resetBtn"><?= htmlspecialchars($i18n[$lang]['reset']) ?></button>
                <button id="hintBtn" style="display:none; background: rgba(255,209,63,0.12); color: var(--yellow); border-color: var(--yellow);">💡 <?= htmlspecialchars($i18n[$lang]['show_hint']) ?></button>
            </div>

            <div class="result" id="resultBox"><?= htmlspecialchars($i18n[$lang]['result']) ?>:</div>
        </section>
    </div>
</div>

<script>
const TEXTS = {
  allOk: <?= json_encode($i18n[$lang]['all_ok']) ?>,
  result: <?= json_encode($i18n[$lang]['result']) ?>,
  xp: <?= json_encode($i18n[$lang]['xp_earned']) ?>,
};

const CHALLENGES_BY_MATERIA = {
  'Programación': [
    {
      id: 'prog-sum-array',
      title: 'Suma de elementos',
      difficulty: 'Fácil',
      type: 'JavaScript',
      points: 10,
      theory: '<strong>Arrays (Arreglos):</strong> Una estructura de datos que almacena múltiples valores en una sola variable. Se acceden por índice (comenzando en 0). Métodos útiles: <code>push()</code>, <code>pop()</code>, <code>reduce()</code>, <code>forEach()</code>.',
      description: 'Crea una función que <strong>sume todos los elementos</strong> de un arreglo numérico.<br><br>Los elementos pueden ser positivos, negativos o cero. Tu función debe retornar un número.',
      examples: 'Entrada: [1,2,3] → Salida: 6<br>Entrada: [5,-2,7] → Salida: 10<br>Entrada: [0,0,0] → Salida: 0',
      hint: 'Opción 1: Usa un bucle <code>for</code> e incrementa un acumulador.<br>Opción 2: Usa <code>reduce()</code> para una solución funcional.',
      starter: `function solve(arr) {
  // Suma todos los elementos del arreglo
  // Retorna el resultado
  return 0;
}`,
      run: (fn) => {
        const tests = [
          {input: [[1,2,3]], expected: 6},
          {input: [[5,-2,7]], expected: 10},
          {input: [[0,0,0]], expected: 0},
          {input: [[100]], expected: 100},
          {input: [[-5,-3,-2]], expected: -10},
        ];
        return tests.map((t) => ({ 
          ok: fn(...t.input) === t.expected, 
          expected: t.expected, 
          got: fn(...t.input), 
          input: t.input 
        }));
      }
    },
    {
      id: 'prog-palindromo',
      title: 'Verificar palíndromo',
      difficulty: 'Medio',
      type: 'JavaScript',
      points: 15,
      theory: '<strong>Palíndromos:</strong> Textos que se leen igual al derecho y al revés. Ejemplos clásicos: "Anita lava la tina", "Radar", "A man, a plan, a canal: Panama". Se deben ignorar espacios y mayúsculas.',
      description: 'Verifica si un texto es un <strong>palíndromo</strong> (se lee igual en ambas direcciones).<br><br>Requerimientos:<br>• Ignora espacios en blanco<br>• Ignora diferencias entre mayúsculas y minúsculas<br>• Retorna true o false',
      examples: '"Anita lava la tina" → true (ignorando espacios es: anitalavalatina)<br>"Radar" → true<br>"Hola mundo" → false',
      hint: 'Paso 1: Convierte a minúsculas y elimina espacios con <code>toLowerCase()</code> y <code>replace()</code>.<br>Paso 2: Invierte el string y compara con el original.<br>Usar <code>split("").reverse().join("")</code> para invertir.',
      starter: `function solve(text) {
  // Retorna true si es palíndromo, false si no
  return false;
}`,
      run: (fn) => {
        const tests = [
          {input: ['Anita lava la tina'], expected: true},
          {input: ['Radar'], expected: true},
          {input: ['Hola mundo'], expected: false},
          {input: ['A man, a plan, a canal: Panama'], expected: true},
        ];
        return tests.map((t) => ({ 
          ok: fn(...t.input) === t.expected, 
          expected: t.expected, 
          got: fn(...t.input), 
          input: t.input 
        }));
      }
    },
    {
      id: 'prog-fizzbuzz',
      title: 'FizzBuzz clásico',
      difficulty: 'Fácil',
      type: 'JavaScript',
      points: 10,
      theory: '<strong>Condicionales (if/else):</strong> Estructura fundamental de control de flujo. Permite ejecutar código basado en condiciones. El operador módulo <code>%</code> retorna el residuo de una división.',
      description: 'Implementa el desafío <strong>FizzBuzz</strong>:<br><br>Para números del 1 al n:<br>• Si es múltiplo de 3: agrega "Fizz"<br>• Si es múltiplo de 5: agrega "Buzz"<br>• Si es múltiplo de ambos: agrega "FizzBuzz"<br>• Si no: agrega el número',
      examples: 'solve(5) → ["1","2","Fizz","4","Buzz"]<br>solve(15) → [...el índice 14 debe ser "FizzBuzz"]',
      hint: 'Usa <code>%</code> (módulo) para verificar divisibilidad: <code>n % 3 === 0</code> significa que n es divisible por 3.<br>Crea un arreglo con un bucle for y usa condicionales anidados.',
      starter: `function solve(n) {
  // Retorna un arreglo con FizzBuzz del 1 al n
  return [];
}`,
      run: (fn) => {
        const out = fn(5);
        const out15 = fn(15);
        return [
          { 
            ok: Array.isArray(out) && out.join(',') === '1,2,Fizz,4,Buzz', 
            expected: '1,2,Fizz,4,Buzz', 
            got: Array.isArray(out) ? out.join(',') : String(out), 
            input: [5] 
          },
          { 
            ok: Array.isArray(out15) && out15[14] === 'FizzBuzz', 
            expected: 'FizzBuzz en índice 14', 
            got: Array.isArray(out15) ? out15[14] : String(out15), 
            input: [15] 
          }
        ];
      }
    },
    {
      id: 'prog-fibonacci',
      title: 'Sucesión Fibonacci',
      difficulty: 'Medio',
      type: 'JavaScript',
      points: 15,
      theory: '<strong>Recursión vs Iteración:</strong> Fibonacci (cada número = suma de los dos anteriores) es un ejemplo clásico donde la iteración es MUCHO más eficiente que la recursión. Secuencia: 1, 1, 2, 3, 5, 8, 13, 21...',
      description: 'Genera los <strong>primeros n números</strong> de la sucesión Fibonacci donde cada número es la suma de los dos anteriores.<br><br>Comienza con: 1, 1<br>Luego: 1+1=2, 1+2=3, 2+3=5, etc.',
      examples: 'solve(6) → [1, 1, 2, 3, 5, 8]<br>solve(1) → [1]<br>solve(8) → [1, 1, 2, 3, 5, 8, 13, 21]',
      hint: 'Mantén dos variables (a, b) con los últimos dos números. En cada iteración: calcula siguiente = a + b, luego actualiza a y b.',
      starter: `function solve(n) {
  // Retorna los primeros n números Fibonacci
  return [];
}`,
      run: (fn) => {
        const out = fn(6);
        return [
          { 
            ok: Array.isArray(out) && out.join(',') === '1,1,2,3,5,8', 
            expected: '[1,1,2,3,5,8]', 
            got: Array.isArray(out) ? '[' + out.join(',') + ']' : String(out), 
            input: [6] 
          }
        ];
      }
    },
    {
      id: 'prog-closure',
      title: 'Closures y funciones superiores',
      difficulty: 'Difícil',
      type: 'JavaScript',
      points: 20,
      theory: '<strong>Closures:</strong> Cuando una función "recuerda" variables de su contexto externo, incluso después de que la función externa ha terminado. Muy útil para crear funciones personalizadas.<br><strong>Funciones que retornan funciones</strong> son ejemplo de Higher Order Functions.',
      description: 'Crea una función que <strong>retorna otra función</strong> que multiplica su entrada por un factor dado.<br><br>La función interna debe "recordar" el factor incluso cuando se llama después.',
      examples: 'const multiplicaX2 = solve(2);<br>multiplicaX2(5) → 10 (porque 5 × 2)<br><br>const multiplicaX3 = solve(3);<br>multiplicaX3(4) → 12 (porque 4 × 3)',
      hint: 'La función externa recibe el factor. Retorna una función que recibe x y multiplica x por factor. La función interna tiene acceso a la variable factor del contexto externo.',
      starter: `function solve(factor) {
  // Retorna una función que multiplica por factor
  return function(x) {
    // Implementa la multiplicación aquí
    return 0;
  };
}`,
      run: (fn) => {
        const mult2 = fn(2);
        const mult3 = fn(3);
        return [
          { ok: mult2(5) === 10, expected: 10, got: mult2(5), input: ['solve(2)(5)'] },
          { ok: mult3(4) === 12, expected: 12, got: mult3(4), input: ['solve(3)(4)'] },
          { ok: mult2(0) === 0, expected: 0, got: mult2(0), input: ['solve(2)(0)'] },
        ];
      }
    },
  ],
  'Pensamiento Matemático III': [
    {
      id: 'mat-derivada',
      title: 'Derivada básica',
      difficulty: 'Medio',
      type: 'Matemática',
      points: 12,
      theory: '<strong>La derivada f\'(x)</strong> mide la tasa de cambio instantánea de una función. Formalmente: f\'(x) = lim(h→0) [f(x+h) - f(x)]/h. Geométricamente es la pendiente de la recta tangente.',
      description: 'Calcula la derivada de <strong>f(x) = 3x² + 2x + 1</strong> evaluada en <strong>x = 2</strong>.<br><br>Pasos recomendados:<br>1. Aplica reglas de derivación a cada término<br>2. Obtén f\'(x)<br>3. Sustituye x = 2',
      examples: '<strong>f(x) = 3x² + 2x + 1</strong><br><br>Derivadas por término:<br>• d/dx[3x²] = 6x<br>• d/dx[2x] = 2<br>• d/dx[1] = 0<br><br>Por lo tanto: f\'(x) = 6x + 2<br>f\'(2) = 6(2) + 2 = 12 + 2 = <strong>14</strong>',
      hint: 'Reglas básicas:<br>• d/dx[xⁿ] = n·x^(n-1)<br>• d/dx[ax] = a<br>• d/dx[c] = 0 (constante)',
      answer: '14',
      run: (input) => {
        const expected = 14;
        const got = parseFloat(input);
        if (isNaN(got)) return { ok: false, msg: 'La respuesta debe ser un número' };
        return { ok: Math.abs(got - expected) < 0.01, expected, got };
      }
    },
    {
      id: 'mat-integral',
      title: 'Integral definida',
      difficulty: 'Difícil',
      type: 'Matemática',
      points: 16,
      theory: '<strong>Integral definida:</strong> ∫ₐᵇ f(x)dx = F(b) - F(a), donde F es una antiderivada (función cuya derivada es f). Geométricamente es el área bajo la curva.',
      description: 'Calcula la integral definida: <strong>∫₀² (2x + 1) dx</strong><br><br>Pasos:<br>1. Encuentra la antiderivada F(x)<br>2. Aplica Teorema Fundamental del Cálculo<br>3. Resta F(2) - F(0)',
      examples: '∫₀² (2x + 1) dx<br><br>Antiderivada: F(x) = x² + x<br><br>Evaluación:<br>F(2) = 2² + 2 = 4 + 2 = 6<br>F(0) = 0² + 0 = 0<br><br>Resultado: 6 - 0 = <strong>6</strong>',
      hint: 'Antiderivadas comunes:<br>• ∫ x dx = x²/2<br>• ∫ 2x dx = x²<br>• ∫ 1 dx = x<br>Luego resta los valores en los límites.',
      answer: '6',
      run: (input) => {
        const expected = 6;
        const got = parseFloat(input);
        if (isNaN(got)) return { ok: false, msg: 'La respuesta debe ser un número' };
        return { ok: Math.abs(got - expected) < 0.01, expected, got };
      }
    },
  ],
  'Física I': [
    {
      id: 'fis-velocidad',
      title: 'Velocidad promedio',
      difficulty: 'Fácil',
      type: 'Física',
      points: 10,
      theory: '<strong>Velocidad promedio</strong> = Distancia total / Tiempo total. Es diferente de velocidad instantánea. Unidades comunes: m/s, km/h.',
      description: 'Un auto recorre <strong>120 km en 2 horas</strong>.<br><br>¿Cuál es su <strong>velocidad promedio</strong> en km/h?',
      examples: 'v = Δd / Δt<br>v = 120 km / 2 h<br>v = <strong>60 km/h</strong>',
      hint: 'Fórmula simple: velocidad = distancia ÷ tiempo. Las unidades se simplifican: km/h.',
      answer: '60',
      run: (input) => {
        const expected = 60;
        const got = parseFloat(input);
        if (isNaN(got)) return { ok: false, msg: 'Respuesta no es un número válido' };
        return { ok: Math.abs(got - expected) < 0.5, expected, got };
      }
    },
    {
      id: 'fis-energia',
      title: 'Energía cinética',
      difficulty: 'Medio',
      type: 'Física',
      points: 13,
      theory: '<strong>Energía cinética (Ec):</strong> Energía que posee un objeto por su movimiento. Depende de la masa y especialmente de la velocidad (elevada al cuadrado). Unidad: Joules (J).',
      description: 'Calcula la <strong>energía cinética</strong> de un objeto con:<br>• Masa (m) = 5 kg<br>• Velocidad (v) = 10 m/s<br><br>Usa la fórmula: <strong>Ec = ½mv²</strong>',
      examples: 'Ec = ½ × m × v²<br>Ec = ½ × 5 kg × (10 m/s)²<br>Ec = ½ × 5 × 100<br>Ec = 2.5 × 100<br>Ec = <strong>250 Joules</strong>',
      hint: 'No olvides: ½ (es mitad, no se omite) y v está al cuadrado. Resultado en Joules.',
      answer: '250',
      run: (input) => {
        const expected = 250;
        const got = parseFloat(input);
        if (isNaN(got)) return { ok: false, msg: 'Respuesta no es número válido' };
        return { ok: Math.abs(got - expected) < 1, expected, got };
      }
    },
  ],
  'Química I': [
    {
      id: 'quim-mol',
      title: 'Cálculo de moles',
      difficulty: 'Fácil',
      type: 'Química',
      points: 10,
      theory: '<strong>Mol:</strong> Unidad de cantidad de materia (1 mol ≈ 6.022 × 10²³ partículas). Relación: moles = masa / masa molar. La masa molar se expresa en g/mol.',
      description: '¿Cuántos moles hay en <strong>18 gramos de agua (H₂O)</strong>?<br><br>Dado: Masa molar de H₂O = 18 g/mol<br>Usa: <strong>n = m / M</strong>',
      examples: 'n = masa / masa molar<br>n = 18 g / 18 g/mol<br>n = <strong>1 mol</strong>',
      hint: 'Fórmula directa: moles = masa (g) ÷ masa molar (g/mol). Cancela las unidades.',
      answer: '1',
      run: (input) => {
        const expected = 1;
        const got = parseFloat(input);
        if (isNaN(got)) return { ok: false, msg: 'No es número válido' };
        return { ok: Math.abs(got - expected) < 0.01, expected, got };
      }
    },
    {
      id: 'quim-ph',
      title: 'pH de una solución',
      difficulty: 'Medio',
      type: 'Química',
      points: 12,
      theory: '<strong>pH</strong> = -log₁₀[H⁺]. Mide la concentración de iones hidrógeno. Escala: pH < 7 (ácido), pH = 7 (neutro), pH > 7 (básico). Rango típico: 0 a 14.',
      description: 'Calcula el <strong>pH</strong> de una solución con concentración de H⁺ = 10⁻³ M<br><br>Usa: <strong>pH = -log[H⁺]</strong>',
      examples: 'pH = -log(10⁻³)<br>pH = -(-3)<br>pH = <strong>3</strong><br><br>Interpretación: pH 3 es una solución ácida.',
      hint: 'log₁₀(10ⁿ) = n. Entonces log(10⁻³) = -3, y pH = -(-3) = 3.',
      answer: '3',
      run: (input) => {
        const expected = 3;
        const got = parseFloat(input);
        if (isNaN(got)) return { ok: false, msg: 'No es número válido' };
        return { ok: Math.abs(got - expected) < 0.1, expected, got };
      }
    },
  ],
  'Ecosistemas': [
    {
      id: 'eco-cadena',
      title: 'Eficiencia energética trófica',
      difficulty: 'Fácil',
      type: 'Opción Múltiple',
      points: 10,
      theory: '<strong>Segunda Ley de Termodinámica en ecología:</strong> Solo ~10% de la energía se transfiere entre niveles tróficos. El 90% se pierde como calor, movimiento, etc. Esta es la razón por la que la cadena alimenticia tiene pocas "eslabones".',
      description: 'En una cadena trófica, ¿cuánta energía <strong>aproximadamente</strong> se transfiere del nivel trófico anterior al siguiente?',
      examples: 'Ejemplo numérico:<br>Productor (plantas): 1000 kcal<br>Herbívoro: 100 kcal (10% de 1000)<br>Carnívoro: 10 kcal (10% de 100)<br>Depredador superior: 1 kcal (10% de 10)',
      options: ['50%', '10%', '90%', '25%'],
      correctIndex: 1,
      hint: 'Recuerda la regla del 10%: cada nivel retiene solo ~10% de la energía. El 90% se pierde principalmente en calor durante el metabolismo.',
      run: (selectedIndex) => {
        const correct = 1;
        return { ok: selectedIndex === correct, expected: '10%', got: selectedIndex >= 0 ? ['50%', '10%', '90%', '25%'][selectedIndex] : 'Sin respuesta' };
      }
    },
    {
      id: 'eco-fotosintesis',
      title: 'Organismos productores',
      difficulty: 'Fácil',
      type: 'Opción Múltiple',
      points: 10,
      theory: '<strong>Productores (autótrofos):</strong> Organismos que fabrican su propio alimento mediante fotosíntesis. Convierten energía solar en energía química. Son la base de casi toda cadena alimenticia en la Tierra.',
      description: 'Los organismos <strong>productores</strong> en un ecosistema son aquellos que:',
      examples: 'Ejemplos de productores:<br>• Plantas verdes (terrestres)<br>• Algas (acuáticas)<br>• Cianobacterias<br><br>Todos realizan fotosíntesis: 6CO₂ + 6H₂O + luz → C₆H₁₂O₆ + O₂',
      options: ['Herbívoros', 'Plantas verdes', 'Carroñeros', 'Descomponedores'],
      correctIndex: 1,
      hint: 'Los productores son autótrofos (hacen su propio alimento). Herbívoros, carroñeros y descomponedores son heterótrofos (dependen de otros).',
      run: (selectedIndex) => {
        const correct = 1;
        return { ok: selectedIndex === correct, expected: 'Plantas verdes', got: selectedIndex >= 0 ? ['Herbívoros', 'Plantas verdes', 'Carroñeros', 'Descomponedores'][selectedIndex] : 'Sin respuesta' };
      }
    },
  ],
};

let editor;
let currentChallenge;
let materias = Object.keys(CHALLENGES_BY_MATERIA).sort();

function renderMateriasList() {
  const list = document.getElementById('materiasList');
  list.innerHTML = '';

  materias.forEach((materia) => {
    const group = document.createElement('div');
    group.className = 'materia-group';

    const title = document.createElement('div');
    title.className = 'materia-title' + (materia === '<?= addslashes($materia_activa) ?>' ? ' active' : '');
    title.textContent = materia;
    title.setAttribute('data-materia', materia);

    const challenges = document.createElement('div');
    challenges.className = 'challenges-in-materia';
    challenges.style.display = (materia === '<?= addslashes($materia_activa) ?>' ? 'grid' : 'none');

    CHALLENGES_BY_MATERIA[materia].forEach((ch) => {
      const item = document.createElement('div');
      item.className = 'challenge-item';
      item.innerHTML = `
        <div class="challenge-item-title">${ch.title}</div>
        <div class="challenge-item-meta">${ch.difficulty} • ${ch.points} pts</div>
      `;
      item.addEventListener('click', () => selectChallenge(ch, materia));
      challenges.appendChild(item);
    });

    title.addEventListener('click', () => {
      challenges.style.display = challenges.style.display === 'none' ? 'grid' : 'none';
      title.classList.toggle('active');
      document.querySelectorAll('.materia-title').forEach(t => {
        if (t !== title) {
          t.classList.remove('active');
          const sibling = t.nextElementSibling;
          if (sibling) sibling.style.display = 'none';
        }
      });
    });

    group.appendChild(title);
    group.appendChild(challenges);
    list.appendChild(group);
  });

  // Auto-open first materia if no materia in params
  if (!window.location.search.includes('materia')) {
    const firstMat = materias[0];
    if (firstMat) {
      const firstChall = CHALLENGES_BY_MATERIA[firstMat][0];
      selectChallenge(firstChall, firstMat);
    }
  } else {
    const params = new URLSearchParams(window.location.search);
    const mat = params.get('materia');
    if (mat && CHALLENGES_BY_MATERIA[mat]) {
      const firstChall = CHALLENGES_BY_MATERIA[mat][0];
      selectChallenge(firstChall, mat);
    }
  }
}

function selectChallenge(ch, materia) {
  currentChallenge = ch;
  history.replaceState({}, '', '?materia=' + encodeURIComponent(materia));

  document.getElementById('challengeTitle').textContent = ch.title;
  document.getElementById('challengeDifficulty').textContent = ch.difficulty;
  document.getElementById('challengeType').textContent = ch.type;
  document.getElementById('challengePoints').textContent = ch.points;

  if (ch.theory) {
    document.getElementById('theoryBox').innerHTML = ch.theory;
    document.getElementById('theoryBox').style.display = 'block';
  } else {
    document.getElementById('theoryBox').style.display = 'none';
  }

  let desc = ch.description;
  if (ch.examples) {
    desc += '<div class="description-example">' + ch.examples.replace(/\n/g, '<br>') + '</div>';
  }
  document.getElementById('challengeDescription').innerHTML = desc;

  if (ch.hint) {
    document.getElementById('hintBox').innerHTML = ch.hint;
    document.getElementById('hintBtn').style.display = 'block';
  } else {
    document.getElementById('hintBtn').style.display = 'none';
  }
  document.getElementById('hintBox').classList.remove('shown');

  document.getElementById('resultBox').textContent = TEXTS.result + ':';

  const wrapper = document.getElementById('editorWrapper');
  wrapper.innerHTML = '';

  if (ch.type === 'JavaScript') {
    const textarea = document.createElement('textarea');
    textarea.className = 'code-input';
    textarea.value = ch.starter;
    wrapper.appendChild(textarea);
    editor = textarea;
  } else if (ch.type === 'Matemática') {
    const input = document.createElement('input');
    input.type = 'number';
    input.step = '0.01';
    input.placeholder = 'Tu respuesta...';
    input.className = 'math-input';
    input.id = 'mathInput';
    wrapper.appendChild(input);
    editor = null;
  } else if (ch.type === 'Opción Múltiple') {
    const select = document.createElement('select');
    select.id = 'multiSelect';
    select.className = 'select-input';

    const defaultOpt = document.createElement('option');
    defaultOpt.value = '-1';
    defaultOpt.textContent = '← Selecciona una respuesta';
    select.appendChild(defaultOpt);

    ch.options.forEach((opt, idx) => {
      const option = document.createElement('option');
      option.value = idx;
      option.textContent = opt;
      select.appendChild(option);
    });

    wrapper.appendChild(select);
    editor = null;
  }

  document.querySelectorAll('.challenge-item').forEach(item => {
    item.classList.remove('active');
    const title = item.querySelector('.challenge-item-title');
    if (title && title.textContent === ch.title) {
      item.classList.add('active');
    }
  });
}

function runChallenge() {
  const resultBox = document.getElementById('resultBox');

  if (!currentChallenge) {
    resultBox.innerHTML = '<span class="fail">✗ No hay desafío seleccionado.</span>';
    return;
  }

  try {
    if (currentChallenge.type === 'JavaScript') {
      const code = editor.value;
      const wrapped = new Function(`${code}; return typeof solve === 'function' ? solve : null;`);
      const solve = wrapped();
      if (!solve) {
        resultBox.innerHTML = '<span class="fail">✗ No se detectó una función `solve`.</span>';
        return;
      }
      const results = currentChallenge.run(solve);
      const failed = results.filter((r) => !r.ok);
      if (failed.length === 0) {
        const xp = currentChallenge.points;
        resultBox.innerHTML = `<span class="ok">${TEXTS.allOk}</span><div class="xp-badge">${TEXTS.xp.replace('{xp}', xp)}</div>`;
        return;
      }
      let output = '';
      failed.forEach((f, i) => {
        output += `✗ Test ${i + 1} falló\n`;
        output += `  input: ${JSON.stringify(f.input)}\n`;
        output += `  esperado: ${JSON.stringify(f.expected)}\n`;
        output += `  obtenido: ${JSON.stringify(f.got)}\n\n`;
      });
      resultBox.innerHTML = `<span class="fail">${output}</span>`;
    } else if (currentChallenge.type === 'Matemática') {
      const input = document.getElementById('mathInput');
      const result = currentChallenge.run(input.value);
      if (result.ok) {
        const xp = currentChallenge.points;
        resultBox.innerHTML = `<span class="ok">${TEXTS.allOk}</span><div class="xp-badge">${TEXTS.xp.replace('{xp}', xp)}</div>`;
      } else if (result.msg) {
        resultBox.innerHTML = `<span class="fail">✗ ${result.msg}</span>`;
      } else {
        resultBox.innerHTML = `<span class="fail">✗ Respuesta incorrecta.\n\nEsperado: ${result.expected}\nObtenido: ${result.got}</span>`;
      }
    } else if (currentChallenge.type === 'Opción Múltiple') {
      const select = document.getElementById('multiSelect');
      const idx = parseInt(select.value);
      const result = currentChallenge.run(idx);
      if (result.ok) {
        const xp = currentChallenge.points;
        resultBox.innerHTML = `<span class="ok">${TEXTS.allOk}</span><div class="xp-badge">${TEXTS.xp.replace('{xp}', xp)}</div>`;
      } else {
        resultBox.innerHTML = `<span class="fail">✗ Respuesta incorrecta.\n\nEsperado: ${result.expected}\nObtenido: ${result.got}</span>`;
      }
    }
  } catch (err) {
    resultBox.innerHTML = `<span class="fail">✗ Error: ${err.message}</span>`;
  }
}

function resetChallenge() {
  if (!currentChallenge) return;

  if (currentChallenge.type === 'JavaScript') {
    if (editor) editor.value = currentChallenge.starter;
  } else if (currentChallenge.type === 'Matemática') {
    const input = document.getElementById('mathInput');
    if (input) input.value = '';
  } else if (currentChallenge.type === 'Opción Múltiple') {
    const select = document.getElementById('multiSelect');
    if (select) select.value = '-1';
  }

  document.getElementById('resultBox').textContent = TEXTS.result + ':';
  document.getElementById('hintBox').classList.remove('shown');
}

// Inits
renderMateriasList();
document.getElementById('runBtn').addEventListener('click', runChallenge);
document.getElementById('resetBtn').addEventListener('click', resetChallenge);
document.getElementById('hintBtn').addEventListener('click', () => {
  const box = document.getElementById('hintBox');
  box.classList.toggle('shown');
  document.getElementById('hintBtn').textContent = box.classList.contains('shown') ? '✓ Pista mostrada' : '💡 Mostrar pista';
});

// Dark theme by default
document.body.classList.add('theme-dark');
</script>
</body>
</html>
