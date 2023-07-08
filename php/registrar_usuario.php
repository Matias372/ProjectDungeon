<?php
// Incluir el archivo de conexión a la base de datos
include("conexion.php");

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['username'];
    $email = $_POST['email'];
    $clave = $_POST['password'];

    // Verificar si el usuario ya existe en la base de datos
    $sql_verificar = "SELECT * FROM usuarios WHERE Email = '$email'";
    $result_verificar = $conn->query($sql_verificar);

    if ($result_verificar->num_rows > 0) {
        // El usuario ya está registrado
        header("Location: registro.html?error=usuario_existente");
        exit();
    } else {
        // Insertar los datos en la base de datos
        $sql_insertar = "INSERT INTO usuarios (Usuario, Email, Clave) VALUES ('$usuario', '$email', '$clave')";
        
        if ($conn->query($sql_insertar) === TRUE) {
            header("Location: ../index.html?mensaje=exito");
            exit();
        } else {
            echo "Error al registrar: " . $conn->error;
        }
    }
}

// Cerrar la conexión
$conn->close();
?>


