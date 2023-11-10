<?php

use App\Http\Controllers\FotosRutaController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\UsuarioController;
use Database\Factories\FotosRutaFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// API USUARIOS
Route::apiResource('usuarios', UsuarioController::class);
Route::get('usuarios/{usuario}/rutas', [UsuarioController::class, 'rutasPorUsuario']);

// API RUTAS
Route::apiResource('rutas', RutaController::class);
Route::get('rutas/ultimas/{ruta}', [RutaController::class, 'ultimasRutas']);
Route::get('rutas/{ruta}/coordenadas', [RutaController::class, 'getCoordenadasRuta']);
Route::get('rutas/busqueda/{filtro}', [RutaController::class, 'filtrarRuta']);

// API FOTOS_RUTA
Route::apiResource('fotos-ruta', FotosRutaController::class, ['parameters' => ['fotos-ruta' => 'fotos']]);