<?php
include('con.php');

if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($con, "SELECT * FROM usuario WHERE idUsuario = $id");
    $row = mysqli_fetch_assoc($result);
}else{
    header("Location: login.html");
}

?>