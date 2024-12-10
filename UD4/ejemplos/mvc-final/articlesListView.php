<?php
class ArticlesListView{
    public function show($data){
        echo "<h1>Listado de Artículos</h1>
        <table>
        <tr>
        <th>Fecha</th>
        <th>Titulo</th>
        </tr>";
   
    // Recorremos fila a fila el resultado de la consulta
    foreach($data as $row) {
        echo "<tr>";
        echo "<td> " . $row['fecha'] . " </td>";
        echo "<td> " . $row['titulo'] . " </td>";
        echo "</tr>";
    }
    echo "</table>";
    }
}