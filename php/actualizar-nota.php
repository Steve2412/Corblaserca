<?php
require "conexion.php";
$cedula = isset($_POST['Cedula']) ? $_POST["Cedula"] : "";
$nota = isset($_POST['Nota']) ? $_POST["Nota"] : "";

try {
$pdo= $conectar->prepare ("UPDATE usuario_has_cursos SET calificacion_user = '$nota' WHERE Usuario_ID_user  = '$cedula'");
$pdo->execute();
echo json_encode("2");
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }
