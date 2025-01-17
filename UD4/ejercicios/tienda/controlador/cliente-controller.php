<?php
include_once("controller.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/ejercicios/tienda/modelo/cliente-model.php");
class ClienteController extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function listar(){
        $data = array();
        $data['clientes'] = ClienteModel::getClientes();
        $this->vista->show('listar-clientes', $data);

    }

    public function altaForm(){
        $this->vista->show('alta-cliente');

    }
}