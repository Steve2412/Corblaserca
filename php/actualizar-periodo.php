<?php
require "conexion.php";
require_once __DIR__ . '/seguridad.php';
requerir_rol($conectar, ['Administrador']);
$id_o = isset($_POST['id_o']) ? $_POST["id_o"] : "";
$id = isset($_POST['ID']) ? $_POST["ID"] : "";
$nombre = isset($_POST['Nombre']) ? $_POST["Nombre"] : "";
$fecha_1 = isset($_POST['Fecha-Inicio']) ? $_POST["Fecha-Inicio"] : "";
$fecha_2 = isset($_POST['Fecha-Fin']) ? $_POST["Fecha-Fin"] : "";
$estado = isset($_POST['Estado']) ? $_POST["Estado"] : "";

try {
$pdo= $conectar->prepare ("UPDATE periodo SET ID_peri = ?,nomb_peri=?,fech_ini_peri=?,fech_fin_peri=?,estado_peri=? WHERE ID_peri  = ?");
$pdo->execute([$id,$nombre,$fecha_1,$fecha_2,$estado,$id_o]);
echo json_encode("2");
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }