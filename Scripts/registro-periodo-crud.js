var formulario = document.querySelector("#Formulario");

var id = document.querySelector("#ID");
var nombre = document.querySelector("#Nombre");
var fech_inic = document.querySelector("#Fecha-Inicio");
var fech_fin = document.querySelector("#Fecha-Fin");

function regresar(){
    window.location.href = "../crud-admin-periodo.php";

}
function registrar(){
    if(id.value==""||id.value==null||
    nombre.value==""||nombre.value==null||
    fech_inic.value==""||fech_inic.value==null||
    fech_fin.value==""||fech_fin.value==null){
        alert("Faltan rellenar campos");
    }else if(fech_fin.value<=fech_inic.value){
        alert("La fecha de fin de curso no puede ser despues de la fecha de inicio");
    }
    else{
    var datos = new FormData(formulario);
    console.log(datos.get("ID"));
    console.log(datos.get("Nombre"));
    console.log(datos.get("Fecha-Inicio"));
    console.log(datos.get("Fecha-Fin"));
    fetch("php/registrar-periodo.php", {
        method: "POST",
        body: datos,
      })
        .then(res => res.json())
        .then(data => {
          console.log(data);
          if (data === "1") {
            alert("Ya existe el periodo");
          }else if(data === "8"){
            alert("Hubo un error")
          } else if (data === "2") {
            alert(
              "Se ha creado un nuevo periodo"
            );
            window.location.href = "../crud-admin-periodo.php";
          }
        });
    }
}