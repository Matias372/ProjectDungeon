<?php
// Incluir el archivo de conexión a la base de datos
require_once 'conexion.php';

// Obtener los datos de la nueva partida desde la solicitud POST
if (isset($_POST['Cod_User']) && isset($_POST['Nombre_PJ']) && isset($_POST['Ubicacion_Actual'])) {
    $codigoId = $_POST['Cod_User'];
    $nombrePJ = $_POST['Nombre_PJ'];
    $ubicacionActual = $_POST['Ubicacion_Actual'];

    // Realizar la inserción de los datos de la nueva partida en la tabla "partidas"
    $sql_partidas = "INSERT INTO partidas (Cod_User, Nombre_PJ, ubicacion_actual) VALUES ('$codigoId', '$nombrePJ', '$ubicacionActual')";
    if ($conn->query($sql_partidas) !== TRUE) {
        echo 'error';
        exit();
    }

    // Obtener el ID de la última partida insertada
    $partidaId = $conn->insert_id;

    // Realizar la inserción de los datos de otras tablas----
    
} else {
    // Si no se proporcionaron todos los datos necesarios en la solicitud POST, enviar respuesta de error
    echo 'error';
}
?>
