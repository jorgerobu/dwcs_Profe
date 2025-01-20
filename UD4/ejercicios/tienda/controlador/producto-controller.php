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


    public function altaProducto()
    {

        //Recuperar campos
        $nombre = $_POST['denom'] ?? null;
        $descripcion = $_POST['desc'] ?? null;
        $cantidad = $_POST['cant'] ?? null;
        $precio = $_POST['precio'] ?? null;
        $error = '';

        //Validar campos
        if (!isset($nombre) || strlen($nombre) > 50) {
            $error = 'El nombre es obligatorio y tiene que tener menos de 50 caracteres.<br>';
        }
        if (isset($descripcion) && strlen($descripcion) > 250) {
            $error .= 'La descripción y tienen que tener menos de 80 caracteres.<br>';
        }
        if (!isset($cantidad) || !filter_var($cantidad, FILTER_SANITIZE_NUMBER_INT)) {
            
            $error .= 'Formato de la cantidad incorrecto.<br>';
        }
        if (!isset($precio) || !filter_var($precio, FILTER_VALIDATE_FLOAT)) {
            
            $error .= 'Formato del precio incorrecto.<br>';
        }

        $data = [];
        if(empty($error)){
            if(ProductoModel::insertarProducto(new Producto($nombre,$precio, $cantidad,$descripcion))){
                $this->listar();
            }else{
                $error .= "Se ha producido un error registrando el producto.";
            }          
        }

        if(!empty($error)){
            $data['errores'] = $error;
            $this->vista->show('alta-cliente',$data);
        }

        

    }
}