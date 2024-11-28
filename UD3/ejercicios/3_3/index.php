<?php
    if(isset($_GET['id_prod'])){
        //Comprobar si existe la cookie.
        $id_carro = -1;
        if(isset($_COOKIE['carrito'])){
            $id_carro = intval($_COOKIE['carrito']);
        }else{
            //Crear carrito
            $id_carro = add_carrito();
        }
        //Obtener el id del carrito
        //Añadir el producto al carrito
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Carrito</th>
        </tr>
        <?php
        include('funciones.php');
        $prods = get_productos();
        foreach ($prods as $p) {
            echo '<tr>';
            echo '<td>' . $p->getNombre() . '</td>';
            echo '<td>' . $p->getDescripcion() . '</td>';
            echo '<td>' . $p->getPrecio() . '</td>';
            echo '<td> <a href="?id_prod=' .$p->getId(). '">Añadir</a></td>';
            echo '</tr>';
        }


        ?>
    </table>
</body>

</html>