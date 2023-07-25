<?php
include('../views/pago.php');

$respuesta = $preference->id;

header('Content-Type: application/json');
      
echo json_encode($respuesta);