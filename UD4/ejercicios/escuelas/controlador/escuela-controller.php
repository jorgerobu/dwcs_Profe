<?php
include($_SERVER["DOCUMENT_ROOT"]."/ejercicios/escuelas/modelo/escuela-model.php");
include($_SERVER["DOCUMENT_ROOT"]."/ejercicios/escuelas/vista/View.php");
class EscuelaController{
    
    public function listar_escuelas(){
        $nombre_filter = $_REQUEST['nombre'] ?? '';
        $cod_municipio_filter = $_REQUEST['municipio'] ?? null;

        $escuelas = EscuelaModel::get_escuelas($cod_municipio_filter,$nombre_filter);
        $view = new View();
        $data = [];
        $data['escuelas'] = $escuelas;
        //TODO: Recuperar municipios.
        $data['municipio'] = [];
        $view->show('listar_escuelas',$data);

    }
}