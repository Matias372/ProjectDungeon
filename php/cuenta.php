<?php
session_start();

// Verificar si hay una sesión iniciada
if(!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}
// Incluir el archivo de conexión a la base de datos y lista de logros
include("conexion.php");
include("logros.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta</title>
    <!-- Agrega aquí tus enlaces a los estilos CSS y otros archivos de JavaScript si es necesario -->
    <link rel="stylesheet" href="../css/general_estilo.css">
    <link rel="stylesheet" href="../css/header_estilo.css">
    <link rel="stylesheet" href="../css/footer_estilo.css">
</head>
<body>
    <!-- Incluir el archivo header.html -->
    <?php include("../html/header.html"); ?>

    <section class= datos>
        <div>
            <img src="../img/User_Img/<?php echo $_SESSION['User_Img']; ?>" alt="Avatar de usuario">
            <h2><?php echo $_SESSION['usuario']; ?></h2>
            <button>Cambiar avatar</button>
            <p>Fecha de creación: <?php echo $_SESSION['Fecha_Creacion']; ?></p>
            <p>Código ID de la cuenta: <?php echo $_SESSION['Codigo_Id']; ?></p>
        </div>
    </section>

    <section class="logros">
        <h3>Mis logros</h3>
        <div class="logros-container">
            <?php
            // Obtener los logros del usuario desde la base de datos
            $codigo_id = $_SESSION['Codigo_Id']; // Obtener el ID del usuario desde la sesión
            $logros_obtenidos = array(); // Array para almacenar los logros obtenidos por el usuario

            // Realizar una consulta a la base de datos para obtener los logros obtenidos por el usuario
            // Aquí debes utilizar tu propia lógica de consulta y conexión a la base de datos
            
            // Ejemplo básico de consulta utilizando mysqli
            $sql = "SELECT Logro_Id FROM usuarios_logros WHERE Codigo_Usuario = '$codigo_id'";
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
                echo '<img src="../img/' . $logro['imagen'] . '" alt="' . $logro['nombre'] . '">';
                echo '<h4>' . $logro['nombre'] . '</h4>';
                echo '<p>' . $logro['descripcion'] . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </section>



    <!-- Incluir el archivo footer.html -->
    <?php include("../html/footer.html"); ?>
</body>
</html>
