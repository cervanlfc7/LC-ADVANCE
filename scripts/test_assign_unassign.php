<?php
require_once __DIR__ . '/../src/Config/config.php';
require_once __DIR__ . '/../src/Core/panel_docente.php';

// Use a test user: create or reuse an existing teacher user id
// For safety, do not modify real production users. This script assumes a teacher with id=1 exists.
$profesor_id = 1;

echo "Starting assign/unassign test as profesor_id={$profesor_id}\n";

$lessons = obtenerLecciones();
if (empty($lessons)) {
    echo "No lessons available to assign.\n";
    exit(1);
}
$slug = $lessons[0]['slug'];
echo "Using lesson slug: {$slug}\n";

// Create a temporary group
$nombre = 'TEST_GROUP_' . time();
$g = crearGrupo($profesor_id, $nombre);
$gid = $g['id'];
echo "Created group id={$gid} name={$nombre}\n";

// Assign lesson
$ok = asignarLeccionAGrupo($gid, $slug, $profesor_id);
if ($ok) {
    echo "Assigned lesson {$slug} to group {$gid} — OK\n";
} else {
    echo "Failed to assign lesson {$slug} to group {$gid}\n";
}

// Verify DB row
$stmt = $pdo->prepare('SELECT COUNT(*) FROM group_lecciones WHERE grupo_id = ? AND slug = ?');
$stmt->execute([$gid, $slug]);
$count = (int)$stmt->fetchColumn();
echo "Rows in group_lecciones for this assignment: {$count}\n";

// Now remove
$removed = removerLeccionAsignadaGrupo($gid, $slug, $profesor_id);
echo $removed ? "Removed assignment — OK\n" : "Failed to remove assignment\n";

$stmt = $pdo->prepare('SELECT COUNT(*) FROM group_lecciones WHERE grupo_id = ? AND slug = ?');
$stmt->execute([$gid, $slug]);
$count2 = (int)$stmt->fetchColumn();
echo "Rows after removal: {$count2}\n";

// Cleanup: delete group
$del = eliminarGrupo($gid, $profesor_id);
echo $del ? "Deleted test group {$gid}\n" : "Failed to delete test group {$gid}\n";

echo "Done.\n";
