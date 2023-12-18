<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\FotosRutaController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\ContactoController;

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

//RUTAS PUBLICAS

    // REGISTRO y LOGIN
    Route::post('registrarse',[AuthController::class,'registrarse']);
    Route::post('login',[AuthController::class,'login']);

    // BUSCADOR
    Route::get('ciudades',[BuscadorController::class,'getCiudades']);
    Route::get('dificultad',[BuscadorController::class,'getDificultad']);
    Route::post('buscador', [BuscadorController::class, 'buscar']);

    // CONTACTA CON NOSOTROS
    Route::post('contacta-con-nosotros', [ContactoController::class, 'store']);

    // SERVICIO
    Route::get('carreras-monte', [CarreraController::class, 'index']);

/////////////

    // API USERS
    Route::apiResource('usuarios', UserController::class);
    Route::get('usuarios/{usuario}/rutas', [UserController::class, 'rutasPorUsuario']);
    
    // API RUTAS
    Route::apiResource('rutas', RutaController::class);
    Route::get('rutas/ultimas/{ruta}', [RutaController::class, 'ultimasRutas']);
    Route::get('rutas/{ruta}/coordenadas', [RutaController::class, 'getCoordenadasRuta']);
    Route::get('rutas/busqueda/{filtro}', [RutaController::class, 'filtrarRuta']);
    Route::get('rutas/incidencias/{ruta}',[RutaController::class, 'getIncidenciasPorRuta']);
    
    // API FOTOS_RUTA
    Route::apiResource('fotos-ruta', FotosRutaController::class, ['parameters' => ['fotos-ruta' => 'fotos']]);
    
    // API HISTORICO
    Route::apiResource('historico', HistoricoController::class);
    
    // API INCIDENCIAS
    Route::apiResource('incidencias', IncidenciaController::class);


//RUTAS PRIVADAS

Route::group(['middleware' => 'auth:sanctum'],function(){
    
    //Logout
    Route::post('logout',[AuthController::class,'logout']);
    
});
