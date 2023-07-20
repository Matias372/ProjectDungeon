<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_dungeon";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}


?>
