<?php
    include('con.php');
    if($_SESSION['rol'] != 'admin'){
        header('Location: index.php');
        exit();
    }
    $admin = $_SESSION['correo'];
    mysqli_query($con, "SET @admin = '$admin'");    

    $id = $_POST['id'];
    $nombre=$_POST['nombre'];
    $precio = floatval($_POST['precio']);
    $color = $_POST['color'];
    $imagen = $_POST['imagen'];
    $material = $_POST['material'];
    $descripcion = $_POST['descripcion'];

    $modify = mysqli_query($con, "UPDATE producto SET nombreProducto='$nombre', 
        precioProducto='$precio', colorProducto='$color', imagenProducto='$imagen',
        materialProducto='$material', descripcionProducto='$descripcion' WHERE idProducto='$id'");

    if($modify){
        echo "Producto modificado";
        header("Location: productosAdmin.php");
        exit;
    }else{
        echo "Error al modificar";
    }
?>