<?php
include __DIR__ . '/../src/content.php';
$materias_disponibles=[];
foreach($lecciones as $l){ $m = $l['materia'] ?? 'Sin Materia'; $materias_disponibles[] = $m; }
$materias_disponibles = array_unique($materias_disponibles);
$profesor_materia_map = [
    'Miguel Marquez' => ['Temas Selectos de Matemáticas I y II'],
    'Enrique' => ['Inglés'],
    'Espindola' => ['Pensamiento Matemático III'],
    'Manuel' => ['Programación'],
    'Meza' => ['Programación'],
    'Herson' => ['Física','Química'],
    'Carolina' => ['Ecosistemas'],
    'Refugio & Padilla' => ['Ciencias Sociales'],
    'Armando' => ['Historia']
];
function normphp($s){ return mb_strtolower(trim(strtr($s, ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n','&'=>'y'])), 'UTF-8'); }
$nf = normphp('Herson');
$matches = [];
foreach($profesor_materia_map as $prof => $mats){
    $np = normphp($prof);
    if ($np === $nf || strpos($np, $nf) !== false || strpos($nf, $np) !== false) {
        foreach ($mats as $mat) {
            foreach ($materias_disponibles as $real) {
                if (normphp($real) === normphp($mat) || strpos(normphp($real), normphp($mat)) !== false) {
                    $matches[] = $real;
                }
            }
        }
        break;
    }
}
$matches = array_unique($matches);
echo "Materias mapeadas para Herson:\n";
foreach ($matches as $m) echo " - $m\n";

// Mostrar si 'Física' existe realmente en el listado de materias
$existsFisica = false;
foreach ($materias_disponibles as $m) if (strpos(normphp($m), normphp('Fisica')) !== false) $existsFisica = true;
echo "\n¿Existe Física en el listado de materias? " . ($existsFisica ? 'SÍ' : 'NO') . "\n";

// Mostrar ejemplo de materias disponibles (limitadas a 50)
echo "\nLista parcial de materias disponibles:\n";
$cnt=0; foreach ($materias_disponibles as $m){ echo " - $m\n"; if (++$cnt>50) break; }
