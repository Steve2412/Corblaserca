<?php
require_once __DIR__ . '/sesion.php';
require "conexion.php";
require "correo.php";
$correo = isset($_POST['Correo']) ? $_POST["Correo"] : "";

try {

$pdo = $conectar->prepare("SELECT correo_user FROM usuario WHERE correo_user = ?");
$pdo->execute([$correo]);
$result = $pdo->fetchColumn();

if($result !== false){
    // El código se genera y se guarda en el servidor: el navegador nunca lo conoce
    $codigo = (string) random_int(100000, 999999);
    $_SESSION['recuperacion'] = [
        'correo' => $result,
        'codigo' => password_hash($codigo, PASSWORD_DEFAULT),
        'expira' => time() + 600,
        'intentos' => 0,
        'verificado' => false,
    ];
    if(enviar_correo($result, "Codigo de recuperacion de cuenta", "Tu codigo de recuperacion es: " . $codigo)){
        echo json_encode("1");
    }else{
        echo json_encode("8");
    }
}else{
    echo json_encode("2");

}

} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }
    
?>
