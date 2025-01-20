<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>
<body>
    <h1>Nuevo cliente</h1>
    <div style="color:red;">
        <?php
            if(isset($data['errores'])){
                echo $data['errores'];
            }
        ?>
    </div>
    <form action="?controller=ClienteController&action=altaCliente" method="post">

        <label for="nombre">Nombre</label><br>
        <input type="text" name="nombre" id= "nombre" required><br>
        <label for="aps">Apellidos</label><br>
        <input type="text" name="aps" id= "aps" required><br>
        <label for="tel">Teléfono</label><br>
        <input type="tel" name="telf" id= "telf"><br>
        <label for="mail">Email</label><br>
        <input type="text" name="mail" id= "mail"><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>