<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controllerProveedores extends Controller
{
    public function listarProveedores()
    {
        $datos = DB::select("select * from proveedores");
        return view('viewProveedores')->with("proveedores", $datos);
    }

    public function registrarProveedor(Request $request)
    {

        // Insertar el proveedor en la base de datos
        DB::insert("INSERT INTO proveedores (nombre, contacto, direccion) VALUES (?, ?, ?)", [
            $request->input('nombreProveedor'),
            $request->input('contactoProveedor'),
            $request->input('direccionProveedor'),
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('listarProveedores')->with('success', 'Proveedor registrado exitosamente.');
    }

    public function modificarProveedor(Request $request)
    {
        // Actualizar el proveedor en la base de datos
        DB::table('proveedores')
            ->where('id', $request->idProveedorM)
            ->update([
                'nombre' => $request->nombreProveedorM,
                'contacto' => $request->contactoProveedorM,
                'direccion' => $request->direccionProveedorM,
            ]);

        // Redirigir a la lista de proveedores con un mensaje de éxito
        return redirect()->route('listarProveedores')->with('success', 'Proveedor actualizado exitosamente.');
    }

    public function eliminarProveedor(Request $request)
    {
        // Eliminar el proveedor de la base de datos
        DB::table('proveedores')->where('id', $request->idProveedor)->delete();

        // Redirigir a la lista de proveedores con un mensaje de éxito
        return redirect()->route('listarProveedores')->with('success', 'Proveedor eliminado exitosamente.');
    }
}
