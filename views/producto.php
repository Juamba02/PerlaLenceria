<?php
    include('../php/connection.php');

    $id = $_GET['id'];

    $id = mysqli_real_escape_string($connection, $id);

    $sql = "SELECT * FROM productos WHERE id='$id'";
    $res = mysqli_query($connection, $sql);

    $producto = mysqli_fetch_assoc($res);
    
    $sqlColores = "SELECT DISTINCT color FROM detalles_productos WHERE id_producto='$id'";
    $resultColores = mysqli_query($connection, $sqlColores);

    $colores = array();

    if (mysqli_num_rows($resultColores) > 0) {
        while ($row = mysqli_fetch_assoc($resultColores)) {
            $colores[] = $row["color"];
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $producto['nombre']; ?> - Perla Lencería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c8d9eaff72.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="../img/logo.png">
    <script src="https://cdn.rawgit.com/download/memorystorage/0.11.0/dist/memorystorage.min.js"></script>
    <script src="../js/tallesButtons.js"></script>
    <script src="../js/carouselImages.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script defer type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script defer src="../js/addToCart.js"></script>
    <script>
        const mostrarTalles = () => {
  var colores = <?php echo json_encode($colores); ?>;
  var tallesDiv = document.getElementById("talles");
  var colorRadios = document.getElementsByName("color");

  for (var i = 0; i < colorRadios.length; i++) {
    if (colorRadios[i].checked) {
      var color = colorRadios[i].value;
      break;
    }
  }

  if (color) {
    // Obtener los talles disponibles para el color seleccionado mediante AJAX
    $.ajax({
      type: "POST",
      url: "../php/obtener_talles.php",
      data: { color: color, id: <?php echo $id; ?> },
      success: function(response) {
        if (response.talles.length > 0) {
          tallesDiv.innerHTML = "";

          for (var i = 0; i < response.talles.length; i++) {
            var radio = document.createElement("input");
            radio.type = "radio";
            radio.name = "talle";
            radio.value = response.talles[i];
            radio.classList.add("radio-talle");
            radio.id = "talle_" + i; // Asignar un ID único al input

            var label = document.createElement("label");
            label.classList.add("radio-button");
            label.htmlFor = "talle_" + i; // Asociar el label al input
            label.appendChild(document.createTextNode(response.talles[i]));

            tallesDiv.appendChild(radio);
            tallesDiv.appendChild(label);
            tallesDiv.appendChild(document.createElement("br"));
          }
        } else {
          tallesDiv.innerHTML = "No hay talles disponibles para el color seleccionado.";
        }
      },
      error: function() {
        tallesDiv.innerHTML = "Error al obtener los talles.";
      }
    });
  } else {
    tallesDiv.innerHTML = "";
  }
}
  </script>
</head>
<body>
    <div class="wrapper">
        <header class="header">
          <p class="centradorIzquierda">.</p>
            <a href="https://perlalenceria.com" class="logoPerla">
              <img src="../img/logo.png" alt="logo" class="logo">
            </a>
            <div class="divCart">
              <a href="carrito" class="linkCarrito">
                <i class="fa-solid fa-cart-shopping fa-2xl" style="color: #969798;"></i>
              </a>
                <div class="divCartNumber">
                    <p class="cartNumber" id="cartNumber">0</p>
                </div>
            </div>
        </header>
        <main class="mainProduct" onsubmit="return false;">
          <div class="divFlecha">
                <a href="https://perlalenceria.com/views/categorias?categoria=<?php echo $producto['categoria']; ?>">
                    <i class="fa-solid fa-chevron-left fa-2xl" style="color: grey;" ></i>
                    <span class="botonAtras">Atrás</span>
                </a>
            </div>
            <div class="contenedorProduct">
                <div class="carousel">
                    <i class="fa-solid fa-chevron-left fa-2xl botonIzquierda carousel__button" id="prevButton" style="color: #000000;"></i>
                    <div class="carousel__images">
                    <?php include('../php/obtenerImagenes.php'); ?>
                    </div>
                    <i class="fa-solid fa-chevron-right fa-2xl carousel__button" id="nextButton" style="color: #000000;"></i>
                </div>
                <div class="nombre">
                    <h3 class="titulo" id="titulo"><?php echo $producto['nombre']; ?></h3>
                    <p class="precioProducto">$<?php echo $producto['precio']; ?></p>
                    <div class="divColores">
                        <h4>Color:</h4>
                        <form class="talles">
                            <div class="divBotones">
                                <?php
                                // Mostrar los colores como radios
                                foreach ($colores as $color) {
                                    echo '<input type="radio" id="'.$color.'" class="input-color" onClick="mostrarTalles()" name="color" value="' . $color . '">';
                                    echo '<label for="'.$color.'" class="label-color">' . $color . '</label>';
                                    echo '<br>';
                                  }
                                ?>
                            </div>
                        
                            <h4>Talle:</h4>
                            <div class="divTalles" id="talles">
                                <p>Seleccione un color</p>
                            <!-- Aquí se mostrarán los talles disponibles para el color seleccionado -->
                            </div>
                            <div>
                              <input type="submit" class="btn btn-mi-color" id="addToCart" value="Agregar al carrito" >
                              <p class="aviso">La cantidad se selecciona en el carrito</p>
                            </div>
                            <p class="peligroInactive" id="advertencia">Seleccioná un color y un talle!</p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="informacion">
                        <?php
                          if($producto['descripcion']){
                            echo $producto['descripcion'];
                          }
                        ?>
                    </div>
                    <a href="https://api.whatsapp.com/send/?phone=5492215137609&text&type=phone_number&app_absent=0"><img class="wsp" src="../img/logoWhatsapp.png" alt=""></a>
        </main>
    </div>
    <footer class="footer">
        <p class="yo">Design by <a href="">Juan Bautista Aramberri</a></p>
    </footer>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>