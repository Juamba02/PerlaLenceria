const numCarrito = document.querySelector("#cartNumber");
const carrito = JSON.parse(localStorage.getItem("carrito")) || [];

const renderNumCarrito = () => {
    numCarrito.innerText = carrito.length.toString();
}

renderNumCarrito(numCarrito);