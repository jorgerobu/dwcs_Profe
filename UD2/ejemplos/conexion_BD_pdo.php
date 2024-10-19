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

//Ejecutamos la consulta SQL
$result = $db->query("SELECT * FROM clientes");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso a BBDD PDO</title>
</head>

<body>
    <h1>Agregar clientes a la base de datos (PDO)</h1>
    <fieldset>
        <form action="" method="post">
            <label for="cliente">Nombre</label>
            <input type="text" name="cliente" required>
            <label for="telf">Teléfono</label>
            <input type="text" name="telf" required>
            <button type="submit">Agregar</button>
        </form>
    </fieldset>
    <fieldset>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
            </tr>
            <?php
            //Mostramos los registros de SELECT. Esta vez con un foreach.
            foreach ($result as $registro) {
                echo '<tr><td>' . $registro["nombre"] . '</td>';
                echo '<td>' . $registro["telefono"] . '</td></tr>';
            }
            //Liberamos los recursos utilizados por el cursor ($result)
            $result->closeCursor();
            //Se cierra la conexion
            $db = null;
            ?>
        </table>
    </fieldset>
</body>

</html>