<?php

require_once __DIR__ . '/../php/sesion.php';
require __DIR__ . '/../php/conexion.php';
require_once __DIR__ . '/../php/seguridad.php';
requerir_rol($conectar, ['Administrador']);

require_once __DIR__ . '/vendor/autoload.php';

use Ifsnop\Mysqldump as IMysqldump; 

// El volcado se genera fuera de la carpeta pública y se borra después de enviarlo
$file_url = tempnam(sys_get_temp_dir(), 'backup');
try {
    $dump = new IMysqldump\Mysqldump('mysql:host='.$config_bd['db_host'].';port='.$config_bd['db_port'].';dbname='.$config_bd['db_name'], $config_bd['db_user'], $config_bd['db_pass']);
    $dump->start($file_url);
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"backup.sql\""); 
    readfile($file_url);
} catch (\Exception $e) {
    error_log('mysqldump-php error: ' . $e->getMessage());
    echo 'No se pudo generar la copia de seguridad';
} finally {
    @unlink($file_url);
}
