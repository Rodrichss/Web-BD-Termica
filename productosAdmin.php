<?php 
    include('con.php');
    if($_SESSION['rol'] != 'admin'){
        header('Location: index.php');
        exit();
    }
    $admin = $_SESSION['correo'];
    mysqli_query($con, "SET @admin = '$admin'");

    include('triggers.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="productosAdmin.css">
    <title>Productos</title>
</head>
<body>
    <header>
        <div class="contenedor">
            <h1 class="">Termicá</h1>
            <input type="checkbox" id="menu-bar">
            <label class="icon-menu" for="menu-bar"></label>
            <nav class="menu" >
                <a href="index.php">Inicio</a>
                <a href="#">Usuarios</a>
                <a href="productosAdmin.php">Productos</a>
                <a href="bitacora.php">Bitácora</a>
            </nav>
        </div>
    </header>
    <div class="columns"></div><br><br><br>
    <main>
        <?php
            include('con.php');
            if(!isset($_POST['busqueda'])){
                $_POST['busqueda'] = '';
            }
            if(!isset($_POST['color'])){
                $_POST['color'] = 'Todos';
            }
        ?>
        
        <div class="wrapper">
            <form method="post" action="productosAdmin.php">
                <div class="search-bar">
                    <h3>Buscar</h3><br>
                    
                    <input type="text" class="busqueda-nombre" name="busqueda" id="busqueda" value="<?php echo $_POST['busqueda']?>" 
                        class="barra-busqueda" placeholder="Buscar"/> 
                    <br><br>
                    <label>Color&nbsp</label>
                    <select id="color "name="color" class="select">
                        <option value="Todos">Todos</option>
                        <option value="Negro">Negro</option>
                        <option value="Blanco">Blanco</option>
                        <option value="Azul claro">Azul Claro</option>
                        <option value="Rojo">Rojo</option>
                        <option value="Amarillo">Amarillo</option>
                        <option value="Azul">Azul</option>
                        <option value="Naranja">Naranja</option>
                    </select>
                    
                    <div class="button-wrapper">
                        <button type="submit" class="button">Filtrar</button>
                    </div>
                </div>
            </form>

        <?php
            if($_POST['busqueda']=='' AND $_POST['color']=='Todos'){
                $filter = '';
            }else{
                if($_POST['busqueda']!='' AND $_POST['color']=='Todos'){
                    $filter = "WHERE nombreProducto = '".$_POST['busqueda']."'";
                }
                if($_POST['busqueda']=='' AND $_POST['color']!='Todos'){
                    $filter = "WHERE colorProducto = '".$_POST['color']."'";
                }
                if($_POST['busqueda']!='' AND $_POST['color']!='Todos'){
                    $filter = "WHERE nombreProducto = '".$_POST['busqueda']."' AND colorProducto = '".$_POST['color']."'";
                }
            }
            $sql = mysqli_query($con, "SELECT * FROM producto $filter");{
        ?>

            <table>
                <caption>Productos</caption>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Color</th>
                        <th>Material</th>
                        <!-- <th>Descripción</th> -->
                        <th>Imagen</th>
                        <th>Modificar</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_array($sql)){
                    ?>
                
                <tr>
                    <td data-cell="id"><p><?php echo $row['idProducto']?></p></td>
                    <td data-cell="nombre"><p><?php echo $row['nombreProducto']?></p></td>
                    <td data-cell="precio"><p><?php echo $row['precioProducto']?> $</p></td>
                    <td data-cell="color"><p><?php echo $row['colorProducto']?></p></td>
                    <td data-cell="material"><p><?php echo $row['materialProducto']?></p></td>
                    <!-- <td data-cell="descripcion"><p><//?php echo $row['descripcionProducto']?></p></td> -->
                    <td data-cell="imagen"><img src="<?php echo $row['imagenProducto']?>"></td>
                    <td data-cell="editar/eliminar">
                        <div class="input-wrapper">
                        <form method="post" action="modificarProductos.php">
                            <input id="id" name="id" type="hidden" value="<?php print $row['idProducto'];?>"/>
                            <button type="image" class="erase-button modify-button"></button>
                        </form>
                        <form method="post" action="eliminarProducto.php">
                            <input id="id" name="id" type="hidden" value="<?php print $row['idProducto'];?>"/>
                            <button type="image" class="erase-button"></button>
                        </form>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>


        <div class="button-wrapper">
            <a href="registroProductosForm.php"><button class="button">Añadir producto</button></a>
        </div>
        
    </main>

</body>
</html>