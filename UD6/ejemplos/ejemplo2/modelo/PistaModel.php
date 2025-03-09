<?php
include_once("Model.php");
include_once("ModelObject.php");

class Pista extends ModelObject{

    public $id_disco;
    public $numero;
    public $titulo;
    public $duracion;

    function __construct($id_disco, $numero, $titulo, $duracion=null){
        $this->id_disco = $id_disco;
        $this->numero = $numero;
        $this->titulo = $titulo;
        $this->duracion = $duracion;
    }

    public static function fromJson($json):ModelObject{
        $data = json_decode($json);
        return new Disco($data->id_disco, $data->numero, $data->titulo, $data->duracion);
    }


    public function toJson():String{
        return json_encode($this,JSON_PRETTY_PRINT);
    }

}

class PistaModel extends Model
{
    public function getAll():array|null
    {
        $sql = "SELECT * FROM pista";
        $pdo = self::getConnection();
        $resultado = null;
        try {
            $statement = $pdo->query($sql);
            $resultado = array();
            foreach($statement as $p){
                $pista = new Pista($p['id_disco'],$p['numero'],$p['titulo'], $p['duracion']);
                $resultado[] = $pista;
            }
        } catch (PDOException $th) {
            error_log("Error PistaModel->getAll()");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }

    public function get($arrayIds):Pista|null
    {
        $sql = "SELECT * FROM pista WHERE id_disco=? AND numero=?";
        $pdo = self::getConnection();
        $resultado = null;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(1, $arrayIds[0], PDO::PARAM_INT);
            $statement->bindValue(2, $arrayIds[1], PDO::PARAM_INT);
            $statement->execute();
            if($p = $statement->fetch()){
                $resultado = new pista($p['id_disco'],$p['numero'],$p['titulo'], $p['duracion']);
            }
            
        } catch (Throwable $th) {
            error_log("Error PistaModel->get($arrayIds)");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }
//TODO
    public function insert($arrayIds, $pista)
    {
        $sql = "INSERT INTO pista(id_disco,titulo, duaracion) VALUES (:id_disco, :titulo, :duracion)";

        $pdo = self::getConnection();
        $resultado = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(":id_disco", $arrayIds[0], PDO::PARAM_INT);
            $statement->bindValue(":titulo", $pista->titulo, PDO::PARAM_STR);
            $statement->bindValue(":duracion", $pista->duracion);
            $resultado = $statement->execute();
            $resultado = $statement->rowCount() == 1;
        } catch (PDOException $th) {
            error_log("Error PistaModel->insert(" . $pista->toJson. ")");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }

    public function update($arrayIds, $pista):bool
    {
        
        $sql = "UPDATE pista SET
            titulo = :titulo,
            duracion = :duracion
            WHERE id_disco = :id_disco AND  numero = :numero";

        $pdo = self::getConnection();
        $resultado = false;
        try {
            
            $statement = $pdo->prepare($sql);
            $statement->bindValue(":titulo", $pista->titulo, PDO::PARAM_STR);
            $statement->bindValue(":duracion", $pista->duracion);
            $statement->bindValue(":id_disco", $arrayIds[0], PDO::PARAM_INT);
            $statement->bindValue(":numero", $arrayIds[1], PDO::PARAM_INT);

            $resultado = $statement->execute();
            $resultado = $statement->rowCount() == 1;
        } catch (PDOException $th) {
            error_log("Error PistaModel->update(" . implode(",", $pista) . ", $arrayIds)");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }

    public function delete($arrayIds)
    {
        $sql = "DELETE FROM pista WHERE id_disco=? AND numero=?";

        $pdo = self::getConnection();
        $resultado = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(1, $arrayIds[0], PDO::PARAM_INT);
            $statement->bindValue(2, $arrayIds[1], PDO::PARAM_INT);
            $resultado = $statement->execute();
            $resultado = $statement->rowCount() == 1;
        } catch (PDOException $th) {
            error_log("Error PistaModel->delete($arrayIds[1])");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }
}
