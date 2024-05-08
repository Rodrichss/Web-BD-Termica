<?php

include "con.php";

$email=$_POST['email'];
$password=$_POST['password'];

$query = mysqli_query($con, "SELECT * FROM usuario WHERE correoUsuario = '".$email."' and passwordUsuario = '".$password."'");
$nr = mysqli_num_rows($query);
$row = mysqli_fetch_assoc($query);

if($nr == 1){
    if($password == $row["passwordUsuario"]){
        $_SESSION["login"] = true;
        $_SESSION["id"] = $row["idUsuario"];
        echo "Sesión iniciada exitosamente";
        header('Location: index.php'); //
        exit; // 
    }
    else{
        echo "Contraseña incorrecta";
    }
}
else if ($nr == 0){
    echo "Usuario no registrado"; //error al iniciar sesión
}
?>