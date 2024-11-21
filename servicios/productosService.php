<?php
require '../config/db.php';

function obtenerProductos(){
    global $conexion;

    try{
        $sql = "select idProducto,nombre,foto,peso,precio,descripcion from productos";
        $stmt = $conexion->query($sql);

        $productos = [];

    
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $productos[] = [
                "idProducto" => $row["idProducto"],
                "nombre" => $row["nombre"],
                "foto" => base64_encode($row["foto"]),
                "peso" => $row["peso"],
                "precio" => $row["precio"],
                "descripcion" => $row["descripcion"]
            ];
        }
    return $productos;
    }catch(PDOException $e){
        die("Error en la consulta: " . $e->getMessage());
    }

}

function obtenerProductoPorId($idProducto){
    global $conexion;

    try{
        $sql = "select idProducto,nombre,foto,peso,precio,descripcion from productos where idProducto = :idProducto";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idProducto',$idProducto,PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return [
                "idProducto" => $row["idProducto"],
                "nombre" => $row["nombre"],
                "foto" => base64_encode($row["foto"]),
                "peso" => $row["peso"],
                "precio" => $row["precio"],
                "descripcion" => $row["descripcion"]
            ];
        }else{
            return null;
        }

    }catch(PDOException $e){
        die("Error en la consulta: " . $e->getMessage());
    }
}
?>