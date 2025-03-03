<?php

namespace webautoriza\model;

require_once("Model.php");

class TokenModel extends Model
{

    public static function getTokensByUser($userId): array
    {
        $sql = "SELECT token, usuario_id, caducidad FROM token WHERE usuario_id=:userId";
        $pdo = self::getConexion();
        $tokens = [];
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':userId', $userId);
            $statement->execute();
            $tokens = $statement->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $tokens;
    }

    /**
     * Devuelve los permisos de asociados a un token en un end point determinado.
     */
    public static function getTokenPermmisions($token, $endpointId): array
    {
        $sql = "SELECT p.nombre FROM autorizacion a INNER JOIN permiso p ON a.permiso_id = p.id
                WHERE a.token = :token AND a.endpoint_id=:endpointId";
        $pdo = self::getConexion();
        $permisos = [];
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':token', $token);
            $statement->bindValue(':endpointId', $endpointId);
            $statement->execute();
            $permisos = $statement->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $permisos;
    }

    /**
     * Genera un nuevo token, lo almacena en la base de datos y devuelve el valor del token o false si no 
     * se ha podido grear.
     * @param userId Es el id del usuario para el que se crea el token.
     * @param endPoints Es un array cuya clave es el id de cada endpoint y el valor es un array con los id de los permisos que 
     * se dan sobre ese endpoint. Ej. ['1'=>[2,3],'2'=[1,2,3,4]]
     */
    public static function addToken($userId, $endpoints): false | string
    {
        //Generamos el token de 16 Bytes.
        $bytes = random_bytes(16);
        $token = bin2hex($bytes);
        $sql = "INSERT INTO token(token, usuario_id) VALUES ('$token',:userId)";
        $pdo = self::getConexion();
        $pdo->beginTransaction();
        $resultado = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':userId', $userId);
            $statement->execute();
            $resultado = $statement->rowCount() == 1;
            if ($resultado) {
                //Asociamos los tokens a los endpoints
                $sql = "INSERT INTO autorizacion(token, permiso_id, endpoint_id) VALUES ('$token', :permisoId, :endpointId)";
                foreach ($endpoints as $endpointId => $permisos) {
                    foreach ($permisos as $permisoId) {
                        $statement = $pdo->prepare($sql);
                        $statement->bindValue(':permisoId', $permisoId);
                        $statement->bindValue(':endpointId', $endpointId);
                        $statement->execute();
                        $resultado = $statement->rowCount() == 1;
                        if(!$resultado){
                            break;
                        }
                    }
                    if(!$resultado){
                        $pdo->rollBack();
                        break;
                    }
                }
                $resultado = $pdo->commit()?$token:false;

            } else {
                $pdo->rollBack();
            }
        } catch (\PDOException $th) {
            error_log($th->getMessage());
            $pdo->rollBack();
            $resultado = false;
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }
}
