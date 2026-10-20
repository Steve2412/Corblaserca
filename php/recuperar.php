<?php
require_once __DIR__ . '/sesion.php';
require "conexion.php";
$contra = isset($_POST['Contra']) ? $_POST["Contra"] : "";
$recuperacion = isset($_SESSION['recuperacion']) ? $_SESSION['recuperacion'] : null;

// Solo se cambia la contraseña del correo que verificó el código en esta misma sesión
if(!$recuperacion || !$recuperacion['verificado'] || time() > $recuperacion['expira']){
    echo json_encode("3");
    exit;
}

if(strlen($contra) < 8 || strlen($contra) > 16){
    echo json_encode("8");
    exit;
}

try {
$pdo= $conectar->prepare("UPDATE usuario SET contra_user = ? WHERE correo_user= ?");
$pdo->execute([$contra, $recuperacion['correo']]);
unset($_SESSION['recuperacion']);
echo json_encode("1");
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }


?>
