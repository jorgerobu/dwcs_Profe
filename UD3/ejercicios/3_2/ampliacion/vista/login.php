<?php
class Login
{

    public function html()
    {
        echo '<!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Login</title>
                </head>
                <body>
                    <h1>Nombre de usuario</h1>
                    <form action="?action=login" method="post">
                        <input type="text" id="nombre" name="nombre"><br>
                        <button type="submit">Empezar</button>
                    </form>
                    <a href="?action=ranking">Ranking</a>
                </body>
                </html>';
    }
}
