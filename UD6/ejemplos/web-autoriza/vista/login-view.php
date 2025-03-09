<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo PATH_ROOT;?>vista/style/styles.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <?php include("errores.php"); ?>
    <fieldset>
        <form action="?controller=user&action=checkLogin" method="post">
            <label for="user">Usuario</label>
            <input name="user" type="text" id="user">
            <label for="pass">Contraseña</label>
            <input name="pass" type="password" id="pass">
            <button type="submit">Acceder</button>
            <a href="?controller=user&action=signin">Registrarse</a>
        </form>
    </fieldset>
</body>
</html>