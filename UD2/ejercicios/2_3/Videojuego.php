<?php
/**
 * Clase que representa un videojuego.
 */
class Videojuego{
    private $id;
    private string $nombre;
    private string $plataforma;
    private  $genero;
    private int $anio_lanzamiento;


    public function __construct( string $nombre, string $plataforma,  $genero, int $anio_lanzamiento,$id=null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->plataforma = $plataforma;
        $this->genero = $genero;
        $this->anio_lanzamiento = $anio_lanzamiento;
    }
    
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

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
     * Get the value of plataforma
     */ 
    public function getPlataforma()
    {
        return $this->plataforma;
    }

    /**
     * Set the value of plataforma
     *
     * @return  self
     */ 
    public function setPlataforma($plataforma)
    {
        $this->plataforma = $plataforma;

        return $this;
    }

    /**
     * Get the value of genero
     */ 
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set the value of genero
     *
     * @return  self
     */ 
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get the value of anio_lanzamiento
     */ 
    public function getAnio_lanzamiento()
    {
        return $this->anio_lanzamiento;
    }

    /**
     * Set the value of anio_lanzamiento
     *
     * @return  self
     */ 
    public function setAnio_lanzamiento($anio_lanzamiento)
    {
        $this->anio_lanzamiento = $anio_lanzamiento;

        return $this;
    }
}