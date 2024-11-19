<?php
include '../servicios/clienteService.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $correo = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];

    $resultado = inicioSesionUsuario($correo,$contrasena);

    if($resultado == true){
        header("../vistas/productos");
    }
}
?>