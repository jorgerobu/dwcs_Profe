<?php
include_once("globals.php");
include_once("controlador/Controller.php");
/**
 * Este fichero captura todas la peticiones a nuestra aplicación.
 * Aqui se parsea la uri para decidir el controlador y la acción que debemos ejecutar.
 */
$metodo = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$uri = explode("/", $uri);
var_dump($uri);
$elemento = $uri[3];
$id = null;

try {
    $controlador = Controller::getController($elemento);
} catch (ControllerException $th) {
    Controller::sendNotFound("Error obteniendo el elemento ".$elemento);
    die();
}

if (count($uri) == 5) {
    try {
        $id = intval($uri[4]);
    } catch (Throwable $th) {

        Controller::sendNotFound("Error en la peticion. El parámetro debe ser un id correcto.");
        die();
    }
}
//TODO
switch ($metodo) {
    case 'POST':
        break;
    case 'GET':
        break;
    case 'DELETE':
        break;
    case 'UPDATE':
        break;
    default:
        Controller::sendNotFound("Método HTTP no disponible.");
}
