<?php
require_once('controlador/UserController.php');
require_once('controlador/Controller.php');
use webautoriza\controlador\UserController ;
use webautoriza\controlador\Controller ;
session_start();

$controller = $_GET['controller'] ?? null;
$method = $_GET['action'] ?? null;
try {
    $controller = Controller::getController($controller);
    $controller->$method();
} catch (\Throwable $th) {
    error_log($th->getMessage());
    $controller = new UserController();
    $controller->login();
}

