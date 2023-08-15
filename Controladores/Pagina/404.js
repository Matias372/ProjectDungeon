document.addEventListener("DOMContentLoaded", function() {

    // Verifica si estamos en la página index.php
    const isIndexPage = window.location.pathname.includes('index.php');

    // Obtén todos los enlaces en la página
    const links = document.querySelectorAll("a");
    let validPages = [];
        if(isIndexPage == true){
            validPages = [
                'localhost/Project%20Dungeon/index.php',
                'Vistas/Interfaz/Pagina/footer.html',
                'Vistas/Interfaz/Pagina/header.html',
                'Vistas/Interfaz/Pagina/cuenta.php',
                'Vistas/Interfaz/Pagina/game.php',
                'Vistas/Interfaz/Pagina/inicio_sesion.php',
                'Vistas/Interfaz/Pagina/registro.php',
                'https://opengameart.org/users/justin-nichol',
                'https://www.freepik.es/autor/upklyak',
                'https://www.freepik.es/autor/pikisuperstar',
                'https://game-icons.net',
            ];
        }else{
            validPages = [
                '../../../index.php',//agregar "../" despues, ahora se dejo asi para ver que se tome cambio.
                'footer.html',
                'header.html',
                'cuenta.php',
                'game.php',
                'inicio_sesion.php',
                'registro.php',
                'https://opengameart.org/users/justin-nichol',
                'https://www.freepik.es/autor/upklyak',
                'https://www.freepik.es/autor/pikisuperstar',
                'https://game-icons.net',
            ];
        }

    // Agrega un controlador de clic para cada enlace
    links.forEach(function(link) {
        link.addEventListener("click", function(event) {
            const nextPage = link.getAttribute("href");
            //alert(nextPage);

            if (!validPages.includes(nextPage)) {
                event.preventDefault(); // Evita la redirección

                if(isIndexPage == true){
                    window.location.href = 'Vistas/Interfaz/Pagina/404.html'; // Redirige a la página 404
                }else{
                    window.location.href = '404.html'; // Redirige a la página 404
                }
                
            }
        });
    });
});