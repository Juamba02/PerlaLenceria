<?php
    include('connection.php');
    session_start();

    $codigo = $_POST['code'];
    $precio = $_POST['totalPrice'];
    $productos = $_POST['productos'];
    $descuento = 0;
    $type = '';

    $sql = "SELECT * FROM giftcards WHERE codigo = '$codigo'";
    $res = mysqli_query($connection, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        // El código existe, puedes utilizar $descuento aquí
        $row = mysqli_fetch_assoc($res);
        $descuento = $row['descuento'];
        $type = $row['tipo'];
        if($row['estado'] == 'true') {
            if($type == 'descuento'){
                $porcentaje = $precio * ($descuento/100);
                $verdaderoDescuento = $porcentaje/$productos;
                if(($precio - $verdaderoDescuento) > 3) {
                    $_SESSION['descuento'] = $verdaderoDescuento;
                    $_SESSION['code'] = $codigo;
                    $_SESSION['tipo'] = $type;
                }
                else{
                    $descuento = 0;
                }
            }else{
                $verdaderoDescuento = $descuento/$productos;
                if(($precio - $verdaderoDescuento) > 3) {
                    $_SESSION['descuento'] = $verdaderoDescuento;
                    $_SESSION['code'] = $codigo;
                    $_SESSION['tipo'] = $type;
                }else{
                    $descuento = 0;
                }
            }
        }else{
            $descuento = 0;
        }
        
    } else {
        // El código no existe
        $descuento = 0;
    }

    $respuesta = array(
        'descuento' => $descuento,
        'type' => $type
    );

    header('Content-Type: application/json');

    echo json_encode($respuesta);
?>