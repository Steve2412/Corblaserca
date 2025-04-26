<?php
require "php/conexion.php";
session_start();
if(!isset($_SESSION['usuario'])){
  echo '<script language="javascript">
  window.location = "index.html"
  </script>';
  die();
  session_destroy(); 
}
$usuario = $_SESSION['usuario'];
$query = "SELECT * FROM usuario_has_cursos WHERE Usuario_ID_user = '$usuario'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Rol_usuario = $row['Usuario_rol'];

}
if($Rol_usuario=="Profesor"||$Rol_usuario=="Estudiante"){
  echo "<script> location.href='home.php' </script>";

} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="Scripts/code.jquery.com_jquery-3.7.0.min.js"></script>
</head>
<body>
    <div class="container my-9">
        <h2>Crear Periodo</h2>
        <form id="Formulario">
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="ID" id="ID" name="ID">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nombre del periodo</label>
                <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Nombre" id="Nombre" name="Nombre">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Fecha Inicio del periodo</label>
                <div class="col-sm-6">
                        <input type="date" id="Fecha-Inicio" name="Fecha-Inicio" max="2030-12-31" class="input-group date">
                </div>
                
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Fecha Fin del periodo</label>
                <div class="col-sm-6">
                        <input type="date" id="Fecha-Fin" name="Fecha-Fin" max="2030-12-31" class="input-group date">
                </div>
                
            </div>

            
            <div class="row mb-3" id="Estado">
                <label class="col-sm-3 col-form-label">Estado</label>
                <div class="col-sm-6">
                    <input type="radio" class="form-check-input" name="Estado" id="option-a" value="Activo" checked>
                    <label class="form-check-label" for="option-1">Activo</label> 
                    <input type="radio" class="form-check-input" name="Estado" id="option-b" value="Finalizado">
                    <label class="form-check-label" for="option-2">Finalizado</label>
                </div>
            </div>
            
        </form>
        <button type="submit" class="btn btn-primary" onclick="registrar()">Registrar</button>
        <button type="submit" class="btn btn-secondary" onclick="regresar()">Regresar</button>
    </div>
</body>

<script src="Scripts/registro-periodo-crud.js" ></script>
</html>