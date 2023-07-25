<?php
include('connection.php');

if (isset($_GET['id'])) {
    $idProducto = $_GET['id'];

    $sql = "SELECT imagen FROM imagenes WHERE id_producto = '$idProducto'";
    $res = mysqli_query($connection, $sql);

    $sql2 = "SELECT imagen FROM productos WHERE id = '$idProducto'";
    $res2 = mysqli_query($connection, $sql2);

    $product = mysqli_fetch_assoc($res2);
    $imgProduct = $product['imagen'];


    echo "<img src='../imgProductos/$imgProduct' alt='Imagen' class='carousel__image'>";

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $imagen = $row['imagen'];
            echo "<img src='../imgProductos/$imagen' alt='Imagen' class='carousel__image'>";
        }
    } else {
        echo "No se encontraron imágenes para el producto";
    }
} else {
    echo "Producto no válido";
}
?>
