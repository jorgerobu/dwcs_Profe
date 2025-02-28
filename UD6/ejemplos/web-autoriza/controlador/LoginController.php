<?php
namespace webautoriza\controlador;
require_once("Controller.php");
use webautoriza\controlador\Controller;

class LoginController extends Controller{

    public function login(){
        $this->view->show('login');
    }

    public function checkLogin(){
        return true;
    }
}