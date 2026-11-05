<?php

/**
 * Description of VotosDAO
 *
 * @author murillodavilaantonio
 */

namespace App\DAO;

use App\Conexion;
use PDO;
use PDOException;


class VotosDAO {

    private PDO $bd;

    public function __construct() {
        $this->bd = Conexion::getConexion();
    }

    public function yaVoto(int $idProducto, string $usuario): bool {
        $sql = "select * from votos where idPr=:idProducto and idUs =:usuario;";

        try {
            $stmt = $this->bd->prepare($sql);
            $stmt->execute([
                ':idProducto' => $idProducto,
                ':usuario' => $usuario
            ]);
            $yaVoto = $stmt->fetch();
            $stmt = null;
            return $yaVoto !== false;
        } catch (PDOException $ex) {
            echo "Error mostrando votos " . $ex->getMessage();
        }
    }

    public function guardarVoto(int $idProducto, string $usuario, int $voto): void {
        $sql = "insert into votos (cantidad, idPr, idUs)values(:cantidad, :idPr, :idUs);";

        try {
            $stmt = $this->bd->prepare($sql);
            $stmt->execute([
                ':cantidad' => $voto,
                ':idPr' => $idProducto,
                ':idUs' => $usuario
            ]);
            
        } catch (PDOException $ex) {
            
            echo "Error mostrando la media de votos " . $ex->getMessage();
            
        }
    }

    public function recuperaMediaVotos(int $idProducto): float {
        $sql = "select avg(cantidad) as media from votos where idPr=:idProducto;";

        try {
            
            $stmt = $this->bd->prepare($sql);
            $stmt->execute([
                ':idProducto' => $idProducto
            ]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = null;
            
            return $resultado ? (float) $resultado['media'] : 0.0;
            
        } catch (PDOException $ex) {
            
            echo "Error recuperando la media de votos del producto " . $ex->getMessage();
            
        }
    }

    public function contarVotos(int $idProducto): int {
        $sql = "select count(*) as total from votos where idPr=:idProducto;";

        try {
            $stmt = $this->bd->prepare($sql);
            $stmt->execute([
                ':idProducto' => $idProducto
            ]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = null;

            return (int) $resultado['total'];
            
        } catch (PDOException $ex) {
            
            echo "Error contanto votos: " . $ex->getMessage();
            return 0;
            
        }
    }
}
