<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProjectDungeon</title>
    <link rel="stylesheet" href="css/general_estilo.css">
    <link rel="stylesheet" href="css/index_estilo.css">
    <link rel="stylesheet" href="css/header_estilo.css">
    <link rel="stylesheet" href="css/footer_estilo.css">
</head>
<body>
    <!-- Incluir el encabezado -->
    <?php include 'html/header.html'; ?>

    <!-- Agregar el section "play" -->
    <section id="play">
        <button onclick="playGame()">Play</button>
    </section>

    <!-- Agregar el section "introduccion" -->
    <section id="introduccion">
        <!-- Contenido de la introducción -->
        <h1>Bienvenido a la introducción</h1>
        <p>Texto de introducción del juego...</p>
    </section>

    <!-- Incluir el pie de página -->
    <?php include 'html/footer.html'; ?>

    <script>
    function playGame() {
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { ?>
            window.location.href = "php/game.php";
        <?php } else { ?>
            window.location.href = "php/inicio_sesion.php";
        <?php } ?>
    }
    </script>
</body>
</html>
