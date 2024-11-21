<?php
require '../clases/db.php';

function obtenerProductos(){
    global $conn;

    $sql = "select idProducto,nombre,foto,peso,precio,descripcion from productos";
    $result = $conn->query($sql);

    $productos = [];

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $productos[] = [
                "idProducto" => $row["idProducto"],
                "nombre" => $row["nombre"],
                "foto" => base64_encode($row["foto"]),
                "peso" => $row["peso"],
                "precio" => $row["precio"],
                "descripcion" => $row["precio"]
            ];
        }
    }

    return $productos;
}
?>