var formulario = document.querySelector("#Formulario");

var Insertar_Nota = document.querySelector("#Nota");

function regresar(){
  window.location.href = "../estudiantes.php";

}

function registrar(){

    if(Insertar_Nota.value==""||
    Insertar_Nota.value==null){
        alert("Inserta una nota")
    }else{
    var datos = new FormData(formulario);
    console.log(datos.get("Nombre"));
    console.log(datos.get("Apellido"));
    console.log(datos.get("Cedula"));
    console.log(datos.get("Nota"));
    fetch("php/actualizar-nota.php", {
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
              "Se ha actualizado la nota correctamente"
            );
            window.location.href = "../estudiantes.php";
          }
        });
    }
}
