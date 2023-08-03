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

    <?php 
    // Definir la variable $isLoggedIn
    $isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    if (!$isLoggedIn) { // Si el usuario NO ha iniciado sesión, mostrar la sección "play" ?>
    <!-- Agregar el section "play" -->
    <section id="play">
        <button onclick="playGame()">Play</button>
    </section>
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
            <img src="img/Character/NPC_Inn.png" alt="Descripción de la imagen 1" id=im1>
            
            
        </div>

        <!-- Segundo div -->
        <div>
            <img src="img/Character/NPC_Shop.png" alt="Descripción de la imagen 2" id=im2>
            <p id=in2>En la ciudad puedes ir a la tienda para ver los equipos disponibles o puedes ir a la posada
                para descansar y comprar suministros. 
            </p>
            <span></span>
        </div>

        <!-- Tercer div -->
        <div>
            <span></span>
            <p id=in3>Recuerda pasar por el gremio para solicitar y entregar misiones.</p>
            <img src="img/Character/NPC_Guild.png" alt="Descripción de la imagen 3" id=im3>
            
        </div>

        <!-- Cuarto div -->
        <div>
            <img src="img/Character/Monsters/Goblinrunts.png" alt="Descripción de la imagen 4" id=im4>
            <p id=in4>¡¡ESPERAMOS QUE TE DIVIERTAS!!</p>
            <span></span>
        </div>
    </section>


    <!-- Incluir el pie de página -->
    <?php include 'html/footer.html'; ?>

    <script>
        
    function playGame() {
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { ?>
            window.location.href = "php/game.php";
        <?php } else { ?>
            window.location.href = "php/sesion/inicio_sesion.php";
        <?php } ?>
    }
    </script>
</body>
</html>
