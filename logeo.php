<?php
session_start();
if(isset( $_SESSION["locked"]))
{
  $diferrence = time();
  if($diferrence>=$_SESSION["locked"]){
    unset($_SESSION["locked"]);
    unset($_SESSION["intento_logeo"]);
  }
}
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Iniciar Sesion</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="assets/styles/css/Navbar.css">
    <link rel="stylesheet" href="assets/styles/css/Login.css">
    <link rel="stylesheet" href="assets/styles/css/footerdef.css">
    <link href="https://fonts.googleapis.com/css2?family=Arimo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">

</head>
<body>

  <div class="menu-cont">
    <header>
      <nav class="navbar">
        <input type="checkbox" id="check" >
        <label for="check" class="checkbtn">
          <i class="fa-solid fa-bars"></i>
        </label>
        <a href="index.html" class="enlace">
          <img class="logo" src="assets/img/logo.png" />
        </a>          
        <h1 class="brand">CORBLASERCA</h1>
        <ul class="elements">
          <li class="element"><a href="index.html" class="a-menu">Inicio</a></li>
          <li class="element"><a href="cursoslanding.html" class="a-menu">Cursos</a></li>
          <li class="element"><a href="logeo.php" class="a-menu">Iniciar sesión</a></li>
          <li class="element"><a href="metodosPago.html" class="a-menu">Métodos de pago</a></li>
          <li class="element"><a href="acercaDe.html" class="a-menu">Acerca de nosotros</a></li>
          <li class="element"><a href="faq.html" class="a-menu">FAQ</a></li>
        </ul>
      </nav>
    </header>
  </div>
  <br>
  <br>
  <div class="Fondo-Blanco"> 
            <h1 class="Login-Texto"> Ingresa tus datos</h1>
                <form class="Formulario" method="POST" onsubmit="return false">
                        <input type="number" inputMode="numeric" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="Cédula" id="Cedula" name="Cedula" required placeholder="Ingrese Cedula" oninvalid="setCustomValidity('Ingrese Cedula')"
                        oninput="this.setCustomValidity('')"></input>
                        <input type="password" placeholder="Contraseña" id="Contraseña" name="Contra"required placeholder="Ingrese Contraseña" oninvalid="setCustomValidity('Ingrese Contraseña')"
                        oninput="this.setCustomValidity('')"></input>
                      
                    <?php 
                    if (isset($_SESSION["locked"])){
                        echo "<button class='Boton-Iniciar-apagado' disabled>Desactivado</button>";

                      }else{
                      echo "<button class='Boton-Iniciar' type='submit' onclick='Iniciar_Sesion()'>Iniciar Sesión</button>";
                    }
                    ?> 
                    <button class="Boton-Registrar" onclick="Registrar()"> Registrarse</button>
                    <a class="Recuperar" href="recuperar.html">¿Olvidaste tú contraseña? </a>
               
                   <img class="Imagen-Login" src="assets/img/password.png">
               
                </form>  
  </div>
   
  <footer class="footer">
    <div class="container-foo">
      <div class="row"> 
        <div class="footer-col">
          <h4>Compañía</h4>
          <ul class="ul-foo">
            <li><a href="acercaDe.html" class="a-foo">Sobre nosotros</a></li>
            <li><a href="cursoslanding.html" class="a-foo">Cursos</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Obtener ayuda</h4>
          <ul class="ul-foo">
            <li><a href="faq.html" class="a-foo">FAQ</a></li>
            <li><a href="logeo.php" class="a-foo">Reportar pago</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Registrarse</h4>
          <ul class="ul-foo">
            <li><a href="registro.html" class="a-foo">Registrarse</a></li>
            <li><a href="logeo.php" class="a-foo">Iniciar Sesión</a></li>
          </ul>
        </div>
            <div class="footer-col">
              <h4>Síguenos</h4>
              <div class="social-links">
                <a href="https://www.facebook.com/profile.php?id=100095263480479&mibextid=ZbWKwL" class="a-foo"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/corblacerca_edu/?igshid=MzNlNGNkZWQ4Mg%3D%3D" class="a-foo"><i class="fab fa-instagram"></i></a>
                <a href="https://api.whatsapp.com/send?phone=584149664100" class="a-foo"><i class="fab fa-whatsapp"></i></a>
              </div>
            </div>
      </div>
    </div>
  </footer>

  <script src="Scripts/login.js"></script>
    
</body>
</html>