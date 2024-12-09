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
    <title>Categorías</title>
</head>

<body>

    @include('navbar')

    <!-- Contenido principal -->
    <div class="container mt-5 mb-5">
        <h1 class="text-center mb-4">Lista de Categorías</h1>

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
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iteramos sobre las categorías -->
                    @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td> <!-- ID -->
                        <td>{{ $categoria->nombre }}</td> <!-- Nombre -->
                        <td class="text-center">
                            <!-- Botón modificar -->
                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalModificar"
                                data-id="{{ $categoria->id }}"
                                data-nombre="{{ $categoria->nombre }}">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Botón eliminar -->
                            <button
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEliminar"
                                data-id="{{ $categoria->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Adicionar Categoría -->
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
                        Adicionar Categoría
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para adicionar categoría -->
                    <form id="formCategoria" method="POST" action="{{ route('registrarCategoria') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nombreCategoria" class="form-label">Nombre</label>
                            <input
                                type="text"
                                class="form-control"
                                id="nombreCategoria"
                                name="nombreCategoria"
                                placeholder="Nombre de la categoría"
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
                    <button type="submit" form="formCategoria" class="btn btn-primary">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Modificar Categoría -->
    <div class="modal fade" id="modalModificar" tabindex="-1" aria-labelledby="modalModificarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModificarLabel">Modificar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de modificación -->
                    <form id="formModificarCategoria" method="POST" action="{{ route('modificarCategoria') }}">
                        @csrf
                        <input type="hidden" name="idCategoriaM" id="idCategoriaM" />
                        <div class="mb-3">
                            <label for="nombreCategoriaM" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombreCategoriaM" name="nombreCategoriaM" required />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formModificarCategoria" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Eliminar Categoría -->
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
                        Eliminar Categoría
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta categoría?
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <!-- Formulario de eliminación de categoría -->
                    <form
                        id="formEliminarCategoria"
                        method="POST"
                        action="{{ route('eliminarCategoria') }}">
                        @csrf 
                        <input
                            type="hidden"
                            name="idCategoria"
                            id="idCategoriaEliminar" />
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

    <script src="{{ asset('js/categorias.js') }}"></script>

</body>

</html>

