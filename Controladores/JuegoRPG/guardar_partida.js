 // Función para guardar los datos del personaje y la partida en la base de datos
function saveGameData(codigoId, characterJSON, gameDataJSON) {
    $.ajax({
        url: '../../../Modelos/JuegoRPG/guardar_partida.php',
        type: 'POST',
        data: {
            Codigo_User: codigoId,
            Personaje: characterJSON,
            Partida: gameDataJSON
        },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                // Llamada a SetClass con un callback
                SetClass(characterJSON, function(PJ_active) {
                    // PJ_active se ha actualizado correctamente aquí
                    loadScenario("../../../Vistas/Interfaz/JuegoRPG/Escenarios/" + gameData.Ubicacion);
                });
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Error al guardar los datos del personaje y la partida: ' + error);
        }
    });
}
