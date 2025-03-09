<?php

namespace webautoriza\model;

require_once("Model.php");

class UsuarioModel extends Model
{

    public static function getUserByPass($user, $pass): object | false
    {
        $sql = "SELECT id, nombre, apellido1, apellido2, email, user, pass FROM usuario WHERE user=:user AND pass=:pass";
        $pdo = self::getConexion();
        $usuario = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':user', $user);
            $statement->bindValue(':pass', hash('sha256', $pass));
            $statement->execute();
            $usuario = $statement->fetch(\PDO::FETCH_OBJ);
        } catch (\PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $usuario;
    }

    public static function getUsersByUserEmail($user, $email): array | false
    {
        $sql = "SELECT id, nombre, apellido1, apellido2, email, user, pass FROM usuario WHERE user=:user OR email=:email";
        $pdo = self::getConexion();
        $user = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':user', $user);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $user = $statement->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $user;
    }

    public static function addUser($nombre, $apellido1, $apellido2, $email, $user, $pass): bool
    {
        $sql = "INSERT INTO usuario(nombre, apellido1, apellido2, email, user, pass) VALUES 
        (:nombre, :apellido1, :apellido2, :email, :user, :pass)";
        $pdo = self::getConexion();
        $resultado = false;
        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(':nombre', $nombre);
            $statement->bindValue(':apellido1', $apellido1);
            $statement->bindValue(':apellido2', $apellido2);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':user', $user);
            $statement->bindValue(':pass', hash('sha256', $pass));
            $statement->execute();
            $resultado = $statement->rowCount() == 1;
        } catch (\PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $statement = null;
            $pdo = null;
        }

        return $resultado;
    }
}
