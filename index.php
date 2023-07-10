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
    

    <!-- Agrega esta sección en el cuerpo del archivo index.html -->
    <section id="mensaje-exito" style="display: none;">
        <div class="mensaje">
            <p>Registro exitoso</p>
            <button onclick="cerrarMensaje()">OK</button>
        </div>
    </section>

    <section class="game">
        <!--incluir game.js?-->
        <div class="content">
            <!-- Contenido del div aquí -->
        </div>
    </section>

    <!-- Incluir el pie de página -->
    <?php include '<html/footer.html'; ?>

    <script src="js/index.js"></script>
</body>
</html>
