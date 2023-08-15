<?php
// Incluir el archivo de conexión a la base de datos
include("../conexion.php");

function generateUUID() {
    global $conn;

    $uuid = '';
    $exists = true;

    while ($exists) {
        // Generar un UUID
        $uuid = generateRandomUUID();

        // Verificar si el UUID ya existe en la tabla usuarios
        $sql_verificar_uuid = "SELECT * FROM usuarios WHERE Id = '$uuid'";
        $result_verificar_uuid = $conn->query($sql_verificar_uuid);

        if ($result_verificar_uuid->num_rows == 0) {
            // El UUID no existe en la tabla usuarios
            $exists = false;
        }
    }

    return $uuid;
}

// Función para generar un UUID (Identificador Único Universal)
function generateRandomUUID() {
    if (function_exists('com_create_guid') === true) {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535),
        mt_rand(16384, 20479), mt_rand(32768, 49151),
        mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535)
    );
}
?>
