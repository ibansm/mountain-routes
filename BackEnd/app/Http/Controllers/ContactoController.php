<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use App\Models\Contacto;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactoController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string',
                'email' => 'required|email',
                'mensaje' => 'required|string'
            ]);

            $mensaje = Contacto::create($request->all());
            return ApiResponse::success("Mensaje enviado correctamente",200);       

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->toArray();
            return ApiResponse::fail($errors ,422);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage() ,500);
        }
    }
}
