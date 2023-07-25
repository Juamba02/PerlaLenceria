<?php
include('../php/connection.php');
session_start();

if(!isset($_SESSION['cliente'])){
    header('Location: https://perlalenceria.com');
    exit;
}

function generarCodigoAlfanumerico($longitud = 8) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo = '';

    for ($i = 0; $i < $longitud; $i++) {
        $posicion = rand(0, strlen($caracteres) - 1);
        $codigo .= $caracteres[$posicion];
    }

    return $codigo;
}

$payment = $_GET['payment_id'];
$status = $_GET['status'];
$type = $_GET['payment_type'];
$order_id = $_GET['merchant_order_id'];

$sqlVer = "SELECT * FROM datos_clientes WHERE id_compra = '$payment'";
$resVer = mysqli_query($connection, $sqlVer);

if(mysqli_num_rows($resVer) > 0){
    unset($_SESSION['cliente']);
    unset($_SESSION['descuento']);
    unset($_SESSION['tipo']);
    unset($_SESSION['carrito']);
    header('Location: https://perlalenceria.com');
    exit;
}

$cliente = $_SESSION['cliente'];
$productos = $_SESSION['carrito'];
$productosJson = json_encode($productos);

$nombre = $cliente['nombre'];
$apellido = $cliente['apellido'];
$dni = $cliente['dni'];
$telefono = $cliente['telefono'];
$email = $cliente['email'];
$tipo = $cliente['tipo'];
$fecha = date('Y-m-d');

if (isset($cliente['piso']) && isset($cliente['depto'])) {
    $provincia = $cliente['provincia'];
    $ciudad = $cliente['ciudad'];
    $codigo = $cliente['codigo'];
    $calle = $cliente['calle'];
    $numero = $cliente['numero'];
    $piso = $cliente['piso'];
    $depto = $cliente['depto'];

    $sql = "INSERT INTO datos_clientes (fecha, estado, tipo, nombre, apellido, dni, telefono, email, provincia, ciudad, codigo, calle, numero, piso, depto, id_compra, productos)
    VALUES ('$fecha', 'Pendiente', '$tipo', '$nombre', '$apellido', '$dni', '$telefono', '$email', '$provincia', '$ciudad', '$codigo', '$calle', '$numero', '$piso', '$depto', '$order_id', '$productosJson');
    ";
    $res = mysqli_query($connection, $sql);
}else if (isset($cliente['provincia'])) {
    $provincia = $cliente['provincia'];
    $ciudad = $cliente['ciudad'];
    $codigo = $cliente['codigo'];
    $calle = $cliente['calle'];
    $numero = $cliente['numero'];

    $sql = "INSERT INTO datos_clientes (fecha, estado, tipo, nombre, apellido, dni, telefono, email, provincia, ciudad, codigo, calle, numero, id_compra, productos)
    VALUES ('$fecha', 'Pendiente', '$tipo', '$nombre', '$apellido', '$dni', '$telefono', '$email', '$provincia', '$ciudad', '$codigo', '$calle', '$numero', '$order_id', '$productosJson');
    ";
    $res = mysqli_query($connection, $sql);
}else{
    $soloGiftcards = 0;
    foreach($productos as $producto) {
        $idProducto = $producto['id'];
        $sqlG = "SELECT * FROM productos WHERE id = '$idProducto'";
        $resG = mysqli_query($connection, $sqlG);
        $fila = mysqli_fetch_assoc($resG);
        if($fila['categoria'] != 'Giftcards') {
            $soloGiftcards = 1;
        }
    }
    if($soloGiftcards == 1) {
        $sql = "INSERT INTO datos_clientes (fecha, estado, tipo, nombre, apellido, dni, telefono, email, id_compra, productos)
        VALUES ('$fecha', 'Pendiente', '$tipo', '$nombre', '$apellido', '$dni', '$telefono', '$email', '$order_id', '$productosJson');
        ";
        $res = mysqli_query($connection, $sql);
    }else{
        $sql = "INSERT INTO datos_clientes (fecha, estado, tipo, nombre, apellido, dni, telefono, email, id_compra, productos)
    VALUES ('$fecha', 'Listo', '$tipo', '$nombre', '$apellido', '$dni', '$telefono', '$email', '$order_id', '$productosJson');
    ";
    $res = mysqli_query($connection, $sql);
    }
    
}

if(isset($_SESSION['code'])) {
    if($_SESSION['tipo'] == 'giftcard'){
        $codigo = $_SESSION['code'];
        $sqlC = "DELETE FROM giftcards WHERE codigo = '$codigo'";
        $res = mysqli_query($connection, $sqlC);
    }
    unset($_SESSION['code']);
    unset($_SESSION['descuento']);
    unset($_SESSION['tipo']);
}

$giftcards = [];

foreach ($productos as $producto) {
    $idProducto = $producto['id'];
    $sqlG = "SELECT * FROM productos WHERE id = $idProducto"; // Corregido $id a $idProducto
    $resG = mysqli_query($connection, $sqlG);
    $fila = mysqli_fetch_assoc($resG);
    
    if ($fila['categoria'] == "Giftcards") {
        for ($i = 1; $i <= intval($producto['cantidad']); $i++) { // Corregido >= a <=
            $precio = $fila['precio'];
            $codigo = generarCodigoAlfanumerico();
            $giftcard = new stdClass();
            $giftcard->codigo = $codigo;
            $giftcard->valor = $precio; // Corregido precio a valor
            $giftcards[] = $giftcard;
            $sqlI = "INSERT INTO giftcards (codigo, tipo, descuento, estado) VALUES ('$codigo', 'giftcard', $precio, 'true')";
            $resI = mysqli_query($connection, $sqlI);
        }
    }
}

$_SESSION['giftcards'] = $giftcards;
unset($_SESSION['carrito']);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <script src="../js/vaciarCarrito.js"></script>
</head>
<body>
    <?php var_dump($giftcards); ?>
</body>
</html>
<?php header("Location: ./compraFinalizada"); ?>