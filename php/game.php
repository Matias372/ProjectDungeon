<?php
session_start();

// Verificar si no hay una sesión iniciada
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: inicio_sesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <link rel="stylesheet" href="../css/general_estilo.css">
    <link rel="stylesheet" href="../css/header_estilo.css">
    <link rel="stylesheet" href="../css/footer_estilo.css">
    <link rel="stylesheet" href="../css/game_extern_estilo.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/game_scripts.js"></script>

    
</head>
<body>
    <!-- Incluir el encabezado -->
    <?php include '../html/header.html'; ?>

    <!-- Agregar el section "game" -->
    <section class="game">
        <div class="content" id="game-content">
            <!-- Aquí se cargará el contenido del escenario seleccionado -->
        </div>
    </section>

    <!-- Incluir el pie de página -->
    <?php include '../html/footer.html'; ?>

    
    
</body>
</html>
