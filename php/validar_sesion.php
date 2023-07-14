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
    include("conexion.php");

    // Verificar si el usuario existe en la base de datos
    $sql_verificar = "SELECT * FROM usuarios WHERE Email = '$email'";
    $result_verificar = $conn->query($sql_verificar);

    if ($result_verificar->num_rows > 0) {
        // El usuario existe, verificar la contraseña
        $row = $result_verificar->fetch_assoc();
        $hashed_password = $row['Clave'];

        if (password_verify($clave, $hashed_password)) {
            // La contraseña es correcta, iniciar sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['usuario'] = $row['Usuario']; // Almacenar el nombre de usuario en la sesión
            $_SESSION['Codigo_Id'] = $row['Codigo_Id']; // Almacenar el Codigo_Id en la sesión
            $_SESSION['User_Img'] = $row['User_Img']; // Almacenar el User_Img en la sesión
            $_SESSION['Fecha_Creacion'] = $row['Fecha']; // Almacenar la fecha de creación en la sesión

            
            // Redirigir al index.php con la señal de sesión iniciada
            header("Location: ../index.php?sesion_iniciada=true");
            exit();
        } else {
            // La contraseña es incorrecta
            header("Location: ../inicio_sesion.php?error=contraseña_incorrecta");
            exit();
        }
    } else {
        // El usuario no existe
        header("Location: ../inicio_sesion.php?error=usuario_no_encontrado");
        exit();
    }

    // Cerrar la conexión
    $conn->close();
} else {
    // Redirigir al formulario de inicio de sesión si se accede directamente a este archivo
    header("Location: ../inicio_sesion.php");
    exit();
}
?>
