//************PRODUCTOS************* */

// Modal para modificar producto
var modalModificarProducto = document.getElementById("modalModificar");
modalModificarProducto.addEventListener("show.bs.modal", function (event) {
  var button = event.relatedTarget;

  // Extrae los valores
  var idProducto = button.getAttribute("data-id");
  var nombreProducto = button.getAttribute("data-nombre");
  var precioProducto = button.getAttribute("data-precio");
  var categoriaProducto = button.getAttribute("data-categoria");


  // Asigna los valores a los campos del modal
  document.getElementById("idProductoM").value = idProducto;
  document.getElementById("nombreProductoM").value = nombreProducto;
  document.getElementById("precioProductoM").value = precioProducto;
  document.getElementById("categoriaProductoM").value = categoriaProducto;
});

// Modal para eliminar producto
var modalEliminarProducto = document.getElementById("modalEliminar");
modalEliminarProducto.addEventListener("show.bs.modal", function (event) {
  var button = event.relatedTarget;
  var idProducto = button.getAttribute("data-id");
  document.getElementById("idProductoEliminar").value = idProducto;
});
