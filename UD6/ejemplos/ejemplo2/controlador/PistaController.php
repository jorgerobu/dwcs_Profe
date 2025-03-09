<?php
include_once("Controller.php");
include_once(PATH_MODEL."PistaModel.php");
class PistaController extends Controller{
    public function get($discoId){ //RECIBE UN ARRAY CON LOS IDS
      
        $model = new PistaModel();
        
        if(count($discoId)==1){
            Controller::sendNotFound("Las pistas se identifican por dos id.");
            die();
        }

        $pista = $model->get($discoId);


        if($pista==null){
            Controller::sendNotFound("El id no se corresponde con ninguna pista");
            die();
        }

        echo $pista->toJson();  //Llamamos a la funcion toJson de Pista para enviar un json
    }

    public function getAll(){
        $model = new PistaModel();
        $pistas = $model->getAll();
        echo json_encode($pistas,JSON_PRETTY_PRINT); // pasamos el array a un Json


    }
    
    public function delete($id) {
        $model = new PistaModel();

        if(!count($id)>1){
            sendNotFound("Las pistas se identifican con dos ids");
            die();
        }
        if($model->delete($id)){
            echo "Pista Eliminada";
        }else{
            sendNotFound("No ha podido eliminar la pista");
        }
    }

    public function update($id, $object){
        if(!count($id)>1){
            Controller::sendNotFound(("Las pistas se identifican por dos ids"));
            die();
        }

        $model = new PistaModel();
        $pista = Pista::fromJson($object);

        if($model->update($id,$pista)){
            echo "Pista modificada";
        }else{
            Controller::sendNotFound("No se ha podido modificar la pista");
        }
    }   

    public function insert($object){
        
    }

}