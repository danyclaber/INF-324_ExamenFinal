<?php

use App\Http\Controllers\controllerProveedores;
use App\Http\Controllers\controllerCategorias;
use App\Http\Controllers\controllerProductos;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    //return view('welcome');
    return view('index');
});


// Ruta para listar proveedores
Route::get('/misProveedores', [controllerProveedores::class, 'listarProveedores'])->name('listarProveedores');

// Ruta para registrar un nuevo proveedor
Route::post('/registrarProveedor', [controllerProveedores::class, 'registrarProveedor'])->name('registrarProveedor');

// Ruta para modificar proveedor
Route::post('/modificarProveedor', [controllerProveedores::class, 'modificarProveedor'])->name('modificarProveedor');

// Ruta para eliminar proveedor
Route::post('/eliminarProveedor', [controllerProveedores::class, 'eliminarProveedor'])->name('eliminarProveedor');



// Ruta para listar categorías
Route::get('/misCategorias', [controllerCategorias::class, 'listarCategorias'])->name('listarCategorias');

// Ruta para registrar una nueva categoría
Route::post('/registrarCategoria', [controllerCategorias::class, 'registrarCategoria'])->name('registrarCategoria');

// Ruta para modificar categoría
Route::post('/modificarCategoria', [controllerCategorias::class, 'modificarCategoria'])->name('modificarCategoria');

// Ruta para eliminar categoría
Route::post('/eliminarCategoria', [controllerCategorias::class, 'eliminarCategoria'])->name('eliminarCategoria');



// Ruta para listar productos
Route::get('/misProductos', [controllerProductos::class, 'listarProductos'])->name('listarProductos');

// Ruta para registrar un nuevo producto
Route::post('/registrarProducto', [controllerProductos::class, 'registrarProducto'])->name('registrarProducto');

// Ruta para modificar producto
Route::post('/modificarProducto', [controllerProductos::class, 'modificarProducto'])->name('modificarProducto');

// Ruta para eliminar producto
Route::post('/eliminarProducto', [controllerProductos::class, 'eliminarProducto'])->name('eliminarProducto');
