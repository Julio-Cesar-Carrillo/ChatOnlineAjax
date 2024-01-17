<?php
require_once "conexion.php";
session_start();
$id = $_SESSION['id'];
$id_u = $_POST['id_u'];

$consulta = $pdo->prepare("SELECT * FROM tbl_mensaje WHERE user_emi_chat=:id AND user_rec_chat=:id_u 
UNION
SELECT * FROM tbl_mensaje WHERE user_emi_chat=:id_u AND user_rec_chat=:id ORDER BY id_chat DESC");
$consulta->bindParam(':id', $id);
$consulta->bindParam(':id_u', $id_u);
$consulta->execute();

$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($resultado);
