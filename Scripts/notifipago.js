var formulario = document.querySelector(".Formulario");

var monto = document.querySelector("#Monto");
var cedu_titular = document.querySelector("#Cedu_Titu");
var fecha_transferencia = document.querySelector("#Fecha_Trans");
var numero_transferencia = document.querySelector("#Num_Trans");
var motivo = document.querySelector("#Motivo");

var banco = document.querySelector(".Banco");
var Banco_de_Venezuela = document.querySelector("#option-1");
var Banesco = document.querySelector("#option-2");
var Banco_Provincial = document.querySelector("#option-3");
var Banco_Nacional_de_Crédito = document.querySelector("#option-4");
var Bancrecer = document.querySelector("#option-5");

function agregarDecimal() {
  var num = monto.value.replace(/\./g,'');
  if(!isNaN(num)){
    num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{2})?/,'$1.');
    num = num.split('').reverse().join('').replace(/^[\.]/,'');
    monto.value = num;
  } else {
    alert('Solo se permiten números');
    monto.value = monto.value.replace(/[^\d\.]*/g,'');
  }
}

  function pago(){
    if (cedu_titular.value=="null"||
    cedu_titular.value==""||
    fecha_transferencia.value=="null"||
    fecha_transferencia.value==""||
    numero_transferencia.value=="null"||
    numero_transferencia.value==""||
    motivo.value=="null"||
    motivo.value==""){
        alert("Debes rellenar todos los campos");
    }else{
        var datos = new FormData(formulario);
        console.log(datos.get("Monto"));
        console.log(datos.get("Banco"));
        console.log(datos.get("Cedu_Titu"));
        console.log(datos.get("Fecha_Trans"));
        console.log(datos.get("Num_Trans"));
        console.log(datos.get("Motivo"));
    
        fetch("php/notificar_pago.php", {
          method: "POST",
          body: datos,
        })
          .then(res => res.json())
          .then(data => {
            console.log(data);
            if (data === "8") {
              alert("Hub un error");
            } else if (data === "2") {
              alert(
                "Se ha hecho la notificación, espere unos dias para validar correctamente el pago"
              );
              window.location.href = "../notifipago.php";
            }
          });
      }
    }



