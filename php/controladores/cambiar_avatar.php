<?php
session_start();

// Verificar si hay una sesión iniciada
if(!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}
// Incluir el archivo de conexión a la base de datos
include("conexion.php");

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha seleccionado una imagen
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        // Obtener la información de la imagen subida
        $avatar = $_FILES['avatar'];
        $avatar_nombre = $avatar['name'];
        $avatar_temporal = $avatar['tmp_name'];

        // Verificar el tipo de imagen (solo se permite JPEG)
        $imagen_info = getimagesize($avatar_temporal);
        $imagen_tipo = $imagen_info['mime'];
        if ($imagen_tipo !== 'image/jpeg') {
            $_SESSION['error_avatar'] = 'Solo se permiten imágenes JPEG (JPG).';
            header("Location: cuenta.php");
            exit();
        }

        // Ruta y nombre del archivo de destino
        $destino = "../img/User_Img/" . $avatar_nombre;

        // Redimensionar la imagen a una anchura de 50px
        $anchura_deseada = 100;
        list($ancho, $alto) = getimagesize($avatar_temporal);
        $ratio = $ancho / $alto;
        $altura_deseada = $anchura_deseada / $ratio;

        $imagen_redimensionada = imagecreatetruecolor($anchura_deseada, $altura_deseada);
        $imagen_original = imagecreatefromjpeg($avatar_temporal);
        imagecopyresampled($imagen_redimensionada, $imagen_original, 0, 0, 0, 0, $anchura_deseada, $altura_deseada, $ancho, $alto);

        // Guardar la imagen redimensionada en el destino
        imagejpeg($imagen_redimensionada, $destino);

        // Actualizar el campo User_Img en la tabla usuarios
        $email = $_SESSION['email'];
        $sql_actualizar = "UPDATE usuarios SET User_Img = '$avatar_nombre' WHERE Email = '$email'";
        $conn->query($sql_actualizar);
        
        // Asignar la nueva imagen como el logo de usuario en $_SESSION['User_Img']
        $_SESSION['User_Img'] = $avatar_nombre;

        // Redirigir de vuelta a la página de cuenta
        header("Location: ../sesion/cuenta.php");
        exit();
    }
}
?>
