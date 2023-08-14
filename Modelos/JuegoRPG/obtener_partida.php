<?php
// Incluir el archivo de conexión a la base de datos
include "../sesion/conexion.php";

// Obtener el Cod_User del cuerpo de la solicitud POST
$codUser = $_POST["Cod_User"];

// Preparar la consulta con un parámetro para evitar ataques de inyección SQL
$query = "SELECT Nombre, Nivel, Ubicacion FROM partidas WHERE Cod_User = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $codUser);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Obtener la primera fila de resultados
    $row = $result->fetch_assoc();

    // Crear un arreglo con los datos de la partida
    $partida = array(
        "Cod_User" => $codUser,
        "Nombre" => $row["Nombre"],
        "Nivel" => $row["Nivel"],
        "Ubicacion" => $row["Ubicacion"]
    );

    // Éxito al obtener los datos de la partida
    $response = array(
        "status" => "success",
        "data" => $partida
    );
} else {
    // No se encontraron registros de partidas guardadas para el Cod_User dado
    $response = array(
        "status" => "error",
        "message" => "No se encontraron partidas guardadas del usuario proporcionado"
    );
}

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();

// Devolver la respuesta en formato JSON
echo json_encode($response);
?>