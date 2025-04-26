<?php
require "conexion.php";
session_start();
if(!isset($_SESSION['usuario'])){
  echo '<script language="javascript">
  window.location = "index.html"
  </script>';
  die();
  session_destroy(); 
}

$usuario = $_SESSION['usuario'];
$query = "SELECT * FROM usuario WHERE cedu_user = '$usuario'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Nombre = $row['nomb_user'];
    $Apellido = $row['apelli_user'];
    $Correo = $row['correo_user'];
    $Genero = $row['sexo_user'];
    $Direccion = $row['dirre_user'];
    $Numero = $row['numer_user'];
    $Contra = $row['contra_user'];
    $Fecha = $row['fech_naci_user'];
   }

   $query = "SELECT * FROM usuario_has_cursos WHERE Usuario_ID_user = '$usuario'"; 
   $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
   foreach ($result as $row){
       $Cursos_ID_cur = $row['Cursos_ID_cur'];
       $Rol_usuario = $row['Usuario_rol'];
   }

   $query = "SELECT * FROM cursos WHERE ID_cur = '$Cursos_ID_cur'"; 
   $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
   foreach ($result as $row){
       $nomb_cur = $row['nomb_cur'];    
       $horar_cur = $row['horar_cur'];
   }

date_default_timezone_set('America/Caracas');
$currentDate = date('d-m-Y');
$currentHour = date('H:i');
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
extract($_POST);

if(isset($submit)){
    $html = '';
    $html .= '
    <h2 align="center">Horario Escolar</h2>
    <div align="center">Reporte del dia '.$currentDate.' a las '.$currentHour.'</div>
    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr class="bg-light-gray">
            <th style="border:1px solid #ddd; padding:8px; text-align:center;" ="text-uppercase">Hora
            </th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;" class="text-uppercase">Lunes</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;" class="text-uppercase">Martes</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;" class="text-uppercase">Miercoles</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;" class="text-uppercase">Jueves</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;" class="text-uppercase">Viernes</th>
            <th style="border:1px solid #ddd; padding:8px; text-align:center;" class="text-uppercase">Sabado</th>
            </tr>
        </thead> 
        ';
    $html .= '
        <tbody style="font-size:20px">
        <tr>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;" class="align-middle">08:00am-9:00am</td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td">
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td">
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;"
            <span class=></span>
        </td>
        </tr>

        <tr>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;" class="align-middle">09:00am-10:00am</td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        </tr>

        <tr>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;" class="align-middle">10:00am-11:00am</td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
           <span class=>'.$nomb_cur.'</span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
           <span class=>'.$nomb_cur.'</span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
           <span class=>'.$nomb_cur.'</span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
           <span class=>'.$nomb_cur.'</span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
           <span class=>'.$nomb_cur.'</span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
           <span class=></span>
        </td>
     </tr>

     <tr>
     <td style="border:1px solid #ddd; padding:8px; text-align:center;" class="align-middle">11:00am-12:00pm</td>
     <td style="border:1px solid #ddd; padding:8px; text-align:center;">
        <span class=>'.$nomb_cur.'</span>
     </td>
     <td style="border:1px solid #ddd; padding:8px; text-align:center;">
        <span class=>'.$nomb_cur.'</span>
     </td>
     <td style="border:1px solid #ddd; padding:8px; text-align:center;">
        <span class=>'.$nomb_cur.'</span>
     </td>
     <td style="border:1px solid #ddd; padding:8px; text-align:center;">
        <span class=>'.$nomb_cur.'</span>
     </td>
     <td style="border:1px solid #ddd; padding:8px; text-align:center;">
        <span class=>'.$nomb_cur.'</span>
     </td>
     <td style="border:1px solid #ddd; padding:8px; text-align:center;">
        <span class=></span>
     </td>
    </tr>

        <tr>
        <td  style="border:1px solid #ddd; padding:8px; text-align:center;" class="align-middle">12:00pm-01:00pm</td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
            <span class=></span>
        </td>
        </tr>

        <tr>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;" class="align-middle">01:00pm-02:00pm</td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
           <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
           <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
           <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
           <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
           <span class=></span>
        </td>
        <td style="border:1px solid #ddd; padding:8px; text-align:center;">
           <span class=></span>
        </td>
     </tr>
     </tbody>
           
        '; 
     }
     $html .= '</table>';
     $dompdf = NEW DOMPDF();
     $dompdf->loadHtml($html);
     $dompdf->setPaper("A4","landscape");
     $dompdf->render();
     $canvas = $dompdf->get_canvas(); 
     $canvas->page_text(400, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}",null, 13, array(0,0,0)); 
     $dompdf->stream("horario.pdf");