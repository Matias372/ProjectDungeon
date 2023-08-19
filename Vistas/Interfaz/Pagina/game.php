<?php
session_start();

// Verificar y manejar la expiración de sesión por inactividad
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > SESSION_EXPIRATION) {
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    header("Location: ../../Vistas/Interfaz/Pagina/inicio_sesion.php?error=sesion_expirada");
    exit();
}
// Verificar si no hay una sesión iniciada
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../sesion/inicio_sesion.php");
    exit();
}

//AGREGA EL MANEJO DE ERRORES.
include('../../../Modelos/Pagina/Errors_display.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Dungeon - Game</title>
    <link rel="stylesheet" href="../../CSS/Pagina/general_estilo.css">
    <link rel="stylesheet" href="../../CSS/Pagina/header_estilo.css">
    <link rel="stylesheet" href="../../CSS/Pagina/footer_estilo.css">
    <link rel="stylesheet" href="../../CSS/Pagina/game_extern_estilo.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../../Controladores/variables_globales.js"></script>
    <script src="../../../Controladores/JuegoRPG/control_partida.js"></script>
    <script src="../../../Controladores/JuegoRPG/guardar_partida.js"></script>
    <script src="../../../Controladores/JuegoRPG/nueva_partida.js"></script>
    <script src="../../../Controladores/JuegoRPG/game.js"></script> <!--SE PASO EL SCRIPT DESDE GAME.PHP a cargar_partida.html-->
    <script src="../../../Controladores/JuegoRPG/cargar_partida.js"></script>
    <script src="../../../Controladores/Pagina/404.js"></script>
    
</head>
<body id= "PageGame">
    
    <!-- Incluir el encabezado -->
    <?php include 'header.php'; ?>

    <!-- Agregar el section "game" -->
    <section class="ext-game">
        <div class="content" id="game-content" data-codigo-id="<?php echo $_SESSION['Id'];?>">
            <!-- Aquí se cargará el contenido del escenario seleccionado -->
            <!-- Por defecto, cargar el menú principal (game.html) -->
            <?php include '../JuegoRPG/game.html'; ?>
        </div>
    </section>

    <!-- Incluir el pie de página -->
    <?php include 'footer.html'; ?>

    <!-- Input oculto para guardar los datos del personaje en formato JSON -->
    <input type="hidden" id="PJData" value=''>

    
</body>
</html>
