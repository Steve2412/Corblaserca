<?php
require "conexion.php";
$id_o = isset($_POST['id_o']) ? $_POST["id_o"] : "";
$id = isset($_POST['ID']) ? $_POST["ID"] : "";
$nombre = isset($_POST['Nombre']) ? $_POST["Nombre"] : "";
$horas = isset($_POST['Horas']) ? $_POST["Horas"] : "";
$precio = isset($_POST['Precio']) ? $_POST["Precio"] : "";
$cupo_min = isset($_POST['Cupo_min']) ? $_POST["Cupo_min"] : "";
$cupo_max = isset($_POST['Cupo_max']) ? $_POST["Cupo_max"] : "";
$contenido = isset($_POST['Contenido']) ? $_POST["Contenido"] : "";
$estado = isset($_POST['Estado']) ? $_POST["Estado"] : "";

try {
$pdo= $conectar->prepare ("UPDATE cursos SET ID_cur = '$id',nomb_cur = '$nombre',horar_cur = '$horas',prec_cur = '$precio',
cupos_cur_min = '$cupo_min', cupos_cur_max = '$cupo_max' ,conte_text='$contenido',estado_cur='$estado' WHERE ID_cur = '$id_o'");
$pdo->execute();
echo json_encode("2");

} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }