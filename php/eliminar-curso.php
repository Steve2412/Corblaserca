<?php
require "conexion.php";
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];
    try {
    $pdo= $conectar->prepare("UPDATE cursos SET estado_cur='Eliminado' WHERE ID_cur =?");
    $pdo->execute([$id]);
    echo '<script language="javascript">alert("Curso Eliminado Exitosamente");</script>';
    echo "<script> location.href='../crud-admin-cursos.php' </script>";

} 
catch (Exception $e) {
    echo '<script language="javascript">alert("Hubo un error");</script>';
    echo "<script> location.href='../crud-admin-cursos.php' </script>";
      
       
   }

}




?>