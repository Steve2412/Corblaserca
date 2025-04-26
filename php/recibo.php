<?php
require "conexion.php";
$id=$_GET['exportarid']; 

$query = "SELECT * FROM notifipago WHERE id_notifipago = '$id'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $monto_notifipago = $row['monto_notifipago'];
    $banco_notifipago = $row['banco_notifipago'];
    $cedu_titular_notifipago = $row['cedu_titular_notifipago'];
    $fecha_notifipago = $row['fecha_notifipago'];
    $referencia_notifipago = $row['referencia_notifipago'];
    $motivo_notifipago = $row['motivo_notifipago'];
    $usuario_notifipago  = $row['usuario_notifipago'];

}

$query = "SELECT * FROM usuario WHERE cedu_user = '$usuario_notifipago'"; 
$result = $conectar->query($query)->fetchAll(PDO::FETCH_BOTH);
foreach ($result as $row){
    $Nombre = $row['nomb_user'];
    $Apellido = $row['apelli_user'];

}


date_default_timezone_set('America/Caracas');
$currentDate = date('d-m-Y');
$currentHour = date('H:i');
require "conexion.php";
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
extract($_POST);

if(isset($submit)){
    $html = '<head> <style>
    /* -------------------------------------
    GLOBAL
    A very basic CSS reset
------------------------------------- */
* {
    margin: 0;
    padding: 0;
    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
    box-sizing: border-box;
    font-size: 14px;
}

img {
    max-width: 100%;
}

body {
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: none;
    width: 100% !important;
    height: 100%;
    line-height: 1.6;
}
table td {
    vertical-align: top;
}

/* -------------------------------------
    BODY & CONTAINER
------------------------------------- */
body {
    background-color: #f6f6f6;
}

.body-wrap {
    background-color: #f6f6f6;
    width: 100%;
}

.container {
    display: block !important;
    max-width: 600px !important;
    margin: 0 auto !important;
    /* makes it centered */
    clear: both !important;
}

.content {
    max-width: 600px;
    margin: 0 auto;
    display: block;
    padding: 20px;
}

/* -------------------------------------
    HEADER, FOOTER, MAIN
------------------------------------- */
.main {
    background: #fff;
    border: 1px solid #e9e9e9;
    border-radius: 3px;
}

.content-wrap {
    padding: 20px;
}

.content-block {
    padding: 0 0 20px;
}

.header {
    width: 100%;
    margin-bottom: 20px;
}

.footer {
    width: 100%;
    clear: both;
    color: #999;
    padding: 20px;
}
.footer a {
    color: #999;
}
.footer p, .footer a, .footer unsubscribe, .footer td {
    font-size: 12px;
}

/* -------------------------------------
    TYPOGRAPHY
------------------------------------- */
h1, h2, h3 {
    font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    color: #000;
    margin: 40px 0 0;
    line-height: 1.2;
    font-weight: 400;
}

h1 {
    font-size: 32px;
    font-weight: 500;
}

h2 {
    font-size: 24px;
}

h3 {
    font-size: 18px;
}

h4 {
    font-size: 14px;
    font-weight: 600;
}

p, ul, ol {
    margin-bottom: 10px;
    font-weight: normal;
}
p li, ul li, ol li {
    margin-left: 5px;
    list-style-position: inside;
}

/* -------------------------------------
    LINKS & BUTTONS
------------------------------------- */
a {
    color: #1ab394;
    text-decoration: underline;
}

.btn-primary {
    text-decoration: none;
    color: #FFF;
    background-color: #1ab394;
    border: solid #1ab394;
    border-width: 5px 10px;
    line-height: 2;
    font-weight: bold;
    text-align: center;
    cursor: pointer;
    display: inline-block;
    border-radius: 5px;
    text-transform: capitalize;
}

/* -------------------------------------
    OTHER STYLES THAT MIGHT BE USEFUL
------------------------------------- */
.last {
    margin-bottom: 0;
}

.first {
    margin-top: 0;
}

.aligncenter {
    text-align: center;
}

.alignright {
    text-align: right;
}

.alignleft {
    text-align: left;
}

.clear {
    clear: both;
}

/* -------------------------------------
    ALERTS
    Change the class depending on warning email, good email or bad email
------------------------------------- */
.alert {
    font-size: 16px;
    color: #fff;
    font-weight: 500;
    padding: 20px;
    text-align: center;
    border-radius: 3px 3px 0 0;
}
.alert a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
}
.alert.alert-warning {
    background: #f8ac59;
}
.alert.alert-bad {
    background: #ed5565;
}
.alert.alert-good {
    background: #1ab394;
}

/* -------------------------------------
    INVOICE
    Styles for the billing table
------------------------------------- */
.invoice {
    margin: 40px auto;
    text-align: left;
    width: 80%;
}
.invoice td {
    padding: 5px 0;
}
.invoice .invoice-items {
    width: 100%;
}
.invoice .invoice-items td {
    border-top: #eee 1px solid;
}
.invoice .invoice-items .total td {
    border-top: 2px solid #333;
    border-bottom: 2px solid #333;
    font-weight: 700;
}

/* -------------------------------------
    RESPONSIVE AND MOBILE FRIENDLY STYLES
------------------------------------- */
@media only screen and (max-width: 640px) {
    h1, h2, h3, h4 {
        font-weight: 600 !important;
        margin: 20px 0 5px !important;
    }

    h1 {
        font-size: 22px !important;
    }

    h2 {
        font-size: 18px !important;
    }

    h3 {
        font-size: 16px !important;
    }

    .container {
        width: 100% !important;
    }

    .content, .content-wrap {
        padding: 10px !important;
    }

    .invoice {
        width: 100% !important;
    }
}
    </style></head>';
    $html .= '
    <table class="body-wrap">
    <tbody><tr>
        <td></td>
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td class="content-wrap aligncenter">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody><tr>
                                    <td class="content-block">
                                        <h2 align="center">Detalles de la notificación del pago</h2>
                                        <div align="center">Reporte del dia '.$currentDate.' a las '.$currentHour.'</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <table class="invoice">
                                            <tbody><tr>
                                                <td>'.$Nombre.' '.$Apellido.'<br>'.$usuario_notifipago.'<br>Fecha del pago: '.$fecha_notifipago.'</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                        <tbody><tr>
                                                            <td>Mónto del pago</td>
                                                            <td class="alignright">'.$monto_notifipago.' Bs.D</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Banco</td>
                                                            <td class="alignright">'.$banco_notifipago.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cédula titutar de la cuenta</td>
                                                            <td class="alignright">'.$cedu_titular_notifipago.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Referencia del pago</td>
                                                            <td class="alignright">'.$referencia_notifipago.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Motivo del pago</td>
                                                            <td class="alignright">'.$motivo_notifipago.'</td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
                <div class="footer">
                    <table width="100%">
                        <tbody><tr>
                            <td class="aligncenter content-block">En caso de algun incoveniente, escribir al siguiente correo: <a href="mailto:cursoscorblaserca@gmail.com">cursoscorblaserca@gmail.com</a></td>
                        </tr>
                    </tbody></table>
                </div></div>
        </td>
        <td></td>
    </tr>
</tbody>
    ';
    $html .= '</table>';
    $dompdf = NEW DOMPDF();
    $dompdf->loadHtml($html);
    $html .= '<link type="text/css" href="assets/styles/css/recibo.css" rel="stylesheet" />';
    $html .= '<link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />';
    $dompdf->setPaper("A4","landscape");
    $dompdf->render();
    $canvas = $dompdf->get_canvas(); 
    $canvas->page_text(400, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}",null, 13, array(0,0,0)); 
    $dompdf->stream("recibo.pdf");

}
?>
