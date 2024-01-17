<?php
require_once "../conexion/conexion.php";
session_start();
$_SESSION['id'];
$id = $_POST['id'];
$query = $pdo->prepare("DELETE FROM tbl_solicitud WHERE id = :id");
$query->bindParam(":id", $id);
$query->execute();
echo "ok";