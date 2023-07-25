const botonAgregar = document.querySelector("#addToCart");
const numCarrito = document.querySelector("#cartNumber");
const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
if (carrito.length > 0) {
  numCarrito.innerText = carrito.length.toString();
}

botonAgregar.addEventListener("click", (event) => {
  event.preventDefault();

  const url = new URL(window.location.href);

  // Obtener el valor del parámetro 'dato' de la URL
  const dato = url.searchParams.get("id");

  const producto = {
    id_producto: dato,
    cantidad: 1,
  };

  const objetoExistente = carrito.find(function (item) {
    return item.id_producto === producto.id_producto;
  });

  if (objetoExistente) {
    Toastify({
      text: "Ese producto ya esta en tu carrito!",
      duration: 1000,
      style: {
        background: "#b61105",
      },
      offset: {
        x: 20,
        y: 130,
      },
    }).showToast();
  } else {
    carrito.push(producto);
    const carritoJSON = JSON.stringify(carrito);
    localStorage.setItem("carrito", carritoJSON);
    numCarrito.innerText = carrito.length.toString();
    Toastify({
      text: "Producto agregado!",
      duration: 1000,
      style: {
        background: "#319535",
      },
      offset: {
        x: 20,
        y: 130,
      },
    }).showToast();
  }
});
