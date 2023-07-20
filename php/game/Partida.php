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

    // Save partida data to the database
    public function saveToDatabase($conn)
    {
        $sql_insertar_partida = "INSERT INTO partidas (Cod_User, Nombre, Nivel, Ubicacion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insertar_partida);
        $stmt->bind_param("issi", $this->codigoId, $this->nombre, $this->nivel, $this->ubicacion);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
