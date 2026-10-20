<?php
require "conexion.php";
require_once __DIR__ . '/seguridad.php';
requerir_rol($conectar, ['Administrador']);
$id=$_GET['deleteid'];
try {
$pdo= $conectar->prepare("UPDATE notifipago SET estado_notifipago='Rechazado' WHERE id_notifipago=?");
$pdo->execute([$id]);
echo '<script language="javascript">alert("Notificacion Rechazada");</script>';
echo "<script> location.href='../crud-admin-pendientes-pagos.php' </script>"; 
} 

catch (Exception $e) {
    echo '<script language="javascript">alert("Hubo un error");</script>';
    echo "<script> location.href='../crud-admin-pendientes-pagos.php' </script>"; 
       
        
    }