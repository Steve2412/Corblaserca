var Formulario = document.querySelector(".Formulario");
var Insertar_Correo = document.querySelector("#Correo");
var Insertar_Codigo = document.querySelector("#Codigo");
var Insertar_Contra_1 = document.querySelector("#Contraseña-Nueva_1");
var Insertar_Contra_2 = document.querySelector("#Contraseña-Nueva_2");


var el_first = document.querySelector(".Entrada-Datos-1");
var el_second = document.querySelector(".Entrada-Datos-2");
var el_third = document.querySelector(".Entrada-Datos-3");
var boton_siguiente = document.querySelector(".Boton-Siguiente");
var boton_codigo = document.querySelector(".Boton-Codigo");
var boton_cambiar = document.querySelector(".Boton-Cambiar");
var boton_regresar = document.querySelector(".Boton-Regresar");

function fun_regresar(){
  window.location.href = "../recuperar.html";

}


function fun_siguiente() {
  var datos = new FormData(Formulario);
  fetch("php/verificar.php", {
    method: "POST",
    body: datos,
  })
    .then(res => res.json())
    .then(data => {
      console.log(data);
      if (data === "2") {
        alert("No existe ningun usuario en la base de datos con este correo");
      } else if (data === "8") {
        alert("No se pudo enviar el correo, intentalo mas tarde");
      } else if (data == "1") {
      alert(
        "Te has llegado un correo con un codigo, busca en la bandeja de entrada"
        
      )
        el_first.style.display = "none";
        el_second.style.display = "block";
        boton_siguiente.style.display = "none";
        boton_codigo.style.display = "block";;
      }
    });

}

function fun_Codigo() {
  var datos = new FormData(Formulario);
  fetch("php/verificar-codigo.php", {
    method: "POST",
    body: datos,
  })
    .then(res => res.json())
    .then(data => {
      if (data === "1") {
        alert("Codigo correcto");
        el_second.style.display = "none";
        el_third.style.display = "block";
        boton_codigo.style.display = "none";
        boton_cambiar.style.display = "block";
      } else if (data === "3") {
        alert("El codigo ha caducado, solicita uno nuevo");
        window.location.reload();
      } else {
        alert("Codigo incorrecto");
      }
    });
  }

  function fun_Cambio(){

    if(Insertar_Contra_1 == null||Insertar_Contra_1 == ""||Insertar_Contra_2 == null||Insertar_Contra_2 == ""){
      alert("Falta campos por rellenar")
    }else if (Insertar_Contra_1.value.length < 8) {
      alert("Contraseña menor a 8 caracteres");
    } else if (Insertar_Contra_1.value.length > 16) {
      alert("Contraseña mayor a 16 caracteres");
    } else if (Insertar_Contra_1.value.search(/[a-z]/) < 0) {
      alert("Debe Incluir una letra minuscula");
    } else if (Insertar_Contra_1.value.search(/[A-Z]/) < 0) {
      alert("Debe Incluir una letra Mayuscula");
    } else if (Insertar_Contra_1.value.search(/[0-9]/) < 0) {
      alert("Debe Incluir una Numero");
    } else if (Insertar_Contra_1.value !== Insertar_Contra_2.value) {
      alert("Las contraseñas no concuerdan");
    }else{
      var datos_2 = new FormData(Formulario);
      fetch("php/recuperar.php", {
        method: "POST",
        body: datos_2,
      })
        .then(res => res.json())
        .then(data => {
          console.log(data);
          if (data === "1") {
            alert("Contraseña cambiada correctamente");
            //window.location.href = "login.html";
          }else if(data === "3"){
            alert("Debes verificar el codigo de nuevo");
            window.location.reload();
          }else if(data === "8"){
            alert("Hubo un error")
          } else if (data === "2") {
            alert(
              "Se ha cambiado la contraseña de forma correcta, procede a iniciar sesión"
            );
            window.location.href = "../logeo.php";
          }
        });
    }

  }



