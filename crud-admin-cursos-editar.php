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


$id=$_GET['editarid']; 
$query = "SELECT * FROM cursos WHERE ID_cur = '$id'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $ID_cur = $row['ID_cur'];
    $nomb_cur = $row['nomb_cur'];
    $horar_cur = $row['horar_cur'];
    $prec_cur = $row['prec_cur'];
    $cupos_cur_min = $row['cupos_cur_min'];
    $cupos_cur_max = $row['cupos_cur_max'];
    $conte_text = $row['conte_text'];
    $estado_cur = $row['estado_cur'];

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Editar <?php echo $nomb_cur ?></title>
</head>
<body>
    <div class="container my-9">
        <h2>Editar Curso <?php echo $nomb_cur?></h2>
        <form id="Formulario">
          <textarea id="id_o" name="id_o" type="hidden" value=<?php echo $ID_cur;?>><?php echo $ID_cur;?></textarea> 

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-6">
                        <textarea type="text" class="form-control" placeholder="ID" id="ID" name="ID"><?php echo $ID_cur;?></textarea>       
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-6">
                        <textarea type="text" class="form-control" placeholder="Nombre" id="Nombre" name="Nombre"><?php echo $nomb_cur;?></textarea> 
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Horas</label>
                <div class="col-sm-6">
                    <select class="form-select" name="Horas" id="Horas">
                        <option value='<?php print $horar_cur ?>' selected hidden><?php echo $horar_cur ?></option>
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
                        <input type="text" class="form-control" maxlength="10" inputMode="numeric" onkeyup="agregarDecimal()" placeholder="Precio" id="Precio" name="Precio" value=<?php echo $prec_cur;?>> 
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Cupo Minimo</label>
                <div class="col-sm-6">
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9-.]/g, '').replace(/(\..*?)\..*/g, '$1');" 
                        class="form-control" placeholder="Cupo_min" id="Cupo_min" name="Cupo_min" maxlength="15" value=<?php echo $cupos_cur_min;?>>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Cupo maximo</label>
                <div class="col-sm-6">
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*?)\..*/g, '$1');"
                        class="form-control" inputMode="numeric" placeholder="Cupo_max" id="Cupo_max" name="Cupo_max" value=<?php echo $cupos_cur_max;?>>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contenido del curso</label>
                <div class="col-sm-6">
                        <textarea type="text" id="Contenido" style="width:550px;height:100px;" name="Contenido" cols="40" class="form-control" ><?php echo $conte_text;?></textarea>
                </div>
            </div>

            <div class="row mb-3" id="Estado">
                <label class="col-sm-3 col-form-label">Estado</label>
                <div class="col-sm-6">
                    <input type="radio" class="form-check-input" name="Estado" id="option-1" value="Activo"  <?php echo ($estado_cur=='Activo')?'checked':'' ?>>
                    <label class="form-check-label" for="option-1">Activo</label> 
                    <input type="radio" class="form-check-input" name="Estado" id="option-2" value="Eliminado" <?php echo ($estado_cur=='Eliminado')?'checked':'' ?>>
                    <label class="form-check-label" for="option-2">Eliminado</label> 
                </div>
            </div>
        </form>
        <button type="submit" class="btn btn-primary" onclick="registrar()">Actualizar</button>
        <button type="submit" class="btn btn-secondary" onclick="regresar()">Regresar</button>
    </div>
</body>
<script src="https://cdn.tiny.cloud/1/j2mhmpoyrt6wygu0k1vrfxap9m9j5zwto1gemng6nbuypahn/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
var id = document.querySelector("#ID");
var id_o = document.querySelector("#id_o");
id_o.style.visibility = "hidden";
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

function regresar(){
  window.location.href = "../crud-admin-cursos.php";

}

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

function registrar(){
    var editor = tinyMCE.triggerSave('#Contenido');
    var datos = new FormData(formulario);
    console.log(datos.get("id_o"));
    console.log(datos.get("ID"));
    console.log(datos.get("Nombre"));
    console.log(datos.get("Horas"));
    console.log(datos.get("Precio"));
    console.log(datos.get("Cupo_min"));
    console.log(datos.get("Cupo_max"));
    console.log(datos.get("Contenido"))
    console.log(datos.get("Estado"))
    fetch("php/actualizar-curso.php", {
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
              "Curso Actualizado"
            );
            window.location.href = "../crud-admin-cursos.php";
          }})
}

  </script>
</html>