<?php
include_once("Model.php");
class BandaModel extends Model
{

    public function getAll()
    {
        $sql = "SELECT * FROM banda";
        $pdo = self::getConnection();
        $resultado = [];
        try {
            $statement = $pdo->query($sql);
            $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            error_log("Error BandaModel->getAll()");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }

    public function get($bandaId)
    {
        $sql = "SELECT * FROM banda WHERE id=?";
        $pdo = self::getConnection();
        $resultado = [];
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(1, $bandaId, PDO::PARAM_INT);
            $statement->execute();
            $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            error_log("Error BandaModel->get($bandaId)");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }

    public function insert($banda)
    {
        $sql = "INSERT INTO banda(nombre, num_integrantes,genero, nacionalidad) VALUES (:nombre, :integrantes, :genero, :nacionalidad)";

        $pdo = self::getConnection();
        $resultado = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(":nombre", $banda['nombre'], PDO::PARAM_STR);
            $statement->bindValue(":integrantes", $banda['num_integrantes'], PDO::PARAM_INT);
            $statement->bindValue(":genero", $banda['genero'], PDO::PARAM_STR);
            $statement->bindValue(":nacionalidad", $banda['nacionalidad'], PDO::PARAM_STR);
            $resultado = $statement->execute();
        } catch (PDOException $th) {
            error_log("Error BandaModel->insert(" . implode(",", $banda) . ")");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }

    public function update($banda, $bandaId)
    {
        // $sql = "INSERT INTO banda(nombre, num_integrantes,genero, nacionalidad) VALUES (:nombre, :integrantes, :genero, :nacionalidad)";
        $sql = "UPDATE banda SET
            nombre=:nombre,
            num_integrantes=:integrantes,
            genero=:genero,
            nacionalidad=:nacionalidad
            WHERE id=:id";

        $pdo = self::getConnection();
        $resultado = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(":nombre", $banda['nombre'], PDO::PARAM_STR);
            $statement->bindValue(":integrantes", $banda['num_integrantes'], PDO::PARAM_INT);
            $statement->bindValue(":genero", $banda['genero'], PDO::PARAM_STR);
            $statement->bindValue(":nacionalidad", $banda['nacionalidad'], PDO::PARAM_STR);
            $statement->bindValue(":id", $bandaId, PDO::PARAM_INT);

            $resultado = $statement->execute();
        } catch (PDOException $th) {
            error_log("Error BandaModel->update(" . implode(",", $banda) . ", $bandaId)");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }

    public function delete($bandaId)
    {
        $sql = "DELETE FROM banda WHERE id=?";

        $pdo = self::getConnection();
        $resultado = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(1, $bandaId, PDO::PARAM_INT);
            $resultado = $statement->execute();
        } catch (PDOException $th) {
            error_log("Error BandaModel->delete($bandaId)");
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }
}
