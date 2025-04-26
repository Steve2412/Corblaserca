<?php
require "conexion.php";
$id = isset($_POST['ID']) ? $_POST["ID"] : "";
$nombre = isset($_POST['Nombre']) ? $_POST["Nombre"] : "";
$horas = isset($_POST['Horas']) ? $_POST["Horas"] : "";
$precio = isset($_POST['Precio']) ? $_POST["Precio"] : "";
$cupo_min = isset($_POST['Cupo_min']) ? $_POST["Cupo_min"] : "";
$cupo_max = isset($_POST['Cupo_max']) ? $_POST["Cupo_max"] : "";
$contenido = isset($_POST['Contenido']) ? $_POST["Contenido"] : "";

try {

    $pdo = $conectar->prepare("SELECT ID_cur FROM cursos WHERE ID_cur = ?");
    $pdo->execute([$id]);
    $result = $pdo->fetchColumn();

    if($result>0){
        echo json_encode("1");

    }else{
        $pdo= $conectar->prepare ("INSERT INTO cursos (ID_cur,nomb_cur,horar_cur,prec_cur,cupos_cur_min,cupos_cur_max,conte_text) 
        VALUES (?,?,?,?,?,?,?)");
        $pdo->bindParam(1,$id);
        $pdo->bindParam(2,$nombre);
        $pdo->bindParam(3,$horas);
        $pdo->bindParam(4,$precio);
        $pdo->bindParam(5,$cupo_min);
        $pdo->bindParam(6,$cupo_max);
        $pdo->bindParam(7,$contenido);
        $pdo->execute();
        echo json_encode("2");
    }
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }