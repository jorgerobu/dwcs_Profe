<?php

/**
 * Definicion de los nombres asociados a cada controlador en la URI.
 */
define("CONTROLLER_BANDA", "banda");
define("CONTROLLER_DISCO", "disco");
define("CONTROLLER_PISTA", "pista");

class ControllerException extends Exception{
    function __construct()
    {
        parent::__construct("Error obteniendo el controlador solicitado.");
    }
}

class Controller
{

    public static function sendNotFound($mensaje)
    {
        error_log($mensaje);
        header("HTTP/1.1 404 Not Found");
        $mensaje = ["error" => $mensaje];
        echo json_encode($mensaje, JSON_PRETTY_PRINT);
    }

    public static function getController($nombre): Controller
    {
        $controller = new Controller();
        switch ($nombre) {
            case CONTROLLER_BANDA:
                $controller = new BandaController();
                break;
            case CONTROLLER_DISCO:
                $controller = new DiscoController();
                break;
            case CONTROLLER_PISTA:
                $controller = new PistaController();
                break;
            default:
                throw new ControllerException();
        }
        return $controller;
    }
}
