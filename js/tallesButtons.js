// Función para seleccionar un talle
function seleccionarTalle(button) {
  // Obtener todos los botones
  var botones = document.getElementsByClassName('botonesTalles');

  // Recorrer los botones y aplicar el estilo correspondiente
  for (var i = 0; i < botones.length; i++) {
      botones[i].style.backgroundColor = 'white';
  }

  // Establecer el color del botón seleccionado
  button.style.backgroundColor = 'lightgrey';
}

function seleccionarColor(color) {
  // Ocultar todos los divs de talles
  const divsTalles = document.getElementsByClassName("talles");
  for (let i = 0; i < divsTalles.length; i++) {
    divsTalles[i].style.display = "none";
  }

  // Mostrar el div de talles del color seleccionado
  const divTalles = document.getElementById("talles-" + color);
  if (divTalles) {
    divTalles.style.display = "block";
  }
}

document.addEventListener('DOMContentLoaded', function() {
  var inputColors = document.querySelectorAll('.input-color');

  for (var i = 0; i < inputColors.length; i++) {
    inputColors[i].addEventListener('change', function() {
      var labels = document.querySelectorAll('.label-color');

      for (var j = 0; j < labels.length; j++) {
        labels[j].classList.remove('checked');
      }

      if (this.checked) {
        var label = this.parentNode;
        label.classList.add('checked');
      }
    });
  }
});



