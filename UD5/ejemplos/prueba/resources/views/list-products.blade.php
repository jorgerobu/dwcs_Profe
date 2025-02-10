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
    <h1>Productos</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
        </tr>

        @foreach($products as $p)
            <tr>
                <td>{{$p->nombre}}</td>
                <td>{{$p->descripcion}}</td>
                <td>{{$p->precio}}</td>
                <td>{{$p->stock}}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>