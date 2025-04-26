console.log("Soymegagay");

var intentos = 3;

var formulario = document.querySelector(".Formulario");

var Entrada_Cedula = document.querySelector("#Cedula");
var Entrada_Contraseña = document.querySelector("#Contraseña");
var Boton_Iniciar = document.querySelector(".Boton-Iniciar");
var Contador_Sesion = 3;

function Registrar(){
  window.location.href = "registro.html";
}

function Iniciar_Sesion() {
  if (Entrada_Cedula.value == null || Entrada_Cedula.value === "") {
    alert("Ingrese Cedula");
  } else if (
    Entrada_Contraseña.value == null ||
    Entrada_Contraseña.value === ""
  ) {
    alert("Ingrese Contraseña");
  } else {
    //alert("Iniciar sesion");
    var datos = new FormData(formulario);
    console.log(datos.get("Cedula"));
    console.log(datos.get("Contra"));
    fetch("php/login.php", {
      method: "POST",
      body: datos,
    })
    .then(res => res.json())
    .then(data => {
        if (data == "2")   {
          intentos -= 1;
          alert("No coinciden los datos, tienes " + intentos + " intentos mas");
          if (intentos == 0){
            alert("Espere 10 segundos para iniciar sesion");
            window.location.href = "logeo.php";


          }
        }else if(data === "8"){
          alert("Hubo un error")
        } else if (data == "1") {
          window.location.href = "home.php";
        }
        console.log(data);
      });
  }
}
