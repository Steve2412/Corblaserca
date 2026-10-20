<?php
require_once __DIR__ . '/sesion.php';

// Corta la petición si no hay una sesión iniciada
function requerir_sesion()
{
    if (!isset($_SESSION['usuario'])) {
        http_response_code(401);
        exit('Debes iniciar sesión');
    }
    return $_SESSION['usuario'];
}

// Corta la petición si el usuario no tiene ninguno de los roles indicados
function requerir_rol(PDO $conectar, array $roles)
{
    $usuario = requerir_sesion();
    $marcadores = implode(',', array_fill(0, count($roles), '?'));
    $pdo = $conectar->prepare("SELECT Usuario_rol FROM usuario_has_cursos WHERE Usuario_ID_user = ? AND Usuario_rol IN ($marcadores) LIMIT 1");
    $pdo->execute(array_merge([$usuario], $roles));
    $rol = $pdo->fetchColumn();
    if ($rol === false) {
        http_response_code(403);
        exit('Acceso denegado');
    }
    return $rol;
}

// Escapa texto para imprimirlo dentro de HTML
function e($texto)
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

// Limpia texto libre que luego se muestra en páginas sin escapar
function limpiar($texto)
{
    return trim(strip_tags((string) $texto));
}
