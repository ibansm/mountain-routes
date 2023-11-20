<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    
    //Registrarse
    public function registrarse(Request $request){

        $validator = Validator::make($request->all(), [
            'username' =>'required|string',
            'email' => 'required|email',
            'password' =>'required',
            'nombre'=>'string|nullable',
            'apellidos'=>'string|nullable',
            'edad'=>'integer|nullable',

        ]);
   
        if($validator->fails()){

            return ApiResponse::fail(['data' => $validator->errors()],422);
        }
   
        $usuario = User::create([
            
             'username' =>$request->username,
             'email' =>$request->email,
             'password'=> Hash::make($request->password),
             'nombre' =>$request->nombre,
             'apellidos' =>$request->apellidos,
             'edad' =>$request->edad,
            
        ]);

        $token =  $usuario->createToken('apiToken')->plainTextToken; 
         
        return ApiResponse::success(['usuario' =>$usuario,'acess_token'=>$token,'token_type'=>'Bearer'],200);
    

    }

    //Login
    public function login(Request $request){
    
         $validator = Validator::make($request->all(), [
             'email' => 'required|email',
             'password' => 'required',
        ]);
   
         if($validator->fails()){

            return ApiResponse::fail(['data' => $validator->errors()],422);
         }
   
        if(Auth::attempt($request->all())){

            $usuario = Auth::user(); 
       
            $token = $request->user()->createToken('apiToken')->plainTextToken;  
            return ApiResponse::success(['access_token'=>$token,'token_type'=>'Bearer'],200);
          

        }
        return ApiResponse::fail(['data'=>'email o contraseña incorrecto.'],401);

  
    }

    //Logout
    public function logout(){
    
        $usuario = Auth::user();

        if ($usuario instanceof \App\Models\User) {
            $usuario->tokens()->delete();
        
            return ApiResponse::success(['data' => 'Usuario ha cerrado sesion correctamente.'],200);
        }
    }
}
