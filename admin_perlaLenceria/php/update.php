<?php
    include('connection.php');
    
    $id=$_GET['updateid'];
    $sqlDatos = "SELECT * FROM detalles_productos WHERE id='$id'";
    $resDatos = mysqli_query($connection, $sqlDatos);
    $row = mysqli_fetch_assoc($resDatos);
    $colorActual = $row['color'];
    $talleActual = $row['talle'];
    $stockActual = $row['stock'];
    if(isset($_POST['submit'])){
        $color = $_POST['color'];
        $talle = $_POST['talle'];
        $stock = $_POST['stock'];

        $sql = "UPDATE detalles_productos SET color='$color', talle='$talle', stock='$stock' WHERE id='$id'";
        $res = mysqli_query($connection, $sql);
        if($res){
            header('Location: ../views/lista.php');
        }else{
            die(mysqli_error($connection));
        }
    }
?>
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
            <form method="post" class="agregarProducto">
                <div class="divFormularios">
                    <section class="sectionVariaciones">
                        <label for="color" class="form-label">Color:</label>
                        <input type="text" name="color" id="color" class="form-control inputVariaciones" style="max-width: 468px;" value=<?php echo $colorActual; ?> required>
                    </section>
                    <section class="sectionVariaciones">
                        <label for="talle" class="form-label">Talle:</label>
                        <input type="text" name="talle" id="talle" class="form-control inputVariaciones" value=<?php echo $talleActual; ?> required>
                    </section>
                    <section>
                        <label for="stock" class="form-label">Stock:</label>
                        <input type="text" name="stock" id="stock" class="form-control inputVariaciones" value=<?php echo $stockActual; ?> required>
                    </section>
                </div>
                <input type="submit" name="submit" id="" class="btn btn-mi-color" value="Actualizar">
                <a href="../views/lista.php">Cancelar</a>
            </form>
        </main>
    </div>
    <footer class="footer">
        <p class="yo">Design by <a href="">Juan Bautista Aramberri</a></p>
    </footer>  
</body>