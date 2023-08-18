

    //====================================================================================
    // Función para enviar el formulario mediante AJAX
    function verificarPartida(codigoId, characterJSON, gameDataJSON) {
        $.ajax({
            url: '../../../Modelos/check_partida.php',
            type: 'POST',
            data: {
                Cod_User: codigoId,
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === "existe") {
                    if (confirm("Ya tienes una partida guardada. ¿Deseas sobrescribir los datos?")) {
                        saveGameData(codigoId, characterJSON, gameDataJSON);
                    }
                } else if (response.status === "new") {
                    saveGameData(codigoId, characterJSON, gameDataJSON);
                }else if (response.status === "error") {
                    alert("Ha ocurrido un error dentro del check... ");
                } else {
                    alert("Respuesta desconocida. A->n_p->eF()");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
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
        $.ajax({
            url: '../../../Modelos/JuegoRPG/Generar_PJ.php',
            type: 'POST',
            data: {
                characterJSON: characterJSON
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.personaje);
                    PJ_active = response.personaje; // Asigna la instancia del personaje creada en PHP
                } else {
                    alert('Error al crear la instancia del personaje.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                alert('Error en la llamada AJAX para crear la instancia del personaje.');
            }
        });
    }
