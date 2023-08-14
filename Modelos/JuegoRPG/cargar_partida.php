<?php
// Incluir el archivo de conexión a la base de datos
include "../sesion/conexion.php";

// Obtener el ID del usuario enviado por AJAX
$codUser = $_POST['Cod_User'];

// Consultar los datos del personaje en la tabla "personaje"
$query = "SELECT Cod_User, Nombre, Clase, Nivel, Fuerza_Basic, Resistencia_Basic, Destreza_Basic, Magia_Basic, Fuerza_Bonif, Resistencia_Bonif, Destreza_Bonif, Magia_Bonif, Stat_Point, HP_actual, MP_actual, BonificacionesAplicadas FROM personaje WHERE Cod_User = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $codUser);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtener los datos del personaje como un arreglo asociativo
    $personajeData = $result->fetch_assoc();

    // Crear un arreglo de respuesta con los datos del personaje
    $response = array(
        'status' => 'success',
        'data' => $personajeData
    );
} else {
    // No se encontraron datos del personaje
    $response = array(
        'status' => 'error',
        'message' => 'No se encontraron datos del personaje.'
    );
}

// Devolver la respuesta como JSON
echo json_encode($response);
?>