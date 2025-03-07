<?php
include_once("globals.php");
include_once("controlador/Controller.php");
include_once("controlador/AuthController.php");

function getIds(array $uri):array{
    $ids = [];
    for($i=count($uri)-1;$i>=0;$i--){
        if(intval($uri[$i])){
            $ids[] = $uri[$i];
        }
    }
    return array_reverse($ids);
}


/**
 * Este fichero captura todas la peticiones a nuestra aplicación.
 * Aqui se parsea la uri para decidir el controlador y la acción que debemos ejecutar.
 */
$metodo = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$uri = explode("/", $uri);
$endpoint = $uri[3];
$id = null;

try {
    $controlador = Controller::getController($endpoint);
} catch (ControllerException $th) {
    Controller::sendNotFound("Error obteniendo el endpoint " . $endpoint);
    die();
}

if (count($uri) >= 5) {
    try {
        $id = getIds($uri);
    } catch (Throwable $th) {

        Controller::sendNotFound("Error en la peticion. El parámetro debe ser un id correcto.");
        die();
    }
}

$token = $_SERVER["HTTP_X_API_KEY"];
$auth = AuthController::checkAuth($endpoint, $metodo, $token);
if(!$auth){
    Controller::sendNotFound("No tiene permiso.");
    die();
}

switch ($metodo) {
    case 'POST':
        $json = file_get_contents('php://input');
        $controlador->insert($json);
        break;
    case 'GET':
        if (isset($id)) {
            $controlador->get($id);
        } else {
            $controlador->getAll();
        }
        break;
    case 'DELETE':
        if (isset($id) ) {
            $controlador->delete($id);
        } else {
            Controller::sendNotFound("Es necesario indicar el id correcto de la banda a eliminar.");
        }
        break;
    case 'PUT':
        if (isset($id) ) {
            $json = file_get_contents('php://input');
            $controlador->update($id, $json);
        } else {
            Controller::sendNotFound("Es necesario indicar el id correcto de la banda a actualizar.");
        }

        break;
    default:
        Controller::sendNotFound("Método HTTP no disponible.");
}
