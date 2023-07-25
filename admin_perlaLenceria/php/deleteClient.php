<?php
include('connection.php');
session_start();

        if(!isset($_SESSION['user'])){
            header('Location: ../default.php');
            exit();
        }
$id = $_GET['deleteid'];
if(isset($_GET['deleteid'])) {
    $sql = "DELETE FROM datos_clientes WHERE id = '$id'";
    $res = mysqli_query($connection, $sql);
}
header('Location: ../views/listaVentas.php');