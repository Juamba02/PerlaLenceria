<?php
    include('../php/connection.php');

    $id = $_GET['id'];

    $id = mysqli_real_escape_string($connection, $id);

    $sql = "SELECT * FROM productos WHERE id='$id'";
    $res = mysqli_query($connection, $sql);

    $producto = mysqli_fetch_assoc($res);
    $precio = intval($producto['precio']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giftcard - Perla Lencería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c8d9eaff72.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script defer type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script defer src="../js/addGiftcardToCart.js"></script>
</head>
<body>
<div class="wrapper">
        <header class="header">
            <p class="centradorIzquierda">.</p>
            <a href="https://perlalenceria.com" class="logoPerla">
              <img src="../img/logo.png" alt="logo" class="logo">
            </a>
            <div class="divCart">
              <a href="carrito" class="linkCarrito">
                <i class="fa-solid fa-cart-shopping fa-2xl" style="color: #969798;"></i>
              </a>
                <div class="divCartNumber">
                    <p class="cartNumber" id="cartNumber">0</p>
                </div>
            </div>
        </header>
        <main class="mainProduct" onsubmit="return false;">
            <div class="divFlecha">
                <a href="https://perlalenceria.com/views/giftcards">
                    <i class="fa-solid fa-chevron-left fa-2xl" style="color: grey;" ></i>
                    <span class="botonAtras">Atrás</span>
                </a>
            </div>
            <div class="contenedorProduct">
                <div class="carousel">
                    <img src="../img/Giftcards.webp" alt="" class="imgGiftcard">
                </div>
                <div class="nombre">
                    <h3 class="titulo"><?php echo $producto['nombre']; ?></h3>
                    <p class="precioProducto">$<?php echo $precio; ?></p>
                    <input type="submit" class="btn btn-mi-color" id="addToCart" value="Agregar al carrito" >
                    <p class="aviso">La cantidad se selecciona en el carrito</p>
                </div>
            </div>
            <div class="informacion">
                        <?php
                            echo $producto['descripcion'];
                        ?>
                    </div>
                    <a href="https://api.whatsapp.com/send/?phone=5492215137609&text&type=phone_number&app_absent=0"><img class="wsp" src="../img/logoWhatsapp.png" alt=""></a>
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>