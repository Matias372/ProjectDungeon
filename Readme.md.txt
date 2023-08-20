Estructura MVC:

está diseñado con una arquitectura Modelo-Vista-Controlador (MVC). 
La lógica se divide en tres partes principales: Modelo, Vista y Controlador

Comenzando desde index.php, muestra una presentación del proyecto, en la parte superior se encuentra el header.php, 
mostrando el icono y nombre del proyecto a la izq y las opciones de inicio de sesión y registro, (cuando se inicia sesión cambia el header). 
En la parte inferior está el footer.html mostrando las atribuciones, “sobre nosotros” y redes sociales, actualmente solo están links básicos en redes sociales.

Tanto en inicio de sesión como en registro aparece un formulario que al completarlo va al archivo validar correspondiente, (validar_sesion.php, validar_registro.php), 
en estos momentos el manejo de de datos se manejó con “query” ya que se estaba revisando pasos por pasos. En los archivos guardar_partida.php y cargar_partida.php se usa “mysqli_stmt_bind_param”. 
(una vez que ordene unos detalles y errores relacionados con el comienzo del juego, se acomodara el código para usar un mismo método)

Cada vez que se cambia de URL el archivo 404.js se encarga de verificar que sea uno de los archivos validos sino carga directamente el archivo 404.html.
Una vez iniciada la sesión se puede acceder a cuenta.php, a través del menú desplazable en el nombre de usuario, donde podrá ver los detalles de usuario
como nombre, imagen, fecha de creación de cuenta y los logros obtenidos. 

también da la opción de cerrar sesión e ir a lista en el menú desplazable del nombre de usuario, 
que actualmente “lista” está sin un link correcto para ocasionar que el sistema te mande a 404.html.
el botón “PLAY” se modifica, si no esta la sesión activa te manda directo a iniciar sesión, en cambio si la sesión esta activa te redirige a game.php donde te muestra el escenario del juego. 
Donde se puede comenzar a jugar el juego.

game.php tiene varios JS ya que maneja la mayor parte del juego cuando se relaciona con los datos de  BD.






