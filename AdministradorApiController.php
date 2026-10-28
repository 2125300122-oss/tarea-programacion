<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administrador;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Validator;

class AdministradorApiController extends Controller
{
    /**
     * GET /api/administradores
     * Lista todos los administradores activos.
     */
    public function index()
    {
        $admins = Administrador::where('estado', 1)->get();

        return response()->json([
            'status' => true,
            'mensaje' => 'Lista de administradores obtenida con éxito',
            'data' => $admins
        ], 200);
    }

    /**
     * GET /api/administradores/{id}
     * Muestra un administrador específico.
     */
    public function show($id)
    {
        $admin = Administrador::find($id);

        if (!$admin) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Administrador no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'mensaje' => 'Administrador encontrado',
             'data' => $admin
        ], 200);
    }

    /**
     * POST /api/administradores
     * Registra un nuevo administrador.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|email|unique:administradores,correo',
            'usuario' => 'required|string|unique:administradores,usuario',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Error de validación',
                'errores' => $validator->errors()
            ], 422);
        }

        $admin = new Administrador();
        $admin->nombres = $request->nombres;
        $admin->apellidos = $request->apellidos;
        $admin->correo = $request->correo;
        $admin->usuario = $request->usuario;
        $admin->contraseña = bcrypt($request->contraseña ?? '123456');
        $admin->rol = $request->rol ?? 'Administrador';
        $admin->estado = 1;
        $admin->imagen = "imagenes/administradores/admin_default.jpg";

        if ($request->hasFile('imagen')) {
            $publicUrl = ImageUploadService::uploadImage($request->file('imagen'));
            if ($publicUrl) {
                $admin->imagen = $publicUrl;
            }
        }

        $admin->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Administrador registrado con éxito vía API',
            'data' => $admin
        ], 201);
    }

    /**
     * PUT /api/administradores/{id}
     * Actualiza un administrador existente.
     */
    public function update(Request $request, $id)
    {
        $admin = Administrador::find($id);

        if (!$admin) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Administrador no encontrado'
            ], 404);
        }

        $admin->nombres = $request->nombres ?? $admin->nombres;
        $admin->apellidos = $request->apellidos ?? $admin->apellidos;
        $admin->correo = $request->correo ?? $admin->correo;
        $admin->usuario = $request->usuario ?? $admin->usuario;

        if ($request->hasFile('imagen')) {
            $publicUrl = ImageUploadService::uploadImage($request->file('imagen'));
            if ($publicUrl) {
                $admin->imagen = $publicUrl;
            }
        }

        $admin->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Administrador actualizado correctamente vía API',
            'data' => $admin
        ], 200);
    }

    /**
     * DELETE /api/administradores/{id}
     * Elimina un administrador.
     */
    public function destroy($id)
    {
        $admin = Administrador::find($id);

        if (!$admin) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Administrador no encontrado'
            ], 404);
        }

        $admin->estado = 0;
        $admin->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Administrador con ID ' . $id . ' eliminado con éxito'
        ], 200);
    }
}
