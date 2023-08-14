 // Función para guardar los datos del personaje y la partida en la base de datos
 function saveGameData(codigoId, characterJSON, gameDataJSON) {
    $.ajax({
        url: '../../php/game/guardar_partida.php',
        type: 'POST',
        data: {
            Codigo_User: codigoId,
            Personaje: characterJSON,
            Partida: gameDataJSON
        },
        dataType: 'json', // Expect JSON response from the server
        success: function(response) {
            if (response.status === 'success') {
                alert(response.message);
                // Redirect to "city.html" after saving
                SetClass(characterJSON);
                switch (gameData.Ubicacion) {
                    case "city.html":
                            loadScenario("../../html/game/Ciudad/" + gameData.Ubicacion);
                            break;
                        case "portal.html":
                            loadScenario("../../html/game/Ciudad/" + gameData.Ubicacion);
                            break;
                    
                        default:
                            console.log(gameData.Ubicacion);
                            loadScenario("../../html/game/portal/" + gameData.Ubicacion);
                            break;
                    }
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) { // <-- Cambiar 'response' por 'xhr'
            console.log(xhr);
            console.log(status);
            console.log(error); // Imprimir el mensaje de error
            console.log(codigoId);
        
            // Si la respuesta del servidor es una cadena JSON, puedes intentar analizarla para obtener más información
            try {
                const responseJSON = JSON.parse(xhr.responseText);
                console.log(responseJSON);
            } catch (e) {
                console.log("No se pudo analizar la respuesta JSON del servidor.");
            }
            alert('Error al guardar los datos del personaje y la partida: ' + error);
        }
    });
}