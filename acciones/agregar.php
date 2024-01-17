<?php
if (isset($_POST)) {
    require_once "../conexion/conexion.php";
    session_start();
    $emi = $_SESSION['id'];
    $rec = $_POST['id'];
    $fec = "'curdate()'";
    $est = 0;

    $consulta2 = $pdo->prepare("SELECT * FROM tbl_solicitud WHERE (num_telf_user_emi = :emi AND num_telf_user_rec = :rec)
                                OR (num_telf_user_rec = :rec AND num_telf_user_emi = :emi)");
    $consulta2->bindParam(':emi', $emi);
    $consulta2->bindParam(':rec', $rec);
    $consulta2->execute();

    if ($consulta2->rowCount() < 1) {
        $query = $pdo->prepare("INSERT INTO tbl_solicitud (num_telf_user_emi,num_telf_user_rec,fecha_solicitud,estado) VALUES (:emi,:rec,:fec,:est)");
        $query->bindParam(":emi", $emi);
        $query->bindParam(":rec", $rec);
        $query->bindParam(":fec", $fec);
        $query->bindParam(":est", $est);
        $query->execute();
        $pdo = null;
        echo "ok";
    }else {
        $pdo = null;
        echo "error";
    }
}
