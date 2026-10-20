<?php
require "conexion.php";
require_once __DIR__ . '/seguridad.php';
$usuario = requerir_sesion();

try {
$pdo_1 = $conectar->prepare("SELECT * FROM usuario_has_cursos WHERE Usuario_ID_user = ?");
$pdo_1->execute([$usuario]);
$result = $pdo_1->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
$Cursos_ID_cur = $row['Cursos_ID_cur'];
$Rol_usuario = $row['Usuario_rol'];
}


$mensaje = isset($_POST['Mensaje']) ? limpiar($_POST["Mensaje"]) : "";
$fecha = date('Y-m-d H:i:s');

$pdo= $conectar->prepare ("INSERT INTO foro (usuario_id_foro ,curso_id_foro ,mensaje_foro,fecha_mensaje_foro) 
        VALUES (?,?,?,?)");
        $pdo->bindParam(1,$usuario);
        $pdo->bindParam(2,$Cursos_ID_cur);
        $pdo->bindParam(3,$mensaje);
        $pdo->bindParam(4,$fecha);
        $pdo->execute();
        echo json_encode("2");
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }