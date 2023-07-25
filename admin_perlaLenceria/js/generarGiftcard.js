const inputCodigo = document.querySelector("#codigo");
const botonGenerar = document.querySelector("#generar");
const inputCodigoGenerado = document.querySelector("#codigo_generado");

const generarCodigoAleatorio = () => {
    const longitudCodigo = 8;
    const caracteresPermitidos = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let codigoGenerado = '';
  
    for (let i = 0; i < longitudCodigo; i++) {
      const indiceAleatorio = Math.floor(Math.random() * caracteresPermitidos.length);
      codigoGenerado += caracteresPermitidos.charAt(indiceAleatorio);
    }
  
    return codigoGenerado;
  }

  botonGenerar.addEventListener('click', (e) => {
    e.preventDefault()
    const codigo = generarCodigoAleatorio();
    inputCodigo.value = codigo;
    inputCodigoGenerado.value = codigo;
  })