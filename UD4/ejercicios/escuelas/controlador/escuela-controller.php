<?php
include_once("globals.php");
include_once(MODEL_PATH."escuela-model.php");
include_once(MODEL_PATH."municipio-model.php");
include_once(VIEW_PATH."View.php");
class EscuelaController{
    
    public function listar_escuelas($input_data = null){
        $data = $input_data ?? [];
        $nombre_filter = $_REQUEST['nombre'] ?? '';
        $cod_municipio_filter = null;
        if(isset($_REQUEST['municipio']) && !empty($_REQUEST['municipio'])){
            $cod_municipio_filter = $_REQUEST['municipio'];
        }        

        $escuelas = EscuelaModel::get_escuelas($cod_municipio_filter,$nombre_filter);
        $view = new View();
        //Cargamos los datos para pasarle a la vista
        $data['escuelas'] = $escuelas;
        $data['municipios'] = MunicipioModel::get_municipios_escuelas();
        $data['filter_municipio'] = $cod_municipio_filter;
        $data['filter_nombre'] = $nombre_filter;
        $view->show('listar-escuelas',$data);

    }

    public function baja_escuela(){
        $data = null;
        if(isset($_REQUEST['cod_escuela'])){
            $escuela = EscuelaModel::get_escuela($_REQUEST['cod_escuela']);
            $matriculas = EscuelaModel::get_num_matriculas_escuela($escuela);
            $data = ['eliminar'=>['escuela'=>$escuela,'matriculas'=>$matriculas]];
            //Guardamos el codigo de la escuela en la sesión
            session_start();
            $_SESSION['escuela_to_delete'] = $escuela;
        }

        $this->listar_escuelas($data);
    }

    public function eliminar_escuela(){
        session_start();
        if(isset($_SESSION['escuela_to_delete'])){
            EscuelaModel::baja_escuela($_SESSION['escuela_to_delete']);
            unset($_SESSION['escuela_to_delete']);
        }

        $this->listar_escuelas();
    }
}