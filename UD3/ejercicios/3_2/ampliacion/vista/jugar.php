<?php
enum Estado
{
    case Vacio;
    case Mayor;
    case Menor;
    case Gana;
    case Pierde;
}
class Jugar
{

    private int $intentos_left;
    private int $numero;
    private Estado $est;

    public function __construct(Estado $est, $intentos, $numero)
    {
        $this->est = $est;
        $this->intentos_left = $intentos;
        $this->numero = $numero;
    }

    private function mostrar_formulario($mensaje = null)
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

    private function mostrar_resultado($mensaje)
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
            <h2>' . $mensaje . '</h2>
            <a href="">Volver a jugar</a>
        </body>
        </html>';
        echo $html;
    }

    public function html()
    {
        switch ($this->est) {
            case Estado::Vacio:
                mostrar_formulario();
                break;
            case Estado::Gana:
                mostrar_resultado('El núemro '.$this->numero.' es correcto! Te han sobrado '.$this->intentos_left);
                break;
            case Estado::Pierde:
                mostrar_resultado('Oooh. Has perdido el número era: '.$this->numero);
                break;
            case Estado::Mayor:
                mostrar_formulario('El número secreto es mayor que '.$this->numero.'. Te quedan '.$this->intentos_left.' intentos.');
                break;
            case Estado::Menor:
                mostrar_formulario('El número secreto es menor que '.$this->numero.'. Te quedan '.$this->intentos_left.' intentos.');
                break;
            default:
                echo "Se ha producido un error.";
        }
    }
}
