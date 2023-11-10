@extends('layouts.app')

@section('title', 'Gestión de usuarios')

@section('content')
    @isset($usuario)
            @foreach ($usuario as $user)
            <div class="text-white bg-success d-flex justify-content-end p-4">Kaixo, {{ucfirst($user->nombre)}}</></div>
            @endforeach
    @endisset
    <h1 class="h-2 text-center m-4">Gestión Usuarios</h1>

    
        
    <div class="container d-flex justify-content-center align-items-center flex-column">
       
        <div class="row">
            <div class="col">
                <a class="m-3 btn btn-success" href="{{route('auth.login')}}">Log-in</a>
                <a class="m-3 btn btn-primary" href="{{route('usuarios.listAll')}}">Ver usuarios</a>
                <a class="m-3 btn btn-dark" href="{{route('auth.register')}}">Sign-in</a>
            </div>
        </div>
    </div>
@endsection