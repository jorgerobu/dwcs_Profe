<?php
include_once("Model.php");
include_once("ModelObject.php");

class Disco extends ModelObject{

    public $id;
    public $titulo;
    public $anho;
    public $id_banda;

    function __construct($titulo, $anho, $id_banda, $id=null){
        $this->titulo = $titulo;
        $this->anho = $anho;
        $this->id_banda = $id_banda;
        $this->id = $id;
    }

    public static function fromJson($json):ModelObject{
        $data = json_decode($json);
        return new Disco($data->titulo, $data->anho, $data->id_banda, $data->id);
    }


    public function toJson():String{
        return json_encode($this,JSON_PRETTY_PRINT);
    }

}


class DiscoModel extends Model
{


    public function getAll()
    {
        $sql = "SELECT * FROM disco";
        $pdo = self::getConnection();
        $resultado = [];
        try {
            $statement = $pdo->query($sql);
            $resultado = array();
            foreach($statement as $d){
                $disco = new Disco($d['titulo'],$d['anho'],$d['id_banda'], $d['id']);
                $resultado[] = $disco;
            }
        } catch (PDOException $th) {
            error_log("Error DiscoModel->getAll()");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }

    public function get($discoId):Disco|null
    {
        $sql = "SELECT * FROM disco WHERE id=?";
        $pdo = self::getConnection();
        $resultado = null;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(1, $discoId, PDO::PARAM_INT);
            $statement->execute();
            if($d = $statement->fetch()){
                $resultado = new disco($d['titulo'],$d['anho'],$d['id_banda'], $d['id']);
            }
            
        } catch (Throwable $th) {
            error_log("Error DiscoModel->get($discoId)");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }

    public function insert($disco)
    {
        $sql = "INSERT INTO disco(titulo, anho,id_banda) VALUES (:titulo, :anho, :id_banda)";

        $pdo = self::getConnection();
        $resultado = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(":titulo", $disco->titulo, PDO::PARAM_STR);
            $statement->bindValue(":anho", $disco->anho, PDO::PARAM_INT);
            $statement->bindValue(":id_banda", $disco->id_banda, PDO::PARAM_INT);
            $resultado = $statement->execute();
        } catch (PDOException $th) {
            error_log("Error DiscoModel->insert(" . $disco->toJson. ")");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }

    public function update($disco, $discoId)
    {
 
        $sql = "UPDATE disco SET
            titulo=:titulo,
            anho=:anho,
            id_banda=:id_banda
            WHERE id=:id";

        $pdo = self::getConnection();
        $resultado = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(":titulo", $disco->titulo, PDO::PARAM_STR);
            $statement->bindValue(":anho", $disco->anho, PDO::PARAM_INT);
            $statement->bindValue(":id_banda", $disco->id_banda, PDO::PARAM_INT);
            $statement->bindValue(":id", $discoId, PDO::PARAM_INT);

            $resultado = $statement->execute();
            $resultado = $statement->rowCount() == 1;
        } catch (PDOException $th) {
            error_log("Error DiscoModel->update(" . implode(",", $disco) . ", $discoId)");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }

    public function delete($discoId)
    {
        $sql = "DELETE FROM disco WHERE id=?";

        $pdo = self::getConnection();
        $resultado = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(1, $discoId, PDO::PARAM_INT);
            $resultado = $statement->execute();
        } catch (PDOException $th) {
            error_log("Error DiscoModel->delete($discoId)");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }
}
