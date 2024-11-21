<?php
require '../clases/db.php';

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
?>