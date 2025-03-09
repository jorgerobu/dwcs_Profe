<?php

namespace webautoriza\model;

require_once("Model.php");

class PermisoModel extends Model
{

    public static function getPermisos(): array
    {
        $sql = "SELECT id, nombre, descripcion FROM permiso ORDER BY 2";
        $pdo = self::getConexion();
        $permisos = [];
        try {
            $statement = $pdo->query($sql);
            $permisos = $statement->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $permisos;
    }

    public static function getPermisosByToken($token): array
    {
        $sql = "SELECT DISTINCT p.id as permiso_id, p.nombre as permiso_nombre, e.id as endpoint_id, e.uri as uri 
        from permiso p left join autorizacion a on a.permiso_id = p.id and a.token = :token
        left join endpoint e on e.id = a.endpoint_id ORDER BY 2, 4 ASC";
        $pdo = self::getConexion();
        $permisos = [];
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(":token",$token);
            $statement->execute();
            while(($row = $statement->fetch())!=false){
                $permisos[$row['permiso_nombre']][] = $row["uri"]; 
            }
        } catch (\PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $permisos;
    }

 }