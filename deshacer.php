<?php 
    include('con.php');
    if($_SESSION['rol'] != 'admin'){
        header('Location: index.php');
        exit();
    }

    $admin = $_SESSION['correo'];
    mysqli_query($con, "SET @admin = '$admin'");
    //ajustar lo de abajo a mi base de datos//
    $idLog = $_POST['idLog'];
    $contrasentencia = $_POST['contrasentencia'];
    // Obtener la operación de la bitácora
    $registro = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM bitacora WHERE idLog = '$idLog'"));
    
    // $id = $registro['idProducto'];
    // $nombre = $registro['nombreProducto'];
    // $precio = $registro['precioProducto'];
    // $color = $registro['colorProducto'];
    // $imagen = $registro['imagenProducto'];
    // $descripcion = $registro['descripcionProducto'];
    // $material = $registro['materialProducto'];
    // $popular = $registro['popularProducto'];

    // if ($registro['operacion'] == 'INSERT') {
    //     // Deshacer inserción
    //     mysqli_query($con, "DELETE FROM producto WHERE idProducto = '$id'");
    // } elseif ($registro['operacion'] == 'UPDATE') {
    //     // Deshacer actualización
    //     mysqli_query($con, "UPDATE producto SET 
    //         nombreProducto = '$nombre',
    //         precioProducto = '$precio',
    //         colorProducto = '$color',
    //         imagenProducto = '$imagen',
    //         descripcionProducto = '$descripcion',
    //         materialProducto = '$material',
    //         popularProducto = '$popular'
    //         WHERE idProducto = '$id'");
    // } elseif ($registro['operacion'] == 'DELETE') {
    //     // Deshacer eliminación
    //     mysqli_query($con, "INSERT INTO producto (idProducto, nombreProducto, precioProducto, colorProducto, imagenProducto,
    //      descripcionProducto, materialProducto, popularProducto) 
    //     VALUES ('$id', '$nombre', '$precio', '$color', '$imagen', '$descripcion', '$material', '$popular')");
    // }
    
    mysqli_query($con, $contrasentencia);
    mysqli_query($con, "DELETE FROM bitacora WHERE idLog = '$idLog'");

    header('Location: bitacora.php');
    exit();

?>