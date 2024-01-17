<?php
require_once "conexion.php";
session_start();
$id = $_SESSION['id'];

if (!empty($_POST['busqueda'])) {
    $busqueda = $_POST['busqueda'];

    $consulta = $pdo->prepare("SELECT * FROM tbl_user WHERE (id != :id) AND (user_user LIKE :busqueda OR nom_user LIKE :busqueda OR cognom_user LIKE :busqueda)");
    $busquedaParam = '%' . $busqueda . '%';
    $consulta->bindParam(':id', $id);
    $consulta->bindParam(':busqueda', $busquedaParam);
    $consulta->execute();
} else {
    $consulta = $pdo->prepare("SELECT s.id AS id_s,u.id AS id_u, u.user_user, u.nom_user, u.cognom_user FROM tbl_solicitud s 
    INNER JOIN tbl_user u ON u.id = s.num_telf_user_rec
    WHERE s.estado = 1 AND s.num_telf_user_emi = :id

    UNION
    
    SELECT s.id AS id_s,u.id AS id_u, u.user_user, u.nom_user, u.cognom_user FROM tbl_solicitud s 
    INNER JOIN tbl_user u ON u.id = s.num_telf_user_emi
    WHERE s.estado = 1 AND s.num_telf_user_rec = :id");

    $consulta->bindParam(':id', $id);
    $consulta->execute();
}
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($resultado);
