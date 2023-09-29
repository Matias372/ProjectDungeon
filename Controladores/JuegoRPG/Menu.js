// Obtener el escenario actual (deberás definir una forma de obtenerlo)
const escenarioActual = obtenerEscenarioActual(); // Esto debe ser una función que obtenga el escenario actual

// Definir las opciones iniciales según el escenario
const opcionesIniciales = obtenerOpcionesIniciales(escenarioActual);

// Generar botones para las opciones iniciales
const inicialSection = document.getElementById('inicial');
opcionesIniciales.forEach((opcion) => {
    const button = document.createElement('button');
    button.textContent = opcion;
    button.addEventListener('click', () => mostrarSeleccion(opcion, opcionesIniciales));
    inicialSection.appendChild(button);
});

// Función para mostrar opciones de selección
function mostrarSeleccion(opcion, opcionesIniciales) {
    // Aquí puedes implementar la lógica para mostrar las opciones de selección según la opción inicial seleccionada
    const opcionesSeleccion = obtenerOpcionesSeleccion(escenarioActual, opcion);

    // Generar botones para las opciones de selección
    const seleccionSection = document.getElementById('seleccion');
    seleccionSection.innerHTML = ''; // Limpiar contenido anterior
    opcionesSeleccion.forEach((opcionSeleccion) => {
        const button = document.createElement('button');
        button.textContent = opcionSeleccion;
        button.addEventListener('click', () => mostrarConfirmacion(opcionesIniciales, opcionSeleccion));
        seleccionSection.appendChild(button);
    });

    // Mostrar el sector de selección
    seleccionSection.style.display = 'block';
}

// Función para mostrar opciones de confirmación
function mostrarConfirmacion(opcionesIniciales, opcionSeleccion) {
    // Aquí puedes implementar la lógica para mostrar las opciones de confirmación según la opción de selección
    const opcionesConfirmacion = obtenerOpcionesConfirmacion(escenarioActual, opcionSeleccion);

    // Generar botones para las opciones de confirmación
    const confirmacionSection = document.getElementById('confirmacion');
    confirmacionSection.innerHTML = ''; // Limpiar contenido anterior
    opcionesConfirmacion.forEach((opcionConfirmacion) => {
        const button = document.createElement('button');
        button.textContent = opcionConfirmacion;
        button.addEventListener('click', () => realizarAccion(opcionesIniciales, opcionSeleccion, opcionConfirmacion));//ANALIZAR: para realizar la accion debe verificar que opcion eligio para saber que accion realizar.
        confirmacionSection.appendChild(button);
    });

    // Mostrar el sector de confirmación
    confirmacionSection.style.display = 'block';
}

//Funcion para cancelar opcion
function CancelarOpcion() {
    const seleccionSection = document.getElementById('seleccion');
    const confirmacionSection = document.getElementById('confirmacion');
    
    // Verificar cuál es el section actual y ocultarlo
    if (seleccionSection.style.display === 'block') {
        seleccionSection.style.display = 'none';
    } else if (confirmacionSection.style.display === 'block') {
        confirmacionSection.style.display = 'none';
    }
}

// Función para realizar la acción seleccionada
function realizarAccion(inicial,seleccion,confirmacion) {
    // Aquí puedes implementar la lógica para realizar la acción correspondiente
    console.log(`Acción realizada: ${inicial}, ${seleccion}, ${confirmacion}`);
    //DESARROLLAR LOGICA===============================================================

    // Reiniciar el menú
    reiniciarMenu();
}

// Función para reiniciar el menú volviendo al sector inicial
function reiniciarMenu() {
    document.getElementById('inicial').style.display = 'block';
    document.getElementById('seleccion').style.display = 'none';
    document.getElementById('confirmacion').style.display = 'none';
}

// Debes definir estas funciones para obtener las opciones según el escenario y la selección
function obtenerEscenarioActual() {
    // Obtener la URL actual del navegador
    const urlActual = window.location.href;

    // Analizar la URL para determinar el escenario actual
    if (urlActual.includes('city.html')) {
        return 'City'; // Cambia 'City' al nombre del escenario según tu estructura
    } else if (urlActual.includes('tienda.html')) {
        return 'Tienda'; // Cambia 'Tienda' al nombre del escenario según tu estructura
    } else if (urlActual.includes('gremio.html')) {
        return 'Gremio'; // Cambia 'Gremio' al nombre del escenario según tu estructura
    } else if (urlActual.includes('posada.html')) {
        return 'Posada'; // Cambia 'Gremio' al nombre del escenario según tu estructura
    } else if (urlActual.includes('Portal.html')) {
        return 'Portal'; // Cambia 'Gremio' al nombre del escenario según tu estructura
    } else if (urlActual.includes('Area_N')) {
        return 'Area'; // Cambia 'Gremio' al nombre del escenario según tu estructura
    }
    // Agrega más condiciones para otros escenarios según sea necesario

    // Valor predeterminado si no se detecta ningún escenario
    return 'Desconocido'; // Puedes cambiar 'Desconocido' a lo que necesites
}


function obtenerOpcionesIniciales(escenario) {
        let opciones = [];
    
        switch (escenario) {
            case 'City':
                opciones = ['Mover a', 'Personaje', 'Guardar'];
                break;
            case 'Tienda':
                opciones = ['Comprar', 'Vender', 'Volver a ciudad'];
                break;
            case 'Gremio':
                opciones = ['Misiones', 'Volver a ciudad'];
                break;
            case 'Posada':
                opciones = ['Descansar', 'Comprar', 'Volver a ciudad'];
                break;
            case 'Portal':
                opciones = ['Explorar Area', 'Volver a ciudad'];
                break;
            case 'Area':
                opciones = ['Explorar', 'Personaje', 'Guardar', 'Volver a ciudad'];
                break;
            case 'Battle':
                opciones = ['Atacar', 'Habilidad', 'Objeto', 'Huir'];
                break;
            default:
                opciones = ['Desconocido'];
                break;
        }
    
        return opciones;
    }


    function obtenerOpcionesSeleccion(escenario, opcionInicial) {
        let opciones = [];
    
        switch (escenario) {
            case 'City':
                switch (opcionInicial) {
                    case 'Mover a':
                        opciones = ['Tienda', 'Gremio', 'Portal', 'Posada', 'Cancelar'];
                        break;
                    case 'Personaje':
                        opciones = ['Estado', 'Inventario', 'Cancelar'];
                        break;
                    case 'Guardar':
                        const PJJSON = JSON.stringify(PJ_active); 
                        const DataJSON = JSON.stringify(gameData);
                        const ID = document.getElementById('game-content').dataset.codigoId; 
                        verificarPartida(ID,PJJSON,DataJSON);
                        break;
                    default:
                        alert("ERROR CON opcionInicial");
                        break;
                }
                break;
    
            case 'Tienda':
                switch (opcionInicial) {
                    case 'Comprar':
                        //MOSTRAR LISTA DE COMPRAS
                        break;
                    case 'Vender':
                        //MOSTRAR LISTA DE COMPRAS
                        break;
                    case 'Volver a ciudad':
                        //CAMBIAR UBICACION Y EJECUTAR LOADSCENARIO()
                        break;
                    default:
                        alert("ERROR CON opcionInicial");
                        break;
                }
                break;
    
            case 'Gremio':
                switch (opcionInicial) {
                    case 'Misiones':
                        //MOSTRAR LISTA DE MISIONES
                        break;
                    case 'Volver a ciudad':
                        //CAMBIAR UBICACION Y EJECUTAR LOADSCENARIO()
                        break;
                    default:
                        alert("ERROR CON opcionInicial");
                        break;
                }
                break;
    
            case 'Posada':
                switch (opcionInicial) {
                    case 'Descansar':
                        opciones = ['¿Quieres una habitación para descansar?', 'Cancelar']; //PASARLO A MENSAJE Y AVANZAR A OPCIONCONFIRMCION
                        break;
                    case 'Comprar':
                        //MOSTRAR LISTA DE COMPRAS
                        break;
                    case 'Volver a ciudad':
                        //CAMBIAR UBICACION Y EJECUTAR LOADSCENARIO()
                        break;
                    default:
                        alert("ERROR CON opcionInicial");
                        break;
                }
                break;
    
            case 'Portal':
                switch (opcionInicial) {
                    case 'Explorar Area':
                        //MOSTRAR LISTA DE AREAS
                        break;
                    case 'Volver a ciudad':
                        //CAMBIAR UBICACION Y EJECUTAR LOADSCENARIO()
                        break;
                    default:
                        alert("ERROR CON opcionInicial");
                        break;
                }
                break;
    
            case 'Area':
                switch (opcionInicial) {
                    case 'Explorar':
                        opciones = ['Explorar el Área', 'Cancelar'];
                        break;
                    case 'Personaje':
                        opciones = ['Estado', 'Inventario', 'Cancelar'];
                        break;
                    case 'Guardar':
                        opciones = ['Verificar Partida', 'Cancelar'];
                        break;
                    case 'Volver a ciudad':
                        //CAMBIAR UBICACION Y EJECUTAR LOADSCENARIO()
                        break;
                    default:
                        alert("ERROR CON opcionInicial");
                        break;
                }
                break;
    
            case 'Battle':
                switch (opcionInicial) {
                    case 'Atacar':
                        opciones = ['¿Deseas atacar a X?', 'Cancelar'];//PASARLO A MENSAJE Y AVANZAR A OPCIONCONFIRMCION
                        break;
                    case 'Habilidad':
                        //MOSTRAR LISTA DE HABILIDADES
                        break;
                    case 'Objeto':
                        //MOSTRAR OBJETOS DE INVENTARIO
                        break;
                    case 'Huir':
                        opciones = ['¿Deseas huir de la batalla?', 'Cancelar']; //PASARLO A MENSAJE Y AVANZAR A OPCIONCONFIRMCION
                        break;
                    default:
                        alert("ERROR CON opcionInicial");
                        break;
                }
                break;
    
            default:
                opciones = ['Cancelar'];
                break;
        }
    
        return opciones;
    }
    

    function obtenerOpcionesConfirmacion(escenario, opcionSeleccion) {
        let opciones = [];
    
        switch (escenario) {
            case 'City':
                switch (opcionSeleccion) {// MODIFICAR- POR OPCION Y AGREGAR UN BOOL PARA CUANDO LA OPCIONSELECCION ES TEXTO.
                    case 'Tienda':
                    case 'Gremio':
                    case 'Portal':
                    case 'Posada':
                        opciones = ['Confirmar', 'Cancelar'];
                        break;
                    case 'Cancelar':
                        CancelarOpcion();
                        break;
                    case 'Estado':
                        //AGREGAR FUNCION PARA MOSTRAR ESTADO DE PERSONAJE
                        break;
                    case 'Inventario':
                        ////AGREGAR FUNCION PARA MOSTRAR INVENTARIO
                        break;
                    default:
                        alert("ERROR CON opcionInicial");
                        break;
                }
                break;
    
            case 'Tienda':
                switch (opcionSeleccion) {
                    case 'Comprar':
                    case 'Vender':
                        opciones = ['Mostrar Lista de Compra/Venta', 'Cancelar'];
                        break;
                    case 'Volver a ciudad':
                        opciones = ['Cancelar'];
                        break;
                    default:
                        opciones = ['Cancelar'];
                        break;
                }
                break;
    
            case 'Gremio':
                switch (opcionSeleccion) {
                    case 'Misiones':
                        opciones = ['Mostrar Lista de Misiones', 'Cancelar'];
                        break;
                    case 'Volver a ciudad':
                        opciones = ['Cancelar'];
                        break;
                    default:
                        opciones = ['Cancelar'];
                        break;
                }
                break;
    
            case 'Posada':
                switch (opcionSeleccion) {
                    case 'Descansar':
                        opciones = ['¿Confirmar habitación para descansar?', 'Cancelar'];
                        break;
                    case 'Comprar':
                        opciones = ['Mostrar Lista de Compra', 'Cancelar'];
                        break;
                    case 'Volver a ciudad':
                        opciones = ['Cancelar'];
                        break;
                    default:
                        opciones = ['Cancelar'];
                        break;
                }
                break;
    
            case 'Portal':
                switch (opcionSeleccion) {
                    case 'Explorar Area':
                        opciones = ['Explorar el Área', 'Cancelar'];
                        break;
                    case 'Volver a ciudad':
                        opciones = ['Cancelar'];
                        break;
                    default:
                        opciones = ['Cancelar'];
                        break;
                }
                break;
    
            case 'Area':
                switch (opcionSeleccion) {
                    case 'Explorar':
                    case 'Personaje':
                    case 'Guardar':
                        opciones = ['Confirmar', 'Cancelar'];
                        break;
                    case 'Volver a ciudad':
                        opciones = ['Cancelar'];
                        break;
                    default:
                        opciones = ['Cancelar'];
                        break;
                }
                break;
    
            case 'Battle':
                switch (opcionSeleccion) {
                    case 'Atacar':
                    case 'Habilidad':
                    case 'Objeto':
                        opciones = ['Confirmar', 'Cancelar'];
                        break;
                    case 'Huir':
                        opciones = ['Confirmar Huida', 'Cancelar'];
                        break;
                    default:
                        opciones = ['Cancelar'];
                        break;
                }
                break;
    
            default:
                opciones = ['Cancelar'];
                break;
        }
    
        return opciones;
    }
    
