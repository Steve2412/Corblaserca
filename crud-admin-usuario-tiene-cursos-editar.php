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
$id=$_GET['editarid']; 
$query = "SELECT * FROM usuario_has_cursos WHERE Usuario_ID_user = '$id'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Cedula = $row['Usuario_ID_user'];
    $Cursos_ID_cur = $row['Cursos_ID_cur'];
    $Periodo_ID_peri  = $row['Periodo_ID_peri'];
    $calificacion_user = $row['calificacion_user'];
    $Usuario_rol = $row['Usuario_rol'];
    $estado_usuario_has_cursos = $row['estado_usuario_has_cursos'];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Editar usuario en curso</title>
</head>
<body>
    <div class="container my-9">
        <h2>Editar usuario en curso</h2>
        <form id="Formulario">
        <textarea id="id_o" name="id_o" hidden value=<?php echo $Cedula;?>><?php echo $Cedula;?></textarea> 
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Cedula del estudiante</label>
                <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Cedula" id="Cedula" name="Cedula" value=<?php echo $Cedula;?>>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Curso</label>
                <div class="col-sm-6">
                    <select name="Cursos" id="Cursos">
                        <?php
                        $query = "SELECT * FROM cursos";
                        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);


                        foreach($result as $opciones){?>
                        
                            
                        <option value="<?php echo $Cursos_ID_cur ?>" selected hidden><?php echo $Cursos_ID_cur ?></option>
                            <option><?php echo $opciones['ID_cur']?></option>
                            <?php } ?>
                            <option value="">Ninguno</option>
                        
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Periodo</label>
                <div class="col-sm-6">
                <select name="Periodo" id="Periodo">
                        <?php
                        $query = "SELECT * FROM periodo";
                        $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);

                        foreach($result as $opciones){?>
                        
                            <option value="<?php echo $Periodo_ID_peri ?>" selected hidden><?php echo $Periodo_ID_peri ?></option>
                            <option><?php echo $opciones['ID_peri']?></option>
                            <?php } ?>
                            <option value="">Ninguno</option>
                        
                    </select>
                </div>
            </div>

            <div class="row mb-3" id="Rol">
                <label class="col-sm-3 col-form-label">Rol</label>
                <div class="col-sm-6">
                    <input type="radio" class="form-check-input" name="Rol" id="option-1" value="Estudiante" <?php echo ($Usuario_rol=='Estudiante')?'checked':'' ?> >
                    <label class="form-check-label" for="option-1">Estudiante</label>
                    <input type="radio" class="form-check-input" name="Rol" id="option-2" value="Profesor" <?php echo ($Usuario_rol=='Profesor')?'checked':'' ?>  >
                    <label class="form-check-label" for="option-2">Profesor</label>  
                    <input type="radio" class="form-check-input" name="Rol" id="option-3" value="Administrador" <?php echo ($Usuario_rol=='Administrador')?'checked':'' ?>  >
                    <label class="form-check-label" for="option-3">Administrador</label> 
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nota del estudiante</label>
                <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Nota" id="Nota" name="Nota" value=<?php echo $calificacion_user;?>>
                </div>
            </div>

            <div class="row mb-3" id="Rol">
                <label class="col-sm-3 col-form-label">Estado</label>
                <div class="col-sm-6">
                    <input type="radio" class="form-check-input" name="Estado" id="option-a" value="Activo" <?php echo ($estado_usuario_has_cursos=='Activo')?'checked':'' ?> >
                    <label class="form-check-label" for="option-1">Activo</label>
                    <input type="radio" class="form-check-input" name="Estado" id="option-b" value="Finalizado" <?php echo ($estado_usuario_has_cursos=='Finalizado')?'checked':'' ?>  >
                    <label class="form-check-label" for="option-2">Finalizado</label>  
                </div>
            </div>
                
        </form>
        <button type="submit" class="btn btn-primary" onclick="registrar()">Actualizar</button>
        <button type="submit" class="btn btn-secondary" onclick="regresar()">Regresar</button>
    </div>
</body>
<script src="Scripts/actualizar-usuario-curso.js" ></script>
</html>