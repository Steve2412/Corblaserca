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
    $horar_cur = $row['horar_cur'];
}

if ($Estado=="Eliminado"){
   echo '<script language="javascript">
   window.location = "index.html"
   </script>';
   die();
   session_destroy(); 
}

$query = "SELECT * FROM usuario_has_cursos WHERE Cursos_ID_cur = '$Cursos_ID_cur' AND Usuario_rol='Profesor'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Rol_profe = $row['Usuario_rol'];
}

if($Rol_usuario=="Profesor"||$Rol_usuario=="Estudiante"){
   echo "<script> location.href='home.php' </script>";

}  

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Administración</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="assets/styles/css/style copy.css">
</head>
<body>

<header class="header">
   
   <section class="flex">

      <a class="logo">Corblaserca</a>

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
      echo "<a href='courses.html'><i class='fas fa-graduation-cap'></i><span>Notas</span></a>";
      } ?>      
      <?php 
      if($Rol_usuario=="Administrador"){
      echo "<a href='administrador.php'><i class='fas fa-graduation-cap'></i><span>Administración</span></a>";
      } ?>
      <!--<a href="contact.html"><i class="fas fa-headset"></i><span>contact us</span></a>-->
   </nav>

</div>


<section class="courses">

<h1 style="font-size:20px; text-align:center;">Menú del Administrador</h1>
<br><br>
<div style="font-size:20px">Usuarios del sistema</div>
<a class='btn btn-primary btn-sm' href='crud-admin-usuario.php'>Usuarios del sistema</a>
<br>
<div style="font-size:20px">Cursos del sistema</div>
<a class='btn btn-primary btn-sm' href='crud-admin-cursos.php'>Cursos</a>
<br>
<div style="font-size:20px">Periodos del sistema</div>
<a class='btn btn-primary btn-sm' href='crud-admin-periodo.php'>Periodos del sistema</a>
<br>
<div style="font-size:20px">Usuarios inscritos en los cursos</div>
<a class='btn btn-primary btn-sm' href='crud-admin-usuario-tiene-cursos.php'>Usuarios inscritos en los cursos</a>
<br><div style="font-size:20px">Historial de Pagos</div>
<a class='btn btn-primary btn-sm' href='crud-admin-historial-pagos.php'>Historial pagos</a>
<br>
<br><div style="font-size:20px">Pagos pendientes</div>
<a class='btn btn-primary btn-sm' href='crud-admin-pendientes-pagos.php'>Pagos pendientes</a>
<br>
<div style="font-size:20px">Copia de seguridad</div>
<a class='btn btn-primary btn-sm' href='composer/backup.php'>Copia de seguridad</a>
<br>
<div style="font-size:20px">Restaurar copia de seguridad</div>
<a class='btn btn-primary btn-sm' href='db_restore/restore.php'>Restaurar copia de seguridad</a>
<br><div style="font-size:20px">Manual de analista</div>
<a class='btn btn-primary btn-sm' href='https://publuu.com/flip-book/192924/478574' target="_blank">Manual de analista</a>
<br>



</section>















<footer class="footer">

   &copy; Todos los derechos reservado por <span>Corblaserca</span> | 2023 all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="Scripts/home.js"></script>

   
</body>
</html>