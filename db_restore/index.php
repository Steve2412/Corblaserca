<?php 
session_start();
require "../php/conexion.php";
if(!isset($_SESSION['usuario'])){
  echo '<script language="javascript">
  window.location = "index.html"
  </script>';
  die();
  session_destroy(); 
}
$usuario = $_SESSION['usuario'];
$query = "SELECT * FROM usuario WHERE cedu_user = '$usuario'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Nombre = $row['nomb_user'];
    $Apellido = $row['apelli_user'];
    $Correo = $row['correo_user'];
    $Genero = $row['sexo_user'];
    $Direccion = $row['dirre_user'];
    $Numero = $row['numer_user'];
    $Contra = $row['contra_user'];
    $Fecha = $row['fech_naci_user'];
    $Estado = $row['estado_user'];
   }

   $query = "SELECT * FROM usuario_has_cursos WHERE Usuario_ID_user = '$usuario'"; 
   $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
   foreach ($result as $row){
	   $Cursos_ID_cur = $row['Cursos_ID_cur'];
	   $Rol_usuario = $row['Usuario_rol'];
   
   }

   if($Rol_usuario=="Profesor"||$Rol_usuario=="Estudiante"){
	echo "<script> location.href='../home.php' </script>";
 
 }

if ($Estado=="Inactivo"){
	echo '<script language="javascript">alert("No estas solvente en el sistema, reporta el pago o comunicate con el administrador");</script>';
	echo '<script language="javascript">
	window.location = "notifipago.php"
	</script>';
 }
 
 if ($Estado=="Eliminado"){
	echo '<script language="javascript">
	window.location = "index.html"
	</script>';
	die();
	session_destroy(); 
 }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Restaurar</title>
	<link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h1 class="text-center" style="margin-top:30px;">Restaura la base de datos</h1>
	<hr>
	<div class="row justify-content-center">
		<div class="col-sm-6">
			<?php
				if(isset($_SESSION['error'])){
					?>
					<div class="alert alert-danger text-center">
						<?php echo $_SESSION['error']; ?>
					</div>
					<?php

					unset($_SESSION['error']);
				}

				if(isset($_SESSION['success'])){
					?>
					<div class="alert alert-success text-center">
						<?php echo $_SESSION['success']; ?>
					</div>
					<?php

					unset($_SESSION['success']);
				}
			?>
			<div class="card">
				<div class="card-body">
					<h3>Información de la base de datos</h3>
					<br>
					<form method="POST" action="restore.php" enctype="multipart/form-data">
					    <div class="form-group row">
					     	<label for="server" class="col-sm-3 col-form-label">Servidor</label>
					      	<div class="col-sm-9">
					        	<input type="text" class="form-control" id="server" name="server" placeholder="ej. 'localhost'" required>
					      	</div>
					    </div>
					    <div class="form-group row">
					      	<label for="username" class="col-sm-3 col-form-label">Usuario</label>
					      	<div class="col-sm-9">
					        	<input type="text" class="form-control" id="username" name="username" placeholder="ej. 'root'" required>
					      	</div>
					    </div>
					    <div class="form-group row">
					      	<label for="password" class="col-sm-3 col-form-label">Contraseña</label>
					      	<div class="col-sm-9">
					        	<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
					      	</div>
					    </div>
					    <div class="form-group row">
					      	<label for="dbname" class="col-sm-3 col-form-label">Base de Datos</label>
					      	<div class="col-sm-9">
					        	<input type="text" class="form-control" id="dbname" name="dbname" placeholder="Nombre base de datos" required>
					      	</div>
					    </div>
					    <div class="form-group row">
					      	<label for="sql" class="col-sm-3 col-form-label">Archivo</label>
					      	<div class="col-sm-9">
					        	<input type="file" class="form-control-file" id="sql" name="sql" placeholder="Base de datos que desea restaurar" required>
					      	</div>
					    </div>
					    <button type="submit" class="btn btn-primary" name="restore">Restore</button>
						<button class="btn btn-primary" onclick="regresar()" name="Regresar">Regresar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>

<script>
	function regresar(){
		window.location.href = "../administrador.php";

	}
</script>