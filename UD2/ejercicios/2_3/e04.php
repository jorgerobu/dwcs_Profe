<?php
include("e04_functions.php");
//Calculo de offset.
$pag = 0;
if (isset($_GET['pag']) && is_numeric($_GET['pag'])) {
    $pag = $_GET['pag'];
}

//Si nos llega un id es porque se pretende eliminar un videojuego. Ver abajo los enlaces Eliminar de la tabla.
if (isset($_GET['id'])) {
    if (eliminar_videojuego(intval($_GET['id']))) {
        echo '<script>alert("Registro eliminado");</script>';
    } else {
        echo '<script>alert("Ups! Algo ha salido mal. No se ha podido eliminar el registro.");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Videojuegos</title>
    <script>
        function confirmar_eliminar(nombre) {
            return confirm(`¿Quiere eliminar el videojuego ${nombre}?`);
        }
    </script>
</head>

<body>
    <?php include("e02_header.html");

    //Comprobamos si nos han llegado filtros. En este caso nos pueden llegar por GET o por POST
    //Para solucionarlo utilizo la variable superglobal $_REQUEST, que contiene los parámetros
    //con independencia del método HTTP empleado.

    $anio = $_REQUEST['anio'] ?: null;
    $nombre = $_REQUEST['nombre'] ?: null;
    $genero = $_REQUEST['genero'] ?: null;
    $plataforma = $_REQUEST['plataforma'] ?: null;
    ?>
    <h1>Videojuegos registrados</h1>
    <!-- Agragamos el fieldset -->
    <fieldset>
        <form class="filtros" action="?pag=<?php echo $pag; ?>" method="post">
            <input placeholder="Nombre" type="text" name="nombre" value="<?php echo $nombre; ?>"><br>
            <input placeholder="Plataforma" type="text" name="plataforma" value="<?php echo $plataforma; ?>"><br>
            <input placeholder="Año" type="number" name="anio" id="anio" value="<?php echo $anio; ?>"><br>
            <input placeholder="Genero" type="text" name="genero" value="<?php echo $genero; ?>"><br>
            <button type="submit">Buscar</button>
        </form>
    </fieldset>
    <table>
        <tr>
            <?php
            //Si el usuario ya ha introducido filtros tenemos que pasarlos por GET para que se mantengan.
            $filtros = "&nombre=$nombre&anio=$anio&plataforma=$plataforma&genero=$genero";
            ?>
            <th><a href="?order=nombre&pag=<?php echo $pag.$filtros; ?>">Nombre</a></th>
            <th><a href="?order=plat&pag=<?php echo $pag.$filtros; ?>">Plataforma</a></th>
            <th><a href="?order=anio&pag=<?php echo $pag.$filtros; ?>">Año</a></th>
            <th><a href="?order=gen&pag=<?php echo $pag.$filtros; ?>">Género</a></th>
        </tr>

        <?php
        //Obtenemos el filtro de busqueda si lo tenemos.
        $order_by = ORDER_NOMBRE;
        if (isset($_GET['order'])) {
            switch ($_GET['order']) {
                case 'anio':
                    $order_by = ORDER_ANIO;
                    break;
                case 'plat':
                    $order_by = ORDER_PLATAFORMA;
                    break;
                case 'gen':
                    $order_by = ORDER_GENERO;
                    break;
                default:
                    $order_by = ORDER_NOMBRE;
            }
        }
        $videojuegos = get_videojuegos_filtros($nombre, $plataforma, $genero, $anio, 10, $pag * 10, $order_by);

        foreach ($videojuegos as $v) {
            echo '<tr><td>' . $v->getNombre() . '</td>';
            echo '<td>' . $v->getPlataforma() . '</td>';
            echo '<td>' . $v->getAnio_lanzamiento() . '</td>';
            echo '<td>' . $v->getGenero() . '</td>';
            echo ' <td><a href="e02_altamodificacion.php?id=' . $v->getId() . '">Editar</a></td>';
            echo ' <td><a href="?id=' . $v->getId() . '&pag=' . $pag . '" onclick="return confirmar_eliminar(\'' . $v->getNombre() . '\')">Eliminar</a></td></tr>';
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