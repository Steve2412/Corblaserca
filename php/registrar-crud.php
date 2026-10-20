<?php
require "conexion.php";
require_once __DIR__ . '/seguridad.php';
requerir_rol($conectar, ['Administrador']);
$cedula = isset($_POST['Cedula']) ? $_POST["Cedula"] : "";
if(!ctype_digit((string) $cedula)){
    echo json_encode("8");
    exit;
}
$cedula = "V-".$cedula;
$nombre = isset($_POST['Nombre']) ? $_POST["Nombre"] : "";
$apellido = isset($_POST['Apellido']) ? $_POST["Apellido"] : "";
$correo = isset($_POST['Correo']) ? $_POST["Correo"] : "";
$direccion = isset($_POST['Direccion']) ? $_POST["Direccion"] : "";
$telefono = isset($_POST['Telefono']) ? $_POST["Telefono"] : "";
$contra = isset($_POST['Contra']) ? $_POST["Contra"] : "";
$fecha = isset($_POST['Fecha']) ? $_POST["Fecha"] : "";
$gen = isset($_POST['Genero']) ? $_POST["Genero"] : "";
$estado = isset($_POST['Estado']) ? $_POST["Estado"] : "";

    $pdo = $conectar->prepare("SELECT cedu_user FROM usuario WHERE cedu_user = ?");
    $pdo->execute([$cedula]);
    $result = $pdo->fetchColumn();

    $pdo = $conectar->prepare("SELECT correo_user FROM usuario WHERE correo_user = ?");
    $pdo->execute([$correo]);
    $result_2 = $pdo->fetchColumn();

    if($result>0){
        echo json_encode("1");

    }elseif($result_2>0){
        echo json_encode("3");

    }else{
        $pdo= $conectar->prepare ("INSERT INTO usuario (cedu_user,nomb_user,apelli_user,correo_user,contra_user,dirre_user,numer_user,fech_naci_user,sexo_user,estado_user) 
        VALUES (?,?,?,?,?,?,?,?,?,?)");
        $pdo->bindParam(1,$cedula);
        $pdo->bindValue(2,limpiar($nombre));
        $pdo->bindValue(3,limpiar($apellido));
        $pdo->bindValue(4,limpiar($correo));
        $pdo->bindParam(5,$contra);
        $pdo->bindValue(6,limpiar($direccion));
        $pdo->bindValue(7,limpiar($telefono));
        $pdo->bindParam(8,$fecha);
        $pdo->bindParam(9,$gen);
        $pdo->bindParam(10,$estado);
        $pdo->execute();
        echo json_encode("2");
        
        
    }
    






?>