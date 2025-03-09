<?php
include_once("BandaController.php");
include_once("DiscoController.php");
include_once("PistaController.php");

define("BANDA_CONTROLLER","banda");
define("DISCO_CONTROLLER","disco");
define("PISTA_CONTROLLER","pista");

class ExceptionController extends Exception{
    function __construct()
    {
        parent::__construct("Error obteniendo el controlador solictado");
    }
}

abstract class Controller{
    public static function sendNotFound($mensaje)
    {
        error_log($mensaje);
        header("HTTP/1.1 404 Not Found");
        $mensaje = ["error" => $mensaje];
        echo json_encode($mensaje, JSON_PRETTY_PRINT);
    }
    
    public static function getController($nombreController){
        $controller = null;

        switch($nombreController){
            case "BANDA_CONTROLLER":
                $controller = new BandaController();
                break;
            case "DISCO_CONTROLLER":
                $controller = new DiscoController();
                break;
            case "PISTA_CONTROLLER":
                $controller = new PistaController();
                break;
            default:
                throw new ExceptionController();
        }
        return $controller;
    }
    
    public abstract function get($id);
    public abstract function getAll();
    public abstract function insert($object);
    public abstract function delete($id);
    public abstract function update($id, $object);
}
?>