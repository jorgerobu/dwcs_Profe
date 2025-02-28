<?php
namespace webautoriza\model;
use PDO;
use PDOException;
define('DB_DSN','');
define('DB_USER','');
define('DB_PASS','');
class Model{
    protected function getConexion():PDO{
        try{
            $pdo = new PDO(DB_DSN,DB_USER, DB_PASS);
        }catch(PDOException $th){
            error_log('Error de conexion con la BD: '.$th->getMessage());
            die();
        }
        return $pdo;
    }
}