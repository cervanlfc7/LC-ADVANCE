<?php
include __DIR__ . '/../src/content.php';
// Simular estado: sin materia GET, con profesor GET
$_GET['profesor'] = 'Herson';

// Agrupar lecciones
$lecciones_agrupadas = [];
$materias_disponibles = [];
foreach ($lecciones as $l) {
    $m = $l['materia'] ?? 'Sin Materia';
    $materias_disponibles[] = $m;
    $lecciones_agrupadas[$m][] = $l;
}
$materias_disponibles = array_unique($materias_disponibles);

// filtros
$filter_materia = isset($_GET['materia']) ? trim($_GET['materia']) : null;
$filter_profesor = empty($filter_materia) && isset($_GET['profesor']) ? trim($_GET['profesor']) : null;
$filter_materias = [];
$highlight_materia = null;

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
function norm($s){
    return mb_strtolower(trim(strtr($s,[
        'á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','ñ'=>'n','&'=>'y'
    ])), 'UTF-8');
}

if ($filter_materia) {
    $filter_materias[] = $filter_materia;
    $highlight_materia = $filter_materia;
} elseif ($filter_profesor) {
    $nf = norm($filter_profesor);
    foreach ($profesor_materia_map as $prof => $mats) {
        $np = norm($prof);
        if ($np === $nf || strpos($np, $nf) !== false || strpos($nf, $np) !== false) {
            foreach ($mats as $mat) {
                foreach ($materias_disponibles as $real) {
                    if (norm($real) === norm($mat) || str_contains(norm($real), norm($mat))) {
                        $filter_materias[] = $real;
                    }
                }
            }
            break;
        }
    }
    $filter_materias = array_unique($filter_materias);
    $highlight_materia = $filter_materias[0] ?? null;
}

if ($filter_materias) {
    $lecciones_agrupadas = array_filter(
        $lecciones_agrupadas,
        fn($k)=> in_array(norm($k), array_map('norm',$filter_materias)),
        ARRAY_FILTER_USE_KEY
    );
}

echo "Filter materias: \n";
print_r($filter_materias);

echo "\nLecciones agrupadas (keys):\n";
print_r(array_keys($lecciones_agrupadas));

// Also check scenario when arriving via leccion return with ?materia=Fisica I&profesor=Herson
$_GET['materia'] = 'Física I';
$filter_materia = isset($_GET['materia']) ? trim($_GET['materia']) : null;
$filter_profesor = empty($filter_materia) && isset($_GET['profesor']) ? trim($_GET['profesor']) : null;
$filter_materias = [];
if ($filter_materia) {
    $filter_materias[] = $filter_materia;
}
$lecciones_agrupadas2 = [];
foreach ($lecciones as $l) {
    $m = $l['materia'] ?? 'Sin Materia';
    $lecciones_agrupadas2[$m][] = $l;
}
if ($filter_materias) {
    $lecciones_agrupadas2 = array_filter(
        $lecciones_agrupadas2,
        fn($k) => in_array(norm($k), array_map('norm',$filter_materias)),
        ARRAY_FILTER_USE_KEY
    );
}

echo "\nCon ?materia=Física I las keys:\n";
print_r(array_keys($lecciones_agrupadas2));
