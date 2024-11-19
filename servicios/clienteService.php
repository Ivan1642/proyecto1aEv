<?php
require '../clases/db.php';

function registrarUsuario($nombre,$apellidos,$correo,$contrasena,$dni){
    global $conexion;

    try{
        $consulta = $conexion->prepare("select correo from usuario where
         correo = :correo or dni = :dni");

         $consulta->execute([':correo' => $correo, ':dni' => $correo]);

         if($consulta->rowCount() > 0){
            return "El correo o el dni ya están registrados";
         }

         $stmt = $conexion->prepare("insert into usuario(nombre,apellidos,correo,contrasena,dni) values (:nombre,:apellidos,:correo,:contrasena,:dni");

         $stmt->execute([':nombre' => $nombre,
                         ':apellidos' => $apellidos,
                         ':correo' => $correo,
                         ':contrasena' => password_hash($contrasena,PASSWORD_BCRYPT),
                         ':dni' => $dni]);

         return "Registro realizado";
    }catch(PDOException $e){
        $e->getMessage();
    }
}
?>