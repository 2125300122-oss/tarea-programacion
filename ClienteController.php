<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function listar()
    {
        $clientes = Cliente::all();
        return view("clientes.listado", compact("clientes"));
    }

    public function vistaFormulario()
    {
        return view("clientes.formulario");
    }

    public function registrar(Request $request)
    {
        $cliente = new Cliente();
        $cliente->nombres = $request->nombres ?? "CLIENTE";
        $cliente->apellidos = $request->apellidos ?? "EJEMPLO";
        $cliente->correo = $request->correo ?? ("cliente" . rand(100, 999) . "@correo.com");
        $cliente->telefono = $request->telefono ?? "3331112233";
        $cliente->direccion = $request->direccion ?? "Dirección registrada";
        $cliente->imagen = $request->imagen ?? 'default_client.png';

        $cliente->save();

        return redirect('/clientes/listado');
    }

    public function vistaEdicion()
    {
        return view("clientes.edicion");
    }

    public function actualizar(Request $request)
    {
        return redirect('/clientes/listado');
    }

    public function vistaMostrar()
    {
        return view("clientes.mostrar");
    }

    public function borrar()
    {
        return redirect('/clientes/listado');
    }
}
