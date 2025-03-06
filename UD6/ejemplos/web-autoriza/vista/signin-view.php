<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo PATH_ROOT;?>vista/style/styles.css" rel="stylesheet">
    <title>Registro</title>
</head>

<body>
    <?php include("errores.php"); ?>
    <fieldset>
        <form action="?controller=user&action=addUser" method="post">
            <label for="nombre">Nombre</label>
            <input name="nombre" type="text" id="nombre" required>
            <label for="apellido1">Primer apellido</label>
            <input name="apellido1" type="text" id="apellido1" required>
            <label for="apellido2">Segundo apellido</label>
            <input name="apellido2" type="text" id="apellido2">
            <label for="email">Email</label>
            <input name="email" type="email" id="email" required>
            <label for="user">Usuario</label>
            <input name="user" type="text" id="user" required>
            <label for="pass">Contraseña</label>
            <input name="pass" type="password" id="pass" required>
            <label for="pass2">Repita la contraseña</label>
            <input name="pass2" type="password" id="pass2" required>
            <button type="submit">Guardar</button>
        </form>
    </fieldset>
</body>

</html>