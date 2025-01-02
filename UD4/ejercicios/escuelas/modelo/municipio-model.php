<?php
include_once("connectionDB.php");
class Municipio{
    private int $codigo;
    private string $nombre;
    private float $latitud;
    private float $longitud;
    private float $altitud;
    private int $cod_provincia;

    public function __construct($codigo, $nombre, $longitud, $latitud, $altitud, $cod_provincia)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->longitud = $longitud;
        $this->latitud = $latitud;
        $this->altitud = $altitud;
        $this->cod_provincia = $cod_provincia;
        
    }

    /**
     * Get the value of codigo
     */ 
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */ 
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

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
     * Get the value of latitud
     */ 
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set the value of latitud
     *
     * @return  self
     */ 
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get the value of longitud
     */ 
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set the value of longitud
     *
     * @return  self
     */ 
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get the value of altitud
     */ 
    public function getAltitud()
    {
        return $this->altitud;
    }

    /**
     * Set the value of altitud
     *
     * @return  self
     */ 
    public function setAltitud($altitud)
    {
        $this->altitud = $altitud;

        return $this;
    }

    /**
     * Get the value of cod_provincia
     */ 
    public function getCod_provincia()
    {
        return $this->cod_provincia;
    }

    /**
     * Set the value of cod_provincia
     *
     * @return  self
     */ 
    public function setCod_provincia($cod_provincia)
    {
        $this->cod_provincia = $cod_provincia;

        return $this;
    }
}

class MunicipioModel{
    public static function get_municipios($cod_provincia=null){
        $db = ConnectionDB::get();
        $sql = "SELECT cod_municipio, cod_provincia, nombre, latitud, longitud, altitud 
                FROM municipio WHERE ? IS NULL OR cod_provincia = ? ORDER BY nombre ASC";
        $statement = $db->prepare($sql);
        $statement->bindValue(1,$cod_provincia);
        $statement->bindValue(2,$cod_provincia);

        $municipios = [];
        try {
            $statement->execute();
            foreach($statement as $row){
                $municipio = new Municipio($row['cod_municipio'],$row['nombre'],$row['longitud'], $row['latitud'], $row['altitud'], $row['cod_provincia']);
                $municipios[] = $municipio;
            }
        } catch (PDOException $th) {
            error_log("Error obteniendo escuelas ".$th->getMessage());
        }finally{
            $statement = null;
            $db = null;
        }

        return $municipios;
    }


    /**
     * Devuelve los municipios con escuelas.
     */
    public static function get_municipios_escuelas($cod_provincia=null){
        $db = ConnectionDB::get();
        $sql = "SELECT DISTINCT m.cod_municipio, m.cod_provincia, m.nombre, m.latitud, m.longitud, m.altitud 
                FROM municipio m INNER JOIN escuela e ON e.cod_municipio = m.cod_municipio
                WHERE ? IS NULL OR cod_provincia = ? ORDER BY nombre ASC";
        $statement = $db->prepare($sql);
        $statement->bindValue(1,$cod_provincia);
        $statement->bindValue(2,$cod_provincia);

        $municipios = [];
        try {
            $statement->execute();
            foreach($statement as $row){
                $municipio = new Municipio($row['cod_municipio'],$row['nombre'],$row['longitud'], $row['latitud'], $row['altitud'], $row['cod_provincia']);
                $municipios[] = $municipio;
            }
        } catch (PDOException $th) {
            error_log("Error obteniendo escuelas ".$th->getMessage());
        }finally{
            $statement = null;
            $db = null;
        }

        return $municipios;
    }
}