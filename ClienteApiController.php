<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Validator;

class ClienteApiController extends Controller
{
    public function index()
    {
        $clientes = Cliente::where('estado', 1)->get();
        return response()->json([
            'status' => true,
            'mensaje' => 'Lista de clientes obtenida correctamente',
            'data' => $clientes
        ], 200);
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Cliente con ID ' . $id . ' no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'mensaje' => 'Cliente encontrado',
            'data' => $cliente
        ], 200);
    }

    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->nombres = !empty($request->nombres) ? $request->nombres : 'Cliente API';
        $cliente->apellidos = !empty($request->apellidos) ? $request->apellidos : 'Ejemplo';

        // Manejar correo único si ya existe
        $correoIngresado = !empty($request->correo) ? $request->correo : 'cliente_' . rand(100, 999) . '@gmail.com';
        if (Cliente::where('correo', $correoIngresado)->exists()) {
            $correoIngresado = str_replace('@', '_' . rand(10, 99) . '@', $correoIngresado);
        }
        $cliente->correo = $correoIngresado;

        $cliente->contraseña = bcrypt($request->contraseña ?? 'cliente123');
        $cliente->direccion = !empty($request->direccion) ? $request->direccion : 'Dirección no especificada';
        $cliente->imagen = "imagenes/clientes/cliente_default.png";
        $cliente->estado = 1;

        if ($request->hasFile('imagen')) {
            $publicUrl = ImageUploadService::uploadImage($request->file('imagen'));
            if ($publicUrl) {
                $cliente->imagen = $publicUrl;
            }
        }

        $cliente->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Cliente registrado correctamente vía API REST',
            'data' => $cliente
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Cliente no encontrado'
            ], 404);
        }

        $cliente->nombres = !empty($request->nombres) ? $request->nombres : $cliente->nombres;
        $cliente->apellidos = !empty($request->apellidos) ? $request->apellidos : $cliente->apellidos;
        $cliente->correo = !empty($request->correo) ? $request->correo : $cliente->correo;
        $cliente->direccion = !empty($request->direccion) ? $request->direccion : $cliente->direccion;

        if ($request->hasFile('imagen')) {
            $publicUrl = ImageUploadService::uploadImage($request->file('imagen'));
            if ($publicUrl) {
                $cliente->imagen = $publicUrl;
            }
        }

        $cliente->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Cliente actualizado correctamente vía API',
            'data' => $cliente
        ], 200);
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Cliente no encontrado'
            ], 404);
        }

        $cliente->estado = 0;
        $cliente->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Cliente con ID ' . $id . ' eliminado con éxito'
        ], 200);
    }
}
