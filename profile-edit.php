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

$query = "SELECT * FROM cursos WHERE ID_cur = '$Cursos_ID_cur'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $nomb_cur = $row['nomb_cur'];
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
 
 if($Rol_usuario=="Administrador"){
   echo "<script> location.href='administrador.php' </script>";

}  

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Editar <?php echo $Nombre?></title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


   <!-- custom css file link  -->
   <link rel="stylesheet" href="assets/styles/css/style copy.css">

      

</head>
<body>

<header class="header">
   
   <section class="flex">

      <a href="home.php" class="logo">Corblaserca</a>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <!--<div id="toggle-btn" class="fas fa-sun"></div>-->
         </div>

      <div class="profile">
         <img src="Images/pic-1.jpg" class="image" alt="">
         <?php echo "<h3 class='name'>$Nombre</h3>" ?>
         <?php echo "<p class='role'>$Rol_usuario</p>" ?>
         <a href="profile.php" class="btn">Ver perfil</a>
         <div class="flex-btn">
            <a href="php/salir.php" class="option-btn">Cerrar sesión</a>
         </div>
      </div>

   </section>

</header>   

<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
      <img src="Images/pic-1.jpg" class="image" alt="">
      <?php echo "<h3 class='name'>$Nombre</h3>" ?>
      <?php echo "<p class='role'>$Rol_usuario</p>" ?>
      <a href="profile.php" class="btn">Ver perfil</a>
   </div>

   <nav class="navbar-sex">
   <?php 
         if($Rol_usuario=="Estudiante"||$Rol_usuario=="Profesor"){
         
         echo "<a href='home.php'><i class='fas fa-home'></i><span>Inicio</span></a>"; 
         echo "<a href='horario.php'><i class='fa-solid fa-calendar-days'></i><span>Horario</span></a>"; 
      }
      ?>

<?php 
         if($Rol_usuario=="Estudiante"){
         
         echo "<a href='historial.php'><i class='fa fa-file-text-o'></i><span>Historial reporte</span></a>"; 
      }
      ?>
   </nav>

</div>


<section class="courses">

<h1>Configuraciones del Usuario</h1>


<div class="table">
<form id="Formulario">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="font-size:20px" >Nombre</label>
                <div class="col-sm-6">
                        <input type="text" class="form-control"style="font-size:20px" onkeydown="return /[a-z]/i.test(event.key)" placeholder="Nombre" id="Nombre" name="Nombre" value=<?php echo $Nombre;?>>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"style="font-size:20px">Apellido</label>
                <div class="col-sm-6">
                        <input type="text" class="form-control"style="font-size:20px" onkeydown="return /[a-z]/i.test(event.key)" placeholder="Apellido" id="Apellido" name="Apellido" value=<?php echo $Apellido;?>>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"style="font-size:20px">Correo</label>
                <div class="col-sm-6">
                        <input type="text" class="form-control"style="font-size:20px" placeholder="Correo" id="Correo" name="Correo" value=<?php echo $Correo;?>>
                </div>
            </div>

            <div class="row mb-3" id="Genero">
                <label class="col-sm-3 col-form-label"style="font-size:20px">Genero</label>
                <div class="col-sm-6">
                    <input type="radio" class="form-check-input"style="font-size:20px" name="Genero" id="option-1" value="M"  <?php echo ($Genero=='M')?'checked':'' ?>>
                    <label class="form-check-label"style="font-size:20px" for="option-1">Hombre</label> 
                    <input type="radio" class="form-check-input"style="font-size:20px" name="Genero" id="option-2" value="F" <?php echo ($Genero=='F')?'checked':'' ?>>
                    <label class="form-check-label"style="font-size:20px" for="option-2">Mujer</label> 
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"style="font-size:20px">Dirección</label>
                <div class="col-sm-6">
                        <input type="text" class="form-control"style="font-size:20px" placeholder="Direccion" id="Direccion" name="Direccion" maxlength="15" value=<?php echo $Direccion;?>>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"style="font-size:20px">Teléfono</label>
                <div class="col-sm-6">
                        <input type="text" class="form-control"style="font-size:20px" inputMode="numeric" placeholder="+58 xxxx-xxxxxxx" id="Telefono" name="Telefono" value=<?php echo $Numero;?>>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"style="font-size:20px">Fecha de Nacimiento</label>
                <div class="col-sm-6">
                        <input type="date" id="Fecha-Insertar"style="font-size:20px" max="2023-12-31" name="Fecha" class="input-group date" value=<?php echo $Fecha;?>>
                </div>
            </div>
            </div>
        </form>
        <button type="submit" class="btn btn-primary" onClick="registrar()">Guardar Cambios</button>
        <button type="submit" class="btn btn-secondary" onclick="regresar()">Regresar</button>


</section>















<footer class="footer">

   &copy; Todos los derechos reservado por <span>Corblaserca</span> | 2023 all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="Scripts/profile-edit.js"></script>

<script src="Scripts/home.js"></script>

   
</body>
</html>