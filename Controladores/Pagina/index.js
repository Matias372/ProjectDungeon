// Obtener el parámetro de la URL para mostrar el mensaje si es necesario
const urlParams = new URLSearchParams(window.location.search);
const mensaje = urlParams.get('mensaje');

// Mostrar el mensaje si el parámetro "mensaje" es "exito"
if (mensaje === 'exito') {
  document.getElementById('mensaje-exito').style.display = 'block';
}

// Función para cerrar el mensaje
function cerrarMensaje() {
  document.getElementById('mensaje-exito').style.display = 'none';
}

// Restablecer el mensaje al recargar la página
window.addEventListener('load', function() {
  if (mensaje === 'exito') {
    history.replaceState({}, document.title, location.pathname);
  }
});
