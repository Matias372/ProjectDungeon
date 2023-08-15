function goToIndex() {
    window.location.href = "../../index.php";
}

// Obtener el parámetro de la URL
const urlParams = new URLSearchParams(window.location.search);
const error = urlParams.get('error');

// Mostrar el mensaje de error si el parámetro está presente
if (error === 'usuario_existente') {
    mostrarMensajeErrorUsuario();
} else if (error === 'email_existente') {
    mostrarMensajeErrorEmail();
}

// Función para mostrar el mensaje de error de usuario
function mostrarMensajeErrorUsuario() {
    const mensajeErrorUsuario = document.getElementById('mensaje-error-usuario');
    mensajeErrorUsuario.style.display = 'block';
}

// Función para mostrar el mensaje de error de email
function mostrarMensajeErrorEmail() {
    const mensajeErrorEmail = document.getElementById('mensaje-error-email');
    mensajeErrorEmail.style.display = 'block';
}

// Función para cerrar el mensaje de error de usuario
function cerrarMensajeErrorUsuario() {
    const mensajeErrorUsuario = document.getElementById('mensaje-error-usuario');
    mensajeErrorUsuario.style.display = 'none';
}

// Función para cerrar el mensaje de error de email
function cerrarMensajeErrorEmail() {
    const mensajeErrorEmail = document.getElementById('mensaje-error-email');
    mensajeErrorEmail.style.display = 'none';
}

// Detectar cuando se recarga la página
window.addEventListener('beforeunload', function(event) {
    cerrarMensajeErrorUsuario();
    cerrarMensajeErrorEmail();
});
