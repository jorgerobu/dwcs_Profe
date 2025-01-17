<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>
<body>
    <h1>Listado de clientes</h1>
    <table>
        <tr>
            <td>Nombre</td>
            <td>Apellidos</td>
            <td>Teléfono</td>
            <td>Email</td>
        </tr>
        <?php
        foreach ($data['clientes'] as $p) {
            echo '<tr>';
            echo '<td>'.$p->getNombre().'</td>';
            echo '<td>'.$p->getApellidos().'</td>';
            echo '<td>'.$p->getTelefono().'</td>';
            echo '<td>'.$p->getMail().'</td>';

            echo '</tr>';
        }

        ?>

    </table>
</body>
</html>