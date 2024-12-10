<?php
class View{
    public function show($vista, $data){
        include($vista.'.php');
    }
}