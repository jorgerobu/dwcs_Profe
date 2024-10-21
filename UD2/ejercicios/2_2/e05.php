<?php
class Estudiante
{
    private $nombre;
    private $edad;
    private $grado;

    public function __construct($nombre, $edad, $grado)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->grado = $grado;
    }

    public static function calcularPromedio($calificaciones)
    {
        $total = array_sum($calificaciones);
        return $total / count($calificaciones);
    }
}

// Uso
$calificaciones = [90, 80, 85, 100];
echo "Promedio: " . Estudiante::calcularPromedio($calificaciones);  // Promedio: 88.75
