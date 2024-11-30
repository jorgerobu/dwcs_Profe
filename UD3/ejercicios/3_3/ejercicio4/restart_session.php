<?php
session_start();
//Comprobamos si existe la cookie que controla el tiempo.
if (isset($_SESSION['loged']) && !isset($_COOKIE['t_reset'])) {
    //Eliminamos las variables de sesión.
    session_unset();
    $params = session_get_cookie_params();
    //Eliminamos la cookie de sesion
    setcookie(session_name(), '', time() - 100,$params["path"],$params["domain"],$params["secure"], $params["httponly"]);
    //Cerramos la sesión
    session_destroy();
}
