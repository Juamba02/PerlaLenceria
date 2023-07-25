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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION['user'])){
            header('Location: ../default.php');
            exit();
        }
        include('connection.php');
        $id = $_GET['id'];
        $sql = "SELECT *, DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha_formateada FROM datos_clientes WHERE id ='$id'";
        $res = mysqli_query($connection, $sql);
        if($res){
            if($row = mysqli_fetch_assoc($res)) {
                $id_pedido = $row['id_compra'];
                $fecha = $row['fecha_formateada'];
                $tipo = $row['tipo'];
                $nombre = $row['nombre'];
                $apellido = $row['apellido'];
                $dni = $row['dni'];
                $telefono = $row['telefono'];
                $email = $row['email'];
                $productos = json_decode($row['productos']);
                $seguimiento = $row['seguimiento'];
                $envio = $row['envio'];
                if($row['provincia']){
                    $provincia = $row['provincia'];
                    $ciudad = $row['ciudad'];
                    $codigo = $row['codigo'];
                    $calle = $row['calle'];
                    $numero = $row['numero'];
                    if($row['piso']) {
                        $piso = $row['piso'];
                        $depto = $row['depto'];
                    }
                }
            }
        }
    ?>
    <div class="wrapper">
        <header class="headerAdmin">
            <img src="../img/logo.png" alt="logo" class="logoPerla">
        </header>
        <main class="mainInfo">
            <div class="divFlecha">
                <a href="https://admin.perlalenceria.com/views/listaVentas.php">
                    <i class="fa-solid fa-chevron-left fa-2xl" style="color: grey;" ></i>
                    <span class="botonAtras">Atrás</span>
                </a>
            </div>
            <h3>Número de pedido: <?php echo $id_pedido; ?></h3>
            <p>Tipo de envío: <?php if($tipo == "Sucursal"){
                    echo "Retiro en sucursal de Correo Argentino";
                    }elseif($tipo == "Domicilio"){
                        echo "Envío a domicilio";
                    }else{
                        echo "Retiro en el local";
                    }
                    ?></p>
            <div class="divInfo">
                <div>
                    <h5>Información del pedido:</h5>
                    <ul class="ulInfo">
                        <li>Fecha del pedido: <?php echo $fecha; ?></li>
                        <li>Nombre y apellido: <?php echo "". $nombre ." ". $apellido ."" ?></li>
                        <li>DNI: <?php echo $dni; ?></li>
                        <li>Teléfono: <?php echo $telefono; ?></li>
                        <li>Email: <span id="email"><?php echo $email; ?></span></li>
                        <?php
                            if(isset($provincia)) {
                                echo "<li>Provincia: ". $provincia ."";
                                echo "<li>Ciudad: ". $ciudad ."";
                                echo "<li>Código postal: ". $codigo ."";
                                echo "<li>Calle: ". $calle ."";
                                echo "<li>Número: ". $numero ."";
                                if(isset($piso)){
                                    echo "<li>Piso: ". $piso ."";
                                    echo "<li>Departamento: ". $depto ."";
                                }
                                echo "<li>Código de seguimiento:". $seguimiento ."</li>";
                                echo "<li>Costo de envío:". $envio ."</li>";
                            }
                        ?>
                        
                        
                    </ul>
                </div>
                <div>
                    <h5>Productos:</h5>
                    <table class="table align-middle mb-0 bg-white">
                        <thead class="mi-tabla">
                            <tr class='fila-principal'>
                                <th>Nombre</th>
                                <th>Color</th>
                                <th>Talle</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                                foreach($productos as $producto) {
                                    $sqlPro = "SELECT * FROM productos WHERE id = '$producto->id'";
                                    $resPro = mysqli_query($connection, $sqlPro);
                                    if($fila = mysqli_fetch_assoc($resPro)){
                                        if($fila['categoria'] == "Giftcards"){
                                            echo "<tr class='fila-principal'>
                                            <td>". $fila['nombre'] ."</td>
                                            <td> --- </td>
                                            <td> --- </td>
                                            <td>". $producto->cantidad ."</td>
                                            </tr>";
                                        }else{
                                            echo "<tr class='fila-principal'>
                                            <td>". $fila['nombre'] ."</td>
                                            <td>". $producto->color ."</td>
                                            <td>". $producto->talle ."</td>
                                            <td>". $producto->cantidad ."</td>
                                            </tr>";
                                        }
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                
            </div>
        </main>
    </div>
    <footer class="footer">
        <p class="yo">Design by <a href="">Juan Bautista Aramberri</a></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>