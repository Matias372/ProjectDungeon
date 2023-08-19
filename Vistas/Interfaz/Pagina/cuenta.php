<?php
session_start();

// Verificar y manejar la expiración de sesión por inactividad
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > SESSION_EXPIRATION) {
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    header("Location: ../../Vistas/Interfaz/Pagina/inicio_sesion.php?error=sesion_expirada");
    exit();
}
// Verificar si hay una sesión iniciada
if(!isset($_SESSION['email'])) {
    header("Location: ../../../index.php");
    exit();
}
// Incluir el archivo de conexión a la base de datos y lista de logros
include("../../../Modelos/conexion.php");
include("../../../Modelos/Pagina/logros.php");
//AGREGA EL MANEJO DE ERRORES.
include('../../../Modelos/Pagina/Errors_display.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta</title>
    <!-- Agrega aquí tus enlaces a los estilos CSS y otros archivos de JavaScript si es necesario -->
    <link rel="stylesheet" href="../../CSS/Pagina/general_estilo.css">
    <link rel="stylesheet" href="../../CSS/Pagina/header_estilo.css">
    <link rel="stylesheet" href="../../CSS/Pagina/footer_estilo.css">
    <link rel="stylesheet" href="../../CSS/Pagina/cuenta_estilo.css">
    <script src="../../../Controladores/Pagina/404.js"></script>
    
</head>
<body>
    
    <!-- Incluir el archivo header.html -->
    <?php include("header.php"); ?>

    <section class= datos>
    <div>   
            <nav id="imgname">
                <img src="../../Recursos/img/User_Img/<?php echo $_SESSION['User_Img']; ?>" alt="Avatar de usuario">
                <h2><?php echo $_SESSION['usuario']; ?></h2>
            </nav>
            
            <form action="../../../Modelos/Pagina/cambiar_avatar.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="avatar" accept="image/jpeg" required>
                <input type="submit" value="Cambiar avatar">
            </form>
            <?php
            if (isset($_SESSION['error_avatar'])) {
                echo '<p class="error-message">' . $_SESSION['error_avatar'] . '</p>';
                unset($_SESSION['error_avatar']);
            }
            ?>
            <p id="date">Fecha de creación: <?php echo $_SESSION['Fecha_Creacion']; ?></p>
        </div>
    </section>

    <section class="logros">
        <h3>Mis logros</h3>
        <div class="logros-container">
            <?php
            // Obtener los logros del usuario desde la base de datos
            $codigo_id = $_SESSION['Id']; // Obtener el ID del usuario desde la sesión
            $logros_obtenidos = array(); // Array para almacenar los logros obtenidos por el usuario

            // Realizar una consulta a la base de datos para obtener los logros obtenidos por el usuario
            // Aquí debes utilizar tu propia lógica de consulta y conexión a la base de datos
            
            // Ejemplo básico de consulta utilizando mysqli
            $sql = "SELECT Logro_Id FROM usuarios_logros WHERE Id_Usuario = '$codigo_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Iterar sobre los resultados de la consulta y almacenar los logros obtenidos en el array $logros_obtenidos
                while ($row = $result->fetch_assoc()) {
                    $logro_id = $row['Logro_Id'];
                    // Buscar el logro en el array $logros y agregarlo al array $logros_obtenidos
                    foreach ($logros as $logro) {
                        if ($logro['id'] == $logro_id) {
                            $logros_obtenidos[] = $logro;
                            break;
                        }
                    }
                }
            }

            // Iterar sobre los logros obtenidos y mostrar su información
            foreach ($logros_obtenidos as $logro) {
                echo '<div class="logro">';
                echo '<img src="../../Recursos/img/Logros/' . $logro['imagen'] . '" alt="' . $logro['nombre'] . '">';
                echo '<h4>' . $logro['nombre'] . '</h4>';
                echo '<p>' . $logro['descripcion'] . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </section>



    <!-- Incluir el archivo footer.html -->
    <?php include("footer.html"); ?>
</body>
</html>
