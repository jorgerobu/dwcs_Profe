<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>

<body>
    <a href="index.php">Seguir comprando</a>
    <h1>Productos en el carrito</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
        </tr>
        <?php
        if (isset($_COOKIE['carrito'])) {
            $id_carro = intval($_COOKIE['carrito']);
            include('funciones.php');
            $prods = get_productos_carrito($id_carro);
            foreach ($prods as $p) {
                echo '<tr>';
                echo '<td>' . $p->getNombre() . '</td>';
                echo '<td>' . $p->getDescripcion() . '</td>';
                echo '<td>' . $p->getPrecio() . '</td>';
                echo '</tr>';
            }
        }
        ?>
    </table>
</body>

</html>