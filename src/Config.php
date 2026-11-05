<?php

/**
 * Description of Config
 *
 * @author murillodavilaantonio
 */

namespace App;

class Config {


    public static function cargar(string $ruta): void {
        
        $lineas = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lineas as $linea) {
            
            if (strpos($linea, '=') !== false && strpos($linea, '#') !== 0) {
                
                [$clave, $valor] = explode('=', $linea, 2);
                
                $_ENV[trim($clave)] = trim($valor);
            }
        }
    }
}

