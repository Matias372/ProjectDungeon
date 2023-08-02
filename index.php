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

        <!-- Primer div -->
        <div>
            <img src="img/Character/NPC_Inn_Icon_M.png" alt="Descripción de la imagen 1" id=im1>
            <p id=in1>Hola Aventurero, bienvenido a "Project Dungeon". Nuestra ciudad es un lugar simple,
                los aventureros como vos vienen por lo mismo, el portal. Si vuelves vivo trae unas monedas
                y te recibire en la posada con una cerveza lista.
            </p>
            
        </div>

        <!-- Segundo div -->
        <div>
            <img src="img/Character/NPC_Shop_Icon_M.png" alt="Descripción de la imagen 2" id=im2>
            <p id=in2>En la ciudad puedes ir a la tienda para ver los equipos disponibles o puedes ir a la posada
                para descansar y comprar suministros. 
            </p>
        </div>

        <!-- Tercer div -->
        <div>
            <img src="img/Character/NPC_Guild_Icon_M.png" alt="Descripción de la imagen 3" id=im3>
            <p id=in3>Recuerda pasar por el gremio para solicitar y entregar misiones.</p>
        </div>

        <!-- Cuarto div -->
        <div>
            <img src="img/Character/Monsters/Goblinrunts_Icon.png" alt="Descripción de la imagen 4" id=im4>
            <p id=in4>¡¡ESPERAMOS QUE TE DIVIERTAS!!</p>
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
