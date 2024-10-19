<?php
//Conexion con la base de datos
$db = new mysqli('mariadb', 'usuarioBD', 'abc123', 'mi_base_de_datos');
// Comprobamos que la conexión se ha realizado
if ($db->connect_error) {
    die("Error en la conexion : " . $db->connect_error);
}

//Si venimos de agregar un cliente tenemos que insertarlo.
if (isset($_POST['cliente']) && isset($_POST['telf'])) {
    // Conectamos con el servidor y abrimos la BD
    $nombre = $_POST['cliente'];
    $telefono = $_POST['telf'];
    // Insertamos un registro en una tabla (aquí se podría escribir cualquier sentencia SQL válida)
    $db->query("INSERT INTO clientes (nombre,telefono) VALUES ('$nombre','$telefono')");
    echo "<script>alert('Cliente agregado!');</script>";
}

//Ejecutamos la consulta SQL
$result = $db->query("SELECT * FROM clientes");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso a BBDD</title>
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
    <fieldset>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
            </tr>
            <?php
            //Mostramos los registros de SELECT
            while ($registro = $result->fetch_array()) {
                echo '<tr><td>' . $registro["nombre"] . '</td>';
                echo '<td>' . $registro["telefono"] . '</td></tr>';
            }

            $db->close();   // Cierra la conexión con el servidor
            ?>
        </table>
    </fieldset>
</body>

</html>