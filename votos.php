<?php

require 'vendor/autoload.php';

use App\DAO\VotosDAO;
use App\PintarEstrellas;
use App\Modelo\Usuario;

session_save_path('/Applications/XAMPP/xamppfiles/temp');
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Content-Type: application/json');
    exit();
}

$idProducto = filter_input(INPUT_POST, 'idProducto', FILTER_SANITIZE_NUMBER_INT);
$voto = filter_input(INPUT_POST, 'voto', FILTER_SANITIZE_NUMBER_INT);
$usuario = $_SESSION['usuario']->getUsuario();

$votosDAO = new VotosDAO();
header('Content-Type: application/json');

if ($votosDAO->yaVoto($idProducto, $usuario)) {

    echo json_encode(['error' => 'Ya has votado este producto.']);
    exit();
}

$votosDAO->guardarVoto($idProducto, $usuario, $voto);
$media = $votosDAO->recuperaMediaVotos($idProducto);
$total = $votosDAO->contarVotos($idProducto);
$estrellas = $total . ' ' . ($total === 1 ? 'Valoración' : 'Valoraciones') . ' ' . PintarEstrellas::render($media);

echo json_encode([
    'media' => $media,
    'estrellas' => $estrellas,
    'mensaje' => 'Voto registrado'
]);
