<?php
session_start();
if(!isset($_SESSION["intento_logeo"])){
    $_SESSION["intento_logeo"] = 0;
}
if($_SESSION["intento_logeo"]==3){
    $_SESSION["locked"]=time() + 60;
}
require "conexion.php";

$cedula = isset($_POST['Cedula']) ? $_POST["Cedula"] : "";
$cedula = "V-".$cedula;
$contra = isset($_POST['Contra']) ? $_POST["Contra"] : "";


try {
$pdo = $conectar->prepare("SELECT cedu_user FROM usuario WHERE cedu_user = '$cedula' AND contra_user='$contra'");
$pdo->execute();
$result = $pdo->fetchColumn();

if($result>0){
        $_SESSION['usuario']=$cedula;
        echo json_encode("1");
    }

    else{
        echo json_encode("2");
        $_SESSION["intento_logeo"] +=1;
        if($_SESSION["intento_logeo"]==3){
            $_SESSION["locked"]=time() + 10;
        }
    }
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }
?>