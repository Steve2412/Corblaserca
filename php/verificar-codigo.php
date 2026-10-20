<?php
require_once __DIR__ . '/sesion.php';
$codigo = isset($_POST['Codigo']) ? $_POST["Codigo"] : "";
$recuperacion = isset($_SESSION['recuperacion']) ? $_SESSION['recuperacion'] : null;

// Código caducado, inexistente o con demasiados intentos fallidos
if(!$recuperacion || time() > $recuperacion['expira'] || $recuperacion['intentos'] >= 5){
    unset($_SESSION['recuperacion']);
    echo json_encode("3");
    exit;
}

if(password_verify((string) $codigo, $recuperacion['codigo'])){
    $_SESSION['recuperacion']['verificado'] = true;
    echo json_encode("1");
}else{
    $_SESSION['recuperacion']['intentos'] += 1;
    echo json_encode("2");
}

?>
