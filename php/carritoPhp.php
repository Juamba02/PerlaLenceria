<?php
    include('connection.php');
    session_start();

    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito'] = array();
    }

    $id = $_POST['id'];
    $color = $_POST['color'];
    $talle = $_POST['talle'];
    $cantidad = intval($_POST['cantidad']);

    $sql = "SELECT * from detalles_productos WHERE id_producto ='$id'";
    $res = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        if($row['color'] == $color) {
            if($row['talle'] == $talle) {
                $id_detalle = $row['id'];
                $stockViejo = $row['stock'];
                $stockNuevo = $stockViejo - $cantidad;
                $sql2 = "UPDATE detalles_productos SET stock = $stockNuevo WHERE id = '$id_detalle'";
                $res2 = mysqli_query($connection, $sql2);
            }
        }
    }

    $producto = array(
        'id' => $id,
        'color' => $color,
        'talle' => $talle,
        'cantidad' => $cantidad
    );
    
    // Guardar el producto en $_SESSION['carrito']
    $_SESSION['carrito'][] = $producto;

    header('Content-Type: application/json');

    echo json_encode($_SESSION['carrito']);
?>