<?php
include("funciones.php");
//Activamos el reinicio de sesión.
include("restart_session.php");
session_start();
//Si no está registrado lo enviamos al login.
if (!isset($_SESSION['loged'])) {
    header("Location: login.php");
}
//Si llegan datos del enlace Logout
if (isset($_GET['logout'])) {
    //Eliminamos las variables de sesión.
    session_unset();
    session_destroy();
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sección restringida</title>
</head>

<body>
    <h1>Sección restringida</h1>
    Estás logueado con el usuario <?= $_SESSION['loged'] ?>. Pulsa aquí para salir: <a href="?logout=y">Logout</a>
    <p>
        Esta sección esta restringida solo para los usuarios que están registrados.
    </p>
</body>

</html>