<?php
interface Identificable
{
    public function getIdentificador();
}

class Estudiante implements Identificable
{
    private $numeroEstudiante;

    public function __construct($numeroEstudiante)
    {
        $this->numeroEstudiante = $numeroEstudiante;
    }

    public function getIdentificador()
    {
        return "Estudiante ID: " . $this->numeroEstudiante;
    }
}

class Profesor implements Identificable
{
    private $numeroEmpleado;

    public function __construct($numeroEmpleado)
    {
        $this->numeroEmpleado = $numeroEmpleado;
    }

    public function getIdentificador()
    {
        return "Profesor ID: " . $this->numeroEmpleado;
    }
}

function mostrarIdentificadores(array $personas)
{
    foreach ($personas as $persona) {
        echo $persona->getIdentificador() . "<br>";
    }
}

// Uso
$personas = [
    new Estudiante(12345),
    new Profesor(67890)
];

mostrarIdentificadores($personas);  // Estudiante ID: 12345, Profesor ID: 67890