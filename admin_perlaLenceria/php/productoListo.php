<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../default.php');
        exit();
    }
    include("connection.php");

    $id = $_POST['id'];
    $seguimiento = $_POST['seguimiento'];
    $envio = $_POST['envio'];
    if ($envio == "Retira por el local" && $seguimiento == "Retira por el local") {
        $sql = "UPDATE datos_clientes SET estado = 'Listo' WHERE id = '$id'";
        $res = mysqli_query($connection, $sql);
    }else{
        $sql = "UPDATE datos_clientes SET estado = 'Listo', seguimiento = '$seguimiento', envio = $envio WHERE id = '$id'";
        $res = mysqli_query($connection, $sql);
    }

    header('Content-Type: application/json');

    echo json_encode("Mail enviado");
?>