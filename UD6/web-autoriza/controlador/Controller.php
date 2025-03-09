<?php
namespace webautoriza\controlador;
include_once("globals.php");
require_once(PATH_VISTA."View.php");
use webautoriza\vista\View;
class Controller{

    static $controllers = [
        'user'=>'webautoriza\\controlador\\UserController',
        'token' => 'webautoriza\\controlador\\TokenController'
    ];

    protected $view;
    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * Si no está logueado redirige a la página de login
     */
    public function noLoggedRedirect(){
        if(!isset($_SESSION['loged'])){
            header('Location: '.PATH_ROOT);
            die();
        }
        
    }

    public static function getController($nombre){
        if(array_key_exists($nombre,self::$controllers)){
            $object = self::$controllers[$nombre];
            return new $object();
        }
        return null;
    }
}