<?php
namespace webautoriza\vista;
class View{
    public function show($vista){
        include_once($vista.'-view.php');
    }
}