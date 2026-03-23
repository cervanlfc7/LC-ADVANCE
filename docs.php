<?php
/**
 * LC-ADVANCE Documentation Viewer
 * Professional Corporate-Retro Markdown Viewer
 */

require_once 'config/config.php';

// Helper to sanitize file paths
function getSafeDocPath($file) {
    $docsDir = __DIR__ . '/docs/';
    $filePath = realpath($docsDir . $file);
    if ($filePath && strpos($filePath, realpath($docsDir)) === 0 && pathinfo($filePath, PATHINFO_EXTENSION) === 'md') {
        return $filePath;
    }
    return null;
}

$file = $_GET['file'] ?? 'README.md';
$docPath = getSafeDocPath($file);

if (!$docPath) {
    die("Documento no encontrado o acceso denegado.");
}

$content = file_get_contents($docPath);

// Minimal Markdown to HTML (since we don't have Parsedown installed)
function simpleMarkdown($text) {
    // Escaping
    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    
    // Headers
    $text = preg_replace('/^# (.*)$/m', '<h1>$1</h1>', $text);
    $text = preg_replace('/^## (.*)$/m', '<h2>$1</h2>', $text);
    $text = preg_replace('/^### (.*)$/m', '<h3>$1</h3>', $text);
    
    // Bold / Italic
    $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
    $text = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $text);
    
    // Links - Transform local .md links to docs.php?file=...
    $text = preg_replace_callback('/\[(.*?)\]\((.*?)\.md(.*?)\)/', function($m) {
        $label = $m[1];
        $file = $m[2] . '.md';
        $anchor = $m[3];
        return "<a href=\"docs.php?file=$file$anchor\">$label</a>";
    }, $text);
    
    // External Links
    $text = preg_replace('/\[(.*?)\]\((.*?)\)/', '<a href="$2" target="_blank">$1</a>', $text);
    
    // Code blocks
    $text = preg_replace('/```(.*?)\n(.*?)```/s', '<div class="code-block"><pre><code>$2</code></pre></div>', $text);
    $text = preg_replace('/`(.*?)`/', '<code class="inline-code">$1</code>', $text);
    
    // Lists
    $text = preg_replace('/^\- (.*)$/m', '<li>$1</li>', $text);
    $text = preg_replace('/(<li>.*<\/li>)/s', '<ul>$1</ul>', $text);
    
    // Horizontal rule
    $text = preg_replace('/^---$/m', '<hr class="doc-hr">', $text);

    // Paragraphs (simplified)
    $text = preg_replace('/^(?!<[a-z])(.*)$/m', '<p>$1</p>', $text);
    
    return $text;
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($file); ?> - LC-ADVANCE Documentation</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        :root {
            --doc-bg: #050508;
            --doc-card: rgba(15, 15, 20, 0.8);
            --doc-sidebar: rgba(10, 10, 15, 0.9);
            --doc-accent: #00ffff;
            --doc-text: #e0e0e0;
            --header-blur: blur(15px);
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        body {
            background-color: var(--doc-bg);
            color: var(--doc-text);
            font-family: 'VT323', monospace;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Animated Grid Background (Consistent with Index) */
        .grid-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
            z-index: -1;
            mask-image: radial-gradient(circle at center, black, transparent 90%);
        }

        .docs-wrapper {
            display: grid;
            grid-template-columns: 300px 1fr;
            min-height: 100vh;
        }

        /* Sidebar Navigation */
        .sidebar {
            background: var(--doc-sidebar);
            border-right: 1px solid rgba(0, 255, 255, 0.1);
            padding: 40px 20px;
            height: 100vh;
            position: sticky;
            top: 0;
            backdrop-filter: var(--header-blur);
            -webkit-backdrop-filter: var(--header-blur);
            display: flex;
            flex-direction: column;
            gap: 30px;
            z-index: 10;
        }

        .sidebar-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar-header h4 {
            font-family: 'Press Start 2P', cursive;
            font-size: 14px;
            color: var(--neon-yellow);
            margin: 0;
            text-shadow: 0 0 10px rgba(255, 204, 0, 0.3);
        }

        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            text-decoration: none;
            color: var(--text-dim);
            border-radius: 12px;
            transition: var(--transition-smooth);
            font-family: 'Press Start 2P', cursive;
            font-size: 9px;
            border: 1px solid transparent;
        }

        .nav-link:hover {
            background: rgba(0, 255, 255, 0.05);
            color: var(--doc-accent);
            border-color: rgba(0, 255, 255, 0.2);
            padding-left: 20px;
        }

        .nav-link.active {
            background: rgba(0, 255, 255, 0.1);
            color: var(--doc-accent);
            border-color: rgba(0, 255, 255, 0.3);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
        }

        .back-btn {
            margin-top: auto;
            display: block;
            text-align: center;
            padding: 12px;
            background: var(--neon-cyan);
            color: #000;
            text-decoration: none;
            font-family: 'Press Start 2P', cursive;
            font-size: 10px;
            border-radius: 8px;
            transition: var(--transition-smooth);
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 15px var(--neon-cyan);
        }

        /* Content Area */
        .content-area {
            padding: 60px 80px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .doc-card {
            background: var(--doc-card);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 24px;
            padding: 60px;
            backdrop-filter: var(--header-blur);
            -webkit-backdrop-filter: var(--header-blur);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            animation: fadeInUp 0.8s ease-out;
        }

        /* Markdown Styling */
        .markdown-body {
            font-size: 21px;
            line-height: 1.6;
            color: #d1d1d1;
        }

        .markdown-body h1 {
            font-family: 'Press Start 2P', cursive;
            font-size: 28px;
            color: #fff;
            margin-bottom: 40px;
            text-align: left;
            background: linear-gradient(to right, #fff, var(--doc-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 20px;
        }

        .markdown-body h2 {
            font-family: 'Press Start 2P', cursive;
            font-size: 18px;
            color: var(--neon-yellow);
            margin-top: 60px;
            margin-bottom: 25px;
        }

        .markdown-body h3 {
            font-family: 'Press Start 2P', cursive;
            font-size: 14px;
            color: var(--neon-pink);
            margin-top: 40px;
        }

        .markdown-body p { margin-bottom: 20px; }

        .code-block {
            background: #000;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 20px;
            margin: 30px 0;
            overflow-x: auto;
            position: relative;
        }

        .code-block code {
            font-family: 'Courier New', Courier, monospace;
            color: #a9ffad;
            font-size: 18px;
        }

        .inline-code {
            background: rgba(255, 255, 255, 0.05);
            color: var(--neon-cyan);
            padding: 2px 8px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 0.9em;
        }

        .doc-hr {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            margin: 50px 0;
        }

        .markdown-body a {
            color: var(--doc-accent);
            text-decoration: none;
            border-bottom: 1px solid transparent;
            transition: 0.3s;
        }

        .markdown-body a:hover {
            border-bottom-color: var(--doc-accent);
            text-shadow: 0 0 10px var(--doc-accent);
        }

        .markdown-body ul {
            padding-left: 20px;
            margin-bottom: 30px;
        }

        .markdown-body li {
            margin-bottom: 10px;
            list-style: none;
            position: relative;
        }

        .markdown-body li::before {
            content: "→";
            position: absolute;
            left: -25px;
            color: var(--doc-accent);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Mobile Menu */
        .mobile-toggle {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--neon-yellow);
            color: #000;
            width: 50px;
            height: 50px;
            border-radius: 25px;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            z-index: 100;
            cursor: pointer;
            box-shadow: 0 0 20px rgba(255, 204, 0, 0.4);
        }

        @media (max-width: 992px) {
            .docs-wrapper { grid-template-columns: 1fr; }
            .sidebar {
                position: fixed;
                left: -100%;
                width: 280px;
                transition: var(--transition-smooth);
            }
            .sidebar.active { left: 0; }
            .content-area { padding: 40px 20px; }
            .doc-card { padding: 30px; border-radius: 16px; }
            .mobile-toggle { display: flex; }
        }
    </style>
</head>
<body>
    <div class="grid-bg"></div>

    <div class="docs-wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h4>DOCS PANEL</h4>
            </div>
            
            <nav class="nav-list">
                <?php foreach ($navItems as $item): ?>
                    <a href="docs.php?file=<?php echo $item['file']; ?>" 
                       class="nav-link <?php echo ($file === $item['file']) ? 'active' : ''; ?>">
                        <span><?php echo $item['icon']; ?></span>
                        <?php echo $item['label']; ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <a href="index.php" class="back-btn">REGRESAR</a>
        </aside>

        <main class="content-area">
            <article class="doc-card">
                <div class="markdown-body">
                    <?php echo $htmlContent; ?>
                </div>
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

        // Close sidebar when clicking a link on mobile
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