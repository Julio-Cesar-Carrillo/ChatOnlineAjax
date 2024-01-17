<?php
if (!filter_has_var(INPUT_POST, 'enviar')) {
    header('Location: ../index.php');
    exit();
} else {

    include_once('./funciones.php');
    include_once("../conexion/conexion.php");
    $enviar = $_POST['enviar'];

    $errores = "";

    if ($enviar == 1) {
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];

        if (validaCampoVacio($email)) {
            if (!$errores) {
                $errores .= "?emailVacio=true";
            } else {
                $errores .= "&emailVacio=true";
            }
        } else {
            if (!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
                if (!$errores) {
                    $errores .= "?emailMal=true";
                } else {
                    $errores .= "&emailMal=true";
                }
            }
        }

        if (validaCampoVacio($pwd)) {
            if (!$errores) {
                $errores .= "?pwdVacio=true";
            } else {
                $errores .= "&pwdVacio=true";
            }
        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $pwd)) {
            if (!$errores) {
                $errores .= "?pwdMal=true";
            } else {
                $errores .= "&pwdMal=true";
            }
        } else if (strlen($pwd) < 9) {
            if (!$errores) {
                $errores .= "?pwdCorto=true";
            } else {
                $errores .= "&pwdCorto=true";
            }
        }
        if ($errores != "") {

            $datosRecibidos = array(
                'email' => $email,
                'pwd' => $pwd
            );
            $datosDevueltos = http_build_query($datosRecibidos);
            header("Location: ../index.php" . $errores . "&" . $datosDevueltos);
            exit();
        } else {
            $consulta = $pdo->prepare("SELECT * FROM tbl_user WHERE email_user = :email");
            $consulta->bindParam(":email", $email);
            $consulta->execute();

            $row = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($row && password_verify($pwd, $row['pwd_user'])) {
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['user'] = $row['user_user'];
                header('Location: ../perfil.php');
                exit();
            } else {
                $mensaje = "El usuario o la contraseña son incorrectos.";
                header("Location: ../index.php?error=login_failed&mensaje=" . urlencode($mensaje));
                exit();
            }
        }
    } elseif ($enviar == 2) {
        $num = $_POST['num'];
        $user = $_POST['user'];
        $nom = $_POST['nom'];
        $cognom = $_POST['cognom'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];

        // Comprobar que los campos no esten vacios

        if (validaCampoVacio($num)) {
            if (!$errores) {
                $errores .= "?numeroVacio=true";
            } else {
                $errores .= "&numeroVacio=true";
            }
        } else {
            if (strlen($num) !== 9) {
                if (!$errores) {
                    $errores .= "?numeroMal=true";
                } else {
                    $errores .= "&numeroMal=true";
                }
            }
        }

        if (validaCampoVacio($user)) {
            if (!$errores) {
                $errores .= "?usernameVacio=true";
            } else {
                $errores .= "&usernameVacio=true";
            }
        } else {
            if (!preg_match("/^[a-zA-Z0-9]*$/", $user)) {
                if (!$errores) {
                    $errores .= "?usernameMal=true";
                } else {
                    $errores .= "&usernameMal=true";
                }
            }
        }

        if (validaCampoVacio($nom)) {
            if (!$errores) {
                $errores .= "?nombreVacio=true";
            } else {
                $errores .= "&nombreVacio=true";
            }
        } else {
            if (!preg_match("/^[a-z A-Z]*$/", $nom)) {
                if (!$errores) {
                    $errores .= "?nombreMal=true";
                } else {
                    $errores .= "&nombreMal=true";
                }
            }
        }

        if (validaCampoVacio($cognom)) {
            if (!$errores) {
                $errores .= "?cognomVacio=true";
            } else {
                $errores .= "&cognomVacio=true";
            }
        } else {
            if (!preg_match("/^[a-z A-Z]*$/", $cognom)) {
                if (!$errores) {
                    $errores .= "?cognomMal=true";
                } else {
                    $errores .= "&cognomMal=true";
                }
            }
        }

        if (validaCampoVacio($email)) {
            if (!$errores) {
                $errores .= "?emailVacio=true";
            } else {
                $errores .= "&emailVacio=true";
            }
        } else {
            if (!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
                if (!$errores) {
                    $errores .= "?emailMal=true";
                } else {
                    $errores .= "&emailMal=true";
                }
            }
        }

        if (validaCampoVacio($pwd)) {
            if (!$errores) {
                $errores .= "?pwdVacio=true";
            } else {
                $errores .= "&pwdVacio=true";
            }
        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $pwd)) {
            if (!$errores) {
                $errores .= "?pwdMal=true";
            } else {
                $errores .= "&pwdMal=true";
            }
        } else if (strlen($pwd) < 9) {
            if (!$errores) {
                $errores .= "?pwdCorto=true";
            } else {
                $errores .= "&pwdCorto=true";
            }
        }
        if ($errores != "") {

            $datosRecibidos = array(
                'num' => $num,
                'user' => $user,
                'nom' => $nom,
                'cognom' => $cognom,
                'email' => $email,
                'pwd' => $pwd
            );
            $datosDevueltos = http_build_query($datosRecibidos);
            header("Location: ../registro.php" . $errores . "&" . $datosDevueltos);
            exit();
        } else {
            // Recoger datos del formulario
            $num = $_POST['num'];
            $user = $_POST['user'];
            $nom = $_POST['nom'];
            $cognom = $_POST['cognom'];
            $email = $_POST['email'];
            $pwd = $_POST['pwd'];
            // Encriptar la contraseña con BCRYPT
            $opciones = [
                'cost' => 12,
            ];
            $pwdencrip = password_hash($pwd, PASSWORD_BCRYPT, $opciones);
            // Comprobar si existe
            $consulta2 = $pdo->prepare("SELECT * FROM tbl_user WHERE num_telf_user = :num");
            $consulta2->bindParam(':num', $num);
            $consulta2->execute();

            if ($consulta2->rowCount() < 1) {
                // Insertar al usuario
                $consulta = $pdo->prepare("INSERT INTO tbl_user (num_telf_user, user_user, nom_user,cognom_user,email_user,pwd_user) VALUES (:num, :user, :nom,:cognom,:email,:pwd)");
                $consulta->bindParam(":num", $num);
                $consulta->bindParam(":user", $user);
                $consulta->bindParam(":nom", $nom);
                $consulta->bindParam(":cognom", $cognom);
                $consulta->bindParam(":email", $email);
                $consulta->bindParam(":pwd", $pwdencrip);
                $consulta->execute();

                // Almacenar la ultima id en una session
                $id = $pdo->lastInsertId();
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['user'] = $nom;

                $pdo = null;
                header('Location: ../perfil.php');
            } else {
                header('Location: ../registro.php?error=1');
                exit();
            }
        }
    }
}
