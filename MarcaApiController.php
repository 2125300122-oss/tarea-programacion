<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marca;
use App\Services\ImageUploadService;

class MarcaApiController extends Controller
{
    public function index()
    {
        $marcas = Marca::where('estado', 1)->get();
        return response()->json([
            'status' => true,
            'mensaje' => 'Lista de marcas obtenida correctamente',
            'data' => $marcas
        ], 200);
    }

    public function show($id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Marca no encontrada'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'mensaje' => 'Marca encontrada',
            'data' => $marca
        ], 200);
    }

    public function store(Request $request)
    {
        $nombreIngresado = !empty($request->nombre) ? $request->nombre : 'Marca API ' . rand(100, 999);

        if (Marca::where('nombre', $nombreIngresado)->exists()) {
            $nombreIngresado = $nombreIngresado . ' (' . rand(10, 99) . ')';
        }

        $marca = new Marca();
        $marca->nombre = $nombreIngresado;
        $marca->imagen = "imagenes/marcas/marca_default.png";
        $marca->estado = 1;

        if ($request->hasFile('imagen')) {
            $publicUrl = ImageUploadService::uploadImage($request->file('imagen'));
            if ($publicUrl) {
                $marca->imagen = $publicUrl;
            }
        }

        $marca->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Marca registrada con éxito vía API REST',
            'data' => $marca
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Marca no encontrada'
            ], 404);
        }

        if (!empty($request->nombre)) {
            $marca->nombre = $request->nombre;
        }

        if ($request->hasFile('imagen')) {
            $publicUrl = ImageUploadService::uploadImage($request->file('imagen'));
            if ($publicUrl) {
                $marca->imagen = $publicUrl;
            }
        }

        $marca->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Marca actualizada con éxito vía API',
            'data' => $marca
        ], 200);
    }

    public function destroy($id)
    {
        $marca = Marca::find($id);

        if (!$marca) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Marca no encontrada'
            ], 404);
        }

        $marca->estado = 0;
        $marca->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Marca eliminada con éxito'
        ], 200);
    }
}
