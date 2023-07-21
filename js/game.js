// Función para cargar el contenido del escenario
function loadScenario(scenarioURL) {
    $('#game-content').load(scenarioURL);
}

// Cargar el escenario game.html al cargar la página
$(document).ready(function() {
    loadScenario('../../html/game.html');
});

