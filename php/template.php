<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detalles de las Giftcards</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            min-height: 100vh;
        }

        .page{
            width: 700px;
        }
    </style>
</head>
<body>
    <div class="page">
        <h1>Gracias por tu compra!</h1>
        <h3>Tu pago fue recibido, si compraste algún producto, te va a llegar un email con los datos cuando salga el envío o este listo para retirar por el local.</h3>
        <h4>Si compraste giftcards, los codigos con sus respectivos valores estan en este mail.</h4>
        <ul>
            <!-- Aquí se insertarán los detalles de cada giftcard -->
            <?php echo $giftcardDetails; ?>
        </ul>
    </div>
    <p>Perla Lencería</p>
</body>
</html>
