
//************PROVEEDORES************* */

var modalModificar = document.getElementById("modalModificar");
modalModificar.addEventListener("show.bs.modal", function (event) {
  var button = event.relatedTarget;

  // Extrae los valores
  var idProveedor = button.getAttribute("data-id");
  var nombreProveedor = button.getAttribute("data-nombre");
  var contactoProveedor = button.getAttribute("data-contacto");
  var direccionProveedor = button.getAttribute("data-direccion");

  // Asigna los valores a los campos del modal
  document.getElementById("idProveedorM").value = idProveedor;
  document.getElementById("nombreProveedorM").value = nombreProveedor;
  document.getElementById("contactoProveedorM").value = contactoProveedor;
  document.getElementById("direccionProveedorM").value =
    direccionProveedor;
});


var modalEliminar = document.getElementById("modalEliminar");
modalEliminar.addEventListener("show.bs.modal", function (event) {
  var button = event.relatedTarget;
  var idProveedor = button.getAttribute("data-id");
  document.getElementById("idProveedorEliminar").value = idProveedor;
});

