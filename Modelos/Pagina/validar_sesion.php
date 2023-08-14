<?php
session_start();

// Inicializar la variable de sesión $_SESSION
$_SESSION = array();

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $clave = $_POST['password'];

    // Incluir el archivo de conexión a la base de datos
    include("../conexion.php");

    // Verificar si el usuario existe en la base de datos
    $sql_verificar = "SELECT * FROM usuarios WHERE Email = '$email'";
    $result_verificar = $conn->query($sql_verificar);

    if ($result_verificar->num_rows > 0) {
        // El usuario existe, verificar la contraseña y el estado
        $row = $result_verificar->fetch_assoc();
        $hashed_password = $row['Clave'];
        $estado = $row['Estado'];

        if (password_verify($clave, $hashed_password)) {
            if ($estado === "BLOQUEADO") {
                // Si el estado del usuario es "BLOQUEADO", cancelar la sesión y redirigir con un mensaje de error
                error_log('Usuario bloqueado');
                header("Location: ../../Vistas/Interfaz/Pagina/inicio_sesion.php?error=UsuarioBloqueado");
                exit();
            }

            // La contraseña es correcta y el usuario no está bloqueado, iniciar sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['usuario'] = $row['Usuario']; // Almacenar el nombre de usuario en la sesión
            $_SESSION['Id'] = $row['Id']; // Almacenar el Codigo_Id en la sesión
            $_SESSION['User_Img'] = $row['User_Img']; // Almacenar el User_Img en la sesión
            $_SESSION['Fecha_Creacion'] = $row['Fecha']; // Almacenar la fecha de creación en la sesión

            // Redirigir al index.php con la señal de sesión iniciada
            header("Location: ../../index.php?sesion_iniciada=true");
            exit();
        } else {
            // La contraseña es incorrecta
            error_log('contraseña incorrecta');
            header("Location: ../../Vistas/Interfaz/Pagina/inicio_sesion.php?error=contraseña_incorrecta");
            exit();
        }
    } else {
        // El usuario no existe
        error_log('Usuario no encontrado.');
        header("Location: ../../Vistas/Interfaz/Pagina/inicio_sesion.php?error=usuario_no_encontrado");
        exit();
    }

    // Cerrar la conexión
    $conn->close();
} else {
    // Redirigir al formulario de inicio de sesión si se accede directamente a este archivo
    error_log('se redirige directo a inicio_sesion.php');
    header("Location: ../../Vistas/Interfaz/Pagina/inicio_sesion.php");
    exit();
}
?>
