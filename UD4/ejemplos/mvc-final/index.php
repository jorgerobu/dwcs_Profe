<?php
include('articlesController.php');
include('errorController.php');
//Controlador por defecto.
$controller = 'ErrorController';
//Acción por defecto.
$action = "showActionNotFound";

if(isset($_REQUEST['controller'])){
    $controller = $_REQUEST['controller'];
    try{
        $objeto = new $controller();
    }catch(\Throwable $th){
        $controller = 'ErrorController';
        $objeto->$action();
        $objeto->showControllerNotFound();
        die();
    }
}

if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
    try {
        $objeto->$action();
        
    } catch (\Throwable $th) {
        $controller = 'ErrorController';
        $objeto = new $controller();
        $objeto->showActionNotFound();
        die();
    }
    
}
$objeto = new $controller();
$objeto->$action();




