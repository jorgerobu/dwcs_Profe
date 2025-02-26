<?php
include_once("Controller.php");
include_once(PATH_MODEL."BandaModel.php");
class BandaController extends Controller{

    public function get($id){
        $model = new BandaModel();
        $banda = $model->get($id);
        
        if($banda==null){
            Controller::sendNotFound("El id no se corresponde con ninguna banda");
            die();
        }

        echo $banda->toJson();

    }

    public function getAll(){
        $model = new BandaModel();
        $bandas = $model->getAll();
        echo json_encode($bandas,JSON_PRETTY_PRINT);

    }

    public function insert($object){
        $model = new BandaModel();
        $banda = Banda::fromJson($object);
        if($model->insert($banda)){
            echo "Banda insertada.";
        }else{
            Controller::sendNotFound("No se ha podido insertar");
        }

    }
    
    public function delete($id) {
        $model = new BandaModel();
        if($model->delete($id)){
            echo "Banda eliminada";
        }else{
            Controller::sendNotFound("No se ha podido eliminar");
        }
    }

    public function update($id, $object){
        $model = new BandaModel();
        $banda = Banda::fromJson($object);

        if($model->update($banda,$id)){
            echo "Banda modificada";
        }else{
            Controller::sendNotFound("No se ha podido modificar");
        }
        
        
    }

}