<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Dungeon</title>
    <link rel="stylesheet" href="../css/general_estilo.css">
    <link rel="stylesheet" href="../css/ini_sesion_estilos.css">
    <link rel="stylesheet" href="../css/header_estilo.css">
    <link rel="stylesheet" href="../css/footer_estilo.css">
</head>
<body>

    <!-- Incluir el encabezado -->
    
    <?php include '../html/header.html'; ?>
    

    <h2>Iniciar sesión</h2>

    <?php
    // Verificar si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los mensajes de error, si existen
        $error = $_GET['error'] ?? '';
        
        // Mostrar el mensaje de error correspondiente
        if ($error === 'contraseña_incorrecta') {
            echo '<p class="mensaje-error">La contraseña es incorrecta.</p>';
        } elseif ($error === 'usuario_no_encontrado') {
            echo '<p class="mensaje-error">El usuario no ha sido encontrado.</p>';
        }
    }
    ?>
    
    <form action="validar_sesion.php" method="POST">
      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" required><br><br>
      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required><br><br>
      <input type="submit" value="Iniciar sesión">
    </form>
    <a href="../index.php" class="cancel-link">Cancelar</a>
  
    <header>
        <?php include '../html/footer.html'; ?>
    </header>

</body>
</html>