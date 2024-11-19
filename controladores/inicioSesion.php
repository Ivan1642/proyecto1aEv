<?php
include '../servicios/clienteService.php';

if($_SERVER['REQUEST_METHOD']){
    $correo = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];

    $resultado = inicioSesionUsuario($correo,$contrasena);

    return $resultado;
}
?>