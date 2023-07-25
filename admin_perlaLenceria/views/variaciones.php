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
                <li class="opciones"><a href="home.php" class="btn btn-mi-color">Agregar producto</a></li>
                <li class="opciones"><a href="variaciones.php" class="btn btn-mi-color-select">Agregar variaciones</a></li>
                <li class="opciones"><a href="lista.php" class="btn btn-mi-color">Lista de productos</a></li>
            </ul>
            <ul>
                <li class="opciones"><a href="listaVentas.php" class="btn btn-mi-color">Lista de ventas</a></li>
                <li class="opciones"><a href="giftcard.php" class="btn btn-mi-color">Códigos giftcards</a></li>
                <li class="opciones"><a href="descuento.php" class="btn btn-mi-color">Códigos descuentos</a></li>
            </ul>
            <form action="../php/addVariacion.php" method="post" class="agregarProducto" enctype="multipart/form-data">
                <div class="divFormularios">
                    <section class="rarito sectionVariaciones">
                        <label for="producto" class="form-label">Producto:</label>
                        <select name="producto" id="producto" class="form-select inputVariaciones" required>
                            <?php
                            include('../php/connection.php');
                            
                                $sql = "SELECT * FROM productos";
                                $res = mysqli_query($connection, $sql);
                                while($row = mysqli_fetch_assoc($res)) {
                                    if($row['categoria'] != "Giftcards"){
                                        $valor = $row['nombre'];
                                        echo "<option value='$valor'>$valor</option>";
                                    }
                                    
                                }
                            ?>
                        </select>
                    </section>
                    <section class="sectionVariaciones">
                        <label for="formFile" class="form-label">Imagenes:</label>
                        <input class="form-control inputVariaciones" type="file" name="imageFiles[]" id="formFile" accept=".jpg, .png, .jpeg" multiple>
                    </section>
                    <section class="sectionVariaciones">
                        <label for="color" class="form-label">Color:</label>
                        <input type="text" name="color" id="color" class="form-control inputVariaciones" required>
                    </section>
                    <section class="sections">
                        <label for="talle" class="form-label">Talle:</label>
                        <input type="text" name="talle" id="talle" class="form-control inputVariaciones" required>
                    </section>
                    <section class="sections">
                        <label for="stock" class="form-label">Stock:</label>
                        <input type="text" name="stock" id="stock" class="form-control inputVariaciones" required>
                    </section>
                </div>
                <input type="submit" name="" id="" class="btn btn-mi-color enviar">
            </form>
    </div>
    <footer class="footer">
        <p class="yo">Design by <a href="">Juan Bautista Aramberri</a></p>
    </footer>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>