<?php
// ================================================
// LC-ADVANCE - Minification Script
// Minifica JS y CSS usando herramientas nativas.
// Requiere Node.js para UglifyJS y cssnano.
// Fallback: minificación básica en PHP.
// ================================================

$publicDir = __DIR__ . '/../public';

$files = [
    // JS files to minify
    'assets/js/app.js' => 'assets/js/app.min.js',
    'assets/js/lab.js' => 'assets/js/lab.min.js',
    'assets/js/loader.js' => 'assets/js/loader.min.js',
    'assets/js/volume_control.js' => 'assets/js/volume_control.min.js',
//    'assets/js/audio_system_fixed.js' => 'assets/js/audio_system_fixed.min.js',
//    'assets/js/genero.js' => 'assets/js/genero.min.js',

    // CSS files to minify
    'assets/css/dashboard.css' => 'assets/css/dashboard.min.css',
    'assets/css/style.css' => 'assets/css/style.min.css',
];

function minifyJS($code) {
    // Remove single-line comments
    $code = preg_replace('#//[^\n]*#', '', $code);
    // Remove multi-line comments
    $code = preg_replace('#/\*[\s\S]*?\*/#', '', $code);
    // Remove whitespace around operators
    $code = preg_replace('/\s*([{}();,:<>=+\-*\/&|!~%])\s*/', '$1', $code);
    // Collapse multiple spaces
    $code = preg_replace('/\s+/', ' ', $code);
    // Remove spaces before/after brackets in control structures
    $code = preg_replace('/\s*([{\(\)}])\s*/', '$1', $code);
    // Trim
    return trim($code);
}

function minifyCSS($code) {
    // Remove comments
    $code = preg_replace('#/\*[\s\S]*?\*/#', '', $code);
    // Remove whitespace around : ; , { }
    $code = preg_replace('/\s*([{}:;,])\s*/', '$1', $code);
    // Remove last semicolon in blocks
    $code = preg_replace('/;}/', '}', $code);
    // Collapse multiple spaces
    $code = preg_replace('/\s+/', ' ', $code);
    // Remove leading/trailing whitespace
    $code = preg_replace('/^\s+|\s+$/m', '', $code);
    return trim($code);
}

// Check if UglifyJS is available
$hasUglify = false;
$hasCleanCSS = false;
exec('npx uglifyjs --version 2>&1', $outUglify, $codeUglify);
if ($codeUglify === 0) $hasUglify = true;

exec('npx cleancss --version 2>&1', $outClean, $codeClean);
if ($codeClean === 0) $hasCleanCSS = true;

$count = 0;
$errors = 0;

foreach ($files as $source => $dest) {
    $sourcePath = $publicDir . '/' . $source;
    $destPath = $publicDir . '/' . $dest;

    if (!file_exists($sourcePath)) {
        echo "⚠️  SKIP: $source (not found)\n";
        continue;
    }

    $original = file_get_contents($sourcePath);
    $origSize = strlen($original);

    if (preg_match('/\.js$/', $source) && $hasUglify) {
        $tmpFile = tempnam(sys_get_temp_dir(), 'lcmin');
        file_put_contents($tmpFile, $original);
        exec("npx uglifyjs \"$tmpFile\" --compress --mangle -o \"$destPath\" 2>&1", $output, $code);
        unlink($tmpFile);
        if ($code !== 0) {
            echo "❌ UglifyJS failed on $source, falling back to PHP\n";
            $minified = minifyJS($original);
            file_put_contents($destPath, $minified);
        }
    } elseif (preg_match('/\.css$/', $source) && $hasCleanCSS) {
        $tmpFile = tempnam(sys_get_temp_dir(), 'lcmin');
        file_put_contents($tmpFile, $original);
        exec("npx cleancss -o \"$destPath\" \"$tmpFile\" 2>&1", $output, $code);
        unlink($tmpFile);
        if ($code !== 0) {
            echo "❌ CleanCSS failed on $source, falling back to PHP\n";
            $minified = minifyCSS($original);
            file_put_contents($destPath, $minified);
        }
    } else {
        // PHP fallback
        $minified = preg_match('/\.js$/', $source) ? minifyJS($original) : minifyCSS($original);
        file_put_contents($destPath, $minified);
    }

    $newSize = filesize($destPath);
    $saved = $origSize - $newSize;
    $pct = $origSize > 0 ? round(100 * $saved / $origSize) : 0;
    echo "   $source: {$origSize}B → {$newSize}B ({$pct}% saved)" . ($hasUglify && preg_match('/\.js$/', $source) ? ' [uglify]' : '') . "\n";
    $count++;
}

echo "\n✅ Done. $count files minified." . ($errors ? " ($errors errors)" : '') . "\n";
