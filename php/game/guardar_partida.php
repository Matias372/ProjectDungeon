<?php
// Habilitar la visualización de todos los errores
error_reporting(E_ALL);

// Include the database connection file
include("../sesion/conexion.php");

$response = array();

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the POST request
    $codigoId = isset($_POST['Cod_User']) ? $_POST['Cod_User'] : '';
    $personajeJSON = isset($_POST['Personaje']) ? $_POST['Personaje'] : '';
    $partidaJSON = isset($_POST['Partida']) ? $_POST['Partida'] : '';

    // Validate the data (you may add further validation here if needed)

    // Decode the JSON data into PHP arrays
    $personaje = json_decode($personajeJSON, true);
    $partida = json_decode($partidaJSON, true);

    // Check if there's a row with the same ID in the "partidas" table
    $queryPartida = "SELECT COUNT(*) as count FROM partidas WHERE Cod_User = ?";
    $stmt = mysqli_prepare($conn, $queryPartida);
    mysqli_stmt_bind_param($stmt, 'i', $codigoId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($count > 0) {
        // Update the existing row
        $queryUpdatePartida = "UPDATE partidas SET 
                                Nombre = ?, 
                                Nivel = ?, 
                                Ubicacion = ? 
                                WHERE Cod_User = ?";
        $stmt = mysqli_prepare($conn, $queryUpdatePartida);
        mysqli_stmt_bind_param($stmt, 'sssi', $partida['Nombre'], $partida['Nivel'], $partida['Ubicacion'], $codigoId);
        if (mysqli_stmt_execute($stmt)) {
            $response["status"] = "success";
            $response["message"] = "Partida actualizada correctamente en la base de datos.";
        } else {
            $response["status"] = "error";
            $response["message"] = "Error al actualizar la partida en la base de datos: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        // Insert a new row
        $queryInsertPartida = "INSERT INTO partidas (Cod_User, Nombre, Nivel, Ubicacion) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $queryInsertPartida);
        mysqli_stmt_bind_param($stmt, 'isss', $codigoId, $partida['Nombre'], $partida['Nivel'], $partida['Ubicacion']);
        if (mysqli_stmt_execute($stmt)) {
            $response["status"] = "success";
            $response["message"] = "Partida insertada correctamente en la base de datos.";
        } else {
            $response["status"] = "error";
            $response["message"] = "Error al insertar la partida en la base de datos: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }

    // Check if there's a row with the same ID in the "personaje" table
    $queryPersonaje = "SELECT COUNT(*) as count FROM personaje WHERE Cod_User = ?";
    $stmt = mysqli_prepare($conn, $queryPersonaje);
    mysqli_stmt_bind_param($stmt, 'i', $codigoId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($count > 0) {
        // Update the existing row
        $queryUpdatePersonaje = "UPDATE personaje SET 
                                 Nombre = ?,
                                 Clase = ?,
                                 Nivel = ?,
                                 Fuerza_Basic = ?,
                                 Resistencia_Basic = ?,
                                 Destreza_Basic = ?,
                                 Magia_Basic = ?,
                                 Fuerza_Bonif = ?,
                                 Resistencia_Bonif = ?,
                                 Destreza_Bonif = ?,
                                 Magia_Bonif = ?,
                                 Stat_Point = ?,
                                 HP_actual = ?,
                                 MP_actual = ?
                                 WHERE Cod_User = ?";
        $stmt = mysqli_prepare($conn, $queryUpdatePersonaje);
        mysqli_stmt_bind_param($stmt, 'ssssssssssssssi', $personaje['nombre'], $personaje['clase'], $personaje['nivel'], $personaje['fuerzaBasic'], $personaje['resistenciaBasic'], $personaje['destrezaBasic'], $personaje['magiaBasic'], $personaje['fuerzaBonif'], $personaje['resistenciaBonif'], $personaje['destrezaBonif'], $personaje['magiaBonif'], $personaje['statPoint'], $personaje['HP_actual'], $personaje['MP_actual'], $codigoId);
        if (mysqli_stmt_execute($stmt)) {
            $response["status"] = "success";
            $response["message"] = "Personaje actualizado correctamente en la base de datos.";
        } else {
            $response["status"] = "error";
            $response["message"] = "Error al actualizar el personaje en la base de datos: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        // Insert a new row
        $queryInsertPersonaje = "INSERT INTO personaje (Cod_User, Nombre, Clase, Nivel, Fuerza_Basic, Resistencia_Basic, Destreza_Basic, Magia_Basic, Fuerza_Bonif, Resistencia_Bonif, Destreza_Bonif, Magia_Bonif, Stat_Point, HP_actual, MP_actual) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $queryInsertPersonaje);
        mysqli_stmt_bind_param($stmt, 'isssssssssssss', $codigoId, $personaje['nombre'], $personaje['clase'], $personaje['nivel'], $personaje['fuerzaBasic'], $personaje['resistenciaBasic'], $personaje['destrezaBasic'], $personaje['magiaBasic'], $personaje['fuerzaBonif'], $personaje['resistenciaBonif'], $personaje['destrezaBonif'], $personaje['magiaBonif'], $personaje['statPoint'], $personaje['HP_actual'], $personaje['MP_actual']);
        if (mysqli_stmt_execute($stmt)) {
            $response["status"] = "success";
            $response["message"] = "Personaje insertado correctamente en la base de datos.";
        } else {
            $response["status"] = "error";
            $response["message"] = "Error al insertar el personaje en la base de datos: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
} else {
    $response["status"] = "error";
    $response["message"] = "Invalid request method.";
}

// Return the response as JSON
echo json_encode($response);
?>
