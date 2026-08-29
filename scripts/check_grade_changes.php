<?php
require_once __DIR__ . '/../src/Config/config.php';

try {
    $sql = "SELECT id, grupo_id, user_id, slug, old_score, new_score, changed_by, note, changed_at FROM grade_changes ORDER BY changed_at DESC LIMIT 20";
    $stmt = $pdo->query($sql);
    if ($stmt === false) {
        $err = $pdo->errorInfo();
        echo "Consulta fallida: " . ($err[2] ?? json_encode($err)) . "\n";
        // show table structure
        try {
            $cols = $pdo->query('DESCRIBE grade_changes')->fetchAll(PDO::FETCH_ASSOC);
            echo "Estructura de grade_changes:\n";
            foreach ($cols as $c) {
                echo " - {$c['Field']} {$c['Type']}" . (isset($c['Null']) ? ($c['Null']=='NO' ? ' NOT NULL' : ' NULL') : '') . "\n";
            }
        } catch (Exception $e) {
            echo "No se pudo obtener estructura: " . $e->getMessage() . "\n";
        }
        exit(1);
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($rows)) {
        echo "No hay registros en grade_changes.\n";
        exit(0);
    }
    echo str_pad('id',6) . str_pad('grupo',8) . str_pad('user',8) . str_pad('slug',30) . str_pad('old',6) . str_pad('new',6) . str_pad('by',6) . str_pad('changed_at',22) . " note\n";
    echo str_repeat('-', 100) . "\n";
    foreach ($rows as $r) {
        printf("%6d%8d%8d%-30s%6s%6s%6d%22s %s\n",
            $r['id'], $r['grupo_id'], $r['user_id'], substr($r['slug'],0,30), is_null($r['old_score'])?'-':$r['old_score'], is_null($r['new_score'])?'-':$r['new_score'], $r['changed_by'], $r['changed_at'], $r['note'] ?? '');
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
