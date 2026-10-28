<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Services\ImageUploadService;

class CategoriaApiController extends Controller
{
    public function index()
    {
        $categorias = Categoria::where('estado', 1)->get();
        return response()->json([
            'status' => true,
            'mensaje' => 'Lista de categorías obtenida correctamente',
            'data' => $categorias
        ], 200);
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Categoría no encontrada'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'mensaje' => 'Categoría encontrada',
            'data' => $categoria
        ], 200);
    }

    public function store(Request $request)
    {
        $nombreIngresado = !empty($request->nombre) ? $request->nombre : 'Categoría API ' . rand(100, 999);

        if (Categoria::where('nombre', $nombreIngresado)->exists()) {
            $nombreIngresado = $nombreIngresado . ' (' . rand(10, 99) . ')';
        }

        $categoria = new Categoria();
        $categoria->nombre = $nombreIngresado;
        $categoria->imagen = "imagenes/categorias/categoria_default.png";
        $categoria->estado = 1;

        if ($request->hasFile('imagen')) {
            $publicUrl = ImageUploadService::uploadImage($request->file('imagen'));
            if ($publicUrl) {
                $categoria->imagen = $publicUrl;
            }
        }

        $categoria->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Categoría registrada con éxito vía API REST',
            'data' => $categoria
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Categoría no encontrada'
            ], 404);
        }

        if (!empty($request->nombre)) {
            $categoria->nombre = $request->nombre;
        }

        if ($request->hasFile('imagen')) {
            $publicUrl = ImageUploadService::uploadImage($request->file('imagen'));
            if ($publicUrl) {
                $categoria->imagen = $publicUrl;
            }
        }

        $categoria->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Categoría actualizada con éxito vía API',
            'data' => $categoria
        ], 200);
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Categoría no encontrada'
            ], 404);
        }

        $categoria->estado = 0;
        $categoria->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Categoría eliminada con éxito'
        ], 200);
    }
}
