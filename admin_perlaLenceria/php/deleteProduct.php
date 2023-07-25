<?php
include('connection.php');
session_start();

        if(!isset($_SESSION['user'])){
            header('Location: ../default.php');
            exit();
        }

if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $sqlDel = "SELECT imagen FROM imagenes WHERE id_producto = '$id'";
    $resDel = mysqli_query($connection, $sqlDel);

    while ($row = mysqli_fetch_assoc($resDel)) {
        $imagenPath = $row['imagen'];

        // Elimina el archivo de imagen si existe
        if (file_exists($imagenPath)) {
            unlink($imagenPath);
        }
    }

    $sql1 = "DELETE FROM detalles_productos WHERE id_producto = '$id'";
    $res1 = mysqli_query($connection, $sql1);

    $sql2 = "DELETE FROM imagenes WHERE id_producto = '$id'";
    $res1 = mysqli_query($connection, $sql2);

    $sql = "DELETE FROM productos WHERE id = '$id'";
    $res = mysqli_query($connection, $sql);
}
header('Location: ../views/lista.php');
?>