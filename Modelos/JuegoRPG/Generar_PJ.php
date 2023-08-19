<?php

include ('Personaje.php');

// Verifica si se ha recibido un dato JSON en la solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['characterJSON'])) {
    // Incluye la definición de la clase Personaje
    

    $characterJSON = $_POST['characterJSON'];
    
    // Decodifica el JSON en un array asociativo
    $decoded_character = json_decode($characterJSON, true);
    
    if ($decoded_character !== null) {
        // Instancia la clase Personaje con los datos decodificados
        $personaje = new Personaje(
            $decoded_character['nombre'],
            $decoded_character['clase'],
            $decoded_character['nivel'],
            $decoded_character['fuerzaBasic'],
            $decoded_character['resistenciaBasic'],
            $decoded_character['destrezaBasic'],
            $decoded_character['magiaBasic'],
            $decoded_character['fuerzaBonif'],
            $decoded_character['resistenciaBonif'],
            $decoded_character['destrezaBonif'],
            $decoded_character['magiaBonif'],
            $decoded_character['statPoint'],
            $decoded_character['HP_actual'],
            $decoded_character['MP_actual'],
            $decoded_character['bonificacionesAplicadas']
        );

    
        $response["status"] = "success";
        $response["personaje"] = $personaje;
    } else {
        $response["status"] = "error";
        $response["message"] = "Error al decodificar el JSON.";
    }
} else {
    $response["status"] = "error";
    $response["message"] = "No se recibieron datos JSON válidos.";
}
// Return the response as JSON
echo json_encode($response);
?>
