<?php
require "conexion.php";
$id_o = isset($_POST['id_o']) ? $_POST["id_o"] : "";
$cedula = isset($_POST['Cedula']) ? $_POST["Cedula"] : "";
$cursos = isset($_POST['Cursos']) ? $_POST["Cursos"] : "";
$periodo = isset($_POST['Periodo']) ? $_POST["Periodo"] : "";
$notas = isset($_POST['Nota']) ? $_POST["Nota"] : "";
$rol = isset($_POST['Rol']) ? $_POST["Rol"] : "";
$estado = isset($_POST['Estado']) ? $_POST["Estado"] : "";

try {
   $pdo= $conectar->prepare ("UPDATE usuario_has_cursos SET Usuario_ID_user='$cedula',Cursos_ID_cur='$cursos',Periodo_ID_peri='$periodo',calificacion_user='$notas',
   Usuario_rol='$rol', estado_usuario_has_cursos='$estado'  WHERE Usuario_ID_user='$id_o'");      
   $pdo->execute();
   echo json_encode("3");
}
 
catch (Exception $e) {
   echo json_encode("8");
      
       
   }



