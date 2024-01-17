<?php
if (isset($_POST)) {
    require_once "../conexion/conexion.php";
    session_start();
    $id = $_POST['id'];
    $fec="'curdate()'";
    $est=1;
    $query = $pdo->prepare("UPDATE tbl_solicitud SET fecha_solicitud = :fec, estado = :est WHERE id = :id");
    $query->bindParam(":id", $id);
    $query->bindParam(":fec", $fec);
    $query->bindParam(":est", $est);
    $query->execute();
    $pdo = null;
    echo "ok";
}
