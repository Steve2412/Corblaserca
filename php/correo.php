<?php
// Envía un correo mediante SMTP.js desde el servidor, sin exponer el token al navegador
function enviar_correo($para, $asunto, $cuerpo)
{
    $config = require __DIR__ . '/config.php';
    if (empty($config['smtpjs_token'])) {
        error_log('Falta smtpjs_token en php/config.php');
        return false;
    }
    $datos = json_encode([
        'SecureToken' => $config['smtpjs_token'],
        'To' => $para,
        'From' => $config['correo_remitente'],
        'Subject' => $asunto,
        'Body' => $cuerpo,
        'Action' => 'Send',
        'nocache' => random_int(1, 1000000),
    ]);
    $contexto = stream_context_create(['http' => [
        'method' => 'POST',
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'content' => $datos,
        'timeout' => 15,
    ]]);
    $respuesta = @file_get_contents('https://smtpjs.com/v3/smtpjs.aspx?', false, $contexto);
    return $respuesta === 'OK';
}
