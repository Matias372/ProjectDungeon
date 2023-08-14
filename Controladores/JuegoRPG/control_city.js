function mostrarSeleccion(opcion) {
    const seleccion = document.getElementById('seleccion');
    const confirmacion = document.getElementById('confirmacion');
    

    // Lógica para mostrar las opciones adicionales según lo seleccionado en el menú
    seleccion.innerHTML = ''; // Limpiamos el contenido previo

    if (opcion === 'Mover') {
        seleccion.innerHTML = `
            <div style="display: block;" onclick="mostrarConfirmacion('ir a la Tienda')">Tienda</div>
            <div style="display: block;" onclick="mostrarConfirmacion('ir al Gremio')">Gremio</div>
            <div style="display: block;" onclick="mostrarConfirmacion('ir a la Posada')">Posada</div>
            <div style="display: block;" onclick="mostrarConfirmacion('ir al Portal')">Portal</div>
            <div style="display: block;" onclick="cancelarAccion()">Cancelar</div>
        `;
    } else if (opcion === 'Personaje') {
        seleccion.innerHTML = `
            <div style="display: block;" onclick="mostrarConfirmacion('Ver estadísticas')">Ver estadísticas</div>
            <div style="display: block;" onclick="mostrarConfirmacion('Ver Inventario')">Inventario</div>
        `;
    } else if (opcion === 'Guardar') {
        seleccion.innerHTML = `
            <div style="display: block;" onclick="mostrarConfirmacion('Guardar partida')">Guardar partida</div>
            <div style="display: block;" onclick="mostrarConfirmacion('Guardar y salir')">Guardar y salir</div>
        `;
    }
}

function mostrarConfirmacion(accion) {
    const confirmacion = document.getElementById('confirmacion');
    
    confirmacion.innerHTML = `
        <p>¿Quieres ${accion}?</p>
        <button onclick="realizarAccion()">Confirmar</button>
        <button onclick="cancelarAccion()">Cancelar</button>
    `;
}

function realizarAccion() {
    // Aquí se implementaría la lógica para realizar la acción seleccionada
    alert('Acción realizada correctamente.');
    limpiarSecciones();
}

function cancelarAccion() {
    // Aquí se implementaría la lógica para cancelar la acción seleccionada
    alert('Acción cancelada.');
    limpiarSecciones();
}

function limpiarSecciones() {
    const seleccion = document.getElementById('seleccion');
    const confirmacion = document.getElementById('confirmacion');
    
}