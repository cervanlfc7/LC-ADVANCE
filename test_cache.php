<?php
require_once 'config/config.php';
try {
    $lessons = obtenerLecciones();
    $por_materia = obtenerLeccionesPorMateria();
    echo "OK\n";
    echo "Total lecciones: " . count($lessons) . "\n";
    echo "Materias: " . count($por_materia) . "\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}