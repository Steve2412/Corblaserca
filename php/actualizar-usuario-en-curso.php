<?php
require "conexion.php";
require_once __DIR__ . '/seguridad.php';
requerir_rol($conectar, ['Administrador']);
$id_o = isset($_POST['id_o']) ? $_POST["id_o"] : "";
$cedula = isset($_POST['Cedula']) ? $_POST["Cedula"] : "";
$cursos = isset($_POST['Cursos']) ? $_POST["Cursos"] : "";
$periodo = isset($_POST['Periodo']) ? $_POST["Periodo"] : "";
$notas = isset($_POST['Nota']) ? $_POST["Nota"] : "";
$rol = isset($_POST['Rol']) ? $_POST["Rol"] : "";
$estado = isset($_POST['Estado']) ? $_POST["Estado"] : "";

try {
   $pdo= $conectar->prepare ("UPDATE usuario_has_cursos SET Usuario_ID_user=?,Cursos_ID_cur=?,Periodo_ID_peri=?,calificacion_user=?,
   Usuario_rol=?, estado_usuario_has_cursos=?  WHERE Usuario_ID_user=?");      
   $pdo->execute([$cedula,$cursos,$periodo,$notas,$rol,$estado,$id_o]);
   echo json_encode("3");
}
 
catch (Exception $e) {
   echo json_encode("8");
      
       
   }



