@extends('layouts.app')

@section('title', 'Lista de usuarios')

@section('content')

<h1 class="h-2 text-center m-4">Lista Usuarios</h1>

    <div class="container">
        <div class="col-8 m-auto d-flex flex-column justify-content-center">
            @if (sizeof($usuarios) == 0)
                <p class="p-4">No hay usuarios</p>    
            @else
            <ul class="m-3 list-group">
                @foreach ($usuarios as $user) 
                    <li class="text-center list-group-item">
                        <a href="{{route('usuarios.show',$user->id)}}">{{$user->id}}. {{$user->username}}</a>
                    </li>
                @endforeach
            </ul>
            @endif
            <a class="w-25 m-auto btn btn-primary" href="{{route('usuarios.index')}}">Volver</a>
        </div>
    </div>
@endsection