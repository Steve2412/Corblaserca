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
   <title>Editar Perfil</title>

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
      <?php 
      if($Rol_usuario=="Administrador"){
      echo "<a href='administrador.php'><i class='fas fa-graduation-cap'></i><span>Administracion</span></a>";
      } ?>
      <!--<a href="contact.html"><i class="fas fa-headset"></i><span>contact us</span></a>-->
   </nav>

</div>


<section class="courses">

<h1>Configuraciones del Usuario</h1>


<div class="table">
        <div class="card xl-4">
          <div class="card-body">
            <div class="row">
              <div class="col-xl-3">
                <h2 class="mb-0">Nombre</h2>
              </div>
              <div class="col-xl-9">
              <h2 class="text-muted mb-0"><?php echo $Nombre ?></h2>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xl-3">
              <h2 class="mb-0">Apellido</h2>
              </div>
              <div class="col-xl-9">
              <h2 class="text-muted mb-0"><?php echo $Apellido ?></h2>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xl-3">
              <h2 class="mb-0">Correo</h2>
              </div>
              <div class="col-xl-9">
              <h2 class="text-muted mb-0"><?php echo $Correo ?></h2>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xl-3">
              <h2 class="mb-0">Cédula</h2>
              </div>
              <div class="col-xl-9">
              <h2 class="text-muted mb-0"><?php echo $usuario ?></h2>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xl-3">
              <h2 class="mb-0">Dirección</h2>
              </div>
              <div class="col-xl-9">
              <h2 class="text-muted mb-0"><?php echo $Direccion ?></h2>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xl-3">
              <h2 class="mb-0">Teléfono</h2>
              </div>
              <div class="col-xl-9">
              <h2 class="text-muted mb-0"><?php echo $Numero ?></h2>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xl-3">
              <h2 class="mb-0">Fecha de nacimiento</h2>
              </div>
              <div class="col-xl-9">
              <h2 class="text-muted mb-0"><?php echo $Fecha ?></h2>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-xl-3">
              <h2 class="mb-0">Genero</h2>
              </div>
              <div class="col-xl-9">
              <h2 class="text-muted mb-0"><?php echo $Genero ?></h2>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-primary" onclick="location.href='profile-edit.php'">Editar</button>


</section>

<footer class="footer">

   &copy; Todos los derechos reservado por <span>Corblaserca</span> | 2023 all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="Scripts/home.js"></script>

   
</body>
</html>