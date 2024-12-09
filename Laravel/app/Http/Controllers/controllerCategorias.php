<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controllerCategorias extends Controller
{
    public function listarCategorias()
    {
        // Obtener todas las categorías
        $datos = DB::select("select * from categorias");
        return view('viewCategorias')->with("categorias", $datos);
    }

    public function registrarCategoria(Request $request)
    {
        // Insertar la categoría en la base de datos
        DB::insert("INSERT INTO categorias (nombre) VALUES (?)", [
            $request->input('nombreCategoria'),
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('listarCategorias')->with('success', 'Categoría registrada exitosamente.');
    }

    public function modificarCategoria(Request $request)
    {
        // Actualizar la categoría en la base de datos
        DB::table('categorias')
            ->where('id', $request->idCategoriaM)
            ->update([
                'nombre' => $request->nombreCategoriaM,
            ]);

        // Redirigir a la lista de categorías con un mensaje de éxito
        return redirect()->route('listarCategorias')->with('success', 'Categoría actualizada exitosamente.');
    }

    public function eliminarCategoria(Request $request)
    {
        // Eliminar la categoría de la base de datos
        DB::table('categorias')->where('id', $request->idCategoria)->delete();

        // Redirigir a la lista de categorías con un mensaje de éxito
        return redirect()->route('listarCategorias')->with('success', 'Categoría eliminada exitosamente.');
    }
}
