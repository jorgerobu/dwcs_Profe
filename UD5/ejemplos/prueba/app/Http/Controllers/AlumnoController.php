<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Equipo;

use Illuminate\Http\Request;

class AlumnoController extends Controller
{

    public function altaForm(){

        $equipos = Equipo::all();
        return view('form-alumno',['equipos'=>$equipos]);
    }


    public function addAlumno(Request $r){

        $nuevo = new Alumno();
        $nuevo->nombre = $r->get('nombre');
        $nuevo->dni = $r->get('dni');
        $nuevo->media = $r->get('media');
        $nuevo->equipo_id = $r->get('equipo_id')=='-1'?null:$r->get('equipo_id');

        $nuevo->save();

        return $this->listAlumnos();

    }

    public function listAlumnos(){

        $alumnos = Alumno::all();
        $data['alumnos'] = $alumnos;

        return view('list-alumnos',$data);

    }
}
