<?php
include("funciones.php");
//Activamos el reinicio de sesión.
include("restart_session.php");
session_start();
//Si ya está registrado lo enviamos a la sección restrigida.
if (isset($_SESSION['loged'])) {
    header("Location: restringido.php");
}

//Tenemos que establecer la cookie antes de generar nada de HTML.
$nic_name = $_COOKIE['nic_name'] ?: '';
//Si nos entra por POST
if (isset($_POST['nic'])) {
    //Comprobamos si ha marcado el check
    if (isset($_POST['recuerda'])) {
        setcookie("nic_name", $_POST['nic'], time() + 2592000);
        $nic_name = $_POST['nic'];
    } else {
        //Si no ha marcado el check eliminamos la cookie
        setcookie("nic_name", $_POST['nic'], time() - 100);
        $nic_name = '';
    }
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
            //Evitamos que accedan a la cookie de sesión desde javascript
            $params = session_get_cookie_params();

            setcookie(session_name(), session_id(), $params["lifetime"], $params["path"], $params["domain"], true, true);
            //Creamos la cookie que caducara en 10 minutos.
            setcookie("t_reset", "on", time() + 6, "", "", true,true);
            header("Location: restringido.php");
        } else {
            echo '<h2 style="color:white;background-color:red;">Login incorrecto</h2>';
        }
    }
    ?>
    <fieldset>
        <form action="" method="post">
            <label for="nic">Nombre de usuario (nic)</label><br>
            <input type="text" name="nic" value=<?= $nic_name ?>>
            <input type="checkbox" id="recuerda" name="recuerda" <?= $nic_name != '' ? 'checked' : '' ?>>
            <label for="recuerda">Recuerdame</label>
            <br>
            <label for="pass">Contraseña</label><br>
            <input type="password" name="pass"><br>
            <button type="submit">Acceder</button>
        </form>
    </fieldset>
    <a href="registro.php">Registrar usuario</a>

</body>

</html>