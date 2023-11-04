<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Página de Login</title>
</head>
<body>
    <h1 class="bg-info text-center p-4">Registro de Usuario</h1>

    <form class="w-50 m-auto" action="{{route('usuarios.store')}}" method="POST">
        
        @csrf

        <div class="m-3">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" type="text" name="username" id="">
        </div>
        <div class="m-3">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" type="text" name="nombre" id="">
        </div>
        <div class="m-3">
            <label class="form-label" for="apellidos">Apellidos</label>
            <input class="form-control" type="text" name="apellidos" id="">
        </div>
        <div class="m-3">
            <label class="form-label" for="email">E-mail</label>
            <input class="form-control" type="email" name="email" id="" aria-describedby="emailHelp">
        </div>
        <div class="m-3">
            <label class="form-label" for="edad">Edad</label>
            <input class="form-control" min="12" max="99" type="number" name="edad" id="edad" placeholder="12">
        </div>
        <div class="m-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="m-3 d-flex align-items-center justify-content-center">
            <a class="m-5 btn btn-primary" href="{{route('usuarios.index')}}">Volver</a>
            <button type="submit" class="text-white btn btn-success">Enviar</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>