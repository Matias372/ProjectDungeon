<?php
session_start();

// Verificar si hay una sesión iniciada
if(isset($_SESSION['email'])) {
    header("Location: ../../../index.php");
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
    <title>Project Dungeon</title>
    <link rel="stylesheet" href="../../CSS/Pagina/general_estilo.css">
    <link rel="stylesheet" href="../../CSS/Pagina/ini_sesion_estilos.css">
    <link rel="stylesheet" href="../../CSS/Pagina/header_estilo.css">
    <link rel="stylesheet" href="../../CSS/Pagina/footer_estilo.css">
    <script src="../../../Controladores/Pagina/404.js"></script>
</head>
<body>
    
    
    <!-- Incluir el encabezado -->
    
    <?php include 'header.php'; ?>
    

    

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
        } elseif ($error === 'UsuarioBloqueado') {
            echo '<p class="mensaje-error">Usuario bloqueado. Por favor, contacte al administrador.</p>';
        }
    }
    ?>
    
    <form action="../../../Modelos/Pagina/validar_sesion.php" method="POST">
        <h2>Iniciar sesión</h2>
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Iniciar sesión">
        <button type="button"><a href="../../../index.php" class="cancel-link">Cancelar</a></button>
    </form>
    
  
    
    <?php include 'footer.html'; ?>
    

</body>
</html>
