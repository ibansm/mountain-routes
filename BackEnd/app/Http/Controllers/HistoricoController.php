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

            // Si no hay incidencias devolvemos en el response un 0
            foreach ($historicos as $val) {
                if (sizeof($val->incidencias) == 0) {
                    $val['incidencias'][] = 0;
                }       
            }

            return ApiResponse::success('Historico',200,$historicos);
        } catch(Exception $e) {
            return ApiResponse::error('Ocurrió un error: '.$e->getMessage(), 500);
        }
    }

   
    // public function create(){}

    public function store(Request $request)
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
            return ApiResponse::error('Error de validación' ,422, $errors);
        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
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
            $historico = Historico::with('rutas')->where('rutas_id', $id)->orderBy('fecha_actualizada','desc')->get();

            if ( count($historico) == 0 ) {
                return ApiResponse::error('No se encontró histórico de la ruta seleccionada',200);
            }

            
            $ruta = $historico[0]["rutas"];
            $historico = $this->setCollectionHistoricToRoute($historico, $ruta);
  
            return ApiResponse::success("Lista de históricos '$id'",200,$historico);

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('No existe el histórico',404);

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
                'fecha_realizada' => 'date_format:Y-m-d|after_or_equal:'.date('Y-01-01')
                
            ]);


            $historico->update($request->all());
         
            return ApiResponse::success('Histórico actualizado correctamente',201,$historico);   

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return ApiResponse::error('Error de validación' ,422, $errors);
        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }


    /**
     * The function "destroy" deletes a historical record by its ID and returns a success message if
     * the record is found and deleted, or an error message if the record is not found or an exception
     * occurs.
     * 
     * @param string id The "id" parameter is a string that represents the unique identifier of the
     * historical record that needs to be deleted.
     * 
     * @return an ApiResponse.
     */
    public function destroy(string $id)
    {
        try {
            $historico = Historico::findOrFail($id);
            $historico->delete();
            return ApiResponse::success('Histórico borrado con éxito',200);

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Histórico no encontrado',404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        } 
    }

    /**
     * The function "setCollectionHistoricToRoute" creates a collection that combines historic data
     * with route data.
     * 
     * @param historico An array of objects representing historical data.
     * @param ruta The parameter "ruta" is an object that represents a route. It has properties such as
     * "id" (route ID), "nombre" (route name), "ciudad" (city), "longitud" (length), and "dificultad"
     * (difficulty).
     * 
     * @return an array that contains the historic data and route data. The historic data is stored in
     * an array with keys "Histórico 1", "Histórico 2", etc., and each value is an array containing the
     * id, fecha_actualizada, fecha_realizada, and rutas_id properties of each historic entry. The
     * route data is stored in an array with the key
     */
    private function setCollectionHistoricToRoute($historico, $ruta) {
        $count = 1;
        $coleccion = [];

        foreach ($historico as $val) {  
            $array = [
                "id" => $val->id,
                "fecha_actualizada" => $val->fecha_actualizada,
                "fecha_realizada" => $val->fecha_realizada,
                "id ruta" => $val->rutas_id
            ];
            $coleccion["Histórico ".$count] = $array;
            $count++;
        }

        $coleccion["ruta"] = [
            "id" => $ruta->id,
            "nombre" => $ruta->nombre,
            "ciudad" => $ruta->ciudad,
            "longitud" => $ruta->longitud,
            "dificultad" => $ruta->dificultad
        ];

        return $coleccion;
    }
}
