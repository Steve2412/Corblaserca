<?php
$config_bd = require __DIR__ . '/config.php';

try{
    $conectar=new PDO('mysql:host='.$config_bd['db_host'].';port='.$config_bd['db_port'].';dbname='.$config_bd['db_name'],$config_bd['db_user'],$config_bd['db_pass']);
    $conectar->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $conectar->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
}



catch(PDOException $error){
    error_log($error->getMessage());
    echo 'No se pudo conectar a la base de datos';
    die;

}

?>
