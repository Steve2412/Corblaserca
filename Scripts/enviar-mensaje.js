var formulario = document.querySelector("#Formulario");
var mensaje = document.querySelector("#Mensaje");


function regresar(){
  window.location.href = "../foro.php";
}

function enviar(){
    if(mensaje.value==""|| mensaje.value==null){
        alert("Inserta un mensaje")
    }else{
        var datos = new FormData(formulario);
        console.log(datos.get("Mensaje"));
        fetch("php/enviar-mensaje.php", {
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
                  "Mensaje enviado"
                );
                window.location.href = "../foro.php";
              }})
    }
}