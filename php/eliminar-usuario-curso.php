<?php
require "conexion.php";
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    try {
    $pdo= $conectar->prepare("DELETE FROM usuario_has_cursos WHERE Usuario_ID_user =?");
    $pdo->execute([$id]);
    echo '<script language="javascript">alert("Usuario Eliminado Exitosamente");</script>';
    echo "<script> location.href='../crud-admin-usuario-tiene-cursos.php' </script>";

}catch (Exception $e) {
        echo '<script language="javascript">alert("Hubo un error");</script>';
        echo "<script> location.href='../crud-admin-cursos.php' </script>";
          
           
       }
}


?>