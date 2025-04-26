<?php
require "conexion.php";
$cedula = isset($_POST['Cedula']) ? $_POST["Cedula"] : "";
$cedula = "V-".$cedula;
$cursos = isset($_POST['Cursos']) ? $_POST["Cursos"] : "";
$periodo = isset($_POST['Periodo']) ? $_POST["Periodo"] : "";
$rol = isset($_POST['Rol']) ? $_POST["Rol"] : "";
$estado = isset($_POST['Estado']) ? $_POST["Estado"] : "";

try {

$pdo = $conectar->prepare("SELECT * FROM usuario WHERE cedu_user ='$cedula'");
$pdo->execute();
$result = $pdo->fetchColumn();  

if($result>0){
    $pdo_2 = $conectar->prepare("SELECT Usuario_ID_user FROM usuario_has_cursos WHERE Usuario_ID_user  = '$cedula' AND  Cursos_ID_cur = '$cursos'");
    $pdo_2->execute();
    $result_2 = $pdo_2->fetchColumn();

    $pdo_3 = $conectar->prepare("SELECT Usuario_ID_user FROM usuario_has_cursos WHERE Usuario_ID_user  = '$cedula' AND  estado_usuario_has_cursos = 'Activo'");
    $pdo_3->execute();
    $result_3 = $pdo_3->fetchColumn();

    if($result_2>0) {
        echo json_encode("2");
    }else if($result_3>0){
        echo json_encode("4");

    }
        else{
        $pdo= $conectar->prepare ("INSERT INTO usuario_has_cursos (usuario_has_cursos.Usuario_ID_user,usuario_has_cursos.Cursos_ID_cur,usuario_has_cursos.Periodo_ID_peri,usuario_has_cursos.Usuario_rol,usuario_has_cursos.estado_usuario_has_cursos) 
        VALUES (?,?,?,?,?)");
        $pdo->bindParam(1,$cedula);
        $pdo->bindParam(2,$cursos);
        $pdo->bindParam(3,$periodo);
        $pdo->bindParam(4,$rol);
        $pdo->bindParam(5,$estado);
        $pdo->execute();
        echo json_encode("3");

        
    }


    }else{
        echo json_encode("1");

    }
}

catch (Exception $e) {
    echo json_encode("8");
       
        
    }
