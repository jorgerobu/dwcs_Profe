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
    <h1>Alumnos</h1>
    <table>
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
            
            <th>Media</th>
            <th>Equipo</th>

        </tr>

        @foreach($alumnos as $p)
            <tr>
                <td>{{$p->dni}}</td>
                <td>{{$p->nombre}}</td>
                <td>{{$p->media}}</td>
                <td>{{$p->equipo->nombre}}</td>

                
            </tr>
        @endforeach
    </table>
</body>

</html>