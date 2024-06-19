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
        $_SESSION['nombre'] = $row['nombreUsuario'];
        $_SESSION['apellidoP'] = $row['apellidoPUsuario'];
        $_SESSION['apellidoM'] = $row['apellidoMUsuario'];
        $_SESSION['correo'] = $row['correoUsuario'];
        $_SESSION['telefono'] = $row['telefonoUsuario'];
        $_SESSION['rol'] = $row['rolUsuario'];

        if($row['rolUsuario'] == 'usuario'){
            echo "Sesión iniciada exitosamente";
            header('Location: index.php'); //
            exit; // 
        }else if($row['rolUsuario'] == 'admin'){
            echo "Sesión iniciada exitosamente";
            header('Location: productosAdmin.php'); //
            exit; // 
        }
    }
    else{
        echo "Contraseña incorrecta";
    }
}
else if ($nr == 0){
    echo "Usuario no registrado"; //error al iniciar sesión
}
?>