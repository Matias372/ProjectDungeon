<?php
// Incluir el archivo de conexión a la base de datos
include("conexion.php");

function GetRandCod() {
    global $conn;

    $codid = '';
    $exists = true;

    while ($exists) {
        $codid = generateRandomString(20);

        // Verificar si el código ya existe en la tabla usuarios
        $sql_verificar_codid = "SELECT * FROM usuarios WHERE Codigo_Id = '$codid'";
        $result_verificar_codid = $conn->query($sql_verificar_codid);

        if ($result_verificar_codid->num_rows == 0) {
            // El código no existe en la tabla usuarios
            $exists = false;
        }
    }

    return $codid;
}

// Función para generar una cadena aleatoria de longitud dada
function generateRandomString($length) {
    $characters = '0123456789';
    $charLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charLength - 1)];
    }

    return $randomString;
}
