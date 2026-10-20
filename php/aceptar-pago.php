<?php
require "conexion.php";
require_once __DIR__ . '/seguridad.php';
requerir_rol($conectar, ['Administrador']);
$id=$_GET['editarid'];

try {
$pdo= $conectar->prepare("UPDATE notifipago SET estado_notifipago='Procesado' WHERE id_notifipago=?");
$pdo->execute([$id]);

$pdo_1 = $conectar->prepare("SELECT * FROM notifipago WHERE id_notifipago = ?");
$pdo_1->execute([$id]);
$result = $pdo_1->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Cedu = $row['usuario_notifipago'];
}


$pdo_3 = $conectar->prepare("SELECT COUNT(*) FROM notifipago WHERE usuario_notifipago = ? AND (estado_notifipago='Rechazado' OR estado_notifipago='Pendiente')");
$pdo_3->execute([$Cedu]);
$result_2 = $pdo_3->fetchColumn();

if($result_2>0){
    echo '<script language="javascript">alert("Reporte aceptado correctamente");</script>';
    echo "<script> location.href='../crud-admin-pendientes-pagos.php' </script>"; 
}else{
    $pdo_2= $conectar->prepare("UPDATE usuario SET estado_user='Activo' WHERE cedu_user=?");
    $pdo_2->execute([$Cedu]);
    echo '<script language="javascript">alert("Reporte aceptado correctamente");</script>';
    echo "<script> location.href='../crud-admin-pendientes-pagos.php' </script>"; 
}
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }