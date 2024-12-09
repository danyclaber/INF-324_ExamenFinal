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
    <title>Productos</title>
</head>

<body>

    @include('navbar')

    <!-- Contenido principal -->
    <div class="container mt-5 mb-5">
        <h1 class="text-center mb-4">Lista de Productos</h1>

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
                        <th>Precio</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iteramos sobre los productos -->
                    @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td> <!-- ID -->
                        <td>{{ $producto->nombre }}</td> <!-- Nombre -->
                        <td>{{ $producto->precio }}</td> <!-- Precio -->
                        <td>{{ $producto->nombreCategoria }}</td> <!-- Categoría -->
                        <td>
                            <!-- Botón modificar -->
                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalModificar"
                                data-id="{{ $producto->id }}"
                                data-nombre="{{ $producto->nombre }}"
                                data-precio="{{ $producto->precio }}"
                                data-categoria="{{ $producto->categoria_id }}">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Botón eliminar -->
                            <button
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEliminar"
                                data-id="{{ $producto->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Adicionar Producto -->
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
                        Adicionar Producto
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para adicionar producto -->
                    <form id="formProducto" method="POST" action="{{ route('registrarProducto') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nombreProducto" class="form-label">Nombre</label>
                            <input
                                type="text"
                                class="form-control"
                                id="nombreProducto"
                                name="nombreProducto"
                                placeholder="Nombre del producto"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="precioProducto" class="form-label">Precio</label>
                            <input
                                type="number"
                                class="form-control"
                                id="precioProducto"
                                name="precioProducto"
                                placeholder="Precio del producto"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="categoriaProducto" class="form-label">Categoría</label>
                            <select
                                class="form-control"
                                id="categoriaProducto"
                                name="categoriaProducto"
                                required>
                                <option value="">Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
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
                    <button type="submit" form="formProducto" class="btn btn-primary">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Modificar Producto -->
    <div class="modal fade" id="modalModificar" tabindex="-1" aria-labelledby="modalModificarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModificarLabel">Modificar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de modificación -->
                    <form id="formModificarProducto" method="POST" action="{{ route('modificarProducto') }}">
                        @csrf
                        <input type="hidden" name="idProductoM" id="idProductoM" />
                        <div class="mb-3">
                            <label for="nombreProductoM" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombreProductoM" name="nombreProductoM" required />
                        </div>
                        <div class="mb-3">
                            <label for="precioProductoM" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precioProductoM" name="precioProductoM" required />
                        </div>
                        <div class="mb-3">
                            <label for="categoriaProductoM" class="form-label">Categoría</label>
                            <select
                                class="form-control"
                                id="categoriaProductoM"
                                name="categoriaProductoM"
                                required>
                                <option value="">Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formModificarProducto" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Eliminar Producto -->
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
                        Eliminar Producto
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este producto?
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <!-- Formulario de eliminación del producto -->
                    <form
                        id="formEliminarProducto"
                        method="POST"
                        action="{{ route('eliminarProducto') }}">
                        @csrf 
                        <input
                            type="hidden"
                            name="idProducto"
                            id="idProductoEliminar" />
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

    <script src="{{ asset('js/productos.js') }}"></script>

</body>

</html>
