<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

include '../config/db.php';

function generarIdCarrito(){
    return uniqid('carrito_',true);
}

function insertarCarritoEnDB($idCarrito){
    global $conexion;

    try{
        $stmt = $conexion->prepare("insert into carrito (idCarrito) values (:idCarrito)");
        $stmt->bindParam(':idCarrito',$idCarrito);
        $stmt->execute();
    }catch(PDOException $e){
        die("Error al insertar el carrito en la base de datos: " . $e->getMessage());
    }
}

function insertarFilaCarrito($idCarrito,$idProducto,$cantidad){
    global $conexion;

    try{
        $stmt = $conexion->prepare("select ifnull(max(nlinea), 0) + 1 as siguienteLinea from lineasCarrito where idCarrito = :idCarrito");
        $stmt->bindParam(':idCarrito',$idCarrito,PDO::PARAM_STR);
        $stmt->execute();
        $nlinea = $stmt->fetch(PDO::FETCH_ASSOC)['siguienteLinea'];

        $stmt = $conexion->prepare("insert into lineasCarrito (idCarrito,nlinea,idProducto,cantidad) values (:idCarrito,:nlinea,:idProducto,:cantidad)");
        $stmt->bindParam(':idCarrito',$idCarrito,PDO::PARAM_STR);
        $stmt->bindParam(':nlinea',$nlinea,PDO::PARAM_INT);
        $stmt->bindParam(':idProducto',$idProducto,PDO::PARAM_INT);
        $stmt->bindParam(':cantidad',$cantidad,PDO::PARAM_INT);

        $stmt->execute();
    }catch(PDOException $e){
        die("Error al insertar una fila en el carrito: " . $e->getMessage());
    }
}

function obtenerProductosPorIdCarrito($idCarrito,$conexion){

    $sql = "select idProducto from lineasCarrito where idCarrito = :idCarrito";

    try{
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idCarrito',$idCarrito,PDO::PARAM_STR);
        $stmt->execute();

        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(empty($productos)){
            echo json_encode(["error" => "No se han encontrado productos para este carrito"]);
            exit();
        }

        return array_column($productos,'idProducto');
    }catch(PDOException $e){
        die("Error al obtener productos: " . $e->getMessage());
    }
}

function obtenerDetallesProductos($idCarrito){
    global $conexion;

    header('Content-Type: application/json');

    $productosIds = obtenerProductosPorIdCarrito($idCarrito,$conexion);

    if(empty($productosIds)){
        echo json_encode([]);
        exit();
    }

    $productosIds = array_map('intval',$productosIds);
    $idsString = implode(',',$productosIds);

    $sql = "select idProducto, nombre, foto, peso, precio, descripcion from productos where idProducto in ($idsString)";

    try{
        $stmt = $conexion->query($sql);

        $productosDetalles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($productosDetalles);

        foreach($productosDetalles as &$producto){
            if($producto['foto']){
                $producto['foto'] = 'data:image/avif;base64,' . base64_encode($producto['foto']);
            }
        }

        echo json_encode($productosDetalles);
        exit();
    }catch(PDOException $e){
        die("Error al obtener los detalles de los productos: " . $e->getMessage());
    }
}
?>