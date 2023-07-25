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
    <script defer src="../js/carrito.js"></script>
    <link rel="shortcut icon" href="../img/logo.png">
    <title>Carrito - Perla Lencería</title>
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
            <a href="https://perlalenceria.com">
                <i class="fa-solid fa-chevron-left fa-2xl" style="color: grey;" ></i>
                <span class="botonAtras">Atrás</span>
            </a>
        </div>
      <h2 class="tituloCarrito">Carrito</h2>
      <div class="divMainCarrito" id="divMainCarrito">
        <div class="listaCarrito" id="listaCarrito">

        </div>
        <form class="codigo">
            <label for="descuento" class="form-label labelDescuento">Si tenés un código de descuento o giftcard, podés canjearlo acá:</label>
            <input type="text" class="form-control" id="descuento">
            <p class="peligroInactive" id="codigoInvalid">Código no válido!</p>
            <input type="submit" value="Canjear" class="btn canjear" id="canjear">
        </form>
        <div id="divPrice" class="divPrice">
        
        </div>
        <p class="aviso labelDescuento">El costo del envío se te enviará por mail junto al código de seguimiento y se paga al momento de retirarlo.</p>
        <button class="btn btn-mi-color continuar" id="finalizar">Continuar con el pago</button>
      </div>
      <a href="https://api.whatsapp.com/send/?phone=5492215137609&text&type=phone_number&app_absent=0"><img class="wsp" src="../img/logoWhatsapp.png" alt=""></a>
    </main>
</div>
<footer class="footer">
    <p class="yo">Design by <a href="">Juan Bautista Aramberri</a></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>