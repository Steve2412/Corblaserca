<?php
require_once __DIR__ . '/sesion.php';
require "conexion.php";
require_once __DIR__ . '/seguridad.php';
$usuario = requerir_sesion();

$monto = isset($_POST['Monto']) ? $_POST["Monto"] : "";
$banco = isset($_POST['Banco']) ? $_POST["Banco"] : "";
$ced_titu = isset($_POST['Cedu_Titu']) ? $_POST["Cedu_Titu"] : "";
$ced_titu = "V-".$ced_titu;
$fecha_trans = isset($_POST['Fecha_Trans']) ? $_POST["Fecha_Trans"] : "";
$num_trans = isset($_POST['Num_Trans']) ? $_POST["Num_Trans"] : "";
$motivo = isset($_POST['Motivo']) ? $_POST["Motivo"] : "";

try {
$pdo= $conectar->prepare ("INSERT INTO notifipago (monto_notifipago,banco_notifipago,cedu_titular_notifipago,fecha_notifipago,referencia_notifipago,motivo_notifipago,usuario_notifipago)
VALUES (?,?,?,?,?,?,?   )");
$pdo->bindValue(1,limpiar($monto));
$pdo->bindValue(2,limpiar($banco));
$pdo->bindParam(3,$ced_titu);
$pdo->bindParam(4,$fecha_trans);
$pdo->bindValue(5,limpiar($num_trans));
$pdo->bindValue(6,limpiar($motivo));
$pdo->bindParam(7,$usuario);
$pdo->execute();

echo json_encode("2");
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }


