<!--   CODIGO PARA LLAMAR A LA FUNCION DESDE LOS OTROS ARCHIVOS
// Incluir el archivo de funciones
include("funciones.php");

// Llamar a la función RegistrarLogro() para registrar un logro
$codigo_id = $_SESSION['Codigo_Id']; // Obtener el código ID del usuario desde la sesión
$logro_id = 1; // ID del logro a registrar
$resultado = RegistrarLogro($codigo_id, $logro_id);

if ($resultado) {
    echo "El logro se registró exitosamente.";
} else {
    echo "Error al registrar el logro.";
}
-->




<?php
// Incluir el archivo de conexión a la base de datos
include("conexion.php");

// Función para registrar un logro en la tabla usuarios_logros
function RegistrarLogro($codigo_id, $logro_id) {
    global $conn;

    // Verificar si el usuario ya tiene el logro registrado
    $sql_verificar_logro = "SELECT * FROM usuarios_logros WHERE usuario_id = '$codigo_id' AND logro_id = '$logro_id'";
    $result_verificar_logro = $conn->query($sql_verificar_logro);

    if ($result_verificar_logro->num_rows > 0) {
        // El logro ya está registrado para el usuario
        return false;
    } else {
        // Insertar el logro en la tabla usuarios_logros
        $sql_insertar_logro = "INSERT INTO usuarios_logros (usuario_id, logro_id) VALUES ('$codigo_id', '$logro_id')";

        if ($conn->query($sql_insertar_logro) === TRUE) {
            return true; // El logro se registró exitosamente
        } else {
            return false; // Error al registrar el logro
        }
    }
}
?>
