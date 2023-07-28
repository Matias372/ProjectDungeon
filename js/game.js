// Variable global para almacenar los datos de la partida actual
let gameData = null;

// Función para cargar el contenido del escenario
function loadScenario(scenarioURL) {
    $('#game-content').load(scenarioURL, function(response, status, xhr) {
        if (status === "error") {
            console.log("Error al cargar el escenario: " + xhr.statusText);
        } else {
            // Obtener solo el nombre del archivo de la URL
            const fileName = scenarioURL.substring(scenarioURL.lastIndexOf('/') + 1);

            // Actualizar el Cod_User, nombre y nivel del personaje en gameData cuando se carga un nuevo escenario
            if (gameData) {
                gameData.Cod_User = getPJActive().Cod_User;
                gameData.NombrePersonaje = getPJActive().nombre;
                gameData.NivelPersonaje = getPJActive().nivel;
                gameData.Ubicacion = fileName; // Guardar solo el nombre del archivo
            }
        }
    });
}

// Mover el script para crear la instancia de PJ_active al archivo game.js
$(document).ready(function() {
    // Obtener los datos del personaje desde la variable oculta
    const PJData = $("#PJData").val();

    if (PJData && PJData.trim() !== "") {
        // Si el input "PJData" tiene un valor no vacío, intentar parsear los datos como JSON
        try {
            // Parsear el JSON recibido para obtener un objeto del personaje
            const characterObj = JSON.parse(PJData);

            // Crear una nueva instancia de la clase Personaje y establecer sus propiedades con los datos del personaje
            PJ_active = new Personaje(
                characterObj.nombre,
                characterObj.clase,
                characterObj.nivel,
                characterObj.fuerzaBasic,
                characterObj.resistenciaBasic,
                characterObj.destrezaBasic,
                characterObj.magiaBasic,
                characterObj.fuerzaBonif,
                characterObj.resistenciaBonif,
                characterObj.destrezaBonif,
                characterObj.magiaBonif,
                characterObj.statPoint,
                characterObj.HP_actual,
                characterObj.MP_actual
            );
        } catch (error) {
            // Si hay un error al parsear el JSON, mostrar un mensaje de error
            console.error("Error al parsear el JSON del personaje:", error);
            alert("Ha ocurrido un error al cargar los datos del personaje. Por favor, genera una nueva partida.");
        }
    } else {
        // Si el input "PJData" está vacío o es nulo, mostrar un mensaje de error
        console.error("El input PJData está vacío o es nulo. No se encontraron datos del personaje.");
        
    }

    // Crear el objeto gameData con el Cod_User, nombre y nivel del personaje
    gameData = {
        Cod_User: PJData.Cod_User,
        NombrePersonaje: PJData.nombre,
        NivelPersonaje: PJData.nivel,
        Ubicacion: null // Inicialmente no conocemos la ubicación, por lo que es null
    };
});
