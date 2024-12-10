<?php

class ErrorController{

    public function showControllerNotFound(){
  
        include('controller_not_found.htm');
    }

    public function showActionNotFound(){
  
        include('action_not_found.htm');
    }


}