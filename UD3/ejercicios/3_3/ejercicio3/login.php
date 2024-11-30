<?php
include("funciones.php");
session_start();
//Si ya está registrado lo enviamos a la sección restrigida.
if (isset($_SESSION['loged'])) {
    header("Location: restringido.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php
    //Si llegan datos del formulario los procesamos
    if (isset($_POST['nic']) && isset($_POST['pass'])) {
        if (comprobar_usuario($_POST['nic'], $_POST['pass'])) {
            //Establecemos la variable de sesión
            $_SESSION['loged'] = $_POST['nic'];
            header("Location: restringido.php");
        } else {
            echo '<h2 style="color:white;background-color:red;">Login incorrecto</h2>';
        }
    }
    ?>
    <fieldset>
        <form action="" method="post">
            <label for="nic">Nombre de usuario (nic)</label><br>
            <input type="text" name="nic"><br>
            <label for="pass">Contraseña</label><br>
            <input type="password" name="pass"><br>
            <button type="submit">Acceder</button>
        </form>
    </fieldset>
    <a href="registro.php">Registrar usuario</a>

</body>

</html>