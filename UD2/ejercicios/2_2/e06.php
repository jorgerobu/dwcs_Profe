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

    public function mostrarInformacion()
    {
        return "Nombre: " . $this->nombre . ", Edad: " . $this->edad;
    }
}

class Profesor extends Persona
{
    private $especialidad;

    public function __construct($nombre, $edad, $especialidad)
    {
        parent::__construct($nombre, $edad);
        $this->especialidad = $especialidad;
    }

    public function mostrarInformacion()
    {
        return parent::mostrarInformacion() . ", Especialidad: " . $this->especialidad;
    }
}

// Uso
$profesor = new Profesor("Seymour Skinner", 44, "Matemáticas");
echo $profesor->mostrarInformacion();  // Nombre: Seymour Skinner, Edad: 44, Especialidad: Matemáticas
