<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giftcards - Perla Lencería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c8d9eaff72.js" crossorigin="anonymous"></script>
    <script defer src="../js/main.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="../img/logo.png">
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
        <main>
            <div class="divFlecha">
                <a href="https://perlalenceria.com">
                    <i class="fa-solid fa-chevron-left fa-2xl" style="color: grey;" ></i>
                    <span class="botonAtras">Atrás</span>
                </a>
            </div>
        <h2 class="titulo">Giftcards</h2>
            <div class="containerTarjetas">
            <?php
                    include('../php/connection.php');
                    $sql = "SELECT * FROM productos WHERE categoria = 'Giftcards'";
                    $resultado = mysqli_query($connection, $sql);

                    if(mysqli_num_rows($resultado) > 0) {
                        while($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<a href='productoGiftcards?id=" . $fila['id'] . "'>";
                            echo "<div class='tarjetas'>";
                            echo "<div class='imgTarjetas'>";
                            echo "<img src=../imgProductos/" . $fila['imagen'] . " class='fotoTarjetas'>";
                            echo "</div>";
                            echo "<div class='textoTarjetas'>";
                            echo "<h3 class='nombreTarjetas'>" . $fila['nombre'] . "</h3>";
                            echo "<div class='parteInferior'>";
                            echo "<p class='precioTarjetas'>$" . intval($fila['precio']) . "</p>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</a>";
                        }
                    }
                ?>
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