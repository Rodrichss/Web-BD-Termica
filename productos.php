<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="productos.css">
    <title>Productos</title>
</head>
<body>
    <!-- <header>
        <div class="contenedor">
            <h1 class="">Termicá</h1>
            <input type="checkbox" id="menu-bar">
            <label class="icon-menu" for="menu-bar"></label>
            <nav class="menu" >
                <a href="index.html">Inicio</a>
                <a href="mision.html">Misión</a>
                <a href="vision.html">Visión</a>
                <a href="productos.html">Productos</a>
                <a href="login.html">Login</a>
                <a href="registro.html">Registrarse</a>
            </nav>
        </div>
    </header> -->

    <main>
        <div class="columns">
           <!-- <div class="column">
                <img src="https://m.media-amazon.com/images/I/61IOjZPFzOL._AC_UL480_FMwebp_QL65_.jpg" alt="Producto 1">
                <div class="product-info">
                    <h2>Vaso Termico 30Oz/880ML</h2>
                    <h1>$150</h1>
                    
                    <button class="button">Agregar al carrito</button>
                </div>
            </div>

            <div class="column">
                <img src="https://m.media-amazon.com/images/I/61p4o27NghL._AC_UL480_FMwebp_QL65_.jpg" alt="Producto 2">
                <div class="product-info">
                    <h2>Vaso Térmico de Acero Inoxidable</h2>
                    <h1>$150</h1>
                    
                    <button class="button">Agregar al carrito</button>
                </div>
            </div>
            <div class="column">
                <img src="https://m.media-amazon.com/images/I/41z-fEBGHmL._AC_UL480_FMwebp_QL65_.jpg" alt="Producto 3">
                <div class="product-info">
                    <h2>40OZ Vaso Térmico de Acero Inoxidable</h2>
                    <h1>$225</h1>
                    
                    <button class="button">Agregar al carrito</button>
                </div>
            </div>
            <div class="column">
                <img src="https://m.media-amazon.com/images/I/71HUDfgQ8bL._AC_UL480_FMwebp_QL65_.jpg" alt="Producto 4">
                <div class="product-info">
                    <h2>Coleman Vaso de Acero Inoxidable Aislado</h2>
                    <h1>$150</h1>
                    
                    <button class="button">Agregar al carrito</button>
                </div>
            </div> -->

            <?php
                include('con.php');
                $sql = mysqli_query($con, "SELECT * FROM producto;");
                while($row = mysqli_fetch_array($sql)){ ?>
                    <form action="carrito.php" method="post">
                        <div class="column">
                            <img src="<?php echo $row['imagenProducto']?>">
                            <div class="product-info">
                                <input type="hidden" id="id" name="id" value="<?php echo $row ['idProducto']?>"/>
                                <input type="hidden" id="nombre" name="nombre" value="<?php echo $row['nombreProducto']?>"/>
                                <input type="hidden" id="precio" name="precio" value="<?php echo $row['precioProducto']?>"/>
                                <input type="hidden" id="cantidad" name="cantidad" value="1"/>


                                <h2><?php echo $row['nombreProducto']?></h2>
                                <h1>$<?php echo $row['precioProducto']?></h1>
                                <a href="detalles.php"><button class="button button-color">Detalles</button></a>
                                <button class="button" type="submit">Agregar al carrito</button>
                            </div>
                        </div>
                    </form>
            <?php } ?>
        </div>
    </main>

</body>
</html>