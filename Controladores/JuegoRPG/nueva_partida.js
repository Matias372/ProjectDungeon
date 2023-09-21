// Function to resaltar la clase seleccionada visualmente
function seleccionarClase(clase){
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
    
    

    gameData = {
        Cod_User: codigoId,
        Nombre: nombrePartida,
        Nivel: nivelPartida,
        Ubicacion: 'city.html'
    };
    const gameDataJSON = JSON.stringify(gameData);

    // Set the character JSON data in the hidden input
    document.getElementById('PJData').value = characterJSON;

    verificarPartida(codigoId, characterJSON, gameDataJSON);
}

// Function to set initial values for the character (Personaje) object
function initializeCharacter(nombre, clase) {
    const nivel = 1;
    const fuerza_basic = 10;
    const resistencia_basic = 10;
    const destreza_basic = 10;
    const magia_basic = 10;
    const fuerza_bonif = 0;
    const resistencia_bonif = 0;
    const destreza_bonif = 0;
    const magia_bonif = 0;
    const stat_point = 0;
    const HP_actual = 10; //MODIFICAR
    const MP_actual = 10;
    const bonificacionesAplicadas = false;
    const fuerzaEquip = 0;
    const resistenciaEquip = 0;
    const destrezaEquip = 0;
    const magiaEquip = 0;

    // Crear un objeto con las propiedades del personaje
    const character = {
        nombre: nombre,
        clase: clase,
        nivel: nivel,
        fuerzaBasic: fuerza_basic,
        resistenciaBasic: resistencia_basic,
        destrezaBasic: destreza_basic,
        magiaBasic: magia_basic,
        fuerzaBonif: fuerza_bonif,
        resistenciaBonif: resistencia_bonif,
        destrezaBonif: destreza_bonif,
        magiaBonif: magia_bonif,
        statPoint: stat_point,
        HP_actual: HP_actual,
        MP_actual: MP_actual,
        bonificacionesAplicadas: bonificacionesAplicadas,
        fuerzaEquip: fuerzaEquip,
        resistenciaEquip: resistenciaEquip,
        destrezaEquip: destrezaEquip,
        magiaEquip: magiaEquip
    };

    return character;
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
    loadScenario('../../../Vistas/Interfaz/JuegoRPG/game.html');
}


