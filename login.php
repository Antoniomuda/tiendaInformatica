<?php

require 'vendor/autoload.php';

use eftec\bladeone\BladeOne;
use App\Modelo\Usuario;
use App\Conexion;
use App\DAO\UsuarioDAO;

session_save_path('/Applications/XAMPP/xamppfiles/temp');
session_start();

$views = __DIR__ . '/views';
$cache = __DIR__ . '/views/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);

$usuario = $_SESSION['usuario'] ?? null;

if (filter_has_var(INPUT_POST, 'aceptar')) {
    $nombreUsuario = trim(filter_input(INPUT_POST, 'usuario', FILTER_UNSAFE_RAW));
    $pass = trim(filter_input(INPUT_POST, 'pass', FILTER_UNSAFE_RAW));

    $errores = [];

    if (empty($nombreUsuario)) {
        $errores['usuario'] = 'El nombre de usuario es obligatorio.';
    }
    if (empty($pass)) {
        $errores['pass'] = 'La contraseña es obligatoria.';
    }

    if (empty($errores)) {
        $passHash = hash('sha256', $pass);
        $usuarioDAO = new UsuarioDAO();
        $usuarioBD = $usuarioDAO->recuperaPorCredenciales($nombreUsuario, $passHash);
        $valid = !is_null($usuarioBD);
        if ($valid) {
            $_SESSION['usuario'] = $usuarioBD;
        }
        header('Content-Type: application/json');
        echo json_encode(['login' => $valid, 'errores' => []]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['login' => false, 'errores' => $errores]);
    }
    exit();
}

echo $blade->run('login', compact('usuario'));
