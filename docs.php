<?php
/**
 * LC-ADVANCE Documentation Viewer
 * Modern dashboard-style Markdown Viewer
 */
require_once 'config/config.php';

function getSafeDocPath($file) {
    $docsDir = realpath(__DIR__ . '/docs/') . DIRECTORY_SEPARATOR;
    $requested = realpath($docsDir . trim($file));
    if ($requested && strpos($requested, $docsDir) === 0 && pathinfo($requested, PATHINFO_EXTENSION) === 'md') {
        return $requested;
    }
    return null;
}

$file = $_GET['file'] ?? '';

$uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!$file && preg_match('#/([a-zA-Z0-9._-]+\.md)$#i', $uriPath, $matches)) {
    $file = $matches[1];
}

if (!$file) {
    $file = 'README.md';
}

$file = basename($file);
$docPath = getSafeDocPath($file);
if (!$docPath) {
    http_response_code(404);
    echo '<!DOCTYPE html><html><body><h1>404 - Documento no encontrado</h1><p>El documento solicitado no existe o no se puede acceder.</p><p><a href="docs.php?file=README.md">Volver a documentación</a></p></body></html>';
    exit;
}

$content = file_get_contents($docPath);

function escapeHtml($value) {
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function parseInline($line) {
    // Normalizar y quitar literales "\n" invocadas en texto markdown.
    $line = str_replace('\\n', '', $line);
    // Links: [text](url)
    $line = preg_replace_callback('/!\[(.*?)\]\((.*?)\)/', function($m) {
        $alt = escapeHtml($m[1]);
        $src = escapeHtml($m[2]);
        return "<img src='$src' alt='$alt' class='inline-image' />";
    }, $line);
    $line = preg_replace_callback('/\[(.*?)\]\((.*?)\)/', function ($m) {
        $text = escapeHtml($m[1]);
        $href = escapeHtml($m[2]);
        $target = preg_match('/^(https?:|\/\/)/', $href) ? ' target="_blank" rel="noopener noreferrer"' : '';
        return "<a href='$href'$target>$text</a>";
    }, $line);
    // Bold, italics, strikethrough
    $line = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $line);
    $line = preg_replace('/__(.+?)__/', '<strong>$1</strong>', $line);
    $line = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $line);
    $line = preg_replace('/_(.+?)_/', '<em>$1</em>', $line);
    $line = preg_replace('/~~(.+?)~~/', '<del>$1</del>', $line);
    // Inline code
    $line = preg_replace('/`([^`]+)`/', '<code class="inline-code">$1</code>', $line);
    return $line;
}

function simpleMarkdown($text) {
    $text = str_replace("\r\n", "\n", $text);
    $text = str_replace("\r", "\n", $text);
    $lines = explode("\n", $text);
    $html = '';
    $inCode = false;
    $codeLang = '';
    $inUl = false;
    $inOl = false;
    $inBlockquote = false;
    $tableMode = false;
    $tableBuffer = [];

    foreach ($lines as $line) {
        $rawLine = str_replace('\\n', '', $line);
        $trimmed = str_replace('\\n', '', trim($line));

        // Saltar líneas vacías (o que solo contenían \n)
        if ($trimmed === '') {
            if ($inUl) { $html .= "</ul>\n"; $inUl = false; }
            if ($inOl) { $html .= "</ol>\n"; $inOl = false; }
            if ($inBlockquote) { $html .= "</blockquote>\n"; $inBlockquote = false; }
            if ($tableMode) { 
                $html .= renderMarkdownTable($tableBuffer); 
                $tableBuffer = []; 
                $tableMode = false; 
            }
            continue;
        }

        if (preg_match('/^```\s*(.*?)$/', $trimmed, $m)) {
            if ($inCode) {
                $html .= "</code></pre></div>\n";
                $inCode = false;
                $codeLang = '';
            } else {
                $inCode = true;
                $codeLang = trim($m[1]);
                $class = $codeLang ? " language-" . escapeHtml($codeLang) : '';
                $html .= "<div class='code-block'><pre><code class='code$class'>";
            }
            continue;
        }

        if ($inCode) {
            $html .= escapeHtml($rawLine) . "\n";
            continue;
        }

        if (preg_match('/^#{1,6}\s+(.+)$/', $trimmed, $m)) {
            if ($inUl) { $html .= "</ul>\n"; $inUl = false; }
            if ($inOl) { $html .= "</ol>\n"; $inOl = false; }
            if ($inBlockquote) { $html .= "</blockquote>\n"; $inBlockquote = false; }
            if ($tableMode) { 
                $html .= renderMarkdownTable($tableBuffer); 
                $tableBuffer = []; 
                $tableMode = false; 
            }
            $level = min(6, substr_count($trimmed, '#'));
            $content = trim(substr($trimmed, $level));
            $content = parseInline(escapeHtml($content));
            $html .= "<h$level>$content</h$level>\n";
            continue;
        }

        if (preg_match('/^\>\s?(.*)$/', $trimmed, $m)) {
            if (!$inBlockquote) {
                if ($inUl) { $html .= "</ul>\n"; $inUl = false; }
                if ($inOl) { $html .= "</ol>\n"; $inOl = false; }
                $html .= "<blockquote>\n";
                $inBlockquote = true;
            }
            $html .= '<p>' . parseInline(escapeHtml($m[1])) . "</p>\n";
            continue;
        }

        if (preg_match('/^(\d+)\.\s+(.*)$/', $trimmed, $m)) {
            if ($inUl) { $html .= "</ul>\n"; $inUl = false; }
            if (!$inOl) { $html .= "<ol>\n"; $inOl = true; }
            $html .= '<li>' . parseInline(escapeHtml($m[2])) . "</li>\n";
            continue;
        }

        if (preg_match('/^[\-\*\+]\s+(.*)$/', $trimmed, $m)) {
            if ($inOl) { $html .= "</ol>\n"; $inOl = false; }
            if (!$inUl) { $html .= "<ul>\n"; $inUl = true; }
            $html .= '<li>' . parseInline(escapeHtml($m[1])) . "</li>\n";
            continue;
        }

        if (preg_match('/^-{3,}\s*$/', $trimmed)) {
            if ($inUl) { $html .= "</ul>\n"; $inUl = false; }
            if ($inOl) { $html .= "</ol>\n"; $inOl = false; }
            if ($inBlockquote) { $html .= "</blockquote>\n"; $inBlockquote = false; }
            if ($tableMode) { 
                $html .= renderMarkdownTable($tableBuffer); 
                $tableBuffer = []; 
                $tableMode = false; 
            }
            $html .= '<hr class="doc-hr">' . "\n";
            continue;
        }

        if (strpos($trimmed, '|') !== false && preg_match('/\|/', $trimmed)) {
            if (!$tableMode) {
                if ($inUl) { $html .= "</ul>\n"; $inUl = false; }
                if ($inOl) { $html .= "</ol>\n"; $inOl = false; }
                if ($inBlockquote) { $html .= "</blockquote>\n"; $inBlockquote = false; }
                $tableMode = true;
            }
            $tableBuffer[] = $trimmed;
            continue;
        }

        if ($tableMode) {
            $html .= renderMarkdownTable($tableBuffer);
            $tableBuffer = [];
            $tableMode = false;
        }

        // Párrafo normal
        $html .= '<p>' . parseInline(escapeHtml($trimmed)) . "</p>\n";
    }

    // Cerrar bloques abiertos
    if ($inCode) {
        $html .= "</code></pre></div>\n";
    }
    if ($inUl) { $html .= "</ul>\n"; }
    if ($inOl) { $html .= "</ol>\n"; }
    if ($inBlockquote) { $html .= "</blockquote>\n"; }
    if ($tableMode) { $html .= renderMarkdownTable($tableBuffer); }

    return $html;
}

function renderMarkdownTable($rows) {
    $html = '<div class="table-wrapper"><table class="doc-table">';
    $head = array_shift($rows);
    $cols = array_map('trim', explode('|', trim($head, '| ')));
    $html .= '<thead><tr>';
    foreach ($cols as $col) {
        $html .= '<th>' . parseInline(escapeHtml($col)) . '</th>';
    }
    $html .= '</tr></thead><tbody>';
    if (!empty($rows)) {
        if (preg_match('/^\s*[:\-\s\|]+$/', $rows[0])) {
            array_shift($rows);
        }
    }
    foreach ($rows as $row) {
        if (trim($row) === '') continue;
        $cells = array_map('trim', explode('|', trim($row, '| ')));
        $html .= '<tr>';
        foreach ($cells as $cell) {
            $html .= '<td>' . parseInline(escapeHtml($cell)) . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= "</tbody></table></div>\n";
    return $html;
}

$htmlContent = simpleMarkdown($content);

$navItems = [
    ['file' => 'README.md', 'label' => 'INICIO', 'icon' => '🏠'],
    ['file' => 'DEVELOPMENT.md', 'label' => 'DESARROLLO', 'icon' => '🔧'],
    ['file' => 'API.md', 'label' => 'API REFERENCE', 'icon' => '🚀'],
    ['file' => 'TROUBLESHOOTING.md', 'label' => 'SOLUCIONES', 'icon' => '💡'],
    ['file' => 'QUICK_REFERENCE.md', 'label' => 'CHEAT SHEET', 'icon' => '📝']
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo escapeHtml($file); ?> - LC-ADVANCE Docs</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0c0f17;
            --surface: #121925;
            --surface2: #1c2436;
            --border: rgba(75, 170, 220, 0.25);
            --border2: rgba(75, 170, 220, 0.18);
            --cyan: #65d9ff;
            --pink: #ff86d2;
            --green: #88ffa4;
            --yellow: #ffe27f;
            --text: #d9e6ff;
            --muted: rgba(180, 215, 255, 0.67);
            --paper: #121827;
            --font-display: 'Syne', sans-serif;
            --font-body: 'Space Grotesk', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
            --transition: all 0.28s ease;
        }
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            color: var(--text);
            background: linear-gradient(140deg, #0a0d18 0%, #101830 65%, #1a2034 100%);
            font-family: var(--font-body);
            overflow-x: hidden;
        }
        .grid-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image: linear-gradient(rgba(75, 170, 220, 0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(75, 170, 220, 0.05) 1px, transparent 1px);
            background-size: 46px 46px;
            animation: gridScroll 40s linear infinite;
            opacity: 0.3;
        }
        .bg-orb { position: fixed; border-radius: 50%; filter: blur(89px); pointer-events: none; z-index: 0; }
        .bg-orb-1 { width: 520px; height: 520px; top: -170px; right: -130px; background: radial-gradient(circle, rgba(39, 124, 255, 0.24), transparent 64%); animation: orbPulse 12s ease-in-out infinite; }
        .bg-orb-2 { width: 380px; height: 380px; bottom: -110px; left: -110px; background: radial-gradient(circle, rgba(255, 122, 192, 0.22), transparent 68%); animation: orbPulse 13s ease-in-out infinite reverse; }
        .docs-wrapper {
            display: block; /* con sidebar fija no necesitamos grid */
            margin-left: 300px; /* deja espacio para la sidebar */
            min-height: min(100dvh, 100vh);
            min-height: calc(100svh - env(safe-area-inset-top) - env(safe-area-inset-bottom));
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        .sidebar {
            background: rgba(10, 14, 28, .93);
            border-right: 1px solid rgba(0, 229, 255, 0.14);
            padding: 30px 18px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            backdrop-filter: blur(15px);
            display: flex;
            flex-direction: column;
            gap: 24px;
            z-index: 15;
        }
        .sidebar-head h3 { margin: 0; font-family: var(--font-display); font-size: 16px; letter-spacing: 0.5px; color: var(--cyan); }
        .nav-list { display: flex; flex-direction: column; gap: 8px; margin: 0; padding: 0; list-style: none; }
        .nav-link { display: flex; align-items: center; gap: 10px; text-decoration: none; padding: 10px 12px; border-radius: 12px; font-family: var(--font-mono); font-size: 11px; color: var(--muted); border: 1px solid transparent; transition: var(--transition); }
        .nav-link:hover { background: rgba(0, 229, 255, 0.1); border-color: rgba(0, 229, 255, 0.2); color: var(--cyan); transform: translateX(2px); }
        .nav-link.active { background: rgba(0, 229, 255, 0.12); border-color: rgba(0, 229, 255, 0.34); color: #fff; box-shadow: 0 0 20px rgba(0, 229, 255, 0.2); }
        .back-btn { margin-top: auto; text-align: center; padding: 10px; color: #000; font-family: var(--font-mono); font-size: 11px; text-transform: uppercase; background: linear-gradient(90deg, var(--cyan), var(--pink)); border-radius: 9px; text-decoration: none; transition: var(--transition); }
        .back-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0, 229, 255, 0.35); }
        .content-area { padding: 42px 44px; margin-left: 0; }
        .doc-card { background: var(--surface); border: 1px solid var(--border); border-radius: 18px; padding: 32px 34px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.32); backdrop-filter: blur(12px); animation: fadeInUp 0.75s ease-out; }
        .markdown-body { color: #d8e9ff; line-height: 1.7; }
        .markdown-body h1 { margin: 0 0 24px; font-family: var(--font-display); font-size: 2.1rem; color: var(--text); text-shadow: 0 0 8px rgba(0, 229, 255, 0.2); }
        .markdown-body h2 { margin: 34px 0 14px; font-family: var(--font-display); font-size: 1.5rem; color: var(--cyan); }
        .markdown-body h3 { margin: 30px 0 12px; font-family: var(--font-display); font-size: 1.2rem; color: var(--pink); }
        .markdown-body p { margin-bottom: 18px; font-size: 1rem; }
        .markdown-body ul, .markdown-body ol { margin: 14px 0 20px 20px; }
        .markdown-body li { margin-bottom: 9px; }
        .markdown-body blockquote { margin: 12px 0 20px; padding: 12px 16px; border-left: 3px solid rgba(0, 229, 255, 0.5); background: rgba(0, 229, 255, 0.04); }
        .doc-table { width: 100%; border-collapse: collapse; margin: 24px 0; }
        .doc-table th, .doc-table td { border: 1px solid rgba(255,255,255,0.12); padding: 10px 12px; }
        .doc-table th { background: rgba(0,229,255,0.12); color: #e3f9ff; font-family: var(--font-mono); font-size: 0.85rem; }
        .doc-table td { background: rgba(5, 15, 30, 0.8); }
        .code-block { background: rgba(3, 12, 25, 0.9); border: 1px solid rgba(0, 229, 255, 0.18); border-radius: 10px; overflow-x: auto; margin: 20px 0; }
        .code-block pre { margin: 0; padding: 16px; font-family: var(--font-mono); font-size: 0.95rem; color: #cfd9ff; white-space: pre-wrap; }
        .inline-code { background: rgba(0, 229, 255, 0.1); border-radius: 3px; padding: 2px 6px; font-family: var(--font-mono); }
        .markdown-body a { color: var(--cyan); text-decoration: none; border-bottom: 1px solid rgba(0, 229, 255, 0.4); }
        .markdown-body a:hover { color: #fff; border-bottom-color: var(--cyan); text-shadow: 0 0 8px rgba(0, 229, 255, 0.55); }
        .doc-hr { border: 0; border-top: 1px solid rgba(255,255,255,0.15); margin: 30px 0; }
        .inline-image { max-width: 100%; border-radius: 8px; margin: 14px 0; }
        .mobile-toggle { display: none; }
        @media (max-width: 992px) {
            .docs-wrapper { grid-template-columns: 1fr; }
            .sidebar { position: fixed; left: -100%; width: 85%; max-width: 320px; top: 0; z-index: 30; height: 100dvh; min-height: calc(100svh - env(safe-area-inset-top) - env(safe-area-inset-bottom)); transition: var(--transition); }
            .sidebar.active { left: 0; }
            .docs-wrapper { margin-left: 0; }
            .content-area { padding: 20px 14px; margin-left: 0; }
            .doc-card { padding: 18px; border-radius: 12px; }
            .mobile-toggle { display: flex; position: fixed; right: 16px; bottom: 16px; width: 46px; height: 46px; border-radius: 50%; align-items: center; justify-content: center; background: var(--yellow); color: #000; font-size: 18px; z-index: 50; box-shadow: 0 6px 22px rgba(255, 180, 40, 0.4); cursor: pointer; }
            .content-area { min-height: calc(100dvh - 80px); overflow-y: auto; }
            .doc-card { background: rgba(12, 18, 30, 0.95); }
            .doc-table { width: 100%; display: block; overflow-x: auto; white-space: nowrap; }
            .doc-table th,
            .doc-table td { white-space: normal; }
            .markdown-body pre { font-size: 0.78rem; }
            .markdown-body code, .markdown-body pre { overflow-wrap: anywhere; word-break: break-word; }
            .markdown-body p, .markdown-body h1, .markdown-body h2, .markdown-body h3 { word-break: break-word; }
            .sidebar { background: rgba(8, 12, 24, 0.95); }
        }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes gridScroll { from { background-position: 0 0, 0 0; } to { background-position: 120px 120px, 120px 120px; } }
        @keyframes orbPulse { 0%, 100% { transform: scale(1); opacity: 0.85; } 50% { transform: scale(1.07); opacity: 1; } }
    </style>
</head>
<body>
    <div class="grid-bg"></div>
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="docs-wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-head"><h3>DOCUMENTACIÓN</h3></div>
            <nav class="nav-list">
                <?php foreach ($navItems as $item) { ?>
                    <a href="docs.php?file=<?php echo urlencode($item['file']); ?>" class="nav-link <?php echo ($item['file'] === $file) ? 'active' : ''; ?>">
                        <span><?php echo $item['icon']; ?></span>
                        <?php echo $item['label']; ?>
                    </a>
                <?php } ?>
            </nav>
            <a href="index.php" class="back-btn">IR AL INICIO</a>
        </aside>
        <main class="content-area">
            <article class="doc-card">
                <div class="markdown-body"><?php echo $htmlContent; ?></div>
            </article>
        </main>
    </div>
    <div class="mobile-toggle" id="mobileToggle">☰</div>
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('mobileToggle');
        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            toggle.textContent = sidebar.classList.contains('active') ? '✕' : '☰';
        });
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 992) {
                    sidebar.classList.remove('active');
                    toggle.textContent = '☰';
                }
            });
        });
    </script>
</body>
</html>