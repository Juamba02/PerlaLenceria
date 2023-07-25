const boton = document.querySelector("#botonEnviar");
const botonLocal = document.querySelector("#botonEnviarLocal");
const emailSpan = document.querySelector("#email");
const inputSeguimiento = document.querySelector("#seguimiento");
const inputEnvio = document.querySelector("#envio");
const email = emailSpan.innerHTML;
const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');
const pedidoSpan = document.querySelector("#pedido");
const pedido = pedidoSpan.innerHTML;
if (boton) {
    boton.addEventListener('click', (e) => {
        e.preventDefault();
        if(inputSeguimiento.value != "" && inputEnvio.value != ""){
            const seguimiento = inputSeguimiento.value;
            const envio = inputEnvio.value;
            $.ajax({
                type: "POST",
                url: "../php/enviarEmail.php",
                data: {email:email, seguimiento: seguimiento, envio: envio},
                dataType: "json",
                success: function(respuesta){
                    $.ajax({
                        type: "POST",
                        url: "../php/productoListo.php",
                        data: {id: id, seguimiento: seguimiento, envio: envio},
                        dataType: "json",
                        success: function(respuesta){
                        window.location.href = "https://admin.perlalenceria.com/views/listaVentas.php";
                    }
                    })
                }
            })
        }
    })
}else if(botonLocal) {
    botonLocal.addEventListener('click', (e) => {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../php/enviarEmailLocal.php",
            data: {email:email, id: pedido},
            dataType: "json",
            success: function(respuesta){
                $.ajax({
                    type: "POST",
                    url: "../php/productoListo.php",
                    data: {id: id, seguimiento: "Retira por el local", envio: "Retira por el local"},
                    dataType: "json",
                    success: function(respuesta){
                    window.location.href = "https://admin.perlalenceria.com/views/listaVentas.php";
                }
                })
            }
        })
    })
}

