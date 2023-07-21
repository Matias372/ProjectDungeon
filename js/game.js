// Función para cargar el contenido del escenario
function loadScenario(scenarioURL) {
    $('#game-content').load(scenarioURL, function(response, status, xhr) {
        if (status === "error") {
            console.log("Error al cargar el escenario: " + xhr.statusText);
        }
    });
}

// Cargar el escenario game.html al cargar la página
$(document).ready(function() {
    loadScenario('../../html/game/game.html');
});


