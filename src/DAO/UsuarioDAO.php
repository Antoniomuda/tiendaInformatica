<?php

namespace App\DAO;

use App\Conexion;
use App\Modelo\Usuario;
use PDO;
use PDOException;

class UsuarioDAO{
    
    private PDO $bd;
    
    public function __construct(){
        
        $this->bd = Conexion::getConexion();
        
    }
    
    public function recuperaPorCredenciales(string $usuario, string $pass): ?Usuario{
      
        
        $sql = "select * from usuarios where usuario=:usuario and pass=:pass;";
        try{
            
            $stmt = $this->bd->prepare($sql);
      
            $stmt->execute([
                ':usuario'=>$usuario,
                ':pass'=>$pass
            ]);
            
     
           $stmt->setFetchMode(PDO::FETCH_CLASS, Usuario::class);
           $resultado = $stmt->fetch();
           $stmt = null;
           return ($resultado ===false) ?null : $resultado;
           
        } catch (PDOException $ex) {
            echo "Error buscando al usuario " . $ex->getMessage();

        }
    }
    
    
    
    
}

   

