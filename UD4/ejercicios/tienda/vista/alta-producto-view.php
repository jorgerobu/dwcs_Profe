<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body>
    <h1>Nuevo producto</h1>

    <div style="color:red;">
        <?php
            if(isset($data['errores'])){
                echo $data['errores'];
            }
        ?>
    </div>
    <form action="?controller=ProductoController&action=altaProducto" method="post">

        <label for="denom">Nombre</label><br>
        <input type="text" name="denom" id= "denom" required><br>
        <label for="desc">Descripción</label><br>
        <input type="text" name="desc" id= "desc" required><br>
        <label for="precio">Precio</label><br>
        <input type="text" name="precio" id= "precio"><br>
        <label for="cant">Cantidad</label><br>
        <input type="number" name="cant" id= "cant"><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>