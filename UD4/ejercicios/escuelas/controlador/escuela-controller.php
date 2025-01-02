<?php
include_once("globals.php");
include_once(MODEL_PATH."escuela-model.php");
include_once(MODEL_PATH."municipio-model.php");
include_once(VIEW_PATH."View.php");
class EscuelaController{
    
    public function listar_escuelas(){
        $nombre_filter = $_REQUEST['nombre'] ?? '';
        $cod_municipio_filter = null;
        if(isset($_REQUEST['municipio']) && !empty($_REQUEST['municipio'])){
            $cod_municipio_filter = $_REQUEST['municipio'];
        }
        

        $escuelas = EscuelaModel::get_escuelas($cod_municipio_filter,$nombre_filter);
        $view = new View();
        //Cargamos los datos para pasarle a la vista
        $data = [];
        $data['escuelas'] = $escuelas;
        $data['municipios'] = MunicipioModel::get_municipios_escuelas();
        $data['filter_municipio'] = $cod_municipio_filter;
        $data['filter_nombre'] = $nombre_filter;
        $view->show('listar-escuelas',$data);

    }
}