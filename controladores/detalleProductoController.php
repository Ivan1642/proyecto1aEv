<?php
include '../servicios/productosService.php';

if(isset($_GET['id'])){
    $idProducto = $_GET['id'];

    $producto = obtenerProductoPorID($idProducto);

    if($producto){
        echo json_encode($producto);
    }else{
        echo json_encode(['error' => 'producto no encontrado']);
    }
}else{
    echo json_encode(['error' => 'ID de producto no proporcionado']);
}
?>