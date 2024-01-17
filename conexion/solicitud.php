<?php
require_once "conexion.php";
session_start();
$id = $_SESSION['id'];
$consulta = $pdo->prepare("SELECT s.id,u.user_user,u.nom_user FROM tbl_solicitud s 
INNER JOIN tbl_user u ON u.id=s.num_telf_user_emi
WHERE s.estado=0 AND s.num_telf_user_rec=:id");
$consulta->bindParam(':id', $id);
$consulta->execute();

$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($resultado);
