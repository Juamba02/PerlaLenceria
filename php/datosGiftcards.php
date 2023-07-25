<?php
    include('connection.php');
    $id = $_POST['id'];
    $sql = "SELECT * FROM productos WHERE id = '$id'";
    $res = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($res);
    $precio = $row['precio'];
    $imagen = $row['imagen'];

    $respuesta = array(
        'imagen' => $imagen,
        'precio' => $precio
      );
      
      header('Content-Type: application/json');
      
      echo json_encode($respuesta);
?>