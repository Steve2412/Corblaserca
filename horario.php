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

$query = "SELECT * FROM usuario_has_cursos WHERE Cursos_ID_cur = '$Cursos_ID_cur' AND Usuario_rol='Admin'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Rol_profe = $row['Usuario_rol'];
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
   <title>Horario</title>
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
      <a href="home.php"><i class="fas fa-home"></i><span>Inicio</span></a>
      <a href="horario.php"><i class="fa-solid fa-calendar-days"></i><span>Horario</span></a>
      <?php 
         if($Rol_usuario=="Estudiante"){
         
         echo "<a href='historial.php'><i class='fa fa-file-text-o'></i><span>Historial reporte</span></a>"; 
      }
      ?>

      <!--<a href="contact.html"><i class="fas fa-headset"></i><span>contact us</span></a>-->
   </nav>

</div>


<section class="courses">
<div class="container">
                <div class="timetable-img text-center">
                    <img src="img/content/timetable.png" alt="">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr class="bg-light-gray">
                                <th class="text-uppercase">Hora
                                </th>
                                <th class="text-uppercase">Lunes</th>
                                <th class="text-uppercase">Martes</th>
                                <th class="text-uppercase">Miercoles</th>
                                <th class="text-uppercase">Jueves</th>
                                <th class="text-uppercase">Viernes</th>
                                <th class="text-uppercase">Sabado</th>
                            </tr>
                        </thead>
                        <?php
                            if($horar_cur=="Lunes a Viernes 08:00am a 10:00am"){
                              echo "
                              <tbody style='font-size:20px'>
                              <tr>
                              <td class='align-middle'>08:00am-9:00am</td>
                              <td>
                                  <span class=>$nomb_cur</span>
                              </td>
                              <td>
                                  <span class=>$nomb_cur</span>
                              </td>
                              <td>
                                  <span class=>$nomb_cur</span>
                               </td>
                              <td>
                                  <span class=>$nomb_cur</span>
                              </td>
                              <td>
                                  <span class=>$nomb_cur</span>
                              </td>
                              <td>
                                  <span class=></span>
                              </td>
                          </tr>

                           <tr>
                           <td class='align-middle'>09:00am-10:00am</td>
                           <td>
                                 <span class=>$nomb_cur</span>
                           </td>
                           <td>
                                 <span class=>$nomb_cur</span>
                           </td>
                           <td>
                                 <span class=>$nomb_cur</span>
                              </td>
                           <td>
                                 <span class=>$nomb_cur</span>
                           </td>
                           <td>
                                 <span class=>$nomb_cur</span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                        </tr>


                           <tr>
                           <td class='align-middle'>10:00am-11:00am</td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                        </tr>

                              <tr>
                              <td class='align-middle'>11:00am-12:00pm</td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                        </tr>

                           <tr>
                           <td class='align-middle'>12:00pm-01:00pm</td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                              </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                        </tr>

                           <tr>
                           <td class='align-middle'>01:00pm-02:00pm</td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                        </tr>

                              </tbody>
                              <form action='php/exportar-horario8-10.php' method='post' class='mb-2'>
                              <input type='submit' name='submit' class='btn btn-outline-danger' value='Exportar PDF'>
                  
                          </form>";
                            }else if ($horar_cur=="Lunes a Viernes 10:00am a 12:00pm"){
                              echo "
                              <tbody style='font-size:20px'>
                              <tr>
                              <td class='align-middle'>08:00am-9:00am</td>
                              <td>
                                  <span class=></span>
                              </td>
                              <td>
                                  <span class=></span>
                              </td>
                              <td>
                                  <span class=></span>
                               </td>
                              <td>
                                  <span class=></span>
                              </td>
                              <td>
                                  <span class=></span>
                              </td>
                              <td>
                                  <span class=></span>
                              </td>
                          </tr>

                           <tr>
                           <td class='align-middle'>09:00am-10:00am</td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                              </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                        </tr>


                           <tr>
                           <td class='align-middle'>10:00am-11:00am</td>
                           <td>
                              <span class=>$nomb_cur</span>
                           </td>
                           <td>
                              <span class=>$nomb_cur</span>
                           </td>
                           <td>
                              <span class=>$nomb_cur</span>
                           </td>
                           <td>
                              <span class=>$nomb_cur</span>
                           </td>
                           <td>
                              <span class=>$nomb_cur</span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                        </tr>

                              <tr>
                              <td class='align-middle'>11:00am-12:00pm</td>
                              <td>
                                 <span class=>$nomb_cur</span>
                              </td>
                              <td>
                                 <span class=>$nomb_cur</span>
                              </td>
                              <td>
                                 <span class=>$nomb_cur</span>
                              </td>
                              <td>
                                 <span class=>$nomb_cur</span>
                              </td>
                              <td>
                                 <span class=>$nomb_cur</span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                        </tr>

                           <tr>
                           <td class='align-middle'>12:00pm-01:00pm</td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                              </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                        </tr>

                           <tr>
                           <td class='align-middle'>01:00pm-02:00pm</td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                        </tr>
                        </tbody>
                        <form action='php/exportar-horario10-12.php' method='post' class='mb-2'>
                        <input type='submit' name='submit' class='btn btn-outline-danger' value='Exportar PDF'>
            
                    </form>";
                        
                            }else if ($horar_cur=="Lunes a Viernes 12:00pm a 02:00pm"){
                              echo "
                              <tbody style='font-size:20px'>
                              <tr>
                              <td class='align-middle'>08:00am-9:00am</td>
                              <td>
                                  <span class=></span>
                              </td>
                              <td>
                                  <span class=></span>
                              </td>
                              <td>
                                  <span class=></span>
                               </td>
                              <td>
                                  <span class=></span>
                              </td>
                              <td>
                                  <span class=></span>
                              </td>
                              <td>
                                  <span class=></span>
                              </td>
                          </tr>

                           <tr>
                           <td class='align-middle'>09:00am-10:00am</td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                              </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                        </tr>


                           <tr>
                           <td class='align-middle'>10:00am-11:00am</td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                        </tr>

                              <tr>
                              <td class='align-middle'>11:00am-12:00pm</td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                        </tr>

                           <tr>
                           <td class='align-middle'>12:00pm-01:00pm</td>
                           <td>
                                 <span class=>$nomb_cur</span>
                           </td>
                           <td>
                                 <span class=>$nomb_cur</span>
                           </td>
                           <td>
                                 <span class=>$nomb_cur</span>
                              </td>
                           <td>
                                 <span class=>$nomb_cur</span>
                           </td>
                           <td>
                                 <span class=>$nomb_cur</span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                        </tr>

                           <tr>
                           <td class='align-middle'>01:00pm-02:00pm</td>
                           <td>
                              <span class=>$nomb_cur</span>
                           </td>
                           <td>
                              <span class=>$nomb_cur</span>
                           </td>
                           <td>
                              <span class=>$nomb_cur</span>
                           </td>
                           <td>
                              <span class=>$nomb_cur</span>
                           </td>
                           <td>
                              <span class=>$nomb_cur</span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                        </tr>
                        </tbody>
                        <form action='php/exportar-horario12-2.php' method='post' class='mb-2'>
                        <input type='submit' name='submit' class='btn btn-outline-danger' value='Exportar PDF'>
            
                    </form>";
                            } else if($horar_cur=="Sabado de 08:00am a 01:00pm"){
                              echo "
                              <tbody style='font-size:20px'>
                              <tr>
                              <td class='align-middle'>08:00am-9:00am</td>
                              <td>
                                  <span class=></span>
                              </td>
                              <td>
                                  <span class=></span>
                              </td>
                              <td>
                                  <span class=></span>
                               </td>
                              <td>
                                  <span class=></span>
                              </td>
                              <td>
                                  <span class=></span>
                              </td>
                              <td>
                                  <span class=>$nomb_cur</span>
                              </td>
                          </tr>

                           <tr>
                           <td class='align-middle'>09:00am-10:00am</td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                              </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=>$nomb_cur</span>
                           </td>
                        </tr>


                           <tr>
                           <td class='align-middle'>10:00am-11:00am</td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=></span>
                           </td>
                           <td>
                              <span class=>Descanso</span>
                           </td>
                        </tr>

                              <tr>
                              <td class='align-middle'>11:00am-12:00pm</td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=></span>
                              </td>
                              <td>
                                 <span class=>$nomb_cur</span>
                              </td>
                        </tr>

                           <tr>
                           <td class='align-middle'>12:00pm-01:00pm</td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                              </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=></span>
                           </td>
                           <td>
                                 <span class=>$nomb_cur</span>
                           </td>
                        </tr>
                        </tbody>                        
                        <form action='php/exportar-horario8-12.php' method='post' class='mb-2'>
                        <input type='submit' name='submit' class='btn btn-outline-danger' value='Exportar PDF'>
            
                    </form>";
                            }
                            
                            ?>

                    </table>
                </div>
            </div>

</section>















<footer class="footer">

   &copy; Todos los derechos reservado por <span>Corblaserca</span> | 2023 all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="Scripts/home.js"></script>

   
</body>
</html>