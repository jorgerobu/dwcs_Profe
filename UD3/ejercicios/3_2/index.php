<?php
define('MAX_INTENTOS', 10);
define('MAX_NUM', 1000);

function mostrar_formulario($mensaje = null)
{
    $html = '<!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Número secreto</title>
            </head>
            <body>
                <h1>Juego del número secreto</h1>
                <form action="" method="post">
                    <label for="numero">Número</label><br>
                    <input  id ="numero" name="numero" type="number" min="1" maxlength="' . MAX_NUM . '">
                    <button type="submit">Comprobar</button>
                </form>';

    if ($mensaje != null) {
        $html .= '<h2>' . $mensaje . '</h2>';
    }

    $html .= '</body></html>';
    echo $html;
}

function mostrar_resultado($mensaje)
{
    //Estado 3: Juego terminado.
    //Si  hay resultados es que el juego ha terminado.
    session_unset();

    $html = '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Número secreto</title>
        </head>
        <body>
            <h1>Juego del número secreto</h1>
            <h2>' . $mensaje . '</h2>
            <a href="">Volver a jugar</a>
        </body>
        </html>';
        echo $html;
}

if (!isset($_SESSION['intentos'])) {
    //Estado 1: Empieza el juego
    session_start();
    //Numero de intentos
    $_SESSION['intentos'] = 0;
    //Numero secreto a adivinar.
    $_SESSION['numero'] = rand(1, MAX_NUM);
    //Momento en el que ha empezado el juego.
    $_SESSION['t_start'] = time();
    mostrar_formulario();
} else {
    //Estado 2: Jugando
    if(isset($_POST['numero'])){
        $_SESSION['intentos'] ++;
        $intentos_left = MAX_INTENTOS-$_SESSION['intentos'];
        //Si se ha pasado de los intentos el juego se termina.
        if($intentos_left==0){
            mostrar_resultado("Ohhh has agotado los intentos. El número era ".$_SESSION['numero']);
        }
        //Número del usuario filtrado.
        $user_input = filter_var($_POST['numero'],FILTER_SANITIZE_NUMBER_INT);
        //Comprobamos el número
        if($user_input > $_SESSION['numero']){
            mostrar_formulario("El número secreto es menor que $user_input te quedan $intentos_left intentos.");

        }else if($user_input < $_SESSION['numero']){
            mostrar_formulario("El número secreto es mayor que $user_input te quedan $intentos_left intentos.");
        }else{
            //En este caso son iguales. Se termina el juego ganando.
            $tiempo = time() - $_SESSION['t_start'];            
            mostrar_resultado("Número $user_input correcto! Lo has logrado en ".$_SESSION['intentos']." $tiempo segundos.");
        }

    }else{
        mostrar_resultado("Se ha producido un error.");
    }

}
