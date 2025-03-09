<?php
include_once("Controller.php");
include_once(PATH_MODEL."BandaModel.php");

class BandaController extends Controller{
    public function get($id){
        $model = new Bandamodel();

        if(count($id)!=1){
            Controller::sendNotFound("Las bandas se identifican por un solo id");
            die();
        }

        $banda = $model->get($id[0]);

        if($banda==null){
            Controller::sendNotFound("El id no se corresponde con  ninguna banda");
            die();
        }

        echo $banda->toJson();
    }
    public function getAll(){
        
    }
    public function insert($object){
        
    }
    public function delete($id){

    }
    public function update($id,$object){

    }
}

?>