<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=STYLE_PATH.'style.css'?>" rel="stylesheet">
    <title>Escuelas</title>
</head>

<body>
    <!-- AQUI EL HEADER -->
    <fieldset>
        <form action="" method="POST">
            <label for="municipio">Municipio</label>
            <select id="municipio" name="municipio">
                <?php
                foreach ($data['municipios'] as $m) {
                    echo '<option value="' . $m->getCodigo() . '">';
                    echo $m->getNombre();
                    echo '</option>';
                }
                ?>
            </select>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre">
            <button type="submit">Buscar</button>
        </form>
    </fieldset>
    <table>
        <tr>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Apertura</th>
        <th>Cierre</th>
        <th>Comedor</th>
        <th>Municipio</th>
        <th>Acciones</th>
        </tr>
        <?php
        foreach ($data['escuelas'] as $esc) {
            echo '<tr>';
            echo '<td style="text-align:left;">' . $esc->getNombre() . '</td>';
            echo '<td style="text-align:left;">' . $esc->getDireccion() . '</td>';
            echo '<td>' . $esc->getHora_apertura() . '</td>';
            echo '<td>' . $esc->getHora_cierre() . '</td>';
            echo '<td><img class="list-icon" src="' .IMG_PATH. ($esc->getComedor() ? "comedor-icon.png" : "no-comedor-icon.png") . '"/></td>';
            echo '<td>' . $esc->getMunicipio()->getNombre() . '</td>';
            echo '<td></td>';
            echo '</tr>';
        }
        ?>
    </table>
    <!-- AQUI EL FOOTER -->
</body>

</html>