<?php
require '../config/db.php';

function registrarUsuario($nombre,$apellidos,$email,$contrasena,$dniCliente){
    global $conexion;

    try{
        $consulta = $conexion->prepare("select email from usuario where
         email = :email or dniCliente = :dniCliente");

         $consulta->execute([':email' => $email, ':dniCliente' => $dniCliente]);

         if($consulta->rowCount() > 0){
            return false;
         }

         $stmt = $conexion->prepare("insert into usuario(nombre,apellidos,email,contrasena,dniCliente) values (:nombre,:apellidos,:email,:contrasena,:dniCliente)");

         $stmt->execute([':nombre' => $nombre,
                         ':apellidos' => $apellidos,
                         ':email' => $email,
                         ':contrasena' => password_hash($contrasena,PASSWORD_BCRYPT),
                         ':dniCliente' => $dniCliente]);

         return true;
    }catch(PDOException $e){
        error_log($e->getMessage());
        return false;
    }
}

function iniciarSesionUsuario($email,$contrasena){
    global $conexion;

    try{
        $consulta = $conexion->prepare("select contrasena from usuario where email = :email");

        $consulta->execute([':email' => $email]);

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