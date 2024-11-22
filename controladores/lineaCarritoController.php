<?php
    include '../servicios/carritoService.php';

    $data = json_decode(file_get_contents("php://input"));

    if(isset($data->idCarrito) && isset($data->idProducto) && isset($data->cantidad)){
        $idCarrito = $data->idCarrito;
        $idProducto = $data->idProducto;
        $cantidad = $data->cantidad;

        try{
            insertarFilaCarrito($idCarrito,$idProducto,$cantidad);
            echo json_encode(['success' => true]);
        }catch(Exception $e){
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }else{
        echo json_encode(['success' => false, 'message' => 'Faltan datos']);
    }
?>