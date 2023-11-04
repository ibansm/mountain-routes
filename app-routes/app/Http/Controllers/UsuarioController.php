<?php

namespace App\Http\Controllers;

use App\Models\Usuario;

use Exception;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;



class UsuarioController extends Controller
{
   
    public function index()
    {
        try {
            $usuarios = Usuario::all();
            return ApiResponse::success('Lista de usuarios',200,$usuarios);
        } catch(Exception $e) {
            return ApiResponse::error('Ocurrió un error: '.$e->getMessage(), 500);
        };
        
    }

   
    // public function create()
    // {
        
    // }

  
    public function store(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|unique:usuarios',
                'nombre' => 'required',
                'apellidos' => 'required',
                'email' => 'required|unique:usuarios',
                'edad' => 'numeric|between:10,99',
                'password' => 'required'
            ]);

            $usuario = Usuario::create($request->all());

            return ApiResponse::success('Usuario creado correctamente',201,$usuario);    

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return ApiResponse::error('Error de validación' ,422, $errors);
        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }

    
    public function show($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            return ApiResponse::success('Usuario obtenido con éxito',200,$usuario);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Usuario no encontrado' ,404);
        }
    }

    
    // public function edit(Usuario $usuario)
    // {
    // }

    
    public function update(Request $request, $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            $request->validate([
                'username' => 'required|unique:usuarios,username,'.$usuario->id,
                'nombre' => 'required',
                'apellidos' => 'required',
                'email' => 'required|unique:usuarios,email,'.$usuario->id,
                'edad' => 'numeric|between:10,99',
                'password' => 'required'
            ]);

            $usuario->update($request->all());

            return ApiResponse::success('Usuario actualizado correctamente',200,$usuario);    

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return ApiResponse::error('Error de validación' ,422, $errors);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Usuario no encontrado' ,404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }

    
    public function destroy($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();
            return ApiResponse::success('Usuario borrado con éxito',200);

        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Usuario no encontrado',404);

        } catch (Exception $e) {
            return ApiResponse::error('Error: '.$e->getMessage() ,500);
        }
    }
}
