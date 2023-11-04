@extends('layouts.app')

@section('title', 'Login Usuario')

@section('content')
    <h1 class="h-2 text-center m-4">Login</h1>
    <form class="w-50 m-auto" action="{{route('usuarios.loginUser')}}" method="POST">
        
        @csrf

        <div class="m-3">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" type="text" name="username" id="">
        </div>
        <div class="m-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="m-3 d-flex align-items-center justify-content-center">
            <button type="submit" class="btn btn-primary">Login in</button>
        </div>
    </form>
   
    @if(isset($usuario) and isset($request))
        @if (count($usuario) == 0)
            <div class="d-flex justify-content-center align-items-center">Username "{{$request->username}}" o contraseña incorrectas.</div>
        @endif
    @endif

@endsection

    