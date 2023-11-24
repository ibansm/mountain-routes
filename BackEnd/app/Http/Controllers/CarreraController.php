<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Http\Responses\ApiResponse;
use App\Models\Carrera;

class CarreraController extends Controller
{
    /**
     * The index function retrieves all the Carrera objects, decodes certain JSON fields, and returns a
     * success response with the Carrera objects or an error response if an exception occurs.
     * 
     * @return an API response. If the code executes successfully, it will return a success response
     * with the `` data and a status code of 200. If an exception occurs, it will return an
     * error response with the error message and a status code of 500.
     */
    public function index() 
    {
        try {
            $carreras = Carrera::all();

            // Decodificar los campos tipo JSON
            foreach ($carreras as $val) {
                $val->desniveles = json_decode($val->desniveles);
                $val->servicios = json_decode($val->servicios);
                $val->info_tecnica = json_decode($val->info_tecnica);
                $val->coordenadas = json_decode($val->coordenadas);
            }

            return ApiResponse::success($carreras,200);
        } catch(Exception $e) {
            return ApiResponse::error('Ocurrió un error: '.$e->getMessage(), 500);
        } 
    }
}
