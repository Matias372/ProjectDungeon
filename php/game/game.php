<?php
session_start();

// Verificar si no hay una sesión iniciada
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../sesion/inicio_sesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Dungeon - Game</title>
    <link rel="stylesheet" href="../../css/general_estilo.css">
    <link rel="stylesheet" href="../../css/header_estilo.css">
    <link rel="stylesheet" href="../../css/footer_estilo.css">
    <link rel="stylesheet" href="../../css/game_extern_estilo.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../js/control_partida.js"></script>
    <script src="../../js/nueva_partida.js"></script>
    <script src="../../js/game.js"></script>
    <script src="../../js/cargar_partida.js"></script>
    
</head>
<body id= "PageGame">
    <!-- Incluir el encabezado -->
    <?php include '../../html/header.html'; ?>

    <!-- Agregar el section "game" -->
    <section class="ext-game">
        <div class="content" id="game-content" data-codigo-id="<?php echo $_SESSION['Id'];?>">
            <!-- Aquí se cargará el contenido del escenario seleccionado -->
            <!-- Por defecto, cargar el menú principal (game.html) -->
            <?php include '../../html/game/game.html'; ?>
        </div>
    </section>

    <!-- Incluir el pie de página -->
    <?php include '../../html/footer.html'; ?>

    <!-- Input oculto para guardar los datos del personaje en formato JSON -->
    <input type="hidden" id="PJData" value=''>

    
</body>
</html>
