<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Perla Lencería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c8d9eaff72.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="../img/logo.png">
    <script src="../js/generarGiftcard.js" defer></script>
</head>
<body>
<?php
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: ../default.php');
        exit();
    }
    ?>
    <div class="modal fade" id="nuevoDescuento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content-mio">
                <form action="../php/nuevoDescuento.php?tipo=giftcard" method="post">
                    <div class="sectionPorcentaje">
                        <label for="codigo">Código:</label>
                        <input type="text" name="codigo" class="form-control inputVariaciones" id="codigo" disabled>
                        <input type="hidden" name="codigo_generado" id="codigo_generado">
                        <button id="generar" class="btn btn-primary">Generar</button>
                        <label for="porcentaje">Valor (sin signo):</label>
                        <input type="text" name="porcentaje" class="form-control inputVariaciones" id="porcentaje">
                    </div>
                    <input type="submit" class="btn btn-mi-color" data-bs-dismiss="modal" data-bs-target="#nuevoDescuento" value="Crear">
                </form>
                <button type="button" class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <header class="headerAdmin">
            <img src="../img/logo.png" alt="logo" class="logoPerla">
        </header>
        <main class="mainAdmin">
            <ul>
                <li class="opciones"><a href="home.php" class="btn btn-mi-color">Agregar producto</a></li>
                <li class="opciones"><a href="variaciones.php" class="btn btn-mi-color">Agregar variaciones</a></li>
                <li class="opciones"><a href="lista.php" class="btn btn-mi-color">Lista de productos</a></li>
            </ul>
            <ul>
                <li class="opciones"><a href="listaVentas.php" class="btn btn-mi-color">Lista de ventas</a></li>
                <li class="opciones"><a href="giftcard.php" class="btn btn-mi-color-select">Códigos giftcards</a></li>
                <li class="opciones"><a href="descuento.php" class="btn btn-mi-color">Códigos descuentos</a></li>
            </ul>
            <div class="botonesPorcentaje">
                <button class="btn btn-mi-color-desplegar" data-bs-toggle="modal" data-bs-target="#nuevoDescuento">Nuevo código</button>
            </div>
            <div class="bg-white shadow mb-2 mt-2 tablaWidth">
                <section class="w-100 p-4 table-responsive d-flex justify-content-center">
                    <table class="table align-middle mb-0 bg-white">
                        <thead class="mi-tabla">
                            <tr class='fila-principal-principal'>
                                <th>Código</th>
                                <th>Valor</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include('../php/connection.php');

                                $query = "SELECT * FROM giftcards WHERE tipo = 'giftcard' ORDER BY id DESC";
                                $res = mysqli_query($connection, $query);
                    
                                while ($fila = mysqli_fetch_assoc($res)) {
                                    $id = $fila['id'];
                                    echo "<tr class='fila-principal'>";
                                    echo "<td>" . $fila['codigo'] . "</td>";
                                    echo "<td>$" . intval($fila['descuento']) . "</td>";
                                    echo "<td><a class='btn btn-mi-danger eliminar' href='../php/deleteDiscount.php?deleteid=" . $id . "&tipo=giftcard'>Eliminar</a></td>";
                                    echo "</tr>";
                                    
                                }
                    
                                mysqli_free_result($res);
                            ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </main>
    </div>
    

    <footer class="footer">
        <p class="yo">Design by <a href="">Juan Bautista Aramberri</a></p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>