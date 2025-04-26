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
    $ID_Periodo = $row['Periodo_ID_peri'];
}

if(!$result){
   echo '<script language="javascript">
   window.location = "index.html"
   </script>';
   die();
   session_destroy(); 
}

if ($Estado=="Inactivo" AND ($Rol_usuario=="Profesor" || $Rol_usuario=="Administrador")){
   echo '<script language="javascript">alert("No tiene acceso al sistema actualmente");</script>';
   echo '<script language="javascript">
   window.location = "index.html"
   </script>';
   die();
   session_destroy();   
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

$query = "SELECT * FROM cursos WHERE ID_cur = '$Cursos_ID_cur'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $nomb_cur = $row['nomb_cur'];
    $estado_cur = $row['estado_cur'];
}

$query = "SELECT * FROM usuario_has_cursos WHERE Cursos_ID_cur = '$Cursos_ID_cur' AND Usuario_rol='Profesor'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $cedu_profe = $row['Usuario_ID_user'];
}

$query = "SELECT * FROM usuario WHERE cedu_user = '$cedu_profe'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Profesor = $row['nomb_user'];
    $Profesor_B = $row['apelli_user'];

}

$query = "SELECT * FROM periodo WHERE ID_peri = '$ID_Periodo'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $fech_ini_peri = $row['fech_ini_peri'];
    $fech_fin_peri = $row['fech_fin_peri'];
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Corblaserca - Inicio</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


   <!-- custom css file link  -->
      <link rel="stylesheet" href="assets/styles/css/style.css">

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

   <nav class="navbar">
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

   <h1 class="heading">Idiomas que estas cursando en este momento </h1>

   <?php
   
   if($estado_cur=="Eliminado"){
      
   }else{
      ?>
         <div class="box-container">

            <div class="box">
               <div class="tutor">
                  <img src="Images/pic-3.jpg" alt="">
                     <div class="info">
                        <?php echo "<h3>$Profesor $Profesor_B</h3>" ?>
                        <span><?php echo $fech_ini_peri?> - <?php echo $fech_fin_peri?></span>
                     </div>
                  </div>
                  <div class="thumb">
                     <img src="Images/Teachers-are-calling-for-the-government-to-introduce-new-measures-tackle-a-steady-decline-in-language-learning-in-English-schools..jpg">
                  </div>
                  <?php echo "<h3 class='title'>$nomb_cur</h3>" ?>
         <a href="cursos.php" class="inline-btn">Ver curso</a>
      </div>     
   <?php } ?>
   
   
   
   


</section>















<footer class="footer">

   &copy; Todos los derechos reservado por <span>Corblaserca</span> | 2023 all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="Scripts/home.js"></script>

   
</body>
</html>