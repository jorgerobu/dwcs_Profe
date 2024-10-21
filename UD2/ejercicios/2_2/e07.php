<?php
class Estudiante
{
    private $nombre;
    private $calificaciones = [];

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    public function agregarCalificacion($calificacion)
    {
        $this->calificaciones[] = $calificacion;
    }

    public function calcularPromedio()
    {
        return array_sum($this->calificaciones) / count($this->calificaciones);
    }
}

// Usoreturn Estudiante::calcularPromedio($this->calificaciones);
$estudiante = new Estudiante("Martin");
$estudiante->agregarCalificacion(85);
$estudiante->agregarCalificacion(90);
echo "Promedio: " . $estudiante->calcularPromedio();  // Promedio: 87.5
