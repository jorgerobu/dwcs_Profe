<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta alumno</title>
</head>
<body>
    <form action="{{route('add_alumno')}}" method="post">
        @csrf
        <label for="equipo_id">Equipo</label><br>
        <select name="equipo_id" id="equipo_id">
            <option value="-1">Sin equipo</option>
            @foreach($equipos as $e)
            <option value="{{$e->id}}">{{$e->nombre}}</option>
            @endforeach
        </select><br>
        <label for="nombre">Nombre</label><br>
        <input name="nombre" id="nombre" required><br>
        <label for="dni">DNI</label><br>
        <input name="dni" id="dni" required><br>
        <label for="media">Media</label><br>
        <input name="media" id="media" ><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>