<?php
include '../servicios/clienteService.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = trim($_POST['email']);
    $contrasena = $_POST['contrasena'];

    if(iniciarSesionUsuario($email,$contrasena)){
        session_start();
        $_SESSION['email'] = $email;
        header('Location: ../vistas/productos.html');
        exit();
    }else{
        echo "Error: credenciales incorrectas";
    }
}
?>