<?php

namespace webautoriza\model;

require_once("Model.php");

class EndpointModel extends Model
{

    public static function getEndpoints(): array
    {
        $sql = "SELECT id, uri FROM endpoint";
        $pdo = self::getConexion();
        $endpoints = [];
        try {
            $statement = $pdo->query($sql);
            $endpoints = $statement->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $endpoints;
    }

 }