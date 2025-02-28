<?php
namespace webautoriza\vista;
class View{
    public function show($vista, $data = null){
        include_once($vista.'-view.php');
    }
}