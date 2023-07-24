<?php
// Habilitar la visualización de todos los errores
error_reporting(E_ALL);

// Include the database connection file
include("../sesion/conexion.php");

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the POST request
    $codigoId = $_POST['Cod_User'] ?? '';
    $personajeJSON = $_POST['Personaje'] ?? '';
    $partidaJSON = $_POST['Partida'] ?? '';

    // Validate the data (you may add further validation here if needed)

    // Decode the JSON data into PHP arrays
    $personaje = json_decode($personajeJSON, true);
    $partida = json_decode($partidaJSON, true);

    // Check if there's a row with the same ID in the "partidas" table
    $queryPartida = "SELECT * FROM partidas WHERE Cod_User = $codigoId";
    $resultPartida = mysqli_query($conn, $queryPartida);

    if (mysqli_num_rows($resultPartida) > 0) {
        // "ALTER TABLE" to update the existing row
        $queryUpdatePartida = "UPDATE partidas SET 
                                Nombre = '{$partida['Nombre']}', 
                                Nivel = '{$partida['Nivel']}', 
                                Ubicacion = '{$partida['Ubicacion']}' 
                                WHERE ID = $codigoId";
        
        mysqli_query($conn, $queryUpdatePartida);
    } else {
        // "INSERT INTO" to add a new row
        $queryInsertPartida = "INSERT INTO partidas (Cod_User, Nombre, Nivel, Ubicacion) VALUES ('$codigoId', '{$partida['Nombre']}', '{$partida['Nivel']}', '{$partida['Ubicacion']}')";
        
        mysqli_query($conn, $queryInsertPartida);
    }

    // Check if there's a row with the same ID in the "personaje" table
    $queryPersonaje = "SELECT * FROM personaje WHERE ID = $codigoId";
    $resultPersonaje = mysqli_query($conn, $queryPersonaje);

    if (mysqli_num_rows($resultPersonaje) > 0) {
        //"UPDATE" to update the existing row
        $queryUpdatePersonaje = "UPDATE personaje SET 
                                 Nombre = '{$personaje['nombre']}',
                                 Clase = '{$personaje['clase']}',
                                 Nivel = '{$personaje['nivel']}',
                                 Fuerza_Basic = '{$personaje['fuerza_basic']}',
                                 Resistencia_Basic = '{$personaje['resistencia_basic']}',
                                 Destreza_Basic = '{$personaje['destreza_basic']}',
                                 Magia_Basic = '{$personaje['magia_basic']}',
                                 Fuerza_Bonif = '{$personaje['fuerza_bonif']}',
                                 Resistencia_Bonif = '{$personaje['resistencia_bonif']}',
                                 Destreza_Bonif = '{$personaje['destreza_bonif']}',
                                 Magia_Bonif = '{$personaje['magia_bonif']}',
                                 Stat_Point = '{$personaje['stat_point']}',
                                 HP_actual = '{$personaje['HP_actual']}',
                                 MP_actual = '{$personaje['MP_actual']}'
                                 WHERE ID = $codigoId";
    
        mysqli_query($conn, $queryUpdatePersonaje);
    } else {
        //"INSERT INTO" to add a new row
        $queryInsertPersonaje = "INSERT INTO personaje (Cod_User, Nombre, Clase, Nivel, Fuerza_Basic, Resistencia_Basic, Destreza_Basic, Magia_Basic, Fuerza_Bonif, Resistencia_Bonif, Destreza_Bonif, Magia_Bonif, Stat_Point, HP_actual, MP_actual) 
                                VALUES ('$codigoId', '{$personaje['nombre']}', '{$personaje['clase']}', '{$personaje['nivel']}', '{$personaje['fuerza_basic']}', '{$personaje['resistencia_basic']}', '{$personaje['destreza_basic']}', '{$personaje['magia_basic']}', '{$personaje['fuerza_bonif']}', '{$personaje['resistencia_bonif']}', '{$personaje['destreza_bonif']}', '{$personaje['magia_bonif']}', '{$personaje['stat_point']}', '{$personaje['HP_actual']}', '{$personaje['MP_actual']}')";
    
        mysqli_query($conn, $queryInsertPersonaje);
    }
}
?>
