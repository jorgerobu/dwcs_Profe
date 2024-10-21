<?php
abstract class PersonaAbstracta
{
    protected $nombre;
    protected $edad;

    public function __construct($nombre, $edad)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    abstract public function mostrarInformacion();
    abstract public function esMayorDeEdad();
}

class Estudiante extends PersonaAbstracta
{
    public function mostrarInformacion()
    {
        return "Estudiante: " . $this->nombre . ", Edad: " . $this->edad;
    }

    public function esMayorDeEdad()
    {
        return $this->edad >= 18;
    }
}

// Uso
$estudiante = new Estudiante("Nelson", 17);
echo $estudiante->mostrarInformacion();  // Estudiante: Nelson, Edad: 17
