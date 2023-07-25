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
    <script src="../js/buscador.js" defer></script>
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
                <li class="opciones"><a href="variaciones.php" class="btn btn-mi-color">Agregar variaciones</a></li>
                <li class="opciones"><a href="lista.php" class="btn btn-mi-color">Lista de productos</a></li>
            </ul>
            <ul>
                <li class="opciones"><a href="listaVentas.php" class="btn btn-mi-color-select">Lista de ventas</a></li>
                <li class="opciones"><a href="giftcard.php" class="btn btn-mi-color">Códigos giftcards</a></li>
                <li class="opciones"><a href="descuento.php" class="btn btn-mi-color">Códigos descuentos</a></li>
            </ul>
            <div class="divBuscador">
                <input type="text" id="searchInput" class="form-control buscador" placeholder="Buscar por número de pedido o nombre del cliente">
            </div>
            <div class="bg-white shadow mb-2 mt-2 tablaWidth">
                <section class="w-100 p-4 table-responsive d-flex justify-content-center">
                    <table class="table align-middle mb-0 bg-white">
                        <thead class="mi-tabla">
                            <tr class='fila-principal-principal'>
                                <th>Nro de pedido</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Tipo</th>
                                <th>Cliente</th>
                                <th>DNI</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include('../php/connection.php');

                                $query = "SELECT *, DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha_formateada
                                FROM datos_clientes
                                ORDER BY estado DESC, fecha ASC";
                                $res = mysqli_query($connection, $query);
                    
                                while ($fila = mysqli_fetch_assoc($res)) {
                                    $id = $fila['id'];

                                    if(isset($fila['nombre'])){
                                        echo "<tr class='fila-principal'>";
                                        echo "<td>" . $fila['id_compra'] . "</td>";
                                        if($fila['estado'] == "Pendiente"){
                                            echo "<td><a href='../php/confirmarPedido.php?id=" . $id . "'><span class='" . $fila['estado'] . "'>" . $fila['estado'] . "</span></a></td>";
                                        }else{
                                            echo "<td><a href='../php/datosPedido.php?id=" . $id . "'><span class='" . $fila['estado'] . "'>" . $fila['estado'] . "</span></a></td>";
                                        }
                                        echo "<td>" . $fila['fecha_formateada'] . "</td>";
                                        echo "<td>" . $fila['tipo'] . "</td>";
                                        echo "<td>" . $fila['nombre'] . " ". $fila['apellido'] ."</td>";
                                        echo "<td>" . $fila['dni'] . "</td>";
                                        echo "<td>" . $fila['telefono'] . "</td>";
                                        echo "<td>" . $fila['email'] . "</td>";
                                        echo "<td><a class='btn btn-mi-danger eliminar' href='../php/deleteClient.php?deleteid=" . $id . "'>Eliminar</a></td>";
                                        echo "</tr>";
                                    }
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