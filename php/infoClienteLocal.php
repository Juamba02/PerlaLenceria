<?php
    include('connection.php');
    session_start();

    $info = $_POST['info'];
    $tipo = $_POST['tipo'];
    
    $nombre = $info['nombre'];
    $apellido = $info['apellido'];
    $dni = $info['dni'];
    $telefono = $info['telefono'];
    $email = $info['email'];

    $cliente = array(
        'tipo' => $tipo,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'dni' => $dni,
        'telefono' => $telefono,
        'email' => $email
    );

    $_SESSION['cliente'] = $cliente;

    header('Content-Type: application/json');

    echo json_encode($_SESSION['cliente']);
?>