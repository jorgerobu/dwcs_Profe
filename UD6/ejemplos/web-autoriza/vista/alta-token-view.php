<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo PATH_ROOT;?>vista/style/styles.css" rel="stylesheet">
    <title>Tokens</title>
</head>

<body>
    <?php include("header.html"); ?>
    <h1>Lista de tokens</h1>
    <h2>
        <?php echo $data['datos_usr']; ?>
    </h2>
    <form action="?controller=token&action=addToken" method="post">
        <fieldset>
            <label for="caducidad">Válido hasta</label>
            <input id="caducidad" name="caducidad" type="date" required>
        </fieldset>
        <table class="endpoints">
            <tr>
                <th>Endpoint</th>
                <?php
                foreach ($data['permisos'] as $permiso) {
                    echo '<th>' . $permiso->nombre . '</th>';
                }
                ?>
            </tr>
            <?php
            foreach ($data['endpoints'] as $endpoint) {
                echo "<tr>";
                echo "<td>" . $endpoint->uri . "</td>";
                foreach ($data['permisos'] as $permiso) {
                    echo "<td>";
                    echo '<input type="checkbox" name="' . $endpoint->id . '[]" value="' . $permiso->id . '"';
                    echo "</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
        <button type="submit">Nuevo token</button>
    </form>
</body>

</html>