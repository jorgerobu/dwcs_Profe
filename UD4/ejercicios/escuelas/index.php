<?php
include("controlador/escuela-controller.php");
//Controlador por defecto.
$controller = 'EscuelaController';
//Acción por defecto.
$action = "listar_escuelas";

if(isset($_REQUEST['controller'])){
    $controller = $_REQUEST['controller'];
    try{
        $objeto = new $controller();
    }catch(\Throwable $th){
        error_log("Cargando controlador inexistente: ".$controller);
        $controller = 'EscuelaController';
    }
}

if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
    try {
        $objeto->$action();
        
    } catch (\Throwable $th) {
        error_log("Cargando accion inexistente: ".$action);
        $controller = 'EscuelaController';
        $action = 'listar_escuelas';
    }
    
}
$objeto = new $controller();
$objeto->$action();