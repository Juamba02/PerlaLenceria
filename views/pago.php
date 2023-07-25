<?php
include('../php/connection.php');
require __DIR__ .  '/../vendor/autoload.php';
session_start();

$productos_mp = array();
$data = $_GET['data'];
$total = 0;
$carrito = json_decode($data, true);
// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-3606027160023139-063011-3b5d9606775f81ad3d81f6ab0db6eb98-470921312');
// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();
foreach($carrito as $producto) {
    $id = $producto['id_producto'];
    $sql = "SELECT * FROM productos WHERE id = '$id'";
    $res = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($res);
    $cantidad = $producto['cantidad'];
    $nombre = $row['nombre'];
    if(isset($_SESSION['descuento'])) {
        $descuento = $_SESSION['descuento']/$cantidad;
        $precio = $row['precio'] - $descuento;
    }else{
        $precio = $row['precio'];
    }
    
    $total += $precio * $cantidad;

    $item = new MercadoPago\Item();
    $item->title = $nombre;
    $item->quantity = $cantidad;
    $item->unit_price = $precio;
    array_push($productos_mp, $item);
    unset($item);
}

$preference->items = $productos_mp;

$preference->payment_methods = array(
    "excluded_payment_types" => array(
      array("id" => "ticket")
    )
);

$preference->back_urls = array(
    "success" => "https://perlalenceria.com/views/success.php",
    "failure" => "https://perlalenceria.com/views/failure"
);
$preference->auto_return = "approved";
$preference->binary_mode = true;

$preference->save();
// Crea un ítem en la preferencia

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c8d9eaff72.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://cdn.rawgit.com/download/memorystorage/0.11.0/dist/memorystorage.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="../js/inputsForm.js"></script>
    <link rel="shortcut icon" href="../img/logo.png">
    <title>Datos - Perla Lencería</title>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago('TEST-70abc31c-ff2c-4fb2-b3a7-f580e73a3e67', {
            locale: 'es-AR'
        });
        const bricksBuilder = mp.bricks();
        mp.bricks().create("wallet", "wallet_container", {
        initialization: {
            preferenceId: "<?php echo $preference->id; ?>"
        },
        });
    </script>
</head>
<body>

<div class="wrapper">
    <header class="header">
        <p class="centradorIzquierda">.</p>
        <a href="https://perlalenceria.com" class="logoPerla">
            <img src="../img/logo.png" alt="logo" class="logo">
        </a>
        <p class="centradorDerecha">.</p>
    </header>
    <main class="mainCarrito">
        <div class="divFlecha">
            <a href="https://perlalenceria.com/views/carrito">
                <i class="fa-solid fa-chevron-left fa-2xl" style="color: grey;" ></i>
                <span class="botonAtras">Atrás</span>
            </a>
        </div>
        <h2>Completá tus datos</h2>
        <form class ="formDatos" action="" id="formDatos">
            <label for="name" class="form-label"><span style="color: red">*</span> Nombre:</label>
            <input type="text" class="form-control" name="name" id="name" required>
            <label for="lastName" class="form-label"><span style="color: red">*</span> Apellido:</label>
            <input type="text" class="form-control" name="lastName" id="lastName" required>
            <label for="dni" class="form-label"><span style="color: red">*</span> DNI:</label>
            <input type="text" minlength="8" maxlength="8" class="form-control" name="dni" id="dni" required>
            <label for="tel" class="form-label"><span style="color: red">*</span> Telefono:</label>
            <input type="tel" class="form-control" name="tel" id="tel" required>
            <label for="email" class="form-label"><span style="color: red">*</span> Email:</label>
            <input type="email" class="form-control" name="email" id="email"required>
            <div class="divFormaEnvio">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Envío a domicilio
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Envío a sucursal de Correo Argentino
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                    <label class="form-check-label" for="flexRadioDefault3">
                        Retiro por el local (Si nada más estas comprando giftcards también hacé click en este)
                    </label>
                </div>
            </div>
            <div id="inputsContainer"></div>
            <div class="divPagar">
                <p class="peligroInactive" id="aviso">Llená todos los datos!</p>
                <p class="peligroInactive" id="carritoVacio">Tu carrito está vacío!</p>
            </div>
        </form>
        <div class="mpButton" id="wallet_container"></div>
        <a href="https://api.whatsapp.com/send/?phone=5492215137609&text&type=phone_number&app_absent=0"><img class="wsp" src="../img/logoWhatsapp.png" alt=""></a>
    </main>
</div>

<footer class="footer">
    <p class="yo">Design by <a href="">Juan Bautista Aramberri</a></p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>