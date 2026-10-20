<?php
require_once __DIR__ . '/sesion.php';
if(!isset($_SESSION["intento_logeo"])){
    $_SESSION["intento_logeo"] = 0;
}
require "conexion.php";

// Bloqueo temporal tras 3 intentos fallidos
if(isset($_SESSION["locked"]) && time() < $_SESSION["locked"]){
    echo json_encode("9");
    exit;
}

$cedula = isset($_POST['Cedula']) ? $_POST["Cedula"] : "";
$cedula = "V-".$cedula;
$contra = isset($_POST['Contra']) ? $_POST["Contra"] : "";


try {
$pdo = $conectar->prepare("SELECT cedu_user FROM usuario WHERE cedu_user = ? AND contra_user = ?");
$pdo->execute([$cedula, $contra]);
$result = $pdo->fetchColumn();

if($result !== false){
        session_regenerate_id(true);
        $_SESSION['usuario']=$result;
        $_SESSION["intento_logeo"] = 0;
        echo json_encode("1");
    }

    else{
        echo json_encode("2");
        $_SESSION["intento_logeo"] +=1;
        if($_SESSION["intento_logeo"]>=3){
            $_SESSION["locked"]=time() + 10;
            $_SESSION["intento_logeo"] = 0;
        }
    }
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }
?>
