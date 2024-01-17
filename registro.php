<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style4.css">
    <title>Registrarse</title>
</head>

<body class="form">
    <div class="formulario2">
        <form action="validaciones/validar.php" method="post">
            <h2 class="h21">Registrarse</h2>
            <?php
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo '<p style="color: red; text-align: center;"> Usuario ya existe.</p>';
            } ?>
            <label for="" class="label1">Telefono<?php if (isset($_GET['numeroVacio'])) {
                                                        echo "*";
                                                    } ?>:</label>
            <?php if (isset($_GET['numeroMal'])) {
                echo "<br><label style='color: red'>Incresa un telefono valido</label>";
            } ?>
            <p><input type="text" name="num" value="<?php if (isset($_GET['num'])) {
                                                        echo $_GET['num'];
                                                    } ?>"></p>

            <label for="" class="label1">Nombre de Usuario<?php if (isset($_GET['usernameVacio'])) {
                                                                echo "*";
                                                            } ?>:</label>
            <?php if (isset($_GET['usernameMal'])) {
                echo "<br><label style='color: red'>Incresa un usuario valido</label>";
            } ?>
            <p><input type="text" name="user" value="<?php if (isset($_GET['user'])) {
                                                            echo $_GET['user'];
                                                        } ?>"></p>

            <label for="" class="label1">Nombre<?php if (isset($_GET['nombreVacio'])) {
                                                    echo "*";
                                                } ?>:</label>
            <?php if (isset($_GET['nombreMal'])) {
                echo "<br><label style='color: red'>Incresa un nombre valido</label>";
            } ?>
            <p><input type="text" name="nom" value="<?php if (isset($_GET['nom'])) {
                                                        echo $_GET['nom'];
                                                    } ?>"></p>


            <label for="" class="label1">Apellidos<?php if (isset($_GET['cognomVacio'])) {
                                                        echo "*";
                                                    } ?>:</label>
            <?php if (isset($_GET['cognomMal'])) {
                echo "<br><label style='color: red'>Incresa un apellido valido</label>";
            } ?>
            <p><input type="text" name="cognom" value="<?php if (isset($_GET['cognom'])) {
                                                            echo $_GET['cognom'];
                                                        } ?>"></p>


            <label for="" class="label1">Correo electronico<?php if (isset($_GET['emailVacio'])) {
                                                                echo "*";
                                                            } ?>:</label>
            <?php if (isset($_GET['emailMal'])) {
                echo "<br><label style='color: red'>Incresa un usuario valido</label>";
            } ?>
            <p><input type="email" name="email" value="<?php if (isset($_GET['email'])) {
                                                            echo $_GET['email'];
                                                        } ?>"></p>


            <label for="" class="label1">Contraseña<?php if (isset($_GET['pwdVacio'])) {
                                                        echo "*";
                                                    } ?>:</label>
            <?php if (isset($_GET['pwdCorto'])) {
                echo "<br><label style='color: red'>Incresa 9 o mas caracateres</label>";
            } ?>
            <?php if (isset($_GET['pwdMal'])) {
                echo "<br><label style='color: red'>Incresa solo letras o números</label>";
            } ?>
            <p><input type="password" name="pwd" value="<?php if (isset($_GET['pwd'])) {
                                                            echo $_GET['pwd'];
                                                        } ?>"></p>

            <label for="" class="labelIn"></label>
            <button type="submit" name="enviar" value="2" class="buttonF">Enviar</button>
        </form>
        <a href="./index.php" class="buttonG">Iniciar sesion</a>

    </div>
</body>

</html>