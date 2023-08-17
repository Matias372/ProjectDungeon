<?php
// Establecer manejadores personalizados de errores y excepciones
set_error_handler('customErrorHandler');
set_exception_handler('customExceptionHandler');

// Función de manejador de errores personalizado
function customErrorHandler($errno, $errstr, $errfile, $errline)
{
    // Asignar niveles de gravedad de errores de PHP a mensajes amigables para el usuario
    $mensajesError = array(
        E_ERROR => '¡Ups! Algo salió mal. Por favor, inténtalo de nuevo más tarde.',
        E_WARNING => '¡Ups! Hubo una advertencia. Por favor, inténtalo de nuevo más tarde.',
        E_PARSE => '¡Ups! Ocurrió un error durante el análisis. Por favor, inténtalo de nuevo más tarde.',
        E_NOTICE => '¡Ups! Hubo una notificación. Por favor, inténtalo de nuevo más tarde.'
       
    );

    // Verificar si el error se encuentra en el arreglo de mensajes de error definidos
    if (array_key_exists($errno, $mensajesError)) {
        // Mostrar el mensaje de error amigable para el usuario con un salto de línea
        echo $mensajesError[$errno] . '<br>';
    } else {
        // Para otros errores no especificados, mostrar un mensaje de error genérico con un salto de línea
        echo '¡Ups! Ocurrió un error. Por favor, inténtalo de nuevo más tarde.' . '<br>';
    }

    // Evitar que PHP maneje el error internamente
    return true;
}

// Función de manejador de excepciones personalizado
function customExceptionHandler($exception)
{
    // Mostrar un mensaje de error genérico al usuario con un salto de línea
    echo '¡Ups! Ocurrió un error inesperado. Por favor, inténtalo de nuevo más tarde.' . '<br>';

    // Registrar la excepción para fines de depuración (opcional)
    error_log($exception);
}
?>
