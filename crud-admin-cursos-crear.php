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
$query = "SELECT * FROM usuario_has_cursos WHERE Usuario_ID_user = '$usuario'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Rol_usuario = $row['Usuario_rol'];

}
if($Rol_usuario=="Profesor"||$Rol_usuario=="Estudiante"){
  echo "<script> location.href='home.php' </script>";

} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <style> 
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.tiny.cloud/1/j2mhmpoyrt6wygu0k1vrfxap9m9j5zwto1gemng6nbuypahn/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>  

    <title>Crear Curso</title>
</head>
<body>
    <div class="container my-9">
        <h2>Crear Curso</h2>
        <form id="Formulario">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="ID" id="ID" name="ID"></input>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Nombre" id="Nombre" name="Nombre">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Horas</label>
                <div class="col-sm-6">
                    <select class="form-select" name="Horas" id="Horas">
                        <option value="Lunes a Viernes 08:00am a 10:00am">Lunes a Viernes 08:00am a 10:00am</option>
                        <option value="Lunes a Viernes 10:00am a 12:00pm">Lunes a Viernes 10:00am a 12:00pm</option>
                        <option value="Lunes a Viernes 12:00pm a 02:00pm">Lunes a Viernes 12:00pm a 02:00pm</option>
                        <option value="Sabado de 08:00am a 01:00pm">Sabado de 08:00am a 01:00pm</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Precio (Bs. D)</label>
                <div class="col-sm-6">
                        <input type="text" class="form-control" onkeyup="agregarDecimal()" inputMode="numeric" placeholder="Precio" id="Precio" name="Precio"></input> 
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Cupo mínimo</label>
                <div class="col-sm-6">
                        <input type="number" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" placeholder="Cupo_min" id="Cupo_min" name="Cupo_min" maxlength="15"></input>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Cupo máximo</label>
                <div class="col-sm-6">
                        <input type="number" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" inputMode="numeric" placeholder="Cupo_max" id="Cupo_max" name="Cupo_max"></input>
                </div>
            </div>
            <form>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contenido del curso</label>
                <div class="col-sm-6">
                        <textarea type="text" id="Contenido" style="width:550px;height:100px;" name="Contenido" cols="40" class="form-control"></textarea>
                </div>
            </div>
            </form>
        </form>
        <button type="submit" class="btn btn-primary" onclick="registrar()">Crear curso</button>
        <button type="submit" class="btn btn-secondary" onclick="regresar()">Regresar</button>
    </div>
</body>
<script>
var id = document.querySelector("#ID");
var nombre = document.querySelector("#Nombre");
var Precio = document.querySelector("#Precio");
var cupo_min = document.querySelector("#Cupo_min");
var cupo_max = document.querySelector("#Cupo_max");


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

function agregarDecimal() {
var num = Precio.value.replace(/\./g,'');
if(!isNaN(num)){
    num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{2})?/,'$1.');
    num = num.split('').reverse().join('').replace(/^[\.]/,'');
    Precio.value = num;
  } else {
    alert('Solo se permiten números');
    Precio.value = Precio.value.replace(/[^\d\.]*/g,'');
  }
}

    function regresar(){
  window.location.href = "../crud-admin-cursos.php";

}

function registrar(){

    if(id.value==""||id.value==null||
    nombre.value==""||nombre.value==null||
    Precio.value==""||Precio.value==null||
    cupo_min.value==""||cupo_min.value==null||
    cupo_max.value==""||cupo_max.value==null){
        alert("Faltan campos por rellenar");
    }else{
    var editor = tinyMCE.triggerSave('#Contenido');
    var datos = new FormData(formulario);
    console.log(datos.get("ID"));
    console.log(datos.get("Nombre"));
    console.log(datos.get("Horas"));
    console.log(datos.get("Precio"));
    console.log(datos.get("Cupo_min"));
    console.log(datos.get("Cupo_max"));
    console.log(datos.get("Contenido"));
    fetch("php/registrar-curso.php", {
        method: "POST",
        body: datos,
      })
        .then(res => res.json())
        .then(data => {
          console.log(data);
          if (data === "1") {
            alert("Ya existe el curso");
          }else if(data==="8"){
            alert("Hubo un error");
          } else if (data === "2") {
            alert(
              "Has registrado un nuevo curso"
            );
            window.location.href = "../crud-admin-cursos.php";
          }})
    }

}

    </script>

</html>