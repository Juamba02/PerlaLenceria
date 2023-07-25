<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Perla Lencería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c8d9eaff72.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="../img/logo.png">
</head>
<body>
    <?php
        session_start();

        if(!isset($_SESSION['user'])){
            header('Location: ../default.php');
            exit();
        }
    ?>
    <div class="modal fade" id="subirPrecios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="../php/subirPrecios.php" method="post">
                    <div class="sectionPorcentaje">
                        <label for="porcentaje">Porcentaje:</label>
                        <input type="text" name="porcentaje" class="form-control inputVariaciones" id="porcentaje">
                    </div>
                    <input type="submit" class="btn btn-mi-color" data-bs-dismiss="modal" data-bs-target="#subirPrecios" value="Actualizar">
                </form>
                <button type="button" class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bajarPrecios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="../php/bajarPrecios.php" method="post">
                    <div class="sectionPorcentaje">
                        <label for="porcentaje">Porcentaje:</label>
                        <input type="text" name="porcentaje" class="form-control inputVariaciones" id="porcentaje">
                    </div>
                    <input type="submit" class="btn btn-mi-color" data-bs-dismiss="modal" data-bs-target="#bajarPrecios" value="Actualizar">
                </form>
                <button type="button" class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <header class="headerAdmin">
            <img src="../img/logo.png" alt="logo" class="logoPerla">
        </header>
        <main class="mainAdmin">
            
        <ul>
                <li class="opciones"><a href="home.php" class="btn btn-mi-color">Agregar producto</a></li>
                <li class="opciones"><a href="variaciones.php" class="btn btn-mi-color">Agregar variaciones</a></li>
                <li class="opciones"><a href="lista.php" class="btn btn-mi-color-select">Lista de productos</a></li>
            </ul>
            <ul>
                <li class="opciones"><a href="listaVentas.php" class="btn btn-mi-color">Lista de ventas</a></li>
                <li class="opciones"><a href="giftcard.php" class="btn btn-mi-color">Códigos giftcards</a></li>
                <li class="opciones"><a href="descuento.php" class="btn btn-mi-color">Códigos descuentos</a></li>
            </ul>
            <div class="botonesPorcentaje">
                <button class="btn btn-mi-color-desplegar" data-bs-toggle="modal" data-bs-target="#subirPrecios">Subir precios</button>
                <button class="btn btn-mi-color-desplegar" data-bs-toggle="modal" data-bs-target="#bajarPrecios">Bajar precios</button>
            </div>
            <div class="bg-white shadow rounded-5 w-75 mb-2 mt-2">
                <section class="w-100 p-4 table-responsive d-flex justify-content-center">
                    <table class="table align-middle mb-0 bg-white">
                        <thead class="mi-tabla">
                            <tr class='fila-principal'>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
            include('../php/connection.php');

            $query = "SELECT * FROM productos";
            $res = mysqli_query($connection, $query);

            while ($fila = mysqli_fetch_assoc($res)) {
                $id = $fila['id'];
                $sql = "SELECT * FROM detalles_productos WHERE id_producto = '$id' ORDER BY color ASC";
                $res2 = mysqli_query($connection, $sql);

                echo "<tr class='fila-principal'>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['categoria'] . "</td>";
                echo "<td>$" . $fila['precio'] . "</td>";
                echo "<td><div class='filasSubtabla'>";
                echo "<button class='btn btn-mi-color-desplegar btn-desplegar'>Desplegar</button>";
                echo "<a class='btn btn-mi-edit editar' href='../php/updateProduct.php?updateid=" . $id . "'>Editar</a>";
                echo "<a class='btn btn-mi-danger eliminar' href='../php/deleteProduct.php?deleteid=" . $id . "'>Eliminar</a>";
                echo "</div></td>";
                echo "</tr>";

                if (mysqli_num_rows($res2) > 0){
                    echo "<tr style='width: 100%; display: none;' class='subtabla'>";
                    echo "<td colspan='3'>";
                    echo "<table class='table align-middle mb-0 bg-white'>";
                    echo "<thead class='bg-grey'>";
                    echo "<tr class='fila-principal'>";
                    echo "<th>Color</td>";
                    echo "<th>Talle</td>";
                    echo "<th>Stock</td>";
                    echo "<th>Acción</td>";
                    echo "</tr>";
                    echo "</thead>";
            
                    while ($fila2 = mysqli_fetch_assoc($res2)) {
                        $id = $fila2['id'];
                        
                        echo "<tr class='fila-principal'>";
                        echo "<td>" . $fila2['color'] . "</td>";
                        echo "<td>" . $fila2['talle'] . "</td>";
                        echo "<td>" . $fila2['stock'] . "</td>";
                        echo "<td><div class='filasSubtabla'>";
                        echo "<a class='btn btn-mi-edit editar' href='../php/update.php?updateid=" . $id . "'>Editar</a>";
                        echo "<a class='btn btn-mi-danger eliminar' href='../php/delete.php?deleteid=" . $id . "'>Eliminar</a>";
                        echo "</div></td>";
                        echo "</tr>";
                    }
                    
                    echo "</table>";
                    echo "</td>";
                    echo "</tr>";
                }
                

                if (mysqli_num_rows($res2) === 0) {
                    echo "<tr class='subtabla' style='display: none;'>";
                    echo "<td colspan='3'>No hay detalles disponibles</td>";
                    echo "</tr>";
                }
            }

            mysqli_free_result($res);
            ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </main>
    </div>
    <footer class="footer">
        <p class="yo">Design by <a href="">Juan Bautista Aramberri</a></p>
    </footer>  
    
    <script>
  document.addEventListener('DOMContentLoaded', function() {
    const botonesDesplegar = document.querySelectorAll('.btn-desplegar');

    botonesDesplegar.forEach(function(boton) {
      boton.addEventListener('click', function() {
        const filaPrincipal = this.closest('.fila-principal');
        const subtabla = filaPrincipal.nextElementSibling;

        if (subtabla.classList.contains('subtabla')) {
          if (subtabla.style.display === 'none') {
            subtabla.style.display = 'table-row';
          } else {
            subtabla.style.display = 'none';
          }
        }
      });
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>