<?php
include_once("controller.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/ejercicios/tienda/modelo/producto-model.php");
class ProductoController extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function listar(){
        $data = array();
        $data['productos'] = ProductoModel::getProductos();
        $this->vista->show('listar-productos', $data);

    }

    public function altaForm(){
        $this->vista->show('alta-producto');

    }
}