<?php

session_start();

if(!isset($_SESSION['usuario_id']) || !isset($_SESSION['usuario_nombre']) ){

    header("location:../login/login.php");
    exit();
}

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if ($url=='http://localhost/massivedemo/section/login/login.php' && (isset($_SESSION['usuario_id']))){
    header("location:../dashboard/dashboard.php");
}

$rolesUrlsPermitidas = array(
    "admin" => [
        "http://localhost/massivedemo/section/login/login.php",
        "/editar_usuario",
        "/eliminar_usuario"
    ],
    "vendedor" => [
        "/",
        "/"
    ],
    "comprador" => [
        "/",
        "/"
    ]
);

function verificarAutorizacion($url, $rolUsuario) {
    global $rolesUrlsPermitidas;

    if (array_key_exists($rolUsuario, $rolesUrlsPermitidas)) {
        $urlsPermitidas = $rolesUrlsPermitidas[$rolUsuario];

        if (in_array($url, $urlsPermitidas)) {
            return true;
        } else {
            header("HTTP/1.1 403 Forbidden");
            echo "No tienes permiso para acceder a esta página.";
            exit();
        }
    } else {
        header("HTTP/1.1 403 Forbidden");
            echo "No tienes permiso para acceder a esta página.";
            exit();
    }
}

$rolUsuarioActual = $_SESSION['usuario_tipo'];

verificarAutorizacion($url, $rolUsuarioActual);
?>


?>