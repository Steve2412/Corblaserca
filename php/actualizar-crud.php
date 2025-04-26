<?php
require "conexion.php";
$cedula = isset($_POST['Cedula']) ? $_POST["Cedula"] : "";
$nombre = isset($_POST['Nombre']) ? $_POST["Nombre"] : "";
$apellido = isset($_POST['Apellido']) ? $_POST["Apellido"] : "";
$correo = isset($_POST['Correo']) ? $_POST["Correo"] : "";
$direccion = isset($_POST['Direccion']) ? $_POST["Direccion"] : "";
$telefono = isset($_POST['Telefono']) ? $_POST["Telefono"] : "";
$fecha = isset($_POST['Fecha']) ? $_POST["Fecha"] : "";
$gen = isset($_POST['Genero']) ? $_POST["Genero"] : "";
$estado = isset($_POST['Estado']) ? $_POST["Estado"] : "";

try {

$pdo= $conectar->prepare ("UPDATE usuario SET cedu_user = '$cedula',nomb_user = '$nombre',apelli_user = '$apellido',correo_user = '$correo',
dirre_user = '$direccion',numer_user = '$telefono',fech_naci_user = '$fecha',sexo_user = '$gen', estado_user = '$estado' WHERE cedu_user = '$cedula'");
$pdo->execute();
echo json_encode("2");
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }