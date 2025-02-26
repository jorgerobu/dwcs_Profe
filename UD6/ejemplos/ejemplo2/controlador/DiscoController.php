<?php
include_once("Controller.php");
include_once(PATH_MODEL."DiscoModel.php");
class DiscoController extends Controller{
    public function get($id){
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
        $model = new DiscoModel();
        if($model->delete($id)){
            echo "Disco eliminado";
        }else{
            Controller::sendNotFound("No se ha podido eliminar");
        }
    }

    public function update($id, $object){
        $model = new DiscoModel();
        $disco = Disco::fromJson($object);

        if($model->update($disco,$id)){
            echo "Disco modificado";
        }else{
            Controller::sendNotFound("No se ha podido modificar");
        }
    }


}