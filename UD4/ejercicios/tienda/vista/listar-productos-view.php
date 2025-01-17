<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>

<body>
    <h1>Listado de productos</h1>
    <table>
        <tr>
            <td>Denominación</td>
            <td>Descripción</td>
            <td>Precio</td>
            <td>Cantidad</td>
        </tr>
        <?php
        foreach ($data['productos'] as $p) {
            echo '<tr>';
            echo '<td>'.$p->getNombre().'</td>';
            echo '<td>'.$p->getDescripcion().'</td>';
            echo '<td>'.$p->getPrecio().'</td>';
            echo '<td>'.$p->getCantidad().'</td>';

            echo '</tr>';
        }

        ?>

    </table>
</body>

</html>