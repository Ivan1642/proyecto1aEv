<?php
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_datos = "";

    try{
        $conexion = new PDO("mysql:host=$servidor;dbname=$base_datos;charset=utf8", $usuario, $contrasena);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        die("Error de conexión: " . $e->getMessage());
    }
?>