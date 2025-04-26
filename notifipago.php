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

if(!$result){
   echo '<script language="javascript">
   window.location = "index.html"
   </script>';
   die();
   session_destroy(); 
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
   <title>Notificación Pago</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="assets/styles/css/style.css">

   <link rel="stylesheet" href="assets/styles/css/notipago.css">
</head>
<body>

<header class="header">
   
   <section class="flex">

      <a class="logo">Corblaserca.</a>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <img src="Images/pic-1.jpg" class="image" alt="">
         <?php echo "<h3 class='name'>$Nombre</h3>" ?>
         <?php echo "<p class='role'>$Rol_usuario</p>" ?>
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
   </div>

   <nav class="navbar">
      <a href="notifipago.php"><i class="fa fa-dollar"></i><span>Reporte de pagos</span></a>
      <a href="historial.php"><i class="fa fa-file-text-o"></i><span>Historial reporte</span></a>
      <!--<a href="contact.html"><i class="fas fa-headset"></i><span>contact us</span></a>-->
   </nav>   

</div>

<div class="menu-cont">
  </div>
  <div class="body">
    <form class="Formulario" onsubmit="return false">
        <h2 class="encabezado2">Notificación de pago</h2>
    <span class="line"></span>
    <p>Ingresa cada uno de los campos</p>

      <div class="input-group">
      <label for="monto" >Monto en Bs. D</label>
        <input type="text" onkeyup="agregarDecimal()" placeholder="2500.00" id="Monto" name="Monto">

        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Seleccione Banco</label><br><br>
                <div class="selectWrapper">
                    <select class="selectBox" name="Banco" id="Banco">
                        <option value="Banco de Venezuela">Banco de Venezuela</option>
                        <option value="Banesco">Banesco</option>
                        <option value="Banco Provincial">Banco Provincial</option>
                        <option value="Banco Nacional de Crédito">Banco Nacional de Crédito</option>
                        <option value="Bancrecer">Bancrecer</option>
                        <option value="Banco Mercantil">Banco Mercantil</option>
                        <option value="Banco del Tesoro">Banco del Tesoro</option>
                        <option value="Banco Exterior">Banco Exterior</option>
                        <option value="Banco Bicentenario">Banco Bicentenario</option>
                        <option value="Banco Venezolano de Crédito">Banco Venezolano de Crédito</option>

                    </select>
                </div>
            </div><br><br>



      <!--<div class="Banco">
         <label class="radio-label-title" for="banco">Seleccione el banco</label>
         <div>
            <input class="radio-input" type="radio" id="option-1" name="Banco" value="Banco de Venezuela" checked>
            <label class="radio-label">Banco de Venezuela</label><br>
        </div>
        <div>
            <input class="radio-input" type="radio" id="option-2" name="Banco" value="Banesco">
            <label class="radio-label">Banesco</label><br>
        </div>
        <div>
            <input class="radio-input" type="radio" id="option-3" name="Banco" value="Banco Provincial">
            <label class="radio-label">Banco Provincial</label>
        </div>
        <div>  
            <input class="radio-input" type="radio" id="option-4" name="Banco" value="Banco Nacional de Crédito">
            <label class="radio-label">Banco Nacional de crédito</label>
        </div>
        <div>
            <input class="radio-input" type="radio" id="option-5" name="Banco" value="Bancrecer">
            <label class="radio-label">Bancrecer</label> 
        </div>
        </div>-->

        <label for="cedula">Cédula del titular de la cuenta</label>
        <input type="number" name="Cedu_Titu" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="Cédula" id="Cedu_Titu">

        <label for="fecha">Fecha de la transferencia</label>
        <input type="date" name="Fecha_Trans" placeholder="2023/02/04" max="2023-12-31" id="Fecha_Trans">

        <label for="cedula">Número de referencia</label>
        <input type="number" name="Num_Trans" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="ej. 58435348" id="Num_Trans">

        <label for="motivo">Motivo de pago</label>
        <input type="text" id="Motivo" name="Motivo">
        <button type="submit" class="btn btn-primary" onclick="pago()">Notificar pago</button>

    </div>
    </form>
  </div>


<footer class="footer">

   &copy; copyright @ 2022 by <span>mr. web designer</span> | all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="Scripts/notifipago.js"></script>
<script src="Scripts/home.js"></script>

   
</body>
</html>