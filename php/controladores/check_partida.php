<?php
// Incluir el archivo de conexión a la base de datos
include("../sesion/conexion.php");

// Verificar si existe una sesión iniciada y obtener el Codigo_Id del usuario
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['Id'])) {
    $codigoId = $_SESSION['Id'];

    // Realizar la consulta para verificar si existe una partida para el usuario actual
    $sql = "SELECT * FROM partidas WHERE Cod_User = '$codigoId'";
    $result = $conn->query($sql);

    // Verificar si se obtuvieron resultados
    if ($result->num_rows > 0) {
        // Si existe una partida, enviar respuesta 'exist'
        echo 'exist';
    } else {
        // Si no existe una partida, enviar respuesta 'not_exist'
        echo 'not_exist';
    }
} else {
    // Si no hay una sesión iniciada o no se pudo obtener el Codigo_Id del usuario, enviar respuesta de error
    echo 'error';
}

// Cerrar la conexión a la base de datos (opcional si no se va a realizar más consultas)
$conn->close();
?>
