<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function eliminar($id){
        //Eliminamos el usuario de id=$id.
    }

    public function formAlta(){
        Log::debug("en formAlta");
        return view("alta-form");
    }

    public function alta(Request $r){
        Log::debug("En alta");
        $r->validate([
            'nombre'=>'required',
            'telf'=>'required'
        ]);

        // session()->put('nombre',$r->get('nombre'));

        // //Almacenar en sesión
        // $r->session()->put('clave','valor');
        // //Recuperar una variable de sesión.
        // $r->session()->get('clave');
        // //Recuperar y eliminar la variable de sesión.
        // $r->session()->pull('clave');
        // //Saber si una variable existe en la sesión y no es NULL.
        // $r->session()->has('clave');
        // //Saber si una variable existe aunque sea null.
        // $r->session()->exists('clave');
        // //Eliminar una variable de sesión
        // $r->session()->forget('clave');
        // //Eliminar todos los datos de la sesión
        // $r->session()->flush();
        // //Regenerar el ID de sesión
        // $r->session()->regenerate();
        // //Regenerar el ID de sesión y eliminar todos los datos
        // $r->session()->invalidate();

        $data = array();
        $data['nombre'] = $r->get("nombre");
        $data['apellidos'] = $r->get("aps");

        $data['telefono'] = $r->get("telf");

        return view('datos-alta', $data);
    }
}
