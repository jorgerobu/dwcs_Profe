<?php
class Article
{
    private static function getConexion()
    {
        $db = null;
        try {
            $db = new PDO('mysql:host=mariadb; dbname=articulos', 'root', 'bitnami');
        } catch (PDOException $th) {
            die($th->getMessage());
        }

        return $db;
    }

    public static function getAll()
    {
        $db = self::getConexion();
        $articles = [];
        try {
            $res = $db->query('SELECT fecha, titulo FROM articulo');

            while ($row = $res->fetch()) {
                $articles[] = $row;
            }
        } catch (PDOException $th) {
            die($th->getMessage());
        }

        $db = null;

        return $articles;
    }
}
