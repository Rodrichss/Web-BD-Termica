<?php

include "con.php";

$nombre=$_POST['nombre'];
$apellidoP = $_POST['apellidoP'];
$apellidoM = $_POST['apellidoM'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$password = $_POST['password'];

$sql = mysqli_query($con, "INSERT INTO usuario(idUsuario,nombreUsuario,apellidoPUsuario,apellidoMUsuario,correoUsuario,telefonoUsuario,
passwordUsuario)values(0,'$nombre','$apellidoP','$apellidoM','$correo','$telefono','$password')");


if($sql){
    echo "Usuario Registrado";
    header('Location: index.html'); //
    exit; //
}else{
    echo "Error al registrar";
}
?>