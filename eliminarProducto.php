<?php
    include('con.php');
    if($_SESSION['rol'] != 'admin'){
        header('Location: index.php');
        exit();
    }
    $admin = $_SESSION['correo'];
    mysqli_query($con, "SET @admin = '$admin'");    

    $id = $_POST['id'];
    $delete = mysqli_query($con, "DELETE FROM producto WHERE idProducto='$id'");

    if($delete){
        echo "Producto eliminado";
        header("Location: ".$_SERVER['HTTP_REFERER']."");
    }else{
        echo "Error al eliminar";
    }
?>