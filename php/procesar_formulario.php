<?php
// Obtener los valores de color y talle enviados por AJAX
include('connection.php');
if (isset($_POST['color']) && isset($_POST['talle'])) {
  $color = $_POST['color'];
  $talle = $_POST['talle'];
  print_r($color);

  // Obtener el id_producto de la URL o de otra fuente de datos
  $id_producto = $_GET['id_producto'];

  // Consultar el stock disponible para el color, talle y id_producto especificados
  // Asegúrate de ajustar esta consulta SQL según la estructura de tu base de datos
  $sql = "SELECT stock FROM detalles_productos WHERE id_producto = $id_producto AND color = '$color' AND talle = '$talle'";
  
  // Ejecutar la consulta SQL
  // Aquí asumo que estás utilizando una conexión a la base de datos establecida previamente
  $result = mysqli_query($connection, $sql);

  if ($result) {
    // Obtener el valor del stock
    $row = mysqli_fetch_assoc($result);
    $stock = $row['stock'];

    // Devolver el stock como respuesta
    echo $stock;
  } else {
    // Manejar el caso de error en la consulta
    echo "Error al obtener el stock";
  }
} else {
  // Manejar el caso de datos faltantes
  echo "Datos incompletos";
}
?>
