<?php

class Partida
{
    private $codigoId;
    private $nombre;
    private $nivel;
    private $ubicacion;

    public function __construct($codigoId, $nombre, $nivel, $ubicacion)
    {
        $this->codigoId = $codigoId;
        $this->nombre = $nombre;
        $this->nivel = $nivel;
        $this->ubicacion = $ubicacion;
    }

    // Getters and Setters
    // ...

    
}
