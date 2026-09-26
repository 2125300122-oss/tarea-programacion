<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function listar()
    {
        $productos = Producto::all();
        return view("productos.listado", compact("productos"));
    }

    public function vistaFormulario()
    {
        return view("productos.formulario");
    }

    public function registrar(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->nombre ?? "Paracetamol 500mg";
        $producto->descripcion = $request->descripcion ?? "Analgésico y antipirético";
        $producto->precio = $request->precio ?? 45.50;
        $producto->existencia = $request->existencia ?? 50;

        $producto->save();

        return redirect('/productos/listado');
    }

    public function vistaEdicion()
    {
        return view("productos.edicion");
    }

    public function actualizar(Request $request)
    {
        return redirect('/productos/listado');
    }

    public function vistaMostrar()
    {
        return view("productos.mostrar");
    }

    public function borrar()
    {
        return redirect('/productos/listado');
    }
}
