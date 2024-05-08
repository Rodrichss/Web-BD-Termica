<?php
    session_start();
    $carrito = $_SESSION['carrito'];
    if(isset($_POST['cantidad'])){
        $id=$_POST['id'];
        $cantidad = $_POST['cantidad'];
        if($cantidad>=1){
            $carrito[$id]['cantidad'] = $cantidad;
        }
        else{
            unset($carrito[$id]);
            //$carrito[$id] = NULL;
        }
    }
    if(isset($_POST['id2'])){
        $id=$_POST['id2'];
        $carrito[$id] = NULL;
    }

    $_SESSION['carrito'] = $carrito;
    header("Location: ".$_SERVER['HTTP_REFERER']."");
?>