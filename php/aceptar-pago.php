<?php
require "conexion.php";
$id=$_GET['editarid'];

try {
$pdo= $conectar->prepare("UPDATE notifipago SET estado_notifipago='Procesado' WHERE id_notifipago=?");
$pdo->execute([$id]);

$query = "SELECT * FROM notifipago WHERE id_notifipago = '$id'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Cedu = $row['usuario_notifipago'];
}


$query_2 = "SELECT * FROM notifipago WHERE usuario_notifipago  = '$Cedu' AND (estado_notifipago='Rechazado' OR estado_notifipago='Pendiente' );"; 
$result_2 = $conectar->query($query_2)->fetchColumn(PDO::FETCH_BOTH);

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