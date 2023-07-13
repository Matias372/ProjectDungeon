<?php
// Incluir el archivo de conexión a la base de datos
include("conexion.php");
include("GetRandCod.php");

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['username'];
    $email = $_POST['email'];
    $clave = $_POST['password'];
    
    // Obtener la ruta de la imagen
    $user_img = "Logo_sesion.png";

    // Obtener el código aleatorio llamando a GetRandCod()
    $codid = GetRandCod();

    // Verificar si el usuario ya existe en la base de datos por nombre de usuario
    $sql_verificar_usuario = "SELECT * FROM usuarios WHERE Usuario = '$usuario'";
    $result_verificar_usuario = $conn->query($sql_verificar_usuario);

    // Verificar si el usuario ya existe en la base de datos por correo electrónico
    $sql_verificar_email = "SELECT * FROM usuarios WHERE Email = '$email'";
    $result_verificar_email = $conn->query($sql_verificar_email);

    if ($result_verificar_usuario->num_rows > 0) {
        // El nombre de usuario ya está registrado
        header("Location: registro.php?error=usuario_existente");
        exit();
    } elseif ($result_verificar_email->num_rows > 0) {
        // El correo electrónico ya está registrado
        header("Location: registro.php?error=email_existente");
        exit();
    } else {
        // Generar el hash de la clave
        $hashed_clave = password_hash($clave, PASSWORD_DEFAULT);

        // Insertar los datos en la base de datos con la clave hash y el código aleatorio
        $sql_insertar = "INSERT INTO usuarios (Usuario, Email, Clave, Codigo_Id, User_Img) VALUES ('$usuario', '$email', '$hashed_clave', '$codid', '$user_img')";

        if ($conn->query($sql_insertar) === TRUE) {
            header("Location: ../index.php?mensaje=exito");
            exit();
        } else {
            echo "Error al registrar: " . $conn->error;
        }
    }
}

// Cerrar la conexión
$conn->close();
?>

