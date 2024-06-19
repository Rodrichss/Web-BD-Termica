<?php
include('con.php');

if(isset($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($con, "SELECT * FROM usuario WHERE idUsuario = $id");
    $row = mysqli_fetch_assoc($result);
}else{
    header("Location: login.html");
}
ob_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="factura.css">
</head>
<body>
    <div class="header">
        <div>
            <h1>Termicá</h1>
            <p>Dirección de la empresa</p>
        </div>
        <img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/proyecto1/img/logo_32px.png" alt="Logo" class="logo">
    </div>
    <hr>
    <h2>Factura</h2>
    <p>Cliente: <?php echo $row['nombreUsuario']; echo " "; echo $row['apellidoPUsuario'];
        echo " "; echo $row['apellidoMUsuario']?></p>
    <p>Fecha: <?php echo Date("d-m-Y");?></p>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio por Unidad</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $subtotal=0;         
            if(isset($_SESSION['carrito'])){
            
            $carrito = $_SESSION['carrito'];
            for($i=0;$i<=count($carrito); $i ++){
                if(isset($carrito[$i])){
                if($carrito[$i]!=NULL){
                        ?>
            <tr>
                <td><?php echo $carrito[$i]['nombre'];?></td>
                <td>$ <?php echo $carrito[$i]['precio'];?></td>
                <td><?php echo $carrito[$i]['cantidad'];?></td>
                <td><?php echo $carrito[$i]['precio']*$carrito[$i]['cantidad'];?> $</td>
            </tr>
            <?php 
                $subtotal = $subtotal + ($carrito[$i]['precio'] * $carrito[$i]['cantidad']);

            }}}}
            $iva=$subtotal*0.16;
            $total = $subtotal + $iva;
            ?>
            
        </tbody>
    </table>
    <p class="subtotal">Subtotal: $<?php echo $subtotal;?></p>
    <p class="subtotal">IVA: $<?php echo $iva;?></p>
    <p class="subtotal">Total: $<?php echo $total?></p>
</body>
</html>
<?php 
$html=ob_get_clean();
//echo $html;

require_once '../proyecto1/Dom/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('letter');
$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

//$dompdf->stream("factura.pdf", array("Attachment" => false));


$nombre = $row['nombreUsuario'];
$apellidoP = $row['apellidoPUsuario'];
$apellidoM = $row['apellidoMUsuario'];
$correo = $row['correoUsuario'];
$message = 'Su factura, ' .$nombre.' '.$apellidoP.' '.$apellidoM;

$output=$dompdf->output();


$title = 'Pedido de '.$nombre." ".Date("F_j_Y");

$to = $correo;
$from = "termica.contacto@gmail.com";
$subject = $title;

$file = $title . ".pdf";
file_put_contents($file,$output);
$attachment = chunk_split(base64_encode(file_get_contents($file)));
$boundary = md5(date('r', time()));


$headers = "From: Termica <$from>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

$body = "--$boundary\r\n";
$body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n";
$body .= "\r\n" . chunk_split(base64_encode($message)) . "\r\n";

$body .= "--$boundary\r\n";
$body .= "Content-Type: application/pdf; name=\"$file\"\r\n";
$body .= "Content-Disposition: attachment; filename=\"$file\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n";
$body .= "\r\n" . $attachment . "\r\n";
$body .= "--$boundary--";

if(mail($to, $subject, $body, $headers)){
    header("Location: index.php ");
    $_SESSION['carrito'] = [];
}else{
    echo "Error al enviar el correo";
}