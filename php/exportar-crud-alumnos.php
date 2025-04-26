<?php
date_default_timezone_set('America/Caracas');
$currentDate = date('d-m-Y');
$currentHour = date('H:i');
session_start();
require "conexion.php"; 
$id=$_GET['exportarid']; 

$query = "SELECT * FROM cursos WHERE ID_cur = '$id'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $nomb_cur = $row['nomb_cur'];
}

require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
extract($_POST);


if(isset($submit)){
    $query = "SELECT * FROM usuario_has_cursos WHERE Cursos_ID_cur='$id'";
    $result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
    $html = '';
    $html .= '
        <h2 align="center">Alumnos de '.$nomb_cur.'</h2>
        <div align="center">Reporte del dia '.$currentDate.' a las '.$currentHour.'</div>
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Cedula</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Nombre</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Apellido</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Nota</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:center;">Rol</th>
            </tr>   
    ';
    foreach ($result as $row){
        $Usuario_ID_user = $row['Usuario_ID_user'];
        $query_2 = "SELECT * FROM usuario WHERE cedu_user='$Usuario_ID_user'";
        $result_2 = $conectar->query($query_2)->fetchAll(PDO::FETCH_BOTH);
        foreach ($result_2 as $row_2){
            $html .= '
            <tr>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['Usuario_ID_user'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row_2['nomb_user'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row_2['apelli_user'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['calificacion_user'].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:center;">'.$row['Usuario_rol'].'</td>
            </tr>
        ';

    }
}
    $html .= '</table>';
    $dompdf = NEW DOMPDF();
    $dompdf->loadHtml($html);
    $dompdf->setPaper("A4","landscape");
    $dompdf->render();
    $canvas = $dompdf->get_canvas(); 
    $canvas->page_text(400, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}",null, 13, array(0,0,0)); 
    $dompdf->stream("alumnos.pdf");

}
?>
