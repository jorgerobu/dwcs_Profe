<?php
include('controlador/controller.php');
$action = isset($_GET['action']) ? $_GET['action']: 'login';

procesar_peticion($action);