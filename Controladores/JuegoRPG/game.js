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
                    gameData.Cod_User = document.getElementById('game-content').dataset.codigoId;
                    gameData.NombrePersonaje = PJ_active.getNombre();
                    gameData.NivelPersonaje = PJ_active.getNivel();
                    gameData.Ubicacion = fileName; // Guardar solo el nombre del archivo
                }
            }
        });
    }