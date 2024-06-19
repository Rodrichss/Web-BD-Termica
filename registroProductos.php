<?php

include "con.php";
if($_SESSION['rol'] != 'admin'){
    header('Location: index.php');
    exit();
}

$admin = $_SESSION['correo'];
mysqli_query($con, "SET @admin = '$admin'");

$nombre=$_POST['nombre'];
$precio = floatval($_POST['precio']);
$color = $_POST['color'];
$imagen = $_POST['imagen'];
$material = $_POST['material'];
$descripcion = $_POST['descripcion'];

$sql = mysqli_query($con, "INSERT INTO producto(nombreProducto,precioProducto,colorProducto,imagenProducto,
descripcionProducto,materialProducto,popularProducto
)values('$nombre','$precio','$color','$imagen','$descripcion','$material',false)");

if($sql){
    echo "Producto Registrado";
    header('Location: productosAdmin.php'); //
    exit; //
}else{
    echo "Error al registrar";
}
?>