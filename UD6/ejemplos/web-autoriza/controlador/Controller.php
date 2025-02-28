<?php
namespace webautoriza\controlador;
include_once("globals.php");
require_once(PATH_VISTA."View.php");
use webautoriza\vista\View;
class Controller{

    protected $view;
    public function __construct()
    {
        $this->view = new View();
    }

    public static function getController($name){
        return new $name();
    }
}