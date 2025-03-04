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
    <?php if (count($data['tokens']) == 0): ?>
        No hay tokens registrados
    <?php else: ?>
        <table>
            <tr>
                <th>Token</th>
                <th>Valido hasta</th>
                <?php
                foreach($data['permisos'] as $permiso){
                    echo "<th>".$permiso->nombre."</th>";
                }
                ?>
            </tr>
            <?php
            foreach ($data['tokens'] as $token) {
                echo '<tr>';
                echo '<td class="token">' . $token->token . '</td>';
                echo '<td class="caducidad">' . $token->caducidad . '</td>';
                foreach ($token->permisos as $permiso => $endpoints) {
                    echo '<td>';
                    if($endpoints!=null){
                        foreach ($endpoints as $endpoint) {
                            echo "$endpoint ";
                        }
                    }
                    
                    echo '</td>';
                }


                echo '<td class="remove_token"><a href="?controller=token&action=deleteToken&token=' . $token->token . '">X</a></td>';
                echo '</tr>';
            }
            ?>
        </table>
    <?php endif ?>
    <table>

    </table>
</body>

</html>