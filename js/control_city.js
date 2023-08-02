function mostrarSeleccion(opcion) {
    const seleccion = document.getElementById('seleccion');
    const confirmacion = document.getElementById('confirmacion');
    seleccion.style.display = 'block';
    confirmacion.style.display = 'none';

    // Lógica para mostrar las opciones adicionales según lo seleccionado en el menú
    seleccion.innerHTML = ''; // Limpiamos el contenido previo

    if (opcion === 'Mover') {
        seleccion.innerHTML = `
            <div class="opcion" onclick="mostrarConfirmacion('ir a la Tienda')">Tienda</div>
            <div class="opcion" onclick="mostrarConfirmacion('ir al Gremio')">Gremio</div>
            <div class="opcion" onclick="mostrarConfirmacion('ir a la Posada')">Posada</div>
            <div class="opcion" onclick="mostrarConfirmacion('ir al Portal')">Portal</div>
            <div class="opcion" onclick="">Cancelar</div>
        `;
    } else if (opcion === 'Personaje') {
        seleccion.innerHTML = `
            <div class="opcion" onclick="mostrarConfirmacion('Ver estadísticas')">Ver estadísticas</div>
            <div class="opcion" onclick="mostrarConfirmacion('Ver Inventario')">Inventario</div>
        `;
    } else if (opcion === 'Guardar') {
        seleccion.innerHTML = `
            <div class="opcion" onclick="mostrarConfirmacion('Guardar partida')">Guardar partida</div>
            <div class="opcion" onclick="mostrarConfirmacion('Guardar y salir')">Guardar y salir</div>
        `;
    }
}

function mostrarConfirmacion(accion) {
    const confirmacion = document.getElementById('confirmacion');
    confirmacion.style.display = 'block';
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
    seleccion.style.display = 'none';
    confirmacion.style.display = 'none';
}
