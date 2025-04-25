var formulario = document.querySelector("#Formulario");

var Insertar_Cedula = document.querySelector("#Cedula");
var Insertar_Cursos = document.querySelector("#Cursos");
var Insertar_Periodo = document.querySelector("#Periodo");


var Insertar_Rol = document.querySelector("#Rol");
var Rol_E = document.querySelector("#option-a");
var Rol_A = document.querySelector("#option-b");

function regresar(){
  window.location.href = "../crud-admin-usuario-tiene-cursos.php";

}

Insertar_Rol.addEventListener("click", (e) => {
    if (Rol_E.checked == true) {
      Rol = Rol_E.value;
      console.log(Rol);
    } else if (Rol_A.checked == true) {
      Rol = Rol_A.value;
      console.log(Rol);
    }
  });

  function registrar(){
    if (Insertar_Cedula===""||
        Insertar_Cedula===null){
        alert("Insertar cedula");
    }else{
        var datos = new FormData(formulario);
        console.log(datos.get("Cedula"));
        console.log(datos.get("Cursos"));
        console.log(datos.get("Periodo"));  
        console.log(datos.get("Rol"));

        fetch("php/registrar-usuario-en-curso.php", {
            method: "POST",
            body: datos,
          })
            .then(res => res.json())
            .then(data => {
              console.log(data);
              if (data === "1") {
                alert("El usuario no existe en el sistema");
              }else if(data === "2"){
                alert("El usuario ya esta en este curso");
              }else if(data === "4"){
                alert("El usuario tiene que finalizar el curso para poder entrar a otro");
              }else if(data === "5"){
                alert("El curso ya esta lleno");
              }else if(data === "8"){
                alert("Hubo un error")
              }else if (data === "3") {
                alert(
                  "El usuario fue inscrito al curso"
                );
                window.location.href = "../crud-admin-usuario-tiene-cursos.php";
              }});
    }
  }