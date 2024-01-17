<?php
session_start();
if (!$_SESSION['id']) {
    header('Location: ./index.php');
    exit();
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PERFIL</title>
        <link rel="stylesheet" href="./css/style4.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

    </head>

    <body class="perfiles">
        <div>
            <h1 class="usuario">
                Bienvenido <?php
                            echo $_SESSION['user'];
                            ?>
            </h1>
            <a href="./acciones/salir.php" class="salir">Salir</a>
        </div>
        <!--  LISTAR AMIGOS -->
        <div class="columna1">
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Nick</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Listado de amigos -->
                    <tbody id="listaamigos">
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MENSAJES -->
        <div class="columna2">
            <div id="mensajes"></div>
        </div>

        <!-- BUSQUEDA AMIGO -->

        <div class="columna3">
            <div>
                <h2 class="h21">Busca a un amigo</h2>
                <form action="" method="post" id="frmbusqueda">
                    <input type="text" name="buscar" id="buscar" placeholder="nombre de usuario o nombre de tu amigo">
                </form>
                <table>
                    <tbody id="busquedaresult">
                    </tbody>
                </table>
            </div>

            <!-- SOLICITUDES PENDIENDES -->

            <div>
                <h2 class="h21">Solicitudes pendientes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nick</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="pendientes">
                    </tbody>
                </table>
            </div>
        </div>
        <script src="script.js"></script>
    </body>

    </html>
<?php
}
