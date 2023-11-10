<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Index - Gestión Rutas</title>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center flex-column">
        <h2 class="m-4">Gestión de Rutas</h2>
        <div class="row">
            <div class="col">
                <a class="m-3 btn btn-info" href="{{route('usuarios.login')}}">Log-in</a>
                <a class="m-3 btn btn-info" href="">Ver rutas</a>
                <a class="m-3 btn btn-info" href="{{route('usuarios.register')}}">Sign-in</a>
            </div>
        </div>
    </div>
    
</body>
</html>