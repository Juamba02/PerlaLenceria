<?php
    session_start();
    unset($_SESSION['carrito']);
    unset($_SESSION['cliente']);
    if(isset($_SESSION['giftcards'])) {
        unset($_SESSION['giftcards']);
    }
    if(isset($_SESSION['code'])) {
        unset($_SESSION['descuento']);
        unset($_SESSION['code']);
        unset($_SESSION['tipo']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - Perla Lencería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c8d9eaff72.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="../img/logo.png">
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <p class="centradorIzquierda">.</p>
            <a href="https://perlalenceria.com/" class="logoPerla">
                <img src="../img/logo.png" alt="logo" class="logo">
            </a>
            <p class="centradorDerecha">.</p>
        </header>
        <main class="mainCarrito">
            <h2>Ups! Parece que hubo un error en tu pago!</h2>
            <p>Revisá tus datos y volvé a intentarlo</p>
            <a href="https://perlalenceria.com" class="btn btn-mi-color">Volver al inicio</a>
        <a href="https://api.whatsapp.com/send/?phone=5492215137609&text&type=phone_number&app_absent=0"><img class="wsp" src="img/logoWhatsapp.png" alt=""></a>
        </main>
    </div>

    <footer class="footer">
        <p class="yo">Design by <a href="">Juan Bautista Aramberri</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>