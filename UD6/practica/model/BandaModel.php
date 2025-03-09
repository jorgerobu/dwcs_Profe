<?php
include_once("Model.php");
include_once("ModelObject.php");

class Banda extends ModelObject{
    public $id;
    public $nombre;
    public $num_integrantes;
    public $genero;
    public $nacionalidad;

    public function __construct($nombre,$num_integrantes,$genero,$nacionalidad=null,$id=null)
    {
        $this->nombre = $nombre;
        $this->num_integrantes = $num_integrantes;
        $this->genero = $genero;
        $this->nacionalidad = $nacionalidad;
        $this->id = $id;
    }

    public static function fromJson($json):ModelObject{
        $data = json_decode($json);
        return new Banda($data->nombre,$data->num_integrantes,$data->genero,$data->nacionalidad,$data->id);
    }
    public function toJson():String{
        return json_encode($this,JSON_PRETTY_PRINT);
    }
}

class BandaModel extends Model{
    public function get($id):Banda|null{
        $sql = "SELECT id, nombre,num_integrantes,genero,nacionalidad from banda WHERE id =?";
        $pdo = self::getConnection();
        $resultado = null;

        try{
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1,$id,PDO::PARAM_INT);
            $stmt->execute();
            
            if($b = $stmt->fetch()){
                $resultado = new Banda($b['nombre'],$b['num_interantes'],$b['genero'],$b['nacionalidad'],$b['id']);
            }
        }catch(Throwable $e){
            error_log("Error BandaModel->get($id)");
            error_log($e->getMessage());
        }finally{
            $stmt = null;
            $pdo = null;
        }

        return $resultado;
    }
    public function getAll(){
        $sql = "SELECT id, nombre,num_integrantes,genero,nacionalidad from banda";
        $pdo = self::getConnection();
        $resultado = [];

        try{
            $stmt = $pdo->query($sql);
            $resultado = [];

            foreach($stmt as $b){
                $resultado[]= new Banda($b['nombre'],$b['num_interantes'],$b['genero'],$b['nacionalidad'],$b['id']);
            }

        }catch(Throwable $e){
            error_log("Error BandaModel->getAll()");
            error_log($e->getMessage());
        }finally{
            $stmt = null;
            $pdo = null;
        }

        return $resultado;
    }
    public function insert($object){
        //TODO
    }
    public function delete($id){

    } 
    public function update($id, $object){

    }
}
?>