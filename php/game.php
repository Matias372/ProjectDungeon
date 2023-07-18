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
    <link rel="stylesheet" href="../css/nueva_partida_estilo.css"> <!-- Agregamos el nuevo CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Incluir el encabezado -->
    <?php include '../html/header.html'; ?>

    <!-- Agregar el section "game" -->
    <section class="game">
        <div class="content" id="game-content">
            <!-- Contenido del juego -->
            <iframe src="../html/game.html" frameborder="0" width="100%" height="100%"></iframe>
        </div>
    </section>

    <!-- Incluir el pie de página -->
    <?php include '../html/footer.html'; ?>

    <!-- Script para escuchar los mensajes enviados desde el iframe -->
    <script>
        // Escuchar los mensajes enviados desde el iframe
        window.addEventListener('message', function(event) {
            if (event.data === 'redirigirNuevaPartida') {
                redirigirNuevaPartida();
            } else if (event.data === 'cargarPartida') {
                cargarPartida();
            }
        });

        // Manejar el redireccionamiento a nueva_partida.html
        function redirigirNuevaPartida() {
            console.log('Se ha llamado a la función redirigirNuevaPartida.');
            $.get("../html/nueva_partida.html", function(data) {
                $('#game-content').html(data);
            });
        }

        // Manejar la carga de partida
        function cargarPartida() {
            console.log('Se ha llamado a la función cargarPartida.');
            // Agrega aquí la lógica para cargar una partida existente
        }
    </script>

    <!-- Incluimos el script game.js -->
    <script src="../js/game.js"></script>

    <!-- Script para manejar la selección de clase y la creación del personaje -->
    <script>
        // ... Código anterior de la función seleccionarClase() ...

        // Cambiar la función crearPersonaje() por Create_newgame()
        function Create_newgame() {
            // ... Código anterior de la función Create_newgame() ...
        }
    </script>
</body>
</html>

