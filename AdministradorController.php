<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrador;

class AdministradorController extends Controller
{
    public function listar(){
        $admins = Administrador::all();
        return view("administradores.listado", compact("admins"));
    }

    public function vistaFormulario(){
        return view("administradores.registro");
    }

    public function registrar(Request $request){
        $admin = new Administrador();
        $admin->nombres = $request->nombres ?? "FULANO";
        $admin->apellidos = $request->apellidos ?? "SUTANO";
        $admin->correo = $request->correo ?? "juan" . rand(10, 999) . "@gmail.com";
        $admin->usuario = $request->usuario ?? "jlopez_admin" . rand(10, 99);
        $admin->contraseña = bcrypt($request->contraseña ?? $request->contrasena ?? '123456');
        $admin->imagen = "/imagenes/administradores/admin_default.jpg";
        $admin->rol = $request->rol ?? 'Administrador';
        $admin->estado = $request->estado ?? 1;

        $admin->save();

        if($request->hasFile('imagen')){
            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $nuevoNombre = 'administrador_'.$admin->id.'.'.$extension;
            $carpeta = 'imagenes/administradores';
            $ruta = $imagen->storeAs($carpeta, $nuevoNombre, 'public');
            $admin->imagen = $ruta;
            $admin->save();
        }

        return "Aqui va el insert";
    }

    public function vistaEdicion($id = null){
        $admin = $id ? Administrador::find($id) : null;
        return view("administradores.edicion", compact("admin"));
    }

    public function actualizar(Request $request, $id = null){
        if ($id && $admin = Administrador::find($id)) {
            $admin->nombres = $request->nombres ?? $admin->nombres;
            $admin->apellidos = $request->apellidos ?? $admin->apellidos;
            $admin->correo = $request->correo ?? $admin->correo;
            $admin->usuario = $request->usuario ?? $admin->usuario;
            $admin->save();
        }
        return "Aqui va el update";
    }

    public function vistaMostrar($id = null){
        $admin = $id ? Administrador::find($id) : null;
        return view("administradores.mostrar", compact("admin"));
    }

    public function borrar($id = null){
        if ($id && $admin = Administrador::find($id)) {
            $admin->delete();
        }
        return "Aqui va el delete";
    }
}
