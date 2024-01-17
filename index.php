<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style4.css">
    <title>Iniciar sesión</title>
</head>

<body class="form">
    <div class="formulario">
        <form action="./validaciones/validar.php" method="post">
            <?php
            if (isset($_GET['mensaje'])) {
                echo "<p style='color: red; text-align: center;'>" . $_GET['mensaje'] . "</p>";
            }
            ?>
            <h2 class="h21">Inicio de sesión</h2>

            <label for="" class="label1">Correo electronico<?php if (isset($_GET['emailVacio'])) {
                                                                echo "*";
                                                            } ?>:</label>
            <?php if (isset($_GET['emailMal'])) {
                echo "<br><label style='color: red; text-align: center;'>Ingresa un usuario válido</label>";
            } ?>
            <p><input type="email" name="email" value="<?php if (isset($_GET['email'])) {
                                                            echo $_GET['email'];
                                                        } ?>"></p>

            <label for="" class="label1">Contraseña<?php if (isset($_GET['pwdVacio'])) {
                                                        echo "*";
                                                    } ?>:</label>

            <?php if (isset($_GET['pwdCorto'])) {
                echo "<br><label style='color: red'>Ingresa 9 o más caracteres</label>";
            } ?>
            <?php if (isset($_GET['pwdMal'])) {
                echo "<br><label style='color: red'>Ingresa solo letras o números</label>";
            } ?>
            <p><input type="password" id="pwd" name="pwd" value="<?php if (isset($_GET['pwd'])) {
                                                                        echo $_GET['pwd'];
                                                                    } ?>"></p>

            <button name="enviar" value="1" class="buttonF">Enviar</button>
            <a href="./registro.php" class="buttonG">Registrarse</a>
        </form>

    </div>
    <br>

</body>

</html>