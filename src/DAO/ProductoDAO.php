<?php

namespace App\DAO;


use App\Conexion;
use App\Modelo\Producto;
use PDO;
use PDOException;


class ProductoDAO {

    private PDO $bd;

    public function __construct() {
        $this->bd = Conexion::getConexion();
    }

    public function recuperarTodo(): array {

        $sql = "select * from productos;";

        try {
            $stmt = $this->bd->prepare($sql);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Producto::class);
            $productos = $stmt->fetchAll();
            $stmt = null;
            return $productos;
            
        } catch (PDOException $ex) {
            echo "Error recuperando todos los productos de la base de datos " . $ex->getMessage();
        }
    }

  

    public function recuperaPorFamilia(): array {
        $sql = "select cod from familias;";

        try {

            $stmt = $this->bd->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_COLUMN);
            $familias = $stmt->fetchAll();
            $stmt = null;
            return $familias;
            
        } catch (PDOException $ex) {
            echo "Error recuperando la familia de los productos " . $ex->getMessage();
        }
    }
}
