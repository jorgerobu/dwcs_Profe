<?php
class ErrorPage
{
    private $mensaje;

    function __construct($mensaje = null)
    {
        $this->mensaje = $mensaje;
        if ($mensaje != null) {
            $this->mensaje = "Se ha producido un error desconocido.";
        }
    }

    public function  html()
    {
        return '<!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Error</title>
            </head>
            <body>
                <h1>Se ha producido un error</h1>
                '.$this->mensaje.'
                <a href="?action=login">Volver a inicio</a>
                
            </body>
            </html>';
    }
}
