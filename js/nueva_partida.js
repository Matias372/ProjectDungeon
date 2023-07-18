// Eliminar el atributo onclick de cada div.personaje en el archivo nueva_partida.js

let claseSeleccionada = null;

function seleccionarClase(clase) {
    // Resaltar la clase seleccionada visualmente
    const personajes = document.querySelectorAll('.personaje');
    personajes.forEach(personaje => {
        personaje.classList.remove('seleccionado');
    });
    const personajeSeleccionado = document.getElementById(clase);
    personajeSeleccionado.classList.add('seleccionado');

    // Guardar la clase seleccionada
    claseSeleccionada = clase;
}


function Create_newgame() {
    const nombre = document.getElementById('nombre').value.trim();

    // Verificar si se ha seleccionado una clase y se ha ingresado un nombre
    if (claseSeleccionada && nombre) {
        const codigoId = <?php echo $_SESSION['Codigo_Id']; ?>;

        // Realizar la consulta a la base de datos para verificar si existe una partida para el usuario actual
        $.ajax({
            url: '../php/check_partida.php',
            type: 'POST',
            data: {
                Cod_User: codigoId
            },
            success: function(response) {
                if (response === 'exist') {
                    // Si existe una partida, mostrar un popup consultando si quiere sobrescribir
                    const confirmacion = confirm('Ya existe una partida guardada. ¿Desea sobrescribir los datos?');
                    if (confirmacion) {
                        CreateDataGame();
                    } else {
                        // Si el usuario no confirma sobrescribir, volver al escenario game.html
                        loadScenario('../html/game.html');
                    }
                } else {
                    CreateDataGame();
                }
            },
            error: function(xhr, status, error) {
                alert('Error en la consulta a la base de datos: ' + error);
            }
        });
    } else {
        alert('Por favor, selecciona una clase y proporciona un nombre para el personaje.');
    }
}


function CreateDataGame(){

}
