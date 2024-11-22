<?php
//Manejamos los estados de la aplicación.
DEFINE('JUGANDO', 'jugando');
DEFINE('RANKING', 'ranking');
DEFINE('LOGIN', 'login');
session_start();

function is_logged()
{
    $logged = false;
    if (isset($_SESSION['usuario'])) {
        $logged = true;
    }

    return $logged;
}

function procesar_peticion(string $action)
{
    $vista = $_SERVER['DOCUMENT_ROOT'] . '/login.html';
    if (is_logged()) {

        switch ($action) {
            case JUGANDO:
                $vista = jugar();
                break;
            case RANKING:
                $vista = ranking();
                break;
        }
    } else {
        $vista = login();
    }
    include($vista);
}

function login()
{
    $vista = $vista = $_SERVER['DOCUMENT_ROOT'] . '/login.html';
    if (isset($_POST['nombre'])) {
        //Creamos el usuario (si no existe).
        //Obtenemos el usuario.
        //$_SESSION['usuario'] = $usr;
        //Empieza el juego
        $_SESSION['intentos'] = 0;
        //Numero secreto a adivinar.
        $_SESSION['numero'] = rand(1, MAX_NUM);
        //Momento en el que ha empezado el juego.
        $_SESSION['t_start'] = time();

        $vista = $_SERVER['DOCUMENT_ROOT'] . '/juego.html';
    }
    return $vista;
}


function jugar() {
    $vista = $vista = $_SERVER['DOCUMENT_ROOT'] . '/juego.html';
    if(isset($_POST['numero'])){

    }else{
        $vista = $vista = $_SERVER['DOCUMENT_ROOT'] . '/error.html';
    }

}

function terminar_juego(){
    session_unset();
}
