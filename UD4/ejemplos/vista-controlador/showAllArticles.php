<!-- Esto es la vista -->
<h1>Listado de Artículos</h1>
<table>
    <tr>
        <th>Fecha</th>
        <th>Titulo</th>
    </tr>
    <?php
    // Recorremos fila a fila el resultado de la consulta
    foreach($articles as $row) {
        echo "<tr>";
        echo "<td> " . $row['fecha'] . " </td>";
        echo "<td> " . $row['titulo'] . " </td>";
        echo "</tr>";
    }
    echo "</table>";