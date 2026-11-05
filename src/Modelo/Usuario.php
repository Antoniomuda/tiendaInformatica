<?php
namespace App\Modelo;

/**
 * Description of Usuario
 *
 * @author murillodavilaantonio
 */



class Usuario {

    private string $usuario;
    
    private string $pass;
    
  
    
    public function getUsuario(): string{
        return $this->usuario;
    }
    
    public function setUsuario($usuario): void{
        $this->usuario=$usuario;
        
    }
    
    public function getPass(): string{
        return $this->pass;
    }
    
    public function setPass($pass): void{
        $this->pass=$pass;
    }
    
}
