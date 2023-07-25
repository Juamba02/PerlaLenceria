<?php
    include('connection.php');
    session_start();

    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito'] = array();
    }

    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];

    $producto = array(
        'id' => $id,
        'cantidad' => $cantidad
    );
    
    // Guardar el producto en $_SESSION['carrito']
    $_SESSION['carrito'][] = $producto;

    header('Content-Type: application/json');
    echo json_encode($_SESSION['carrito']);
?>