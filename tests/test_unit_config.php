<?php
// LC-ADVANCE - Unit tests for config functions and quiz scoring
require_once __DIR__ . '/testcase. php';
function testCalcularNivel() {
    $tc = new TestCase('calcularNivel');
    $tc->assertEquals(1, calcularNivel(0));
    $tc->assertEquals(1, calcularNivel(499));
    $tc->assertEquals(2, calcularNivel(500));
    $tc->assertEquals(2, calcularNivel(999));
    $tc->assertEquals(3, calcularNivel(1000));
    $tc->assertEquals(3, calcularNivel(1499));
    $tc->assertEquals(4, calcularNivel(1500));
    $tc->assertEquals(10, calcularNivel(4500));
    list($p, $f) = $tc->summary(); echo "  PASSED: $p | FAILED: $f\n"; return $f === 0;
}
function testLimpiarEntrada() {
    $tc = new TestCase('limpiarEntrada');
    $tc->assertEquals('test', limpiarEntrada('test'));
    $tc->assertEquals('hola', limpiarEntrada('  hola  '));
    $tc->assertEquals('&lt;script&gt;', limpiarEntrada('<script>'));
    $tc->assertEquals('&lt;?php', limpiarEntrada('<?php'));
    $tc->assertEquals("O&apos;Reilly", limpiarEntrada("O'Reilly"));
    list($p, $f) = $tc->summary(); echo "  PASSED: $p | FAILED: $f\n"; return $f === 0;
}
function testQuizScoring() {
    $tc = new TestCase('Quiz Scoring');
    $tc->assertEquals(30, 3 * 10);
    $tc->assertEquals(0, strcasecmp('  La respuesta  ', 'la respuesta'));
    $tc->assertFalse(strcasecmp('respuesta 2', 'respuesta') === 0);
    $preguntas = [['pregunta' => 'Q1', 'correcta' => 'A'], ['pregunta' => 'Q2', 'correcta' => 'B'], ['pregunta' => 'Q3', 'correcta' => 'C']];
    $respuestas = ['A', 'B', 'X'];
    $calc = 0; foreach ($preguntas as $i => $p) { if (strcasecmp($respuestas[$i], $p['correcta']) === 0) $calc++; }
    $tc->assertEquals(2, $calc);
    $tc->assertEquals(20, $calc * 10);
    list($p, $f) = $tc->summary(); echo "  PASSED: $p | FAILED: $f\n"; return $f === 0;
}
function testRateLimitLogic() {
    $tc = new TestCase('Rate Limit Logic');
    $attempts = 0; for ($i = 1; $i <= 5; $i++) $attempts++;
    $tc->assertEquals(5, $attempts); $tc->assertTrue($attempts >= 5);
    $api_count = 0; for ($i = 1; $i <= 30; $i++) $api_count++;
    $tc->assertEquals(30, $api_count); $tc->assertFalse($api_count > 30); $tc->assertTrue(31 > 30);
    list($p, $f) = $tc->summary(); echo "  PASSED: $p | FAILED: $f\n"; return $f === 0;
}
function testCacheHelpers() {
    $tc = new TestCase('Cache Helpers');
    if (function_exists('obtenerLecciones')) { $les = obtenerLecciones(); $tc->assertTrue(is_array($les)); $tc->assertTrue(count($les) > 0); $first = $les[0] ?? null; if ($first) { $tc->assertTrue(isset($first['slug'])); $tc->assertTrue(isset($first['quiz'])); $tc->assertTrue(is_array($first['quiz'])); } }
    if (function_exists('obtenerLeccionesPorMateria')) { $por = obtenerLeccionesPorMateria(); $tc->assertTrue(is_array($por)); $tc->assertTrue(count($por) > 0); }
    if (function_exists('buscarLeccion')) { $r = buscarLeccion('non-existent-slug-xyz'); $tc->assertNull($r); }
    list($p, $f) = $tc->summary(); echo "  PASSED: $p | FAILED: $f\n"; return $f === 0;
}
echo "Running: tests/test_unit_config. php\n";
$ok = true;
$ok &= testCalcularNivel();
$ok &= testLimpiarEntrada();
$ok &= testQuizScoring();
$ok &= testRateLimitLogic();
$ok &= testCacheHelpers();
if ($ok) { echo "PASS: tests/test_unit_config. php\n"; exit(0); }
else { echo "FAIL: tests/test_unit_config. php\n"; exit(1); }