<?php
session_start();
$usuario = $_SESSION['usuario'];
require "conexion.php";
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    try {
    $pdo= $conectar->prepare("DELETE FROM foro WHERE mensaje_foro = '$id' AND usuario_id_foro = '$usuario'");
    $pdo->execute();
    echo '<script language="javascript">alert("Mensaje Eliminado Exitosamente");</script>';
    echo "<script> location.href='../foro.php' </script>";
} 
catch (Exception $e) {
    echo '<script language="javascript">alert("Hubo un error");</script>';
    echo "<script> location.href='../crud-admin-cursos.php' </script>";
      
      
       
   }
}


?>