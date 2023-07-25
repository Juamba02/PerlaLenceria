<?php
    include('connection.php');
    
    $id=$_GET['updateid'];
    $sqlDatos = "SELECT * FROM productos WHERE id='$id'";
    $resDatos = mysqli_query($connection, $sqlDatos);
    $row = mysqli_fetch_assoc($resDatos);
    $nombreActual = $row['nombre'];
    $descActual = $row['descripcion'];
    $categoriaActual = $row['categoria'];
    $precioActual = $row['precio'];
    if(isset($_POST['submit'])){
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $desc = $_POST['descripcion'];
        $precio = $_POST['precio'];

        $sql = "UPDATE productos SET nombre='$nombre', categoria='$categoria', descripcion='$desc', precio='$precio' WHERE id='$id'";
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
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control inputVariaciones" style="max-width: 468px;" value=<?php echo $nombreActual; ?> required>
                    </section>
                    <section class="sectionVariaciones">
                        <label for="categoria" class="form-label">Categoria:</label>
                        <select name="categoria" id="categoria" class="form-select inputVariaciones">
                            <option value=<?php echo $categoriaActual; ?>><?php echo $categoriaActual; ?></option>
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
                        <textarea name="descripcion" id="descripcion" class="form-control inputTextarea"><?php echo $descActual; ?></textarea>
                    </section>
                    <section>
                        <label for="precio" class="form-label">Precio (sin $):</label>
                        <input type="text" name="precio" id="precio" class="form-control" value=<?php echo $precioActual; ?> required>
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
</html>