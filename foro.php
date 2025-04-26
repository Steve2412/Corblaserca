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

$query = "SELECT * FROM usuario_has_cursos WHERE Usuario_ID_user = '$usuario'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Cursos_ID_cur = $row['Cursos_ID_cur'];
    $Rol_usuario = $row['Usuario_rol'];
}

if(!$result){
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
}

if($Rol_usuario=="Administrador"){
   echo "<script> location.href='administrador.php' </script>";

}

if ($estado_cur=="Eliminado"){
   echo '<script language="javascript">
   window.location = "home.php"
   </script>';
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
   <title>Foro</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
      <link rel="stylesheet" href="assets/styles/css/style copy.css">
      <link rel="stylesheet" href="assets/styles/css/foro.css">


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
      <a href="home.php"><i class="fas fa-home"></i><span>Inicio</span></a>
      <a href="cursos.php"><i class="fas fa-chalkboard-teacher"></i><span>Curso</span></a>
      <a href="foro.php"><i class="fa fa-comments"></i><span>Foro</span></a>
      <a href="estudiantes.php"><i class="fas fa-graduation-cap"></i><span>Estudiantes</span></a>
   </nav>

</div>


<section class="courses">

<div class="section py-5">
    <div class="container">
        <div class="card rounded-0 shadow">
            <div class="card-body">
                <div class="contrain-fluid">
                  <div style="line-height:1em" class="mb-3">
                        <h2 class="font-weight-bold mb-0 border-bottom">Foro de discusion</h2><br><br><br>
                    </div>
                    <div>
                        <p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: "Open Sans", Arial, sans-serif; font-size: 14px;">Los foros chat de una página de estudios a distancia pueden ser un excelente lugar para conectar a estudiantes, profesores y otros usuarios para compartir recursos, problemas y experiencias. Esto permite a los usuarios compartir su conocimiento, aprender de los demás y obtener información importante para el éxito de sus estudios. Los foros chat también pueden ser una excelente herramienta para formar una comunidad de estudiantes, profesores y otros usuarios que pueden ayudarse mutuamente con sus experiencias. Esto ayuda a los usuarios a mejorar sus habilidades y conocimientos, así como a desarrollar nuevas habilidades. Los foros chat también pueden servir como un punto de encuentro para todos los usuarios para compartir conocimiento, discutir temas de interés y formar redes de apoyo entre los usuarios. Esto también puede ayudar a los usuarios a desarrollar habilidades de comunicación, así como a aprender nuevos estilos de aprendizaje. Por último, los foros chat también pueden ayudar a los usuarios a obtener nuevas oportunidades laborales y a conocer mejor a sus compañeros de clase. </p>                    
                     </div>
                    <hr class="mx-n3">
                    <h4 class="font-weight-bolder">Mensajes:</h4>


                    <?php

                     $query = "SELECT * FROM foro WHERE curso_id_foro = '$Cursos_ID_cur'"; 
                     $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);

                     if($result){
                        foreach ($result as $row) {
                           $cedula_estudiante = $row['usuario_id_foro'];
                           $mensaje_foro = $row['mensaje_foro'];
                           $fecha_mensaje_foro = $row['fecha_mensaje_foro'];
                           $query_2 = "SELECT * FROM usuario WHERE cedu_user='$cedula_estudiante'";
                           $result_2 = $conectar->query($query_2)->fetchAll(PDO::FETCH_BOTH);
                           if ($result_2){
                              foreach ($result_2 as $row_2){
                                 $Nombre_Estudiante = $row_2['nomb_user'];
                                 $Apellido_Estudiante = $row_2['apelli_user'];
                              }
                           }

                              echo "
                              <ul class='list-group'>
                              <li class='list-group-item'>
                                  <div class='pull-left hidden-xs'>
                                      <div>
                                       <img class='img-circle' width='40' height='40' title=$Nombre_Estudiante src='Images/pic-1.jpg'>                    
                                      </div>
                                  </div>
                                  <small class='pull-right text-muted'>$fecha_mensaje_foro</small>
                                  <div>
                                      <small class='font-weight-bold'>$Nombre_Estudiante $Apellido_Estudiante</small>
                                      <p class='list-group-item-text'>
                                          $mensaje_foro
                                      </p>";
                                      if($cedula_estudiante==$usuario) {
                                       echo "<a href='php/eliminar-mensaje.php?deleteid=$mensaje_foro' onclick='return checkdelete();' class='link-danger'>Eliminar</a>
                                       ";
                                      }
                                      echo"

                                  </div>
                              </li>
                              </ul>";
                           }
                        }
                       ?>
                     


                  <a class="btn btn-primary btn-sm" href="foro-editar.php">Escribe un mensaje</a>


            </div>
        </div>
    </div>
</div>

</section>















<footer class="footer">

   &copy; Todos los derechos reservado por <span>Corblaserca</span> | 2023 all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="Scripts/home.js"></script>

<script>
    function checkdelete(){
        return confirm('¿Estas seguro deseas borrar este mensaje?');
    }
    </script>

   
</body>
</html>