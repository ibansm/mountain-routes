<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use App\Models\Ruta;
use App\Http\Responses\ApiResponse;
use App\Models\Historico;
use App\Models\Incidencia;

class IncidenciaController extends Controller
{
    
   /**
    * The index function retrieves all incidencias and groups them by historicos_id, then returns a
    * success response with the incidencias.
    * 
    * @return an API response with the success status code 200 and the data of the incidencias grouped
    * by historicos_id.
    */
    public function index()
    {
        try {
            $incidencias = Incidencia::all()->groupBy('historicos_id'); 

            return ApiResponse::success($incidencias,200);
        } catch(Exception $e) {
            return ApiResponse::error('Ocurrió un error: '.$e->getMessage(), 500);
        }
    }

   
    // public function create(){}

  
   
    /**
     * The function "store" in PHP validates and stores an incident with its type, description,
     * coordinates, state, and route ID.
     * 
     * @param Request request The  parameter is an instance of the Request class, which
     * represents an HTTP request. It contains all the data and information about the incoming request,
     * such as the request method, headers, query parameters, form data, and more.
     * 
     * @return an API response. If the validation passes and the incidencia is successfully created, it
     * returns a success response with the created incidencia and a status code of 201. If there is a
     * validation error, it returns a fail response with the validation errors and a status code of
     * 422. If there is any other exception, it returns an error response with the exception message
     * and a
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tipo' => 'required|in:arbol,derrumbe,piedra,estado_fuente,hundimiento',
                'descripcion' => 'required|string',
                'coordenada' => 'required|array|min:2',
                'coordenada.*' => 'required|numeric|between:-99999999,9999999.9999999',
                'estado' => 'boolean',
                'rutas_id' => 'required|integer'
            ]);

            $incidencia = new Incidencia();
            $request['coordenada'] = json_encode($request->coordenada);
            $historico_id = $this->setHistoricoToIncidencia($request->rutas_id);

            $resul = $incidencia->create([
                'tipo' => $request->tipo,
                'descripcion' => $request->descripcion,
                'coordenada' => $request->coordenada,
                'historicos_id' => $historico_id,
                'rutas_id' => $request->rutas_id
                ]);

            return ApiResponse::success($resul,201);   
           

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return ApiResponse::fail($errors ,422);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage() ,500);
        }
    }

   
    /**
     * The function retrieves a historical record and its associated incidents, and returns them as a
     * response.
     * 
     * @param string id The "id" parameter is a string that represents the ID of the historical record
     * that you want to retrieve.
     * 
     * @return an API response. If the specified historical record is found, it returns a success
     * response with a list of incidents associated with that historical record. If there are no
     * incidents associated with the historical record, it returns a success response with a message
     * indicating that there are no incidents. If the historical record is not found, it returns an
     * error response indicating that the historical record does not exist.
     */
    public function show(string $id)
    {
        try {
            $incidencias = Incidencia::with('historicos')->findOrFail($id);

            if ($incidencias == null) {
                return ApiResponse::fail('No existen incidencias vinculadas al histórico',404);
            }

  
            return ApiResponse::success($incidencias,200);

        } catch (ModelNotFoundException $e) {
            return ApiResponse::fail('No existe el histórico',404);

        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500); 
        }
    }


    // public function edit(string $id){}

  
  /**
   * The function updates an incident with the given ID using the data from the request and returns a
   * success response or an error response.
   * 
   * @param Request request The  parameter is an instance of the Request class, which
   * represents an HTTP request. It contains all the data and information about the request, such as
   * the request method, headers, query parameters, form data, etc.
   * @param string id The "id" parameter is a string that represents the unique identifier of the
   * "Ruta" object that needs to be updated.
   * 
   * @return an API response. If the update is successful, it returns a success response with the
   * updated incidence and a status code of 201. If there are validation errors, it returns a fail
   * response with the validation errors and a status code of 422. If there is any other exception, it
   * returns an error response with the error message and a status code of 500.
   */
    public function update(Request $request, string $id)
    {
        try {
            $incidencia = Incidencia::findOrFail($id);
            $request->validate([
                'descripcion' => 'string',
                'tipo' => 'in:arbol,derrumbe,piedra,estado_fuente,hundimiento',
                'coordenada' => 'array|min:2',
                'coordenada.*' => 'numeric|between:-99999999,9999999.9999999',
                'estado' => 'boolean',
            ]);
            
            $incidencia->update($request->all());

            return ApiResponse::success($incidencia,201);   
           

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return ApiResponse::fail($errors ,422);
        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }


    // public function destroy(string $id){}


    /**
     * The function "setHistoricoToIncidencia" checks if a given route ID exists in the "Incidencia"
     * table, and if not, creates a new record in the "Historico" table with the same route ID and
     * current dates.
     * 
     * @param id The parameter "id" is the ID of a route.
     * 
     * @return the value of the 'rutas_id' field from the 'Historico' table.
     */
    private function setHistoricoToIncidencia($id)
    {
        $idRuta = Incidencia::select('rutas_id')->where('rutas_id',$id)->get();

        if (sizeof($idRuta) == 0) {
            $historico = Historico::create([
                'id' => $id,
                'fecha_actualizada' => now(),
                'fecha_realizada' => now()
            ]);
            return $historico->id;
        } 
        
        return $idRuta[0]['rutas_id'];
    }
}
