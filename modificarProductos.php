<?php include('con.php');

    $id = $_POST['id'];
    $query = mysqli_query($con, "SELECT * FROM producto WHERE idProducto='$id'");

    $producto = mysqli_fetch_assoc($query);
    $nombre = $producto['nombreProducto'];
    $precio = $producto['precioProducto'];
    $color = $producto['colorProducto'];
    $material = $producto['materialProducto'];
    $imagen = $producto['imagenProducto'];
    $descripcion = $producto['descripcionProducto'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="registroProductos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar producto</title>
</head>
<body>
    <section class="box" class="form" id="todo">
        <h1 class="topbox">Ingrese los nuevos valores del producto de id: <?php print $id;?></h1>
        <form action="editarProducto.php" method="post">
            <ul>
                <input class="form-label" type="hidden" id="id" name="id" value="<?php print $id;?>"/>    

                <label class="label" for="nombre">Nombre</label><br>
                <input class="form-label" type="text" id="nombre" name="nombre" placeholder="<?php echo $nombre;?>"/>

                <label class="label" for="precio">Precio (en pesos)</label><br>
                <input class="form-label" type="text" id="precio" name="precio" placeholder="<?php echo $precio;?>"/>

                <label class="label" for="color">Color</label><br>
                <input class="form-label" type="text" id="color" name="color" placeholder="<?php echo $color;?>"/>

                <label class="label" for="material">Material</label><br>
                <input class="form-label" type="text" id="material" name="material" placeholder="<?php echo $material;?>"/>

                <label class="label" for="imagen">URL de imagen</label><br>
                <input class="form-label" type="text" id="imagen" name="imagen" placeholder="<?php echo $imagen;?>"/>

                <label class="label" for="descripcion">Descripción</label><br>
                <input class="form-descripcion" type="text" id="descripcion" name="descripcion" placeholder="<?php echo $descripcion;?>"/>
            </ul>
            <button class="button" type="submit">Modificar producto</button>
        </form>
    </section>
</body>
</html>