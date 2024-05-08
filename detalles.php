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
    <link rel="stylesheet" href="productos.css">
    <title>Detalles</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
</head>
<body>
    <?php $nombre = $row["nombreUsuario"];?>
    <button onclick="generatePDF('<?php echo $nombre; ?>')">Comprar</button>
    <script>
        function generatePDF(nombre){
            const doc = new jsPDF();
            doc.text(nombre,10,10)
            doc.save(nombre+".pdf");
        }
    </script>
    <a href="logout.php"><button>Logout</button></a>
</body>
</html>
