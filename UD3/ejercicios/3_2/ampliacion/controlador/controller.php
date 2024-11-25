<?php
//Vista
include("../vista/login.php");
include("../vista/jugar.php");
//Modelo
include('../modelo/partida.php');
include('../modelo/usuario.php');
include('../modelo/model.php');

define('MAX_NUM',1000);
define('MAX_INTENTOS',10);
define('ACTION_JUGAR','jugar');
define('ACTION_LOGIN','login');
define('ACTION_RANKING','ranking');


function is_logged(){
    $logged = false;
    if(isset($_SESSION['usuario'])){
        $logged = true;
    }

    return $logged;
}

function procesar_peticion($action=null){
    session_start();
    $action = $action==null ? ACTION_LOGIN: $action;
    $vista = new Login();
    if($action == ACTION_RANKING){
        $vista = ranking();
    }else{
        if(is_logged()){
            $vista = jugar();
        }else{
            $vista = login();
        }
    }
    
    $vista->html();
}

function jugar(){
    if (isset($_POST['numero'])) {
        $_SESSION['intentos']++;
        $intentos_left = MAX_INTENTOS - $_SESSION['intentos'];
        $vista = null;
        //Si se ha pasado de los intentos el juego se termina.
        if ($intentos_left < 0) { //PIERDE (agota los intentos)
            $vista = new Jugar(Estado::Pierde,$intentos_left,$_SESSION['numero']);
            //Destruir session.
            session_unset();
        } else {
            //Número del usuario filtrado.
            $user_input = filter_var($_POST['numero'], FILTER_SANITIZE_NUMBER_INT);
            //Comprobamos el número
            if ($user_input > $_SESSION['numero']) {
                $vista = new Jugar(Estado::Menor,$intentos_left,$_POST['numero']);
            } else if ($user_input < $_SESSION['numero']) {
                $vista = new Jugar(Estado::Mayor,$intentos_left,$_POST['numero']);
            } else { //GANA
                //En este caso son iguales. Se termina el juego ganando.
                $tiempo = time() - $_SESSION['t_start'];
                $vista = new Jugar(Estado::Gana,$intentos_left,$_POST['numero']);
                //Guardar partida en la BD.
                $partida = new Partida();
                $partida->setId_usuario($_SESSION['usuario'])
                ->setIntentos($_SESSION['intentos'])
                ->setTiempo(time()-intval($_SESSION['t_start']));
                alta_partida($partida);
                //Destruir session.
                session_unset();
            }
        }
    } else {
        $vista = new Error();
    }

    return $vista;
}

function ranking(){
    //Buscar todas las partidas.
    $vista = 'ranking.html';
}

function login(){
    $vista = new Login();
    if(isset($_POST['nombre'])){
        //Creamos el usuario si no existe.
        alta_usuario($_POST['nombre']);
        //Obtenemos el id_usuario
        $usuario = get_usuario($_POST['nombre']);

        $_SESSION['usuario'] = $usuario->getId_usuario();
        $_SESSION['intentos'] = 0;
        $_SESSION['t_start'] = time();
        $_SESSION['numero'] = rand(1, MAX_NUM);
        $vista = new Jugar(Estado::Vacio,MAX_INTENTOS,$_SESSION['numero']);
    }

    return $vista;

}