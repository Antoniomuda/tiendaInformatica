<?php

require 'vendor/autoload.php';

use eftec\bladeone\BladeOne;
use App\Modelo\Usuario;
use App\PintarEstrellas;
use App\DAO\ProductoDAO;
use App\DAO\VotosDAO;

session_save_path('/Applications/XAMPP/xamppfiles/temp');
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
$usuario = $_SESSION['usuario'];
$productoDAO = new ProductoDAO();
$votosDAO = new VotosDAO();
$productos = $productoDAO->recuperarTodo();

$views = __DIR__ . '/views';
$cache = __DIR__ . '/views/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);

echo $blade->run('productos', compact('usuario', 'productos', 'votosDAO'));

