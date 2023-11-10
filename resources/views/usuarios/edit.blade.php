@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<h1 class="h-2 text-center m-4">Editar Usuarios</h1>

    <form class="w-50 m-auto" action="{{route('usuarios.update', $usuario)}}" method="POST">
        
        @csrf
        @method('put')

        <div class="m-3">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" type="text" name="username" value="{{$usuario->username}}">
        </div>
        <div class="m-3">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" type="text" name="nombre" value="{{$usuario->nombre}}">
        </div>
        <div class="m-3">
            <label class="form-label" for="apellidos">Apellidos</label>
            <input class="form-control" type="text" name="apellidos" value="{{$usuario->apellidos}}">
        </div>
        <div class="m-3">
            <label class="form-label" for="email">E-mail</label>
            <input class="form-control" type="email" name="email" value="{{$usuario->email}}" aria-describedby="emailHelp">
        </div>
        <div class="m-3">
            <label class="form-label" for="edad">Edad</label>
            <input class="form-control" min="12" max="99" type="number" name="edad" value="{{$usuario->edad}}">
        </div>
        <div class="m-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="{{$usuario->password}}">
        </div>
        <div class="m-3 d-flex align-items-center justify-content-center">
            <a class="m-5 btn btn-primary" href="{{route('usuarios.index')}}">Volver</a>
            <button type="submit" class="btn btn-success">Actualizar usuario</button>
        </div>
    </form>

@endsection