<?php

namespace App;
use PDO;


class Conexion {
    private static ?PDO $bd = null;

    public static function getConexion(): PDO {
        if (!self::$bd) {
            Config::cargar(__DIR__ . '/../.env');
            self::$bd = new PDO(
                'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=' . $_ENV['DB_CHARSET'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS']
            );
            self::$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$bd;
    }
}