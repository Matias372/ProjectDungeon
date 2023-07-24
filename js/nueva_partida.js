// Function to resaltar la clase seleccionada visualmente
function seleccionarClase(clase) {
    const personajes = document.querySelectorAll('.personaje');
    personajes.forEach(personaje => {
        personaje.classList.remove('seleccionado');
    });

    const personajeSeleccionado = document.getElementById(clase);
    personajeSeleccionado.classList.add('seleccionado');

    // Aquí puedes hacer algo con la variable 'clase' si es necesario
}

// Function to create a new game and character
function createNewGame() {
    include("../../php/sesion/conexion.php");
    const codigoId = document.getElementById('game-content').dataset.codigoId;
    const nombrePartida = document.getElementById('nombre').value.trim();
    const nivelPartida = 1;

    const nombrePersonaje = document.getElementById('nombre').value.trim();
    const claseSeleccionada = document.querySelector('.personaje.seleccionado');
    
    if (!nombrePersonaje || !claseSeleccionada) {
        alert('Por favor, selecciona una clase y proporciona un nombre para el personaje.');
        return;
    }

    const clase = claseSeleccionada.id;
    const character = initializeCharacter(nombrePersonaje, clase);
    const characterJSON = JSON.stringify(character); // Convert the character object to JSON

    const gameData = {
        Cod_User: codigoId,
        Nombre: nombrePartida,
        Nivel: nivelPartida,
        Ubicacion: 'city.html'
    };
    const gameDataJSON = JSON.stringify(gameData);

    // Check if a game already exists for the user
    $.ajax({
        url: '../../php/controladores/check_partida.php',
        type: 'POST',
        data: { Cod_User: codigoId },
        success: function(response) {
            if (response === 'exist') {
                const confirmacion = confirm('Ya existe una partida guardada. ¿Desea sobrescribir los datos?');
                if (confirmacion) {
                    // Send the character and game data to guardar_partida.php to save in the database
                    saveGameData(codigoId, characterJSON, gameDataJSON);
                } else {
                    // Do nothing or handle the user's decision accordingly
                }
            } else {
                // No existing game, directly save the character and game data in the database
                saveGameData(codigoId, characterJSON, gameDataJSON);
            }
        },
        error: function(xhr, status, error) {
            alert('Error en la consulta a la base de datos: ' + error);
        }
    });
}

// Function to set initial values for the character (Personaje) object
function initializeCharacter(nombre, clase) {
    const nivel = 1;
    const fuerza_basic= 10;
    const resistencia_basic= 10;
    const destreza_basic= 10;
    const magia_basic= 10;
    const fuerza_bonif= 0;
    const resistencia_bonif= 0;
    const destreza_bonif= 0;
    const magia_bonif= 0;
    const stat_point= 0;
    const HP_actual= (nivel * 10) + (fuerza_basic * 5) + (fuerza_bonif * 10);
    const MP_actual= (nivel * 5) + (magia_basic * 10) + (magia_bonif * 5);
    return {
        nombre: nombre,
        clase: clase,
        nivel: nivel,
        fuerza_basic: fuerza_basic,
        resistencia_basic: resistencia_basic,
        destreza_basic: destreza_basic,
        magia_basic: magia_basic,
        fuerza_bonif: fuerza_bonif,
        resistencia_bonif: resistencia_bonif,
        destreza_bonif: destreza_bonif,
        magia_bonif: magia_bonif,
        stat_point: stat_point,
        HP_actual: HP_actual,
        MP_actual: MP_actual
    };
}

// Function to save the character and game data in the database
function saveGameData(codigoId, characterJSON, gameDataJSON) {
    $.ajax({
        url: '../../php/game/guardar_partida.php',
        type: 'POST',
        data: {
            Cod_User: codigoId,
            Personaje: characterJSON,
            Partida: gameDataJSON
        },
        success: function(response) {
            // Character and game data saved successfully
            alert('Los datos del personaje y la partida se han guardado correctamente en la base de datos.');
            // Redirect to "city.html" after saving
            loadScenario('../../html/game/Ciudad/city.html');
        },
        error: function(xhr, status, error) {
            alert('Error al guardar los datos del personaje y la partida: ' + error);
        }
    });
}

// Función para cargar el contenido del escenario
function loadScenario(scenarioURL) {
    $('#game-content').load(scenarioURL, function(response, status, xhr) {
        if (status === "error") {
            console.log("Error al cargar el escenario: " + xhr.statusText);
        }
    });
}

// Function to go back to game.html when "Volver" button is clicked
function goToIndex() {
    loadScenario('../../html/game/game.html');
}
