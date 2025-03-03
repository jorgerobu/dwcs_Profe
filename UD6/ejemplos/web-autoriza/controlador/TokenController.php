<?php
namespace webautoriza\controlador;
require_once("Controller.php");
require_once(PATH_MODEL . "TokenModel.php");
require_once(PATH_MODEL . "PermisoModel.php");
require_once(PATH_MODEL . "EndpointModel.php");
use webautoriza\controlador\Controller;
use webautoriza\model\TokenModel;
use webautoriza\model\PermisoModel;
use webautoriza\model\EndpointModel;

class TokenController extends Controller{

    public function __construct()
    {
       //Comprobamos que esté logueado
       parent::__construct();
       $this->noLoggedRedirect();
       
    }

    public function getTokens(){
        $tokens = TokenModel::getTokensByUser($_SESSION['loged']->id);
        for($i=0; $i<count($tokens); $i++){
            $permisos = PermisoModel::getPermisosByToken($tokens[$i]->token);
            $tokens[$i]->permisos = $permisos;
        }
        $data['datos_usr'] = $_SESSION['loged']->nombre." ".$_SESSION['loged']->apellido1;
        $data['tokens'] = $tokens;
        $this->view->show('tokens',$data);

    }

    public function altaToken(){
        
        $data = [];
        $data['endpoints'] = EndpointModel::getEndpoints();
        $permisos = PermisoModel::getPermisos();
        foreach($permisos as $permiso){
            $data[$permiso->nombre] = $permiso->id;
        }
        $data['datos_usr'] = $_SESSION['loged']->nombre." ".$_SESSION['loged']->apellido1;
        $this->view->show('alta-token',$data);
       
    }

    public function addToken(){
        $endpoints = EndpointModel::getEndpoints();
        $permisos = [];
        foreach($endpoints as $ep){
            if(isset($_POST[$ep->id]) && count($_POST[$ep->id]) > 0){
                $permisos[$ep->id] = $_POST[$ep->id];
            }
        }
        $token = TokenModel::addToken($_SESSION['loged']->id, $permisos);
        if($token){
            echo $token;
        }else{
            echo "No se ha podido generar el token.";
        }
    }

    public function deleteToken(){
        
    }
}