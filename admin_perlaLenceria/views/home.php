<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Perla Lencería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c8d9eaff72.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="../img/logo.png">
</head>
<body>
    <?php
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: ../default.php');
        exit();
    }
    ?>
    <div class="wrapper">
        <header class="headerAdmin">
            <img src="../img/logo.png" alt="logo" class="logoPerla">
        </header>
        <main class="mainAdmin">
            <ul>
                <li class="opciones"><a href="home.php" class="btn btn-mi-color-select">Agregar producto</a></li>
                <li class="opciones"><a href="variaciones.php" class="btn btn-mi-color">Agregar variaciones</a></li>
                <li class="opciones"><a href="lista.php" class="btn btn-mi-color">Lista de productos</a></li>
            </ul>
            <ul>
                <li class="opciones"><a href="listaVentas.php" class="btn btn-mi-color">Lista de ventas</a></li>
                <li class="opciones"><a href="giftcard.php" class="btn btn-mi-color">Códigos giftcards</a></li>
                <li class="opciones"><a href="descuento.php" class="btn btn-mi-color">Códigos descuentos</a></li>
            </ul>
            <form action="../php/addProduct.php" method="post" enctype="multipart/form-data" class="agregarProducto">
                <div class="divFormularios">
                    <section class="sectionVariaciones">
                        <label for="formFile" class="form-label">Imagen principal:</label>
                        <input class="form-control inputVariaciones" type="file" name="imageFiles" id="formFile" accept=".jpg, .png, .jpeg" required>
                    </section>
                    <section class="sectionVariaciones">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control inputVariaciones" required>
                    </section> 
                    <section class="sectionVariaciones">
                        <label for="categoria" class="form-label">Categoria:</label>
                        <select name="categoria" id="categoria" class="form-select inputVariaciones">
                            <option value="Conjuntos">Conjuntos</option>
                            <option value="Corpiños">Corpiños</option>
                            <option value="Pijamas">Pijamas</option>
                            <option value="Bodys">Bodys</option>
                            <option value="Pantuflas">Pantuflas</option>
                            <option value="Hombre">Hombre</option>
                            <option value="Batas">Batas</option>
                            <option value="Kids">Kids</option>
                            <option value="Packs">Packs</option>
                        </select>
                    </section>
                    <section class="sectionText">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" class="form-control inputTextarea"></textarea>
                    </section>
                    <section>
                        <label for="precio" class="form-label">Precio (sin $):</label>
                        <input type="text" name="precio" id="precio" class="form-control" required>
                    </section>
                    
                </div>
                <input type="submit" name="" id="" class="btn btn-mi-color">
            </form>
    </div>
    
    <footer class="footer">
        <p class="yo">Design by <a href="">Juan Bautista Aramberri</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>