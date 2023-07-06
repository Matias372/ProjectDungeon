function goToIndex() {
    window.location.href = "../index.html";
}

// Obtener el parámetro de la URL
const urlParams = new URLSearchParams(window.location.search);
const error = urlParams.get('error');

// Mostrar el mensaje de error si el parámetro está presente
if (error === 'usuario_existente') {
    mostrarMensajeError();
}

// Función para mostrar el mensaje de error
function mostrarMensajeError() {
    const mensajeError = document.getElementById('mensaje-error');
    mensajeError.style.display = 'block';
}

// Función para cerrar el mensaje de error
function cerrarMensajeError() {
    const mensajeError = document.getElementById('mensaje-error');
    mensajeError.style.display = 'none';
}

// Detectar cuando se recarga la página
window.addEventListener('beforeunload', function(event) {
    cerrarMensajeError();
});