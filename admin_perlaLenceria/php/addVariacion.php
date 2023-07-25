<?php
    include('connection.php');
    $targetDirectory = '../../imgProductos/';

    $uploadedFiles = $_FILES['imageFiles'];
    $producto = $_POST['producto'];
    $colorProducto = $_POST['color'];
    $talleProducto = $_POST['talle'];
    $stockProducto = $_POST['stock'];

    $sql1 = "SELECT id FROM productos WHERE nombre = '$producto'";
    $result1 = mysqli_query($connection, $sql1);

    if ($row = mysqli_fetch_assoc($result1)) {
        $id = $row['id'];

        $verificacion = "SELECT * FROM detalles_productos WHERE id_producto = '$id' AND color = '$colorProducto' AND talle = '$talleProducto'";
        $resVerificacion = mysqli_query($connection, $verificacion);

        if (mysqli_num_rows($resVerificacion) == 0) {
            $sql = "INSERT INTO detalles_productos (id_producto, color, talle, stock) VALUES ('$id', '$colorProducto', '$talleProducto', '$stockProducto')";
            $res = mysqli_query($connection, $sql);
            for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
                $nombreImagen = basename($uploadedFiles['name'][$i]);
                $targetFile = $targetDirectory . basename($uploadedFiles['name'][$i]);
                move_uploaded_file($uploadedFiles['tmp_name'][$i], $targetFile);

                $sqlImagen = "INSERT INTO imagenes (id_producto, imagen) VALUES ('$id', '$nombreImagen')";
                $resImagen = mysqli_query($connection, $sqlImagen);
            }

            
        }
    }

    header('Location: ../views/variaciones.php');
?>