<?php
// Incluir el archivo de conexión a la base de datos
include("../sesion/conexion.php");


$response["status"] = "error";
$response["message"] = "ingreso al archivo";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el valor del ID enviado desde el formulario
    $id = $_POST["Cod_User"];

    // Realizar la consulta en la tabla "partidas" para verificar si existe una fila con el mismo ID
    $query = "SELECT COUNT(*) as count FROM partidas WHERE Cod_User = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row["count"] > 0) {
        // Devolver la respuesta al script AJAX
        $response["status"] = "success";
        $response["message"] = "se conto los datos de tabla";
    } else {
        // Si no existe una fila con el mismo ID, ejecutar la función directamente
        $response["status"] = "error";
        $response["message"] = "no se conto los datos de tabla";
    }
}

// Devolver la respuesta en formato JSON
echo json_encode($response);
?>
