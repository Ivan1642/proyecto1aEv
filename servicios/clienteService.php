<?php
require '../clases/db.php';

function registrarUsuario($nombre,$apellidos,$correo,$contrasena,$dni){
    global $conexion;

    try{
        $consulta = $conexion->prepare("select correo from usuario where
         correo = :correo or dni = :dni");

         $consulta->execute([':correo' => $correo, ':dni' => $correo]);

         if($consulta->rowCount() > 0){
            return false;
         }

         $stmt = $conexion->prepare("insert into usuario(nombre,apellidos,correo,contrasena,dni) values (:nombre,:apellidos,:correo,:contrasena,:dni");

         $stmt->execute([':nombre' => $nombre,
                         ':apellidos' => $apellidos,
                         ':correo' => $correo,
                         ':contrasena' => password_hash($contrasena,PASSWORD_BCRYPT),
                         ':dni' => $dni]);

         return true;
    }catch(PDOException $e){
        $e->getMessage();
    }
}

function iniciarSesionUsuario($correo,$contrasena){
    global $conexion;

    try{
        $consulta = $conexion->prepare("select contrasena from usuario where correo = :correo");

        $consulta->execute([':correo' => $correo]);

        if($consulta->rowCount() === 0){
            return false;
        }

        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if(password_verify($contrasena,$usuario['contrasena'])){
            return true;
        }else{
            return false;
        }
    }catch(PDOException $e){
        return"ERROR: " . $e->getMessage();
    }
}
?>