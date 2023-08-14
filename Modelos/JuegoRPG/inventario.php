<?php
session_start(); // Asegurarse de que la sesión esté iniciada


include "../game/Objetos.php"; // Incluye tu archivo de objetos



// Función para obtener el inventario de un usuario
function obtenerInventario($codigoId, $conn) {
    global $objetos; // Acceso a la variable $objetos definida en Objetos.php

    $query = "SELECT * FROM inventarios WHERE Usuario_id = '$codigoId'";
    $result = $conn->query($query);
    $inventario = array(); // Aquí almacenaremos la información de cada objeto en el inventario

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $objeto_id = $row['Objeto_id']; // ID del objeto en la fila actual
            $cantidad = $row['Cantidad'];   // Cantidad del objeto en el inventario
            $tipo = $row['Tipo']; 
    
            // Usamos el ID del objeto para acceder a la información definida en Objetos.php
            $infoObjeto = $objetos[$objeto_id]; 
    
            // Creamos un array con la información del objeto y la cantidad
            $objetoEnInventario = array(
                'objeto' => $infoObjeto,
                'cantidad' => $cantidad,
                'tipo' => $tipo
            );
    
            // Agregamos el objeto al array del inventario
            $inventario[] = $objetoEnInventario;
        }
    }
    
    return $inventario; // Devolvemos el array con la información del inventario
}

// Función para agregar un objeto al inventario de un usuario
function agregarObjeto($codigoId, $objeto_id, $cantidad, $conn) {
    global $objetos;

    // Verifica si el objeto ya existe en el inventario
    $query = "SELECT * FROM Inventarios WHERE usuario_id = '$codigoId' AND objeto_id = '$objeto_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Si el objeto ya existe, actualiza la cantidad
        $query = "UPDATE Inventarios SET cantidad = cantidad + '$cantidad' WHERE usuario_id = '$codigoId' AND objeto_id = '$objeto_id'";
        $conn->query($query);
    } else {
        // Si el objeto no existe, agrega una nueva fila al inventario
        $query = "INSERT INTO Inventarios (usuario_id, objeto_id, cantidad) VALUES ('$codigoId', '$objeto_id', '$cantidad')";
        $conn->query($query);
    }
}

// Función para quitar un objeto del inventario de un usuario
function quitarObjeto($codigoId, $objeto_id, $cantidad, $conn) {
    // Verifica si el objeto existe en el inventario
    $query = "SELECT * FROM Inventarios WHERE usuario_id = '$codigoId' AND objeto_id = '$objeto_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $objetoCantidadActual = $row['cantidad'];

        if ($cantidad >= $objetoCantidadActual) {
            // Si la cantidad a quitar es mayor o igual a la cantidad actual, elimina la fila del inventario
            $deleteQuery = "DELETE FROM Inventarios WHERE usuario_id = '$codigoId' AND objeto_id = '$objeto_id'";
            $conn->query($deleteQuery);
        } else {
            // Si la cantidad a quitar es menor, actualiza la cantidad
            $updateQuery = "UPDATE Inventarios SET cantidad = cantidad - '$cantidad' WHERE usuario_id = '$codigoId' AND objeto_id = '$objeto_id'";
            $conn->query($updateQuery);
        }
    }
}


// ... otras funciones para actualizar y eliminar objetos en el inventario

?>
