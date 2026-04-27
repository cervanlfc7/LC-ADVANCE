<?php
require_once 'config/config.php';
requireLogin(true);

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
        'title' => 'Coding Challenges',
        'subtitle' => 'Editor interactivo con pruebas automáticas en tiempo real.',
        'challenge' => 'Desafío',
        'run' => 'Ejecutar pruebas',
        'reset' => 'Reiniciar código',
        'result' => 'Resultado',
        'all_ok' => 'Todo correcto. ¡Excelente!',
        'go_dashboard' => 'Volver al Dashboard',
        'difficulty' => 'Dificultad',
    ],
    'en' => [
        'title' => 'Coding Challenges',
        'subtitle' => 'Interactive editor with real-time automated tests.',
        'challenge' => 'Challenge',
        'run' => 'Run tests',
        'reset' => 'Reset code',
        'result' => 'Result',
        'all_ok' => 'All tests passed. Great job!',
        'go_dashboard' => 'Back to Dashboard',
        'difficulty' => 'Difficulty',
    ],
];
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($i18n[$lang]['title']) ?> | LC-ADVANCE</title>
    <style>
        :root {
            --bg: #060a12;
            --surface: #0c1220;
            --surface2: #111a2d;
            --border: rgba(0,230,255,0.2);
            --cyan: #00e5ff;
            --green: #00ff87;
            --pink: #ff3cac;
            --text: #e8f4ff;
            --muted: rgba(200,230,255,0.62);
        }
        body { margin: 0; background: var(--bg); color: var(--text); font-family: Arial, sans-serif; }
        .wrap { width: min(1100px, 94%); margin: 0 auto; padding: 24px 0 40px; }
        .top { display: flex; justify-content: space-between; gap: 12px; align-items: center; margin-bottom: 16px; flex-wrap: wrap; }
        .top a { text-decoration: none; color: var(--cyan); border: 1px solid var(--border); border-radius: 8px; padding: 8px 12px; font-size: 13px; }
        .subtitle { color: var(--muted); margin-bottom: 18px; }
        .grid { display: grid; grid-template-columns: 320px 1fr; gap: 12px; }
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 12px; padding: 14px; }
        .challenge-list { display: grid; gap: 8px; }
        .challenge-item { background: var(--surface2); border: 1px solid var(--border); border-radius: 10px; padding: 10px; cursor: pointer; }
        .challenge-item.active { border-color: var(--cyan); box-shadow: 0 0 0 2px rgba(0,229,255,0.16); }
        .challenge-item h4 { margin: 0 0 6px; font-size: 14px; }
        .challenge-item p { margin: 0; font-size: 12px; color: var(--muted); }
        .editor-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; gap: 10px; flex-wrap: wrap; }
        .pill { font-size: 11px; border: 1px solid var(--border); border-radius: 999px; padding: 4px 10px; color: var(--cyan); }
        #editor { height: 360px; border: 1px solid var(--border); border-radius: 10px; overflow: hidden; }
        .actions { display: flex; gap: 8px; margin-top: 10px; }
        button { border: 1px solid var(--border); border-radius: 8px; padding: 9px 12px; background: var(--surface2); color: var(--text); cursor: pointer; font-size: 13px; }
        button.primary { background: var(--cyan); color: #041420; border-color: var(--cyan); font-weight: 700; }
        .result { margin-top: 12px; background: #081421; border: 1px solid var(--border); border-radius: 10px; padding: 12px; min-height: 76px; font-family: Consolas, monospace; font-size: 13px; white-space: pre-wrap; }
        .ok { color: var(--green); }
        .fail { color: #ff849f; }
        @media (max-width: 900px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<div class="wrap">
    <div class="top">
        <div>
            <h1 style="margin:0 0 6px;"><?= htmlspecialchars($i18n[$lang]['title']) ?></h1>
            <div class="subtitle"><?= htmlspecialchars($i18n[$lang]['subtitle']) ?></div>
        </div>
        <a href="dashboard.php"><?= htmlspecialchars($i18n[$lang]['go_dashboard']) ?></a>
    </div>

    <div class="grid">
        <section class="card">
            <h3 style="margin-top:0;"><?= htmlspecialchars($i18n[$lang]['challenge']) ?></h3>
            <div class="challenge-list" id="challengeList"></div>
        </section>

        <section class="card">
            <div class="editor-top">
                <strong id="challengeTitle">—</strong>
                <span class="pill"><span><?= htmlspecialchars($i18n[$lang]['difficulty']) ?>:</span> <span id="challengeDifficulty">—</span></span>
            </div>
            <div id="editor"></div>
            <div class="actions">
                <button class="primary" id="runBtn"><?= htmlspecialchars($i18n[$lang]['run']) ?></button>
                <button id="resetBtn"><?= htmlspecialchars($i18n[$lang]['reset']) ?></button>
            </div>
            <div class="result" id="resultBox"><?= htmlspecialchars($i18n[$lang]['result']) ?>:</div>
        </section>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/monaco-editor@0.52.2/min/vs/loader.js"></script>
<script>
const TEXTS = {
  allOk: <?= json_encode($i18n[$lang]['all_ok']) ?>,
  result: <?= json_encode($i18n[$lang]['result']) ?>
};

const CHALLENGES = [
  {
    id: 'sum-array',
    title: 'Suma de arreglo',
    difficulty: 'Easy',
    starter: `function solve(arr) {\n  // Regresa la suma de todos los elementos\n  return 0;\n}`,
    run: (fn) => {
      const tests = [
        {input: [[1,2,3]], expected: 6},
        {input: [[5,-2,7]], expected: 10},
        {input: [[0,0,0]], expected: 0},
      ];
      return tests.map((t) => ({ ok: fn(...t.input) === t.expected, expected: t.expected, got: fn(...t.input), input: t.input }));
    }
  },
  {
    id: 'is-palindrome',
    title: 'Palíndromo alfanumérico',
    difficulty: 'Medium',
    starter: `function solve(text) {\n  // true si es palíndromo ignorando espacios y mayúsculas\n  return false;\n}`,
    run: (fn) => {
      const tests = [
        {input: ['Anita lava la tina'], expected: true},
        {input: ['Radar'], expected: true},
        {input: ['Hola mundo'], expected: false},
      ];
      return tests.map((t) => ({ ok: fn(...t.input) === t.expected, expected: t.expected, got: fn(...t.input), input: t.input }));
    }
  },
  {
    id: 'fizzbuzz',
    title: 'FizzBuzz',
    difficulty: 'Easy',
    starter: `function solve(n) {\n  // Regresa un arreglo del 1..n con reglas FizzBuzz\n  return [];\n}`,
    run: (fn) => {
      const out = fn(5);
      const out15 = fn(15);
      return [
        { ok: Array.isArray(out) && out.join(',') === '1,2,Fizz,4,Buzz', expected: '1,2,Fizz,4,Buzz', got: Array.isArray(out) ? out.join(',') : String(out), input: [5] },
        { ok: Array.isArray(out15) && out15[14] === 'FizzBuzz', expected: 'FizzBuzz en posición 15', got: Array.isArray(out15) ? out15[14] : String(out15), input: [15] }
      ];
    }
  }
];

let editor;
let current = CHALLENGES[0];

function mountList() {
  const list = document.getElementById('challengeList');
  list.innerHTML = '';
  CHALLENGES.forEach((c) => {
    const item = document.createElement('article');
    item.className = 'challenge-item' + (c.id === current.id ? ' active' : '');
    item.innerHTML = `<h4>${c.title}</h4><p>${c.difficulty}</p>`;
    item.addEventListener('click', () => selectChallenge(c.id));
    list.appendChild(item);
  });
}

function selectChallenge(id) {
  const found = CHALLENGES.find((c) => c.id === id);
  if (!found) return;
  current = found;
  document.getElementById('challengeTitle').textContent = current.title;
  document.getElementById('challengeDifficulty').textContent = current.difficulty;
  editor.setValue(current.starter);
  document.getElementById('resultBox').textContent = `${TEXTS.result}:`;
  mountList();
}

function runTests() {
  const code = editor.getValue();
  const resultBox = document.getElementById('resultBox');
  try {
    const wrapped = new Function(`${code}; return typeof solve === 'function' ? solve : null;`);
    const solve = wrapped();
    if (!solve) {
      resultBox.innerHTML = '<span class="fail">No se detectó una función `solve`.</span>';
      return;
    }
    const results = current.run(solve);
    const failed = results.filter((r) => !r.ok);
    if (failed.length === 0) {
      resultBox.innerHTML = `<span class="ok">${TEXTS.allOk}</span>`;
      return;
    }
    let output = '';
    failed.forEach((f, i) => {
      output += `Test ${i + 1} falló\n`;
      output += `input: ${JSON.stringify(f.input)}\n`;
      output += `esperado: ${JSON.stringify(f.expected)}\n`;
      output += `obtenido: ${JSON.stringify(f.got)}\n\n`;
    });
    resultBox.innerHTML = `<span class="fail">${output}</span>`;
  } catch (err) {
    resultBox.innerHTML = `<span class="fail">${err.message}</span>`;
  }
}

require.config({ paths: { vs: 'https://cdn.jsdelivr.net/npm/monaco-editor@0.52.2/min/vs' } });
require(['vs/editor/editor.main'], () => {
  editor = monaco.editor.create(document.getElementById('editor'), {
    value: current.starter,
    language: 'javascript',
    theme: 'vs-dark',
    automaticLayout: true,
    minimap: { enabled: false },
    fontSize: 14
  });
  selectChallenge(current.id);
});

document.getElementById('runBtn').addEventListener('click', runTests);
document.getElementById('resetBtn').addEventListener('click', () => editor && editor.setValue(current.starter));
mountList();
</script>
</body>
</html>
