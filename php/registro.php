<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProjectDungeon</title>
    <link rel="stylesheet" href="../css/general_estilo.css">
    <link rel="stylesheet" href="../css/registro_estilo.css">
</head>
<body>

    <!-- Incluir el encabezado -->
    <header>
        <?php include '../html/header.html'; ?>
    </header>

    <form class="registro-form" action="validar_registro.php" method="POST">
        <h2>Registro</h2>
        <div class="form-group">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" pattern="[a-zA-Z0-9]+" title="Solo se permiten letras y números" required>
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[A-Z]).{8,}" title="La contraseña debe tener al menos 8 caracteres, una mayúscula y un número" required>
        </div>
        <div class="form-buttons">
            <button type="submit">Registrarse</button>
            <button type="button"><a href="../index.php" class="cancel-link">Cancelar</a></button>
        </div>
        <p>O registra con:</p>
        <button type="button" class="google-btn">Google</button>
    </form>

    <section id="mensaje-error-usuario" style="display: none;">
        <div class="mensaje-error">
            <p>El usuario ya está registrado.</p>
            <button onclick="cerrarMensajeErrorUsuario()">OK</button>
        </div>

    </section>

    <section id="mensaje-error-email" style="display: none;">
        <div class="mensaje-error">
            <p>El correo electrónico ya está registrado.</p>
            <button onclick="cerrarMensajeErrorEmail()">OK</button>
        </div>
    </section>

    
    <!-- Incluir el pie de página -->        
    <?php include '../html/footer.html'; ?>

    <script src="../js/registro.js"></script>
</body>
</html>
