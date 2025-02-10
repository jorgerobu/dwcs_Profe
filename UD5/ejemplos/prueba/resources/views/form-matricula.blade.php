<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matricular alumnos</title>
</head>
<body>
    <h1>Matriculando alumnos en {{$materia->nombre}}</h1>
    <form action="{{route('matricular_alumnos',$materia->id)}}" method="post">
        @csrf
        @foreach($alumnos as $a)
            
            @if($a->materias->contains($materia))
                <input type="checkbox" name="id_alumnos[]" value="{{$a->id}}" checked>
            @else
                <input type="checkbox" name="id_alumnos[]" value="{{$a->id}}" >
            @endif
            <label>{{$a->nombre}} [{{$a->dni}}]</label><br>
        @endforeach
        <button type="submit">Guardar</button>
    </form>
</body>
</html>