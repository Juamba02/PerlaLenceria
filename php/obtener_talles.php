<?php
include('connection.php');

if (isset($_POST['color']) && isset($_POST['id'])) {
  $color = $_POST['color'];
  $id = $_POST['id'];

  // Consultar los talles disponibles para el color y el producto seleccionados
  $sql = "SELECT * FROM detalles_productos WHERE id_producto = '" . mysqli_real_escape_string($connection, $id) . "'";

  $result = mysqli_query($connection, $sql);

  if ($result) {
    $talles = array();

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        if ($row['color'] == $color) {
          if($row['stock'] > 0) {
            $talles[] = strtoupper($row["talle"]);
          }
        }
      }
    }

    // Preparar la respuesta en formato JSON
    $response = array(
      'talles' => $talles
    );

    // Establecer la cabecera Content-Type como application/json
    header('Content-Type: application/json');

    // Imprimir la respuesta como cadena JSON
    echo json_encode($response);
  } else {
    // Manejo de error en caso de falla en la consulta
    $error = mysqli_error($connection);
    echo "Error de consulta: " . $error;
  }
}
?>



