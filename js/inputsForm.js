// Obtener referencias a los elementos del formulario
const radioDomicilio = document.querySelector("#flexRadioDefault1");
const radioSucursal = document.querySelector("#flexRadioDefault2");
const radioLocal = document.querySelector("#flexRadioDefault3");
const inputsContainer = document.querySelector("#inputsContainer");
const mpButton = document.querySelector("#wallet_container");
const aviso = document.querySelector("#aviso");
const inputName = document.querySelector("#name");
const inputApellido = document.querySelector("#lastName");
const inputTelefono = document.querySelector("#tel");
const inputEmail = document.querySelector("#email");
const inputDni = document.querySelector("#dni");
let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
const divBoton = document.querySelector("#divBoton");

const eliminarLocalStorage = () => {
  const carritoVacio = [];
  const carritoJson = JSON.stringify(carritoVacio);
        localStorage.setItem("carrito", carritoJson);
}

const requiredInputs = (
  name,
  apellido,
  dni,
  telefono,
  email,
  provincia,
  ciudad,
  codigo,
  calle,
  numero
) => {
  if (
    name.value != "" &&
    apellido.value != "" &&
    dni.value != "" &&
    telefono.value != "" &&
    email.value != "" &&
    provincia.value != "" &&
    ciudad.value != "" &&
    codigo.value != "" &&
    calle.value != "" &&
    numero.value != ""
  ) {
    return true;
  } else {
    return false;
  }
};

const requiredInputsShort = (
  name,
  apellido,
  dni,
  telefono,
  email
) => {
  if (
    name.value !== "" &&
    apellido.value !== "" &&
    dni.value != "" &&
    telefono.value !== "" &&
    email.value !== ""
  ) {
    return true;
  } else {
    return false;
  }
};

// Función para mostrar los inputs correspondientes según la selección
const mostrarInputs = () => {
  // Limpiar los inputs anteriores
  inputsContainer.innerHTML = "";

  // Verificar qué radio está seleccionado
  if (radioDomicilio.checked) {
    inputsContainer.innerHTML = `
    <label for="provincia" class="form-label"><span style="color: red">*</span> Provincia:</label>
    <select class="form-select" id="provincia">
      <option selected>Capital Federal</option>
      <option>Gran Buenos Aires</option>
      <option>Buenos Aires</option>
      <option>Catamarca</option>
      <option>Chaco</option>
      <option>Chubut</option>
      <option>Córdoba</option>
      <option>Corrientes</option>
      <option>Entre Ríos</option>
      <option>Formosa</option>
      <option>Jujuy</option>
      <option>La Pampa</option>
      <option>La Rioja</option>
      <option>Mendoza</option>
      <option>Misiones</option>
      <option>Neuquén</option>
      <option>Río Negro</option>
      <option>Salta</option>
      <option>San Juan</option>
      <option>San Luis</option>
      <option>Santa Cruz</option>
      <option>Santa Fe</option>
      <option>Santiago del Estero</option>
      <option>Tierra del Fuego</option>
      <option>Tucumán</option>
    </select>

    <label for="ciudad" class="form-label"><span style="color: red">*</span> Ciudad:</label>
    <input type="text" class="form-control" name="ciudad" id="ciudad" required>

    <label for="codigo" class="form-label"><span style="color: red">*</span> Codigo postal:</label>
    <input type="text" class="form-control" name="codigo" id="codigo" required>

    <label for="calle" class="form-label"><span style="color: red">*</span> Calle:</label>
    <input type="text" class="form-control" name="calle" id="calle" required>

    <label for="numero" class="form-label"><span style="color: red">*</span> Numero:</label>
    <input type="text" class="form-control" name="numero" id="numero" required>

    <label for="piso" class="form-label">Piso:</label>
    <input type="text" class="form-control" name="piso" id="piso" placeholder="Opcional">

    <label for="depto" class="form-label">Depto:</label>
    <input type="text" class="form-control" name="depto" id="depto" placeholder="Opcional">
    <div class="divPagar">
    <input type="submit" id="botonPagar" value="Checkout" class="btn btn-mi-color">
    </div>
    `;

    const inputProvincia = document.querySelector("#provincia");
    const inputCiudad = document.querySelector("#ciudad");
    const inputCodigo = document.querySelector("#codigo");
    const inputCalle = document.querySelector("#calle");
    const inputNumero = document.querySelector("#numero");
    const inputPiso = document.querySelector("#piso");
    const inputDepto = document.querySelector("#depto");
    const botonPagar = document.querySelector("#botonPagar");

    botonPagar.addEventListener("click", (event) => {
      event.preventDefault();
      if (carrito && carrito.length > 0) {
        let info;
      if (
        requiredInputs(
          inputName,
          inputApellido,
          inputDni,
          inputTelefono,
          inputEmail,
          inputProvincia,
          inputCiudad,
          inputCodigo,
          inputCalle,
          inputNumero
        )
      ) {
        if (inputPiso.value == "" && inputDepto.value == "") {
          info = {
            nombre: inputName.value,
            apellido: inputApellido.value,
            dni: inputDni.value,
            telefono: inputTelefono.value,
            email: inputEmail.value,
            provincia: inputProvincia.value,
            ciudad: inputCiudad.value,
            codigo: inputCodigo.value,
            calle: inputCalle.value,
            numero: inputNumero.value,
          };
          
        } else {
          info = {
            nombre: inputName.value,
            apellido: inputApellido.value,
            dni: inputDni.value,
            telefono: inputTelefono.value,
            email: inputEmail.value,
            provincia: inputProvincia.value,
            ciudad: inputCiudad.value,
            codigo: inputCodigo.value,
            calle: inputCalle.value,
            numero: inputNumero.value,
            piso: inputPiso.value,
            depto: inputDepto.value,
          };
          
        }
        const tipo = "Domicilio"
        const carritoVacio = [];
        const carritoJson = JSON.stringify(carritoVacio);
        localStorage.setItem("carrito", carritoJson);
        $.ajax({
          type: "POST",
              url: "../php/infoCliente.php",
              data: {info: info, tipo: tipo},
              dataType: "json",
              success: function(respuesta){
                carrito.forEach(producto => {
                  if(producto.color) {
                    $.ajax({
                      type: "POST",
                      url: "../php/carritoPhp.php",
                      data: {id:producto.id_producto, color: producto.color, talle: producto.talle, cantidad: producto.cantidad},
                      dataType: "json",
                      success: function(respuesta) {
                      }
                    })
                  }else{
                    $.ajax({
                      type: "POST",
                      url: "../php/giftcardPhp.php",
                      data: {id:producto.id_producto, cantidad: producto.cantidad},
                      dataType: "json",
                      success: function(respuesta) {
                      }
                    })
                  }
                  
                });
                botonPagar.classList.add("mpButton");
                mpButton.classList.remove("mpButton");
                aviso.classList.remove("peligroActive");
                aviso.classList.add("peligroInactive");
                const carritoVacio = [];
        const carritoJson = JSON.stringify(carritoVacio);
        localStorage.setItem("carrito", carritoJson);;
              }
        })
        
      } else {
        aviso.classList.add("peligroActive");
        aviso.classList.remove("peligroInactive");
      }
      }else{
        const carritoVacio = document.querySelector("#carritoVacio");
        carritoVacio.classList.remove('peligroInactive');
        carritoVacio.classList.add('peligroActive');
      }
      
      
    });
  } else if (radioSucursal.checked) {
    inputsContainer.innerHTML = `
    <label for="provincia" class="form-label"><span style="color: red">*</span> Provincia:</label>
    <select class="form-select" id="provincia">
      <option selected>Capital Federal</option>
      <option>Gran Buenos Aires</option>
      <option>Buenos Aires</option>
      <option>Catamarca</option>
      <option>Chaco</option>
      <option>Chubut</option>
      <option>Córdoba</option>
      <option>Corrientes</option>
      <option>Entre Ríos</option>
      <option>Formosa</option>
      <option>Jujuy</option>
      <option>La Pampa</option>
      <option>La Rioja</option>
      <option>Mendoza</option>
      <option>Misiones</option>
      <option>Neuquén</option>
      <option>Río Negro</option>
      <option>Salta</option>
      <option>San Juan</option>
      <option>San Luis</option>
      <option>Santa Cruz</option>
      <option>Santa Fe</option>
      <option>Santiago del Estero</option>
      <option>Tierra del Fuego</option>
      <option>Tucumán</option>
    </select>

    <label for="ciudad" class="form-label"><span style="color: red">*</span> Ciudad:</label>
    <input type="text" class="form-control" name="ciudad" id="ciudad" required>

    <label for="codigo" class="form-label"><span style="color: red">*</span> Codigo postal:</label>
    <input type="text" class="form-control" name="codigo" id="codigo" required>

    <label for="calle" class="form-label"><span style="color: red">*</span> Calle de la sucursal:</label>
    <input type="text" class="form-control" name="calle" id="calle" required>

    <label for="numero" class="form-label"><span style="color: red">*</span> Numero de la sucursal:</label>
    <input type="text" class="form-control" name="numero" id="numero" required>

    <div class="divPagar">
    <input type="submit" id="botonPagar" value="Checkout" class="btn btn-mi-color">
    </div>
    `;

    const inputProvincia = document.querySelector("#provincia");
    const inputCiudad = document.querySelector("#ciudad");
    const inputCodigo = document.querySelector("#codigo");
    const inputCalle = document.querySelector("#calle");
    const inputNumero = document.querySelector("#numero");
    const botonPagar = document.querySelector("#botonPagar");
    
    botonPagar.addEventListener("click", (event) => {
      event.preventDefault();
      if (carrito && carrito.length > 0) {
        let info;
      if (
        requiredInputs(
          inputName,
          inputApellido,
          inputDni,
          inputTelefono,
          inputEmail,
          inputProvincia,
          inputCiudad,
          inputCodigo,
          inputCalle,
          inputNumero
        )
      ) {
          info = {
            nombre: inputName.value,
            apellido: inputApellido.value,
            dni: inputDni.value,
            telefono: inputTelefono.value,
            email: inputEmail.value,
            provincia: inputProvincia.value,
            ciudad: inputCiudad.value,
            codigo: inputCodigo.value,
            calle: inputCalle.value,
            numero: inputNumero.value,
          };
          const tipo = "Sucursal"
          const carritoVacio = [];
        const carritoJson = JSON.stringify(carritoVacio);
        localStorage.setItem("carrito", carritoJson);;
        $.ajax({
          type: "POST",
              url: "../php/infoCliente.php",
              data: {info: info, tipo: tipo},
              dataType: "json",
              success: function(respuesta){
                
                carrito.forEach(producto => {
                  if(producto.color) {
                    $.ajax({
                      type: "POST",
                      url: "../php/carritoPhp.php",
                      data: {id:producto.id_producto, color: producto.color, talle: producto.talle, cantidad: producto.cantidad},
                      dataType: "json",
                      success: function(respuesta) {
                      }
                    })
                  }else{
                    $.ajax({
                      type: "POST",
                      url: "../php/giftcardPhp.php",
                      data: {id:producto.id_producto, cantidad: producto.cantidad},
                      dataType: "json",
                      success: function(respuesta) {
                      }
                    })
                  }
                  
                });
                botonPagar.classList.add("mpButton");
                mpButton.classList.remove("mpButton");
                aviso.classList.remove("peligroActive");
                aviso.classList.add("peligroInactive");
                const carritoVacio = [];
        const carritoJson = JSON.stringify(carritoVacio);
        localStorage.setItem("carrito", carritoJson);;
              }
        })
        
      } else {
        aviso.classList.add("peligroActive");
        aviso.classList.remove("peligroInactive");
      }
      }else{
        const carritoVacio = document.querySelector("#carritoVacio");
        carritoVacio.classList.remove('peligroInactive');
        carritoVacio.classList.add('peligroActive');
      }
      
      
    });

  } else if (radioLocal.checked) {
    inputsContainer.innerHTML = `<div class="divPagar">
    <input type="submit" id="botonPagar" value="Checkout" class="btn btn-mi-color">
    </div>`;

    const botonPagar = document.querySelector("#botonPagar");

    botonPagar.addEventListener("click", (event) => {
      
      event.preventDefault();
      if (carrito && carrito.length > 0) {
        let info;
      if (
        requiredInputsShort(
          inputName,
          inputApellido,
          inputDni,
          inputTelefono,
          inputEmail
        )
      ) {
        
          info = {
            nombre: inputName.value,
            apellido: inputApellido.value,
            dni: inputDni.value,
            telefono: inputTelefono.value,
            email: inputEmail.value
          };
          const tipo = "Local"
        $.ajax({
          type: "POST",
              url: "../php/infoClienteLocal.php",
              data: {info: info, tipo: tipo},
              dataType: "json",
              success: function(respuesta){
                const carritoVacio = [];
                const carritoJson = JSON.stringify(carritoVacio);
                localStorage.setItem("carrito", carritoJson);
                carrito.forEach(producto => {
                  if(producto.color) {
                    $.ajax({
                      type: "POST",
                      url: "../php/carritoPhp.php",
                      data: {id:producto.id_producto, color: producto.color, talle: producto.talle, cantidad: producto.cantidad},
                      dataType: "json",
                      success: function(respuesta) {
                      }
                    })
                  }else{
                    $.ajax({
                      type: "POST",
                      url: "../php/giftcardPhp.php",
                      data: {id:producto.id_producto, cantidad: producto.cantidad},
                      dataType: "json",
                      success: function(respuesta) {
                      }
                    })
                  }
                  
                });
                botonPagar.classList.add("mpButton");
                mpButton.classList.remove("mpButton");
                aviso.classList.remove("peligroActive");
                aviso.classList.add("peligroInactive");
              }
        })
        
      } else {
        aviso.classList.add("peligroActive");
        aviso.classList.remove("peligroInactive");
      }
      }else{
        const carritoVacio = document.querySelector("#carritoVacio");
        carritoVacio.classList.remove('peligroInactive');
        carritoVacio.classList.add('peligroActive');
      }
      
      
    });
  }
};

// Asociar el evento "change" a los radios
radioDomicilio.addEventListener("change", mostrarInputs);
radioSucursal.addEventListener("change", mostrarInputs);
radioLocal.addEventListener("change", mostrarInputs);

const formDatos = document.querySelector("#formDatos");
