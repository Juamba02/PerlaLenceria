document.addEventListener("DOMContentLoaded", function() {
  // Obtén el elemento contenedor donde se mostrará la lista del carrito
  const listaCarrito = document.querySelector("#listaCarrito");
  let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
  if (carrito == null || carrito.length == 0 || !carrito) {
    const divMainCarrito = document.querySelector("#divMainCarrito");
    divMainCarrito.classList.remove('divMainCarrito')
    divMainCarrito.classList.add('peligroInactive')
  }
  const divPrice = document.querySelector("#divPrice");
  let totalPrice = 0;
  carrito.sort(function(a, b) {
    return parseInt(a.id_detalle) - parseInt(b.id_detalle);
  });

  const eliminarProducto = (id_detalle) => {
    // Eliminar el producto del array carrito
    // Filtrar el carrito y eliminar el producto con el id_detalle especificado
    carrito = carrito.filter(producto => producto.id_detalle !== id_detalle);

    // Guardar el carrito actualizado en el localStorage
    localStorage.setItem("carrito", JSON.stringify(carrito));
  }

  const eliminarGiftcard = (id) => {
    // Eliminar el producto del array carrito
    // Filtrar el carrito y eliminar el producto con el id_detalle especificado
    carrito = carrito.filter(producto => producto.id_producto !== id);

    // Guardar el carrito actualizado en el localStorage
    localStorage.setItem("carrito", JSON.stringify(carrito));
  }

  const subirTotal = (precio) => {
    totalPrice += precio;
    price.innerText = "Total: $" + totalPrice;
  }

  const bajarTotal = (precio) => {
    totalPrice -= precio;
    price.innerText = "Total: $" + totalPrice;
  }

  const eliminarTotal = (cantidad, precio) => {
    const precioProducto = cantidad * precio;
    totalPrice -= precioProducto;
    price.innerText = "Total: $" + totalPrice;
  }

  const actualizarPrecio = (precio, cantidad) => {
    totalPrice += (precio*cantidad)
    price.innerText = "Total: $" + totalPrice; 
  }
  
    // Itera sobre los productos del carrito
  carrito.forEach((producto) => {
    // Realiza una consulta AJAX para obtener la imagen y el stock del producto
    if(producto.color != undefined) {
      $.ajax({
        type: "POST",
        url: "../php/datosCarrito.php",
        data: {id:producto.id_producto, color: producto.color, talle: producto.talle},
        dataType: "json",
        success: function(respuesta) {
          const imagen = respuesta.imagen;
          const stock = respuesta.stock;
          const nombre = respuesta.nombre;
          const precio = respuesta.precio;
          actualizarPrecio(parseInt(precio), producto.cantidad);
    
          // Diseña el elemento <li> con los datos obtenidos
          const li = document.createElement("li");
          li.classList.add("productoCarrito");
    
          // Agrega la imagen del producto
          const imagenElemento = document.createElement("img");
          imagenElemento.src = "../imgProductos/" + imagen;
          imagenElemento.style.width = "60px";
          imagenElemento.style.height = "auto";
          li.appendChild(imagenElemento);
    
          // Agrega el nombre del producto
          const nombreElemento = document.createElement("span");
          nombreElemento.textContent = nombre;
          li.appendChild(nombreElemento);
    
          // Agrega el color del producto
          const colorProducto = document.createElement("span");
          colorProducto.textContent = producto.color;
          li.appendChild(colorProducto);
    
          // Agrega el talle del producto
          const talleProducto = document.createElement("span");
          talleProducto.textContent = producto.talle;
          li.appendChild(talleProducto);
    
          const divCantidad = document.createElement("div");
          divCantidad.classList.add("divCantidad");
    
          const botonDecremento = document.createElement("button");
          botonDecremento.textContent = "-";
          botonDecremento.addEventListener("click", function() {
          if (cantidadSeleccionada > 1) {
            cantidadSeleccionada--;
            producto.cantidad = cantidadSeleccionada
            localStorage.setItem("carrito", JSON.stringify(carrito))
            cantidadElemento.textContent = cantidadSeleccionada;
            precioProducto.innerText = "$" + cantidadSeleccionada*precio;
            bajarTotal(parseInt(precio));
          }
          });
          botonDecremento.classList.add("btn-mi-color-cantidad-izquierda");
          divCantidad.appendChild(botonDecremento);
    
          // Agrega los botones para incrementar y decrementar la cantidad
          const cantidadElemento = document.createElement("span");
          cantidadElemento.textContent = producto.cantidad;
          cantidadElemento.classList.add("cantidad");
          divCantidad.appendChild(cantidadElemento);
    
          let cantidadSeleccionada = producto.cantidad; // Cantidad inicial obtenida del local storage
          const cantidadMaxima = stock; // Límite máximo basado en el stock
    
          // Botón de incremento
          const botonIncremento = document.createElement("button");
          botonIncremento.textContent = "+";
          botonIncremento.addEventListener("click", function() {
            if (cantidadSeleccionada < cantidadMaxima) {
            cantidadSeleccionada++;
            producto.cantidad = cantidadSeleccionada
            localStorage.setItem("carrito", JSON.stringify(carrito))
            cantidadElemento.textContent = cantidadSeleccionada;
            precioProducto.innerText = "$" + cantidadSeleccionada*precio;
            subirTotal(parseInt(precio));
            }
          });
          botonIncremento.classList.add("btn-mi-color-cantidad-derecha");
          divCantidad.appendChild(botonIncremento);
    
          li.appendChild(divCantidad);
    
          const precioProducto = document.createElement("span");
          precioProducto.innerText = "$" + cantidadSeleccionada*precio;
          li.appendChild(precioProducto);
    
          const botonEliminar = document.createElement("button");
          const tacho = document.createElement("i");
          tacho.classList.add("fa-solid");
          tacho.classList.add("fa-trash");
          tacho.style.color = "#ffffff";
          botonEliminar.append(tacho);
          botonEliminar.classList.add("btn");
          botonEliminar.classList.add("btn-mi-danger");
          
          botonEliminar.addEventListener("click", function() {
            // Obtener el elemento padre (<li>) del botón de eliminar
            const li = botonEliminar.parentNode;
            // Eliminar el producto del carrito y del sessionStorage
            eliminarProducto(producto.id_detalle);
            eliminarTotal(parseInt(cantidadSeleccionada), parseInt(precio))
            // Eliminar el elemento <li> del DOM
            listaCarrito.removeChild(li);
          });
          
          li.appendChild(botonEliminar);
    
          
          
    
          // Agrega el elemento <li> al contenedor de la lista del carrito
          listaCarrito.appendChild(li);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        console.log("Error en la solicitud AJAX: " + textStatus + ", " + errorThrown);
        }
        });
    }else{
      $.ajax({
        type: "POST",
        url: "../php/datosGiftcards.php",
        data: {id:producto.id_producto},
        dataType: "json",
        success: function(respuesta){
          
          const imagen = respuesta.imagen;
          const nombre = "Giftcard";
          const precio = respuesta.precio;
          actualizarPrecio(parseInt(precio), producto.cantidad);

          // Diseña el elemento <li> con los datos obtenidos
          const li = document.createElement("li");
          li.classList.add("productoCarrito");
    
          // Agrega la imagen del producto
          const imagenElemento = document.createElement("img");
          imagenElemento.src = "../img/" + imagen;
          imagenElemento.style.width = "60px";
          imagenElemento.style.height = "auto";
          li.appendChild(imagenElemento);
    
          // Agrega el nombre del producto
          const nombreElemento = document.createElement("span");
          nombreElemento.textContent = nombre;
          li.appendChild(nombreElemento);

          const colorProducto = document.createElement("span");
          colorProducto.innerText = "-"
          colorProducto.style.width = "31px";
          li.appendChild(colorProducto);
    
          // Agrega el talle del producto
          const talleProducto = document.createElement("span");
          talleProducto.innerText = "-";
          talleProducto.style.width = "9px";
          li.appendChild(talleProducto);

          const divCantidad = document.createElement("div");
          divCantidad.classList.add("divCantidad");
    
          const botonDecremento = document.createElement("button");
          botonDecremento.textContent = "-";
          botonDecremento.addEventListener("click", function() {
          if (cantidadSeleccionada > 1) {
            cantidadSeleccionada--;
            producto.cantidad = cantidadSeleccionada
            localStorage.setItem("carrito", JSON.stringify(carrito))
            cantidadElemento.textContent = cantidadSeleccionada;
            precioProducto.innerText = "$" + cantidadSeleccionada*precio;
            bajarTotal(parseInt(precio));
          }
          });
          botonDecremento.classList.add("btn-mi-color-cantidad-izquierda");
          divCantidad.appendChild(botonDecremento);
    
          // Agrega los botones para incrementar y decrementar la cantidad
          const cantidadElemento = document.createElement("span");
          cantidadElemento.textContent = producto.cantidad;
          cantidadElemento.classList.add("cantidad");
          divCantidad.appendChild(cantidadElemento);
    
          let cantidadSeleccionada = producto.cantidad; // Cantidad inicial obtenida del local storage
    
          // Botón de incremento
          const botonIncremento = document.createElement("button");
          botonIncremento.textContent = "+";
          botonIncremento.addEventListener("click", function() {
            cantidadSeleccionada++;
            producto.cantidad = cantidadSeleccionada
            localStorage.setItem("carrito", JSON.stringify(carrito))
            cantidadElemento.textContent = cantidadSeleccionada;
            precioProducto.innerText = "$" + cantidadSeleccionada*precio;
            subirTotal(parseInt(precio));
          });
          botonIncremento.classList.add("btn-mi-color-cantidad-derecha");
          divCantidad.appendChild(botonIncremento);
    
          li.appendChild(divCantidad);
    
          const precioProducto = document.createElement("span");
          precioProducto.innerText = "$" + cantidadSeleccionada*precio;
          li.appendChild(precioProducto);
    
          const botonEliminar = document.createElement("button");
          const tacho = document.createElement("i");
          tacho.classList.add("fa-solid");
          tacho.classList.add("fa-trash");
          tacho.style.color = "#ffffff";
          botonEliminar.append(tacho);
          botonEliminar.classList.add("btn");
          botonEliminar.classList.add("btn-mi-danger");
          
          botonEliminar.addEventListener("click", function() {
            // Obtener el elemento padre (<li>) del botón de eliminar
            const li = botonEliminar.parentNode;
            // Eliminar el producto del carrito y del sessionStorage
            eliminarGiftcard(producto.id_producto);
            eliminarTotal(parseInt(cantidadSeleccionada), parseInt(precio))
            // Eliminar el elemento <li> del DOM
            listaCarrito.removeChild(li);
          });
          
          li.appendChild(botonEliminar);
    
          
          
    
          // Agrega el elemento <li> al contenedor de la lista del carrito
          listaCarrito.appendChild(li);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        console.log("Error en la solicitud AJAX: " + textStatus + ", " + errorThrown);
        }
      })
    }
    
    });

    const price = document.createElement("h4");
    price.innerText = "Total: $" + totalPrice;
    divPrice.appendChild(price);

    const canjear = document.querySelector("#canjear");
  const descuento = document.querySelector("#descuento");
  const codigoInvalid = document.querySelector("#codigoInvalid");

  canjear.addEventListener('click', (event) => {
    event.preventDefault();
    const longitud = carrito.length
    if (descuento != 0){
      $.ajax({
        type: "POST",
        url: "../php/checkCode.php",
        data: {code:descuento.value, totalPrice: totalPrice, productos: longitud},
        dataType: "json",
        success: function(respuesta){
          if(respuesta.type == "giftcard") {
            const newPrice = totalPrice - respuesta.descuento;
            if(newPrice > 3) {
              price.innerText = "Total: $" + newPrice;
              codigoInvalid.classList.remove("peligroActive");
              codigoInvalid.classList.add("peligroInactive");
            }
          }else if (respuesta.type == "descuento"){
            const decimal = respuesta.descuento/100;
            const percentage = totalPrice * decimal;
            const newPrice = totalPrice - percentage;
            if(newPrice > 3) {
              price.innerText = "Total: $" + newPrice;
              codigoInvalid.classList.remove("peligroActive");
              codigoInvalid.classList.add("peligroInactive");
            }
            
          }else{
            codigoInvalid.classList.add("peligroActive");
            codigoInvalid.classList.remove("peligroInactive");
          }
        }
      })
    }else{
      codigoInvalid.classList.add("peligroActive");
      codigoInvalid.classList.remove("peligroInactive");
    }
  })

  const avanzar = document.querySelector('#finalizar');
  avanzar.addEventListener('click', () => {
    const jsonData = JSON.stringify(carrito);
    window.location.href = "pago?data=" + encodeURIComponent(jsonData);
  })
  })