<?php
// Incluir el archivo de conexión a la base de datos
include("conexion.php");

// Verificar si se pudo conectar a la base de datos


$response["status"] = "error";
$response["message"] = "ingreso al archivo";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el valor del ID enviado desde el formulario
    $id = $_POST["Cod_User"];

    // Realizar la consulta en la tabla "partidas" para verificar si existe una fila con el mismo ID
    $query = "SELECT COUNT(*) as count FROM partidas WHERE Cod_User = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row["count"] === "1") {
        // Si hay una fila con el ID proporcionado
        $response["status"] = "existe";
        $response["message"] = "La fila existe en la tabla.";
    } elseif ($row["count"] === "0") {
        // Si no hay una fila con el ID proporcionado
        $response["status"] = "new";
        $response["message"] = "La fila es nueva en la tabla.";
    } else {
        // Si ocurrió algún error
        $response["status"] = "error";
        $response["message"] = "Ocurrió un error al verificar la fila.";
    }
}

// Devolver la respuesta en formato JSON
echo json_encode($response);
?>
