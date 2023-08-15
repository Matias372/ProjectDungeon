$(document).ready(function() {
    
    // Obtener la partida guardada al cargar la página
    const codigoId = document.getElementById('game-content').dataset.codigoId;
    obtenerPartidaGuardada(codigoId);
    
    // Función para obtener la partida guardada
    function obtenerPartidaGuardada(codigoId) {
        $.ajax({
            url: "../../Modelos/check_partida.php",
            type: "POST",
            data: {
                Cod_User: codigoId,
            },
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    // Obtener los datos de la partida guardada
                    obtenerDatosPartida(codigoId);
                } else {
                    // Mostrar un mensaje de que no hay partida guardada
                    mostrarMensaje("No hay partida guardada.");
                }
            },
            error: function() {
                // Mostrar un mensaje de error
                mostrarMensaje("Error al obtener la partida guardada.");
            }
        });
    }
    
    // Función para obtener los datos de la partida guardada
    function obtenerDatosPartida(codigoId) {
        
        $.ajax({
            url: "../../Modelos/JuegoRPG/obtener_partida.php",
            type: "POST",
            data: {
                Cod_User: codigoId,
            },
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    // Mostrar los datos de la partida
                    mostrarPartida(response.data);
                } else {
                    // Mostrar un mensaje de error al obtener los datos de la partida
                    mostrarMensaje("Ha ocurrido un error dentro del check...");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Mostrar un mensaje de error
                mostrarMensaje("Error al obtener los datos de la partida.");
            }
        });
    }
    
    // Función para mostrar los datos de la partida guardada
    function mostrarPartida(partida) {
        // Obtener el contenedor de la partida
        var partidaContainer = $("#partida-container");
    
        // Limpiar el contenedor
        partidaContainer.empty();
    
        // Crear elementos HTML para mostrar los datos de la partida
        var nombrePersonaje = $("<p>").text("Nombre de personaje: " + partida.Nombre);
        var nivel = $("<p>").text("Nivel: " + partida.Nivel);
    
        // Obtener la ubicación sin la extensión .html
        var ubicacionSinExtension = partida.Ubicacion.replace(".html", "");
    
        // Crear un párrafo para mostrar la ubicación
        var ubicacionParrafo = $("<p>").text("Ubicación: " + ubicacionSinExtension);
    
        var cargarBtn = $("<button>").text("Cargar Partida");
    
        // Agregar los elementos al contenedor
        partidaContainer.append(nombrePersonaje, nivel, ubicacionParrafo, cargarBtn);
    
        // Asignar un evento click al botón de cargar partida
        cargarBtn.on("click", function() {
            cargarPartida(partida);
        });
    }    
    
    // Función para cargar la partida
    function cargarPartida(partida) {
        $.ajax({
            url: "../../Modelos/JuegoRPG/cargar_partida.php",
            type: "POST",
            data: {
                Cod_User: partida.Cod_User,
            },
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    
                    alert("se tomo los datos de tabla personaje");
                    gameData = {
                        Cod_User: partida.Cod_User,
                        NombrePersonaje: partida.Nombre,
                        NivelPersonaje: partida.Nivel,
                        Ubicacion: partida.Ubicacion
                    };
                    alert("se colocan los datos en la variable global de partida");

                    SetClass(JSON.stringify(response.data));
                    alert("se colocan los datos en la variable global de personaje");
                    loadScenario("../../Vistas/Interfaz/JuegoRPG/Escenarios/" + gameData.Ubicacion);
                    

                } else {
                    // Mostrar un mensaje de error al obtener los datos de la partida
                    mostrarMensaje("Ha ocurrido un error dentro al cargar partida");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Mostrar un mensaje de error
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                mostrarMensaje("Error al obtener los datos de la personaje.");
            }
        });
        
    }
    
    // Función para mostrar un mensaje en el contenedor de mensajes
    function mostrarMensaje(mensaje) {
        // Obtener el contenedor de mensajes
        var mensajeContainer = $("#mensaje-container");
        
        // Mostrar el mensaje
        mensajeContainer.text(mensaje);
    }
});