<header>
    <?php
    // Verificar si hay una sesión iniciada
    if (isset($_SESSION['usuario'])) {
        $username = $_SESSION['usuario'];
        $Image = $_SESSION['User_Img'];
    ?>
    
    <div class="logo">
        <?php if (basename($_SERVER['PHP_SELF']) === 'index.php'): ?>
            <a href="index.php"><img src="Vistas/Recursos/img/NewLogo-01.png" alt="Logo de la empresa" id= "logimg"></a>
            <a href="index.php"><img src="Vistas/Recursos/img/Name_log.png" alt="Logo de la empresa" id= "lognam"></a>
        <?php else: ?>
            <a href="../../../index.php"><img src="../../Recursos/img/NewLogo-01.png" alt="Logo de la empresa" id= "logimg"></a>
            <a href="../../../index.php"><img src="../../Recursos/img/Name_log.png" alt="Logo de la empresa" id= "lognam"></a>
        <?php endif; ?>
    </div>
    
    
    <nav>
        <ul>
            <li class="user-dropdown">
                <div class="user-avatar">
                    <?php if (basename($_SERVER['PHP_SELF']) === 'index.php'): ?>
                        <img src="Vistas/Recursos/img/User_img/<?php echo $Image?>" alt="Avatar de usuario">
                    <?php else: ?>
                        <img src="../../Recursos/img/User_img/<?php echo $Image?>" alt="Avatar de usuario">
                    <?php endif; ?>
                </div>
                <div class="user-info">
                    <div class="username"><?php echo $username; ?></div>
                    <div class="dropdown-content">
                        <ul>
                            <?php if (basename($_SERVER['PHP_SELF']) === 'index.php'): ?>
                                <li><a href="Vistas/Interfaz/Pagina/Clasificaciones.php">Lista</a></li>
                                <li><a href="Vistas/Interfaz/Pagina/cuenta.php">Cuenta</a></li>
                                <li><a href="Modelos/Pagina/logout.php">Salir</a></li>
                            <?php else: ?>
                                <li><a href="Clasificaciones.php">Lista</a></li>
                                <li><a href="cuenta.php">Cuenta</a></li>
                                <li><a href="../../../Modelos/Pagina/logout.php">Salir</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="play-link"> <!-- Agrega una nueva lista para el enlace "Play" -->
                <?php if (basename($_SERVER['PHP_SELF']) === 'index.php'): ?>
                    <a href="Vistas/Interfaz/Pagina/game.php" id="play-boton">Play</a>
                <?php else: ?>
                    <a href="game.php" id="play-boton">Play</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
    <?php } else { ?>
        <div class="logo">
            <?php if (basename($_SERVER['PHP_SELF']) === 'index.php'): ?>
                <a href="index.php"><img src="Vistas/Recursos/img/NewLogo-01.png" alt="Logo de la empresa" id= "logimg"></a>
                <a href="index.php"><img src="Vistas/Recursos/img/Name_log.png" alt="Logo de la empresa" id= "lognam"></a>
            <?php else: ?>
                <a href="../../../index.php"><img src="../../Recursos/img/NewLogo-01.png" alt="Logo de la empresa" id= "logimg"></a>
                <a href="../../../index.php"><img src="../../Recursos/img/Name_log.png" alt="Logo de la empresa" id= "lognam"></a>
            <?php endif; ?>
        </div>
        
        

        <nav>
            <ul>
                <?php if (basename($_SERVER['PHP_SELF']) === 'index.php'): ?>
                    <li class="login-link"><a href="Vistas/Interfaz/Pagina/inicio_sesion.php">Iniciar sesión</a></li>
                    <li class="register-link"><a href="Vistas/Interfaz/Pagina/registro.php">Registrarse</a></li>
                <?php else: ?>
                    <li class="login-link"><a href="inicio_sesion.php">Iniciar sesión</a></li>
                    <li class="register-link"><a href="registro.php">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php } ?>
</header>
