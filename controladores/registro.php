<?php
require '../servicios/clienteService.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];
    $dniCliente = trim($_POST['dni']);

    if(registrarUsuario($nombre,$apellidos,$email,$contrasena,$dniCliente)){
        header('Location: ../vistas/productos.html');
        exit();
    }else{
        echo "Error: el usuario ya existe o hubo un problema en el registro";
    }
}
?>