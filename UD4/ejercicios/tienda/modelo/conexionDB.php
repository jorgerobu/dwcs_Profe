<?php
class ConexionDB
{
    public static function getConnexion()
    {

        try {
            $pdo = new PDO('mysql:dbname=tienda;host=mariadb', 'root', 'bitnami');
        } catch (PDOException $th) {
            error_log("Error obteniendo la conexion. " . $th->getMessage());
            die();
        }

        return $pdo;
    }
}
