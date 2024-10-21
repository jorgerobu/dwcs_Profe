<?php
class Direccion
{
    private $calle;
    private $ciudad;
    private $codigoPostal;

    public function __construct($calle, $ciudad, $codigoPostal)
    {
        $this->calle = $calle;
        $this->ciudad = $ciudad;
        $this->codigoPostal = $codigoPostal;
    }

    public function getDireccionCompleta()
    {
        return $this->calle . ", " . $this->ciudad . ", " . $this->codigoPostal;
    }
}

class Persona
{
    private $nombre;
    private $edad;
    private $direccion;

    public function __construct($nombre, $edad, Direccion $direccion)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->direccion = $direccion;
    }

    public function mostrarDireccion()
    {
        return $this->direccion->getDireccionCompleta();
    }
}

// Uso
$direccion = new Direccion("Calle Falsa 123", "Springfield", "12345");
$persona = new Persona("Bart", 10, $direccion);
echo $persona->mostrarDireccion();  // Calle Falsa 123, Springfield, 12345
