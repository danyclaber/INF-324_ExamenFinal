<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <!-- Incluyendo Font Awesome para íconos -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        rel="stylesheet" />
    <title>Proveedores</title>
</head>

<body>

    @include('navbar')

    <!-- Contenido principal -->
    <div class="container mt-5 mb-5">
        <h1 class="text-center mb-4">Lista de Proveedores</h1>

        <!-- Botón Adicionar -->
        <div class="mb-3">
            <button
                class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#modalAdicionar"
                title="Adicionar">
                <i class="fas fa-plus"></i> Adicionar
            </button>
        </div>

        <!-- Tabla responsiva -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Contacto</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iteramos sobre los proveedores -->
                    @foreach ($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->id }}</td> <!-- ID -->
                        <td>{{ $proveedor->nombre }}</td> <!-- Nombre -->
                        <td>{{ $proveedor->contacto }}</td> <!-- Contacto -->
                        <td>{{ $proveedor->direccion }}</td> <!-- Dirección -->
                        <td>
                            <!-- Botón modificar -->
                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalModificar"
                                data-id="{{ $proveedor->id }}"
                                data-nombre="{{ $proveedor->nombre }}"
                                data-contacto="{{ $proveedor->contacto }}"
                                data-direccion="{{ $proveedor->direccion }}">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Botón eliminar -->
                            <button
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEliminar"
                                data-id="{{ $proveedor->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal para Adicionar Proveedor -->
    <div
        class="modal fade"
        id="modalAdicionar"
        tabindex="-1"
        aria-labelledby="modalAdicionarLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAdicionarLabel">
                        Adicionar Proveedor
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para adicionar proveedor -->
                    <form id="formProveedor" method="POST" action="{{ route('registrarProveedor') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nombreProveedor" class="form-label">Nombre</label>
                            <input
                                type="text"
                                class="form-control"
                                id="nombreProveedor"
                                name="nombreProveedor"
                                placeholder="Nombre del proveedor"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="contactoProveedor" class="form-label">Contacto</label>
                            <input
                                type="text"
                                class="form-control"
                                id="contactoProveedor"
                                name="contactoProveedor"
                                placeholder="Número de contacto"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="direccionProveedor" class="form-label">Dirección</label>
                            <input
                                type="text"
                                class="form-control"
                                id="direccionProveedor"
                                name="direccionProveedor"
                                placeholder="Dirección del proveedor"
                                required />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cerrar
                    </button>
                    <button type="submit" form="formProveedor" class="btn btn-primary">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Modificar Proveedor -->
    <div class="modal fade" id="modalModificar" tabindex="-1" aria-labelledby="modalModificarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModificarLabel">Modificar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de modificación -->
                    <form id="formModificarProveedor" method="POST" action="{{ route('modificarProveedor') }}">
                        @csrf
                        <input type="hidden" name="idProveedorM" id="idProveedorM" />
                        <div class="mb-3">
                            <label for="nombreProveedorM" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombreProveedorM" name="nombreProveedorM" required />
                        </div>
                        <div class="mb-3">
                            <label for="contactoProveedorM" class="form-label">Contacto</label>
                            <input type="text" class="form-control" id="contactoProveedorM" name="contactoProveedorM" required />
                        </div>
                        <div class="mb-3">
                            <label for="direccionProveedorM" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccionProveedorM" name="direccionProveedorM" required />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formModificarProveedor" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Eliminar Proveedor -->
    <div
        class="modal fade"
        id="modalEliminar"
        tabindex="-1"
        aria-labelledby="modalEliminarLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarLabel">
                        Eliminar Proveedor
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este proveedor?
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <!-- Formulario de eliminación del proveedor -->
                    <form
                        id="formEliminarProveedor"
                        method="POST"
                        action="{{ route('eliminarProveedor') }}">
                        @csrf 
                        <input
                            type="hidden"
                            name="idProveedor"
                            id="idProveedorEliminar" />
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="{{ asset('js/proveedores.js') }}"></script>

</body>

</html>