// Función para guardar los datos del personaje y la partida en la base de datos
export function saveGameData(codigoId, characterJSON, gameDataJSON) {
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
                loadScenario('../../html/game/Ciudad/city.html');
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error, cod_test) { // BORRAR DESPUES
            console.log(xhr);
            console.log(status);
            console.log(error); // Imprimir el mensaje de error
            console.log(codigoId);
            console.log(cod_test);
            alert("Código de Usuario recibido: " + response.cod_test);

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

//====================================================================================
// Función para enviar el formulario mediante AJAX
export function verificarPartida(codigoId, characterJSON, gameDataJSON) {
    $.ajax({
        url: '../../php/controladores/check_partida.php',
        type: 'POST',
        data: {
            Cod_User: codigoId,
        },
        dataType: 'json',
        success: function(response) {
            if (response.status === "success") {
                if (confirm("Ya tienes una partida guardada. ¿Deseas sobrescribir los datos?")) {
                    saveGameData(codigoId, characterJSON, gameDataJSON);
                }
            } else if (response.status === "error") {
                alert("Ha ocurrido un error dentro del check... ");
            } else {
                alert("Respuesta desconocida. A->n_p->eF()");
            }
        },
        error: function() {
            // Manejo de errores si ocurre algún problema con la llamada AJAX
            alert("Ha ocurrido un error al validar los datos.");
        }
    });
}

//====================================================================================

// Variable global para almacenar la instancia de la clase PJ_active
let PJ_active = null;

// Función para establecer la clase activa (PJ_active) para el resto de escenarios
function SetClass(characterJSON) {
    // Parsear el JSON recibido para obtener un objeto del personaje
    const characterObj = JSON.parse(characterJSON);

    // Crear una nueva instancia de la clase Personaje y establecer sus propiedades con los datos del personaje
    PJ_active = {
        nombre: characterObj.nombre,
        clase: characterObj.clase,
        nivel: characterObj.nivel,
        fuerzaBasic: characterObj.fuerzaBasic,
        resistenciaBasic: characterObj.resistenciaBasic,
        destrezaBasic: characterObj.destrezaBasic,
        magiaBasic: characterObj.magiaBasic,
        fuerzaBonif: characterObj.fuerzaBonif,
        resistenciaBonif: characterObj.resistenciaBonif,
        destrezaBonif: characterObj.destrezaBonif,
        magiaBonif: characterObj.magiaBonif,
        statPoint: characterObj.statPoint,
        HP_actual: characterObj.HP_actual,
        MP_actual: characterObj.MP_actual
    };

    // Asignar la instancia de PJ_active a la variable globalPJ en game.php
    if (typeof globalPJ !== 'undefined') {
        globalPJ = PJ_active;
    }
}
