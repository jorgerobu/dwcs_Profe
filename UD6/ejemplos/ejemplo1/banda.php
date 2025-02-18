<?php

include_once("modelo/BandaModel.php");
function sendNotFound($mensaje){
    header("HTTP/1.1 404 Not Found");
    $mensaje = ["error"=>$mensaje];
    echo json_encode($mensaje,JSON_PRETTY_PRINT);
}

$metodo = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$uri = explode("/",$uri);
$controlador = $uri[3];
$idBanda = null;
if(count($uri)==5){
    try{
        $idBanda = intval($uri[4]);
    }catch(Throwable $th){
        
        sendNotFound("Error en la peticion. El parámetro debe ser un id de banda correcto.");
        die();
    }
}

$model = new BandaModel();
switch ($metodo) {
    case 'GET':
        if($idBanda==null){
            $bandas = $model->getAll();
        }else{
            $bandas = $model->get($idBanda);
        }
        
        echo json_encode($bandas,JSON_PRETTY_PRINT);
        break;
    case 'POST':
        //Recuperar el json del cuerpo de la petición
        $json = file_get_contents('php://input');
        //Transformar el json en un array
        $json_array = json_decode($json,true);
        if($model->insert($json_array)){
            echo json_encode(["mensaje"=>"Banda creada"]);
        }else{
            sendNotFound("No se ha podido crear la banda.");
        }
        break;
    case 'PUT':
        if($idBanda==null){
            sendNotFound("No puede actualizar una banda sin pasar el id. Ej. http://localhost/ejemplos/ejemplo1/banda.php/4");
            die();
        }

        //Recuperar el json del cuerpo de la petición
        $json = file_get_contents('php://input');
        //Transformar el json en un array
        $json_array = json_decode($json,true);
        if($model->update($json_array,$idBanda)){
            echo json_encode(["mensaje"=>"Banda actualizada"]);
        }else{
            sendNotFound("No se ha podido actualizar la banda.");
        }

        break;
    case 'DELETE':
        if($idBanda==null){
            sendNotFound("No puede eliminar una banda sin pasar el id. Ej. http://localhost/ejemplos/ejemplo1/banda.php/4");
            die();
        }
        if($model->delete($idBanda)){
            echo json_encode(["mensaje"=>"Banda eliminada"]);
        }else{
            sendNotFound("No se ha podido eliminar la banda.");
        }

        break;
    default:
    sendNotFound("Método HTTP no disponible.");
}

