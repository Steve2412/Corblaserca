<?php

require_once __DIR__ . '/vendor/autoload.php';
include_once(dirname(__FILE__) . '/vendor/mysqldump-php/src/Ifsnop/main.inc.php');

use Ifsnop\Mysqldump as IMysqldump; 

try {
    $dump = new IMysqldump\Mysqldump('mysql:host=localhost;dbname=prueba', 'root', '');
    $dump->start('backup/backup.sql');
    $file_url = 'backup/backup.sql';
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
    readfile($file_url);
} catch (\Exception $e) {
    echo 'mysqldump-php error: ' . $e->getMessage();
}