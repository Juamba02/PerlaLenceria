<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Perla Lencería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="shortcut icon" href="./img/logo.png">
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <img src="./img/logo.png" alt="logo" class="logoPerla">
        </header>
        <main class="mainLogin">
            <div class="inicioSesion">
                <form action="./php/authentication.php" method="post">
                    <section>
                    <label for="user" class="form-label">Usuario:</label>
                    <input type="text" name="user" id="user" class="form-control">
                    </section>
                    <section>
                    <label for="pass" class="form-label">Contraseña:</label>
                    <input type="password" name="pass" id="pass" class="form-control">
                    </section>
                    <input type="submit" value="Iniciar sesión" class="boton">
                </form>
            </div>
        </main>
    </div>
    
    <footer class="footer">
        <p class="yo">Design by <a href="">Juan Bautista Aramberri</a></p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>