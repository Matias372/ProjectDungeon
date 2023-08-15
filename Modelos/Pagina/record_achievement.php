<?php
// Incluir el archivo de conexión a la base de datos
include("../conexion.php");

// Función para registrar un logro en la tabla usuarios_logros
function RegistrarLogro($codigo_id, $logro_id) {
    global $conn;

    // Verificar si el usuario ya tiene el logro registrado
    $sql_verificar_logro = "SELECT * FROM usuarios_logros WHERE Id_usuario = '$codigo_id' AND Logro_Id = '$logro_id'";
    $result_verificar_logro = $conn->query($sql_verificar_logro);

    if ($result_verificar_logro->num_rows > 0) {
        // El logro ya está registrado para el usuario
        return false;
    } else {
        // Insertar el logro en la tabla usuarios_logros
        $sql_insertar_logro = "INSERT INTO usuarios_logros (Id_usuario, Logro_Id) VALUES ('$codigo_id', '$logro_id')";

        if ($conn->query($sql_insertar_logro) === TRUE) {
            return true; // El logro se registró exitosamente
        } else {
            return false; // Error al registrar el logro
        }
    }
}
?>
