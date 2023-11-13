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

            return ApiResponse::success('Incidencias',200,$incidencias);
        } catch(Exception $e) {
            return ApiResponse::error('Ocurrió un error: '.$e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            $historico = Historico::findOrFail($id);
            $incidencias = Incidencia::where('historicos_id', $id)->get();

            if (sizeof($incidencias)==0) {
                return ApiResponse::success('No existen incidencias vinculadas al histórico',200);
            }

            $result = [
                "incidencias" => $incidencias,
                "historico" => $historico
            ];
  
            return ApiResponse::success("Lista de incidencias",200,$result);

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('No existe el histórico',404);

        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
