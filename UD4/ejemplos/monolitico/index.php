<?php
// Conectamos con la base de datos
$db = new PDO('mysql:host=mariadb; dbname=articulos', 'root', 'bitnami');
//Lanzamos una consulta para recuperar los artículos que haya en la BD
$res = $db->query('SELECT fecha, titulo FROM articulo');
?>
<!-- Generamos una tabla HTML con el resultado de la consulta -->
<h1>Listado de Artículos</h1>
<table>
    <tr>
        <th>Fecha</th>
        <th>Titulo</th>
    </tr>
    <?php
    // Recorremos fila a fila el resultado de la consulta
    while ($row = $res->fetch()) {
        echo "<tr>";
        echo "<td> " . $row['fecha'] . " </td>";
        echo "<td> " . $row['titulo'] . " </td>";
        echo "</tr>";
    }
    echo "</table>";
    // Cerramos la conexión con la BD
    $db = null;
    ?>