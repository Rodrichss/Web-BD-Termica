<?php 
include("con.php");

if(isset($_SESSION['carrito'])){
    $carrito = $_SESSION['carrito'];
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $indexCarrito = -1;
    $repetido = false;
    $nuevaCantidad = 0;

    for($i=0;$i<=count($carrito);$i ++){
        if(isset($carrito[$i])){
            if($id==$carrito[$i]['id']){
                $nuevaCantidad = $carrito[$i]['cantidad'] + $cantidad;
                $carrito[$i]['cantidad'] = $nuevaCantidad;
                $repetido = true;
                break;
            }
        }
    }
    if(!$repetido){
        $carrito[]=array("id"=>$id, "nombre"=>$nombre, "precio"=>$precio,"cantidad"=>$cantidad);
    }

    // if($indexCarrito != -1){
    //     $nuevaCantidad = $carrito[$indexCarrito]['cantidad'] + $cantidad;
    // }else{
    //     $carrito[]=array("id"=>$id, "nombre"=>$nombreP, "precio"=>$precio,"cantidad"=>$cantidad);
    // }
}else{
    $nombreP = $_POST['nombreP'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $carrito[]=array("id"=>$id, "nombre"=>$nombre, "precio"=>$precio,"cantidad"=>$cantidad);
}

$_SESSION['carrito'] = $carrito;

header("Location: ".$_SERVER['HTTP_REFERER']."");

?>