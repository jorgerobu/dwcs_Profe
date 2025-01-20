<?php
include_once('conexionDB.php');
class Cliente{
    private int $id_cliente; 
    private string $nombre; 
    private string $apellidos; 
    private string $telefono ;
    private string $mail;
    

    public function __construct(string $nombre, string $apellidos, string $telefono, string $mail, int $id = null)
    {
        if(isset($id)){
            $this->id_cliente = $id; 
        }
        $this->nombre = $nombre; 
        $this->apellidos = $apellidos; 
        $this->telefono = $telefono;
        $this->mail = $mail;
    }

   

    /**
     * Get the value of id_cliente
     */ 
    public function getId_cliente()
    {
        return $this->id_cliente;
    }

    /**
     * Set the value of id_cliente
     *
     * @return  self
     */ 
    public function setId_cliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;

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
     * Get the value of apellidos
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }
}

class ClienteModel{

    public static function getClientes():array{
        $clientes = [];
        $pdo = ConexionDB::getConnexion();
        $sql = "SELECT cod_cliente, nombre, apellidos, telefono, mail FROM cliente";

        try {
            $statement = $pdo->query($sql);
            foreach($statement as $row){
                $cliente = new Cliente($row['nombre'],
                                        $row['apellidos'],
                                        $row['telefono'],
                                        $row['mail'],
                                        $row['cod_cliente']);
                $clientes[] = $cliente;
            }
        } catch (PDOException $th) {
            error_log("Error obteniendo clientes de la BD. ".$th->getMessage());
        }finally{
            $pdo = null;
            $statement = null;
        }
        return $clientes;
    }

    public static function insertarCliente(Cliente $c){
        $toret = false;
        $pdo = ConexionDB::getConnexion();
        $sql = "INSERT INTO cliente(nombre, apellidos, telefono, mail) VALUES (?,?,?,?)";

        try {
            $statement = $pdo->prepare($sql);
            $statement->bindValue(1,$c->getNombre(),PDO::PARAM_STR);
            $statement->bindValue(2,$c->getApellidos(),PDO::PARAM_STR);
            $statement->bindValue(3,$c->getTelefono());
            $statement->bindValue(4,$c->getMail());
            // $statement->debugDumpParams();
            $toret = $statement->execute();

        } catch (PDOException $th) {
            error_log("Error obteniendo clientes de la BD. ".$th->getMessage());
            $toret = false;
        }finally{
            $pdo = null;
            $statement = null;
        }
        return $toret;
    }
    
}


