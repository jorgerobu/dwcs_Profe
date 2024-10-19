<?php
//Conexion con la base de datos
$cadenaConexion = 'mysql:host=mariadb;dbname=mi_base_de_datos';
$db = new PDO($cadenaConexion, 'usuarioBD', 'abc123');

//Si venimos de agregar un cliente tenemos que insertarlo.
if (isset($_POST['cliente']) && isset($_POST['telf'])) {
    // Conectamos con el servidor y abrimos la BD
    $nombre = $_POST['cliente'];
    $telefono = $_POST['telf'];
    // Insertamos un registro en una tabla (aquí se podría escribir cualquier sentencia SQL válida)
    $filasAfectadas = $db->exec("INSERT INTO clientes (nombre,telefono) VALUES ('$nombre','$telefono')");
    if ($filasAfectadas == 1) {

        echo "<script>alert('Cliente agregado!');</script>";
    } else {
        die("Error en la conexion : " . $db->errorInfo());
    }
}
//Obtenemos la página actual. Si es la primera vez la página será 0.
$pag = $_GET['pag'] ?: 0;
//Calculamos el offset para excluir las 3 consultas anteriores.
$offset = $pag*3;
//Ejecutamos la consulta SQL. En el sql limitamos los resultados desde pag hasta 3.
$result = $db->query("SELECT * FROM clientes ORDER BY nombre LIMIT 3 OFFSET $offset");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginación de bases de datos</title>
</head>

<body>
    <h1>Agregar clientes a la base de datos</h1>
    <fieldset>
        <form action="" method="post">
            <label for="cliente">Nombre</label>
            <input type="text" name="cliente" required>
            <label for="telf">Teléfono</label>
            <input type="text" name="telf" required>
            <button type="submit">Agregar</button>
        </form>
    </fieldset>
    <h1>Tabla paginada</h1>
    <fieldset>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
            </tr>
            <?php
            //Mostramos los registros de SELECT. Esta vez con un foreach.
            $hayElementos = false;
            foreach ($result as $registro) {
                echo '<tr><td>' . $registro["nombre"] . '</td>';
                echo '<td>' . $registro["telefono"] . '</td></tr>';
                $hayElementos = true;
            }
            //Liberamos los recursos utilizados por el cursor ($result)
            $result->closeCursor();
            //Se cierra la conexion
            $db = null;
            ?>

            <!-- Paginacion -->
            <tr>
                <?php
                echo "<td>";
                //No mostramos el enlace a anterior si estamos en la primera página.
                if ($pag > 0) {
                    $prev = $pag - 1;
                    echo "<a href=?pag=$prev>Anterior</a>";
                }
                echo "</td>";
                $next = $pag + 1;
                if($hayElementos){
                    echo "<td><a href=?pag=$next>Siguiente</a></td>";
                }
                    
                ?>
            </tr>
        </table>

    </fieldset>
</body>

</html>