<?php
include_once("Controller.php");
include_once(PATH_MODEL."DiscoModel.php");
class DiscoController extends Controller{
    public function get($id){
        if(count($id)!=1){
            Controller::sendNotFound("Los discos se identifican por un sol id.");
            die();
        }
        $model = new DiscoModel();
        $disco = $model->get($id);
        
        if($disco==null){
            Controller::sendNotFound("El id no se corresponde con ningun Disco");
            die();
        }

        echo $disco->toJson();

    }

    public function getAll(){
        $model = new DiscoModel();
        $discos = $model->getAll();
        echo json_encode($discos,JSON_PRETTY_PRINT);
    }
    
    public function insert($object){
        $model = new DiscoModel();
        $disco = Disco::fromJson($object);
        if($model->insert($disco)){
            echo "Disco insertado.";
        }else{
            Controller::sendNotFound("No se ha podido insertar");
        }
    }

    public function delete($id) {
        if(count($id)!=1){
            Controller::sendNotFound("Los discos se identifican por un sol id.");
            die();
        }
        $model = new DiscoModel();
        if($model->delete($id[0])){
            echo "Disco eliminado";
        }else{
            Controller::sendNotFound("No se ha podido eliminar");
        }
    }

    public function update($id, $object){
        if(count($id)!=1){
            Controller::sendNotFound("Los discos se identifican por un sol id.");
            die();
        }
        $model = new DiscoModel();
        $disco = Disco::fromJson($object);

        if($model->update($disco,$id[0])){
            echo "Disco modificado";
        }else{
            Controller::sendNotFound("No se ha podido modificar");
        }
    }


}