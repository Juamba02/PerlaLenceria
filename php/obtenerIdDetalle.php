<?php
include('connection.php');

$id = $_POST['id'];
$color = $_POST['color'];
$talle = $_POST['talle'];
$id_detalle = 0;

$sql = "SELECT * FROM detalles_productos WHERE id_producto = '$id'";
$res = mysqli_query($connection, $sql);

if ($res) {
    if (mysqli_num_rows($res) > 0) {
      while ($row = mysqli_fetch_assoc($res)) {
        if ($row['color'] == $color && $row['talle'] == $talle) {
          $id_detalle = $row['id'];
        }
      }
    }
  }

  echo $id_detalle;
?>