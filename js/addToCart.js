const botonAgregar = document.querySelector("#addToCart");
const numCarrito = document.querySelector("#cartNumber");
let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
numCarrito.innerText = carrito.length.toString();


    document.getElementById("addToCart").addEventListener("click", (event) => {
        event.preventDefault(); // Prevenir el envío del formulario por defecto
    
        // Obtener el color seleccionado
        const colorRadios = document.getElementsByName("color");
        let colorSeleccionado = null;
    
        for (var i = 0; i < colorRadios.length; i++) {
          if (colorRadios[i].checked) {
            colorSeleccionado = colorRadios[i].value;
            break;
          }
        }
    
        // Obtener el talle seleccionado
        const talleRadios = document.getElementsByName("talle");
        let talleSeleccionado = null;
    
        for (var i = 0; i < talleRadios.length; i++) {
          if (talleRadios[i].checked) {
            talleSeleccionado = talleRadios[i].value;
            break;
          }
        }

        if(!colorSeleccionado || !talleSeleccionado) {
            const mensajeError = document.querySelector("#advertencia");
            mensajeError.classList.remove("peligroInactive");
            mensajeError.classList.add("peligroActive");
        }else{
            const url = new URL(window.location.href);

            // Obtener el valor del parámetro 'dato' de la URL
            const dato = url.searchParams.get("id");
            let id_detalle = 0;

            $.ajax({
              type: "POST",
              url: "../php/obtenerIdDetalle.php",
              data: { id: dato, color: colorSeleccionado, talle: talleSeleccionado },
              success: function(response) {
                id_detalle = response;
                const producto = {
                  id_detalle: id_detalle,
                  id_producto: dato,
                  color: colorSeleccionado,
                  talle: talleSeleccionado,
                  cantidad: 1
                }

                const objetoExistente = carrito.find(function(item) {
                  return item.id === producto.id && item.color === producto.color && item.talle === producto.talle;
                });
  
                if(objetoExistente) {
                  Toastify({
                      text: "Ese producto ya esta en tu carrito!",
                      duration: 1000,
                      style: {
                          background: "#b61105"
                      },
                      offset: {
                          x: 20,
                          y: 130
                      }
                  }).showToast();
                }else{
                      carrito.push(producto);
                      const carritoJSON = JSON.stringify(carrito);
                      localStorage.setItem("carrito", carritoJSON); 
                      numCarrito.innerText = carrito.length.toString();
                      Toastify({
                          text: "Producto agregado!",
                          duration: 1000,
                          style: {
                              background: "#319535"
                          },
                          offset: {
                              x: 20,
                              y: 130
                          }
                      }).showToast();
                      const mensajeError = document.querySelector("#advertencia");
                      if(mensajeError.classList.value == "peligroActive") {
                          mensajeError.classList.remove("peligroActive");
                          mensajeError.classList.add("peligroInactive");
                      }
                }
              }
            })
            
            

            
        }
    })
    