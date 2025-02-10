<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <title>Alta reaalizada</title>
</head>

<body>
    <h1>Nuevo usuario</h1>
    <form method="post" action="{{route('alta_usuario')}}">
        @csrf
        <label for="nombre">Nombre</label><br>
        <input type="text" id="nombre" name="nombre"><br>

        <label for="aps">Apellidos</label><br>
        <input type="text" id="aps" name="aps"><br>

        <label for="telf">Teléfono</label><br>
        <input type="tel" id="telf" name="telf"><br>
        <button type="submit">Guardar</button>
    </form>
</body>

</html>