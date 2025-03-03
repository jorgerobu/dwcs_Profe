<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokens</title>
</head>

<body>
    <?php include("header.html"); ?>
    <h1>Lista de tokens</h1>
    <h2>
        <?php echo $data['datos_usr']; ?>
    </h2>
    <form action="?controller=token&action=addToken" method="post">
        <table class="endpoints">
            <tr>
                <th>Endpoint</th>
                <th>GET</th>
                <th>POST</th>
                <th>PUT</th>
                <th>DELETE</th>
            </tr>
            <?php
            foreach ($data['endpoints'] as $endpoint) {
                echo "<tr>";
                echo "<td>" . $endpoint->uri . "</td>";
                //GET
                echo "<td>";
                echo '<input type="checkbox" name="' . $endpoint->id . '[]" value="' . $data['GET'] . '"';
                echo "</td>";
                //POST
                echo "<td>";
                echo '<input type="checkbox" name="' . $endpoint->id . '[]" value="' . $data['POST'] . '"';
                echo "</td>";
                //PUT
                echo "<td>";
                echo '<input type="checkbox" name="' . $endpoint->id . '[]" value="' . $data['PUT'] . '"';
                echo "</td>";
                //DELETE
                echo "<td>";
                echo '<input type="checkbox" name="' . $endpoint->id . '[]" value="' . $data['DELETE'] . '"';
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <button type="submit">Nuevo token</button>
    </form>
</body>

</html>