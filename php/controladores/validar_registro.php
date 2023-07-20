<?php
// Incluir el archivo de conexión a la base de datos
include("../sesion/conexion.php");
include("GetRandCod.php");

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['username'];
    $email = $_POST['email'];
    $clave = $_POST['password'];
    
    // Obtener la ruta de la imagen
    $user_img = "Logo_sesion.png";

    // Verificar si el usuario ya existe en la base de datos por nombre de usuario
    $sql_verificar_usuario = "SELECT * FROM usuarios WHERE Usuario = '$usuario'";
    $result_verificar_usuario = $conn->query($sql_verificar_usuario);

    // Verificar si el usuario ya existe en la base de datos por correo electrónico
    $sql_verificar_email = "SELECT * FROM usuarios WHERE Email = '$email'";
    $result_verificar_email = $conn->query($sql_verificar_email);

    if ($result_verificar_usuario->num_rows > 0) {
        // El nombre de usuario ya está registrado
        header("Location: ../sesion/registro.php?error=usuario_existente");
        exit();
    } elseif ($result_verificar_email->num_rows > 0) {
        // El correo electrónico ya está registrado
        header("Location: ../sesion/registro.php?error=email_existente");
        exit();
    } else {
        // Generar un UUID para el "Id" del usuario
        $id = generateUUID();

        // Generar el hash de la clave
        $hashed_clave = password_hash($clave, PASSWORD_DEFAULT);

        // Insertar los datos del usuario en la base de datos con la clave hash y el UUID
        $sql_insertar_usuario = "INSERT INTO usuarios (Id, Usuario, Email, Clave, User_Img) VALUES ('$id', '$usuario', '$email', '$hashed_clave', '$user_img')";

        if ($conn->query($sql_insertar_usuario) === TRUE) {
            // Insertar un nuevo registro en la tabla usuarios_logros
            $logro_id = 1; // ID del logro a insertar
            $sql_insertar_logro = "INSERT INTO usuarios_logros (Id_usuario, Logro_Id) VALUES ('$id', '$logro_id')";
            
            if ($conn->query($sql_insertar_logro) === TRUE) {
                header("Location: ../../index.php?mensaje=exito");
                exit();
            } else {
                echo "Error al insertar el logro: " . $conn->error;
            }
        } else {
            echo "Error al registrar: " . $conn->error;
        }
    }
}

// Cerrar la conexión
$conn->close();
?>
