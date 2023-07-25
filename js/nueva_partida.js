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
//====================================================================================
// Function to create a new game and character
function createNewGame() {
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

    enviarFormulario(codigoId, characterJSON, gameDataJSON);
}

//====================================================================================

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
    const HP_actual= (nivel * 10) + (fuerza_basic * 5) + (fuerza_bonif * 10); //MODIFICAR
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

//====================================================================================

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
        dataType: 'json', // Expect JSON response from the server
        success: function(response) {
            // Check the response status and show appropriate alert
            if (response.status === 'success') {
                alert(response.message);
                // Redirect to "city.html" after saving
                loadScenario('../../html/game/Ciudad/city.html');
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Error al guardar los datos del personaje y la partida: ' + error);
        }
    });
}

//====================================================================================

// Función para cargar el contenido del escenario
function loadScenario(scenarioURL) {
    $('#game-content').load(scenarioURL, function(response, status, xhr) {
        if (status === "error") {
            console.log("Error al cargar el escenario: " + xhr.statusText);
        }
    });
}

//====================================================================================

// Function to go back to game.html when "Volver" button is clicked
function goToIndex() {
    loadScenario('../../html/game/game.html');
}

//====================================================================================

// Función para enviar el formulario mediante AJAX
function enviarFormulario(codigoId, characterJSON, gameDataJSON) {
    
    
    $.ajax({
        url:  '../../php/controladores/check_partida.php',
        type: 'POST',
        data: {
            Cod_User: codigoId,
        },
        dataType: 'json', 
        success: function(response) {
            // Respuesta recibida desde validar.php
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