<?php
require "conexion.php";
$id = isset($_POST['ID']) ? $_POST["ID"] : "";
$nombre = isset($_POST['Nombre']) ? $_POST["Nombre"] : "";
$fecha_1 = isset($_POST['Fecha-Inicio']) ? $_POST["Fecha-Inicio"] : "";
$fecha_2 = isset($_POST['Fecha-Fin']) ? $_POST["Fecha-Fin"] : "";
$estado = isset($_POST['Estado']) ? $_POST["Estado"] : "";

try {
$pdo = $conectar->prepare("SELECT ID_peri  FROM periodo WHERE ID_peri  = ?");
$pdo->execute([$id]);
$result = $pdo->fetchColumn();

if($result>0){
    echo json_encode("1");

}else{
    $pdo= $conectar->prepare ("INSERT INTO periodo (ID_peri,nomb_peri,fech_ini_peri,fech_fin_peri,estado_peri) VALUES (?,?,?,?,?)");
    $pdo->bindParam(1,$id);
    $pdo->bindParam(2,$nombre);
    $pdo->bindParam(3,$fecha_1);
    $pdo->bindParam(4,$fecha_2);
    $pdo->bindParam(5,$estado);
    $pdo->execute();
    echo json_encode("2");
}
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }
