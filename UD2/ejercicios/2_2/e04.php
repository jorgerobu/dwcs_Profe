<?php
class Persona
{
    protected $nombre;
    protected $edad;

    public function __construct($nombre, $edad)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }
}

class Estudiante extends Persona
{
    private $grado;

    public function __construct($nombre, $edad, $grado)
    {
        parent::__construct($nombre, $edad);
        $this->grado = $grado;
    }

    public function mostrarInformacion()
    {
        return "Nombre: " . $this->nombre . ", Edad: " . $this->edad . ", Grado: " . $this->grado;
    }
}

// Uso
$estudiante = new Estudiante("Lisa", 8, "4to grado");
echo $estudiante->mostrarInformacion();  // Nombre: Lisa, Edad: 8, Grado: 4to grado
