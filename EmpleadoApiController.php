<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Services\ImageUploadService;

class EmpleadoApiController extends Controller
{
    /**
     * GET /api/empleados
     * Lista todos los empleados activos.
     */
    public function index()
    {
        $empleados = Empleado::where('estado', 1)->get();

        return response()->json([
            'status' => true,
            'mensaje' => 'Lista de empleados obtenida con éxito',
            'data' => $empleados
        ], 200);
    }

    /**
     * GET /api/empleados/{id}
     * Muestra un empleado específico por ID.
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);

        if (!$empleado) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Empleado no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'mensaje' => 'Empleado encontrado',
            'data' => $empleado
        ], 200);
    }

    /**
     * POST /api/empleados
     * Registra un nuevo empleado.
     */
    public function store(Request $request)
    {
        $empleado = new Empleado();
        $empleado->nombres = !empty($request->nombres) ? $request->nombres : 'Empleado API';
        $empleado->apellidos = !empty($request->apellidos) ? $request->apellidos : 'Ejemplo';

        $correoIngresado = !empty($request->correo) ? $request->correo : 'empleado_' . rand(100, 999) . '@farmacia.com';
        if (Empleado::where('correo', $correoIngresado)->exists()) {
            $correoIngresado = str_replace('@', '_' . rand(10, 99) . '@', $correoIngresado);
        }
        $empleado->correo = $correoIngresado;

        $usuarioIngresado = !empty($request->usuario) ? $request->usuario : 'user_emp' . rand(100, 999);
        if (Empleado::where('usuario', $usuarioIngresado)->exists()) {
            $usuarioIngresado = $usuarioIngresado . rand(10, 99);
        }
        $empleado->usuario = $usuarioIngresado;

        $empleado->contraseña = bcrypt($request->contraseña ?? '123456');
        $empleado->puesto = !empty($request->puesto) ? $request->puesto : 'Farmacéutico';
        $empleado->imagen = "imagenes/empleados/empleado_default.png";
        $empleado->estado = 1;

        if ($request->hasFile('imagen')) {
            $publicUrl = ImageUploadService::uploadImage($request->file('imagen'));
            if ($publicUrl) {
                $empleado->imagen = $publicUrl;
            }
        }

        $empleado->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Empleado registrado correctamente vía API REST',
            'data' => $empleado
        ], 201);
    }

    /**
     * PUT /api/empleados/{id}
     * Actualiza un empleado existente.
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::find($id);

        if (!$empleado) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Empleado no encontrado'
            ], 404);
        }

        $empleado->nombres = !empty($request->nombres) ? $request->nombres : $empleado->nombres;
        $empleado->apellidos = !empty($request->apellidos) ? $request->apellidos : $empleado->apellidos;
        $empleado->correo = !empty($request->correo) ? $request->correo : $empleado->correo;
        $empleado->usuario = !empty($request->usuario) ? $request->usuario : $empleado->usuario;
        $empleado->puesto = !empty($request->puesto) ? $request->puesto : $empleado->puesto;

        if ($request->hasFile('imagen')) {
            $publicUrl = ImageUploadService::uploadImage($request->file('imagen'));
            if ($publicUrl) {
                $empleado->imagen = $publicUrl;
            }
        }

        $empleado->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Empleado actualizado correctamente vía API',
            'data' => $empleado
        ], 200);
    }

    /**
     * DELETE /api/empleados/{id}
     * Elimina (borrado lógico) un empleado.
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);

        if (!$empleado) {
            return response()->json([
                'status' => false,
                'mensaje' => 'Empleado no encontrado'
            ], 404);
        }

        $empleado->estado = 0;
        $empleado->save();

        return response()->json([
            'status' => true,
            'mensaje' => 'Empleado con ID ' . $id . ' eliminado con éxito'
        ], 200);
    }
}
