<?php
require "conexion.php";
session_start();
if(!isset($_SESSION['usuario'])){
  echo '<script language="javascript">
  window.location = "index.html"
  </script>';
  die();
  session_destroy(); 
}
try {
$usuario = $_SESSION['usuario'];
$nombre = isset($_POST['Nombre']) ? $_POST["Nombre"] : "";
$apellido = isset($_POST['Apellido']) ? $_POST["Apellido"] : "";
$correo = isset($_POST['Correo']) ? $_POST["Correo"] : "";
$direccion = isset($_POST['Direccion']) ? $_POST["Direccion"] : "";
$telefono = isset($_POST['Telefono']) ? $_POST["Telefono"] : "";;
$fecha = isset($_POST['Fecha']) ? $_POST["Fecha"] : "";
$gen = isset($_POST['Genero']) ? $_POST["Genero"] : "";

$pdo= $conectar->prepare ("UPDATE usuario SET nomb_user = '$nombre',apelli_user = '$apellido',correo_user = '$correo', 
dirre_user = '$direccion',numer_user = '$telefono',fech_naci_user = '$fecha',sexo_user = '$gen' WHERE cedu_user = '$usuario'");
$pdo->execute();
echo json_encode("2");
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }