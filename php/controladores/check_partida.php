<?php
// Incluir el archivo de conexión a la base de datos
include("../sesion/conexion.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el valor del ID enviado desde el formulario
    $id = $_POST["Cod_User"];

    // Realizar la consulta en la tabla "partidas" para verificar si existe una fila con el mismo ID
    $query = "SELECT COUNT(*) as count FROM partidas WHERE Cod_User = $id";
    $result = mysqli_query($conexion, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $exists = $row["count"] > 0;
        
        // Devolver la respuesta al script AJAX
        echo json_encode(array("exists" => $exists));
    } else {
        // Manejo de errores si ocurre algún problema con la consulta
        echo json_encode(array("exists" => false));
    }
}
?>
