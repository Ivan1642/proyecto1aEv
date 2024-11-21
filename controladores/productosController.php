<?php
require '../servicios/productosService.php';

$productos = obtenerProductos();

header('Content-Type: application/json');
echo json_encode($productos);
exit();
?>