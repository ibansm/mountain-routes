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

    /*
    public function buscar(Request $request){

       $ciudad = $request->ciudad;
       $dificultad = $request->dificultad;
       $longitud = $request->longitud;
       $duracion = $request->duracion;
       $ninos = $request->ninos;

       $rutas = Ruta::select('nombre','descripcion','ciudad','dificultad','longitud','duracion','ninos')
                ->where('ninos',$ninos) 
                ->when($ciudad,function($query,$ciudad){

                    $query ->where('ciudad',$ciudad); 
                
                })

                ->when($dificultad,function($query,$dificultad){

                    $query ->where('dificultad',$dificultad); 
                
                })

                ->when($longitud,function($query,$longitud){

                    switch($longitud){

                        case '5':
                            return $query ->whereBetween('longitud',[0,$longitud]);
                        break;

                        case '10':
                            return $query ->whereBetween('longitud',[5,$longitud]);
                        break;

                        //Falta el case mayor que 10
                    } 
                
                })

                ->when($duracion,function($query,$duracion){
                    
                    switch($duracion){

                        case '2':
                           
                            return $query ->whereBetween('duracion',[0,120]);
                        break;

                        case '4':
                            return $query ->whereBetween('duracion',[120,240]);
                        break;

                        case '6':
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
    
*/
    
}
