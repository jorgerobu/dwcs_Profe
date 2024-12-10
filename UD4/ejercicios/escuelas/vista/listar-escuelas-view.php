<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escuelas</title>
</head>
<body>
    <!-- AQUI EL HEADER -->
     <fieldset>
        <form action="" method="POST">
        <label for="municipio">Municipio</label>
        <select id="municipio" name="municipio">
            <?php
                foreach($data['municipios'] as $m){
                    echo '<option value="'.$m->getCodigo().'">';
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
        <th>
            <td>Nombre</td>
            <td>Dirección</td>
            <td>Apertura</td>
            <td>Cierre</td>
            <td>Comedor</td>
            <td>Municipio</td>
            <td>Acciones</td>
        </th>
        <?php
            foreach($data['escuelas'] as $esc){
                echo '<tr>';
                echo '<td>'.$esc->getNombre().'</td>';
                echo '<td>'.$esc->getDireccion().'</td>';
                echo '<td>'.$esc->getHora_apertura().'</td>';
                echo '<td>'.$esc->getHora_cierre().'</td>';
                echo '<td><img src="img/'.$esc->getComedor()?"comedor-icon.png":"no-comedor-icon.png".'"></td>';
                echo '<td>'.$esc->getMunicipio()->getNombre().'</td>';
                echo '<td></td>';
                echo '</tr>';
            }
        ?>
     </table>
    <!-- AQUI EL FOOTER -->
</body>
</html>