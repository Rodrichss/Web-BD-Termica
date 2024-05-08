<?php

include "con.php";

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
    header('Location: index.html'); //
    exit; //
}else{
    echo "Error al registrar";
}
?>