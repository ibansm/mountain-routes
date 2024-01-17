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
           
        ]);
   
        if($validator->fails()){

            return ApiResponse::fail($validator->errors(),422);
        }
   
        $usuario = User::create([
            
             'username' =>$request->username,
             'email' =>$request->email,
             'password'=> Hash::make($request->password),
            
            
        ]);

        $token =  $usuario->createToken('apiToken')->plainTextToken; 
         
        return ApiResponse::success(['usuario' =>$usuario,'access_token'=>$token,'token_type'=>'Bearer'],200);
    

    }

    //Login
    public function login(Request $request){
    
         $validator = Validator::make($request->all(), [
             'email' => 'required|email',
             'password' => 'required',
        ]);
   
         if($validator->fails()){

            return ApiResponse::fail($validator->errors(),422);
         }
   
        if(Auth::attempt($request->all())){

            $usuario = Auth::user(); 
       
            $token = $request->user()->createToken('apiToken')->plainTextToken;  
            return ApiResponse::success(['access_token'=>$token,'token_type'=>'Bearer'],200);
          

        }
        return ApiResponse::fail('Email o contraseña incorrectos.',401);

    }

    //Logout
    public function logout() {
        
        // the user() method has a return type of \Illuminate\Contracts\Auth\Authenticatable|null

        /** @var User @usuario **/
        $usuario = Auth::user();
    
        $usuario->tokens()->delete();
        return ApiResponse::success('Usuario ha cerrado sesión correctamente.',200);
        
    }
}
