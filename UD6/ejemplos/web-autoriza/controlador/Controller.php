<?php
include_once("globals.php");
// Incluir controladores

class Controller{
    public static function getController($name){
        return new $name();
    }
}