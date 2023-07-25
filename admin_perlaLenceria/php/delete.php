<?php
include('connection.php');
session_start();

        if(!isset($_SESSION['user'])){
            header('Location: ../default.php');
            exit();
        }

if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM detalles_productos WHERE id = '$id'";
    $res = mysqli_query($connection, $sql);
}
header('Location: ../views/lista.php');
?>