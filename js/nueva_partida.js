// Function to resaltar la clase seleccionada visualmente
function seleccionarClase(clase) {
    const personajes = document.querySelectorAll('.personaje');
    personajes.forEach(personaje => {
        personaje.classList.remove('seleccionado');
    });
    const personajeSeleccionado = document.getElementById(clase);
    personajeSeleccionado.classList.add('seleccionado');

    claseSeleccionada = clase;
}

// Function to create a new game and character
function createNewGame() {
    const codigoId = <?php echo $_SESSION['Id']; ?>;
    const nombrePartida = document.getElementById('nombre').value.trim(); // You can set the default name for the game here
    const nivelPartida = 1; // You can set the default level for the game here

    const nombrePersonaje = document.getElementById('nombre').value.trim();
    const claseSeleccionada = document.querySelector('.personaje.seleccionado');
    
    if (!nombrePersonaje || !claseSeleccionada) {
        alert('Por favor, selecciona una clase y proporciona un nombre para el personaje.');
        return;
    }

    const clase = claseSeleccionada.id;
    const character = initializeCharacter(nombrePersonaje, clase);
    const characterJSON = JSON.stringify(character);

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
    return {
        nombre: nombre,
        clase: clase,
        nivel: 1,
        fuerza_basic: 10,
        resistencia_basic: 10,
        destreza_basic: 10,
        magia_basic: 10,
        fuerza_bonif: 0,
        resistencia_bonif: 0,
        destreza_bonif: 0,
        magia_bonif: 0,
        stat_point: 0
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
            window.location.href = '../html/city.html';
        },
        error: function(xhr, status, error) {
            alert('Error al guardar los datos del personaje y la partida: ' + error);
        }
    });
}
