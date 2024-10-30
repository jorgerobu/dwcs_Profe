<?php
include("e02_functions.php");
//Calculo de offset.
$pag = 0;
if (isset($_GET['pag']) && is_int($_GET['pag'])) {
    $pag = $_GET['pag'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Videojuegos</title>
</head>

<body>
    <?php include("e02_header.html"); ?>
    <h1>Videojuegos registrados</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Plataforma</th>
            <th>Año</th>
            <th>Género</th>
        </tr>

        <?php
        $videojuegos = get_videojuegos(10, $pag * 10);
        foreach ($videojuegos as $v) {
            echo '<tr><td>' . $v->getNombre() . '</td>';
            echo '<td>' . $v->getPlataforma() . '</td>';
            echo '<td>' . $v->getAnio_lanzamiento() . '</td>';
            echo '<td>' . $v->getGenero() . '</td>';
            echo ' <td><a href="altamodificacion.php?id=' . $v->getId() . '">Editar</a></td>';
            echo ' <td><a href="eliminar.php?id=' . $v->getId() . '">Eliminar</a></td></tr>';
        }
        ?>

    </table>
    <footer>
        <?php
        if ($pag > 0):
        ?>
            <a href="?pag=<?php echo $pag - 1 ?>">Anterior</a>
        <?php
        endif;
        ?>

        <?php

        if (count($videojuegos) == 10):
        ?>
            <a href="?pag=<?php echo $pag + 1 ?>">Siguiente</a>
        <?php
        endif;
        ?>

    </footer>
</body>

</html>