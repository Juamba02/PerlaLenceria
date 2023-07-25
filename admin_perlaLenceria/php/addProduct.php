<?php
include('connection.php');

$targetDirectory = '../../imgProductos/';

$uploadedFiles = $_FILES['imageFiles'];
$nombreProducto = $_POST['nombre'];
$categoriaProducto = $_POST['categoria'];
$descripcionProducto = $_POST['descripcion'];
$precioProducto = $_POST['precio'];

$verificacion = "SELECT * FROM productos WHERE nombre = '$nombreProducto'";
$resVerificacion = mysqli_query($connection, $verificacion);

if(mysqli_num_rows($resVerificacion) == 0){
    $nombreImagen = basename($uploadedFiles['name']);
    $targetFile = $targetDirectory . basename($uploadedFiles['name']);
    move_uploaded_file($uploadedFiles['tmp_name'], $targetFile);
    $sql = "INSERT INTO productos (nombre, categoria, descripcion, precio, imagen) VALUES ('$nombreProducto', '$categoriaProducto', '$descripcionProducto', '$precioProducto', '$nombreImagen')";
    $res = mysqli_query($connection, $sql);
}

header('Location: ../views/home.php');
?>