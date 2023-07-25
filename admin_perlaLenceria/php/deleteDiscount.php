<?php
include('connection.php');
session_start();

        if(!isset($_SESSION['user'])){
            header('Location: ../default.php');
            exit();
        }
$id = $_GET['deleteid'];
$tipo = $_GET['tipo'];
if(isset($_GET['deleteid'])) {
    $sql = "DELETE FROM giftcards WHERE id = '$id'";
    $res = mysqli_query($connection, $sql);
}
header('Location: ../views/'. $tipo .'.php');