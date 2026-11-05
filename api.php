<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\AdminAuthController;
use App\Http\Controllers\Api\ProductoApiController;
use App\Http\Controllers\Api\ClienteApiController;
use App\Http\Controllers\Api\CategoriaApiController;
use App\Http\Controllers\Api\MarcaApiController;
use App\Http\Controllers\Api\TipoApiController;
use App\Http\Controllers\Api\AdministradorApiController;
use App\Http\Controllers\Api\EmpleadoApiController;
use App\Http\Controllers\Api\PedidoApiController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS DE AUTENTICACIÓN (LOGIN) - SOPORTA GET Y POST
|--------------------------------------------------------------------------
*/

// Rutas de login públicas (Soporta GET, POST, Basic Auth, Body y Query Params)
Route::match(['get', 'post'], '/admin/login', [AdminAuthController::class, 'login']);
Route::match(['get', 'post'], '/administradores/login', [AdminAuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| RUTAS PRIVADAS Y PROTEGIDAS POR TOKEN SANCTUM (auth:sanctum)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // AUTENTICACIÓN ADMINISTRADOR (LOGOUT Y PERFIL)
    Route::match(['get', 'post'], '/admin/logout', [AdminAuthController::class, 'logout']);
    Route::match(['get', 'post'], '/administradores/logout', [AdminAuthController::class, 'logout']);
    Route::get('/admin/me', [AdminAuthController::class, 'me']);

    // RUTAS API ADMINISTRADORES (GET, POST, PUT, DELETE)
    Route::get('/administradores', [AdministradorApiController::class, 'index']);
    Route::get('/administradores/{id}', [AdministradorApiController::class, 'show']);
    Route::post('/administradores', [AdministradorApiController::class, 'store']);
    Route::put('/administradores/{id}', [AdministradorApiController::class, 'update']);
    Route::delete('/administradores/{id}', [AdministradorApiController::class, 'destroy']);

    // RUTAS API PRODUCTOS (GET, POST, PUT, DELETE)
    Route::get('/productos', [ProductoApiController::class, 'index']);
    Route::get('/productos/{id}', [ProductoApiController::class, 'show']);
    Route::post('/productos', [ProductoApiController::class, 'store']);
    Route::put('/productos/{id}', [ProductoApiController::class, 'update']);
    Route::delete('/productos/{id}', [ProductoApiController::class, 'destroy']);

    // RUTAS API CLIENTES (GET, POST, PUT, DELETE)
    Route::get('/clientes', [ClienteApiController::class, 'index']);
    Route::get('/clientes/{id}', [ClienteApiController::class, 'show']);
    Route::post('/clientes', [ClienteApiController::class, 'store']);
    Route::put('/clientes/{id}', [ClienteApiController::class, 'update']);
    Route::delete('/clientes/{id}', [ClienteApiController::class, 'destroy']);

    // RUTAS API MARCAS / PROVEEDORES (GET, POST, PUT, DELETE)
    Route::get('/marcas', [MarcaApiController::class, 'index']);
    Route::get('/marcas/{id}', [MarcaApiController::class, 'show']);
    Route::post('/marcas', [MarcaApiController::class, 'store']);
    Route::put('/marcas/{id}', [MarcaApiController::class, 'update']);
    Route::delete('/marcas/{id}', [MarcaApiController::class, 'destroy']);

    // RUTAS API CATEGORÍAS (GET, POST, PUT, DELETE)
    Route::get('/categorias', [CategoriaApiController::class, 'index']);
    Route::get('/categorias/{id}', [CategoriaApiController::class, 'show']);
    Route::post('/categorias', [CategoriaApiController::class, 'store']);
    Route::put('/categorias/{id}', [CategoriaApiController::class, 'update']);
    Route::delete('/categorias/{id}', [CategoriaApiController::class, 'destroy']);

    // RUTAS API TIPOS (GET, POST, PUT, DELETE)
    Route::get('/tipos', [TipoApiController::class, 'index']);
    Route::get('/tipos/{id}', [TipoApiController::class, 'show']);
    Route::post('/tipos', [TipoApiController::class, 'store']);
    Route::put('/tipos/{id}', [TipoApiController::class, 'update']);
    Route::delete('/tipos/{id}', [TipoApiController::class, 'destroy']);

    // RUTAS API EMPLEADOS (GET, POST, PUT, DELETE)
    Route::get('/empleados', [EmpleadoApiController::class, 'index']);
    Route::get('/empleados/{id}', [EmpleadoApiController::class, 'show']);
    Route::post('/empleados', [EmpleadoApiController::class, 'store']);
    Route::put('/empleados/{id}', [EmpleadoApiController::class, 'update']);
    Route::delete('/empleados/{id}', [EmpleadoApiController::class, 'destroy']);

    // RUTAS API PEDIDOS (GET, DELETE)
    Route::get('/pedidos', [PedidoApiController::class, 'index']);
    Route::get('/pedidos/{id}', [PedidoApiController::class, 'show']);
    Route::delete('/pedidos/{id}', [PedidoApiController::class, 'destroy']);
});
