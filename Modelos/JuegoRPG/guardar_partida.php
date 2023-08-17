<?php
// Include the database connection file
include("../conexion.php");

$response = array();
$response["status"] = "error";
$response["message"] = "No entra al POST";

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the POST request
    $codigoId = isset($_POST['Codigo_User']) ? $_POST['Codigo_User'] : '';
    $personajeJSON = isset($_POST['Personaje']) ? $_POST['Personaje'] : '';
    $partidaJSON = isset($_POST['Partida']) ? $_POST['Partida'] : '';

    // Validate the data (you may add further validation here if needed)

    // Decode the JSON data into PHP arrays
    $personaje = json_decode($personajeJSON, true);
    $partida = json_decode($partidaJSON, true);

    // Check if there's a row with the same ID in the "partidas" table
    $query = "SELECT Cod_User FROM partidas WHERE Cod_User = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigoId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        // Update the existing row
        $query = "UPDATE partidas SET Nombre = ?, Nivel = ?, Ubicacion = ? WHERE Cod_User = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssi', $partida['Nombre'], $partida['Nivel'], $partida['Ubicacion'], $codigoId);
    } else {
        // Insert a new row
        $query = "INSERT INTO partidas (Cod_User, Nombre, Nivel, Ubicacion) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ssis', $codigoId, $partida['Nombre'], $partida['Nivel'], $partida['Ubicacion']);
    }

    if (mysqli_stmt_execute($stmt)) {
        $response["status"] = "success";
        $response["message"] = "Operación realizada correctamente.";
    } else {
        $response["status"] = "error";
        $response["message"] = "Error en la operación: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    $response["status"] = "error";
    $response["message"] = "Método de solicitud inválido.";
}

// Return the response as JSON
echo json_encode($response);
?>
