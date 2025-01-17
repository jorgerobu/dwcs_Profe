<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/ejercicios/tienda/vista/view.php");

class Controller{
    protected View $vista;

    public function __construct()
    {
        $this->vista = new View();
    }

}