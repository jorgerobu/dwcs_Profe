<?php
require_once('controlador/LoginController.php');
use webautoriza\controlador\LoginController;
session_start();

$controller = new LoginController();
if(!isset($_SESSION['logged'])){
    $controller->login();
}