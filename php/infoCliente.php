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
    $provincia = $info['provincia'];
    $ciudad = $info['ciudad'];
    $codigo = $info['codigo'];
    $calle = $info['calle'];
    $numero = $info['numero'];

    $_SESSION['cliente'] = array();

    if(isset($info['piso']) && isset($info['depto'])) {
        $piso = $info['piso'];
        $depto = $info['depto'];

        $cliente = array(
            'tipo' => $tipo,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'dni' => $dni,
            'telefono' => $telefono,
            'email' => $email,
            'provincia' => $provincia,
            'ciudad' => $ciudad,
            'codigo' => $codigo,
            'calle' => $calle,
            'numero' => $numero,
            'piso' => $piso,
            'depto' => $depto
        );
    }else{
        $cliente = array(
            'tipo' => $tipo,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'dni' => $dni,
            'telefono' => $telefono,
            'email' => $email,
            'provincia' => $provincia,
            'ciudad' => $ciudad,
            'codigo' => $codigo,
            'calle' => $calle,
            'numero' => $numero
        );
    }

    $_SESSION['cliente'] = $cliente;

    header('Content-Type: application/json');

    echo json_encode($_SESSION['cliente']);
?>