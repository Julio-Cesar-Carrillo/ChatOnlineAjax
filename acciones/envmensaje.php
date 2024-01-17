<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "../conexion/conexion.php";
    session_start();

    $emi = $_SESSION['id'];
    $rec = $_POST['id_u'];
    $msj = $_POST['msj'];


    try {
        $consulta = $pdo->prepare("INSERT INTO tbl_mensaje (user_emi_chat, user_rec_chat, historial_chat, fecha) 
            VALUES (:emi, :rec, :his, NOW())");

        $consulta->bindParam(":emi", $emi);
        $consulta->bindParam(":rec", $rec);
        $consulta->bindParam(":his", $msj);
        $consulta->execute();
        $pdo = null;
        echo "ok";
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
}