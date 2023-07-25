<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HTML email template</title>
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

        <p>
            Podés hacer el seguimiento de tu envío con este codigo: "<?php echo $seguimiento; ?>" en esta pagina https://www.correoargentino.com.ar/seguimiento-de-envios, recordá que el coste de envío debés pagarlo al retirarlo! ($<?php echo $envio; ?>) 
        </p>

        <p>Perla Lencería</p>
    </div>
</body>
</html>