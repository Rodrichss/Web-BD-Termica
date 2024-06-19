<?php
include "con.php";
if ($_SESSION['rol'] != 'admin') {
    header('Location: index.php');
    exit();
}

$admin = $_SESSION['correo'];
mysqli_query($con, "SET @admin = '$admin'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="bitacora.css">
    <title>Bitácora productos</title>
</head>
<body>
<header>
        <div class="contenedor">
            <h1 class="">Termicá</h1>
            <input type="checkbox" id="menu-bar">
            <label class="icon-menu" for="menu-bar"></label>
            <nav class="menu">
                <a href="index.php">Inicio</a>
                <a href="#">Usuarios</a>
                <a href="productosAdmin.php">Productos</a>
                <a href="bitacora.php">Bitácora</a>
            </nav>
        </div>
    </header>

    <div class="columns"></div><br><br><br><br><br>

    <div class="wrapper">
    <main>
        <table>
            <caption>Bitácora</caption>
            <thead>
                <tr>
                    <!-- <th>Id</th> -->
                    <th>Operación</th>
                    <th>Fecha</th>
                    <th>Administrador</th>
                    <th>Sentencia</th>
                    <th>Contrasentencia</th>
                    <th>Deshacer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = mysqli_query($con, "SELECT * FROM bitacora ORDER BY fecha DESC");
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                <tr>
                    <!-- <td data-cell="id"><//?php echo $row['idLog'] ?></td> -->
                    <td data-cell="operacion"><?php echo $row['operacion'] ?></td>
                    <td data-cell="fecha"><?php echo $row['fecha'] ?></td>
                    <td data-cell="administrador"><?php echo $row['admin'] ?></td>
                    <td data-cell="sentencia" class="sentencia"><?php echo $row['sentencia'] ?></td>
                    <td data-cell="contrasentencia" class="sentencia"><?php echo $row['contrasentencia'] ?></td>
                    <td>
                        <div class="input-wrapper">
                        <form method="post" action="deshacer.php">
                            <input id="idLog" type="hidden" name="idLog" value="<?php echo $row['idLog'] ?>">
                            <input id="contrasentencia" type="hidden" name="contrasentencia" value="<?php echo $row['contrasentencia'] ?>">
                            <button type="image" class="undo-button"></button>
                        </form>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    </div>

</body>
</html>