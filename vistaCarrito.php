<?php 
    require 'con.php';

    if(!empty($_SESSION["id"])){
        $id = $_SESSION["id"];
        $result = mysqli_query($con, "SELECT * FROM usuario WHERE idUsuario = $id");
        $row = mysqli_fetch_assoc($result);
    }else{
        header("Location: login.html");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="productosAdmin.css">
    <title>Carrito</title>
</head>
<body>
    <main>
        <div class="columns">
            <div class="wrapper">
                <table>
                    <caption>Tu carrito de compras</caption>
                    <thead>
                        <tr>
                            <th>Artículo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            
                            if(isset($_SESSION['carrito'])){
                                $total=0;
                                $carrito = $_SESSION['carrito'];
                                for($i=0;$i<=count($carrito); $i ++){
                                    if(isset($carrito[$i])){
                                    if($carrito[$i]!=NULL){
                        ?>

                        <tr>
                            <td><p><?php echo $carrito[$i]['nombre'];?></p></td>
                            <td><p><?php echo $carrito[$i]['precio'];?> $</p></td>
                            <td>
                                <form method="post" action="modificarCarrito.php">
                                    <div class="input-wrapper">
                                        <input id="id" name="id" type="hidden" value="<?php print $i;?>"/>
                                        <input id="cantidad" name="cantidad" type="text" value="<?php print $carrito[$i]['cantidad'];?>" 
                                            class="input-cantidad"/>
                                        <input type="image" name="UpdateImage" src="../proyecto1/img/cart_update_icon_32px.png" value="" />
                                    </div>
                                </form>
                            </td>
                            <td><p><?php echo $carrito[$i]['precio'] * $carrito[$i]['cantidad'];?> $</p></td>

                            <td>
                                <form method="post" action="modificarCarrito.php">
                                        <input id="id2" name="id2" type="hidden" value="<?php print $i;?>"/>
                                        <button type="image" class="erase-button"></button>
                                </form>
                            </td>
                        </tr>
                        <?php 
                            $total = $total + ($carrito[$i]['precio'] * $carrito[$i]['cantidad']);

                        }}}}?>
                        <tr> <td class="empty-cell"></td> <td class="empty-cell"></td> <td class="empty-cell"></td>
                        <td>
                        <strong>
                        <?php
                            if(isset($_SESSION['carrito'])){
                                $total=0;
                                for($i=0;$i<=count($carrito)-1;$i ++){
                                    if(isset($carrito[$i])){
                                        if($carrito[$i]!=NULL){
                                            $total = $total + ($carrito[$i]['precio'] * $carrito[$i]['cantidad']);
                                        }
                                    }
                                }
                            }
                            if(!isset($total)){
                                $total = 0;
                            }else{
                                $total = $total;
                            }
                            echo $total; ?> $</strong>
                        </td>
                        <td class="empty-cell"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="wrapper-continuar">
                    <a type="button" class="button" href="factura.php">Enviar pedido</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>