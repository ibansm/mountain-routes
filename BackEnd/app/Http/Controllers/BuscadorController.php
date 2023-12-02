<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Ruta;

class BuscadorController extends Controller
{

    public function getCiudades(){

        $ciudades = Ruta::select('ciudad')
        ->distinct()
        ->get();
        return ApiResponse::success($ciudades,200);

    }

    public function getDificultad(){

        $dificultad = Ruta::select('dificultad')
        ->distinct()
        ->get();
        return ApiResponse::success($dificultad,200);

    }
}
