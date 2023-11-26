<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Http\Responses\ApiResponse;
use App\Models\Historico;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Ruta;
use App\Models\Incidencia;

class HistoricoController extends Controller
{
   

    /**
     * The index function retrieves historical data with associated incidents and returns it as a
     * response, while the store function validates and creates a new historical record.
     * 
     * @return The `index()` function is returning a response with a success message and the
     * `` data if there are no errors. If there is an exception, it will return an error
     * message with the exception message.
     */
    public function index()
    {
        try {
            $historicos = Historico::with('incidencias')->get();

            if (sizeof($historicos) == 0) {
                return ApiResponse::success("No existen históricos", 200);
            }

            return ApiResponse::success($historicos,200);
        } catch(Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

   
    // public function create(){}

    private function store(Request $request)
    {
        try {
            $request->validate([
                'rutas_id' => 'required|integer',               
                'fecha_actualizada' => 'required|date_format:Y-m-d',
                'fecha_realizada' => 'required|date_format:Y-m-d|after_or_equal:'.date('Y-01-01')
                
            ]);


            $historico = Historico::create($request->all());
         
            return ApiResponse::success('Histórico creado correctamente',201,$historico);   

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return ApiResponse::fail($errors,422);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage() ,500);
        }
    }


    /**
     * The function retrieves and returns the historical data for a given route ID.
     * 
     * @param string id The parameter "id" is a string that represents the ID of a route. It is used to
     * find the corresponding route and its historical records.
     * 
     * @return an API response. The response can be either a success response or an error response.
     */
    public function show(string $id)
    {
        try {
             
            $findId = Ruta::findOrFail($id);
            $historico = Historico::with('incidencias')->findOrFail($id);
            
            $resul = [
                'historico' => $historico,
                'ruta' => $findId
            ];
  
            return ApiResponse::success($resul,200);

        } catch (ModelNotFoundException $e) {
            if ($e->getModel() == "App\Models\Historico") {
                return ApiResponse::error('No existe histórico asociado a la ruta',404);
            } else if ($e->getModel() == "App\Models\Ruta") {
                return ApiResponse::error('No existe la ruta',404);
            }

        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }


    // public function edit(string $id){}

 
    /**
     * This PHP function updates a historical record based on the provided request data and ID.
     * 
     * @param Request request The  parameter is an instance of the Request class, which
     * represents an HTTP request. It contains all the data and information about the request, such as
     * the request method, headers, query parameters, form data, and more.
     * @param string id The "id" parameter is a string that represents the ID of the historical record
     * that needs to be updated.
     * 
     * @return an API response. If the update is successful, it returns a success response with a
     * message, status code 201, and the updated historical record. If there is a validation error, it
     * returns an error response with a message, status code 422, and the validation errors. If there
     * is any other exception, it returns an error response with a message containing the exception
     * message and
     */
    public function update(Request $request, string $id)
    {
        try {
            $historico = Historico::findOrFail($id);

            $request->validate([  
                'rutas_id' => 'integer',              
                'fecha_actualizada' => 'date_format:Y-m-d|after_or_equal:'.now(),
                'fecha_realizada' => 'date_format:Y-m-d'  
            ]);


            $historico->update($request->all());
         
            return ApiResponse::success($historico,201);   

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return ApiResponse::fail($errors ,422);
        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }
}
