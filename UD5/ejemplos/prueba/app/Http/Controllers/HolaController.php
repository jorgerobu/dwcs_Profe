<?php
namespace App\Http\Controllers;

class HolaController extends Controller
{
    public function show(){
        return view('hola');
    }

    public function saludo($nombre=null){
        if($nombre!==null){
            $data['nombre'] = $nombre;
            return view('hola',$data);
        }else{
            return view('hola-gen');
        }

       
    }

    public function general(){

        return view('hola-gen');
    }
}