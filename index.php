<?php
session_start();

// Verificar y manejar la expiración de sesión por inactividad
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > SESSION_EXPIRATION) {
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    header("Location: ../../Vistas/Interfaz/Pagina/inicio_sesion.php?error=sesion_expirada");
    exit();
}

// Verificar si se ha enviado un mensaje de éxito
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : "";

// Mensaje a mostrar si el registro fue exitoso
$mensajeExitoso = "¡Registro exitoso! Puedes iniciar sesión y jugar ahora.";

//CONTROL DE ERRORES.
include('Modelos/Pagina/Errors_display.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Dungeon</title>
    <link rel="stylesheet" href="Vistas/CSS/Pagina/general_estilo.css">
    <link rel="stylesheet" href="Vistas/CSS/Pagina/index_estilo.css">
    <link rel="stylesheet" href="Vistas/CSS/Pagina/header_estilo.css">
    <link rel="stylesheet" href="Vistas/CSS/Pagina/footer_estilo.css">
    <script src="Controladores/Pagina/404.js"></script>
    <script src="Controladores/Pagina/index.js"></script>
</head>
<body>

    
    <!-- Incluir el encabezado -->
    <?php include 'Vistas/Interfaz/Pagina/header.php'; ?>

    <?php 
    // Definir la variable $isLoggedIn
    $isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    if (!$isLoggedIn) { // Si el usuario NO ha iniciado sesión, mostrar la sección "play" ?>
    <!-- Agregar el section "play" -->
    <section id="play">
        <button onclick="playGame()">Play</button>
    </section>
    <?php } ?>

    <?php if ($mensaje === "exito") { ?>
        <div class="mensaje-exito" id="mensaje-exito">
            <p><?php echo $mensajeExitoso; ?></p>
            <button class="cerrar-mensaje" onclick="cerrarMensaje()">Cerrar</button>
        </div>
    <?php } ?>
    
    <!-- Agregar el section "introduccion" -->
    <section id="introduccion">

        

        <!-- Primer div -->
        <div>
            <span></span>
            <p id=in1>Hola Aventurero, bienvenido a "Project Dungeon". Nuestra ciudad es un lugar simple,
                los aventureros como vos vienen por lo mismo, el portal. Si vuelves vivo trae unas monedas
                y te recibire en la posada con una cerveza lista.
            </p>
            <img src="Vistas/Recursos/img/Character/NPC_Inn.png" alt="Descripción de la imagen 1" id=im1>
            
            
        </div>

        <!-- Segundo div -->
        <div>
            <img src="Vistas/Recursos/img/Character/NPC_Shop.png" alt="Descripción de la imagen 2" id=im2>
            <p id=in2>En la ciudad puedes ir a la tienda para ver los equipos disponibles o puedes ir a la posada
                para descansar y comprar suministros. 
            </p>
            <span></span>
        </div>

        <!-- Tercer div -->
        <div>
            <span></span>
            <p id=in3>Recuerda pasar por el gremio para solicitar y entregar misiones.</p>
            <img src="Vistas/Recursos/img/Character/NPC_Guild.png" alt="Descripción de la imagen 3" id=im3>
            
        </div>

        <!-- Cuarto div -->
        <div>
            <img src="Vistas/Recursos/img/Character/Monsters/Goblin runts.png" alt="Descripción de la imagen 4" id=im4>
            <p id=in4>¡¡ESPERAMOS QUE TE DIVIERTAS!!</p>
            <span></span>
        </div>
    </section>


    <!-- Incluir el pie de página -->
    <?php include 'Vistas/Interfaz/Pagina/footer.html'; ?>

    <script> //MODIFICAR========================
        
    function playGame() {
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { ?>
            window.location.href = "Vistas/Interfaz/Pagina/game.php";
        <?php } else { ?>
            window.location.href = "Vistas/Interfaz/Pagina/inicio_sesion.php";
        <?php } ?>
    }
    </script>
</body>
</html>
