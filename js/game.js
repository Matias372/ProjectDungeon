// Función para cargar el contenido del escenario
function loadScenario(scenarioURL) {
    $('#game-content').load(scenarioURL);
}

// Cargar el escenario game.html al cargar la página
$(document).ready(function() {
    loadScenario('../../html/game.html');
});

// Escuchar los mensajes enviados desde el contenido del escenario
window.addEventListener('message', function(event) {
    const data = event.data;
    switch (data) {
        case 'redirigirNuevaPartida':
            loadScenario('../html/game/nueva_partida.html');
            break;
        case 'cargarPartida':
            loadScenario('../html/game/cargar_partida.html');
            break;
        case 'ciudad':
            loadScenario('../html/game/Ciudad/city.html');
            break;
        case 'tienda':
            loadScenario('../html/game/Ciudad/shop.html');
            break;
        case 'posada':
            loadScenario('../html/game/Ciudad/posada.html');
            break;
        case 'gremio':
            loadScenario('../html/game/Ciudad/guild.html');
            break;
        case 'dungeon_p1':
            loadScenario('../html/game/portal/dungeon_P1.html');
            break;
        default:
            console.log('Opción no reconocida:', data);
            break;
    }
});

