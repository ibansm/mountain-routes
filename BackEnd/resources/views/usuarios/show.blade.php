@extends('layouts.app')

@section('title', 'Mostrar Usuario')

@section('content')
<h1 class="h-2 text-center m-4">Mostrar Usuarios</h1>

    <div class="container m-auto d-flex flex-column align-items-center justify-content-center">
        <div class="row text-center">
            <div class="col-12">
                <h5 class="text-center pt-4">Usuario registrado</h5>
                <ul class="d-flex w-75 m-auto p-3 list-group list-group-horizontal">
                    <li class="list-group-item">USERNAME=> {{$usuario->username}}</li>
                    <li class="list-group-item">EMAIL=> {{$usuario->email}}</li>
                </ul>
            </div>
        <div class="row text-center">
            <div class="col-12">
                <form class="d-flex align-items-center justify-content-around m-auto" action="{{route('usuarios.destroy', $usuario)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <a class="btn btn-primary" href="{{route('usuarios.listAll')}}">Volver</a>
                    <a class="btn btn-success" href="{{route('usuarios.edit', $usuario)}}">Editar</a>
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection