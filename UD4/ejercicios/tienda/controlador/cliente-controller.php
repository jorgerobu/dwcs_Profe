<?php
include_once("controller.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/ejercicios/tienda/modelo/cliente-model.php");
class ClienteController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function listar()
    {
        $data = array();
        $data['clientes'] = ClienteModel::getClientes();
        $this->vista->show('listar-clientes', $data);
    }

    public function altaForm()
    {
        $this->vista->show('alta-cliente');
    }

    public function altaCliente()
    {

        //Recuperar campos
        $nombre = $_POST['nombre'] ?? null;
        $apellidos = $_POST['aps'] ?? null;
        $telefono = $_POST['telf'] ?? null;
        $mail = $_POST['mail'] ?? null;
        $error = '';

        //Validar campos
        if (!isset($nombre) || strlen($nombre) > 40) {
            $error = 'El nombre es obligatorio y tiene que tener menos de 40 caracteres.<br>';
        }
        if (!isset($apellidos) || strlen($apellidos) > 80) {
            $error .= 'Los apellidos son obligatorios y tienen que tener menos de 80 caracteres.<br>';
        }
        if (isset($telefono)) {
            $telefono = filter_var($telefono, FILTER_SANITIZE_NUMBER_INT);
            if (!$telefono || strlen($telefono)!= 9) {
                $error .= 'Formato del teléfono incorrecto<br>';
            }
        }
        if (isset($mail)) {
            $mail = filter_var($mail, FILTER_VALIDATE_EMAIL);
            if (!$mail) {
                $error .= 'Formato del email incorrecto<br>';
            }
        }

        $data = [];
        if(empty($error)){
            if(ClienteModel::insertarCliente(new Cliente($nombre, $apellidos,$telefono,$mail))){
                $this->listar();
            }else{
                $error .= "Se ha producido un error registrando el cliente.";
            }          
        }

        if(!empty($error)){
            $data['errores'] = $error;
            $this->vista->show('alta-cliente',$data);
        }

        

    }
}
