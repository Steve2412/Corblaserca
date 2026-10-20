<?php
require "conexion.php";
require_once __DIR__ . '/seguridad.php';
require_once __DIR__ . '/sesion.php';
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

$pdo= $conectar->prepare ("UPDATE usuario SET nomb_user = ?,apelli_user = ?,correo_user = ?, 
dirre_user = ?,numer_user = ?,fech_naci_user = ?,sexo_user = ? WHERE cedu_user = ?");
$pdo->execute([limpiar($nombre),limpiar($apellido),limpiar($correo),limpiar($direccion),limpiar($telefono),$fecha,$gen,$usuario]);
echo json_encode("2");
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }