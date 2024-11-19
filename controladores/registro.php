<?php
require '../servicios/clienteService.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $correo = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];
    $DNI = trim($_POST['dni']);

    registrarUsuario($nombre,$apellidos,$correo,$contrasena,$DNI);

    header('../controladores/productos.php');
}
?>