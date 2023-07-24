<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_dungeon";

// Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if (!$conn) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}
?>
