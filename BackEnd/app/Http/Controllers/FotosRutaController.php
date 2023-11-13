<?php

namespace App\Http\Controllers;

use App\Models\FotosRuta;
use Illuminate\Http\Request;
use Exception;
use App\Http\Responses\ApiResponse;
use App\Models\Ruta;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class FotosRutaController extends Controller
{
    
    
   /**
    * The index function retrieves a list of photos grouped by route and returns a success response
    * with the list of photos or an error response if an exception occurs.
    * 
    * @return an API response with a success status code of 200 and a message of 'Listado de fotos'.
    * The data being returned is the variable , which is a collection of FotosRuta models grouped
    * by the 'rutas_id' attribute.
    */
    public function index()
    {
        try {
            $fotos = FotosRuta::all()->groupBy('rutas_id');

            return ApiResponse::success($fotos,200);
        } catch(Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } 
    }


   /**
    * This PHP function is used to store a photo route in a database, along with its associated data.
    * 
    * @param Request request The  parameter is an instance of the Request class, which
    * represents an HTTP request. It contains all the data and information about the incoming request,
    * such as the request method, headers, query parameters, form data, and uploaded files.
    * 
    * @return an API response. If the validation passes and the record is successfully created, it
    * returns a success response with a message, status code 201, and the created record as the data.
    * If there is a validation error, it returns an error response with a message, status code 422, and
    * the validation errors as the data. If there is any other exception, it returns an
    */
    public function store(Request $request)
    {
        try {
            $request->validate([                
                'nombre' => 'required|string|unique:fotos_ruta',
                'data' => 'required|image|max:2048',
                'coordenadas' => 'required|array|min:2',
                'coordenadas.*' => 'required|numeric|between:-99999999,9999999.9999999',
                'rutas_id' => 'required|integer'
            ]);

            // Data request
            $data = $request->all();

            $foto = $request->file('data')->store('public/multimedia/fotos/ruta');
            $data['data'] = Storage::url($foto);

            $fotos = FotosRuta::create($data);
         
            return ApiResponse::success($fotos,201);   

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return ApiResponse::fail($errors,422);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage() ,500);
        }
    }

   
    /**
     * The function retrieves and returns a list of photos associated with a specific route ID,
     * handling various error cases.
     * 
     * @param string id The "id" parameter is a string that represents the ID of a route.
     * 
     * @return an API response. If the route is found and there are photos associated with it, it will
     * return a success response with the list of photos. If no photos are found, it will return an
     * error response indicating that no photos were found. If the route is not found, it will return
     * an error response indicating that the route does not exist. If any other exception occurs, it
     */
    public function show(string $id)
    {
        try {
            $findId = Ruta::findOrFail($id);
            $fotos = FotosRuta::with('rutas')->where('rutas_id', $id)->get();

            if ( count($fotos) == 0 ) {
                return ApiResponse::fail('No se encontraron fotos',404);
            }

            
            $ruta = $fotos[0]["rutas"];
            $fotos = $this->setCollectionPhotoToRoute($fotos, $ruta);
  
            return ApiResponse::success($fotos,200);

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('No existe la ruta',404);

        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage() ,500);
        }
    }

  
    // public function edit(string $id)
    // {
    // }

 
    // public function update(Request $request, string $id)
    // { 
    // }

    
    /**
     * The function "destroy" deletes a photo with the given ID and returns a success message if the
     * photo is found and deleted, or an error message if the photo is not found or an exception
     * occurs.
     * 
     * @param string id The "id" parameter is a string that represents the unique identifier of the
     * photo that needs to be deleted.
     * 
     * @return an instance of the ApiResponse class. The success method is called with the message
     * 'Foto borrada con éxito' and the status code 200 if the foto is successfully deleted. If a
     * ModelNotFoundException is caught, the error method is called with the message 'Foto no
     * encontrada' and the status code 404. If any other exception is caught, the error method is
     * called with
     */
    public function destroy(string $id)
    {
        try {
            $foto = FotosRuta::findOrFail($id);
            $foto->delete();
            return ApiResponse::success('Foto borrada con éxito',200);

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Foto no encontrada',404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }


    /**
     * The function "setCollectionPhotoToRoute" creates a collection of photos and a route, and returns
     * the collection.
     * 
     * @param fotos An array of objects representing photos. Each photo object has properties such as
     * id, nombre (name), foto (photo data), coordenadas (coordinates), and id ruta (route id).
     * @param ruta The parameter "ruta" is an object that represents a route. It has properties such as
     * "id" (route ID), "nombre" (route name), "ciudad" (city), "longitud" (length), and "dificultad"
     * (difficulty).
     * 
     * @return an array called . This array contains multiple elements, including "Foto 1",
     * "Foto 2", etc., which are sub-arrays containing information about each photo. The sub-arrays
     * include properties such as "id", "nombre", "foto", "coordenadas", and "id ruta". Additionally,
     * the  array includes a "ruta"
     */
    private function setCollectionPhotoToRoute($fotos, $ruta) {
        $count = 1;
        $coleccion = [];

        foreach ($fotos as $foto) {  
            $array = [
                "id" => $foto->id,
                "nombre" => $foto->nombre,
                "foto" => $foto->data,
                "coordenadas" => $foto->coordenadas,
                "id ruta" => $foto->rutas_id
            ];
            $coleccion["Foto ".$count] = $array;
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

    // private function storeToMultimedia($request,$data) {
    //     // En produccion se linkeara la carpeta {php artisan storage:link}
    //     $url = [];
    //     foreach ($request->file[$data] as $val) {
    //         $foto = $val->store('public/multimedia/fotos/ruta');
    //         $url[] = Storage::url($foto);
    //     }
    //     return $url;
    // }

}
