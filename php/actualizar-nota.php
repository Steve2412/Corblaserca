<?php
require "conexion.php";
require_once __DIR__ . '/seguridad.php';
requerir_rol($conectar, ['Profesor']);
$cedula = isset($_POST['Cedula']) ? $_POST["Cedula"] : "";
$nota = isset($_POST['Nota']) ? $_POST["Nota"] : "";

try {
// El profesor solo puede calificar a estudiantes de sus propios cursos
$pdo= $conectar->prepare ("UPDATE usuario_has_cursos SET calificacion_user = ? WHERE Usuario_ID_user = ? AND Usuario_rol = 'Estudiante'
AND Cursos_ID_cur IN (SELECT curso FROM (SELECT Cursos_ID_cur AS curso FROM usuario_has_cursos WHERE Usuario_ID_user = ? AND Usuario_rol = 'Profesor') AS cursos_profesor)");
$pdo->execute([$nota, $cedula, $_SESSION['usuario']]);
echo json_encode("2");
} 

catch (Exception $e) {
    echo json_encode("8");
       
        
    }
