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
    $conte_text= $row['conte_text'];
    $estado_cur = $row['estado_cur'];

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

if ($estado_cur=="Eliminado"){
   echo '<script language="javascript">
   window.location = "home.php"
   </script>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php echo"<title>$nomb_cur</title>"?>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="assets/styles/css/style.css">

   <link rel="stylesheet" href="assets/styles/css/cursos.css">
</head>
<body>

<header class="header">
   
   <section class="flex">

      <a href="home.php" class="logo">Corblaserca.</a>   

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
      <a href="home.php"><i class="fas fa-home"></i><span>Inicio</span></a>
      <a href="cursos.php"><i class="fas fa-chalkboard-teacher"></i><span>Curso</span></a>
      <a href="foro.php"><i class="fa fa-comments"></i><span>Foro</span></a>
      <a href="estudiantes.php"><i class="fas fa-graduation-cap"></i><span>Estudiantes</span></a>
   </nav>

</div>

<section id="wrap" class="playlist-details">

<?php 

if($Rol_usuario=="Profesor"){
   echo  "<a class='btn btn-primary btn-sm' href='cursos-editar.php'>Editar</a>";
}

if($Rol_usuario=="Administrador"){
   echo "<script> location.href='administrador.php' </script>";

}  

?>
<br><br><br>
<?php echo $conte_text ?>

 <!--<section id="wrap" class="playlist-videos">
   <iframe width="560" height="315" src=<?php echo $conte_video ?> title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    <br>
    <br><br>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/9p-_NhWuuZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</section>
<section id="wrap" class="descargar-section">
    <h3 class="descargar">Descargar pdf de ingles I</h3>
    <a class="descargar-btn" href=<?php ?>download="manual ingles basico.pdf">Descargar archivo</a>
</section>

<section id="wrap" class="exercises">
<h3 class="exercise-h1">Ejercicios de pronombres personales y posesivos</h3>

<a class="exercise-a" href="https://agendaweb.org/exercises/grammar/pronouns/subject-object-possessive">Personal and posesive pronouns</a>
</section>







<footer class="footer">

   &copy; Todos los derechos reservado por <span>Corblaserca</span> | 2023 all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="Scripts/home.js"></script>

   
</body>
</html>