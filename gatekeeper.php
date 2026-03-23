<?php
/**
 * LC-ADVANCE Gatekeeper
 * Interstitial page to choose between Login or Guest access
 */

require_once 'config/config.php';
iniciarSesionSegura();

$redirect = $_GET['redirect'] ?? 'mapa/index.php';

// Si ya está logueado, redirigir directamente
if (isset($_SESSION['usuario_id'])) {
    redirigir($redirect);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Requerido | LC-ADVANCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        :root {
            --accent-glow: 0 0 30px rgba(0, 255, 255, 0.3);
            --card-bg: rgba(20, 20, 25, 0.8);
            --header-blur: blur(15px);
        }

        body {
            background-color: #050508;
            color: #e0e0e0;
            font-family: 'VT323', monospace;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
        }

        .grid-bg {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: 
                linear-gradient(rgba(0, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: -1;
            mask-image: radial-gradient(circle at center, black, transparent 80%);
        }

        .gatekeeper-card {
            background: var(--card-bg);
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 24px;
            padding: 60px;
            text-align: center;
            backdrop-filter: var(--header-blur);
            -webkit-backdrop-filter: var(--header-blur);
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            max-width: 500px;
            width: 90%;
            animation: fadeInUp 0.8s ease-out;
        }

        h2 {
            font-family: 'Press Start 2P', cursive;
            font-size: 18px;
            color: var(--neon-yellow);
            margin-bottom: 30px;
            line-height: 1.6;
        }

        p {
            font-size: 20px;
            margin-bottom: 40px;
            color: #aaa;
        }

        .options {
            display: flex;
            flex-direction: column;
            gap: 25px;
            margin-top: 20px;
        }

        .btn {
            padding: 22px 30px !important;
            font-family: 'Press Start 2P', cursive !important;
            font-size: 12px !important;
            border-radius: 12px !important;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            line-height: 1;
            border: none;
            position: relative;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            height: auto;
            min-height: 60px;
            box-sizing: border-box;
        }

        .btn-login {
            background: var(--neon-cyan) !important;
            color: #000 !important;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3), 4px 4px 0 #008888;
        }

        .btn-guest {
            background: transparent !important;
            border: 2px solid var(--neon-pink) !important;
            color: var(--neon-pink) !important;
            box-shadow: 0 0 10px rgba(255, 0, 255, 0.2), 4px 4px 0 rgba(255, 0, 255, 0.4);
        }

        .btn:hover {
            transform: translate(-2px, -2px);
        }

        .btn-login:hover {
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.6), 6px 6px 0 #008888;
        }

        .btn-guest:hover {
            background: rgba(255, 0, 255, 0.1) !important;
            box-shadow: 0 0 25px rgba(255, 0, 255, 0.4), 6px 6px 0 rgba(255, 0, 255, 0.6);
        }

        .btn:active {
            transform: translate(2px, 2px);
            box-shadow: none !important;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="grid-bg"></div>

    <div class="gatekeeper-card">
        <h2>IDENTIDAD REQUERIDA</h2>
        <p>Para acceder a esta sección del campus, necesitas iniciar sesión o entrar como invitado temporal.</p>
        
        <div class="options">
            <a href="login.php?redirect=<?php echo urlencode($redirect); ?>" class="btn btn-login">INICIAR SESIÓN</a>
            <a href="guest_login.php?redirect=<?php echo urlencode($redirect); ?>" class="btn btn-guest">ACCESO INVITADO</a>
            <a href="index.php" style="margin-top: 20px; color: #666; text-decoration: none; font-size: 14px;">VOLVER AL INICIO</a>
        </div>
    </div>
</body>
</html>