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
   <?php echo"<title>Estudiantes $nomb_cur</title>"?>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="assets/styles/css/style copy.css">

   <link rel="stylesheet" href="assets/styles/css/cursos.css">
   <link rel="stylesheet" href="subir.css">
</head>
<body>

<header class="header">
   
   <section class="flex">

      <a href="home.php" class="logo">Corblaserca.</a>   

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
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

<section>
<h2 style='font-size:40px'>Lista Estudiantes</h2>  
<form action="php/exportar-alumnos.php" method="post" class="mb-2">
            <input type="submit" name="submit" class="btn btn-outline-danger" value="Exportar PDF">

        </form>
   <br>
        <table class="table">
            <thead>
                <tr>
                    <th style="font-size:20px">Cedula</th>
                    <th style="font-size:20px">Nombre</th>
                    <th style="font-size:20px">Apellido</th>
                    <th style="font-size:20px">Calificacion</th>
                    <th style="font-size:20px"></th>
                </tr>
            </thead>
            <tbody id="showdata">
            <?php
            $query = "SELECT * FROM usuario_has_cursos WHERE Usuario_rol='Estudiante' AND Cursos_ID_cur='$Cursos_ID_cur'";
            $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
            foreach ($result as $row){
            $Usuario_ID_user = $row['Usuario_ID_user'];   
            $query_2 = "SELECT * FROM usuario WHERE cedu_user='$Usuario_ID_user'";
            $result_2 = $conectar->query($query_2)->fetchAll(PDO::FETCH_BOTH);
            foreach ($result_2 as $row_2){
               echo"
                   <tr>
                       <td style='font-size:20px'>$row[Usuario_ID_user]</td>
                       <td style='font-size:20px'>$row_2[nomb_user]</td>
                       <td style='font-size:20px'>$row_2[apelli_user]</td>
                       <td style='font-size:20px'>$row[calificacion_user]</td>
                       <td>";
                       if($Rol_usuario=="Profesor"){
                        echo "<a class='btn btn-primary btn-sm' href='estudiantes-editar.php?editarid=$row[Usuario_ID_user]'>Editar</a>";

                       }
                       echo "
                        </td>
                   </tr>
               ";
           }
         }


            ?>
         </tbody>
      </table>


</section>







<<!--footer class="footer">

   &copy; copyright @ 2022 by <span>mr. web designer</span> | all rights reserved!

</footer>-->

<!-- custom js file link  -->
<script src="Scripts/home.js"></script>

   
</body>
</html>