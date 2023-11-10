@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <h1 class="h-2 text-center m-4">Página principal</h1>

    <div class="mt-5 container d-flex justify-content-center align-items-center flex-column">
        <h5 class="m-4">Ongi Etorri - Mountain Routes</h5>
        <div class="row">
            <div class="col">
                <a class="text-white m-3 btn btn-primary" href="{{route('auth.login')}}">Log-in</a>
                <a class="text-white m-3 btn btn-danger" href="{{route('usuarios.index')}}">Ver usuarios</a>
                <a class="text-white m-3 btn btn-success" href="{{route('rutas.index')}}">Ver rutas</a>
                <a class="text-white m-3 btn btn-warning" href="{{route('auth.register')}}">Sign-in</a>
            </div>
        </div>
    </div> 

@endsection
