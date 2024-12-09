<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controllerProductos extends Controller
{


    public function listarProductos()
    {
         // Obtener todos los productos de la base de datos
         $productos = DB::select("SELECT p.id, p.nombre, p.precio, c.nombre as nombreCategoria, c.id as categoria_id FROM productos p JOIN categorias c ON p.categoria_id = c.id");

         // Obtener todas las categorías
         $categorias = DB::select("SELECT * FROM categorias");
 
         // Pasar los datos a la vista
         return view('viewProductos', compact('productos', 'categorias'));
    }

    public function registrarProducto(Request $request)
    {
        // Insertar el producto en la base de datos
        DB::insert("INSERT INTO productos (nombre, precio, categoria_id) VALUES (?, ?, ?)", [
            $request->input('nombreProducto'),
            $request->input('precioProducto'),
            $request->input('categoriaProducto'),
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('listarProductos')->with('success', 'Producto registrado exitosamente.');
    }

    public function modificarProducto(Request $request)
    {
        // Actualizar el producto en la base de datos
        DB::table('productos')
            ->where('id', $request->idProductoM)
            ->update([
                'nombre' => $request->nombreProductoM,
                'precio' => $request->precioProductoM,
                'categoria_id' => $request->categoriaProductoM,
            ]);

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('listarProductos')->with('success', 'Producto actualizado exitosamente.');
    }

    public function eliminarProducto(Request $request)
    {
        // Eliminar el producto de la base de datos
        DB::table('productos')->where('id', $request->idProducto)->delete();

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('listarProductos')->with('success', 'Producto eliminado exitosamente.');
    }
}
