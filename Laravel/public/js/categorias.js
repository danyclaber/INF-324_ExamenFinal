//************CATEGORÍAS************* */

var modalModificar = document.getElementById("modalModificar");
modalModificar.addEventListener("show.bs.modal", function (event) {
  var button = event.relatedTarget;

  // Extrae los valores
  var idCategoria = button.getAttribute("data-id");
  var nombreCategoria = button.getAttribute("data-nombre");

  // Asigna los valores a los campos del modal
  document.getElementById("idCategoriaM").value = idCategoria;
  document.getElementById("nombreCategoriaM").value = nombreCategoria;
});

var modalEliminar = document.getElementById("modalEliminar");
modalEliminar.addEventListener("show.bs.modal", function (event) {
  var button = event.relatedTarget;
  var idCategoria = button.getAttribute("data-id");
  document.getElementById("idCategoriaEliminar").value = idCategoria;
});
