<?php
include("funciones.php");
    if(isset($_GET['id_prod'])){
        //Comprobar si existe la cookie.
        $id_carro = -1;
        //Obtener el id del carrito
        if(isset($_COOKIE['carrito'])){
            $id_carro = intval($_COOKIE['carrito']);
        }else{
            //Crear carrito
            $id_carro = add_carrito();
            //Establecer cookie.
            setcookie("carrito",$id_carro,time()+172800);
        }
        //Añadir el producto al carrito
        add_producto($id_carro,intval($_GET['id_prod']));
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
</head>
<body>
    <h1>Productos</h1>
    <a href="carrito.php">Carrito</a>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Carrito</th>
        </tr>
        <?php
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