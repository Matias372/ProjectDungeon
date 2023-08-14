<?php
session_start();

// Verificar si hay una sesión iniciada
if(!isset($_SESSION['email'])) {
    header("Location: ../../index.php");
    exit();
}
// Incluir el archivo de conexión a la base de datos
include("../conexion.php");

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
            header("Location: Pagina/cuenta.php");
            exit();
        }

        // Generar un nombre de archivo único basado en el tiempo actual y el ID del usuario
        $nombre_uniq = time() . '_' . $_SESSION['Id'] . '_' . $avatar_nombre;

        // Limitar la longitud del nombre de archivo a 145 caracteres
        $nombre_uniq = substr($nombre_uniq, 0, 145);

        // Ruta y nombre del archivo de destino
        $destino = "../../Vistas/Recursos/img/User_Img/" . $nombre_uniq;

        // Redimensionar la imagen a una anchura de 100px
        $anchura_deseada = 100;
        list($ancho, $alto) = getimagesize($avatar_temporal);
        $ratio = $ancho / $alto;
        $altura_deseada = $anchura_deseada / $ratio;

        $imagen_redimensionada = imagecreatetruecolor($anchura_deseada, $altura_deseada);
        $imagen_original = imagecreatefromjpeg($avatar_temporal);
        imagecopyresampled($imagen_redimensionada, $imagen_original, 0, 0, 0, 0, $anchura_deseada, $altura_deseada, $ancho, $alto);

        // Guardar la imagen redimensionada en el destino
        imagejpeg($imagen_redimensionada, $destino);

        // Obtener el nombre de la imagen anterior del usuario
        $email = $_SESSION['email'];
        $sql_obtener_img = "SELECT User_Img FROM usuarios WHERE Email = '$email'";
        $resultado = $conn->query($sql_obtener_img);
        $row = $resultado->fetch_assoc();
        $imagen_anterior = $row['User_Img'];

        // Eliminar la imagen anterior del usuario si existe
        if (!empty($imagen_anterior) && file_exists("../../Vistas/Recursos/img/User_Img/" . $imagen_anterior)) {
            unlink("../../Vistas/Recursos/img/User_Img/" . $imagen_anterior);
        }

        // Actualizar el campo User_Img en la tabla usuarios
        $sql_actualizar = "UPDATE usuarios SET User_Img = '$nombre_uniq' WHERE Email = '$email'";
        $conn->query($sql_actualizar);
        
        // Asignar la nueva imagen como el logo de usuario en $_SESSION['User_Img']
        $_SESSION['User_Img'] = $nombre_uniq;

        // Redirigir de vuelta a la página de cuenta
        header("Location: ../../Vistas/Interfaz/Pagina/cuenta.php");
        exit();
    }
}
?>