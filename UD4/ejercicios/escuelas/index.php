<?php
include("controlador/escuela-controller.php");

if (isset($_REQUEST['controller'])) {
    $controller = $_REQUEST['controller'];
    try {
        $objeto = new $controller();

        if (isset($_REQUEST['action'])) {
            $action = $_REQUEST['action'];
        }
        $objeto->$action();
    } catch (\Throwable $th) {
        error_log("Cargando controlador inexistente: " . $controller);
        $objeto = new EscuelaController();
        $objeto->listar_escuelas();
    }
} else {
    $objeto = new EscuelaController();
    $objeto->listar_escuelas();
}
