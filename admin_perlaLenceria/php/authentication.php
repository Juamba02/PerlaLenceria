<?php
    include('connection.php');

    $userIngresado = $_POST['user'];
    $passIngresado = $_POST['pass'];

    $sql = "SELECT * FROM usuario WHERE user = '$userIngresado' AND pass = '$passIngresado'";
    $res = mysqli_query($connection, $sql);

    if(mysqli_num_rows($res) == 1){
        session_start();
        $_SESSION['user'] = $userIngresado;
        header('Location: ../views/home.php');
        exit(); 
    }else{
        header('Location: ../default.php');
        exit();
    }
?>