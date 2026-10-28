<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tipo;
use App\Services\ImageUploadService;

class TipoApiController extends Controller
{
    public function index()
    {
        $tipos = Tipo::where('estado', 1)->get();
        return response()->json([
            'status' => true,
            'mensaje' => 'Lista de tipos obtenida correctamente',
            'data' => $tipos
        ], 200);
    }

    public function show($id)
    {
        $tipo = Tipo::find($id);

        if (!$tipo) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Tipo de presentación no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'mensaje' => 'Tipo encontrado',
            'data' => $tipo
        ], 200);
    }

    public function store(Request $request)
    {
        $nombreIngresado = !empty($request->nombre) ? $request->nombre : 'Tipo API ' . rand(100, 999);

        // Si el nombre ya existe en la base de datos, le añade un sufijo para evitar error de duplicado
        if (Tipo::where('nombre', $nombreIngresado)->exists()) {
            $nombreIngresado = $nombreIngresado . ' (' . rand(10, 99) . ')';
        }

        $tipo = new Tipo();
        $tipo->nombre = $nombreIngresado;
        $tipo->imagen = "imagenes/tipos/tipo_default.png";
        $tipo->estado = 1;

        if ($request->hasFile('imagen')) {
            $publicUrl = ImageUploadService::uploadImage($request->file('imagen'));
            if ($publicUrl) {
                $tipo->imagen = $publicUrl;
            }
        }

        $tipo->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Tipo registrado con éxito vía API REST',
            'data' => $tipo
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $tipo = Tipo::find($id);

        if (!$tipo) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Tipo de presentación no encontrado'
            ], 404);
        }

        if (!empty($request->nombre)) {
            $tipo->nombre = $request->nombre;
        }

        if ($request->hasFile('imagen')) {
            $publicUrl = ImageUploadService::uploadImage($request->file('imagen'));
            if ($publicUrl) {
                $tipo->imagen = $publicUrl;
            }
        }

        $tipo->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Tipo actualizado con éxito vía API',
            'data' => $tipo
        ], 200);
    }

    public function destroy($id)
    {
        $tipo = Tipo::find($id);

        if (!$tipo) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Tipo no encontrado'
            ], 404);
        }

        $tipo->estado = 0;
        $tipo->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Tipo eliminado con éxito'
        ], 200);
    }
}
