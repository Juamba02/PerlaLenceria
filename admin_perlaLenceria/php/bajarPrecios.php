<?php
include('connection.php');
session_start();

if(!isset($_SESSION['user'])){
    header('Location: ../default.php');
    exit();
}

$porcentaje = intval($_POST['porcentaje']);

$factor = 1 - ($porcentaje/100);

// Consulta para actualizar los precios
$sql = "UPDATE productos SET precio = ROUND(precio * $factor, 2)";
$res = mysqli_query($connection, $sql);

if($res){

    header("Location: ../views/lista.php");
}else{
    echo "Error al actualizar los precios: " . mysqli_error($connection);
}

?>