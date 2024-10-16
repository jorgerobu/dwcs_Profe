<?php

/**
 * Comprueba que el usuario y la contraseña sean correctos.
 * En este caso el usuario correcto siempre es admin y la contraseña 1234.
 *
 * @param string $usr
 * @param string $pass
 * @return boolean
 */
function comprobar(string $usr, string $pass): bool
{
    $toret = false;
    if (!empty($usr) && !empty($pass)) {
        $toret = $usr == 'admin' && $pass == '1234';
    }

    return $toret;
}
?>
<!-- Probamos la función -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php
    //Definimos un precio y un IVA para probar la función.
    $usuario = 'admin';
    $contrasena = '1234';
    ?>
    <h1>Login</h1>
    <?php
    if (comprobar($usuario, $contrasena)) {
        echo '<span style="color:green;"><strong>Login correcto</strong></span>';
    } else {
        echo '<span style="color:red;"><strong>Login incorrecto</strong></span>';
    }
    ?>
</body>

</html>