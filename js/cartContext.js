var carrito = [];

var getCarrito = () => {
    return carrito
}

var renderNumCarrito = (numCarrito) => {
    numCarrito.innerText = carrito.length.toString();
}

var addProduct = (product, numCarrito) => {
    carrito.push(product);
    renderNumCarrito(numCarrito)
}

var eliminarProducto = (index, numCarrito) => {
    // Eliminar el producto del array carrito
    carrito.splice(index, 1);
    renderNumCarrito(numCarrito)
}