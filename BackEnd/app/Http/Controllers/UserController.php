<?php

namespace App\Http\Controllers;

use App\Models\User;

use Exception;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UserController extends Controller
{
   
    /**
     * The index function retrieves a list of users and returns a success response with the list or an
     * error response if an exception occurs.
     * 
     * @return an API response. If the try block is successful, it will return a success response with
     * a message "Lista de usuarios", a status code of 200, and the list of users. If an exception
     * occurs, it will return an error response with a message "Ocurrió un error: " followed by the
     * error message, and a status code of 500.
     */
    public function index()
    {
        try {
            $usuarios = User::all();
            return ApiResponse::success($usuarios, 200);
        } catch(Exception $e) {
            return ApiResponse::error('Ocurrió un error: '.$e->getMessage(), 500);
        } 
    }

    public function selectIdUser($email)
    {
        try {
            $idUser = User::select('id')->where('email',$email)->get();
            return ApiResponse::success($idUser, 200);
        } catch(Exception $e) {
            return ApiResponse::error('Ocurrió un error: '.$e->getMessage(), 500);
        } 
    }


    
    /**
     * The function "show" retrieves a user by their ID and returns a success response with the user
     * data, or an error response if the user is not found.
     * 
     * @param id The parameter "id" is the unique identifier of the user that we want to retrieve from
     * the database.
     * 
     * @return an API response. If the user is found, it returns a success response with the message
     * "Usuario obtenido con éxito", the status code 200, and the user object. If the user is not
     * found, it returns an error response with the message "Usuario no encontrado" and the status code
     * 404.
     */
    public function show($id)
    {
        try {
            $usuario = User::findOrFail($id);
            return ApiResponse::success($usuario, 200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Usuario no encontrado' ,404);
        }
    }

    
   /**
    * The function updates a user record in the database with the provided request data, and returns a
    * success response if the update is successful, or an error response if there are validation
    * errors, the user is not found, or there is an unexpected error.
    * 
    * @param Request request The  parameter is an instance of the Request class, which
    * represents an HTTP request. It contains all the data and information about the request, such as
    * the request method, headers, and input data.
    * @param id The  parameter is the unique identifier of the user that needs to be updated. It is
    * used to find the user record in the database and update its information.
    * 
    * @return an API response. If the update is successful, it returns a success response with a
    * message and the updated user data. If there is a validation error, it returns an error response
    * with the validation errors. If the user is not found, it returns an error response indicating
    * that the user was not found. If there is any other exception, it returns an error response with
    * the exception
    */
    public function update(Request $request, $id)
    {
        try {
            $usuario = User::findOrFail($id);
            $request->validate([
                'username' =>'string',
                'email' => 'unique:users,email,'.$usuario->id,
                // 'nombre'=>'string|nullable',
                // 'apellidos'=>'string|nullable',
                // 'edad'=>'integer|nullable',
            ]);

            $usuario->update($request->all());

            return ApiResponse::success($usuario,200);    

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return ApiResponse::fail(422, $errors);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Usuario no encontrado' ,404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }

    
    /**
     * The function "destroy" deletes a user with the given ID and returns a success message if the
     * user is found and deleted, or an error message if the user is not found or if there is an
     * exception.
     * 
     * @param id The parameter "id" is the unique identifier of the user that needs to be deleted from
     * the database.
     * 
     * @return an API response. If the user is found and successfully deleted, it returns a success
     * response with a message "Usuario borrado con éxito" and a status code of 200. If the user is not
     * found, it returns an error response with a message "Usuario no encontrado" and a status code of
     * 404. If any other exception occurs, it returns an error response with
     */
    public function destroy($id)
    {
        try {
            $usuario = User::findOrFail($id);
            $usuario->delete();
            return ApiResponse::success('Usuario borrado con éxito',200);

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Usuario no encontrado',404);

        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }

    /**
     * The function "rutasPorUsuario" retrieves a user's routes and returns them along with the user's
     * username and email in a JSON response.
     * 
     * @param id The parameter "id" is the identifier of the user for whom we want to retrieve the
     * routes. It is used to query the database and find the user with the corresponding ID.
     * 
     * @return an API response. If the user is found, it returns a success response with the user's
     * username, email, and routes. If the user is not found, it returns an error response indicating
     * that the user was not found. If any other exception occurs, it returns an error response with
     * the specific error message.
     */
    public function rutasPorUsuario($id) {
        try {
            $usuarios = User::with('usuarios')->findOrFail($id);

            if ( count($usuarios['usuarios']) == 0 ) {
                return ApiResponse::error('El usuario no tiene rutas',404);
            }

            $usuarios = [
                "username" => $usuarios->username,
                "email" => $usuarios->email,
                "rutas" => $usuarios->usuarios
            ];
                
            return ApiResponse::success($usuarios,200);

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Usuario no encontrado',404);

        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }
}
