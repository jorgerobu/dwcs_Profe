<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Alumno;
use Illuminate\Support\Facades\Log;
class MateriaController extends Controller
{
    public function listMaterias(){
        $materias['materias'] = Materia::all();

        return view('list-materias',$materias);
    }


    public function matricularAlumnosForm($id)  {
        $data = array();
        $data['materia'] = Materia::find($id);
        $data['alumnos'] = Alumno::all();

        return view('form-matricula',$data);

    }

    public function matricularAlumnos(Request $request, $id)  {
        $id_alumnos = $request->get('id_alumnos');
        $materia = Materia::find($id);
        
        $materia->alumnos()->syncWithPivotValues($id_alumnos,['curso'=>2025]);
        return $this->listMaterias();
    }
}
