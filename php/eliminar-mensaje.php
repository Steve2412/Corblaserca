<?php
require_once __DIR__ . '/sesion.php';
require "conexion.php";
require_once __DIR__ . '/seguridad.php';
$usuario = requerir_sesion();
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    try {
    $pdo= $conectar->prepare("DELETE FROM foro WHERE mensaje_foro = ? AND usuario_id_foro = ?");
    $pdo->execute([$id, $usuario]);
    echo '<script language="javascript">alert("Mensaje Eliminado Exitosamente");</script>';
    echo "<script> location.href='../foro.php' </script>";
} 
catch (Exception $e) {
    echo '<script language="javascript">alert("Hubo un error");</script>';
    echo "<script> location.href='../crud-admin-cursos.php' </script>";
      
      
       
   }
}


?>