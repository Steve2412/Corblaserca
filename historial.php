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

if($Rol_usuario=="Administrador"){
   echo "<script> location.href='administrador.php' </script>";

}

if ($Estado=="Eliminado"){
   echo '<script language="javascript">
   window.location = "index.html"
   </script>';
   die();
   session_destroy(); 
}


$query = "SELECT * FROM cursos WHERE ID_cur = '$Cursos_ID_cur'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $nomb_cur = $row['nomb_cur'];
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
}

$query = "SELECT * FROM periodo WHERE ID_peri = '$ID_Periodo'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $fech_ini_peri = $row['fech_ini_peri'];
    $fech_fin_peri = $row['fech_fin_peri'];
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
   <title>Historial Pago</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <!-- custom css file link  -->
      <link rel="stylesheet" href="assets/styles/css/style (2).css">

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
         <h3 class='name'> <?php echo $Nombre ?></h3>
         <p class='role'><?php echo $Rol_usuario ?></p>
         <?php
         if($Estado=="Activo"){
            echo "<a href='profile.php' class='btn'>Ver perfil</a>";

         }
         ?>
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
      <h3 class='name'><?php echo $Nombre?></h3>
      <p class='role'><?php echo $Rol_usuario?></p>
      <?php
         if($Estado=="Activo"){
            echo "<a href='profile.php' class='btn'>Ver perfil</a>
            ";

         }
         ?>
   </div>

   <nav class="navbar">

   <?php

   if($Estado=="Activo"){
      echo "<a href='home.php'><i class='fas fa-home'></i><span>Inicio</span></a>";
      echo "<a href='horario.php'><i class='fa-solid fa-calendar-days'></i><span>Horario</span></a>";
   }

   ?>

<?php

if($Estado=="Inactivo"){
   echo "<a href='notifipago.php'><i class='fa fa-dollar'></i><span>Reporte de pagos</span></a>";
}

?>
      <?php 
         if($Rol_usuario=="Estudiante"){
         
         echo "<a href='historial.php'><i class='fa fa-file-text-o'></i><span>Historial reporte</span></a>
         "; 
      }
      ?>

      <!--<a href="contact.html"><i class="fas fa-headset"></i><span>contact us</span></a>-->
   </nav>

</div>


<section class="historial">

   <h1 class="heading">Historial de pagos del Estudiante</h1>

   <div class="container-historial">

   <?php

   $query = "SELECT * FROM notifipago WHERE usuario_notifipago  = '$usuario'"; 
   $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
   foreach ($result as $row){
   $id_notifipago = $row['id_notifipago'];
   $monto_notifipago = $row['monto_notifipago'];
   $referencia_notifipago = $row['referencia_notifipago'];
   $fecha_notifipago = $row['fecha_notifipago'];
   $estado_notifipago = $row['estado_notifipago'];

   echo "
   <div class='cubo'>";?>

   <textarea id="id" name="id" hidden value=<?php echo $id_notifipago;?>><?php echo $id_notifipago;?></textarea> 

   <?php

   if($estado_notifipago=="Rechazado"){
      echo "<h3 class='estatus-rechazo'>$estado_notifipago</h3>
      <h3 class='fecha-pago'>$fecha_notifipago</h3>

      <h3 class='Referencia-pago'>Nro. Referencia $referencia_notifipago</h3>
   
      <h3 class='monto-pago'>$monto_notifipago Bs.D</h3>
   
      <form action='php/recibo.php?exportarid=$id_notifipago' method='post' class='mb-2'>
         <input type='submit' name='submit' class='boton-detalles' value='Exportar PDF'>
      </form>
       
    </div>
      ";
      
   }else if($estado_notifipago=="Pendiente"){
      echo "<h3 class='estatus-Pendiente'>$estado_notifipago</h3>

      <h3 class='fecha-pago'>$fecha_notifipago</h3>
   
      <h3 class='Referencia-pago'>Nro. Referencia $referencia_notifipago</h3>
   
      <h3 class='monto-pago'>$monto_notifipago Bs.D</h3>
   
      <form action='php/recibo.php?exportarid=$id_notifipago' method='post' class='mb-2'>
         <input type='submit' name='submit' class='boton-detalles' value='Exportar PDF'>
      </form>
       
    </div>
    ";

   }else{

   echo "<h3 class='estatus-pago'>$estado_notifipago</h3>

   <h3 class='fecha-pago'>$fecha_notifipago</h3>

   <h3 class='Referencia-pago'>Nro. Referencia $referencia_notifipago</h3>

   <h3 class='monto-pago'>$monto_notifipago Bs.D</h3>

   <form action='php/recibo.php?exportarid=$id_notifipago' method='post' class='mb-2'>
      <input type='submit' name='submit' class='boton-detalles' value='Exportar PDF'>
   </form>
    
 </div>
   
   ";

   }}
   ?>
      





</section>














<footer class="footer">

   &copy; Todos los derechos reservado por <span>Corblaserca</span> | 2023 all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="Scripts/home.js"></script>

   
</body>
</html>