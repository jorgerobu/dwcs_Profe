<?php
    function reverso(int $numero):int{
        $strNum = strval($numero);
        $strNum = strrev($strNum);
        return intval($strNum);
    }
?>

<!-- Uso -->
 <!DOCTYPE html>
 <html lang="es">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reverso</title>
 </head>
 <body>
    <h1>El reverso del número 1234</h1>
    <?php echo 'Calculo: '.reverso(1234);?>
 </body>
 </html>