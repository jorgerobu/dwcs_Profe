<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function addEquipo(){
        $nuevo = new Equipo();
        $nuevo->nombre = "Equipo 1";
        $nuevo->save();

        $nuevo = new Equipo();
        $nuevo->nombre = "Equipo 2";
        $nuevo->save();

        $nuevo = new Equipo();
        $nuevo->nombre = "Equipo 3";
        $nuevo->save();

        $nuevo = new Equipo();
        $nuevo->nombre = "Equipo 4";
        $nuevo->save();
    }
}
