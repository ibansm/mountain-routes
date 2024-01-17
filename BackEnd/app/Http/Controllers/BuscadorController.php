<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Ruta;

class BuscadorController extends Controller
{

    public function getCiudades(){

        $ciudades = Ruta::select('ciudad')
        ->distinct()
        ->get();
        return ApiResponse::success($ciudades,200);

    }

    public function getDificultad(){

        $dificultad = Ruta::select('dificultad')
        ->distinct()
        ->get();
        return ApiResponse::success($dificultad,200);

    }

    
    public function buscar(Request $request){

       $ciudad = $request->ciudad;
       $dificultad = $request->dificultad;
       $longitud = $request->longitud;
       $duracion = $request->duracion;
       $ninos = $request->ninos;

       $rutas = Ruta::select('nombre','descripcion','ciudad','dificultad','longitud','duracion','ninos', 'foto_perfil')
                ->where('ninos',$ninos) 
                ->when($ciudad,function($query,$ciudad){

                    $query ->where('ciudad',$ciudad); 
                
                })

                ->when($dificultad,function($query,$dificultad){

                    $query ->where('dificultad',$dificultad); 
                
                })

                ->when($longitud,function($query,$longitud){

                    switch($longitud){

                        case '1':
                            return $query ->whereBetween('longitud',[0,5]);
                        break;

                        case '2':
                            return $query ->whereBetween('longitud',[5,10]);
                        break;

                        case '3':
                            return $query ->where('longitud','>',10);
                        break;

                        
                    } 
                
                })

                ->when($duracion,function($query,$duracion){
                    
                    switch($duracion){

                        case '1':
                           
                            return $query ->whereBetween('duracion',[0,120]);
                        break;

                        case '2':
                            return $query ->whereBetween('duracion',[120,240]);
                        break;

                        case '3':
                            return $query ->whereBetween('duracion',[240,360]);
                        break;
                    }
                    
                    
                
                })

                
        
        ->get();

        if ($rutas->isEmpty($rutas)) {

            return ApiResponse::success('Lo sentimos,no hemos encontrado ninguna ruta',200);

        }else{

            return ApiResponse::success($rutas,200);
        }
       
    }
    
    
}
