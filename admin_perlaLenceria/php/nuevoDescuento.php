<?php
    include('connection.php');
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: ../default.php');
        exit();
    }

    $tipo = $_GET['tipo'];
    $codigo = $_POST['codigo_generado'];
    $valor = $_POST['porcentaje'];

    $sql = "INSERT INTO giftcards (codigo, tipo, descuento, estado) VALUES ('$codigo', '$tipo', $valor, 'true')";
    $res = mysqli_query($connection, $sql);

    header("Location: ../views/". $tipo .".php");
?>