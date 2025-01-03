<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=STYLE_PATH.'style.css'?>" rel="stylesheet">
    <title>Escuelas</title>

    <?php
        if(isset($data['eliminar'])){
            $alerta_matriculas = $data['eliminar']['matriculas']>0?'Se perderán las '.$data['eliminar']['matriculas'].' matrículas de alumnos asociadas. ':'';
            echo "<script> res =confirm('Está a punto de eliminar la escuela \"".$data['eliminar']['escuela']->getNombre()."\". ".$alerta_matriculas."¿Desea continuar?');
            if(res){
                window.location.href = '?controller=EscuelaController&action=eliminar_escuela';
            }
            </script>";
        }
    ?>
</head>

<body>
    <!-- AQUI EL HEADER -->
    <fieldset>
        <form action="?controller=escuela-controller&action=listar-escuelas" method="POST">
            <label for="municipio">Municipio</label>
            <select id="municipio" name="municipio">
                <option value="">Todos los municipios</option>
                <?php
                foreach ($data['municipios'] as $m) {
                    echo '<option value="' . $m->getCodigo() .'" '.($m->getCodigo()==$data['filter_municipio']?'selected ':''). '>';
                    echo $m->getNombre();
                    echo '</option>';
                }
                ?>
            </select>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value=<?= $data['filter_nombre'] ?>>
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
            echo '<td><a href="?controller=EscuelaController&action=baja_escuela&cod_escuela='.$esc->getCodigo().'">Eliminar</a></td>';
            echo '</tr>';
        }
        ?>
    </table>
    <!-- AQUI EL FOOTER -->
</body>

</html>