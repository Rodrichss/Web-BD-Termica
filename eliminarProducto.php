<?php
    include('con.php');

    $id = $_POST['id'];
    $delete = mysqli_query($con, "DELETE FROM producto WHERE idProducto='$id'");

    if($delete){
        echo "Producto eliminado";
        header("Location: ".$_SERVER['HTTP_REFERER']."");
    }else{
        echo "Error al eliminar";
    }
?>