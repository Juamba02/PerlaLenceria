<?php
include('connection.php');
$id = $_POST['id'];
$talle = $_POST['talle'];
$color = $_POST['color'];

$sql = "SELECT * FROM detalles_productos WHERE id_producto = '$id'";
$res = mysqli_query($connection, $sql);

$stock = 0;

if ($res) {
  if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
      if ($row['color'] == $color && $row['talle'] == $talle) {
        $stock = $row['stock'];
        break;
      }
    }
  }
}

$sql2 = "SELECT imagen FROM productos WHERE id = '$id'";
$res2 = mysqli_query($connection, $sql2);

$imagen = '';
if ($res2 && mysqli_num_rows($res2) > 0) {
  $row2 = mysqli_fetch_assoc($res2);
  $imagen = $row2['imagen'];
}

$sql3 = "SELECT nombre FROM productos WHERE id = '$id'";
$res3 = mysqli_query($connection, $sql3);

$nombre = '';
if ($res3 && mysqli_num_rows($res3) > 0) {
  $row3 = mysqli_fetch_assoc($res3);
  $nombre = $row3['nombre'];
}

$sql4 = "SELECT precio FROM productos WHERE id ='$id'";
$res4 = mysqli_query($connection, $sql4);

$precio = 0;
if($res4 && mysqli_num_rows($res4) > 0) {
  $row4 = mysqli_fetch_assoc($res4);
  $precio = $row4['precio'];
}

$respuesta = array(
  'nombre' => $nombre,
  'imagen' => $imagen,
  'stock' => $stock,
  'precio' => $precio
);

header('Content-Type: application/json');

echo json_encode($respuesta);
?>
