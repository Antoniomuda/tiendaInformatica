<?php

/**
 * Description of Producto
 *
 * @author murillodavilaantonio
 */

namespace App\Modelo;

class Producto {

    private int $id;
    private string $nombre;
    private string $nombre_corto;
    private string $descripcion;
    private float $pvp;
    private string $familia;

    
    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getNombre_corto(): string {
        return $this->nombre_corto;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function getPvp(): float {
        return $this->pvp;
    }

    public function getFamilia(): string {
        return $this->familia;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setNombre_corto(string $nombre_corto): void {
        $this->nombre_corto = $nombre_corto;
    }

    public function setDescripcion(string $descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function setPvp(float $pvp): void {
        $this->pvp = $pvp;
    }

    public function setFamilia(string $familia): void {
        $this->familia = $familia;
    }


}
