<?php

/**
 * @author Iván Sola Martí
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Http\Responses\ApiResponse;
use App\Models\Ruta;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;


class RutaController extends Controller
{
   
    
    /**
     * The index function retrieves a list of routes, converts the time field to JSON format, and
     * returns a success response with the list of routes.
     * 
     * @return an API response with a success status code (200) and a message "Lista de rutas". The
     * data being returned is the list of routes () after modifying the "tiempo" field to JSON
     * format using the setSecondsToTime() function.
     */
    public function index()
    {
        try {
            $rutas = Ruta::all();

            // Set time field to JSON format
            foreach($rutas as $tiempo) {
                $tiempo['tiempo'] = $this->setSecondsToTime($tiempo['tiempo']);
            }

            return ApiResponse::success($rutas,200);
        } catch(Exception $e) {
            return ApiResponse::error('Ocurrió un error: '.$e->getMessage(), 500);
        } 
    }

    
    //public function create(){}

    
   
    /**
     * The above function is a PHP code snippet that handles the storage of a route object, including
     * validation of request data, setting values for certain fields, and returning a response.
     * 
     * @param Request request The  parameter is an instance of the Request class, which
     * represents an HTTP request. It contains all the data and information about the incoming request,
     * such as the request method, headers, query parameters, form data, and uploaded files.
     * 
     * @return an API response. If the validation passes and the route is successfully created, it
     * returns a success response with a status code of 201 (Created) and the created route data in the
     * response body. If there is a validation error, it returns an error response with a status code
     * of 422 (Unprocessable Entity) and the validation errors in the response body. If there is
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'nombre' => 'required|string|unique:rutas',
                'descripcion' => 'required|string',
                'longitud' => 'required|numeric|between:1,99999999.99',
                'tiempo.horas' => 'required|numeric|between:0,9999',
                'tiempo.minutos' => 'required|numeric|between:0,60',
                'tiempo.segundos' => 'required|numeric|between:0,60',
                'ciudad' => 'required|string|min:2|max:40',
                'fecha_creada' => 'required|date_format:Y-m-d',
                'fecha_realizada' => 'required|date_format:Y-m-d|after_or_equal:'.date('Y-01-01'),
                'coordenadas' => 'required',
                'dificultad' => 'required|in:baja,media,alta',
                'foto_perfil' => 'required|image|max:2048'
            ]);
            
            // Data request
            $data = $request->all();

            // Set foto_perfil
            // En produccion habra que linkear tambien la carpeta "storage" {php artisan storage:link}
            $foto = $request->file('foto_perfil')->store('public/multimedia/fotos/perfil');
            $data['foto_perfil'] = Storage::url($foto);
    
            // Set tiempo
            $data['tiempo'] = $this->setTimeToSeconds($request->tiempo);
            
            $ruta = Ruta::create($data);
            $ruta['tiempo'] = $this->setSecondsToTime($ruta['tiempo']); // Parse to JSON

            return ApiResponse::success($ruta,201);   
           

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return ApiResponse::fail($errors ,422);
        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }

    
   /**
    * The function "show" retrieves a route with its associated users and returns it as a successful
    * API response, or returns an error if the route is not found.
    * 
    * @param string id The "id" parameter is a string that represents the unique identifier of a route.
    * It is used to retrieve a specific route from the database.
    * 
    * @return an API response. If the route is found, it returns a success response with the route
    * data. If the route is not found, it returns an error response.
    */
    public function show(string $id)
    {
        try {
            $ruta = Ruta::with('usuarios')->findOrFail($id);
            $ruta['tiempo'] = $this->setSecondsToTime($ruta['tiempo']);
            return ApiResponse::success($ruta,200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Ruta no encontrada' ,404);
        }
    }

   
    // public function edit(string $id){}

    
    /**
     * The function updates a route in a PHP application, validating the request data and handling any
     * exceptions that may occur.
     * 
     * @param Request request The  parameter is an instance of the Request class, which
     * represents an HTTP request. It contains all the data and information about the request, such as
     * the request method, headers, query parameters, form data, etc.
     * @param string id The "id" parameter is a string that represents the unique identifier of the
     * route that needs to be updated. It is used to find the specific route in the database and update
     * its information.
     * 
     * @return an API response. If the update is successful, it returns a success response with a
     * message and the updated route data. If there is a validation error, it returns an error response
     * with the validation errors. If the route is not found, it returns an error response indicating
     * that the route was not found. If there is any other exception, it returns an error response with
     * the exception
     */
    public function update(Request $request, string $id)
    {
        try {
            $ruta = Ruta::findOrFail($id);
            $request->validate([
                'nombre' => 'unique:rutas,nombre,'.$ruta->id,
                'descripcion' => 'string',
                'longitud' => 'numeric|between:1,99999999.99',
                'tiempo.horas' => 'numeric|between:0,9999',
                'tiempo.minutos' => 'numeric|between:0,60',
                'tiempo.segundos' => 'numeric|between:0,60',
                'ciudad' => 'string|min:2|max:40',
                'fecha_creada' => 'date_format:Y-m-d',
                'fecha_realizada' => 'date_format:Y-m-d|after_or_equal:'.date('Y-01-01'),
                'dificultad' => 'in:baja,media,alta',
                'foto_perfil' => 'image|mimes:jpeg,jpg,png,gif|max:2048'
            ]);

            $request['tiempo'] = $this->setTimeToSeconds($request->tiempo); // To seconds
            $ruta->update($request->all());

            $ruta['tiempo'] = $this->setSecondsToTime($ruta['tiempo']); // Parse to JSON
            return ApiResponse::success($ruta,200);    

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return ApiResponse::fail($errors ,422);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Ruta no encontrada' ,404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }

   
   /**
    * The function "destroy" deletes a record from the "Ruta" model and returns a success message if
    * the record is found and deleted, or an error message if the record is not found or an exception
    * occurs.
    * 
    * @param string id The "id" parameter is a string that represents the unique identifier of the
    * "Ruta" object that needs to be deleted.
    * 
    * @return an ApiResponse. If the Ruta is successfully deleted, it returns a success response with a
    * message "Ruta borrada con éxito" and a status code of 200. If the Ruta is not found, it returns
    * an error response with a message "Ruta no encontrada" and a status code of 404. If any other
    * exception occurs, it returns an error
    */
    public function destroy(string $id)
    {
        try {
            $ruta = Ruta::findOrFail($id);
            $ruta->delete();
            return ApiResponse::success('Ruta borrada con éxito',200);

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Ruta no encontrada',404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }

  
    /**
     * The function "ultimasRutas" retrieves the latest routes with specific fields from a database,
     * formats the time field, and returns a success response with the routes.
     * 
     * @param ruta The parameter "ruta" is the number of latest routes that you want to retrieve. It
     * determines how many routes will be returned in the response.
     * 
     * @return an API response with the message 'Últimas rutas', a status code of 200, and the latest
     * routes data in JSON format.
     */
    public function ultimasRutas($ruta) {

        try {
            $rutas = Ruta::select(
                                'nombre',
                                'descripcion',
                                'tiempo',
                                'ciudad',
                                'longitud',
                                'dificultad',
                                'foto_perfil'
                                )
                    ->latest()
                    ->take($ruta)
                    ->orderBy('fecha_creada','DESC')
                    ->get();

             // Set time field to JSON format
            foreach($rutas as $tiempo) {
                $tiempo['tiempo'] = $this->setSecondsToTime($tiempo['tiempo']);
            }
            return ApiResponse::success($rutas,200);
        } catch(Exception $e) {
            return ApiResponse::error('Ocurrió un error: '.$e->getMessage(), 500);
        }  
    }

   
    /**
     * The function "getCoordenadasRuta" retrieves the coordinates of a given route and returns a
     * success response with the route data or an error response if the route is not found or an
     * exception occurs.
     * 
     * @param ruta The parameter "ruta" is the ID of the route that you want to retrieve the
     * coordinates for.
     * 
     * @return an API response. If the route is found, it returns a success response with the route
     * data. If the route is not found, it returns an error response with a "Ruta no encontrada"
     * message and a 404 status code. If any other exception occurs, it returns an error response with
     * the exception message and a 500 status code.
     */
    public function getCoordenadasRuta($ruta) {
        try {
            $ruta = Ruta::select('coordenadas')->where('id',$ruta)->get();

            if ( count($ruta) == 0 ) {
                return ApiResponse::error('No existe la ruta',404);
            }

            $coordinadas = $ruta[0]['coordenadas']['geometry']['type']['coordinates'];
    
            return ApiResponse::success($coordinadas,200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Ruta no encontrada',404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }

   
    /**
     * The function "filtrarRuta" filters routes based on a given filter and returns the results as a
     * success response or an error response if no results are found.
     * 
     * @param filtro The parameter "filtro" is a string that represents the filter criteria for
     * searching routes. It is used to filter routes based on their name.
     * 
     * @return an ApiResponse with either a success or error message, along with a status code and the
     * filtered routes.
     */
    public function filtrarRuta($filtro) {
        try {
            $ruta = Ruta::where('nombre','like','%'.$filtro.'%')->get();
            if (count($ruta) == 0) {
                return ApiResponse::error('No se encontraron resultados' ,404);
            }
            return ApiResponse::success($ruta,200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('No se encontraron resultados' ,404);
        }
    }

   
    /**
     * The setTimeToSeconds function converts a time object into the total number of seconds.
     * 
     * @param time The parameter "time" is expected to be an object with properties "horas" (hours),
     * "minutos" (minutes), and "segundos" (seconds).
     * 
     * @return the total number of seconds represented by the given time.
     */
    private function setTimeToSeconds($time) {
        $time = json_decode(json_encode($time));
        $segundos = function ($time) {
            $time->horas *= 3600;
            $time->minutos *= 60;
            return $time->horas + $time->minutos + $time->segundos;
        };
        return $segundos($time);
    }

    
   /**
    * The function "setSecondsToTime" takes a time in seconds and returns an array with the hours,
    * minutes, and seconds.
    * 
    * @param time The parameter "time" represents the total number of seconds.
    * 
    * @return an array with three elements: "horas" (hours), "minutos" (minutes), and "segundos"
    * (seconds).
    */
    private function setSecondsToTime($time) {
        $horas = floor($time/3600);
        $minutos = floor(($time-($horas*3600))/60);
        $segundos = $time-($horas*3600)-($minutos*60);
        
        return [
            "horas" => $horas,
            "minutos" => $minutos,
            "segundos" => $segundos
        ];  
    }
}
