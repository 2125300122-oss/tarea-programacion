<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/inicio', 'layouts/app');

// RUTAS ADMINISTRADOR 
Route::get('/admin/listar', [AdministradorController::class, 'listar'])->name('admin.index');
Route::get('/admin/crear', [AdministradorController::class, 'vistaFormulario']);
Route::post('/admin/guardar', [AdministradorController::class, 'registrar']);
Route::get('/admin/editar/{id?}', [AdministradorController::class, 'vistaEdicion']);
Route::put('/admin/actualizar/{id?}', [AdministradorController::class, 'actualizar']);
Route::get('/admin/mostrar/{id?}', [AdministradorController::class, 'vistaMostrar']);
Route::delete('/admin/borrar/{id?}', [AdministradorController::class, 'borrar']);


