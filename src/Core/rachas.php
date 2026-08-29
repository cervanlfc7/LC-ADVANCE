<?php

function actualizarRacha($usuario_id, $pdo) {
    $hoy = date('Y-m-d');
    $ayer = date('Y-m-d', strtotime('-1 day'));

    $stmt = $pdo->prepare("SELECT ultimo_login, racha_actual FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $row = $stmt->fetch();
    if (!$row) return;

    $ultimo = $row['ultimo_login'];
    $racha = (int)$row['racha_actual'];

    if ($ultimo === $hoy) return;

    if ($ultimo === $ayer || $ultimo === null) {
        $racha++;
    } else {
        $protectores = (int)$pdo->query("SELECT protectores_racha FROM usuarios WHERE id = $usuario_id")->fetchColumn();
        if ($protectores > 0) {
            $pdo->prepare("UPDATE usuarios SET protectores_racha = protectores_racha - 1 WHERE id = ?")->execute([$usuario_id]);
            $racha++;
            if (function_exists('crearNotificacion')) {
                crearNotificacion($usuario_id, "🛡️ Protector usado", "Has usado un protector de racha.", $pdo);
            }
        } else {
            $racha = 1;
        }
    }

    $bonus_xp = 0;
    $hit = null;
    if (in_array($racha, [3, 7, 14, 21, 30, 60, 90, 365])) {
        $bonus_xp = $racha * 10;
        $hit = $racha;
    }

    _otorgarProtectoresAuto($usuario_id, $pdo);

    $stmt = $pdo->prepare("UPDATE usuarios SET ultimo_login = ?, racha_actual = ?, puntos = puntos + ? WHERE id = ?");
    $stmt->execute([$hoy, $racha, $bonus_xp, $usuario_id]);

    if ($bonus_xp > 0 && function_exists('crearNotificacion')) {
        crearNotificacion($usuario_id, "🔥 Racha de $racha d&iacute;as", "¡Has iniciado sesi&oacute;n $racha d&iacute;as consecutivos! +$bonus_xp XP", $pdo);
    }

    return [
        'racha' => $racha,
        'bonus_xp' => $bonus_xp,
        'hit' => $hit,
    ];
}

function _otorgarProtectoresAuto($usuario_id, $pdo) {
    $stmt = $pdo->prepare("SELECT protectores_racha, puntos, racha_actual FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $u = $stmt->fetch();
    if (!$u) return;

    $condiciones = [
        ['min_puntos' => 500,  'min_racha' => 7,  'max' => 1],
        ['min_puntos' => 1500, 'min_racha' => 14, 'max' => 2],
        ['min_puntos' => 3000, 'min_racha' => 30, 'max' => 3],
    ];
    $actuales = (int)$u['protectores_racha'];
    $debe_tener = 0;
    foreach ($condiciones as $c) {
        if ((int)$u['puntos'] >= $c['min_puntos'] && (int)$u['racha_actual'] >= $c['min_racha']) {
            $debe_tener = max($debe_tener, $c['max']);
        }
    }
    if ($debe_tener > $actuales) {
        $pdo->prepare("UPDATE usuarios SET protectores_racha = ? WHERE id = ?")->execute([$debe_tener, $usuario_id]);
        if (function_exists('crearNotificacion')) {
            crearNotificacion($usuario_id, "🛡️ Protector de racha", "Has recibido $debe_tener protectores de racha por tu progreso!", $pdo);
        }
    }
}

function obtenerRacha($usuario_id, $pdo) {
    $stmt = $pdo->prepare("SELECT ultimo_login, racha_actual FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $row = $stmt->fetch();
    if (!$row) return ['racha' => 0, 'hoy' => false];

    $hoy = date('Y-m-d');
    $activo_hoy = $row['ultimo_login'] === $hoy;

    return [
        'racha' => (int)$row['racha_actual'],
        'hoy' => $activo_hoy,
    ];
}
