<?php
include '../servicios/carritoService.php';

if(!isset($_SESSION['carrito_id'])){
    $idUnico = generarIdCarrito();
    $_SESSION['carrito_id'] = $idUnico;

    insertarCarritoEnDB($idUnico);
}

echo json_encode(['carrito_id' => $_SESSION['carrito_id']]);
?>