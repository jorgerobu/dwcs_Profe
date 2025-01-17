<?php
include_once('conexionDB.php');
class Producto{
    private int $id_producto; 
    private string $nombre; 
    private string $descripcion; 
    private float $precio ;
    private int $cantidad;
    

    public function __construct(string $nombre, string $descripcion, float $precio, int $cantidad, int $id = null)
    {
        $this->id_producto = $id; 
        $this->nombre = $nombre; 
        $this->descripcion = $descripcion; 
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    /**
     * Get the value of id_producto
     */ 
    public function getId_producto()
    {
        return $this->id_producto;
    }

    /**
     * Set the value of id_producto
     *
     * @return  self
     */ 
    public function setId_producto($id_producto)
    {
        $this->id_producto = $id_producto;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */ 
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }
}


class ProductoModel{

    public static function getProductos():array{
        $productos = [];
        $pdo = ConexionDB::getConnexion();
        $sql = "SELECT cod_producto, denominacion, descripcion, precio, cantidad FROM producto";

        try {
            $statement = $pdo->query($sql);
            foreach($statement as $row){
                $producto = new Producto($row['denominacion'],
                                        $row['descripcion'],
                                        $row['precio'],
                                        $row['cantidad'],
                                        $row['cod_producto']);
                $productos[] = $producto;
            }
        } catch (PDOException $th) {
            error_log("Error obteniendo productos de la BD. ".$th->getMessage());
        }finally{
            $pdo = null;
            $statement = null;
        }
        return $productos;
    }
    
}