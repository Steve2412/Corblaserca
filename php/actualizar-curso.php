<?php
require "conexion.php";
require_once __DIR__ . '/seguridad.php';
requerir_rol($conectar, ['Administrador']);
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
$pdo= $conectar->prepare ("UPDATE cursos SET ID_cur = ?,nomb_cur = ?,horar_cur = ?,prec_cur = ?,
cupos_cur_min = ?, cupos_cur_max = ? ,conte_text=?,estado_cur=? WHERE ID_cur = ?");
$pdo->execute([$id,$nombre,$horas,$precio,$cupo_min,$cupo_max,$contenido,$estado,$id_o]);
echo json_encode("2");

} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }