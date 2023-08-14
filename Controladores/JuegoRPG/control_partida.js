

    //====================================================================================
    // Función para enviar el formulario mediante AJAX
    function verificarPartida(codigoId, characterJSON, gameDataJSON) {
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

/* Variable global para almacenar la instancia de la clase PJ_active
let PJ_active = null;*/


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
            MP_actual: characterObj.MP_actual,
            bonificacionesAplicadas: characterObj.BonificacionesAplicadas
        };

        // Asignar la instancia de PJ_active a la variable globalPJ en game.php
        if (typeof globalPJ !== 'undefined') {
            globalPJ = PJ_active;
        }
    }
