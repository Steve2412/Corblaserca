var formulario = document.querySelector("#Formulario");
var validRegex =
  /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

var Insertar_Nombre = document.querySelector("#Nombre");
var Insertar_Apellido = document.querySelector("#Apellido");
var Insertar_Correo = document.querySelector("#Correo");
var Insertar_Genero = document.querySelector("#Genero");
var Genero_M = document.querySelector("#option-1");
var Genero_F = document.querySelector("#option-2");

var Insertar_Direccion = document.querySelector("#Direccion");
var Insertar_Telefono = document.querySelector("#Telefono");
var Insertar_Fecha = document.querySelector("#Fecha-Insertar");

let res = document.querySelector("#res");

Insertar_Telefono.addEventListener("keyup", function (e) {
  if (Event.key != "Backspace" && Insertar_Telefono.value.length === 4) {
    Insertar_Telefono.value += "-";
  }
});

var el_first = document.querySelector(".Entrada-Datos-1");
var el_second = document.querySelector(".Entrada-Datos-2");
var boton_siguiente = document.querySelector(".Boton-Siguiente");
var boton_regresar = document.querySelector(".Boton-Regresar");
var boton_registrarse = document.querySelector(".Boton-Registrarse");

Insertar_Genero.addEventListener("click", (e) => {
  if (Genero_M.checked == true) {
    Gen = Genero_M.value;
    console.log(Gen);
  } else if (Genero_F.checked == true) {
    Gen = Genero_F.value;
    console.log(Gen);
  }
});

function regresar() {
  window.location.href = "../profile.php";
}

function registrar() {
  var Fecha_Actual = new Date();
  var Fecha_Comparar = new Date(Insertar_Fecha.value);
  var Difference_In_Time = Fecha_Actual.getTime() - Fecha_Comparar.getTime();
  Difference_In_Time = Math.round(Difference_In_Time / (1000 * 60 * 60 * 24));
  console.log(Difference_In_Time);
  if (
    Insertar_Nombre.value == null ||
    Insertar_Nombre.value === "" ||
    Insertar_Apellido.value == null ||
    Insertar_Apellido.value === "" ||
    Insertar_Correo.value == null ||
    Insertar_Correo.value === "" ||
    Insertar_Direccion.value == null ||
    Insertar_Direccion.value === "" ||
    Insertar_Telefono.value == null ||
    Insertar_Telefono.value === "" ||
    Insertar_Fecha.value == null ||
    Insertar_Fecha.value === ""
  )
  alert("Faltan campos por rellenar");
  else if (!Insertar_Correo.value.match(validRegex)) {
    alert("Correo Invalido!");
    }else if (
    Insertar_Telefono.value.search == /[A-Z]/ ||
    Insertar_Telefono.value.length > 15
  ) {
    alert("Error en el numero telefonico");
  } else if(Difference_In_Time<"6574"||Insertar_Fecha.value<"1920-01-01"){
    alert("No puedes ingresar esta fecha.")
  }  else {
    var datos = new FormData(formulario);
    console.log(datos.get("Nombre"));
    console.log(datos.get("Apellido"));
    console.log(datos.get("Correo"));
    console.log(datos.get("Cedula"));
    console.log(datos.get("Genero"));
    console.log(datos.get("Direccion"));
    console.log(datos.get("Telefono"));
    console.log(datos.get("Contra"));
    console.log(datos.get("Fecha"));

    fetch("php/profile-edit-crud.php", {
      method: "POST",
      body: datos,
    })
      .then(res => res.json())
      .then(data => {
        console.log(data);
        if (data === "1") {
          alert("Ya existe el usuario");
        }else if(data === "8"){
          alert("Hubo un error")
        } else if (data === "2") {
          alert(
            "Usuario Actualizado Correctamente"
          );
          window.location.href = "../profile.php";
        }
      });
  }
}
