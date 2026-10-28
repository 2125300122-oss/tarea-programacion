<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProductoApiController;
use App\Http\Controllers\Api\ClienteApiController;
use App\Http\Controllers\Api\CategoriaApiController;
use App\Http\Controllers\Api\MarcaApiController;
use App\Http\Controllers\Api\TipoApiController;
use App\Http\Controllers\Api\AdministradorApiController;
use App\Http\Controllers\Api\EmpleadoApiController;

/*
|--------------------------------------------------------------------------
| API ROUTES (MÉTODOS REST: GET, POST, PUT, DELETE)
|--------------------------------------------------------------------------
*/

// RUTAS API PRODUCTOS
Route::get('/productos', [ProductoApiController::class, 'index']);

Route::post('/productos', [ProductoApiController::class, 'store']);
Route::put('/productos/{id}', [ProductoApiController::class, 'update']);
Route::delete('/productos/{id}', [ProductoApiController::class, 'destroy']);

// RUTAS API CLIENTES
Route::get('/clientes', [ClienteApiController::class, 'index']);

Route::post('/clientes', [ClienteApiController::class, 'store']);
Route::put('/clientes/{id}', [ClienteApiController::class, 'update']);
Route::delete('/clientes/{id}', [ClienteApiController::class, 'destroy']);

// RUTAS API CATEGORÍAS
Route::get('/categorias', [CategoriaApiController::class, 'index']);

Route::post('/categorias', [CategoriaApiController::class, 'store']);
Route::put('/categorias/{id}', [CategoriaApiController::class, 'update']);
Route::delete('/categorias/{id}', [CategoriaApiController::class, 'destroy']);

// RUTAS API MARCAS / LABORATORIOS
Route::get('/marcas', [MarcaApiController::class, 'index']);

Route::post('/marcas', [MarcaApiController::class, 'store']);
Route::put('/marcas/{id}', [MarcaApiController::class, 'update']);
Route::delete('/marcas/{id}', [MarcaApiController::class, 'destroy']);

// RUTAS API TIPOS
Route::get('/tipos', [TipoApiController::class, 'index']);

Route::post('/tipos', [TipoApiController::class, 'store']);
Route::put('/tipos/{id}', [TipoApiController::class, 'update']);
Route::delete('/tipos/{id}', [TipoApiController::class, 'destroy']);

// RUTAS API ADMINISTRADORES
Route::get('/administradores', [AdministradorApiController::class, 'index']);
Route::get('/administradores/{id}', [AdministradorApiController::class, 'show']);
Route::post('/administradores', [AdministradorApiController::class, 'store']);
Route::put('/administradores/{id}', [AdministradorApiController::class, 'update']);
Route::delete('/administradores/{id}', [AdministradorApiController::class, 'destroy']);

// RUTAS API EMPLEADOS
Route::get('/empleados', [EmpleadoApiController::class, 'index']);
Route::get('/empleados/{id}', [EmpleadoApiController::class, 'show']);
Route::post('/empleados', [EmpleadoApiController::class, 'store']);
Route::put('/empleados/{id}', [EmpleadoApiController::class, 'update']);
Route::delete('/empleados/{id}', [EmpleadoApiController::class, 'destroy']);