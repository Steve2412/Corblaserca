<?php
require "conexion.php";
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    try {
    $pdo= $conectar->prepare("UPDATE usuario SET estado_user='Eliminado' WHERE cedu_user =?");
    $pdo->execute([$id]);
    echo '<script language="javascript">alert("Usuario Eliminado Exitosamente");</script>';
    echo "<script> location.href='../crud-admin-usuario.php' </script>";
}catch (Exception $e) {
    echo '<script language="javascript">alert("Hubo un error");</script>';
    echo "<script> location.href='../crud-admin-cursos.php' </script>";
      
       
   }
}


?>