<?php
class Persona
{
    private $nombre;
    private $edad;

    public function __construct($nombre, $edad)
    {
        $this->nombre = $nombre;
        $this->setEdad($edad);  // Usamos el setter para validar
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getEdad()
    {
        return $this->edad;
    }

    public function setEdad($edad)
    {
        if ($edad > 0) {
            $this->edad = $edad;
        } else {
            echo "La edad debe ser positiva.";
        }
    }

    public function esMayorDeEdad()
    {
        return $this->edad >= 18;
    }
}

// Uso
$persona = new Persona("Ana", 16);
echo $persona->esMayorDeEdad() ? "Es mayor de edad" : "Es menor de edad";  // Es menor de edad
