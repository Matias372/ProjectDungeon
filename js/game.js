// Función para crear una nueva partida con las estadísticas iniciales según la clase seleccionada
function Create_newgame() {
    const nombre = document.getElementById('nombre').value.trim();

    // Verificar si se ha seleccionado una clase y se ha ingresado un nombre
    if (claseSeleccionada && nombre) {
        // Verificar la clase seleccionada y actualizar las estadísticas
        let fuerza = 10;
        let resistencia = 10;
        let destreza = 10;
        let magia = 10;

        switch (claseSeleccionada) {
            case 'Barbarian':
                resistencia += 5;
                break;
            case 'Mage':
                magia += 5;
                break;
            case 'Ranger':
                destreza += 5;
                break;
            case 'Warrior':
                fuerza += 5;
                break;
            default:
                // Si no se reconoce la clase, mostrar una alerta y salir de la función
                alert('Clase seleccionada no reconocida. Inténtalo de nuevo.');
                return;
        }

        // Aquí deberías guardar la partida en la base de datos con las estadísticas actualizadas
        // Puedes utilizar una solicitud AJAX para enviar los datos al archivo "validar_registro.php" (por ejemplo) para realizar la inserción en la base de datos

        // Muestra un mensaje de éxito y redirige a la página de juego o realiza otras acciones necesarias
        alert(`¡Nueva partida creada!\nClase: ${claseSeleccionada}\nNombre: ${nombre}\nFuerza: ${fuerza}\nResistencia: ${resistencia}\nDestreza: ${destreza}\nMagia: ${magia}`);
        // window.location.href = "game.html";
    } else {
        alert('Por favor, selecciona una clase y proporciona un nombre para el personaje.');
    }
}
