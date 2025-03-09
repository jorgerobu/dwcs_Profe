<?php
include_once("globlas.php");
include_once(PATH_CONTROLLER."controller.php");

//Recuperamos method y uri
$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];

//parseamos la uri
$uri = explode("/", $uri);

$endpoint = $uri[2];
$id = null;

//obtenemos las ids en la uri
function getIds(array $uri):array{
    $ids = [];
   for ($i=count($uri)-1; $i>=0; $i--) { 
        if(intval($uri[$i])){
            $ids[] = $uri[$i];
        }
   }
   return array_reverse($ids);
}

//obtenemos el controlador
try {
    $controller = Controller::getController($endpoint);
} catch (ExceptionController $th) {
    Controller::sendNotFound("No se ha podido obtener el endpoint ".$endpoint);
    die();
}

if(count($uri)>=4){
    try {
        $id = getIds($uri);
    } catch (\Throwable $th) {
        Controller::sendNotFound("Error en la petición, El parámetro tiene que ser un id correcto");
        die();
    }
}

// llamamos al método del controlador
switch($endpoint){
    case "POST":
        $json = file_get_contents("php://input");
        $controller->insert($json);
        break;
    case "GET":
        if(isset($id)){
            $controller->get($id);
        }else{
            $controller->getAll();
        }
        break;
    case "DELETE":
        if(isset($id)){
            $controller->delete(($id));
        }else{
            Controller::sendNotFound("Es necesario introducir el id a eliminar");
            die();
        }
        break;
    case "PUT":
        if(isset($id)){
            $json = file_get_contents("php://input");
            $controller->update($id,$json);
        }else{
            Controller::sendNotFound("Es necesario introducir el id a modificar");
            die();
        }
        break;
    default;
        Controller::sendNotFound("Método HTTP no disponible");
        die();
        
}
?>