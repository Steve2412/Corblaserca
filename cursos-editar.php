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


$query = "SELECT * FROM cursos WHERE ID_cur = '$Cursos_ID_cur'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $nomb_cur = $row['nomb_cur'];
    $conte_text= $row['conte_text'];
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
   <?php echo"<title>$nomb_cur</title>"?>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="assets/styles/css/style.css">

   <link rel="stylesheet" href="assets/styles/css/cursos.css">
   <link rel="stylesheet" href="subir.css">
</head>
<body>

<header class="header">
   
   <section class="flex">

      <a href="home.php" class="logo">Corblaserca.</a>   

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
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
   echo  "<a class='btn btn-primary btn-sm' onclick='registrar()';'>Guardar Cambios</a>";
   echo  "<a class='btn btn-primary btn-sm' href='cursos.php';'>Regresar</a>";
}

?>

<form id="Formulario">
<div class="col-sm-6">
   <textarea type="text" id="Contenido" style="width:1000px;height:600px;" name="Contenido" cols="40" class="form-control" ><?php echo $conte_text;?></textarea>
</div>
</form>


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

   &copy; copyright @ 2022 by <span>mr. web designer</span> | all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="Scripts/home.js"></script>
<script src="https://cdn.tiny.cloud/1/j2mhmpoyrt6wygu0k1vrfxap9m9j5zwto1gemng6nbuypahn/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: '#Contenido',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });

    var formulario = document.querySelector("#Formulario");

function regresar(){
  window.location.href = "../crud-admin-cursos.php";

}

function registrar(){
    var editor = tinyMCE.triggerSave('#Contenido');
    var datos = new FormData(formulario);
    console.log(datos.get("Contenido"))
    fetch("php/actualizar-contenido.php", {
        method: "POST",
        body: datos,
      })
        .then(res => res.json())
        .then(data => {
          console.log(data);
          if (data === "1") {
            alert("Ya existe el curso");
          }else if(data === "8"){
          alert("Hubo un error")
        } else if (data === "2") {
            alert(
              "Contenido actualizado"
            );
            window.location.href = "../cursos.php";
          }})
}

  </script>

   
</body>
</html>