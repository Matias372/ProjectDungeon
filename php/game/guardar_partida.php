<?php
// Include the database connection file
require_once 'conexion.php';

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

    // Prepare the SQL statements to insert data into the respective tables
    $personajeStmt = $conn->prepare("INSERT INTO personajes (Cod_User, Nombre, Clase, Nivel, Fuerza_Basic, Resistencia_Basic, Destreza_Basic, Magia_Basic, Fuerza_Bonif, Resistencia_Bonif, Destreza_Bonif, Magia_Bonif, Stat_Point) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $partidaStmt = $conn->prepare("INSERT INTO partidas (Cod_User, Nombre, Nivel, Ubicacion) 
                                   VALUES (?, ?, ?, ?)");

    // Bind the parameters and execute the statements
    $personajeStmt->bind_param("ssiiiiiiiiisii", $codigoId, $personaje['nombre'], $personaje['clase'], $personaje['nivel'], $personaje['fuerza_basic'], $personaje['resistencia_basic'], $personaje['destreza_basic'], $personaje['magia_basic'], $personaje['fuerza_bonif'], $personaje['resistencia_bonif'], $personaje['destreza_bonif'], $personaje['magia_bonif'], $personaje['stat_point'], $personaje['HP_actual'], $personaje['MP_actual']);

    $partidaStmt->bind_param("siss", $codigoId, $partida['Nombre'], $partida['Nivel'], $partida['Ubicacion']);


    // Execute the statements and check for success
    $personajeSuccess = $personajeStmt->execute();
    $partidaSuccess = $partidaStmt->execute();

    // Close the statements
    $personajeStmt->close();
    $partidaStmt->close();

    // Check if both insertions were successful
    if ($personajeSuccess && $partidaSuccess) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    // If the request is not a POST request, return an error
    echo "error";
}

// Close the database connection
$conn->close();
?>
