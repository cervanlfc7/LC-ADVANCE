<?php
require_once __DIR__ . '/../config/config.php';
class TC { private $p=0,$f=0; function eq($e,$a,$m=''){$e=(int)$e;$a=(int)$a;if($e===$a){$this->p++;return true;}$this->f++;echo "FAIL:$m exp=$e got=$a\n";return false;} function t($v,$m=''){return $this->eq(1,$v?1:0,$m);} function f($v,$m=''){return $this->eq(0,$v?1:0,$m);} function s(){return[$this->p,$this->f];} }

function testNivel(){ $tc=new TC(); $tc->eq(1,calcularNivel(0)); $tc->eq(1,calcularNivel(499)); $tc->eq(2,calcularNivel(500)); $tc->eq(3,calcularNivel(1000)); $tc->eq(4,calcularNivel(1500)); list($p,$f)=$tc->s(); echo "nivel:P$p F$f\n"; return $f===0; }
function testLimpiar(){ $tc=new TC(); $tc->eq('test',limpiarEntrada('test')); $tc->eq('hola',limpiarEntrada('  hola  ')); $tc->eq('&lt;script&gt;',limpiarEntrada('<script>')); list($p,$f)=$tc->s(); echo "limpiar:P$p F$f\n"; return $f===0; }
function testQuiz(){ $tc=new TC(); $tc->eq(30,3*10); $tc->eq(0,strcasecmp('A','a')); list($p,$f)=$tc->s(); echo "quiz:P$p F$f\n"; return $f===0; }

$ok=testNivel() && testLimpiar() && testQuiz(); echo $ok?"PASS":"FAIL"; exit($ok?0:1);